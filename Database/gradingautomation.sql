-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 04:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradingautomation`
--

-- --------------------------------------------------------
CREATE DATABASE gradingautomation;
--
-- Table structure for table `controlsheet`
--

CREATE TABLE `controlsheet` (
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `roll_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class_test_1` float NOT NULL DEFAULT 0,
  `class_test_2` float NOT NULL DEFAULT 0,
  `class_test_3` float NOT NULL DEFAULT 0,
  `class_test_4` float NOT NULL DEFAULT 0,
  `mid_term_1` float NOT NULL DEFAULT 0,
  `mid_term_2` float NOT NULL DEFAULT 0,
  `total_assesment` float NOT NULL DEFAULT 0,
  `end_term` float NOT NULL DEFAULT 0,
  `total_marks` float NOT NULL DEFAULT 0,
  `grade` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `controlsheet`
--

INSERT INTO `controlsheet` (`course_code`, `roll_no`, `name`, `class_test_1`, `class_test_2`, `class_test_3`, `class_test_4`, `mid_term_1`, `mid_term_2`, `total_assesment`, `end_term`, `total_marks`, `grade`) VALUES
('CSL-258', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 60, 40, 100, ''),
('CSL-258', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-258', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-258', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-258', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSL-253', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 60, 40, 100, ''),
('CSL-253', 'BT19CSE002', 'Anupam Panwar', 9.5, 8, 0, 0, 18, 19, 54.5, 38, 92.5, ''),
('CSL-253', 'BT19CSE003', 'Neha Dhyani', 9.5, 9.5, 0, 0, 19, 18.5, 56.5, 38, 94.5, ''),
('CSL-253', 'BT19CSE011', 'Purvi Goyal', 9, 8, 0, 0, 18, 19.5, 54.5, 38.5, 93, ''),
('CSL-253', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9.5, 0, 0, 19, 18.5, 57, 37, 94, ''),
('CSL-255', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 60, 40, 100, ''),
('CSL-255', 'BT19CSE002', 'Anupam Panwar', 9, 9, 0, 0, 18, 20, 56, 37, 93, 'AA'),
('CSL-255', 'BT19CSE003', 'Neha Dhyani', 9.5, 8.5, 0, 0, 18, 18.5, 54.5, 38.5, 93, 'AA'),
('CSL-255', 'BT19CSE011', 'Purvi Goyal', 9, 8.5, 0, 0, 17.5, 19, 54, 38, 92, 'AA'),
('CSL-255', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 8.5, 0, 0, 18, 19.5, 56, 36.5, 92.5, 'AA'),
('CSP-253', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 0, 40, 100, ''),
('CSP-253', 'BT19CSE002', 'Anupam Panwar', 9.5, 8, 0, 0, 18, 19, 0, 38, 0, ''),
('CSP-253', 'BT19CSE003', 'Neha Dhyani', 9.5, 9.5, 0, 0, 19, 18.5, 0, 38, 0, ''),
('CSP-253', 'BT19CSE011', 'Purvi Goyal', 9, 8, 0, 0, 18, 19.5, 0, 38.5, 0, ''),
('CSP-253', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9.5, 0, 0, 19, 18.5, 0, 37, 0, ''),
('CSL-251', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 0, 40, 100, ''),
('CSL-251', 'BT19CSE002', 'Anupam Panwar', 9, 9, 0, 0, 18, 20, 0, 37, 0, ''),
('CSL-251', 'BT19CSE003', 'Neha Dhyani', 9.5, 8.5, 0, 0, 18, 18.5, 0, 38.5, 0, ''),
('CSL-251', 'BT19CSE011', 'Purvi Goyal', 9, 8.5, 0, 0, 17.5, 19, 0, 38, 0, ''),
('CSL-251', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 8.5, 0, 0, 18, 19.5, 0, 36.5, 0, ''),
('CSL-252', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 0, 40, 100, ''),
('CSL-252', 'BT19CSE002', 'Anupam Panwar', 9.5, 8, 0, 0, 18, 19, 0, 38, 0, ''),
('CSL-252', 'BT19CSE003', 'Neha Dhyani', 9.5, 9.5, 0, 0, 19, 18.5, 0, 38, 0, ''),
('CSL-252', 'BT19CSE011', 'Purvi Goyal', 9, 8, 0, 0, 18, 19.5, 0, 38.5, 0, ''),
('CSL-252', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9.5, 0, 0, 19, 18.5, 0, 37, 0, ''),
('CSL-257', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 60, 40, 100, ''),
('CSL-257', 'BT19CSE002', 'Anupam Panwar', 9, 9, 0, 0, 18, 20, 56, 37, 93, ''),
('CSL-257', 'BT19CSE003', 'Neha Dhyani', 9.5, 8.5, 0, 0, 18, 18.5, 54.5, 38.5, 93, ''),
('CSL-257', 'BT19CSE011', 'Purvi Goyal', 9, 8.5, 0, 0, 17.5, 19, 54, 38, 92, ''),
('CSL-257', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 8.5, 0, 0, 18, 19.5, 56, 36.5, 92.5, ''),
('MEL-151', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 0, 40, 100, ''),
('MEL-151', 'BT19CSE002', 'Anupam Panwar', 9, 9, 0, 0, 18, 20, 0, 37, 0, ''),
('MEL-151', 'BT19CSE003', 'Neha Dhyani', 9.5, 8.5, 0, 0, 18, 18.5, 0, 38.5, 0, ''),
('MEL-151', 'BT19CSE011', 'Purvi Goyal', 9, 8.5, 0, 0, 17.5, 19, 0, 38, 0, ''),
('MEL-151', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 8.5, 0, 0, 18, 19.5, 0, 36.5, 0, ''),
('MEP-151', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 0, 40, 100, ''),
('MEP-151', 'BT19CSE002', 'Anupam Panwar', 9.5, 8, 0, 0, 18, 19, 0, 38, 0, ''),
('MEP-151', 'BT19CSE003', 'Neha Dhyani', 9.5, 9.5, 0, 0, 19, 18.5, 0, 38, 0, ''),
('MEP-151', 'BT19CSE011', 'Purvi Goyal', 9, 8, 0, 0, 18, 19.5, 0, 38.5, 0, ''),
('MEP-151', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9.5, 0, 0, 19, 18.5, 0, 37, 0, ''),
('CSL-307', '', 'Maximim Marks', 10, 10, 0, 0, 20, 20, 60, 40, 100, ''),
('CSL-307', 'BT19CSE002', 'Anupam Panwar', 10, 10, 0, 0, 10, 10, 40, 10, 50, ''),
('CSL-307', 'BT19CSE003', 'Neha Dhyani', 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('CSL-307', 'BT19CSE011', 'Purvi Goyal', 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('CSL-307', 'BT19CSE020', 'Priyanshu Upadhyay', 0, 0, 0, 0, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(20) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `semester`, `batch`) VALUES
(3, 'Data Structures', 'CSL-251', 'Odd Semester-2020', '2017'),
(3, 'Operating System', 'CSL-252', 'Odd Semester-2020', '2019'),
(2, 'Object Oriented Design', 'CSL-253', 'Odd Semester-2020', '2020'),
(1, 'Computer Networks', 'CSL-255', 'Even Semester-2021', '2018'),
(1, 'Data Communication', 'CSL-257', 'Odd Semester-2020', '2019'),
(1, 'Computer Organistaion', 'CSL-258', 'Even Semester-2021', '2020'),
(5, 'Software Engineering', 'CSL-307', 'Even Semester-2021', '2018'),
(2, 'Course1', 'CSL-X1', 'Odd Semester-2020', '2020'),
(2, 'Course2', 'CSL-X2', 'Even Semester-2020', '2019'),
(2, 'Course3', 'CSL-X3', 'Odd Semester-2020', '2019'),
(2, 'Course4', 'CSL-X4', 'Odd Semester-2020', '2020'),
(2, 'Course5', 'CSL-X5', 'Odd Semester-2020', '2020'),
(2, 'Course6', 'CSL-X6', 'Odd Semester-2020', '2020'),
(2, 'Course7', 'CSL-X7', 'Odd Semester-2020', '2019'),
(2, 'Course8', 'CSL-X8', 'Even Semester-2020', '2019'),
(2, 'Course9', 'CSL-X9', 'Odd Semester-2020', '2020'),
(2, 'Object Oriented Lab', 'CSP-253', 'Odd Semester-2020', '2019'),
(4, 'Engineering Drawing', 'MEL-151', 'Odd Semester-2020', '2018'),
(4, 'Engineering Drawing Lab', 'MEP-151', 'Odd Semester-2020', '2017');

-- --------------------------------------------------------

--
-- Table structure for table `gradewindow`
--

CREATE TABLE `gradewindow` (
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `lower_cutoff` float NOT NULL,
  `upper_cutoff` float NOT NULL,
  `no_of_students` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gradewindow`
--

INSERT INTO `gradewindow` (`course_code`, `grade`, `lower_cutoff`, `upper_cutoff`, `no_of_students`) VALUES
('CSL-258', 'AA', 86, 100, 2),
('CSL-258', 'AB', 75, 85, 1),
('CSL-258', 'BB', 66, 74, 1),
('CSL-258', 'BC', 56, 65, 0),
('CSL-258', 'CC', 46, 55, 0),
('CSL-258', 'DD', 36, 45, 0),
('CSL-258', 'FF', 0, 35, 0),
('CSL-253', 'AA', 92, 0, 0),
('CSL-253', 'AB', 85, 0, 0),
('CSL-253', 'BB', 78, 0, 0),
('CSL-253', 'BC', 65, 0, 0),
('CSL-253', 'CC', 52, 0, 0),
('CSL-253', 'DD', 39, 0, 0),
('CSL-253', 'FF', 0, 0, 0),
('CSL-255', 'AA', 86, 100, 4),
('CSL-255', 'AB', 78, 85, 0),
('CSL-255', 'BB', 66, 77, 0),
('CSL-255', 'BC', 56, 65, 0),
('CSL-255', 'CC', 46, 55, 0),
('CSL-255', 'DD', 36, 45, 0),
('CSL-255', 'FF', 0, 35, 0),
('CSL-257', 'AA', 92, 0, 0),
('CSL-257', 'AB', 85, 0, 0),
('CSL-257', 'BB', 78, 0, 0),
('CSL-257', 'BC', 65, 0, 0),
('CSL-257', 'CC', 52, 0, 0),
('CSL-257', 'DD', 39, 0, 0),
('CSL-257', 'FF', 0, 0, 0),
('CSL-252', 'AA', 0, 0, 0),
('CSL-252', 'AB', 0, 0, 0),
('CSL-252', 'BB', 0, 0, 0),
('CSL-252', 'BC', 0, 0, 0),
('CSL-252', 'CC', 0, 0, 0),
('CSL-252', 'DD', 0, 0, 0),
('CSL-252', 'FF', 0, 0, 0),
('CSP-253', 'AA', 0, 0, 0),
('CSP-253', 'AB', 0, 0, 0),
('CSP-253', 'BB', 0, 0, 0),
('CSP-253', 'BC', 0, 0, 0),
('CSP-253', 'CC', 0, 0, 0),
('CSP-253', 'DD', 0, 0, 0),
('CSP-253', 'FF', 0, 0, 0),
('CSL-251', 'AA', 0, 0, 0),
('CSL-251', 'AB', 0, 0, 0),
('CSL-251', 'BB', 0, 0, 0),
('CSL-251', 'BC', 0, 0, 0),
('CSL-251', 'CC', 0, 0, 0),
('CSL-251', 'DD', 0, 0, 0),
('CSL-251', 'FF', 0, 0, 0),
('MEL-151', 'AA', 0, 0, 0),
('MEL-151', 'AB', 0, 0, 0),
('MEL-151', 'BB', 0, 0, 0),
('MEL-151', 'BC', 0, 0, 0),
('MEL-151', 'CC', 0, 0, 0),
('MEL-151', 'DD', 0, 0, 0),
('MEL-151', 'FF', 0, 0, 0),
('MEP-151', 'AA', 0, 0, 0),
('MEP-151', 'AB', 0, 0, 0),
('MEP-151', 'BB', 0, 0, 0),
('MEP-151', 'BC', 0, 0, 0),
('MEP-151', 'CC', 0, 0, 0),
('MEP-151', 'DD', 0, 0, 0),
('MEP-151', 'FF', 0, 0, 0),
('CSL-307', 'AA', 86, 0, 0),
('CSL-307', 'AB', 75, 0, 0),
('CSL-307', 'BB', 66, 0, 0),
('CSL-307', 'BC', 56, 0, 0),
('CSL-307', 'CC', 46, 0, 0),
('CSL-307', 'DD', 36, 0, 0),
('CSL-307', 'FF', 36, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Surendra Singh', 'surendra@nituk.ac.in', 'surendra'),
(2, 'Sneha Chauhan', 'sneha@nituk.ac.in', 'sneha'),
(3, 'Krishanveer Gangwar', 'kg@nituk.ac.in', 'krish'),
(4, 'Dungali Shreehari', 'dungali@nituk.ac.in', 'dungali'),
(5, 'Maheep Singh', 'maheep@nituk.ac.in', 'maheep');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `controlsheet`
--
ALTER TABLE `controlsheet`
  ADD KEY `Course Code` (`course_code`),
  ADD KEY `Course Code_2` (`course_code`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `controlsheet`
--
ALTER TABLE `controlsheet`
  ADD CONSTRAINT `controlsheet_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
