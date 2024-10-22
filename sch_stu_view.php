<?php
include_once 'connection.php';
//start seesion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//get class id
// $classid = $_GET['classid']; 

if (isset($_POST['classid'])) {
    $classid = $_POST['classid'];
    $sql = "SELECT sch.Start_class, sch.End_class, sch.Time_in, 
                    sch.Time_out,sch.Monday, sch.Tuesday, sch.Wednesday, sch.Thursday, sch.Friday
        FROM tb_sch_student sch
		INNER JOIN tb_class c ON sch.Class_id = c.ClassID WHERE Class_id = $classid";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sch = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$sql = "SELECT * FROM tb_class
INNER join
    tb_course ON tb_class.course_id = tb_course.id
    INNER jOIN tb_classroom ON tb_class.room_id = tb_classroom.id
where tb_class.Status = 'Active'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$class = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<?php include_once "header.php"; ?>
<section class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2 card-header">
            <div class="col-sm-6">
                <h3 class="m-0">|តារាងបង្ហាញកាលវិភាគ</h3>
            </div>
        </div>
    </div>

    <form action="" method="post">
        <div class="form-group m-2 card p-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="classid" class="form-control form-select">
                        <option selected disabled>--ជ្រើសរើសថ្នាក់--</option>
                        <?php foreach ($class as $row) : ?>
                        <option value="<?= $row['ClassID']; ?>"><?= $row['Name']; ?> -
                            <?= $row['Course_name']; ?> - <?= $row['Shift']; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn1 bg-sis text-white" name="save" id="save" value="បង្ហាញ"
                        class="form-control">
                </div>
            </div>
        </div>
    </form>

    <!-- /.row -->

    <div class="row m-2">
        <!-- <div class="form-group" style="width: 300px;">
                            <input type="text" id="" name="namesearch" class="search form-control float-right"
                                placeholder="ស្វែងរក" ">
                            <div class="input-group-append">
                            </div>
                        </div> -->
        <!-- /.card-header -->

        <div class="card-body table-responsive p-0 text-sm mt-1">
            <table class="table table-hover table-bordered text-nowrap text-center" "
                id=" userTbl">
                <thead>
                    <tr>
                        <th style="width: 10%; background-color: #152550; color:white; font-size:medium;">
                            ម៉ោងសិក្សា
                        </th>
                        <th style="width: 15%; background-color: #152550; color:white; font-size:medium;">
                            ច័ន្ទ
                        </th>
                        <th style="width: 15%; background-color: #152550; color:white; font-size:medium;">
                            អង្គារ
                        </th>
                        <th style="width: 15%; background-color: #152550; color:white; font-size:medium;">
                            ពុធ
                        </th>
                        <th style="width: 15%; background-color: #152550; color:white; font-size:medium;">
                            ព្រហស្បត្តិ៍
                        </th>
                        <th style="width: 15%; background-color: #152550; color:white; font-size:medium;">
                            សុក្រ
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($sch)) { ?>
                    <?php $i = 1;
                        foreach ($sch as $row): ?>
                    <tr style="height: 60px;">
                        <td class="table-info align-middle">
                            <?php echo date('h:i', strtotime($row['Time_in'])); ?> -
                            <?php echo date('h:i A', strtotime($row['Time_out'])); ?>
                        </td>
                        <!-- <td><?php echo $row['Time_in']; ?>:<?php echo $row['Time_out']; ?></td> -->
                        <td class="align-middle">
                            <div class="day">
                                <?php echo $row['Monday']; ?>
                            </div>
                        </td>
                        <td class="align-middle"><?php echo $row['Tuesday']; ?></td>
                        <td class="align-middle"><?php echo $row['Wednesday']; ?></td>
                        <td class="align-middle"><?php echo $row['Thursday']; ?></td>
                        <td class="align-middle"><?php echo $row['Friday']; ?></td>
                        <td class="align-middle">
                            <!-- <form action="report_sch.php" method="POST">
                                        <button type="submit" name="export_pdf" title="PDF"
                                            style="border:none; background: transparent; padding:0px;"><i
                                                class="fa fa-file-pdf text-danger ml-1" style=" font-size: 18px;"></i>
                                            <input type="hidden" name="classname" value="<?= $row['Class_name']; ?>">
                                        </button>
                                        <button type="submit" name="export_excel" title="Excel"
                                            style="border:none; background: transparent; padding:0px;"><i
                                                class="fa fa-file-excel text-success ml-2"
                                                style=" font-size: 18px;"></i></button>


                                    </form> -->
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php } else {
                        echo '<tr><td colspan="7" style="text-align:center;" class="text-danger"><p>គ្មានទិន្នន័យ</p></td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card -->
    </div>

    <!-- /.row -->
</section>
</div>
<?php include_once "footer.php"; ?>