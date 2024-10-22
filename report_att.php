<?php
require 'vendors/autoload.php'; // for PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include_once 'connection.php'; // Ensure this file connects to the database correctly

// Function to fetch student data
function fetchStudentData($conn)
{
    if (isset($_POST['classname'])) {
        // Sanitize class name
        $classname = filter_input(INPUT_POST, 'classname', FILTER_SANITIZE_STRING);

        // SQL query with a parameter placeholder
        $query = "SELECT stu.En_name, stu.Stu_code, stu.Gender, r.Name, co.Course_name, c.Shift, att.Date, att.Attendance 
                  FROM tb_attendance att
                  INNER JOIN tb_student stu ON att.Stu_id = stu.ID
                  INNER JOIN tb_class c ON att.Class_id = c.ClassID
                  INNER JOIN tb_course co ON c.course_id = co.id
                  INNER JOIN tb_classroom r ON c.room_id = r.id 
                  WHERE r.Name = :classname";

        // Prepare and bind parameters
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':classname', $classname, PDO::PARAM_STR);
        $stmt->execute();
        
        return [$classname, $stmt->fetchAll(PDO::FETCH_ASSOC)];
    }
    return [null, []];
}

// Fetch data from the database
list($classname, $data) = fetchStudentData($conn);

if (empty($data)) {
    echo "No records found for the specified class.";
    exit;
}

if (isset($_POST['export_excel'])) {
    // Create a new spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $headers = ['Attendance Date', 'Student Code', 'Student Name', 'Gender', 'Course Name', 'Class Name', 'Shift', 'Attendance Status'];

    // Set headers in the Excel file
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '1', $header);
        $column++;
    }

    // Fill data in the Excel file
    $rowCount = 2;
    foreach ($data as $row) {
        $sheet->setCellValue('A' . $rowCount, $row['Date']);
        $sheet->setCellValue('B' . $rowCount, $row['Stu_code']);
        $sheet->setCellValue('C' . $rowCount, $row['En_name']);
        $sheet->setCellValue('D' . $rowCount, $row['Gender']);
        $sheet->setCellValue('E' . $rowCount, $row['Course_name']);
        $sheet->setCellValue('F' . $rowCount, $row['Name']);
        $sheet->setCellValue('G' . $rowCount, $row['Shift']);
        $sheet->setCellValue('H' . $rowCount, $row['Attendance']); // Corrected typo from 'Attandance'

        $rowCount++;
    }

    // Save Excel file with dynamic filename
    $classname_safe = preg_replace('/[^A-Za-z0-9_\-]/', '_', $classname); // Clean classname for file name
    $filename = "attendance_report_{$classname_safe}_" . date('Y-m-d') . ".xlsx";
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=\"$filename\"");
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
} elseif (isset($_POST['export_pdf'])) {
    // Using TCPDF for PDF generation
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('បញ្ចីវត្តមានសិស្ស');
    $pdf->AddPage();
    
    // Adding Khmer font (ensure the font is UTF-8 encoded)
    $fontname = TCPDF_FONTS::addTTFfont('Battambang-Regular.ttf', 'TrueTypeUnicode', '', 32);
    $pdf->SetFont($fontname, '', 10);

    // Ensure UTF-8 support in the PDF
    $pdf->SetFont($fontname, '', 12, 'Battambang-Regular.ttf', 'false');
    $pdf->SetTextColor(0, 0, 255); // Blue color for the title
    $pdf->Write(0, 'បញ្ចីវត្តមានសិស្ស', '', 0, 'C', true, 0, false, false, 0);

    $pdf->Ln(4); // Space after title
    
    // Reset text color for table
    $pdf->SetTextColor(0, 0, 0);
    // Start table with headers
    $html = '<table border="1" cellspacing="0" cellpadding="4">
              <tr style="background-color: powderblue;">
                  <th style="color: blue; text-align: center;">កាលបរិច្ឆេទ</th>
                  <th style="color: blue; text-align: center;">អត្តលេខ</th>
                  <th style="color: blue; text-align: center;">ឈ្មោះ</th>
                  <th style="color: blue; text-align: center;">ភេទ</th>
                  <th style="color: blue; text-align: center;">កម្រិតសិក្សា</th>
                  <th style="color: blue; text-align: center;">បន្ទប់</th>
                  <th style="color: blue; text-align: center;">វេនសិក្សា</th>
                  <th style="color: blue; text-align: center;">វត្តមាន</th>
              </tr>';
    
    // Fill table rows
    foreach ($data as $row) {
        $html .= '<tr>
                  <td style="text-align: center;">' . htmlspecialchars($row['Date'], ENT_QUOTES, 'UTF-8') . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Stu_code'], ENT_QUOTES, 'UTF-8') . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['En_name'], ENT_QUOTES, 'UTF-8') . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Gender'], ENT_QUOTES, 'UTF-8') . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Course_name'], ENT_QUOTES, 'UTF-8') . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8') . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Shift'], ENT_QUOTES, 'UTF-8') . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Attendance'], ENT_QUOTES, 'UTF-8') . '</td>
              </tr>';
    }

    $html .= '</table>';
    
    // Write HTML table to PDF
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // Output PDF with dynamic filename
    $classname_safe = preg_replace('/[^A-Za-z0-9_\-]/', '_', $classname); // Clean classname for file name
    $pdfFilename = "students_report_attendance_{$classname_safe}_" . date('Y-m-d') . ".pdf";
    $pdf->Output($pdfFilename, 'I');
    exit;
}
?>