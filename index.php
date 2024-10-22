<?php
include "connection.php";

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in as admin

if (!isset($_SESSION['user']) || $_SESSION['user'] == 'admin') {
    header('Location: login_role.php');
    exit;
}

// Fetching the counts dynamically from the database
$student_count = getCount($conn, 'tb_student', 'ID');
$teacher_count = getCount($conn, 'tb_teacher', 'id');
$class_count = getCount($conn, 'tb_class', 'ClassID');
$course_count = getCount($conn, 'tb_course', 'id');

// Function to get count from a table
function getCount($conn, $table, $column) {
    $sql = "SELECT COUNT($column) as count FROM $table";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'];
}
?>

<?php include_once 'header.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">|ទំព័រដើម</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes displaying the counts -->
            <div class="row">
                <!-- Students Count -->
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ចំនួនសិស្សសរុប</span>
                            <span class="info-box-number">
                                <?php echo $student_count; ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Teachers Count -->
                <div class="col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ចំនួនគ្រូបង្រៀនសរុប</span>
                            <span class="info-box-number">
                                <?php echo $teacher_count; ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Classes Count -->
                <div class="col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-warehouse"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ចំនួនថ្នាក់រៀនសរុប</span>
                            <span class="info-box-number">
                                <?php echo $class_count; ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Courses Count -->
                <div class="col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ចំនួនវគ្គសិក្សាសរុប</span>
                            <span class="info-box-number">
                                <?php echo $course_count; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <!-- Calendar -->
                    <div class="card pb-3">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn bg-sis text-white btn-sm dropdown-toggle"
                                        data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn bg-sis text-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-sis text-white btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- </div> -->
                <!-- testcalenda -->

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background-color:#152550; color:white;">
                            <h3 class="card-title">តារាង</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- test -->
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>

<script>
// DONUT CHART - dynamically set data from PHP
var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
var donutData = {
    labels: [
        'ចំនួនសិស្សសរុប',
        'ចំនួនគ្រូបង្រៀនសរុប',
        'ចំនួនថ្នាក់រៀនសរុប',
        'ចំនួនវគ្គសិក្សាសរុប',
    ],
    datasets: [{
        data: [
            <?php echo $student_count; ?>,
            <?php echo $teacher_count; ?>,
            <?php echo $class_count; ?>,
            <?php echo $course_count; ?>
        ],
        backgroundColor: ['#17a2b8', '#dc3545', '#28a745', '#6f42c1'],
    }]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
};

// Create doughnut chart
new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});
</script>

<?php include_once 'footer.php'; ?>