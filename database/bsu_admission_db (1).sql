-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 05:21 AM
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
(3, 'Grade 12 ', ' as of Application Period Currently enrolled as Grade 12.', 86, 86, 86, 86, 'Board'),
(4, 'ALS/PEPT Completers', 'Those whose ALS/PEPT Certificate of Rating indicates that they are eligible for College Admission/Rating is equivalent to Senior High and similar terms.', NULL, NULL, NULL, 80, 'Board'),
(5, 'Transferees', 'Those who started college schooling in another school and intend to continue schooling in BSU.', NULL, NULL, NULL, 80, 'Board'),
(6, 'Second Degree', 'Those who have already graduated from a degree program in College. This may either be Second degree (BSU graduate of a Baccalaureate program) or Second Degree-transferees (Graduates of a Baccalaureate degree from another school who will enroll another degree in BSU).', NULL, NULL, NULL, 80, 'Board');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_data`
--

CREATE TABLE `admission_data` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_data`
--

INSERT INTO `admission_data` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `id` int(11) NOT NULL,
  `app_number` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `college` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `b_date` varchar(100) NOT NULL,
  `birth_plce` varchar(100) NOT NULL,
  `civil_stat` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `nationality` varchar(200) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `mobile_num` varchar(11) NOT NULL,
  `acad_class` varchar(100) NOT NULL,
  `high_school` varchar(100) NOT NULL,
  `LRN` varchar(30) NOT NULL,
  `application_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`id`, `app_number`, `email`, `college`, `course`, `password`, `u_name`, `lname`, `fname`, `mname`, `age`, `sex`, `b_date`, `birth_plce`, `civil_stat`, `address`, `nationality`, `contact_person`, `relationship`, `mobile_num`, `acad_class`, `high_school`, `LRN`, `application_date`) VALUES
(1, '1900088', 'puylongarjie@gmail.com', 'CIS', 'BSIT', '123', 'Arjie', 'Puylong', 'Arjie', 'Lutong', 23, 'f', '03-15-2000', 'La Trinidad', 'single', 'OD-328 Banig Tawang, La Trinidad, Benguet', 'Filipino', 'Albert L. Puylong', 'brother', '09612571677', 'Non-board', 'LA Trinidad National HIgh School', '123456798', '2024-02-06'),
(3, '19088888', 'gojosaturo@gmail.com', 'CTE', 'BEED', '1234', 'Gojo', 'Satoru', 'Gojo', 'Akutami', 20, 'M', '12-03-2004', 'La Trinidad', 'Single', 'OD-328 Banig Tawang, La Trinidad, Benguet', 'Filipino', 'Gemma Saturo', 'Mother', '09111316444', 'Board', 'Benguet National High School', '1237825255555', '2024-02-06'),
(4, '10000019', 'Gojo@gmail.com', 'CAS', 'BSABE', '1234', 'Jojo', 'saturo', 'Gojo', 'Okkotsu', 21, 'M', '10-05-2003', '', '', '', '', '', '', '', '', '', '', '2024-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `application_id` int(11) NOT NULL,
  `app_number` varchar(100) NOT NULL,
  `documents` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `result` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(26, '2024-02-21', '13:00:00', 502),
(29, '2024-02-20', '08:00:00', 500),
(30, '2024-02-21', '09:00:00', 100);

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
(1, '2024-01-19', 500, 500),
(2, '2024-01-14', 500, 500),
(3, '2024-01-15', 500, 500),
(7, '2024-01-16', 33, 33);

-- --------------------------------------------------------

--
-- Table structure for table `ca`
--

CREATE TABLE `ca` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ca`
--

INSERT INTO `ca` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cas`
--

CREATE TABLE `cas` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cas`
--

INSERT INTO `cas` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chet`
--

CREATE TABLE `chet` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chet`
--

INSERT INTO `chet` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chk`
--

CREATE TABLE `chk` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chk`
--

INSERT INTO `chk` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cis`
--

CREATE TABLE `cis` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cis`
--

INSERT INTO `cis` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cn`
--

CREATE TABLE `cn` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cn`
--

INSERT INTO `cn` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cnas`
--

CREATE TABLE `cnas` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cnas`
--

INSERT INTO `cnas` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cns`
--

CREATE TABLE `cns` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cns`
--

INSERT INTO `cns` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `college_code` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`, `college_code`, `department`) VALUES
(1, 'College of Information Sciences', 'CIS', 'Department of Information Technology'),
(3, 'College of Forestry', 'CF', 'Department of Entomology'),
(4, 'COLLEGE OF TEACHER EDUCATION', 'CTE', 'Department of Elementary Education');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course` varchar(100) NOT NULL,
  `college_code` varchar(255) NOT NULL,
  `major` varchar(100) NOT NULL,
  `slots` varchar(100) NOT NULL,
  `used_slots` int(11) NOT NULL,
  `classfication` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course`, `college_code`, `major`, `slots`, `used_slots`, `classfication`) VALUES
(1, 'Bachelor of Science in Information Technology', 'CIS', 'none', '300', 0, 'Non-board');

-- --------------------------------------------------------

--
-- Table structure for table `cte`
--

CREATE TABLE `cte` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `applicant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `english_2` varchar(255) DEFAULT NULL,
  `english_3` varchar(255) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `math_2` varchar(255) DEFAULT NULL,
  `math_3` varchar(255) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `science_2` varchar(255) DEFAULT NULL,
  `science_3` varchar(255) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Accepted','Declined','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cte`
--

INSERT INTO `cte` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `english_2`, `english_3`, `math_grade`, `math_2`, `math_3`, `science_grade`, `science_2`, `science_3`, `gwa_grade`, `Result`, `status`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(32, '', 'Johnson, Emily Grace', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '2323', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, NULL, NULL, NULL),
(33, '', 'Davis, Andrew Robert', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '123', '0000-00-00', 90.00, NULL, NULL, 88.00, NULL, NULL, 89.00, NULL, NULL, 88.00, 'NOR', NULL, '0000-00-00', NULL, 'Cancelled'),
(34, '', 'Brown, Olivia Anne', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '346547', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(35, '', 'Miller, Ethan James', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '24356', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(37, '', 'Wilson, Sophia Marie', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '25346', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(38, '', 'Moore, Benjamin Thomas', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '234535', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', NULL, 'Cancelled'),
(39, '', 'Anderson, Ava Elizabeth', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 88.00, NULL, NULL, 93.00, NULL, NULL, 95.00, NULL, NULL, 94.00, 'NOA(Q-A)', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(40, '', 'Taylor, William Joseph', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '354325', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(41, '', 'Aguilar, Maria Luisa Santos', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '3425436', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(42, '', 'Santos, Juan Miguel Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '235465', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(43, '', 'Reyes, Ana Theresa Fernandez', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Senior High School Graduate', '', '', 'Bachelor of Arts in English Language', 'Non-Board', '547658', '0000-00-00', 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(44, '', 'Reyes, Juan Dela Cruz', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '436547', '0000-00-00', 97.00, NULL, NULL, 88.00, NULL, NULL, 87.00, NULL, NULL, 91.00, 'NOA', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(45, '', 'Santos, Maria Clara Magtanggol', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', 'Bachelor of Science in Criminology', 'Board', '453', '0000-00-00', 88.00, NULL, NULL, 87.00, NULL, NULL, 87.00, NULL, NULL, 99.00, 'NOR', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(46, '', 'Gonzales, Andres Bonifacio', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '4365467', '0000-00-00', 87.00, NULL, NULL, 99.00, NULL, NULL, 89.00, NULL, NULL, 90.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(47, '', 'Lim, Rosa Maria Espino', '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'High School Graduate', '', '', 'Bachelor of Science in Criminology', 'Board', '654765', '0000-00-00', 88.00, NULL, NULL, 86.00, NULL, NULL, 89.00, NULL, NULL, 93.00, '', NULL, '0000-00-00', '00:00:00', 'Cancelled'),
(61, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Smith, Aiden gie', 'female', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, NULL, 'gfujhyu', 'smith@gmail.com', 'ghjuyu', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'ALS/PEPT Completers', 'bvjngh', '6787698769', 'Bachelor of Science in Civil Engineering', 'Board', '11-01-0133', '2024-01-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0x6173736574732f75706c6f6164732f363561653034373638313263645f327832207369676e61747572652e706e67, 'Hello, Hi gfdfd', 'male', '2000-05-11', 'fgf', 23, 'married', 'wr', 'rwgr', 'Simpa', 2604, NULL, 'Bea Caligtan', 'hello@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'ALS/PEPT Completers', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '24-2-00144', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0x6173736574732f75706c6f6164732f363561653437343063326464385f327832207369676e61747572652e706e67, 'Caligtan, Bea rgfg', 'male', '2000-05-11', 'La Trinidad', 23, 'single', 'Filipino', 'Filipino', 'fdgfd', 54654, '9193296969', 'Gieberly Sawac', 'bea@gmail.com', 'Sawac, Gieberly Fagwan', '2147483647', 'parent', 'Sawac, Gieberly Fagwan', '2147483647', 'guardian', 'Second Degree', 'Mankayan National High School', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00145', '2024-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16', '00:00:00', 'Cancelled'),
(85, 0x6173736574732f75706c6f6164732f363561663166623231383265335f327832207369676e61747572652e706e67, 'Sabiano, Jones Fagwan', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao', 2604, '9193296969', 'Gieberly Sawac', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'guardian', 'Senior High School Graduates', 'Simpa Ampucao Itogon Benguet', '324535465768', 'Bachelor of Science in Agriculture', 'Board', '24-2-00146', '2024-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, ''),
(88, 0x6173736574732f75706c6f6164732f363562323139316333393634625f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan Sap-ay', 'male', '2000-05-11', 'La Trinindad', 23, 'single', 'Filipino', 'Filipino', 'rdeyhtr6y', 2604, '9193296969', 'Gieberly Sawac', 'jeshen@gmail.com', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '9460599686', 'Parent', 'High School (Old Curriculum) Graduates', 'Simpa Ampucao Itogon Benguet', '123456789123', 'Bachelor of Science in Agriculture', 'Board', '24-2-00020', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0x6173736574732f75706c6f6164732f363562333265636539616436395f32783220612e706e67, 'Comot, Jessa Itsu', 'female', '2000-02-01', 'gregh', 23, 'married', 'wr', 'wrg', 'bnbknmnmnm', 98977, '9786767667', 'bbvhhvb', 'itsu@gmail.com', 'jbhh', '9765675657', 'Guardian', 'bhbh', '9787687565', 'Parent', 'Senior High School Graduates', 'ghhgkhjg', '4654767676', 'Bachelor of Science in Information Technology', 'Non-board', '24-2-00021', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_accnt`
--

CREATE TABLE `deleted_accnt` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `userType` varchar(100) NOT NULL,
  `deletion_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `college_name` varchar(100) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `slots` int(11) NOT NULL,
  `used_slots` int(11) NOT NULL,
  `dept_chair` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `college_name`, `dept_name`, `course`, `slots`, `used_slots`, `dept_chair`) VALUES
(1, 'College of Information Sciences', 'Department of Information Technology', 'Bachelor of Science in Information Technology', 300, 0, 'Rowena Tello');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `college` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(50) NOT NULL
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
(2, 'High School of the Old High school curriculum', 'Those who did not enroll in any college degree program in any other school after graduation from high school.', 80, 'Non-Board'),
(3, 'Grade 12', 'as of application period Currently enrolled as Grade 12.', 80, 'Non-Board'),
(4, 'ALS/PEPT Completers', 'Those whose ALS/PEPT Certificate of Rating indicates that they are eligible for College Admission/Rating is equivalent to Senior High and similar terms.', 80, 'Non-Board'),
(5, 'Transferees', 'Those who started college schooling in another school and intend to continue schooling in BSU.', 80, 'Non-Board'),
(6, 'Second Degree', 'Those who have already graduated from a degree program in College. This may either be Second degree (BSU graduate of a Baccalaureate program) or Second Degree-transferees (Graduates of a Baccalaureate degree from another school who will enroll another degree in BSU)', 80, 'Non-Board');

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
(1, 'BSIT', 'Non-Board', 'Bachelor of Science in Information Technology', 100),
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
(46, 'BSC', 'Board', 'Bachelor of Science in Criminology', 0),
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
(70, 'BSM', 'Non-Board', 'Bachelor of Science in Mathematics', 0),
(71, 'BSM', 'Non-Board', 'Bachelor of Science in Mathematics', 0),
(72, 'BSS', 'Non-Board', 'Bachelor of Science in Statistics', 0),
(73, 'BPA', 'Non-Board', 'Bachelor of Public Administration', 0),
(74, 'BAH', 'Non-Board', 'Bachelor of Arts in History', 0),
(80, '', '', '', 0);

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
  `email` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `logs` datetime NOT NULL DEFAULT current_timestamp(),
  `actions` varchar(50) NOT NULL
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
  `token` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `state` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'activated\r\n, pending,rejected\r\n',
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `name`, `mname`, `email`, `password`, `userType`, `status`, `token`, `created_date`, `state`, `department`) VALUES
(12, 'Puylong', 'Arjie', 'Lutong', 'puylongarjie@gmail.com', '$2y$10$FzuJ5c.C6b4jT23LlCWO1.Dq1uvl/QNNwNrakUmNMCxIjLFoQDQLm', 'Admin', 'verified', '037b20cea94c998bb0d510c0b7dbebf3', '2024-01-25 15:32:05', 'Activated', ''),
(13, 'Summit', 'Wilkins', 'sumo', 'wilkinssummit15@gmail.com', '$2y$10$dlLEqc6K6e3BkT3j.QG/F.Wy98kNEezOoVAO4RqQCmFPldJ8yw4VW', 'Staff', 'verified', '5158cd682693a7f09254d23d0de487a4', '2024-02-07 09:34:56', 'Pending', ''),
(15, 'Fish', 'JR', 'Nemo', 'mainbsu1901@gmail.com', '$2y$10$Ynzzhs6LYDIAWQ1iD1ZzG.96eLa7QII8gyHLusHLkvSfkZbG3kqZG', 'Staff', 'verified', '91863e3e030aa668b3149548d8678da2', '2024-02-14 11:19:05', 'Activated', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_data`
--
ALTER TABLE `admission_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_number` (`app_number`);

--
-- Indexes for table `appointmentdate`
--
ALTER TABLE `appointmentdate`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `ca`
--
ALTER TABLE `ca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chet`
--
ALTER TABLE `chet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chk`
--
ALTER TABLE `chk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cis`
--
ALTER TABLE `cis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cn`
--
ALTER TABLE `cn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cnas`
--
ALTER TABLE `cnas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cns`
--
ALTER TABLE `cns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`),
  ADD UNIQUE KEY `college` (`college_name`),
  ADD UNIQUE KEY `college_name` (`college_name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course` (`course`);

--
-- Indexes for table `cte`
--
ALTER TABLE `cte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_accnt`
--
ALTER TABLE `deleted_accnt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_data`
--
ALTER TABLE `admission_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointmentdate`
--
ALTER TABLE `appointmentdate`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ca`
--
ALTER TABLE `ca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `chet`
--
ALTER TABLE `chet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cn`
--
ALTER TABLE `cn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cnas`
--
ALTER TABLE `cnas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cns`
--
ALTER TABLE `cns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cte`
--
ALTER TABLE `cte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `deleted_accnt`
--
ALTER TABLE `deleted_accnt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
