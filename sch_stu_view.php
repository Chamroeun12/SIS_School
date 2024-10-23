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
    <div class="container-fluid no-print">
        <div class="row mb-2 card-header">
            <div class="col-sm-6">
                <h3 class="m-0">|តារាងបង្ហាញកាលវិភាគ</h3>
            </div>
        </div>
    </div>

    <div class="print-only text-center mt-4">
        <h3>កាលវិភាគប្រចាំសប្តាហ៍</h3>
        <!-- <h5>Morning Scedule</h5> -->
    </div>
    <form action="" method="post">
        <div class="form-group m-2 card p-4 no-print">
            <div class="row">
                <div class="col-md-4">
                    <select name="classid" class="form-control form-select">
                        <option selected disabled>--ជ្រើសរើសថ្នាក់--</option>
                        <?php foreach ($class as $row) : ?>
<<<<<<< HEAD
                        <option value="<?= htmlspecialchars($row['ClassID']); ?>"
                            <?php if (isset($_GET['classid']) && $_GET['classid'] == $row['ClassID']) echo 'selected'; ?>>
                            <?= htmlspecialchars($row['Name']); ?> - <?= htmlspecialchars($row['Course_name']); ?> -
                            <?= htmlspecialchars($row['Shift']); ?>
=======
                        <option value="<?= $row['ClassID']; ?>"
                            <?= (isset($_POST['classid']) && $_POST['classid'] == $row['ClassID']) ? 'selected' : ''; ?>>
                            <?= $row['Name']; ?> - <?= $row['Course_name']; ?> - <?= $row['Shift']; ?>
>>>>>>> 140112f696779de527c4c43b63c99be6d38820b7
                        </option>
                        <?php endforeach; ?>
                    </select>

<<<<<<< HEAD

=======
>>>>>>> 140112f696779de527c4c43b63c99be6d38820b7
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn1 bg-sis text-white" name="save" id="save" value="បង្ហាញ"
                        class="form-control">
                    <div class="float-right mr-3">
                        <!-- Print button (not to be printed) -->
                        <button class="no-print btn1 bg-sis text-white" onclick="printPage()"><i
                                class="fas fa-print"></i> ទាញយក</button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!-- /.row -->
    <hr>
    <div class="row m-2">

        <div class="card-body table-responsive p-0 text-sm mt-1">
            <table class="table table-hover table-bordered text-nowrap text-center" "
                id=" userTbl">
                <thead>
                    <tr class="on-print table-secondary" style="font-size:16px;">
                        <th style="width:18%">
                            ម៉ោងសិក្សា
                        </th>
                        <th>
                            ច័ន្ទ
                        </th>
                        <th>
                            អង្គារ
                        </th>
                        <th>
                            ពុធ
                        </th>
                        <th>
                            ព្រហស្បត្តិ៍
                        </th>
                        <th>
                            សុក្រ
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($sch)) { ?>
                    <?php $i = 1;
                        foreach ($sch as $row): ?>
                    <tr style="height: 60px;">
                        <td class="align-middle">
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

    <div class="print-only ml-2">
        <div>
            <tr>
                ចំណាំ:
            </tr>
        </div>
        <div>
            <tr style="font-size:12px;">
                *This schedule can be changed or added and updated at anytime if necsessary.
            </tr>
        </div>
        <div>
            <tr style="font-size:12px;">
                *Please contact the school administration for any questions or concerns.
            </tr>
        </div>





    </div>
</section>
</div>

<script>
function printPage() {
    window.print();
}
</script>
<?php include_once "footer.php"; ?>