<?php
require('fpdf/fpdf.php'); // or use TCPDF if needed
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
    $pdf->SetTitle('Students Report Attendance');
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 10);

    // Add content to PDF
    $html = '<h1 style="color: blue; text-align: center;">Students Report Attendance</h1>';
    $html .= '<table border="1" cellspacing="0" cellpadding="4">
              <tr style="background-color: powderblue;">
                  <th style="color: blue; text-align: center;">Attendance Date</th>
                  <th style="color: blue; text-align: center;">Student Code</th>
                  <th style="color: blue; text-align: center;">Student Name</th>
                  <th style="color: blue; text-align: center;">Gender</th>
                  <th style="color: blue; text-align: center;">Class</th>
                  <th style="color: blue; text-align: center;">Room</th>
                  <th style="color: blue; text-align: center;">Shift</th>
                  <th style="color: blue; text-align: center;">Attendance</th>
              </tr>';

    // Fill data in PDF
    foreach ($data as $row) {
        $html .= '<tr>
                  <td style="text-align: center;">' . htmlspecialchars($row['Date']) . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Stu_code']) . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['En_name']) . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Gender']) . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Course_name']) . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Name']) . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Shift']) . '</td>
                  <td style="text-align: center;">' . htmlspecialchars($row['Attendance']) . '</td>
              </tr>';
    }

    $html .= '</table>'; 
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output PDF with dynamic filename
    $classname_safe = preg_replace('/[^A-Za-z0-9_\-]/', '_', $classname); // Clean classname for file name
    $pdfFilename = "students_report_attendance_{$classname_safe}_" . date('Y-m-d') . ".pdf";
    $pdf->Output($pdfFilename, 'I');
    exit;
}