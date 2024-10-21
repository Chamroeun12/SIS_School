<?php
include_once 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['btnsave'])) {
    $sql = "INSERT INTO tb_classroom(Name,status) VALUES(:Name,:status)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":Name", $_POST['Name'], PDO::PARAM_STR);
    $stmt->bindParam(":status", $_POST['status'], PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount()) {
        echo "<script>window.history.back();</script>";
    }
}

// Initialize variables
$status = '';
$search = '';

// Check if filtering by status or search
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
    }
    if (isset($_GET['search'])) {
        $search = $_GET["search"];
    }
}

// Build the SQL query
$sql = "SELECT * FROM tb_classroom";
if ($status) {
    $sql .= " WHERE tb_classroom.status = :status";
}
$sql .= " ORDER BY Name ASC";
$stmt = $conn->prepare($sql);
if ($status) {
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
}
$stmt->execute();
$classroom = $stmt->fetchAll(PDO::FETCH_ASSOC);


//pages
$sql  = "SELECT COUNT(*) AS CountRecords FROM tb_classroom LIMIT 8";
$stmt = $conn->prepare($sql);
$stmt->execute();
$temp = $stmt->fetch(PDO::FETCH_ASSOC);

$maxpage = 1;
if ($temp) {
    $maxpage = ceil($temp['CountRecords'] / 8);
}
?>
<?php include_once 'header.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">|បន្ទប់សិក្សា</h3>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <a href="add_subject.php" class="btn1 bg-sis text-white float-sm-right" data-toggle="modal"
                        data-target="#modal-lg"><i class="fas fa-plus iconz"></i> បញ្ចូលថ្មី</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#152550; color:white;">
                        <h3 class="card-title">|បញ្ចូលបន្ទប់ថ្មី</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Condition to Add or Edit student -->

                    <!-- form add and edit student -->
                    <form name="subjectForm" method="post" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="inputName">បន្ទប់សិក្សា</label>
                                        <input type="text" id="" name="Name" class="form-control" value="">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">ស្ថានភាព</label>
                                            <select name="status" class="form-control">
                                                <option value="active">Active</option>
                                                <option value="disable">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">បោះបង់</button>
                            <input type="submit" value="រក្សាទុក" name="btnsave" class="btn1 bg-sis text-white">
                            <!-- <button type="button" class="btn btn-primary">Save</button> -->
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>

    <!-- Main content -->
    <!-- <section class="content">
        <div class="container-fluid">
            <div class="row"> -->
    <div class="row m-2">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header p-0">

                    <div class="card-tools mt-3 mr-3">
                        <div class="form-group" style="width: 300px;">
                            <input type="text" id="" name="namesearch" class="search form-control float-right"
                                placeholder="ស្វែងរក">
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET"
                        style="float: right; margin-right: 10px;" class="mt-3">
                        <input type="hidden" name="search"
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <select name="status" onchange="this.form.submit()" class="form-select custom-select"
                            style="width: 250px;">
                            <option value="" <?php echo ($status == '') ? 'selected' : ''; ?>>ទាំងអស់</option>
                            <option value="active" <?php echo ($status === 'active') ? 'selected' : ''; ?>>
                                Active
                            </option>
                            <option value="disable" <?php echo ($status === 'disable') ? 'selected' : ''; ?>>
                                Disable
                            </option>
                        </select>
                    </form>

                    <div class="card-body p-0">
                        <table class="table table-hover text-nowrap" id="userTbl">
                            <thead>
                                <tr>
                                    <th style="background-color:#152550; color:white;">ល.រ</th>
                                    <th style="background-color:#152550; color:white;">បន្ទប់សិក្សា</th>
                                    <th style="background-color:#152550; color:white;">ស្ថានភាព</th>
                                    <th style="background-color:#152550; color:white;">សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($classroom as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $value['Name']; ?></td>
                                    <td>
                                        <?php if ($value['status'] == 'active') { ?>
                                        <span class="badge badge-success">Active</span>
                                        <?php } else { ?>
                                        <span class="badge badge-danger">Disable</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="update_room.php?room_id=<?php echo $value['id'] ?>">
                                            <i class="fa fa-edit text-success"></i>
                                        </a>
                                        <a class="m-2" href="all_condition.php?room_id=<?php echo $value['id'] ?>"
                                            onclick="return confirm('Do you want to delete this record?')">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>


                    <div class="card-footer">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <!-- Previous link -->
                            <li class="page-item">
                                <a class="page-link"
                                    href="tbl_classroom.php?page=<?php echo isset($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] - 1 : 1; ?>">&laquo;</a>
                            </li>

                            <!-- Page links -->
                            <?php for ($i = 1; $i <= $maxpage; $i++): ?>
                            <li
                                class="page-item <?php echo isset($_GET['page']) && $_GET['page'] == $i ? 'active' : ''; ?>">
                                <a class="page-link"
                                    href="tbl_classroom.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php endfor; ?>

                            <!-- Next link -->
                            <li class="page-item">
                                <a class="page-link"
                                    href="tbl_classroom.php?page=<?php echo isset($_GET['page']) && $_GET['page'] < $maxpage ? $_GET['page'] + 1 : $maxpage; ?>">&raquo;</a>
                            </li>
                        </ul>
                    </div>

                    <!-- /.card -->
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->


<?php include_once 'footer.php'; ?>