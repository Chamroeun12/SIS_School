<?php
include_once 'connection.php';
//start seesion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Build the SQL query

$sql = "SELECT * FROM tb_teacher"; 
$sql .= " ORDER BY En_name ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once "header.php"; ?>
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
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
            <h3 class="text-center">បញ្ជីឈ្មោះគ្រូបង្រៀន</h3>
        </div>
    </div>

    <hr>
    <!-- /.row -->
    <div class="row m-2">
        <div class="col-12">
            <div class="card">

                <div class="card-body table-responsive p-0 text-sm">
                    <table class="table-bordered table-hover table" id="userTbl">
                        <thead class=" table-secondary">
                            <tr>
                                <th style="font-size:16px;">ល.រ</th>
                                <th style="font-size:16px;">រូបភាព</th>
                                <th style="font-size:16px;">អត្តលេខ</th>
                                <th style="font-size:16px;">ឈ្មោះភាសាអង់គ្លេស</th>
                                <th style="font-size:16px;">ឈ្មោះភាសាខ្មែរ</th>
                                <th style="font-size:16px;">ភេទ</th>
                                <th style="font-size:16px;">ថ្ងៃខែ​ឆ្នាំកំណើត</th>
                                <th style="font-size:16px;">អាសយដ្ឋាន</th>
                                <th style="font-size:16px;">លេខទូរស័ព្ទ</th>
                                <th style="font-size:16px;">ផ្សេងៗ</th>
                            </tr>
                        </thead>
                        <tbody id="showdata">
                            <?php foreach ($data as $key => $value) { ?>
                            <t>
                                <td><?php
                                        if (isset($_GET['page']) && $_GET['page'] > 1)
                                            echo ($_GET['page'] - 1) * 10 + ($key + 1);
                                        else
                                            echo ($key + 1);
                                        ?></td>
                                <td>
                                    <div class="user-panel p-0">
                                        <div class="image p-0">
                                            <img onerror="this.style.display = 'none'" class="img-circle p-0"
                                                src="images/<?= $value['Profile_img']; ?>"
                                                style="width: 35px; height: 35px; object-fit:cover;" />
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $value['Staff_code']; ?></td>
                                <td><?php echo $value['En_name']; ?></td>
                                <td><?php echo $value['Kh_name']; ?></td>
                                <td><?php echo $value['Gender']; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($value['DOB'])); ?></td>
                                <td><?php echo $value['Address']; ?></td>
                                <td><?php echo $value['Phone']; ?></td>
                                <td></td>
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    </div>
    <!-- /.row -->
</section>
</div>

<script>
function preview(evt) {
    let img = document.getElementById('img');
    img.src = URL.createObjectURL(evt.target.files[0]);
}
</script>

<?php include_once "footer.php"; ?>