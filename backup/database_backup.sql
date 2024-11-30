SET foreign_key_checks = 0; 
DROP TABLE IF EXISTS `installments`;

CREATE TABLE `installments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `total` decimal(11,0) NOT NULL,
  `install_1` decimal(11,0) DEFAULT NULL,
  `installDate_1` date DEFAULT NULL,
  `paid_1` decimal(11,0) DEFAULT 0,
  `paidWay1` enum('كاش','بنكك') NOT NULL DEFAULT 'كاش',
  `processNumber1` bigint(20) DEFAULT NULL,
  `paidDate_1` datetime DEFAULT NULL,
  `install_2` decimal(11,0) DEFAULT NULL,
  `installDate_2` date DEFAULT NULL,
  `paid_2` decimal(11,0) DEFAULT 0,
  `paidWay2` enum('كاش','بنكك') NOT NULL DEFAULT 'كاش',
  `processNumber2` bigint(20) DEFAULT NULL,
  `paidDate_2` datetime DEFAULT NULL,
  `install_3` decimal(11,0) DEFAULT NULL,
  `installDate_3` date DEFAULT NULL,
  `paid_3` decimal(11,0) DEFAULT 0,
  `paidWay3` enum('كاش','بنكك') NOT NULL DEFAULT 'كاش',
  `processNumber3` bigint(20) DEFAULT NULL,
  `paidDate_3` datetime DEFAULT NULL,
  `install_4` decimal(11,0) DEFAULT NULL,
  `installDate_4` date DEFAULT NULL,
  `paid_4` decimal(11,0) DEFAULT 0,
  `paidWay4` enum('كاش','بنكك') NOT NULL DEFAULT 'كاش',
  `processNumber4` bigint(20) DEFAULT NULL,
  `paidDate_4` datetime DEFAULT NULL,
  `install_5` decimal(11,0) DEFAULT NULL,
  `installDate_5` date DEFAULT NULL,
  `paid_5` decimal(11,0) DEFAULT 0,
  `paidWay5` enum('كاش','بنكك') NOT NULL DEFAULT 'كاش',
  `processNumber5` bigint(20) DEFAULT NULL,
  `paidDate_5` datetime DEFAULT NULL,
  `install_6` decimal(11,0) DEFAULT NULL,
  `installDate_6` date DEFAULT NULL,
  `paid_6` decimal(11,0) DEFAULT 0,
  `paidWay6` enum('كاش','بنكك') NOT NULL DEFAULT 'كاش',
  `processNumber6` bigint(20) DEFAULT NULL,
  `paidDate_6` datetime DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id` (`student_id`),
  CONSTRAINT `installments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `installments` WRITE;

INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('154', '0', '10', '10', '2024-09-03', '0', 'كاش', '0', '0000-00-00 00:00:00', '0', '0000-00-00', '0', 'كاش', '0', '0000-00-00 00:00:00', '0', '0000-00-00', '0', 'كاش', '0', '0000-00-00 00:00:00', '0', '0000-00-00', '0', 'كاش', '0', '0000-00-00 00:00:00', '0', '0000-00-00', '0', 'كاش', '0', '0000-00-00 00:00:00', '0', '0000-00-00', '0', 'كاش', '0', '0000-00-00 00:00:00', '2024-09-22', '2024-09-22');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('178', '211', '1000000', '100000', '0000-00-00', '55000', 'كاش', '', '2024-10-22 08:30:05', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-06', '2024-10-06');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('179', '212', '1111', '100000', '0000-00-00', '5000', 'كاش', '', '2024-10-06 19:10:25', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-06', '2024-10-06');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('180', '213', '1111', '100000', '0000-00-00', '60000', 'كاش', '', '2024-10-06 20:09:51', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-06', '2024-10-06');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('181', '214', '111111', '100000', '0000-00-00', '80000', 'بنكك', '1', '2024-10-07 06:55:23', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-06', '2024-10-06');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('182', '215', '700000', '100000', '0000-00-00', '25000', 'بنكك', '5', '2024-10-09 10:44:40', '10000', '0000-00-00', '1000', 'كاش', '', '2024-10-08 13:29:31', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-07', '2024-10-07');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('183', '216', '700000', '100000', '0000-00-00', '20000', 'بنكك', '4', '2024-10-09 09:38:14', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-08', '2024-10-08');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('184', '217', '700000', '100000', '0000-00-00', '10000', 'بنكك', '10', '2024-10-20 14:29:52', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-09', '2024-10-09');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('185', '218', '2000', '10', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-19', '2024-10-19');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('186', '219', '2000', '10', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-20', '2024-10-20');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('188', '221', '2000', '10', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-21', '2024-10-21');
INSERT INTO `installments` (id, student_id, total, install_1, installDate_1, paid_1, paidWay1, processNumber1, paidDate_1, install_2, installDate_2, paid_2, paidWay2, processNumber2, paidDate_2, install_3, installDate_3, paid_3, paidWay3, processNumber3, paidDate_3, install_4, installDate_4, paid_4, paidWay4, processNumber4, paidDate_4, install_5, installDate_5, paid_5, paidWay5, processNumber5, paidDate_5, install_6, installDate_6, paid_6, paidWay6, processNumber6, paidDate_6, created_at, updated_at) VALUES ('189', '222', '2000', '10', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '0', '0000-00-00', '0', 'كاش', '', '', '2024-10-22', '2024-10-22');
UNLOCK TABLES;


DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` varchar(255) NOT NULL,
  `stage` enum('ابتدائي','متوسط','ثانوي','رياض') NOT NULL DEFAULT 'رياض',
  `installNumber` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `paid` decimal(11,0) NOT NULL,
  `paidWay` enum('كاش','بنكك') NOT NULL DEFAULT 'كاش',
  `processNumber` int(20) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `instsllments_id` (`student_id`),
  CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `invoices` WRITE;

INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('2', 'ملاذ ادريس عمر عبدالرحيم', 'ابتدائي', 'الاول', '211', '35000', 'كاش', '', '2.png', '2024-10-06 11:15:46');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('14', 'هدى', 'ابتدائي', 'الاول', '212', '5000', 'كاش', '', '3.png', '2024-10-06 19:10:26');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('15', 'بلال', 'متوسط', 'الاول', '213', '60000', 'كاش', '', '15.png', '2024-10-06 20:09:51');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('16', 'عمر', 'ثانوي', 'الاول', '214', '70000', 'كاش', '', '16.png', '2024-10-06 20:10:48');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('17', 'عمر', 'ثانوي', 'الاول', '214', '10000', 'بنكك', '1', '17.png', '2024-10-07 06:55:23');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('24', 'محمد انور عبدالله إدريس', 'رياض', 'الاول', '215', '10000', 'كاش', '', '18.png', '2024-10-07 07:51:36');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('35', 'محمد انور عبدالله إدريس', 'رياض', 'الاول', '215', '10000', 'كاش', '', '25.png', '2024-10-07 08:12:36');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('36', 'محمد انور عبدالله إدريس', 'رياض', 'الثاني', '215', '1000', 'كاش', '', '36.png', '2024-10-08 13:29:31');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('37', 'ادم', 'رياض', 'الاول', '216', '10000', 'كاش', '', '37.png', '2024-10-08 13:59:54');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('38', 'ادم', 'رياض', 'الاول', '216', '10000', 'بنكك', '4', '38.png', '2024-10-09 09:38:14');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('39', 'محمد انور عبدالله إدريس', 'رياض', 'الاول', '215', '5000', 'بنكك', '5', '39.png', '2024-10-09 10:44:41');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('40', 'اية عبدالعليم احمد السر', 'رياض', 'الاول', '217', '10000', 'بنكك', '10', '40.png', '2024-10-20 14:29:53');
INSERT INTO `invoices` (id, student, stage, installNumber, student_id, paid, paidWay, processNumber, image, create_at) VALUES ('41', 'ملاذ ادريس عمر عبدالرحيم', 'ابتدائي', 'الاول', '211', '20000', 'كاش', '', '41.png', '2024-10-22 08:30:05');
UNLOCK TABLES;


DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `appName` varchar(255) NOT NULL,
  `inkedPhoto` varchar(255) NOT NULL,
  `backupFile` varchar(255) NOT NULL,
  `invoiceMsg` text NOT NULL,
  `invoiceReport` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `settings` WRITE;

INSERT INTO `settings` (appName, inkedPhoto, backupFile, invoiceMsg, invoiceReport, created_at) VALUES (' مدرستي', 'pit.png', 'database_backup.sql', 'تم الدفع بنجاح، شكرا لكم على سداد الاقساط ✅  ', '', '2024-09-18 07:42:55');
UNLOCK TABLES;


DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) NOT NULL,
  `enrollNumber` int(11) DEFAULT NULL,
  `enrollDate` date NOT NULL,
  `gender` enum('بنين','بنات') NOT NULL,
  `birthDate` date DEFAULT NULL,
  `birthPlace` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `guardian` varchar(255) DEFAULT NULL,
  `guardianCopula` varchar(255) DEFAULT NULL,
  `guardianCareer` varchar(255) DEFAULT NULL,
  `travel` varchar(25) NOT NULL,
  `phoneOne` varchar(255) DEFAULT NULL,
  `phoneTwo` varchar(255) DEFAULT NULL,
  `whatsappPhone` varchar(255) DEFAULT NULL,
  `class` varchar(255) NOT NULL,
  `stage` enum('ابتدائي','متوسط','ثانوي','رياض') NOT NULL,
  `installments_id` int(11) DEFAULT NULL,
  `accountName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `installments_id` (`installments_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`installments_id`) REFERENCES `installments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `students` WRITE;

INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('211', 'ملاذ ادريس عمر عبدالرحيم', '1', '2024-09-19', 'بنات', '2006-02-09', 'كسلا', 'الخرطوم', ' ادريس عمر عبدالرحيم', 'اب', 'مهندس مدني', '', '09374654545', '0967345613451', '0123847345', 'الاول', 'ابتدائي', '178', 'student_211', '92892', '2024-10-06', '2024-10-06');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('212', 'هدى الطيب ابراهيم محمد', '2', '2024-08-20', 'بنات', '0000-00-00', '', '', ' الطيب ابراهيم محمد', 'اب', 'طبيب', '', '0981754545', '012234475', '0981754545', 'الاول', 'ابتدائي', '179', 'student_212', '190729', '2024-10-06', '2024-10-06');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('213', 'بلال مزمل ابراهيم احمد', '1', '2010-04-02', 'بنين', '2024-09-17', '', '', 'مزمل ابراهيم احمد', 'اب', 'باحث اجتماعي', '', '091776348', '01887234654', '01887234654', 'الاول', 'متوسط', '180', 'student_213', '159175', '2024-10-06', '2024-10-06');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('214', 'عمر', '1', '2024-09-21', 'بنين', '0000-00-00', '', '', '', '', '', '', '', '', '', 'الاول', 'ثانوي', '181', 'student_214', '142708', '2024-10-06', '2024-10-06');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('215', 'محمد انور عبدالله إدريس', '1', '2024-06-20', 'بنين', '2024-09-20', '', 'كسلا', ' انور عبدالله إدريس', 'اب', 'معلم', '', '0918019619', '0122792818', '0118848745', 'الاول', 'رياض', '182', 'student_215', '103703', '2024-10-07', '2024-10-07');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('216', 'ادم عبدالمنعم احمد السيد', '2', '2024-10-20', 'بنين', '2006-10-13', '', '', ' عبدالمنعم احمد السيد', 'اب', 'مهندس', '', '0971345634', '0913354563', '01837464534', 'الثالث', 'متوسط', '183', 'student_216', '75452', '2024-10-08', '2024-10-08');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('217', 'اية عبدالعليم احمد السر', '3', '2024-09-20', 'بنات', '0000-00-00', '', '', 'عبدالعليم احمد السر', 'اب', 'حرفي', '', '0963451585', '09123124234', '09123124234', 'الاول', 'رياض', '184', 'student_217', '172398', '2024-10-09', '2024-10-09');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('218', 'منذر الحاج على ادم', '8', '2024-08-20', 'بنين', '0000-00-00', 'khartom', 'kassala', ' محمد على ادم', 'عم', 'تاجر', '', '091736452345', '09827345765', '0121324645', 'الثالث', 'ابتدائي', '185', 'student_218', '51222', '2024-10-19', '2024-10-19');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('219', 'عبدالعظيم محمد علاءالدين ادم', '8', '2024-10-18', 'بنين', '0000-00-00', 'الدويم', 'القضارف', 'محمد علاءالدين ادم', 'اب', 'تاجر', '', '09345725452', '0982745640', '0113475236', 'الاول', 'رياض', '186', 'student_219', '161545', '2024-10-20', '2024-10-20');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('221', 'عثمان محمد ادم احمد', '7', '2024-09-21', 'بنين', '0000-00-00', 'كسلا', 'الخرطوم', 'محمد ادم احمد', 'اب', 'اعمال حرة', '', '091154738', '09786354454', '0118863456', 'الاول', 'رياض', '188', 'student_221', '126824', '2024-10-21', '2024-10-21');
INSERT INTO `students` (id, fullName, enrollNumber, enrollDate, gender, birthDate, birthPlace, address, guardian, guardianCopula, guardianCareer, travel, phoneOne, phoneTwo, whatsappPhone, class, stage, installments_id, accountName, password, created_at, updated_at) VALUES ('222', 'منذر محمد ادم احمد', '6', '2024-10-22', 'بنين', '0000-00-00', 'كسلا', 'الخرطوم', 'محمد ادم احمد', 'اب', 'اعمال حرة', '', '0963576345', '09786354454', '0118863456', 'الثالث', 'متوسط', '189', 'student_222', '34188', '2024-10-22', '2024-10-22');
UNLOCK TABLES;


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','superadmin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `users` WRITE;

INSERT INTO `users` (id, username, fullName, password, role) VALUES ('1', 'admin', 'admin', '$2y$10$MSdue8WEn.EVo.gKKM5z/uNw5KSOdPGHkgrDMYFMdsOuZNJdydbku', 'superadmin');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('302', 'يوسف', 'يوسف احمد عادل عماد', '$2y$10$gOX4zFhohshfCnY47caore0WsEBQOYYyx1UXZXJT41T9gI61eVsYW', 'admin');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('306', 'student_211', 'ملاذ ادريس عمر عبدالرحيم', '$2y$10$Xu9pZiQMqh5MzmsqWP16bOx/K1iccLKMuwYIqxo30Qx3ds7Zv6xf2', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('307', 'student_212', 'هدى', '$2y$10$irza..mpwOuJ8hJv0MvOPeyk8JF0E8mLMBg1i.3V8NL9N2QiyZD4O', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('308', 'student_213', 'بلال', '$2y$10$92jUkPOK3FRUWevQmq508e40pcnpFcASDUALfPU7lirQ/M7DnQru2', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('309', 'student_214', 'عمر', '$2y$10$ZtsuytI6rxIvU0qqyD8qC.RKyzlyl25MAAZiPyIu6oOQDLDEpjR/2', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('310', 'student_215', 'محمد انور عبدالله إدريس', '$2y$10$CyFsvMLjDErMFn0U05FQiuVQX9otRVSam2BTUkci33PORtbjsjVGq', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('315', 'student_216', 'ادم', '$2y$10$cPrj1HZGz2Lk882S8iTyhejexZXF2JFQJuUaX1bxR2q0hI4BsUNqi', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('316', 'student_217', 'اية', '$2y$10$pRbJYRG7rghYqIyNnxsw/eORiDHT./biNDvJgAxugHoVkcetmcDUW', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('319', 'student_218', 'mohamed anwer lyman', '$2y$10$ZdFhNetaqIvWBFlqzUzX8ucXJW4YEbmltUDqm1Q9mIDXVEDPVTX5e', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('320', 'student_219', 'عبدالعظيم محمد علاءالدين ادم', '$2y$10$X/pqUz1yIv1wtn6HFCFbmewS9M.oB1xUdFm/cDmT6J21FuqBxUGG.', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('322', 'user', 'user', '$2y$10$2p6PXPMdohnMoWaEsWxyQO816i0UZ12q2nVaRKOFzjie9Xyywz676', 'admin');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('323', 'student_221', 'عثمان محمد ادم احمد', '$2y$10$1uTGP4XJYKDMTUZ/G9tobO0k6E0.eD//QPOKoWxMCJF8ONYi.e5tS', 'user');
INSERT INTO `users` (id, username, fullName, password, role) VALUES ('325', 'student_222', 'منذر محمد ادم احمد', '$2y$10$oSUB4kcc2NaVu3xq.tSbU.VbJuiGH7EYMr0Sa4f/JAu6M9tngoWl.', 'user');
UNLOCK TABLES;


SET foreign_key_checks = 1; 
