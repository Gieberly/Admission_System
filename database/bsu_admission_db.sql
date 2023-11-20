-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 11:11 AM
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
(1, 0x6173736574732f75706c6f6164732f363535363635633061313563325f323139333434302e706e67, 'Sabiano, Jones Fagwan', 'female', '2008-01-05', 'La Trinindad', 14, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Bea Caligtan', 'jones@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'hs_graduate', 'King\'s College of The Philippines', 'N/A', 'N/A', '324535465768', 'Bachelor of Secondary Education (BSEd) Major in Social Studies', 'Board', '17-11-0001', '2023-11-16', 88.00, 88.00, 88.00, 99.00, 0, 'NOA'),
(2, 0x6173736574732f75706c6f6164732f363535363136643435303063655f32783220612e706e67, 'Sabiano, Charmain Fagwan', 'female', '2004-02-27', 'La Trinidad', 18, 'married', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Bea Caligtan', 'char@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'fgd', 'N/A', '324535465768', 'Bachelor of Secondary Education (BSEd) Major in Science', 'Board', '16-11-0001', '2023-11-16', 0.00, 0.00, 0.00, 0.00, 0, 'NOR'),
(3, 0x6173736574732f75706c6f6164732f363535363136313065633135355f32783220612e706e67, 'Sabiano, Devon Lee Fagwan', 'male', '2014-06-01', 'La Trinindad', 8, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Gieberly Sawac', 'devon@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Entrepreneurship specialized in Apparel & Fashion Enterprise', 'Non-board', '16-11-0001', '2023-11-16', 0.00, 0.00, 0.00, 87.00, 0, 'NOA'),
(28, 0x6173736574732f75706c6f6164732f363535383062313633363636635f32783220612e706e67, 'Bacasen, Ivan Fagwan', 'male', '2020-10-08', 'La Trinindad', 2, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Gieberly Sawac', 'ivan@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'shs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Secondary Education (BSEd) Major in Social Studies', 'Board', '18-11-0001', '2023-11-18', 99.00, 89.00, 87.00, 0.00, NULL, 'NOR'),
(29, 0x6173736574732f75706c6f6164732f363535616130343335656365395f32783220612e706e67, 'Bacasen, Zion Fagwan', 'male', '2000-05-11', 'La Trinindad', 22, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Bea Caligtan', 'zion@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'shs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Nutrition and Dietetics', 'Non-board', '20-11-0001', '2023-11-19', 0.00, 0.00, 0.00, 99.00, NULL, NULL);

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
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(500) NOT NULL,
  `TotalSlots` int(11) NOT NULL,
  `AvailableSlots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`, `TotalSlots`, `AvailableSlots`) VALUES
(27, 'Bachelor of Science in Biology', 66, 66),
(28, 'dgtfrydtru', 445, 55),
(29, 'ewrw', 1, 1),
(30, 'dgtfrydtru', 55, 44),
(31, 'fwre ybbn', 44, 44),
(32, 'rety', 44, 44);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_staff`
--

CREATE TABLE `deleted_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
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
(10, 'bakit?', 'wqre');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userType`, `status`) VALUES
(1, 'Gieberly F. Sawac', 'gieberlycious@gmail.com', '$2y$10$Bs05CM.xJVukJxeVTyujCeztfDihfFm/LWIXFn9R1KkuMLQkFYv7y', 'admin', 'pending'),
(40, 'Jeffrey De la Torre', 'jeff@gmail.com', '$2y$10$gq/BO7onAkC/0qN0SKLiOOA6DRJUd5/iupZFhMrAfO2X/yJ4b/Ea2', 'staff', 'approved'),
(46, 'Jeshen Sap-ayen Licangen', 'jeshen@gmail.com', '$2y$10$3H9i5jkIzWmhDZXSwqeAy.Odw5RP.B4kzFuo7fbsG2v44l83t5LBu', 'staff', 'approved'),
(48, 'Giely', 'giely@gmail.com', '$2y$10$EOmZepgmETy1HooN08oOt.NOVnQbl3smtCNGsGlafxGO7sFkgZ8T2', 'student', 'approved'),
(49, 'Devon Lee Sabiano', 'devon@gmail.com', '$2y$10$1F52J0AH7k906Yan3U.qjO1UZ8CQ8XaNuq4a90Q1SRkDwv0A.nsAK', 'student', 'approved'),
(50, 'Charmain Pangit', 'char@gmail.com', '$2y$10$D4tJbg.RkcIk1aZ62G.Uq.L4OiAQbg1OXsJjqIxJkYQIiFRt0EE3a', 'student', 'approved'),
(52, 'Jones Sabiano', 'jones@gmail.com', '$2y$10$Cqom4nDbGEveQT9FxbCvuuulzTWsmO8xqri.g8CZgTI2s7SitPafy', 'student', 'approved'),
(53, 'Anthonio Sabiano', 'antonio@gmail.com', '$2y$10$fZYJRhQ3OKr21G5y1PBygepBs6Z.v7xfUV3H9iloV2OCTxeyd8.92', 'student', 'approved'),
(54, 'Ivan Bacasen', 'ivan@gmail.com', '$2y$10$5mW3zryh0FRzFv9MqL9Ov.TfdRYb5sP8usmPkivO9t0bPXL5xUYiq', 'student', 'approved'),
(55, 'Chad Bacasen', 'chad@gmail.com', '$2y$10$eQhS833dk45Lmg9WuNkXk.TubOa884ga3KkPYkiks.o..b5SECdMG', 'student', 'pending'),
(56, 'Zion Bacasen', 'zion@gmail.com', '$2y$10$.AMQfkC3bdaTiXRhWuk03u30J.rQEFedIN3XUNZno5RfrbQMdf2Fm', 'student', 'pending'),
(57, 'Jeffrey De la Torre', 'jeffy@gmail.com', '$2y$10$v8NUrdqrSvVKKIG4e22NfOqYmOeep/VgHYh/RG9Is848RKutf.g7a', 'staff', 'approved'),
(58, 'Giely Bons', 'jeffey@gmail.com', '$2y$10$CyV0kGZKvtPNPbP3.05peOyREFhva4Y4rwLJgdU6wbixNBoEUZHX6', 'student', 'approved'),
(59, 'Gieberly Sawac', 'g@gmail.com', '$2y$10$7.Z25E4aX0nvBrYj.dbbNON4W9GczC/TJrPHjOX86qOHKdGElVYk6', 'staff', 'pending'),
(60, 'Gieberly Sawac', 'd@gmail.com', '$2y$10$fyUrbP8AzmAnr81o7CRn5OO2yVT/t15QBq49gU/CEMACVH4fFfzAq', 'staff', 'approved'),
(61, 'Gieberly Sawac', 'gieb@gmail.com', '$2y$10$8rt07RZ.aEWpJ8atgVK./erc9GRMcM0QzFdgo.GuNJ4NuzCT02x6e', 'staff', 'pending'),
(62, 'Jeffrey De la Torre', 'giebe@gmail.com', '$2y$10$Mrxosl9qEfNIBWv411Y3.eRZBRPypKgJMg7hUbWTbG3nMVEmYs.6y', 'student', 'approved');

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
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `deleted_staff`
--
ALTER TABLE `deleted_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `applicationdate`
--
ALTER TABLE `applicationdate`
  MODIFY `ApplicationDateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `deleted_staff`
--
ALTER TABLE `deleted_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reapplication`
--
ALTER TABLE `reapplication`
  MODIFY `StepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
