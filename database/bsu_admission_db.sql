-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 12:27 AM
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
(10, 0x75706c6f6164732f363535333530636136623632375f32783220612e706e67, 'Doe, Jane Florence', 'female', '1975-04-22', 'La Trinindad', 47, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Jane Doe', 'jane@gmail.com', 'Doe,John Florence', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'hs_graduate', 'King\'s College of The Philippines', 'N/A', 'N/A', '324535465768', 'Bachelor of Technology and Livelihood Education Major in Agri-Fisheries', 'Board', '14-11-0001', '2023-11-14', 99.00, 89.00, 99.00, 0.00, NULL, NULL),
(11, 0x75706c6f6164732f363535333562376137613262635f32783220612e706e67, 'Doe, John Florence', 'male', '2000-05-09', 'La Trinindad', 22, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Bea Caligtan', 'john@gmail.com', 'Gieberly', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'als_pept_passer', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor in Physical Education', 'Non-board', '14-11-0001', '2023-11-14', 0.00, 0.00, 0.00, 88.00, NULL, NULL),
(12, 0x75706c6f6164732f363535333630613035323765655f32783220612e706e67, 'Doe, Juan Florence', 'female', '2000-02-02', 'La Trinindad', 22, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'JuanDoe', 'a@gmail.com', 'Sawac', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'shs_graduate', 'King\'s College of The Philippines', 'N/A', 'N/A', '324535465768', 'Bachelor of Secondary Education (BSEd) Major in Mathematics', 'Board', '14-11-0001', '2023-11-14', 88.00, 88.00, 99.00, 0.00, NULL, NULL),
(13, 0x75706c6f6164732f363535333631393764653534395f32783220612e706e67, 'Bona, Giely Juan', 'female', '2000-05-11', 'La Trinindad', 22, 'married', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Giely Bona', 'giely@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Gieberly', 2147483647, 'guardian', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Information Technology (BSIT)', 'Non-board', '14-11-0001', '2023-11-14', 0.00, 0.00, 0.00, 89.00, NULL, NULL),
(14, 0x75706c6f6164732f363535333633636536303261635f32783220612e706e67, 'Mouse, Micky Theodore', 'male', '2001-06-08', 'La Trinindad', 21, 'single', 'Filipino', 'Filipino', 'Simpa', 2604, 2147483647, 'Juan Cruz', 'micky@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'hs_graduate', 'King\'s College of The Philippines', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Entrepreneurship specialized in Apparel & Fashion Enterprise', 'Non-board', '14-11-0001', '2023-11-14', 0.00, 0.00, 0.00, 89.00, NULL, NULL),
(15, 0x75706c6f6164732f363535333661356133386635645f32783220612e706e67, 'Cat, Thomas Jasper', 'female', '2000-05-11', 'La Trinidad', 22, 'married', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'gieb', 'thomas@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'transferee', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Arts in Communication', 'Non-board', '14-11-0001', '2023-11-14', 0.00, 0.00, 0.00, 80.00, NULL, NULL),
(16, 0x75706c6f6164732f363535333939613839346338385f32783220612e706e67, 'Sawac, Sawac, Gieberly Fagwan nfx', 'female', '2000-05-11', 'La Trinindad', 22, 'single', 'wr', 'wrg', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'w', 'y@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'hs_graduate', 'King\'s College of The Philippines', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Food Technology', 'Non-board', '14-11-0001', '2023-11-14', 0.00, 0.00, 0.00, 89.00, NULL, NULL),
(17, 0x75706c6f6164732f363535333962303834373933665f32783220612e706e67, 'Sawac, Sawac, Gieberly Fagwan ryy', 'female', '2000-05-11', 'La Trinindad', 22, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'JuanDoe', 'mas@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'Gieberly', 2147483647, 'parent', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Entrepreneurship specialized in Food Enterprise', 'Non-board', '15-11-0001', '2023-11-14', 0.00, 0.00, 0.00, 80.00, NULL, NULL),
(18, 0x75706c6f6164732f363535336230646662663331375f32783220612e706e67, 'Sawac, Sawac, Gieberly Fagwan erer', 'female', '2000-05-11', 'La Trinindad', 22, 'married', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Bea Caligtan', 'a@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'Gieberly', 2147483647, 'guardian', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'fgd', 'N/A', '324535465768', 'Bachelor of Science in Food Technology', 'Non-board', '15-11-0001', '2023-11-14', 0.00, 0.00, 0.00, 99.00, NULL, NULL),
(19, 0x75706c6f6164732f363535336231373835393330375f327832207369676e61747572652e706e67, 'Sawac, Sawac, Gieberly Fagwan gsf', 'female', '2000-05-11', 'La Trinindad', 22, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'JuanDoe', '586@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Gieberly', 2147483647, 'guardian', 'als_pept_passer', 'King\'s College of The Philippines', 'N/A', 'N/A', '324535465768', 'Bachelor of Library and Information Science (BLIS)', 'Non-board', '15-11-0001', '2023-11-14', 0.00, 0.00, 0.00, 89.00, NULL, NULL),
(20, 0x75706c6f6164732f363535343062363266336532635f32783220612e706e67, 'Bunny, Bugs Rabbit', 'male', '1979-01-21', 'La Trinindad', 43, 'single', 'Filipino', 'Filipino', 'Simpa', 2604, 2147483647, 'Bea Caligtan', 'a@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Secondary Education (BSEd) Major in English', 'Board', '15-11-0001', '2023-11-15', 88.00, 88.00, 89.00, 0.00, NULL, NULL),
(21, 0x75706c6f6164732f363535343239346436303463385f32783220612e706e67, 'Duck, Duffy Ling', 'female', '2000-05-11', 'La Trinindad', 22, 'single', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'JuanDoe', 'duffy@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'Gieberly', 2147483647, 'parent', 'shs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Nutrition and Dietetics', 'Non-board', '15-11-0001', '2023-11-15', 0.00, 0.00, 0.00, 99.00, NULL, NULL),
(22, 0x75706c6f6164732f363535343261623962366461385f32783220612e706e67, 'Doo, Scooby Dog', 'male', '2000-01-12', 'La Trinindad', 22, 'married', 'Filipino', 'Filipino', 'Simpa Ampucao Itogon Benguet', 2604, 2147483647, 'Bea Caligtan', 'doo@gmail.com', 'Sawac, Gieberly Fagwan', 2147483647, 'guardian', 'Sawac, Gieberly Fagwan', 2147483647, 'parent', 'hs_graduate', 'Simpa Ampucao Itogon Benguet', 'N/A', 'N/A', '324535465768', 'Bachelor of Science in Food Technology', 'Non-board', '15-11-0001', '2023-11-15', 0.00, 0.00, 0.00, 99.00, NULL, NULL),
(23, 0x75706c6f6164732f363535346236613939303062635f696d726573697a65722d313639393137373337383430302e706e67, 'Gieberly, Gieberly Fagwan', 'female', '2000-05-11', 'La Trinidad,', 22, 'married', 'Filipino', 'Filipino', 'Simpa', 2604, 2147483647, 'gieb', 'main@gmail.com', 'Gieberly', 2147483647, 'parent', 'Gieberly', 2147483647, 'guardian', 'als_pept_passer', 'Ampucao', 'adef', 'bsu', '094598522224', 'Bachelor of Science in Entrepreneurship specialized in Apparel & Fashion Enterprise', 'Non-board', '15-11-0001', '2023-11-15', 0.00, 0.00, 0.00, 99.00, NULL, NULL),
(24, 0x75706c6f6164732f363535346632666434623965615f696d726573697a65722d313639393137373337383430302e706e67, 'Gieberly, Gieberly rg', 'female', '2000-05-11', 'La Trinidad,', 22, 'single', 'Filipino', 'Filipino', 'Simpa', 2604, 2147483647, 'gieb', 'juana@gmail.com', 'Gieberly', 2147483647, 'guardian', 'Gieberly', 2147483647, 'parent', 'vocational_completers', 'Ampucao', 'adef', 'bsu', '325547658657', 'Bachelor of Science in Food Technology', 'Non-board', '16-11-0001', '2023-11-15', 0.00, 0.00, 0.00, 88.00, NULL, NULL);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userType`, `status`) VALUES
(13, 'Jane Doe', 'jane@gmail.com', '$2y$10$kfv514nhDoQWxEMM5/jstuV0OeBDGkN4i7d47aSqNsKxjiA7Ej6iy', 'student', 'pending'),
(14, 'John Doe', 'john@gmail.com', '$2y$10$f9G2cmLz64SzSL64yh3ENuAjMVvOlV7bzovUwNR9hfntO3.pcVIBa', 'student', 'pending'),
(15, 'Juan Doe', 'juan@gmail.com', '$2y$10$gNZj3s9gpbvFgIWHw87NoeCgtOWjT/cHkzetT1M2UMK6YULefuqGS', 'student', 'pending'),
(16, 'Giely Bona', 'giely@gmail.com', '$2y$10$xaUrvLelgEfrxzsUgF80GuFDpARPms6rkYMmHdNeMHptl5EKZvyzW', 'student', 'pending'),
(17, 'Micky Mouse', 'micky@gmail.com', '$2y$10$C1eA4AGiTFSDjNvB5BuGYeuKC1FqC5EEGLZnocKn.H81yE3zMGDWO', 'student', 'pending'),
(18, 'Thomas Cat', 'thomas@gmail.com', '$2y$10$pQdeyz15PCsi211U/XSpzeMOmAktIdo2z3MGFoeZ/ymlCvKMoBeDm', 'student', 'pending'),
(19, 'Gieberly Sawac', 'gieberlycious@gmail.com', '$2y$10$Bs05CM.xJVukJxeVTyujCeztfDihfFm/LWIXFn9R1KkuMLQkFYv7y', 'admin', 'pending'),
(20, 'Jeshen Sap-ay Licangen', 'jeshen@gmail.com', '$2y$10$HH/lteOaVezT6/TBwGwCeOjJfj0F22AW3SHHHvSDc.easeEImG/jK', 'staff', 'Approve'),
(21, 'Arjie Puylong', 'arjie@gmail.com', '$2y$10$m5EPd4jI/a91NFegmOeFSuhGgv.RLeSH9tyCOhRzuCghiDb8K/ZQG', 'staff', 'Pending'),
(22, 'Jessa Itsu', 'jessa@gmail.com', '$2y$10$oCpPSkYCW9L0bqASh6zfOuJOUGDdXTfcJB6jCTnVWFhB1cv.Y8Bre', 'staff', 'Approve'),
(24, 'Random Fun Facts', 'y@gmail.com', '$2y$10$OeVoWED6pFnRqlffZ5bKT.R1GzEsyT7IhfYjqQVAfgNyGqwHBFqm6', 'student', 'pending'),
(25, 'Gieberly Lee', 'mas@gmail.com', '$2y$10$.wPVrwTWIdVJ.hWj9fM24eas60ZEGSmNZPFwaLC8AJFm7xrJMO1t2', 'student', 'pending'),
(26, 'Giely Bons', 'gieber@gmail.com', '$2y$10$J008p/TEnCAS7c0Z1f8M7.WCOBy02nbJYZk/OpHt4gh9J2UagIPjS', 'student', 'pending'),
(27, 'Giely Bo Gie', 'viey@gmail.com', '$2y$10$GBTs1NrEqY73meZGHlC5gesbJlo1hc1KiQm.Kxqvvajf58WHrk60S', 'student', 'pending'),
(28, 'Giely Bons', 'gieb@gmail.com', '$2y$10$ee4R3EVuADBAlQW5JDNGpuEi1T7poX4nX00kAU067V91wN2yh8TDW', 'student', 'pending'),
(29, 'Bugs Bunny', 'bugs@gmail.com', '$2y$10$tIzFMYc5NSc.qcv1iFfhnewaRHAuXvs8HyiiYBtjDo9hehbE1wJ96', 'student', 'pending'),
(30, 'Duffy Duck', 'duffy@gmail.com', '$2y$10$D8MEzwp0.yz8Z8zSv.5K9.Co0jPZw81sKVzj15on2cL0eulgFB8lG', 'student', 'pending'),
(31, 'Scooby Doo', 'doo@gmail.com', '$2y$10$qxwU6tUMd0PG12ZBwNbQFeiBNK8rVXVt5aAxf2TGGrNHnfvXwy5GK', 'student', 'pending'),
(33, 'Charmain Pangit', 'charmain@gmail.com', '$2y$10$.vbuRwwxPRcvbxDPYhFmxu8WYxgCplSOzJ0PzMv.HCde7bERYi8GS', 'student', 'approved'),
(34, 'Juana Jose', 'main@gmail.com', '$2y$10$AA2eRec6yJiS91YNto7u7.LRFum31qh.KZbaZw6mBjaFddhXgWhoW', 'student', 'approved'),
(35, 'Juan dela Cruz', 'juana@gmail.com', '$2y$10$CUtt8uOB5CHGuAPDQ0MbcOiGBf0dQRqk4XZRTi/hEB4b/C3ZHOw5S', 'student', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_data`
--
ALTER TABLE `admission_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_staff`
--
ALTER TABLE `deleted_staff`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `deleted_staff`
--
ALTER TABLE `deleted_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
