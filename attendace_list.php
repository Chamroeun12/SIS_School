<?php
include_once 'connection.php';
//start seesion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sql = "SELECT
    r.Name,
    co.Course_name,
    t.Kh_name,
    att.Date,
    c.ClassID
FROM
    tb_attendance att
INNER JOIN
    tb_class c ON att.Class_id = c.ClassID
INNER JOIN
    tb_course co ON c.course_id = co.id
INNER JOIN
    tb_teacher t ON c.Teacher_id = t.id
INNER JOIN tb_classroom r ON c.room_id = r.id
GROUP BY
    r.Name,
    co.Course_name,
    t.En_name,
    att.Date
ORDER BY
    att.Date;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include_once "header.php"; ?>
<section class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2 card-header">
            <div class="col-sm-6">
                <h3 class="m-0">|តារាងវត្តមានប្រចាំថ្ងៃតាមថ្នាក់</h3>
            </div>
            <!-- /.col -->
            <div class="col-sm-6"> </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row m-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="form-group" style="width: 300px;">
                            <input type="text" id="" name="namesearch" class="search form-control float-right"
                                placeholder="ស្វែងរក" style="font-family:Khmer OS Siemreap;">
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0 text-sm">
                    <table class="table table-hover text-nowrap" style="font-family:Khmer OS Siemreap;" id="userTbl">
                        <thead>
                            <tr>
                                <th style="background-color:#152550; color:white;">ល.រ</th>
                                <th style="background-color:#152550; color:white;">ថ្នាក់</th>
                                <th style="background-color:#152550; color:white;">វគ្គសិក្សា</th>
                                <th style="background-color:#152550; color:white;">គ្រូបង្រៀន</th>
                                <th style="background-color:#152550; color:white;">កាលបរិច្ឆេទ</th>
                                <th style="background-color:#152550; color:white;">ទាញយក</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($attendance as $row): ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['Name']; ?></td>
                                <td><?php echo $row['Course_name']; ?></td>
                                <td><?php echo $row['Kh_name']; ?></td>
                                <td>
                                    <?php
                                        // Create a DateTime object from the string
                                        $date = new DateTime($row['Date']);
                                        // Format the date to "15-Sep-2024 at 10 am"
                                        echo $date->format('d-M-Y');
                                        ?>
                                </td>
                                <td>
                                    <form action="" method="">
                                        <a href="class_att.php?classatt=<?php echo $row['ClassID'] ?>">
                                            <i class="fa fa-file-download " style=" font-size: 18px;"></i> ទាញយក
                                        </a>


                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</section>
</div>
<?php include_once "footer.php"; ?>