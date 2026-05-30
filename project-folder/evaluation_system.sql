-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2026 at 01:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(2) NOT NULL,
  `registration_no` varchar(10) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `registration_no`, `full_name`, `password`) VALUES
(1, 'ADMIN2026', 'System Administrator', '$2y$10$.3Jgyp3R6/QFUd4p.ucQAuGN0jAEco9JDAV7X/anzBVhGU7jGQpZO');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(5) NOT NULL,
  `student_reg_no` varchar(10) NOT NULL,
  `teacher_reg_no` varchar(10) NOT NULL,
  `clarity` int(1) DEFAULT NULL,
  `interaction` int(1) DEFAULT NULL,
  `organization` int(1) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subjectID` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `student_reg_no`, `teacher_reg_no`, `clarity`, `interaction`, `organization`, `comment`, `created_at`, `subjectID`) VALUES
(1, '2023123456', 'TCH1001', 5, 4, 5, '', '2026-02-13 11:05:36', 'SUB01'),
(2, '2023123456', 'TCH1007', 2, 3, 5, '', '2026-02-13 11:05:48', 'SUB07'),
(3, '2023123456', 'TCH1009', 5, 2, 3, '', '2026-02-13 11:05:56', 'SUB09'),
(4, '2023123456', 'TCH1008', 4, 5, 3, '', '2026-02-13 11:06:04', 'SUB08'),
(5, '2023123456', 'TCH1013', 4, 5, 5, '.', '2026-02-13 11:06:27', 'SUB13'),
(6, '2023123456', 'TCH1014', 2, 5, 4, '', '2026-02-13 11:06:51', 'SUB14'),
(7, '2023123457', 'TCH1004', 1, 1, 1, '', '2026-02-13 11:47:37', 'SUB04'),
(8, '2023123458', 'TCH1012', 5, 5, 5, '2', '2026-02-13 11:48:56', 'SUB12'),
(9, '2023123459', 'TCH1006', 3, 4, 3, '', '2026-02-13 11:50:50', 'SUB06'),
(10, '2023123457', 'TCH1005', 4, 4, 5, '', '2026-02-13 11:52:03', 'SUB05'),
(11, '2023123456', 'TCH1006', 5, 5, 5, '', '2026-02-13 11:53:10', 'SUB06'),
(12, '2023123458', 'TCH1013', 1, 1, 1, '', '2026-02-13 11:54:26', 'SUB13'),
(13, '2023123458', 'TCH1014', 1, 1, 1, '', '2026-02-13 11:54:33', 'SUB14'),
(14, '2023123457', 'TCH1013', 5, 3, 4, '..', '2026-03-02 12:12:35', 'SUB13');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(6) NOT NULL,
  `registration_no` varchar(10) NOT NULL,
  `password` varchar(60) NOT NULL,
  `full_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `registration_no`, `password`, `full_name`) VALUES
(1, '2023123456', '$2y$10$bVBm4V6ukIPkXHjYLflDEemxZfmVj3Z/.wtKYn9TIgD/i6/jn6BE.', 'Ali Ben Ahmed'),
(2, '2023123457', '$2y$10$n.t3Kfbq4jInbvVRcDT6K.kb9fWKW43E8v3K3unJCPNtNmsicF0M.', 'Sara Bensaid'),
(3, '2023123458', '$2y$10$vMu0ktm/g53IlNHCPiUeLOnxrtnzY/CyzRbhae0BLjmqBHcYL8OWu', 'Omar Haddad'),
(4, '2023123459', '$2y$10$5rKDec3vBp0WBCQI6prrxOra2RkJcWIFyowbH9LlYQtc2C6KJ0W2i', 'Mohamed Sami');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectID` varchar(6) NOT NULL,
  `subName` varchar(50) NOT NULL,
  `subType` varchar(5) NOT NULL,
  `semester` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `subName`, `subType`, `semester`) VALUES
('SUB01', 'Compilers', 'Cours', 'S5'),
('SUB02', 'Compilers', 'TD', 'S5'),
('SUB03', 'Compilers', 'TP', 'S5'),
('SUB04', 'Operating systems', 'Cours', 'S5'),
('SUB05', 'Operating systems', 'TD', 'S5'),
('SUB06', 'Operating systems', 'TP', 'S5'),
('SUB07', 'Human-Computer Interface', 'Cours', 'S5'),
('SUB08', 'Human-Computer Interface', 'TD', 'S5'),
('SUB09', 'Human-Computer Interface', 'TP', 'S5'),
('SUB10', 'Software engineering', 'Cours', 'S5'),
('SUB11', 'Software engineering', 'TD', 'S5'),
('SUB12', 'Software engineering', 'TP', 'S5'),
('SUB13', 'Probabilities and statistics', 'Cours', 'S5'),
('SUB14', 'Probabilities and statistics', 'TD', 'S5'),
('SUB15', 'Linear programming', 'Cours', 'S5'),
('SUB16', 'Linear programming', 'TD', 'S5'),
('SUB17', 'Digital economy', 'Cours', 'S5');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(5) NOT NULL,
  `registration_no` varchar(10) NOT NULL,
  `password` varchar(60) NOT NULL,
  `full_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `registration_no`, `password`, `full_name`) VALUES
(1, 'TCH1001', '$2y$10$j64C4kxdFwMDbOuWYjdIVOAuTMliCfvqZF9k1so0dtKLEer0EM8mq', 'Dr. Kherici'),
(2, 'TCH1002', '$2y$10$3Mtws/JV2ldsNYXFG2G7DeMSx10c.jl7UBxieDNOTlganX66SxJxS', 'Dr. Amrane'),
(3, 'TCH1003', '$2y$10$4ThsIB7/956il4UbDIRLhOzPVM/csIk1TqXtGnv6Jceb/lS9csr9S', 'Dr. Debbache'),
(4, 'TCH1004', '$2y$10$3JcB0A/xm5BLFC5STe6Th.nHIdGb6lxOSUZOF3SeP9keX4iX8Mvim', 'Pr. Farah'),
(5, 'TCH1005', '$2y$10$.qVAH4kYiD9m.ucsQyuY3OYhmUVMly.NQzIJobLo6x2EAPgo5CcP.', 'Dr. Bouhaouche'),
(6, 'TCH1006', '$2y$10$0.N4DDtRJXi/Kp/5fbXc5uTVVqZCeCt2ebdfDC/BCINfWRUlKuCbm', 'Dr. Bouhaouche'),
(7, 'TCH1007', '$2y$10$IUaUo9rmHqg6gtn/vxCgr.iIgmwtsjScatnYUwDqgm3q9W3vvnGLy', 'Dr. Rouabhia'),
(8, 'TCH1008', '$2y$10$pcKQRwLzWEgWFueUXnnAiOZD.DcqNbko/.eJzHZDoNH5Pzr8vmW5i', 'Dr. Rouabhia'),
(9, 'TCH1009', '$2y$10$tMduXX9esWr.zLkas0PsM.zamedZ5SAV3oNG.9.ayRZKhWTgUsMJC', 'Dr. Rouabhia'),
(10, 'TCH1010', '$2y$10$gIDzDvq8D8updQ7II9XYeeOlOo/VZDWfthkaB0vm8T7QP/i5Y3uZi', 'Dr. Layachi'),
(11, 'TCH1011', '$2y$10$rTgE2u1kG7jesINA32R6L.wJf.swQ6Wszfhdkx9yKPRBeR.ww1Ldq', 'Dr. Menghour'),
(12, 'TCH1012', '$2y$10$aRnMGbUur2V7WNks2ygzy.w7onZfekWmUNfVQ2E0vyQOAQ0IyNEH6', 'Dr. Berrezzek'),
(13, 'TCH1013', '$2y$10$35V/pP6F5XlSRc25bu4MP.OfZsRqI8bbfg/9mXrgUS7pD5VHCHqsW', 'Dr. Chouia'),
(14, 'TCH1014', '$2y$10$Do8Y98l/d8qQPqcqzXCDce1CAfGNglFoRdgd4lmnXI3l3A1lts.bu', 'Dr. Chouia'),
(15, 'TCH1015', '$2y$10$O9u3HxL7fhM6I1ZISIhkRebfcMSlD8/P9tUmBWKNgRDQ2icxH4EAS', 'Dr. Sobhi'),
(16, 'TCH1016', '$2y$10$xKiOiqQyWQK/tu1ixpYIYelQBPI/YZcB9rTFqYgH1g5jOEA75M5x6', 'Dr. Hamissi'),
(17, 'TCH1017', '$2y$10$hZ/jwCUGxx9lwEu.9GpohOOgiBkIXwS7K2Li0IUNq16ejF6ZBT2B.', 'Mme. Babes N');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `teacher_reg_no` varchar(10) NOT NULL,
  `subjectID` varchar(6) NOT NULL,
  `AcademicYear` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`teacher_reg_no`, `subjectID`, `AcademicYear`) VALUES
('TCH1001', 'SUB01', '2025/2026'),
('TCH1002', 'SUB02', '2025/2026'),
('TCH1003', 'SUB03', '2025/2026'),
('TCH1004', 'SUB04', '2025/2026'),
('TCH1005', 'SUB05', '2025/2026'),
('TCH1006', 'SUB06', '2025/2026'),
('TCH1007', 'SUB07', '2025/2026'),
('TCH1008', 'SUB08', '2025/2026'),
('TCH1009', 'SUB09', '2025/2026'),
('TCH1010', 'SUB10', '2025/2026'),
('TCH1011', 'SUB11', '2025/2026'),
('TCH1012', 'SUB12', '2025/2026'),
('TCH1013', 'SUB13', '2025/2026'),
('TCH1014', 'SUB14', '2025/2026'),
('TCH1015', 'SUB15', '2025/2026'),
('TCH1016', 'SUB16', '2025/2026'),
('TCH1017', 'SUB17', '2025/2026');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_no` (`registration_no`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_no` (`registration_no`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_no` (`registration_no`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`teacher_reg_no`,`subjectID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`subjectID`);

--
-- Constraints for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `teacher_subject_ibfk_1` FOREIGN KEY (`teacher_reg_no`) REFERENCES `teachers` (`registration_no`),
  ADD CONSTRAINT `teacher_subject_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`subjectID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
