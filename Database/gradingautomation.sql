-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2021 at 10:09 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

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
  `class_test_1` float NOT NULL,
  `class_test_2` float NOT NULL,
  `mid_term_1` float NOT NULL,
  `mid_term_2` float NOT NULL,
  `end_term` float NOT NULL,
  `total_marks` float NOT NULL,
  `grade` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `controlsheet`
--

INSERT INTO `controlsheet` (`course_code`, `roll_no`, `name`, `class_test_1`, `class_test_2`, `mid_term_1`, `mid_term_2`, `end_term`, `total_marks`, `grade`) VALUES
('CSL-258', '', 'Maximim Marks', 10, 10, 20, 20, 40, 100, ''),
('CSL-258', 'BT19CSE002', 'Anupam Panwar', 9, 9, 18, 20, 37, 0, ''),
('CSL-258', 'BT19CSE003', 'Neha Dhyani', 9.5, 8.5, 18, 18.5, 38.5, 0, ''),
('CSL-258', 'BT19CSE011', 'Purvi Goyal', 9, 8.5, 17.5, 19, 38, 0, ''),
('CSL-258', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 8.5, 18, 19.5, 36.5, 0, ''),
('CSL-253', '', 'Maximim Marks', 10, 10, 20, 20, 40, 100, ''),
('CSL-253', 'BT19CSE002', 'Anupam Panwar', 9.5, 8, 18, 19, 38, 0, ''),
('CSL-253', 'BT19CSE003', 'Neha Dhyani', 9.5, 9.5, 19, 18.5, 38, 0, ''),
('CSL-253', 'BT19CSE011', 'Purvi Goyal', 9, 8, 18, 19.5, 38.5, 0, ''),
('CSL-253', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9.5, 19, 18.5, 37, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(20) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `batch`) VALUES
(3, 'Operating System', 'CSL-252', 'BT19'),
(2, 'Object Oriented Design', 'CSL-253', 'BT20'),
(1, 'Computer Networks', 'CSL-255', 'BT19'),
(1, 'Data Communication', 'CSL-257', 'BT19'),
(1, 'Computer Organistaion', 'CSL-258', 'BT20');

-- --------------------------------------------------------

--
-- Table structure for table `gradewindow`
--

CREATE TABLE `gradewindow` (
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `cut_off` decimal(7,0) NOT NULL,
  `no_of_students` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gradewindow`
--

INSERT INTO `gradewindow` (`course_code`, `grade`, `cut_off`, `no_of_students`) VALUES
('CSL-258', 'AA', '86', 0),
('CSL-258', 'AB', '75', 0),
('CSL-258', 'BB', '66', 0),
('CSL-258', 'BC', '56', 0),
('CSL-258', 'CC', '46', 0),
('CSL-258', 'DD', '36', 0),
('CSL-258', 'FF', '0', 0),
('CSL-253', 'AA', '92', 0),
('CSL-253', 'AB', '85', 0),
('CSL-253', 'BB', '78', 0),
('CSL-253', 'BC', '65', 0),
('CSL-253', 'CC', '52', 0),
('CSL-253', 'DD', '39', 0),
('CSL-253', 'FF', '0', 0);

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
(1, 'Surendra Singh', 'suri@nituk.ac.in', 'surendra'),
(2, 'Sneha Chauhan', 'sneha@nituk.ac.in', 'sneha'),
(3, 'Krishanveer Gangwar', 'kg@nituk.ac.in', 'krish');

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
-- Indexes for table `gradewindow`
--
ALTER TABLE `gradewindow`
  ADD KEY `Course Code` (`course_code`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

--
-- Constraints for table `gradewindow`
--
ALTER TABLE `gradewindow`
  ADD CONSTRAINT `gradewindow_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
