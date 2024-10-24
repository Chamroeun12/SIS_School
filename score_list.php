<?php
include_once 'connection.php';
//start seesion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sql = "SELECT r.Name, t.Kh_name, co.Course_name, c.Shift, c.ClassID FROM tb_class c
		INNER JOIN tb_teacher t ON c.Teacher_id = t.id
		INNER JOIN tb_course co ON c.course_id = co.id
        INNER JOIN tb_classroom r ON c.room_id = r.id
    WHERE c.`status` = 'active' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$score = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include_once "header.php"; ?>
<section class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2 card-header">
            <div class="col-sm-6">
                <h3 class="m-0">|តារាងបញ្ជីលទ្ធផលពិន្ទុតាមថ្នាក់</h3>
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
                                placeholder="ស្វែងរក">
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0 text-sm">
                    <table class="table table-hover text-nowrap" id="userTbl">
                        <thead>
                            <tr>
                                <th style="background-color:#152550; color:white;">ល.រ</th>
                                <th style="background-color:#152550; color:white;">ថ្នាក់</th>
                                <th style="background-color:#152550; color:white;">គ្រូបង្រៀន</th>
                                <th style="background-color:#152550; color:white;">វគ្គសិក្សា</th>
                                <th style="background-color:#152550; color:white;">វេនសិក្សា</th>
                                <th style="background-color:#152550; color:white;">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($score as $row): ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['Name']; ?></td>
                                <td><?php echo $row['Kh_name']; ?></td>
                                <td><?php echo $row['Course_name']; ?></td>
                                <td><?php echo $row['Shift']; ?></td>
                                <td class="">
                                    <form action="" method="">
                                        <a href="class_score.php?classscore=<?php echo $row['ClassID'] ?>"><i
                                                class="fa fa-file-download " style=" font-size: 18px;"></i> ទាញយក
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