<?php // For PDF generation
require 'vendors/autoload.php'; // Autoloader for PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; // Xlsx for better compatibility

include_once 'connection.php'; // Database connection


// Function to fetch student data
function fetchStudentData($conn) {
    if(isset($_POST['classname'])){
        $classname = $_POST['classname'];
        // echo $classname;
        }
    $query = "SELECT
        s.En_name AS Student_Name,
        s.Gender,
        s.DOB,
        r.Name,
        co.Course_name,
        c.Shift,
        t.En_name AS Teacher_Name,
        s.Phone
    FROM
        tb_add_to_class ad
    INNER JOIN
        tb_class c ON ad.Class_id = c.ClassID
    INNER JOIN tb_classroom r ON c.room_id = r.id
    INNER JOIN
        tb_course co ON c.course_id = co.id
    INNER JOIN
        tb_teacher t ON c.Teacher_id = t.id
    INNER JOIN
        tb_student s ON ad.Stu_id = s.ID WHERE  r.Name='$classname'";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch data from the database
$data = fetchStudentData($conn);

if (isset($_POST['export_excel'])) {
    // Generate Excel using PhpSpreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $headers = ['Student Name', 'Gender', 'DOB', 'Class Name', 'Course Name', 'Shift', 'Teacher Name', 'Phone'];
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '1', $header);
        $column++;
    }

    // Fill data
    $rowCount = 2; // Start from the second row
    foreach ($data as $row) {
        $sheet->setCellValue('A' . $rowCount, $row['Student_Name']);
        $sheet->setCellValue('B' . $rowCount, $row['Gender']);
        $sheet->setCellValue('C' . $rowCount, $row['DOB']);
        $sheet->setCellValue('D' . $rowCount, $row['Class_name']);
        $sheet->setCellValue('E' . $rowCount, $row['Course_name']);
        $sheet->setCellValue('F' . $rowCount, $row['Shift']);
        $sheet->setCellValue('G' . $rowCount, $row['Teacher_Name']);
        $sheet->setCellValue('H' . $rowCount, $row['Phone']);
        $rowCount++;
    }

    // Save Excel file
    $writer = new Xlsx($spreadsheet); // Use Xlsx for better compatibility
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="report.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit; // Exit after outputting the file
}?>