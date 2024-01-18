-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 03:46 AM
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
  `phone` int(13) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `contact_person_1` varchar(50) NOT NULL,
  `contact_person_1_mobile` int(13) NOT NULL,
  `relationship_1` varchar(10) NOT NULL,
  `contact_person_2` varchar(50) DEFAULT NULL,
  `contact_person_2_mobile` int(13) DEFAULT NULL,
  `relationship_2` varchar(10) DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(50) NOT NULL,
  `als_pept_name_address` varchar(50) NOT NULL,
  `college_name_address` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `english_grade` decimal(5,2) DEFAULT NULL,
  `math_grade` decimal(5,2) DEFAULT NULL,
  `science_grade` decimal(5,2) DEFAULT NULL,
  `gwa_grade` decimal(5,2) DEFAULT NULL,
  `Rank` int(11) DEFAULT NULL,
  `Result` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_data`
--

INSERT INTO `admission_data` (`id`, `id_picture`, `applicant_name`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `nationality`, `permanent_address`, `zip_code`, `phone`, `facebook`, `email`, `contact_person_1`, `contact_person_1_mobile`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `als_pept_name_address`, `college_name_address`, `lrn`, `degree_applied`, `nature_of_degree`, `applicant_number`, `application_date`, `english_grade`, `math_grade`, `science_grade`, `gwa_grade`, `Rank`, `Result`) VALUES
(1, 0x6173736574732f75706c6f6164732f363535363136313065633135355f32783220612e706e67, 'Sabiano, Devon Lee Fagwan', 'male', '2014-06-01', 'La Trinindad', 8, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Gieberly Sawac', 'devon@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Entrepreneurship specialized in Apparel & Fashion Enterprise', 'Board', '16-11-0001', '2023-11-16', 0.00, 0.00, 0.00, 99.00, NULL, NULL),
(2, 0x6173736574732f75706c6f6164732f363535363136643435303063655f32783220612e706e67, 'Sabiano, Charmain Fagwan', 'female', '2004-02-27', 'La Trinidad', 18, 'married', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Bea Caligtan', 'char@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'fgd', 'N/A', '324535465768', 'Bachelor of Secondary Education (BSEd) Major in Science', 'Board', '16-11-0001', '2023-11-16', 88.00, 89.00, 99.00, 0.00, NULL, NULL),
(4, 0x696d6734, 'Carter, Jackson William', 'male', '2002-03-10', 'Rivertown', 21, 'single', 'British', 'British', '789 River Road', 34567, -8210, 'William Carter', 'william@gmail.com', 'Emily Carter', -1790, 'parent', 'Sophia Walker', -7335, 'sibling', 'hs_graduate', 'Rivertown High School', 'N/A', 'University of Rivertown', '765432109', 'Bachelor of Science in Agriculture Major in Agricultural Economics', 'Non-Board', '22-11-0004', '2023-11-28', 88.25, 88.00, 85.75, 99.00, 0, 'NOA'),
(5, 0x696d6735, 'Donovan, Mia Isabella', 'female', '2001-05-18', 'Harbor City', 22, 'single', 'American', 'American', '890 Harbor Street', 45678, -7099, 'Isabella Donovan', 'isabella@gmail.com', 'James Donovan', -2655, 'parent', 'Ava Donovan', -6234, 'sibling', 'college_student', 'Harbor High School', 'N/A', 'University of Harbor City', '654321098', 'Bachelor of Science in Agriculture Major in Animal Science', 'Board', '23-11-0005', '2023-12-01', 92.00, 90.00, 90.25, 91.75, NULL, ''),
(6, 0x696d6736, 'Evans, Noah Christopher', 'male', '2003-12-05', 'Mountain View', 20, 'single', 'Canadian', 'Canadian', '567 Hillside Lane', 23456, -5988, 'Christopher Evans', 'christopher@gmail.com', 'Sophie Evans', -8346, 'parent', 'Lily Evans', -3766, 'sibling', 'college_student', 'Mountain View High School', 'N/A', 'University of Mountain View', '543210987', 'Bachelor of Science in Agriculture Major in Agronomy', 'Board', '24-11-0006', '2023-12-05', 85.50, 89.00, 89.75, 88.00, NULL, ''),
(7, 0x696d6737, 'Fisher, Olivia Rose', 'female', '2000-09-28', 'Ocean City', 23, 'single', 'American', 'American', '678 Ocean Boulevard', 12345, -4877, 'Rose Fisher', 'rose@gmail.com', 'David Fisher', -1554, 'parent', 'Emma Fisher', -7335, 'sibling', 'college_graduate', 'Ocean City High School', 'N/A', 'University of Ocean City', '432109876', 'Bachelor of Science in Agriculture Major in Agronomy', 'Board', '25-11-0007', '2023-12-08', 89.75, 90.00, 88.50, 87.25, NULL, ''),
(8, 0x696d6738, 'Gonzalez, Benjamin James', 'male', '2002-11-15', 'Sunset Village', 22, 'single', 'Mexican', 'Mexican', '789 Sunset Avenue', 56789, -3766, 'James Gonzalez', 'james@gmail.com', 'Maria Gonzalez', -6234, 'parent', 'Sophia Gonzalez', -8346, 'sibling', 'college_student', 'Sunset High School', 'N/A', 'University of Sunset Village', '321098765', 'Bachelor of Science in Agriculture Major in Agronomy', 'Board', '26-11-0008', '2023-12-11', 86.25, 92.75, 87.50, 89.00, NULL, ''),
(9, 0x696d6739, 'Hall, Emma Kate', 'female', '2001-08-12', 'Meadowville', 21, 'single', 'Australian', 'Australian', '890 Meadow Lane', 23456, -2655, 'Kate Hall', 'kate@gmail.com', 'David Hall', -8210, 'parent', 'Oliver Hall', -1790, 'sibling', 'college_student', 'Meadowville High School', 'N/A', 'University of Meadowville', '210987654', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '27-11-0009', '2023-12-14', 91.50, 88.25, 92.00, 89.75, 0, 'NOA'),
(10, 0x696d673130, 'Ingram, Elijah David', 'male', '2003-04-25', 'Hilltop City', 20, 'single', 'Canadian', 'Canadian', '567 Summit Street', 34567, -1554, 'David Ingram', 'david@gmail.com', 'Sophie Ingram', -5123, 'parent', 'Ava Ingram', -6234, 'sibling', 'college_student', 'Hilltop High School', 'N/A', 'University of Hilltop City', '098765432', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '28-11-0010', '2023-12-17', 87.75, 91.75, 89.00, 88.50, NULL, ''),
(11, 0x696d673131, 'Jenkins, Ava Elizabeth', 'female', '2002-01-30', 'Maplewood', 22, 'single', 'American', 'American', '678 Maple Avenue', 45678, -9321, 'Elizabeth Jenkins', 'elizabeth@gmail.com', 'John Jenkins', -3766, 'parent', 'Sophia Jenkins', -6234, 'sibling', 'college_graduate', 'Maplewood High School', 'N/A', 'University of Maplewood', '987654321', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '29-11-0011', '2023-12-20', 93.25, 89.75, 91.00, 92.50, NULL, NULL),
(12, 0x696d673132, 'King, Samuel Ryan', 'male', '2001-07-08', 'Greenfield', 23, 'married', 'British', 'British', '789 Green Street', 56789, -8210, 'Ryan King', 'ryan@gmail.com', 'Sophia King', -1790, 'spouse', 'Emma Taylor', -6234, 'friend', 'college_graduate', 'Greenfield High School', 'N/A', 'University of Greenfield', '876543210', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', '30-11-0012', '2023-12-23', 94.50, 90.25, 95.75, 93.00, NULL, NULL),
(13, 0x696d673133, 'Lawson, Sophia Marie', 'female', '2002-09-17', 'Woodland', 20, 'single', 'Canadian', 'Canadian', '890 Wood Lane', 23456, -7099, 'Marie Lawson', 'marie@gmail.com', 'Michael Lawson', -8346, 'parent', 'Noah Lawson', -3766, 'sibling', 'college_student', 'Woodland High School', 'N/A', 'University of Woodland', '765432109', 'Bachelor of Arts in Sociology', 'Board', '31-11-0013', '2023-12-26', 90.00, 88.75, 87.25, 89.50, NULL, NULL),
(14, 0x696d673134, 'Murphy, Ethan Michael', 'male', '2003-02-12', 'Harmonyville', 21, 'single', 'American', 'American', '567 Harmony Avenue', 34567, -4877, 'Michael Murphy', 'michael@gmail.com', 'Emily Murphy', -6234, 'parent', 'Ava Murphy', -8346, 'sibling', 'college_student', 'Harmonyville High School', 'N/A', 'University of Harmonyville', '654321098', 'Bachelor of Science in Computer Engineering', 'Board', '32-11-0014', '2023-12-29', 88.75, 92.50, 89.25, 90.00, NULL, NULL),
(15, 0x696d673135, 'Nelson, Lily Marie', 'female', '2001-06-28', 'Sunnyside', 22, 'single', 'Canadian', 'Canadian', '890 Sunshine Lane', 45678, -2655, 'Marie Nelson', 'marie@gmail.com', 'David Nelson', -8210, 'parent', 'Jackson Nelson', -1790, 'sibling', 'college_graduate', 'Sunnyside High School', 'N/A', 'University of Sunnyside', '210987654', 'Master of Arts in English Literature', 'Board', '33-11-0015', '2024-01-01', 91.25, 89.00, 91.75, 90.50, NULL, NULL),
(16, 0x696d673136, 'Connor, Caleb Joseph', 'male', '2002-12-15', 'Rainbow City', 23, 'married', 'Irish', 'Irish', '678 Rainbow Street', 56789, -1554, 'Joseph O\'Connor', 'joseph@gmail.com', 'Sophie O\'Connor', -5123, 'spouse', 'Emma Taylor', -6234, 'friend', 'college_graduate', 'Rainbow City High School', 'N/A', 'University of Rainbow City', '098765432', 'Bachelor of Science in Agriculture Major in Agroforestry', 'Board', '34-11-0016', '2024-01-04', 95.00, 90.00, 94.25, 92.75, NULL, ''),
(17, 0x696d673137, 'Parker, Ava Elizabeth', 'female', '2001-11-20', 'Hillside', 20, 'single', 'American', 'American', '890 Hillcrest Lane', 23456, -8210, 'Elizabeth Parker', 'elizabeth@gmail.com', 'Michael Parker', -4877, 'parent', 'Sophia Parker', -6234, 'sibling', 'college_student', 'Hillside High School', 'N/A', 'University of Hillside', '876543210', 'Bachelor of Science in Nursing', 'Board', '35-11-0017', '2024-01-07', 89.25, 90.50, 88.00, 87.75, NULL, NULL),
(18, 0x696d673138, 'Quinn, Liam Alexander', 'male', '2003-07-08', 'Lakewood', 21, 'single', 'Canadian', 'Canadian', '567 Lakeview Avenue', 34567, -7099, 'Alexander Quinn', 'alexander@gmail.com', 'Emily Quinn', -1554, 'parent', 'Sophia Quinn', -6234, 'sibling', 'college_student', 'Lakewood High School', 'N/A', 'University of Lakewood', '765432109', 'Bachelor of Science in Mechanical Engineering', 'Board', '36-11-0018', '2024-01-10', 87.50, 91.00, 89.75, 88.25, NULL, NULL),
(19, 0x696d673139, 'Reynolds, Lily Marie', 'female', '2002-04-15', 'Oceanview', 22, 'single', 'American', 'American', '678 Ocean Lane', 45678, -2655, 'Marie Reynolds', 'marie@gmail.com', 'David Reynolds', -8210, 'parent', 'Jackson Reynolds', -1790, 'sibling', 'college_graduate', 'Oceanview High School', 'N/A', 'University of Oceanview', '210987654', 'Master of Science in Computer Science', 'Board', '37-11-0019', '2024-01-13', 92.75, 89.00, 90.50, 91.25, NULL, NULL),
(20, 0x696d673230, 'Smith, Samuel Ryan', 'male', '2001-09-28', 'Mountainville', 23, 'married', 'American', 'American', '890 Mountain Road', 56789, -4877, 'Ryan Smith', 'ryan@gmail.com', 'Sophia Smith', -6234, 'spouse', 'Emma Taylor', -1554, 'friend', 'college_graduate', 'Mountainville High School', 'N/A', 'University of Mountainville', '987654321', 'Doctor of Dental Medicine', 'Board', '38-11-0020', '2024-01-16', 94.00, 90.25, 95.00, 92.50, NULL, NULL),
(27, 0x6173736574732f75706c6f6164732f363536303463616562303534615f64656661756c742d6176617461722d70686f746f2d706c616365686f6c6465722d69636f6e2d677265792d766563746f722d33383539343339342e6a7067, 'Itsu, Jessa 2134', 'male', '2001-09-19', 'La Trinindad', 21, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Gieberly Sawac', 'jessa@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Senior High School Graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Agriculture (BSA)', 'Non-board', '24-11-0001', '2023-11-24', 0.00, 0.00, 0.00, 99.00, NULL, NULL);

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
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'staff'
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
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `Department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userType`, `status`, `Department`) VALUES
(1, 'Gieberly F. Sawac', 'gieberlycious@gmail.com', '$2y$10$Bs05CM.xJVukJxeVTyujCeztfDihfFm/LWIXFn9R1KkuMLQkFYv7y', 'admin', 'pending', NULL),
(20, 'Jeshen Sap-ay Licangen', 'jeshen@gmail.com', '$2y$10$HH/lteOaVezT6/TBwGwCeOjJfj0F22AW3SHHHvSDc.easeEImG/jK', 'staff', 'approved', NULL),
(80, 'Devon Lee Sabiano', 'devon@gmail.com', '$2y$10$L0rmGOj9ZDZDjHMN9wm3EepoQX/3krVYeEfeM.qJGRnFVlHB5UhGu', 'student', 'pending', NULL),
(81, 'Gieberly Sawac', 'sawac.gieberly99@gmail.com', '$2y$10$PlOSgzveGcB/is7EjEcUNOv2AG/zB4c5ESSwu8mUvSQB4qmrnV2Be', 'student', 'approved', NULL),
(86, 'Sawac, Gieberly Fagwan', 'gieberly@gmail.com', '$2y$10$ceyP/Nz/p3Voib5Wep5QrOMP/as9g2KpjxlFglcCQjg9qTQ1omrJa', 'Faculty', 'pending', 'Bachelor of Science in Criminology');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

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
-- AUTO_INCREMENT for table `admission_data`
--
ALTER TABLE `admission_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `applicationdate`
--
ALTER TABLE `applicationdate`
  MODIFY `ApplicationDateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `ProgramID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `reapplication`
--
ALTER TABLE `reapplication`
  MODIFY `StepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
