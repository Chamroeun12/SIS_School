<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize variables
$selected_class = '';
$class_date = date('Y-m-d');
$students_info = [];
$msg = '';

// Fetch all active classes for the dropdown
$sql = "SELECT * FROM tb_class
        INNER JOIN tb_course ON tb_class.course_id = tb_course.id
        INNER JOIN tb_classroom ON tb_class.room_id = tb_classroom.id
        WHERE tb_class.Status = 'Active'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$toastr_script = ''; // To hold toastr notifications

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['classid'] ?? null;
    $start_date = $_POST['sch_start'] ?? null;
    $end_date = $_POST['sch_end'] ?? null;
    $schedule_items = $_POST['item'] ?? [];

    $errors = [];

    // Validate inputs
    if (empty($class_id)) {
        $errors[] = "Class ID is required.";
    }
    if (empty($start_date)) {
        $errors[] = "Start Date is required.";
    }
    if (empty($end_date)) {
        $errors[] = "End Date is required.";
    }
    if (empty($schedule_items)) {
        $errors[] = "At least one schedule item is required.";
    }

    // If no errors, process the form
    if (empty($errors)) {
        try {
            // Start transaction
            $conn->beginTransaction();

            // Process each schedule item
            for ($i = 0; $i < count($schedule_items); $i += 7) {
                $start_time = $schedule_items[$i] ?? null;
                $end_time = $schedule_items[$i + 1] ?? null;
                $monday = $schedule_items[$i + 2] ?? null;
                $tuesday = $schedule_items[$i + 3] ?? null;
                $wednesday = $schedule_items[$i + 4] ?? null;
                $thursday = $schedule_items[$i + 5] ?? null;
                $friday = $schedule_items[$i + 6] ?? null;

                if ($start_time && $end_time) {
                    $sql = "INSERT INTO tb_sch_student (Class_id, Start_class, End_class, Time_in, Time_out, Monday, Tuesday, Wednesday, Thursday, Friday)
                            VALUES (:classid, :start_date, :end_date, :start_time, :end_time, :monday, :tuesday, :wednesday, :thursday, :friday)";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':classid' => $class_id,
                        ':start_date' => $start_date,
                        ':end_date' => $end_date,
                        ':start_time' => $start_time,
                        ':end_time' => $end_time,
                        ':monday' => $monday,
                        ':tuesday' => $tuesday,
                        ':wednesday' => $wednesday,
                        ':thursday' => $thursday,
                        ':friday' => $friday
                    ]);
                }
            }

            // Commit transaction
            $conn->commit();
            $toastr_script = "<script>toastr.success('Schedule added successfully!');</script>";
        } catch (Exception $e) {
            $conn->rollBack();
            $errors[] = "Failed to add schedule: " . $e->getMessage();
            $toastr_script = "<script>toastr.error('Failed to add schedule. Please try again.');</script>";
        }
    } else {
        $toastr_script = "<script>toastr.error('Please correct the errors.');</script>";
    }
}
?>
<?php include_once "header.php"; ?>

<section class="content-wrapper">
    <form action="" method="POST">
        <div class="col-sm-6 pt-3 mb-3 ml-3">
            <h3>|តារាងបញ្ចូលកាលវិភាគ</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div id="msg">
                    <?php if (isset($msg)) echo $msg; ?>
                </div>
                <div class="card mb-3">
                    <div class="card-body rounded-0">
                        <div class="container-fluid">
                            <div class="row align-items-end">
                                <div class="col-sm-4">
                                    <label for="Class_id" class="form-label">សម្រាប់ថ្នាក់:</label>
                                    <select name="classid" id="Class_id" class="form-control form-select"
                                        style="font-size:14px;">
                                        <option value="">--ជ្រើសរើសថ្នាក់--</option>
                                        <?php foreach ($classes as $row) : ?>
                                        <option value="<?= $row['ClassID']; ?>"><?= $row['Name']; ?> -
                                            <?= $row['Course_name']; ?> - <?= $row['Shift']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="sch_start" class="form-label">ឆ្នាំសិក្សាចាប់ផ្តើម:</label>
                                    <input type="date" name="sch_start" id="sch_start" class="form-control"
                                        style="font-size:14px;" value="">
                                </div>
                                <div class="col-sm-4">
                                    <label for="sch_end" class="form-label">ឆ្នាំសិក្សាបញ្ចប់:</label>
                                    <input type="date" name="sch_end" id="sch_end" class="form-control"
                                        style="font-size:14px;" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div id="itemContainer" class="p-2">
                <div class="row input-group ml-2">
                    <div class="form-group mb-2 col-md-6">
                        <label for="" class="form-label">ម៉ោងចូល:</label>
                        <input type="time" class="form-control" name="item[]" placeholder="Start Time">
                    </div>
                    <div class="form-group mb-2 col-md-6">
                        <label for="" class="form-label">ម៉ោងចេញ:</label>
                        <input type="time" class="form-control" name="item[]" placeholder="End Time">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃច័ន្ទ:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Monday">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃអង្គារ:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Tuesday">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃពុធ:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Wednesday">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃព្រហស្បត្ត៍:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Thursday">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃសុក្រ:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Friday">
                    </div>
                    <div class="form-group-append col-md-2 mt-4">
                        <button class="btn btn-danger removeItem" type="button"><i
                                class="fas fa-minus-square"></i></button>
                    </div>
                </div>
            </div>

            <div class="row ml-2">
                <div class="col-md-2 ml-2 mb-1">
                    <button type="button" class="btn btn-success" id="addItem">ថែមថ្មី</button>
                </div>
                <div class="col-md-7"></div>
                <div class="col-md-2 ml-5 mb-1">
                    <input type="submit" name="submit" class="btn1 bg-sis text-white" value="រក្សាទុក">
                </div>
            </div>
        </div>
    </form>

    <!-- jQuery to handle dynamic field addition -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        // Add new input fields
        $('#addItem').click(function() {
            $('#itemContainer').append(`
            <div class="row input-group ml-2">
                    <div class="form-group mb-2 col-md-6">
                        <label for="" class="form-label">ម៉ោងចូល:</label>
                        <input type="time" class="form-control" name="item[]" placeholder="Start Time">
                    </div>
                    <div class="form-group mb-2 col-md-6">
                        <label for="" class="form-label">ម៉ោងចេញ:</label>
                        <input type="time" class="form-control" name="item[]" placeholder="End Time">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃច័ន្ទ:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Monday">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃអង្គារ:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Tuesday">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃពុធ:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Wednesday">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃព្រហស្បត្ត៍:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Thursday">
                    </div>
                    <div class="form-group mb-2 col-md-2">
                        <label for="" class="form-label">ថ្ងៃសុក្រ:</label>
                        <input type="text" class="form-control" name="item[]" placeholder="Friday">
                    </div>
                    <div class="form-group-append col-md-2 mt-4">
                        <button class="btn btn-danger removeItem" type="button"><i
                                class="fas fa-minus-square"></i></button>
                    </div>
                </div>`);
        });

        // Remove input fields
        $(document).on('click', '.removeItem', function() {
            $(this).closest('.row').remove();
        });
    });
    </script>

    <!-- Toastr notifications -->
    <?= $toastr_script; ?>
</section>

<?php include_once "footer.php"; ?>