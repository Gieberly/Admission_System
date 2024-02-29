-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 04:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsu_admission_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicclassification`
--

CREATE TABLE `academicclassification` (
  `ID` int(11) NOT NULL,
  `Classification` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Math` float DEFAULT NULL,
  `Science` float DEFAULT NULL,
  `English` float DEFAULT NULL,
  `GWA` float DEFAULT NULL,
  `NatureOfDegree` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academicclassification`
--

INSERT INTO `academicclassification` (`ID`, `Classification`, `Description`, `Math`, `Science`, `English`, `GWA`, `NatureOfDegree`) VALUES
(1, 'Senior High School Graduates', 'Those who did not enroll in any technical/vocational/college degree program in any other school after graduation.', 90, 90, 90, 86, 'Board'),
(2, 'High School (Old Curriculum) Graduates', 'Those who did not enroll in any college degree program in any other school after graduation from high school of the old curriculum.', 86, 86, 86, 86, 'Board'),
(3, 'Grade 12', ' as of Application Period Currently enrolled as Grade 12.', 86, 86, 86, 86, 'Board'),
(4, 'ALS/PEPT Completers', 'Those whose ALS/PEPT Certificate of Rating indicates that they are eligible for College Admission/Rating is equivalent to Senior High and similar terms.', NULL, NULL, NULL, 80, 'Board'),
(5, 'Transferees', 'Those who started college schooling in another school and intend to continue schooling in BSU.', NULL, NULL, NULL, 80, 'Board'),
(6, 'Second Degree', 'Those who have already graduated from a degree program in College. This may either be Second degree (BSU graduate of a Baccalaureate program) or Second Degree-transferees (Graduates of a Baccalaureate degree from another school who will enroll another degree in BSU).', NULL, NULL, NULL, 80, 'Board');

-- --------------------------------------------------------

--
-- Table structure for table `admission_data`
--

CREATE TABLE `admission_data` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `sent` enum('sent','unsent') DEFAULT 'unsent',
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(500) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(255) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(255) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(500) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` decimal(5,2) DEFAULT NULL,
  `english_3` decimal(5,2) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` decimal(5,2) DEFAULT NULL,
  `math_3` decimal(5,2) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` decimal(5,2) DEFAULT NULL,
  `science_3` decimal(5,2) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `test_score` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_data`
--

INSERT INTO `admission_data` (`id`, `id_picture`, `applicant_name`, `sent`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `test_score`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(33, '', 'Davis, Andrew Robert', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, NULL, 'NOA(Q-A)', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, 'NOA(NQ-A)', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, 'NOR(Q-NA)', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, 'NOA(Q-A)', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, 'NOA(NQ-A)', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, NULL, 'NOA(NQ-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, 'NOA(NQ-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, 'NOR(Q-NA)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, 0.00, 0.00, 99.00, 0.00, 0.00, 89.00, 0.00, 0.00, 90.00, 0.00, 'NOR(Q-NA)', NULL, '0000-00-00', '00:00:00', 'Accepted'),
(47, '', 'Lim, Rosa Maria Espino', 'unsent', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, NULL, 'NOA(NQ-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'unsent', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'unsent', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30', '09:00:00', 'Declined'),
(93, 0x6173736574732f75706c6f6164732f363563396362353032633032345f64756d6d792d6d616e2d353730783537302d312e706e67, 'Comot, Jessa Itsu', 'unsent', 'female', '2000-09-05', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'La Trinidad Benguet', 2604, '9145524552', 'Gieberly Sawac', 'itsu@gmail.com', 'Sawac, Gieberly Fagwan', '9460592222', 'Guardian', 'Sawac, Gieberly Fagwan', '9460553542', 'Guardian', 'High School (Old Curriculum) Graduates', 'King\'s College of The Philippines', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00025', '2024-02-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-13', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applicationdate`
--

CREATE TABLE `applicationdate` (
  `ApplicationDateID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicationdate`
--

INSERT INTO `applicationdate` (`ApplicationDateID`, `StartDate`, `EndDate`) VALUES
(2, '2023-01-11', '2023-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `appointmentdate`
--

CREATE TABLE `appointmentdate` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `available_slots` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointmentdate`
--

INSERT INTO `appointmentdate` (`appointment_id`, `appointment_date`, `appointment_time`, `available_slots`) VALUES
(26, '2024-02-14', '08:00:00', 10),
(54, '2024-02-15', '10:00:00', 10),
(60, '2024-02-16', '09:00:00', 10),
(67, '2024-02-13', '08:00:00', 10),
(68, '2024-02-13', '09:00:00', 10),
(69, '2024-02-13', '10:00:00', 10),
(70, '2024-02-14', '10:00:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `AMSlot` int(255) DEFAULT NULL,
  `PMSlot` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`ID`, `Date`, `AMSlot`, `PMSlot`) VALUES
(1, '2024-01-19', 495, 482),
(2, '2024-01-14', 499, 495),
(3, '2024-01-15', 493, 487),
(7, '2024-01-16', 25, 20),
(8, '2024-02-01', 50, 49),
(9, '2024-02-01', 50, 49),
(10, '2024-01-03', 50, 50),
(11, '2024-01-17', 50, 50),
(12, '2024-01-11', 99, 99),
(13, '2024-01-11', 99, 99),
(14, '2024-01-11', 99, 99),
(15, '2024-01-11', 99, 99),
(16, '2024-01-01', 99, 99);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_admission_data`
--

CREATE TABLE `deleted_admission_data` (
  `id` int(11) NOT NULL,
  `applicant_name` varchar(255) DEFAULT NULL,
  `applicant_number` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`) VALUES
(9, 'fdbf', 'fgfdg'),
(10, 'bakit?', 'wqre'),
(11, 'bakit?', 'gfhgh'),
(12, 'gfhgfh', 'gfhgf'),
(13, 'bakit?', 'fghgfhfgt'),
(14, 'gfhgfh', 'fghgfhgf'),
(15, 'gfhgfhgf', 'gfjhgfj'),
(16, 'ghgfh', 'fghgfh'),
(17, 'bakit?', 'gfhgfh');

-- --------------------------------------------------------

--
-- Table structure for table `nonboardacadclass`
--

CREATE TABLE `nonboardacadclass` (
  `ID` int(11) NOT NULL,
  `Classification` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `GWA` float DEFAULT NULL,
  `NatureOfDegree` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nonboardacadclass`
--

INSERT INTO `nonboardacadclass` (`ID`, `Classification`, `Description`, `GWA`, `NatureOfDegree`) VALUES
(1, 'Senior High School Graduates', 'Those who did not enroll in any technical/vocational/college degree program in any other school after graduation.', 80, 'Non-Board'),
(2, 'High School (Old Curriculum) Graduates', 'Those who did not enroll in any college degree program in any other school after graduation from high school.', 80, 'Non-Board'),
(3, 'Grade 12', 'as of application period Currently enrolled as Grade 12.', 80, 'Non-Board'),
(4, 'ALS/PEPT Completers', 'Those whose ALS/PEPT Certificate of Rating indicates that they are eligible for College Admission/Rating is equivalent to Senior High and similar terms.', 80, 'Non-Board'),
(5, 'Transferees', 'Those who started college schooling in another school and intend to continue schooling in BSU.', 80, 'Non-Board'),
(6, 'Second Degree', 'Those who have already graduated from a degree program in College. This may either be Second degree (BSU graduate of a Baccalaureate program) or Second Degree-transferees (Graduates of a Baccalaureate degree from another school who will enroll another degree in BSU)', 80, 'Non-Board');

-- --------------------------------------------------------

--
-- Table structure for table `personel`
--

CREATE TABLE `personel` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `ProgramID` int(11) NOT NULL,
  `Courses` varchar(255) NOT NULL,
  `Nature_of_Degree` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Overall_Slots` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`ProgramID`, `Courses`, `Nature_of_Degree`, `Description`, `Overall_Slots`) VALUES
(1, 'BSIT', 'Non-Board', 'Bachelor of Science in Information Technology', 99),
(33, 'BSA', 'Board', 'Bachelor of Science in Agriculture', 100),
(34, 'BSABE', 'Board', 'Bachelor of Science in Agricultural and Biosystems Engineering', 100),
(35, 'BSCE', 'Board', 'Bachelor of Science in Civil Engineering', 100),
(36, 'BSEE', 'Board', 'Bachelor of Science in Electrical Engineering', 10),
(37, 'BSIE', 'Board', 'Bachelor of Science in Industrial Engineering', 0),
(38, 'BSF', 'Board', 'Bachelor of Science in Forestry', 0),
(39, 'BSFT', 'Board', 'Bachelor of Science in Food Technology', 0),
(40, 'BSND', 'Board', 'Bachelor of Science in Nutrition and Dietetics', 0),
(41, 'BPE', 'Board', 'Bachelor of Physical Education', 0),
(42, 'BLIS', 'Board', 'Bachelor of Library and Information Science', 0),
(43, 'BSC', 'Board', 'Bachelor of Science in Chemistry', 0),
(44, 'BSN', 'Board', 'Bachelor of Science in Nursing', 0),
(45, 'BSP', 'Board', 'Bachelor of Science in Psychology', 0),
(46, 'BSC', 'Board', 'Bachelor of Science in Criminology', 88),
(47, 'BECE', 'Board', 'Bachelor of Early Childhood Education', 0),
(48, 'BEE', 'Board', 'Bachelor of Elementary Education', 0),
(49, 'BSEdME', 'Board', 'Bachelor of Secondary Education Major in English', 0),
(50, 'BSEdMF', 'Board', 'Bachelor of Secondary Education Major in Filipino', 0),
(51, 'BSEdMM', 'Board', 'Bachelor of Secondary Education Major in Mathematics', 0),
(52, 'BSEdMS', 'Board', 'Bachelor of Secondary Education Major in Science', 0),
(53, 'BSEdMSS', 'Board', 'Bachelor of Secondary Education Major in Social Science', 0),
(54, 'BSEMV', 'Board', 'Bachelor of Secondary Education Major in Values', 0),
(55, 'BTLEMA', 'Board', 'Bachelor of Technology and Livelihood Education Major in Agri-Fishery', 0),
(56, 'BTLEMHE', 'Board', 'Bachelor of Technology and Livelihood Education Major in Home Economics', 0),
(57, 'DVM', 'Board', 'Doctor of Veterinary Medicine', 0),
(59, 'BAEL', 'Non-Board', 'Bachelor of Arts in English Language', 0),
(60, 'BSA', 'Non-Board', 'Bachelor of Science in Agribusiness', 0),
(61, 'BSC', 'Non-Board', 'Bachelor of Arts in Communication', 0),
(62, 'BAFL', 'Non-Board', 'Bachelor of Arts in Filipino Language', 0),
(63, 'BSE', 'Non-Board', 'Bachelor of Science in Entrepreneurship', 0),
(64, 'BSHM', 'Non-Board', 'Bachelor of Science in Hospitality Managements', 0),
(65, 'BSTM', 'Non-Board', 'Bachelor of Science in Tourism Management', 0),
(66, 'BSESS', 'Non-Board', 'Bachelor of Science in Exercise and Sports Sciences', 0),
(67, 'DevCom', 'Non-Board', 'Bachelor of Science in Development Communication', 0),
(68, 'BSB', 'Non-Board', 'Bachelor of Science in Biology', 0),
(69, 'BSES', 'Non-Board', 'Bachelor of Science in Environmental Science', 0),
(70, 'BSM', 'Non-Board', 'Bachelor of Science in Mathematics', 88),
(71, 'BSM', 'Non-Board', 'Bachelor of Science in Mathematics', 0),
(72, 'BSS', 'Non-Board', 'Bachelor of Science in Statistics', 54),
(73, 'BPA', 'Non-Board', 'Bachelor of Public Administration', 0),
(74, 'BAH', 'Non-Board', 'Bachelor of Arts in History', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reapplication`
--

CREATE TABLE `reapplication` (
  `StepID` int(11) NOT NULL,
  `Steps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reapplication`
--

INSERT INTO `reapplication` (`StepID`, `Steps`) VALUES
(9, 'dghdgh'),
(10, '3355');

-- --------------------------------------------------------

--
-- Table structure for table `releasingofresults`
--

CREATE TABLE `releasingofresults` (
  `ReleaseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `releasingofresults`
--

INSERT INTO `releasingofresults` (`ReleaseDate`) VALUES
('2023-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `school_semester`
--

CREATE TABLE `school_semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_semester`
--

INSERT INTO `school_semester` (`id`, `semester`) VALUES
(1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `college_code` int(11) NOT NULL,
  `dep_code` int(11) NOT NULL,
  `slots` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(11) NOT NULL,
  `last_name` int(11) DEFAULT NULL,
  `name` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_result`
--

CREATE TABLE `student_result` (
  `id` int(11) NOT NULL,
  `app_number` int(11) NOT NULL,
  `college` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `b_date` varchar(100) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `gwa` int(11) NOT NULL,
  `math` int(11) NOT NULL,
  `science` int(11) NOT NULL,
  `english` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `result` varchar(255) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_result`
--

INSERT INTO `student_result` (`id`, `app_number`, `college`, `course`, `lname`, `fname`, `mname`, `email`, `b_date`, `sex`, `municipality`, `province`, `country`, `gwa`, `math`, `science`, `english`, `rank`, `result`, `modified`, `created`) VALUES
(80, 10000019, 'CAS', 'BSABE', 'saturo', 'Gojo', 'Okkotsu', 'Gojo@gmail.com', '03-15-2001', 'male', 'La trinidad', 'benguet', 'Philippines', 99, 99, 99, 99, 1, 'NOA', '2023-11-02 21:09:03', '2023-11-02 21:31:14'),
(81, 10000020, 'CIS', 'BSIT', 'Puylong', 'Arjie', 'Lutong', 'rj@gmail,com', '01/02/2001', 'female', 'Kyoto', 'Osaka', 'Japan', 98, 98, 98, 97, 1, 'NOA', '2023-11-02 21:09:03', '2023-11-02 21:31:14'),
(82, 10000021, 'CTE', 'BSEE', 'Licangan', 'Jeshen', 'Sap-ay', 'jl@gmail.com', '01/02/2001', 'female', 'Mankayan', 'benguet', 'Philippines', 100, 100, 100, 100, 1, 'NOA', '2023-11-02 21:09:03', '2023-11-02 21:31:14'),
(83, 19000022, 'CIS', 'BSIT', 'King', 'Luther', 'the third', 'luther@gmail.com', '02-01-2000', 'male', 'La trinidad', 'Benguet', 'Philippines', 75, 80, 74, 74, 102, 'NOR', NULL, '2023-11-05 17:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userType` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'pending=no, verified=yes',
  `lstatus` varchar(255) NOT NULL DEFAULT 'Pending',
  `Department` varchar(255) DEFAULT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `state` varchar(100) NOT NULL DEFAULT 'active' COMMENT 'active, inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `name`, `mname`, `email`, `password`, `userType`, `status`, `lstatus`, `Department`, `verification_code`, `token`, `created_date`, `state`) VALUES
(6, 'Summit', 'Wilkins', 'sumo', 'wilkinssummit15@gmail.com', '$2y$10$bQKPo9OcpUwZ5Ma5pvZEEOqbHYl8npoJa7k04O2any5mV4goG8.f.', 'admin', 'verified', 'Pending', NULL, NULL, 'e45f45a2ecdc0004f85da9f7ef79759c', '2024-01-15 10:31:06', 'active'),
(10, 'Puylong', 'Arjie', 'Lutong', 'puylongarjie@gmail.com', '$2y$10$wzj//ANTEBj61kVh8i1n3.7vtazIuDeOEzxRSRFyJIzUb9SgrwZtS', 'student', 'verified', 'Pending', NULL, NULL, 'df977d13a7d898ae86dc2245d7360e14', '2024-01-23 19:16:24', 'active'),
(11, 'Sawac', 'Gieberly', 'Fagwan', 'sawac.gieberly99@gmail.com', '$2y$10$4Ene775kmahF6FYD6GsKGOXQ5YDQjAxhw9MPX2I3kGm58CLV5cr8m', 'staff', 'pending', 'Pending', NULL, NULL, '76d106b9673d8b3f433d168b930a6e3d', '2024-01-23 19:24:34', 'active'),
(17, 'Sawac', 'Gieberly', 'Fagwan', 'gieberlycious@gmail.com', '$2y$10$z2RoM9IV7Ethf60vZfrQQurf72hCexUyUkCU1vW6MODMczj0m2WhC', 'admin', 'pending', 'Approved', '', NULL, '', '2024-01-25 13:13:04', 'active'),
(18, 'Sabiano', 'Devon Lee', 'Fagwan', 'devon@gmail.com', '$2y$10$Z5LsEuDozHR80i.AIoy.lOi9ixUd0l7DIvKEeEYYaKTBTXU.01Tpy', 'Staff', 'pending', 'Approved', '', NULL, '', '2024-01-25 13:27:57', 'active'),
(19, 'Sabiano', 'Jones', 'Fagwan', 'jones@gmail.com', '$2y$10$5mN18JiZFaQH0HSXneeh0esJBQmyBD1psdWw2hk0OX08WV8RNEDeC', 'Student', 'pending', 'Approved', '', NULL, '', '2024-01-25 15:06:40', 'active'),
(20, 'Licangen', 'Jeshen', 'Sap-ay', 'jeshen@gmail.com', '$2y$10$jYShaRIxbsp2CWxCQQ7pROb7j968Iw5bHPQfMZLs9ynu.Y5KLT2jW', 'Student', 'pending', 'Approved', '', NULL, '', '2024-01-25 15:08:02', 'active'),
(22, '', 'jeffrey', '', 'jeff@gmail.com', '$2y$10$ujik81.RaIDO8rgEZdODj.B0hJo7noFmDfuokmTmnZrmcTjZvzoDS', 'student', 'approved', 'Pending', NULL, NULL, '', '2024-02-06 11:49:00', 'active'),
(25, 'Comot', 'Jessa', 'Itsu', 'itsu@gmail.com', '$2y$10$QsJxUHAVGYE7Oh12TNUJS.7Qc414sJ0HwEe55KCj5frKv/sg88qPC', 'Student', 'pending', 'Approved', '', NULL, '', '2024-02-07 16:08:02', 'active'),
(26, 'Doe', 'John', 'Lee', 'john@gmail.com', '$2y$10$rd01Y1G84O6PAOx5SasSfepILikfjLmNeEG351sLzcRWKflevOIqe', 'Staff', 'pending', 'Pending', '', NULL, '', '2024-02-13 11:22:28', 'active'),
(27, '', '', '', '', '', '', 'pending', 'Pending', NULL, NULL, '', '2024-02-14 12:11:31', 'active'),
(28, '', '', 'Fagwan', 'igorotclothing@gmail.com', '$2y$10$DYJiZ6exd40o9lZuPrbGROiJTb7oVJKzI8dmS71L8DHzOoN/0yMc6', 'Admin', 'pending', 'Pending', NULL, NULL, 'f697675dad9751038ff79dbc7468bc7b', '2024-02-14 12:38:23', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicclassification`
--
ALTER TABLE `academicclassification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admission_data`
--
ALTER TABLE `admission_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicationdate`
--
ALTER TABLE `applicationdate`
  ADD PRIMARY KEY (`ApplicationDateID`);

--
-- Indexes for table `appointmentdate`
--
ALTER TABLE `appointmentdate`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `deleted_admission_data`
--
ALTER TABLE `deleted_admission_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `nonboardacadclass`
--
ALTER TABLE `nonboardacadclass`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`ProgramID`);

--
-- Indexes for table `reapplication`
--
ALTER TABLE `reapplication`
  ADD PRIMARY KEY (`StepID`);

--
-- Indexes for table `releasingofresults`
--
ALTER TABLE `releasingofresults`
  ADD PRIMARY KEY (`ReleaseDate`);

--
-- Indexes for table `school_semester`
--
ALTER TABLE `school_semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_result`
--
ALTER TABLE `student_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicclassification`
--
ALTER TABLE `academicclassification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admission_data`
--
ALTER TABLE `admission_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `applicationdate`
--
ALTER TABLE `applicationdate`
  MODIFY `ApplicationDateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointmentdate`
--
ALTER TABLE `appointmentdate`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nonboardacadclass`
--
ALTER TABLE `nonboardacadclass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `ProgramID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `reapplication`
--
ALTER TABLE `reapplication`
  MODIFY `StepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_semester`
--
ALTER TABLE `school_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
