<?php
require 'vendors/autoload.php'; // Ensure this is pointing to the correct location of your autoloader.

include_once 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Export to Excel functionality
if (isset($_POST['export_excel'])) {
    $classscore = $_GET['classscore'];
    $for_month = $_GET['for_month'];

    // Fetch data for the selected month and class
    $query = "SELECT 
        stu.Kh_name AS Student_Name, 
        stu.Stu_code,
        stu.Gender,
        r.Name,
        c.Shift,
        co.Course_name,
        c.Start_class,
        c.End_class,
        t.Kh_name AS Teacher_Name,
        ms.for_month,
        ms.Homework, 
        ms.Participation, 
        ms.Attendance, 
        ms.Monthly, 
        ms.Average 
    FROM tb_month_score ms
        INNER JOIN tb_student stu ON ms.Stu_id = stu.ID
        INNER JOIN tb_class c ON ms.Class_id = c.ClassID
        INNER JOIN tb_classroom r ON c.room_id = r.id
        INNER JOIN tb_course co ON c.course_id = co.id
        INNER JOIN tb_teacher t ON c.Teacher_id = t.id 
    WHERE c.`status` = 'active' 
        AND Class_id = :classscore 
        AND ms.for_month = :for_month
    ORDER BY ms.Average DESC, ms.for_month";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':classscore', $classscore, PDO::PARAM_INT);
    $stmt->bindParam(':for_month', $for_month, PDO::PARAM_STR);
    $stmt->execute();
    $Class = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($Class)) {
        // Create a new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header row
        $sheet->setCellValue('A1', 'ល.រ')
              ->setCellValue('B1', 'អត្តលេខ')
              ->setCellValue('C1', 'ឈ្មោះ')
              ->setCellValue('D1', 'ភេទ')
              ->setCellValue('E1', 'កិច្ចការផ្ទះ')
              ->setCellValue('F1', 'ការចូលរួម')
              ->setCellValue('G1', 'វត្តមាន')
              ->setCellValue('H1', 'ប្រចាំខែ')
              ->setCellValue('I1', 'មធ្យមភាគ')
              ->setCellValue('J1', 'Rank')
              ->setCellValue('K1', 'For Month');

        // Fill data rows
        $i = 2; // Starting row after header
        $rank = 1;
        $previousAverage = null;

        foreach ($Class as $row) {
            if ($previousAverage !== null && $row['Average'] != $previousAverage) {
                $rank++;
            }
            $previousAverage = $row['Average'];

            $sheet->setCellValue('A' . $i, $i - 1)
                  ->setCellValue('B' . $i, $row['Stu_code'])
                  ->setCellValue('C' . $i, $row['Student_Name'])
                  ->setCellValue('D' . $i, $row['Gender'])
                  ->setCellValue('E' . $i, $row['Homework'])
                  ->setCellValue('F' . $i, $row['Participation'])
                  ->setCellValue('G' . $i, $row['Attendance'])
                  ->setCellValue('H' . $i, $row['Monthly'])
                  ->setCellValue('I' . $i, $row['Average'])
                  ->setCellValue('J' . $i, $rank)
                  ->setCellValue('K' . $i, $row['for_month']);

            $i++;
        }

        // Set filename and output to download
        $fileName = "student_scores_" . $for_month . ".xlsx";
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}



// Regular data retrieval for displaying on page
if (isset($_GET['classscore']) && isset($_GET['for_month'])) {
$classscore = $_GET['classscore'];
$for_month = $_GET['for_month'];

$query = "SELECT
stu.Kh_name AS Student_Name,
stu.Stu_code,
stu.Gender,
r.Name,
c.Shift,
co.Course_name,
c.Start_class,
c.End_class,
t.Kh_name AS Teacher_Name,
ms.for_month,
ms.Homework,
ms.Participation,
ms.Attendance,
ms.Monthly,
ms.Average
FROM tb_month_score ms
INNER JOIN tb_student stu ON ms.Stu_id = stu.ID
INNER JOIN tb_class c ON ms.Class_id = c.ClassID
INNER JOIN tb_classroom r ON c.room_id = r.id
INNER JOIN tb_course co ON c.course_id = co.id
INNER JOIN tb_teacher t ON c.Teacher_id = t.id
WHERE c.`status` = 'active'
AND Class_id = :classscore
AND ms.for_month = :for_month
ORDER BY ms.Average DESC, ms.for_month";

$stmt = $conn->prepare($query);
$stmt->bindParam(':classscore', $classscore, PDO::PARAM_INT);
$stmt->bindParam(':for_month', $for_month, PDO::PARAM_STR);
$stmt->execute();
$Class = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

include_once "header.php";
?>

<!-- Rest of your HTML form and table code here -->


<style>
@media print {
    footer {
        display: none;
    }

    form {
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
            <i class="fa fa-file-excel "></i> Excel
        </button>
    </form>
</div>

<section class="content-wrapper">
    <div class="row pt-4">
        <div class="col-sm-4">
            <?php if (!empty($Class)) { ?>
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
            <?php } ?>
        </div>
        <div class="col-sm-5">
            <h3 class="text-center">តារាពិន្ទុសិស្សប្រចាំខែ</h3>
        </div>
    </div>
    <form method="GET" action="">
        <div class="row mt-2">
            <div class="col-sm-3 ml-4">
                <label for="for_month">សម្រាប់ខែ </label>
                <select name="for_month" id="for_month" class="form-control form-select" style="font-size:14px;"
                    required>
                    <option selected disabled>-- ជ្រើសរើសខែ --</option>
                    <option value="First Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'First Month') echo 'selected'; ?>>
                        ប្រចាំខែទី១</option>
                    <option value="Second Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Second Month') echo 'selected'; ?>>
                        ប្រចាំខែទី២</option>
                    <option value="Third Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Third Month') echo 'selected'; ?>>
                        ប្រចាំខែទី៣</option>
                    <option value="Fourth Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Fourth Month') echo 'selected'; ?>>
                        ប្រចាំខែទី៤</option>
                    <option value="Fifth Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Fifth Month') echo 'selected'; ?>>
                        ប្រចាំខែទី៥</option>
                    <option value="Sixth Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Sixth Month') echo 'selected'; ?>>
                        ប្រចាំខែទី៦</option>
                    <option value="Seventh Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Seventh Month') echo 'selected'; ?>>
                        ប្រចាំខែទី៧</option>
                    <option value="Eighth Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Eighth Month') echo 'selected'; ?>>
                        ប្រចាំខែទី៨</option>
                    <option value="Ninth Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Ninth Month') echo 'selected'; ?>>
                        ប្រចាំខែទី៩</option>
                    <option value="Tenth Month"
                        <?php if (isset($_GET['for_month']) && $_GET['for_month'] == 'Tenth Month') echo 'selected'; ?>>
                        ប្រចាំខែទី១០</option>
                    <!-- Add more months as needed -->
                </select>

            </div>
            <div class="col-sm-4 ">
                <label for="">&nbsp;</label>
                <div class="ml-3">
                    <input type="hidden" name="classscore" value="<?php echo htmlspecialchars($_GET['classscore']); ?>">
                    <input type="submit" value="បង្ហាញ" name="btnsave" class="btn1 bg-sis text-white">
                </div>
            </div>
        </div>
    </form>




    <hr>
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
                                <th style=" font-size:16px;">កិច្ចការផ្ទះ</th>
                                <th style=" font-size:16px;">ការចូលរួម</th>
                                <th style=" font-size:16px;">វត្តមាន</th>
                                <th style=" font-size:16px;">ប្រចាំខែ</th>
                                <th style=" font-size:16px;">មធ្យមភាគ</th>
                                <th style=" font-size:16px;">Rank</th>
                                <th style=" font-size:16px;">For Month</th>
                                <th style=" font-size:16px;">ផ្សេងៗ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($Class)) {
                                $i=1;
                                $rank = 1; 
                                $previousAverage = null; 
                                foreach ($Class as $row) { 
                                    // Check if this student's average is different from the previous one
                                    if ($previousAverage !== null && $row['Average'] != $previousAverage) {
                                        $rank++; // Increment the rank only if the average is different
                                    }
                                    $previousAverage = $row['Average']; // Update the previous average to the current one
                                ?>
                            <tr>
                                <td><?php echo $i++; ?></td> <!-- Rank -->
                                <td><?php echo htmlspecialchars($row['Stu_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['Student_Name']); ?></td>
                                <td><?php echo htmlspecialchars($row['Gender']); ?></td>
                                <td><?php echo htmlspecialchars($row['Homework']); ?></td>
                                <td><?php echo htmlspecialchars($row['Participation']); ?></td>
                                <td><?php echo htmlspecialchars($row['Attendance']); ?></td>
                                <td><?php echo htmlspecialchars($row['Monthly']); ?></td>
                                <td><?php echo htmlspecialchars($row['Average']); ?></td>
                                <td><?php echo $rank; ?></td> <!-- Display rank -->
                                <td><?php echo htmlspecialchars($row['for_month']); ?></td>
                                <td></td>
                            </tr>
                            <?php }
                            } else { ?>
                            <tr>
                                <td colspan="12" class="text-center">គ្មានទិន្នន័យ</td>
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