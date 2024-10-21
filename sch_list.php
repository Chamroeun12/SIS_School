<?php
include_once 'connection.php';
//start seesion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sql = "SELECT sch.sch_id,r.Name, t.Kh_name, c.Shift, co.Course_Name, sch.Start_class, sch.End_class, sch.Time_in, sch.Time_out,t.`status`,c.`status`
        FROM tb_sch_student sch
		INNER JOIN tb_class c ON sch.Class_id = c.ClassID
        INNER JOIN tb_course co ON c.course_id = co.id
        INNER JOIN tb_classroom r ON c.room_id = r.id
		INNER JOIN tb_teacher t ON sch.teacher_id = t.id ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sch = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include_once "header.php"; ?>
<section class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2 card-header">
            <div class="col-sm-6">
                <h3 class="m-0">|តារាងបញ្ជីពិន្ទុ</h3>
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
                                <!-- <th>គ្រូបង្រៀន</th> -->
                                <th style="background-color:#152550; color:white;">ម៉ោងចូល</th>
                                <th style="background-color:#152550; color:white;">ម៉ោងចេញ</th>
                                <th style="background-color:#152550; color:white;">បន្ទប់សិក្សា</th>
                                <th style="background-color:#152550; color:white;">កម្រិតសិក្សា</th>
                                <th style="background-color:#152550; color:white;">វេនសិក្សា</th>
                                <th style="background-color:#152550; color:white;">កាលបរិច្ឆេទចាប់់ផ្តើម</th>
                                <th style="background-color:#152550; color:white;">កាលបរិច្ឆេទបញ្ចប់</th>
                                <th style="background-color:#152550; color:white;">ទាញយក</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($sch as $row): ?>
                            <tr>
                                <td><?php echo $i++ ?></td>

                                <td><?php echo date('h:i A', strtotime($row['Time_in'])); ?></td>
                                <td><?php echo date('h:i A', strtotime($row['Time_out'])); ?></td>
                                <td><?php echo $row['Name']; ?></td>
                                <td><?php echo $row['Course_Name']; ?></td>
                                <td><?php echo $row['Shift']; ?></td>
                                <td><?php echo $row['Start_class']; ?></td>
                                <td><?php echo $row['End_class']; ?></td>

                                <td>
                                    <form action="report_sch_student.php" method="POST">
                                        <button type="submit" name="export_pdf" title="PDF"
                                            style="border:none; background: transparent; padding:0px;"><i
                                                class="fa fa-file-pdf text-danger ml-1" style=" font-size: 18px;"></i>
                                            <input type="hidden" name="classname" value="<?= $row['Name']; ?>">
                                        </button>
                                        <button type="submit" name="export_excel" title="Excel"
                                            style="border:none; background: transparent; padding:0px;"><i
                                                class="fa fa-file-excel text-success ml-2"
                                                style=" font-size: 18px;"></i></button>
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