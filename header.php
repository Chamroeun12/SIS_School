<?php
include 'connection.php';
// Get the URI and split it into segments
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Refresh the page after 30 seconds -->
<!-- <meta http-equiv="refresh" content="30"> -->
    <title>SmartBright International School</title>
    <link rel="icon" href="images/SiSlogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="fonts.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/activemenu.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Get cookie -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <style>
        aside a p {
            color: #fff;
        }

        aside a i {
            color: #fff;
        }

        .stu-list {
            color: #152550;
        }

        .btnhover1:hover {
            background: #5b6684;
            color: #fff;
        }

        .btnhover1:active {
            background: #5b6684;
            color: #fff;
        }

        .bimg {
            border-top: 1px solid #5b6684;
            border-bottom: 1px solid #5b6684;
        }

        .bg-sis {
            background-color: #152550;
        }

        .btn1 {
            padding: 6px 10px;
            border-radius: 5px;
        }

        .bg-sis {
            background-color: #152550;
        }
    </style>

    <style>
        @media print {
            .on-prit {
                color: black;
                background-color: white;
            }

            .no-print {
                display: none !important;
            }

            @page {
                size: A4 landscape;
            }

            .print-only {
                display: block !important;
            }
        }

        .print-only {
            display: none;
        }

        .no-print {
            display: block;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="">
            <img class="animation__shake" src="images/SiSlogo.png" height="100">
            <div class="font-weight-light">ស្មាតប្រាយ អ៊ិនធើណាសិនណលស្គូល</div>
            <div class="font-weight-light">SmartBright International School</div>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
                            style="font-size:23px;"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- <li class="mr-2" data-toggle="dropdown">
                    <img src=dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" width="40" height="40">
                    <span class="name_user text-dark"><?php echo $_SESSION["user"]; ?></span>
                    <div class="position-relative">
                        <div class="dropdown-menu droppdown-menu-right mt-2">
                            <a href="#" class="dropdown-item text-dark">Profile</a>
                            <a href="logout.php" class="dropdown-item text-dark">Logout</a>
                        </div>
                    </div>
                </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar" style="background-color: #152550; color: #fff;">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="images/SiSlogo.png" class="brand-image" width="">
                <!-- <span class="brand-text font-weight-light">Management System</span> -->
                <span class="brand-text text-white" style=" font-size:13px;">
                    ស្មាតប្រាយ អ៊ិនធើណាសិនណលស្គូល
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mb-3 d-flex bimg pt-2 pb-2">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-white">
                            <!-- <?= $_SESSION["user"]; ?> -->
                            <?php echo $_SESSION["user"] ?>
                        </a>
                    </div>
                </div>
                <!-- Sidebar Menu -->

                <nav class="mt-1">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item ">
                                <a href="index.php"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'index.php') echo 'active'; ?>||<?php if (isset($uriSegments[2]) && $uriSegments[2] == './') echo 'active'; ?></a>">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        ទំព័រដើម
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="student_list.php"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'student_list.php') echo 'active'; ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        ព័ត៌មានផ្ទាល់ខ្លួនសិស្ស
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="teacher_list.php"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'teacher_list.php') echo 'active'; ?>">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>
                                        ព័ត៌មានគ្រូបង្រៀន
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="subject.php"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'subject.php') echo 'active'; ?>">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>
                                        មុខវិជ្ជាសិក្សា
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="tbl_course.php"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'tbl_course.php') echo 'active'; ?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        កម្រិតសិក្សា
                                    </p>
                                </a>
                            </li>

                            <li
                                class="nav-item <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'room.php') echo 'menu-open'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'classroom.php') echo 'menu-open'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'class.php') echo 'menu-open'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'Student_in_class.php') echo 'menu-open'; ?>">
                                <a href="#"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'room.php') echo 'active'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'classroom.php') echo 'active'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'class.php') echo 'active'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'Student_in_class.php') echo 'active'; ?>">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>
                                        ថ្នាក់រៀន
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview ">
                                    <li class=" nav-item ">
                                        <a href=" room.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'room.php') echo 'active'; ?>">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                បញ្ជីបន្ទប់សិក្សា
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview ">
                                    <li class="nav-item">
                                        <a href="classroom.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'classroom.php') echo 'active'; ?>">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                បញ្ជីថ្នាក់រៀន
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="class.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'class.php') echo 'active'; ?>">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                បញ្ចូលសិស្សទៅក្នុងថ្នាក់
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview ">
                                    <li class="nav-item">
                                        <a href="Student_in_class.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'Student_in_class.php') echo 'active'; ?>">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                សិស្សក្នុងថ្នាក់រៀន
                                            </p>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                        <?php endif; ?>
                        <!-- close  -->

                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item">
                                <a href="score_list.php"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'score_list.php') echo 'active'; ?>">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>
                                        លទ្ធផលពិន្ទុ
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="attendace_list.php"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'attendace_list.php') echo 'active'; ?> ">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>
                                        បញ្ជីវត្តមានសិក្សា
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- User page -->


                        <?php if ($_SESSION['role'] == 'user'): ?>

                            <li
                                class="nav-item <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'Classlist.php') echo 'menu-open'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'score_list.php') echo 'menu-open'; ?> ">
                                <a href="#"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'Classlist.php') echo 'active'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'score_list.php') echo 'active'; ?> ">
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>
                                        ពិន្ទុ
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview ">
                                    <li class="nav-item">
                                        <a href="Classlist.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'Classlist.php') echo 'active'; ?> ">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                បញ្ជូលពិន្ទុ
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="score_list.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'score_list.php') echo 'active'; ?> ">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                លទ្ធផលពិន្ទុ
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>



                        <?php if ($_SESSION['role'] == 'user'): ?>
                            <li
                                class="nav-item <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'attendance.php') echo 'menu-open'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'attendace_list.php') echo 'menu-open'; ?>">
                                <a href="#"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'attendance.php') echo 'active'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'attendace_list.php') echo 'active'; ?> ">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>
                                        វត្តមាន
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="attendance.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'attendance.php') echo 'active'; ?> ">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                បញ្ចូលវត្តមាន
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="attendace_list.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'attendace_list.php') echo 'active'; ?> ">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                បញ្ជីវត្តមាន
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link btnhover1">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>
                                        ចាកចេញ
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>


                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li
                                class="nav-item <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'sch_add.php') echo 'menu-open'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'sch_list.php') echo 'menu-open'; ?> ">
                                <a href="#"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'sch_add.php') echo 'active'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'sch_list.php') echo 'active'; ?> ">
                                    <i class="nav-icon fas fa-calendar"></i>
                                    <p>
                                        កាលវិភាគសិក្សា
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview ">
                                    <li class="nav-item">
                                        <a href="sch_add.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'sch_add.php') echo 'active'; ?> ">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                បញ្ចូលកាលវិភាគ
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="sch_stu_view.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'sch_list.php') echo 'active'; ?> ">
                                            <p class="text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                បង្ហាញកាលវិភាគ
                                            </p>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            <li class="nav-item">
                                <a href="report.php"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'report.php') echo 'active'; ?> ">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        របាយការណ៍
                                    </p>
                                </a>
                            </li>


                            <li
                                class="nav-item <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'user_info.php') echo 'menu-open'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'backup.php') echo 'menu-open'; ?> ">
                                <a href="#"
                                    class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'user_info.php') echo 'active'; ?> || <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'backup.php') echo 'active'; ?> ">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        ផ្សេងៗ
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="user_info.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'user_info.php') echo 'active'; ?> ">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i>
                                                ព័ត៌មានអ្នកប្រើប្រាស់
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="backup.php"
                                            class="nav-link btnhover1 <?php if (isset($uriSegments[2]) && $uriSegments[2] == 'backup.php') echo 'active'; ?> ">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i> Backup
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview mb-5">
                                    <li class="nav-item">
                                        <a href="logout.php" class="nav-link btnhover1 ">
                                            <p class="stu-list text-white pl-3">
                                                <i class="fas fa-circle text-white" style="font-size:10px;"></i> ចាកចេញ
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- check _SESSION if user -->
                        <?php endif; ?>
                    </ul>


                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
