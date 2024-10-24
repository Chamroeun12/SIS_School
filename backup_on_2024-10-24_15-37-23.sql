

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


