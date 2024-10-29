

CREATE TABLE `tb_teacher` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `Profile_img` varchar(255) DEFAULT NULL,
  `En_name` varchar(50) DEFAULT NULL,
  `Kh_name` varchar(50) DEFAULT NULL,
  `Staff_code` varchar(20) DEFAULT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `Age` int(2) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Position` varchar(30) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Nation` varchar(20) DEFAULT NULL,
  `Ethnicity` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT NULL ON UPDATE current_timestamp(5),
  `Update_at` datetime(5) DEFAULT NULL ON UPDATE current_timestamp(5),
  PRIMARY KEY (`id`),
  KEY `En_name` (`En_name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_teacher` (`id`, `Profile_img`, `En_name`, `Kh_name`, `Staff_code`, `Gender`, `Age`, `DOB`, `Position`, `Address`, `Phone`, `Nation`, `Ethnicity`, `status`, `Date`, `Create_at`, `Update_at`) VALUES ('15', 'images (2).jpg', 'Chan Sovanara', 'ច័ន្ទ សុវណ្ណារ៉ា', 'SIST-01', 'ប្រុស', '', '1990-02-26', 'គ្រូបង្រៀន', 'សៀមរាប', '016​ 123 321', 'ខ្មែរ', 'ខ្មែរ', 'disable', '', '2024-10-20 16:41:12.24215', '2024-10-20 16:41:12.24215');
INSERT INTO `tb_teacher` (`id`, `Profile_img`, `En_name`, `Kh_name`, `Staff_code`, `Gender`, `Age`, `DOB`, `Position`, `Address`, `Phone`, `Nation`, `Ethnicity`, `status`, `Date`, `Create_at`, `Update_at`) VALUES ('17', 'download.jpg', 'NHEB Phach', 'ញ៉េប ផាច', 'T-001', 'ស្រី', '', '2024-10-13', 'គ្រូបង្រៀនភាសាចិន', 'បន្ទាយមានជ័យ', '0973752204', 'ខ្មែរ', 'ខ្មែរ', 'active', '', '2024-10-24 19:28:47.94553', '2024-10-24 19:28:47.94553');
INSERT INTO `tb_teacher` (`id`, `Profile_img`, `En_name`, `Kh_name`, `Staff_code`, `Gender`, `Age`, `DOB`, `Position`, `Address`, `Phone`, `Nation`, `Ethnicity`, `status`, `Date`, `Create_at`, `Update_at`) VALUES ('18', 'images (1).jpg', 'SUN Phala', 'ស៊ុន ផល្លា', 'Teacher-002', 'ប្រុស', '', '2024-09-17', 'គ្រូបង្រៀនភាសាអង់គ្លេស', 'Siem Reap', '0123456789', 'ខ្មែរ', 'ខ្មែរ', 'active', '', '2024-10-24 19:28:57.95409', '2024-10-24 19:28:57.95409');
INSERT INTO `tb_teacher` (`id`, `Profile_img`, `En_name`, `Kh_name`, `Staff_code`, `Gender`, `Age`, `DOB`, `Position`, `Address`, `Phone`, `Nation`, `Ethnicity`, `status`, `Date`, `Create_at`, `Update_at`) VALUES ('19', '455759676_1845419689304169_348413088179969606_n.jpg', 'SON Mean', 'សុន មាន', 'T-002', 'ប្រុស', '', '2024-10-01', 'គ្រូបង្រៀនភាសាខ្មែរ', 'Siem Reap', '098 345 126', 'ខ្មែរ', 'ខ្មែរ', 'active', '', '2024-10-24 19:28:35.72122', '2024-10-24 19:28:35.72122');




CREATE TABLE `tb_student` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `Stu_code` varchar(10) DEFAULT NULL,
  `En_name` varchar(50) DEFAULT NULL,
  `Kh_name` varchar(50) DEFAULT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Address` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `Create_at` date DEFAULT NULL,
  `Update_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `Profile_img` varchar(255) DEFAULT NULL,
  `Dad_name` varchar(50) DEFAULT NULL,
  `Mom_name` varchar(50) DEFAULT NULL,
  `Dad_job` varchar(100) DEFAULT NULL,
  `Mom_job` varchar(100) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_student` (`ID`, `Stu_code`, `En_name`, `Kh_name`, `Gender`, `DOB`, `Address`, `status`, `Create_at`, `Update_at`, `Profile_img`, `Dad_name`, `Mom_name`, `Dad_job`, `Mom_job`, `Phone`) VALUES ('115', 'IT-1205', 'SARAN Chamroeun', 'សារ៉ាន ចំរើន', 'ប្រុស', '2024-10-08', 'Siemreap', 'active', '', '2024-10-24 20:06:36', 'photo_2024-04-09_10-53-45.jpg', 'test', 'test', 'test', 'test', '0123456789');
INSERT INTO `tb_student` (`ID`, `Stu_code`, `En_name`, `Kh_name`, `Gender`, `DOB`, `Address`, `status`, `Create_at`, `Update_at`, `Profile_img`, `Dad_name`, `Mom_name`, `Dad_job`, `Mom_job`, `Phone`) VALUES ('116', 'IT-1707', 'CHHENG Vichet', 'ឆេង វិចិត្រ', 'ប្រុស', '2024-10-21', 'សៀមរាប', 'active', '', '2024-10-24 19:14:20', 'photo_2023-06-07_10-47-58.jpg', 'test', 'test', 'test', 'test', '0123456789');
INSERT INTO `tb_student` (`ID`, `Stu_code`, `En_name`, `Kh_name`, `Gender`, `DOB`, `Address`, `status`, `Create_at`, `Update_at`, `Profile_img`, `Dad_name`, `Mom_name`, `Dad_job`, `Mom_job`, `Phone`) VALUES ('117', 'IT-0217', 'MUON Piti', 'មួន ពិទិ', 'ស្រី', '2024-10-16', 'បន្ទាយមានជ័យ', 'active', '', '2024-10-24 20:07:37', 'photo_2024-10-14_10-09-03.jpg', 'test', 'test', 'test', 'test', '0123456789');
INSERT INTO `tb_student` (`ID`, `Stu_code`, `En_name`, `Kh_name`, `Gender`, `DOB`, `Address`, `status`, `Create_at`, `Update_at`, `Profile_img`, `Dad_name`, `Mom_name`, `Dad_job`, `Mom_job`, `Phone`) VALUES ('118', 'IT-0001', 'Vakhim', 'វ៉ាឃីម', 'ប្រុស', '2024-10-15', 'បន្ទាយមានជ័យ', 'disable', '', '2024-10-24 19:16:35', '4k-laptop.jpg', 'test', 'test', 'test', 'test', '០១២៣៤៥៦៧៨៩');
INSERT INTO `tb_student` (`ID`, `Stu_code`, `En_name`, `Kh_name`, `Gender`, `DOB`, `Address`, `status`, `Create_at`, `Update_at`, `Profile_img`, `Dad_name`, `Mom_name`, `Dad_job`, `Mom_job`, `Phone`) VALUES ('119', 'IT-0002', 'THENG Manit', 'ថេង ម៉ានិត', 'ប្រុស', '2024-10-23', 'សៀមរាប', 'active', '', '2024-10-24 19:16:09', 'photo_2024-05-10_21-39-31.jpg', 'test', 'test', 'test', 'test', '0123456789');




CREATE TABLE `tb_subject` (
  `SubID` int(10) NOT NULL AUTO_INCREMENT,
  `Subject_name` varchar(50) DEFAULT NULL,
  `Color` varchar(40) DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT NULL,
  `Update_at` datetime(5) DEFAULT NULL,
  PRIMARY KEY (`SubID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_subject` (`SubID`, `Subject_name`, `Color`, `Create_at`, `Update_at`) VALUES ('36', 'ថ្នាក់ភាសាខ្មែរ', 'bg-danger', '', '');
INSERT INTO `tb_subject` (`SubID`, `Subject_name`, `Color`, `Create_at`, `Update_at`) VALUES ('37', 'ថ្នាក់ភាសាអង់គ្លេស', 'bg-warning', '', '');
INSERT INTO `tb_subject` (`SubID`, `Subject_name`, `Color`, `Create_at`, `Update_at`) VALUES ('38', 'ថ្នាក់ភាសាចិន', 'bg-info', '', '');




CREATE TABLE `tb_add_to_class` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `Stu_id` int(6) DEFAULT NULL,
  `Class_id` int(6) DEFAULT NULL,
  `Create_at` timestamp NULL DEFAULT current_timestamp(),
  `Update_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `Stu_id` (`Stu_id`),
  KEY `Class_id` (`Class_id`),
  CONSTRAINT `tb_add_to_class_ibfk_1` FOREIGN KEY (`Stu_id`) REFERENCES `tb_student` (`ID`),
  CONSTRAINT `tb_add_to_class_ibfk_2` FOREIGN KEY (`Class_id`) REFERENCES `tb_class` (`ClassID`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_add_to_class` (`id`, `Stu_id`, `Class_id`, `Create_at`, `Update_at`) VALUES ('47', '115', '34', '2024-10-21 01:55:42', '2024-10-21 01:55:42');
INSERT INTO `tb_add_to_class` (`id`, `Stu_id`, `Class_id`, `Create_at`, `Update_at`) VALUES ('48', '116', '34', '2024-10-22 09:55:34', '2024-10-22 09:55:34');
INSERT INTO `tb_add_to_class` (`id`, `Stu_id`, `Class_id`, `Create_at`, `Update_at`) VALUES ('50', '115', '35', '2024-10-22 15:28:24', '2024-10-22 15:28:24');
INSERT INTO `tb_add_to_class` (`id`, `Stu_id`, `Class_id`, `Create_at`, `Update_at`) VALUES ('51', '116', '35', '2024-10-22 15:28:24', '2024-10-22 15:28:24');
INSERT INTO `tb_add_to_class` (`id`, `Stu_id`, `Class_id`, `Create_at`, `Update_at`) VALUES ('52', '117', '35', '2024-10-22 15:28:24', '2024-10-22 15:28:24');
INSERT INTO `tb_add_to_class` (`id`, `Stu_id`, `Class_id`, `Create_at`, `Update_at`) VALUES ('53', '115', '36', '2024-10-24 19:42:30', '2024-10-24 19:42:30');
INSERT INTO `tb_add_to_class` (`id`, `Stu_id`, `Class_id`, `Create_at`, `Update_at`) VALUES ('54', '116', '37', '2024-10-25 14:11:05', '2024-10-25 14:11:05');
INSERT INTO `tb_add_to_class` (`id`, `Stu_id`, `Class_id`, `Create_at`, `Update_at`) VALUES ('55', '117', '37', '2024-10-25 14:11:05', '2024-10-25 14:11:05');




CREATE TABLE `tb_attendance` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `Class_id` int(6) DEFAULT NULL,
  `Attendance` enum('Present','Permission','Absent') DEFAULT 'Absent',
  `Stu_id` int(6) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT current_timestamp(5),
  `Update_at` timestamp(5) NULL DEFAULT current_timestamp(5),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_attendance` (`Class_id`,`Stu_id`,`Date`),
  KEY `Class_id` (`Class_id`),
  KEY `Stu_id` (`Stu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_attendance` (`id`, `Class_id`, `Attendance`, `Stu_id`, `Date`, `Create_at`, `Update_at`) VALUES ('136', '34', 'Absent', '115', '2024-10-21', '2024-10-21 13:40:49.71311', '2024-10-21 13:40:49.71311');
INSERT INTO `tb_attendance` (`id`, `Class_id`, `Attendance`, `Stu_id`, `Date`, `Create_at`, `Update_at`) VALUES ('138', '34', 'Present', '115', '2024-10-22', '2024-10-22 15:59:21.71373', '2024-10-22 15:59:21.71373');
INSERT INTO `tb_attendance` (`id`, `Class_id`, `Attendance`, `Stu_id`, `Date`, `Create_at`, `Update_at`) VALUES ('139', '34', 'Permission', '116', '2024-10-22', '2024-10-22 15:59:21.76122', '2024-10-22 15:59:21.76122');
INSERT INTO `tb_attendance` (`id`, `Class_id`, `Attendance`, `Stu_id`, `Date`, `Create_at`, `Update_at`) VALUES ('140', '34', 'Absent', '115', '2024-10-23', '2024-10-22 15:59:21.76614', '2024-10-22 15:59:21.76614');
INSERT INTO `tb_attendance` (`id`, `Class_id`, `Attendance`, `Stu_id`, `Date`, `Create_at`, `Update_at`) VALUES ('141', '34', 'Present', '115', '2024-10-24', '2024-10-24 14:44:11.93541', '2024-10-24 14:44:11.93541');
INSERT INTO `tb_attendance` (`id`, `Class_id`, `Attendance`, `Stu_id`, `Date`, `Create_at`, `Update_at`) VALUES ('142', '34', 'Permission', '116', '2024-10-24', '2024-10-24 14:44:11.94277', '2024-10-24 14:44:11.94277');
INSERT INTO `tb_attendance` (`id`, `Class_id`, `Attendance`, `Stu_id`, `Date`, `Create_at`, `Update_at`) VALUES ('143', '36', 'Present', '115', '2024-10-24', '2024-10-24 21:21:56.26279', '2024-10-24 21:21:56.26279');




CREATE TABLE `tb_class` (
  `ClassID` int(6) NOT NULL AUTO_INCREMENT,
  `room_id` int(10) DEFAULT NULL,
  `Class_Type` varchar(1) DEFAULT NULL,
  `Teacher_id` int(6) DEFAULT NULL,
  `course_id` int(6) DEFAULT NULL,
  `Time_in` time(6) DEFAULT NULL,
  `Time_out` time(6) DEFAULT NULL,
  `Shift` varchar(15) DEFAULT NULL,
  `Start_class` date DEFAULT NULL,
  `End_class` date DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT NULL,
  `Update_at` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ClassID`) USING BTREE,
  KEY `Teacher_id` (`Teacher_id`),
  KEY `course_id` (`course_id`),
  KEY `tb_class_ibfk_3` (`room_id`),
  CONSTRAINT `tb_class_ibfk_1` FOREIGN KEY (`Teacher_id`) REFERENCES `tb_teacher` (`id`),
  CONSTRAINT `tb_class_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `tb_course` (`id`),
  CONSTRAINT `tb_class_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `tb_classroom` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_class` (`ClassID`, `room_id`, `Class_Type`, `Teacher_id`, `course_id`, `Time_in`, `Time_out`, `Shift`, `Start_class`, `End_class`, `Create_at`, `Update_at`, `status`) VALUES ('34', '1', '', '17', '181', '07:00:00.000000', '11:00:00.000000', 'ពេញម៉ោង', '2024-10-01', '2024-10-31', '', '', 'active');
INSERT INTO `tb_class` (`ClassID`, `room_id`, `Class_Type`, `Teacher_id`, `course_id`, `Time_in`, `Time_out`, `Shift`, `Start_class`, `End_class`, `Create_at`, `Update_at`, `status`) VALUES ('35', '3', '', '18', '183', '07:00:00.000000', '01:03:00.000000', 'ពេលព្រឹក', '2024-10-01', '2024-10-31', '', '', 'active');
INSERT INTO `tb_class` (`ClassID`, `room_id`, `Class_Type`, `Teacher_id`, `course_id`, `Time_in`, `Time_out`, `Shift`, `Start_class`, `End_class`, `Create_at`, `Update_at`, `status`) VALUES ('36', '6', '', '19', '183', '14:00:00.000000', '15:00:00.000000', 'ពេលរសៀល', '2024-10-01', '2024-10-31', '', '', 'active');
INSERT INTO `tb_class` (`ClassID`, `room_id`, `Class_Type`, `Teacher_id`, `course_id`, `Time_in`, `Time_out`, `Shift`, `Start_class`, `End_class`, `Create_at`, `Update_at`, `status`) VALUES ('37', '6', '', '18', '180', '07:10:00.000000', '09:13:00.000000', 'ពេញម៉ោង', '2024-10-25', '2024-10-25', '', '', 'active');




CREATE TABLE `tb_course` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `Course_name` varchar(50) DEFAULT NULL,
  `Color` varchar(30) DEFAULT NULL,
  `Sub_id` int(6) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT NULL ON UPDATE current_timestamp(5),
  `Update_at` timestamp(5) NULL DEFAULT NULL ON UPDATE current_timestamp(5),
  PRIMARY KEY (`id`),
  KEY `subjectFK` (`Sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_course` (`id`, `Course_name`, `Color`, `Sub_id`, `Date`, `Create_at`, `Update_at`) VALUES ('180', 'មតេយ្យសិក្សា', '', '36', '2024-10-20', '2024-10-24 19:34:13.38196', '2024-10-24 19:34:13.38196');
INSERT INTO `tb_course` (`id`, `Course_name`, `Color`, `Sub_id`, `Date`, `Create_at`, `Update_at`) VALUES ('181', 'ថ្នាក់ទី១', '', '36', '2024-10-20', '2024-10-20 16:48:09.50540', '2024-10-20 16:48:09.50540');
INSERT INTO `tb_course` (`id`, `Course_name`, `Color`, `Sub_id`, `Date`, `Create_at`, `Update_at`) VALUES ('182', 'ថ្នាក់ទី២', '', '38', '2024-10-20', '2024-10-24 19:35:17.83494', '2024-10-24 19:35:17.83494');
INSERT INTO `tb_course` (`id`, `Course_name`, `Color`, `Sub_id`, `Date`, `Create_at`, `Update_at`) VALUES ('183', 'ភាសាអង់គ្លេសកម្រិតដំបូង', '', '37', '2024-10-20', '2024-10-20 23:23:49.52736', '2024-10-20 23:23:49.52736');




CREATE TABLE `tb_login` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `Teacher_id` int(6) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(8) DEFAULT NULL,
  `Role` enum('admin','user') DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_login` (`id`, `Teacher_id`, `Username`, `Password`, `Role`, `date`) VALUES ('2', '', 'Tii', '2222', 'admin', '');
INSERT INTO `tb_login` (`id`, `Teacher_id`, `Username`, `Password`, `Role`, `date`) VALUES ('4', '', 'Chet', '3333', 'user', '');
INSERT INTO `tb_login` (`id`, `Teacher_id`, `Username`, `Password`, `Role`, `date`) VALUES ('5', '', 'admin', 'admin', 'admin', '');




CREATE TABLE `tb_final_score` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Class_id` int(10) DEFAULT NULL,
  `Homework` double DEFAULT NULL,
  `Participation` double DEFAULT NULL,
  `Attendance` double DEFAULT NULL,
  `Final` double DEFAULT NULL,
  `Average` double DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Stu_id` int(10) DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT NULL ON UPDATE current_timestamp(5),
  `Update_at` datetime(5) DEFAULT NULL ON UPDATE current_timestamp(5),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_final_score` (`id`, `Class_id`, `Homework`, `Participation`, `Attendance`, `Final`, `Average`, `Status`, `Date`, `Stu_id`, `Create_at`, `Update_at`) VALUES ('1', '', '60', '60', '70', '69', '69', 'New', '2024-09-02', '', '2024-10-11 15:53:18.22319', '2024-10-11 15:53:18.22319');




CREATE TABLE `tb_mid_score` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Class_id` int(10) DEFAULT NULL,
  `Homework` double DEFAULT NULL,
  `Paticipantion` double DEFAULT NULL,
  `Attendance` double DEFAULT NULL,
  `Midterm` double DEFAULT NULL,
  `Average` double DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Stu_id` int(10) DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT NULL ON UPDATE current_timestamp(5),
  `Update_at` datetime(5) DEFAULT NULL ON UPDATE current_timestamp(5),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_mid_score` (`id`, `Class_id`, `Homework`, `Paticipantion`, `Attendance`, `Midterm`, `Average`, `Status`, `Date`, `Stu_id`, `Create_at`, `Update_at`) VALUES ('1', '', '79', '50', '59', '79', '79', 'NEW', '2024-09-04', '', '2024-09-04 18:49:08.00000', '2024-09-04 18:49:11.00000');




CREATE TABLE `tb_month_score` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Class_id` int(10) DEFAULT NULL,
  `Homework` decimal(5,2) DEFAULT NULL,
  `Participation` decimal(5,2) DEFAULT NULL,
  `Attendance` decimal(5,2) DEFAULT NULL,
  `Monthly` decimal(5,2) DEFAULT NULL,
  `Average` decimal(5,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `for_month` varchar(100) DEFAULT NULL,
  `Stu_id` int(10) DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5),
  `Update_at` timestamp(5) NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;





CREATE TABLE `tb_monthly` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `Class_id` int(6) DEFAULT NULL,
  `Course_id` int(6) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT NULL,
  `Update_at` datetime(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classFK` (`Class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;





CREATE TABLE `tb_sch_student` (
  `sch_id` int(6) NOT NULL AUTO_INCREMENT,
  `Class_id` int(6) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `Time_in` time DEFAULT NULL,
  `Time_out` time DEFAULT NULL,
  `Start_class` date DEFAULT NULL,
  `End_class` date DEFAULT NULL,
  `Monday` varchar(255) DEFAULT NULL,
  `Tuesday` varchar(255) DEFAULT NULL,
  `Wednesday` varchar(255) DEFAULT NULL,
  `Thursday` varchar(255) DEFAULT NULL,
  `Friday` varchar(255) DEFAULT NULL,
  `Create_at` timestamp(5) NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5),
  `Update_at` timestamp(5) NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5),
  PRIMARY KEY (`sch_id`) USING BTREE,
  KEY `ClassSCH` (`Class_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('7', '1', '2', '17:53:00', '18:53:00', '2024-10-19', '2024-10-26', 'Monday', 'ghjk', 'hjk', 'hjk', '', '', '');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('8', '3', '3', '18:11:00', '19:11:00', '2024-10-24', '2024-10-31', 'Monday', 'fuyhhjuu', 'huhh', 'uyygujh', '', '2024-10-21 14:51:07.65375', '2024-10-21 14:51:07.65375');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('9', '6', '4', '18:12:00', '20:12:00', '2024-10-24', '2024-10-31', 'dfghj', 'Warm up lession', 'Warm up lession', 'Warm up lession', 'Warm up lession', '2024-10-22 15:18:59.48617', '2024-10-22 15:18:59.48617');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('15', '34', '20', '07:30:00', '08:00:00', '2024-10-21', '2024-10-26', 'Warm up lession', 'Warm up lession', 'Warm up lession', 'Warm up lession', 'Warm up lession', '2024-10-22 15:18:59.49281', '2024-10-22 15:18:59.49281');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('16', '34', '20', '08:00:00', '08:40:00', '2024-10-21', '2024-10-26', 'Active Book', 'Active Book', 'Active Book', 'English Science', 'Talk Time', '2024-10-22 15:04:57.39468', '2024-10-22 15:04:57.39468');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('17', '34', '20', '08:40:00', '09:00:00', '2024-10-21', '2024-10-26', 'Break', 'Break', 'Break', 'English Science', 'Talk Time', '2024-10-22 15:07:28.55564', '2024-10-22 15:07:28.55564');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('18', '34', '', '09:00:00', '10:00:00', '2024-10-26', '2024-10-21', 'Active Book & Work book', 'Active Book & Work book', 'Active Book & Work book', 'Active Book & Work book', 'Active Book & Work book', '2024-10-22 15:07:10.59013', '2024-10-22 15:07:10.59013');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('19', '34', '', '10:00:00', '10:30:00', '2024-10-21', '2024-10-21', 'Practice', 'Practice', 'Practice', 'Physical Education', 'Extra Activity', '2024-10-22 15:09:24.69024', '2024-10-22 15:09:24.69024');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('21', '36', '', '14:00:00', '15:00:00', '2024-10-01', '2024-10-31', 'Science', 'Math', 'Listening', 'Practice', 'Sport', '2024-10-24 19:50:56.66930', '2024-10-24 19:50:56.66930');
INSERT INTO `tb_sch_student` (`sch_id`, `Class_id`, `teacher_id`, `Time_in`, `Time_out`, `Start_class`, `End_class`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Create_at`, `Update_at`) VALUES ('22', '36', '', '15:00:00', '16:00:00', '2024-10-01', '2024-10-31', 'Writing', 'Grammar', 'Coloring', 'Library', 'Sport', '2024-10-24 19:50:56.68516', '2024-10-24 19:50:56.68516');


