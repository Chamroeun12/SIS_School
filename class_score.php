<?php
include_once 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if(isset($_GET['classscore'])){
    $classscore = $_GET['classscore'];
    // echo $classname;
    $query = "SELECT 
    stu.Kh_name AS Student_Name, 
    stu.Stu_code,
    stu.Gender,
    r.Name,
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
		INNER JOIN tb_teacher t ON c.Teacher_id = t.id WHERE c.`status` = 'active' AND Class_id =:classscore";
$stmt = $conn->prepare($query);
$stmt->bindParam(':classscore', $classscore, PDO::PARAM_INT);
$stmt->execute();
$Class = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


include_once "header.php";
?>

<style>
@media print {

    /* Hide footer */
    footer {
        display: none;
    }

    /* Ensure table borders and background colors are printed */
    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black !important;
        /* Set borders to black */
        color: black !important;
        /* Set text color to black */
    }

    /* Set specific table header background */
    thead {
        background-color: darkblue !important;
        /* Ensure background is printed */
    }

    /* Adjust padding for better print layout */
    th,
    td {
        padding: 10px;
    }

    /* Hide any unnecessary buttons or elements */
    .btn1,
    .card-title {
        display: none;
    }
}

/* Optional: Add color back to the web page (non-print view) */
table th {
    background-color: #000;
    /* You can use this to maintain original design */
}
</style>

<div class="">
    <h3 class="card-title float-sm-right pr-4 pt-4">
        <button type="button" class="btn1 bg-sis text-white" onclick="window.print()"><i class="fa fa-print"></i>
            ទាញយក</button>
    </h3>
</div>


<section class="content-wrapper">
    <div class="row pt-4">
        <div class="col-sm-4"> <?php if (!empty($Class)) { ?>
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
        <div class="col-sm-4">
            <h3 class="text-center">តារាពិន្ទុសិស្សប្រចាំខែ</h3>
        </div>
    </div>

    <hr>
    <div class="row m-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0 text-sm">
                    <table class="table-bordered table-hover table" id="userTbl">
                        <thead class=" table-secondary">
                            <tr class="">
                                <th style=" font-size:16px;">ល.រ</th>
                                <th style=" font-size:16px;">អត្តលេខ</th>
                                <th style=" font-size:16px;">ឈ្មោះ</th>
                                <th style=" font-size:16px;">ភេទ</th>
                                <th style=" font-size:16px;">កិច្ចការផ្ទះ</th>
                                <th style=" font-size:16px; ">ការចូលរួម</th>
                                <th style=" font-size:16px;">វត្តមាន</th>
                                <th style=" font-size:16px;">ប្រចាំខែ</th>
                                <th style=" font-size:16px;">មធ្យមភាគ</th>
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