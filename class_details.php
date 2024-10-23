<?php
include_once 'connection.php';
require 'vendors/autoload.php'; // Autoloader for PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_GET['classroom'])){
    $classroom = $_GET['classroom'];
    $query = "SELECT
        s.Kh_name AS Student_Name,
        s.Gender,
        s.Stu_code,
        s.DOB,
        s.Address,
        r.Name AS room,
        co.Course_name,
        c.Shift,
        t.Kh_name AS Teacher_Name,
        s.Phone,
        c.Start_class,
        c.End_class
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
        tb_student s ON ad.Stu_id = s.ID
    WHERE Class_id = :classroom";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':classroom', $classroom, PDO::PARAM_INT);
    $stmt->execute();
    $Class = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST['export_excel'])) {
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $headers = ['Student Code', 'Student Name', 'Gender', 'DOB', 'Address', 'Phone'];
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '1', $header);
        $column++;
    }

    // Populate rows with data
    $rowCount = 2;
    foreach ($Class as $row) {
        $sheet->setCellValue('A' . $rowCount, $row['Stu_code']);
        $sheet->setCellValue('B' . $rowCount, $row['Student_Name']);
        $sheet->setCellValue('C' . $rowCount, $row['Gender']);
        $sheet->setCellValue('D' . $rowCount, $row['DOB']);
        $sheet->setCellValue('E' . $rowCount, $row['Address']);
        $sheet->setCellValue('F' . $rowCount, $row['Phone']);
        $rowCount++;
    }

    // Set the headers for the Excel file download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="student_list.xlsx"');
    header('Cache-Control: max-age=0');

    // Create an Xlsx writer and output the spreadsheet to the browser
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit; // Exit to prevent further output
}

include_once "header.php";
?>

<!-- Styles for print view (unchanged) -->
<style>
@media print {
    footer {
        display: none;
    }

    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black !important;
        color: black !important;
    }

    thead {
        background-color: darkblue !important;
    }

    th,
    td {
        padding: 10px;
    }

    .btn1,
    .card-title {
        display: none;
    }
}

table th {
    background-color: #000;
}
</style>

<div class="">
    <h3 class="card-title float-sm-right pr-4 pt-4">
        <button type="button" class="btn bg-danger text-white" onclick="window.print()">
            <i class="fa fa-print"></i> ទាញយក
        </button>
    </h3>

    <!-- Form for exporting to Excel -->
    <form method="post" class="float-sm-right pr-4 pt-4">
        <button type="submit" name="export_excel" class="btn bg-success text-white">
            <i class="fa fa-file-excel text_white"></i> Excel
        </button>
    </form>
</div>

<!-- Content Section (Unchanged) -->
<section class="content-wrapper">
    <div class="row pt-4">
        <div class="col-sm-4">
            <?php if (!empty($Class)) { ?>
            <div class="ml-3">
                <tr>បន្ទប់ <?php echo htmlspecialchars($Class[0]['room']); ?> - កម្រិតសិក្សា
                    <?php echo htmlspecialchars($Class[0]['Course_name']); ?></tr>
            </div>
            <div class="ml-3">
                <tr>វេនសិក្សា <?php echo htmlspecialchars($Class[0]['Shift']); ?>
                    ឆ្នាំសិក្សា <?php echo htmlspecialchars(date('Y', strtotime($Class[0]['Start_class']))); ?>​ -
                    <?php echo htmlspecialchars(date('Y', strtotime($Class[0]['End_class']))); ?>
                </tr>
            </div>
            <div class="ml-3">
                <tr>គ្រូបង្រៀន: <?php echo htmlspecialchars($Class[0]['Teacher_Name']); ?></tr>
            </div>
            <?php } ?>
        </div>
        <div class="col-sm-4">
            <h3 class="text-center">បញ្ជីឈ្មោះសិស្ស</h3>
        </div>
    </div>

    <hr>
    <div class="row m-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0 text-sm">
                    <table class="table-bordered table-hover table">
                        <thead class="table-secondary">
                            <tr>
                                <th style=" font-size:16px;">ល.រ</th>
                                <th style=" font-size:16px;">អត្តលេខ</th>
                                <th style=" font-size:16px;">ឈ្មោះ</th>
                                <th style=" font-size:16px;">ភេទ</th>
                                <th style=" font-size:16px;">ថ្ងៃខែឆ្នាំកំណើត</th>
                                <th style=" font-size:16px;">អាសយដ្ធាន</th>
                                <th style=" font-size:16px;">លេខទូរស័ព្ទ</th>
                                <th style=" font-size:16px;">ផ្សេងៗ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($Class as $row) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo htmlspecialchars($row['Stu_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['Student_Name']); ?></td>
                                <td><?php echo htmlspecialchars($row['Gender']); ?></td>
                                <td><?php echo htmlspecialchars($row['DOB']); ?></td>
                                <td><?php echo htmlspecialchars($row['Address']); ?></td>
                                <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "footer.php"; ?>