<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize variables for selected class, class date, and student info
$selected_class = '';
$class_date = date('Y-m-d');
$students_info = [];
$msg = '';

// Fetch all active classes for the dropdown
$sql = "SELECT * FROM tb_class
        INNER join tb_course ON tb_class.course_id = tb_course.id
        INNER JOIN tb_classroom ON tb_class.room_id = tb_classroom.id
        where tb_class.Status = 'Active'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if a class is selected and a date is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check action type
    if (isset($_POST['action']) && $_POST['action'] == 'show' && isset($_POST['Class_id']) && isset($_POST['class_date'])) {
        $selected_class = $_POST['Class_id'];
        $class_date = $_POST['class_date'];

        // Fetch students based on selected class
        $sql = "SELECT *
                FROM tb_add_to_class
                INNER JOIN tb_student ON tb_add_to_class.Stu_id = tb_student.ID
                INNER JOIN tb_class ON tb_add_to_class.Class_id = tb_class.ClassID
                WHERE tb_class.ClassID = :class_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':class_id', $selected_class, PDO::PARAM_INT);
        $stmt->execute();
        $students_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Handle attendance form submission
    if (isset($_POST['status'])) {
        foreach ($_POST['student_id'] as $index => $student_id) {
            $status = $_POST['status'][$index];

            // Insert or update attendance record
            $sql = "INSERT INTO tb_attendance (Class_ID, Attendance, Stu_ID, Date)
                    VALUES (:class_id, :attendance, :student_id, :class_date)
                    ON DUPLICATE KEY UPDATE Attendance = :attendance";
            $stmt = $conn->prepare($sql);
            try {
                $stmt->execute([
                    'class_id' => $selected_class,
                    'attendance' => $status,
                    'student_id' => $student_id,
                    'class_date' => $class_date
                ]);
            } catch (PDOException $e) {
                $msg = "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</div>";
            }
        }

        $msg = "<div class='alert alert-success'>Attendance saved successfully.</div>";
        // Re-fetch students info to display the attendance status
        $students_info = fetchAttendance($selected_class, $class_date, $conn);
        header('Location: attendace_list.php');
        exit;
    }
}

// Function to fetch attendance information
function fetchAttendance($class_id, $class_date, $conn)
{
    $sql = "SELECT tb_student.ID, tb_student.Kh_name, tb_student.Stu_code, tb_attendance.Attendance
            FROM tb_student
            LEFT JOIN tb_attendance ON tb_student.ID = tb_attendance.Stu_ID AND tb_attendance.Class_ID = :class_id AND tb_attendance.Date = :class_date
            WHERE tb_student.ID IN (SELECT Stu_id FROM tb_add_to_class WHERE Class_id = :class_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
    $stmt->bindParam(':class_date', $class_date);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php include_once "header.php"; ?>

<style>
/* Hide the default radio buttons */
input[type="radio"] {
    display: none;
}

/* Create a custom label to act as the visual representation of the radio button */
input[type="radio"]+label {
    display: inline-block;
    width: 100px;
    height: 30px;
    /*  border: 2px solid #000; */
    /* Adjust the color to match the design */
    position: relative;
    cursor: pointer;
    text-align: center;
    line-height: 25px;
    font-size: 18px;
    margin-left: -20px;
    margin-bottom: -20px;
}

/* Styling for checked radio button (tick mark) */
input[type="radio"]:checked+label:before {
    content: "✔";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: green;
    /* Change color of the tick */
}

/* Styling for table headers */
th {
    background-color: #152550;
    color: white;
}

/* General styling for table cells */
.text-dark-emphasis {
    font-weight: bold;
}
</style>

<section class="content-wrapper">
    <form action="" method="POST">
        <div class="col-sm-6 pt-3 mb-3 ml-3">
            <h3>|បញ្ជីហៅវត្តមានសិស្ស</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div id="msg">
                    <?php if (isset($msg)) echo $msg; ?>
                </div>
                <div class="card mb-3">
                    <div class="card-body rounded-0">
                        <div class="container-fluid">
                            <div class="row align-items-end ">
                                <div class="col-sm-5">
                                    <label for="Class_id" class="form-label">សម្រាប់ថ្នាក់</label>
                                    <select name="Class_id" id="Class_id" class="form-control form-select" required
                                        style="font-size:14px;">
                                        <option value="">--ជ្រើសរើសថ្នាក់--</option>
                                        <?php foreach ($classes as $row) : ?>
                                        <option value="<?= htmlspecialchars($row['ClassID'], ENT_QUOTES, 'UTF-8'); ?>"
                                            <?= ($row['ClassID'] == $selected_class) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8'); ?> -
                                            <?= $row['Course_name']; ?> - <?= $row['Shift']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <label for="class_date" class="form-label">កាលបរិច្ឆេទ</label>
                                    <input type="date" name="class_date" id="class_date" class="form-control" required
                                        style="font-size:14px;"
                                        value="<?= htmlspecialchars($class_date, ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label for="">&nbsp;</label>
                                    <div class="ml-2">
                                        <input type="hidden" name="action" value="show">
                                        <input type="submit" value="បង្ហាញ" name="btnsave"
                                            class="btn1 bg-sis text-white">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card m-3">
                    <div class="card-header rounded-0">
                        <div class="card-title">តារាងបញ្ចូលវត្តមានសិស្ស</div>
                        <div class="d-flex justify-content-end">
                            <button class="btn1 bg-sis text-white mr-2" type="submit">រក្សាទុក</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table id="attendance-tbl" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:5%;">ល.រ</th>
                                            <th class="text-center" style="width:11%;">អត្តលេខ</th>
                                            <th class="text-center " style="width:20%;">ឈ្មោះភាសាខ្មែរ</th>
                                            <th class="text-center" style="width:20%;">ឈ្មោះភាសាអង់គ្លេស</th>
                                            <th class="text-center" style="width:5%;">ភេទ</th>
                                            <th class="text-center" style="width:15%;">ថ្ងៃខែឆ្នាំកំណើត</th>
                                            <th class="text-center text-success" style="width:8%;">វត្តមាន</th>
                                            <th class="text-center text-warning" style="width:8%">សុំច្បាប់</th>
                                            <th class="text-center text-danger" style="width:8%;">អវត្តមាន</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($students_info)): ?>
                                        <?php foreach ($students_info as $index => $student): ?>
                                        <tr class="student-row">
                                            <td class="px-2 py-1 text-center">
                                                <input type="hidden" name="student_id[]"
                                                    value="<?= htmlspecialchars($student['ID'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <?= $index + 1; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars($student['Stu_code'], ENT_QUOTES, 'UTF-8'); ?>
                                            </td>
                                            <td class="text-center ">
                                                <?= htmlspecialchars($student['Kh_name'], ENT_QUOTES, 'UTF-8'); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars($student['En_name'], ENT_QUOTES, 'UTF-8'); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars($student['Gender'], ENT_QUOTES, 'UTF-8'); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars($student['DOB'], ENT_QUOTES, 'UTF-8'); ?>
                                            </td>
                                            <td class="text-center px-2 py-1 text-dark-emphasis">
                                                <div class="form-check justify-content-center">
                                                    <input class="form-check-input status_check" type="radio"
                                                        id="present-<?= $index; ?>" name="status[<?= $index; ?>]"
                                                        value="1"
                                                        <?= (isset($student['Attendance']) && $student['Attendance'] == 1) ? 'checked' : ''; ?>>
                                                    <label for="present-<?= $index; ?>"></label>
                                                </div>
                                            </td>
                                            <td class="text-center px-2 py-1 text-dark-emphasis ">
                                                <div class="form-check justify-content-center">
                                                    <input class="form-check-input status_check " type="radio"
                                                        id="permission-<?= $index; ?>" name="status[<?= $index; ?>]"
                                                        value="2"
                                                        <?= (isset($student['Attendance']) && $student['Attendance'] == 2) ? 'checked' : ''; ?>>
                                                    <label for="permission-<?= $index; ?>"></label>
                                                </div>
                                            </td>
                                            <td class="text-center px-2 py-1 text-dark-emphasis">
                                                <div class="form-check justify-content-center">
                                                    <input class="form-check-input status_check" type="radio"
                                                        id="absent-<?= $index; ?>" name="status[<?= $index; ?>]"
                                                        value="3"
                                                        <?= (isset($student['Attendance']) && $student['Attendance'] == 3) ? 'checked' : ''; ?>>
                                                    <label for="absent-<?= $index; ?>"></label>
                                                </div>
                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">គ្មា​នទិន្ន័យ</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
</section>

<?php include_once "footer.php"; ?>