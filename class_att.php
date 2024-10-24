<?php
require 'vendors/autoload.php';

include_once 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



if (isset($_POST['export_excel'])) {
    // Create a new Spreadsheet object
    $start = $_POST['start'];
    $end = $_POST['end'];
    if (isset($_GET['classatt'])) {
        $classatt = $_GET['classatt'];
        // echo $classname;
        $query = "SELECT stu.En_name,
                stu.Kh_name,
                stu.Stu_code,
                stu.DOB,
                stu.Address,
                stu.Phone,
                stu.Gender,
                r.Name,
                co.Course_name,
                c.Shift,
                c.Start_class,
                c.End_class,
                t.Kh_name AS Teacher_Name,
                att.Date,
                att.Attendance 
                  FROM tb_attendance att
                  INNER JOIN tb_student stu ON att.Stu_id = stu.ID
                  INNER JOIN tb_class c ON att.Class_id = c.ClassID
                  INNER JOIN tb_teacher t ON c.Teacher_id = t.id
                  INNER JOIN tb_course co ON c.course_id = co.id
                  INNER JOIN tb_classroom r ON c.room_id = r.id
WHERE Class_id =:classatt AND att.Date BETWEEN '$start' AND '$end' ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':classatt', $classatt, PDO::PARAM_INT);
        $stmt->execute();
        $Class = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $headers = ['Student Code', 'Kh Name', 'Gender', 'DOB', 'Phone', 'Attendance'];
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '1', $header);
        $column++;
    }

    // Populate rows with data
    $rowCount = 2;
    foreach ($Class as $row) {
        $sheet->setCellValue('A' . $rowCount, $row['Stu_code']);
        $sheet->setCellValue('B' . $rowCount, $row['Kh_name']);
        $sheet->setCellValue('C' . $rowCount, $row['Gender']);
        $sheet->setCellValue('D' . $rowCount, $row['DOB']);
        $sheet->setCellValue('E' . $rowCount, $row['Phone']);
        $sheet->setCellValue('F' . $rowCount, $row['Attendance']);
        $rowCount++;
    }

    // Set the headers for the Excel file download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="attendance_list.xlsx"');
    header('Cache-Control: max-age=0');

    // Create an Xlsx writer and output the spreadsheet to the browser
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit; // Exit to prevent further output
}

if (isset($_POST['save'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    if (isset($_GET['classatt'])) {
        $classatt = $_GET['classatt'];
        // echo $classname;
        $query = "SELECT stu.En_name,
                stu.Kh_name,
                stu.Stu_code,
                stu.DOB,
                stu.Address,
                stu.Phone,
                stu.Gender,
                r.Name,
                co.Course_name,
                c.Shift,
                c.Start_class,
                c.End_class,
                t.Kh_name AS Teacher_Name,
                att.Date,
                att.Attendance 
                  FROM tb_attendance att
                  INNER JOIN tb_student stu ON att.Stu_id = stu.ID
                  INNER JOIN tb_class c ON att.Class_id = c.ClassID
                  INNER JOIN tb_teacher t ON c.Teacher_id = t.id
                  INNER JOIN tb_course co ON c.course_id = co.id
                  INNER JOIN tb_classroom r ON c.room_id = r.id
WHERE Class_id =:classatt AND att.Date BETWEEN '$start' AND '$end' ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':classatt', $classatt, PDO::PARAM_INT);
        $stmt->execute();
        $Class = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
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



<!-- <div class="">
    <h3 class="card-title float-sm-right pr-4 pt-4">
        <button type="button" class="btn bg-danger text-white" onclick="window.print()">
            <i class="fa fa-print"></i> ទាញយក
        </button>
    </h3> -->

<!-- Form for exporting to Excel -->
<!-- <form method="post" class="float-sm-right pr-4 pt-4">
    <button type="submit" name="export_excel" class="btn bg-success text-white">
        <i class="fa fa-file-excel "></i> Excel
    </button>
</form> -->
</div>

<!-- Content Section (Unchanged) -->
<section class="content-wrapper">
    <form action="" method="post">
        <div class="form-group m-2 card p-4 no-print">
            <div class="row">
                <div class="col-md-2">
                    <input type="date" name="start" id="start" class="form-control"
                        value="<?php echo isset($_POST['start']) ? $_POST['start'] : ''; ?>" required>
                </div>
                <div class="col-md-2">
                    <input type="date" name="end" id="end" class="form-control"
                        value="<?php echo isset($_POST['end']) ? $_POST['end'] : ''; ?>" required>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn1 bg-sis text-white" name="save" id="save" value="បង្ហាញ"
                        class="form-control">
                </div>
                <div class="col-md-3">

                </div>
                <div class="col-md-2">
                    <button class="btn bg-danger text-white" onclick="window.print()">
                        <i class="fa fa-print"></i> ទាញយក
                    </button>
                </div>
                <div class="col-md-1">
                    <button type="submit" name="export_excel" class="btn bg-success text-white">
                        <i class="fa fa-file-excel "></i> Excel
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="row pt-4">
        <?php if (!empty($Class)) { ?>
        <div class="col-sm-4">

            <div class="ml-3">
                <tr>បន្ទប់ <?php echo htmlspecialchars($Class[0]['Name']); ?> - កម្រិតសិក្សា
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
            <!-- <div class="ml-3">
                <tr>កាលបរិច្ឆេទ: <?php echo htmlspecialchars($Class[0]['Date']); ?></tr>
            </div> -->

        </div>
        <div class="col-sm-5">
            <h3 class="text-center">បញ្ជីវត្តមានសិស្ស</h3>
        </div>
        <?php } ?>
    </div>

    <hr>
    <?php if (isset($Class)) { ?>
    <div class="row m-2">

        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0 text-sm">
                    <table class="table-bordered table-hover table" id="userTbl">
                        <thead class="table-secondary">
                            <tr>
                                <th style=" font-size:16px;">ល.រ</th>
                                <th style=" font-size:16px;">អត្តលេខ</th>
                                <th style=" font-size:16px;">ឈ្មោះ</th>
                                <th style=" font-size:16px;">ភេទ</th>
                                <th style=" font-size:16px;">ថ្ងៃខែឆ្នាំកំណើត</th>
                                <th style=" font-size:16px;">លេខទូរស័ព្ទ</th>
                                <th style=" font-size:16px;">វត្តមាន</th>
                                <th style=" font-size:16px;">ផ្សេងៗ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                                foreach ($Class as $row) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo htmlspecialchars($row['Stu_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['Kh_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['Gender']); ?></td>
                                <td><?php echo htmlspecialchars($row['DOB']); ?></td>
                                <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['Attendance']); ?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } else {
        echo '<h4 class="text-center">គ្មានទិន្នន័យ</h4>';
    } ?>
</section>

<?php include_once "footer.php"; ?>