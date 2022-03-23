-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 07:18 PM
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

--
-- Table structure for table `controlsheet`
--

CREATE TABLE `controlsheet` (
  `course_code` varchar(20) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `class_test_1` int(11) NOT NULL,
  `class_test_2` int(11) NOT NULL,
  `class_test_3` int(11) NOT NULL,
  `class_test_4` int(11) NOT NULL,
  `mid_term_1` int(11) NOT NULL,
  `mid_term_2` int(11) NOT NULL,
  `total_assessment` int(11) NOT NULL,
  `end_term` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `controlsheet`
--

INSERT INTO `controlsheet` (`course_code`, `roll_no`, `name`, `class_test_1`, `class_test_2`, `class_test_3`, `class_test_4`, `mid_term_1`, `mid_term_2`, `total_assessment`, `end_term`, `total_marks`, `grade`) VALUES
('CSL-251', 'BT19CSE002', 'Anupam Panwar', 9, 9, 0, 0, 18, 20, 0, 37, 0, ''),
('CSL-251', 'BT19CSE003', 'Neha Dhyani', 10, 9, 0, 0, 18, 19, 0, 39, 0, ''),
('CSL-251', 'BT19CSE011', 'Purvi Goyal', 9, 9, 0, 0, 18, 19, 0, 38, 0, ''),
('CSL-251', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9, 0, 0, 18, 20, 0, 37, 0, ''),
('CSL-252', 'BT19CSE002', 'Anupam Panwar', 10, 8, 0, 0, 18, 19, 0, 38, 0, 'FF'),
('CSL-252', 'BT19CSE003', 'Neha Dhyani', 10, 10, 0, 0, 19, 19, 0, 38, 0, 'FF'),
('CSL-252', 'BT19CSE011', 'Purvi Goyal', 9, 8, 0, 0, 18, 20, 0, 39, 0, 'FF'),
('CSL-252', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 10, 0, 0, 19, 19, 0, 37, 0, 'FF'),
('CSL-253', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
('CSL-253', 'BT19CSE002', 'Anupam Panwar', 6, 8, 0, 0, 18, 19, 51, 38, 89, 'AA'),
('CSL-253', 'BT19CSE003', 'Neha Dhyani', 10, 10, 0, 0, 19, 19, 58, 38, 96, 'AA'),
('CSL-253', 'BT19CSE011', 'Purvi Goyal', 9, 8, 0, 0, 18, 20, 55, 39, 94, 'AA'),
('CSL-253', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 10, 0, 0, 19, 19, 58, 37, 95, 'AA'),
('CSL-255', 'BT19CSE002', 'Anupam Panwar', 9, 9, 0, 0, 18, 20, 56, 37, 93, 'AA'),
('CSL-255', 'BT19CSE003', 'Neha Dhyani', 10, 9, 0, 0, 18, 19, 55, 39, 93, 'AA'),
('CSL-255', 'BT19CSE011', 'Purvi Goyal', 9, 9, 0, 0, 18, 19, 54, 38, 92, 'AA'),
('CSL-255', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9, 0, 0, 18, 20, 56, 37, 93, 'AA'),
('CSL-257', 'BT19CSE002', 'Anupam Panwar', 9, 9, 0, 0, 18, 20, 56, 37, 93, ''),
('CSL-257', 'BT19CSE003', 'Neha Dhyani', 10, 9, 0, 0, 18, 19, 55, 39, 93, ''),
('CSL-257', 'BT19CSE011', 'Purvi Goyal', 9, 9, 0, 0, 18, 19, 54, 38, 92, ''),
('CSL-257', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9, 0, 0, 18, 20, 56, 37, 93, ''),
('CSL-258', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-258', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-258', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-258', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSL-258', 'BT19CSE056', 'ys', 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
('CSL-307', 'BT19CSE002', 'Anupam Panwar', 10, 10, 0, 0, 10, 10, 40, 10, 50, ''),
('CSL-307', 'BT19CSE003', 'Neha Dhyani', 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('CSL-307', 'BT19CSE011', 'Purvi Goyal', 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('CSL-307', 'BT19CSE020', 'Priyanshu Upadhyay', 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('CSL-X1', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-X1', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-X1', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-X1', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSL-X2', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-X2', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-X2', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-X2', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSL-X3', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-X3', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-X3', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-X3', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSL-X4', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-X4', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-X4', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-X4', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSL-X5', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-X5', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-X5', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-X5', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSL-X66', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-X66', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-X66', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-X66', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSL-X7', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, ''),
('CSL-X7', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, ''),
('CSL-X7', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, ''),
('CSL-X7', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, ''),
('CSL-X8', 'BT19CSE002', 'Anupam Panwar', 8, 9, 0, 0, 16, 19, 52, 35, 87, 'AA'),
('CSL-X8', 'BT19CSE003', 'Neha Dhyani', 9, 9, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSL-X8', 'BT19CSE011', 'Purvi Goyal', 8, 5, 0, 0, 12, 14, 39, 30, 69, 'BB'),
('CSL-X8', 'BT19CSE020', 'Priyanshu Upadhyay', 8, 8, 0, 0, 15, 13, 44, 34, 78, 'AB'),
('CSP-253', 'BT19CSE002', 'Anupam Panwar', 10, 8, 0, 0, 18, 19, 55, 38, 93, 'AA'),
('CSP-253', 'BT19CSE003', 'Neha Dhyani', 10, 10, 0, 0, 19, 19, 57, 38, 95, 'AA'),
('CSP-253', 'BT19CSE011', 'Purvi Goyal', 9, 8, 0, 0, 18, 20, 55, 39, 93, 'AA'),
('CSP-253', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 10, 0, 0, 19, 19, 57, 37, 94, 'AA'),
('MEL-151', 'BT19CSE002', 'Anupam Panwar', 9, 9, 0, 0, 18, 20, 0, 37, 0, ''),
('MEL-151', 'BT19CSE003', 'Neha Dhyani', 10, 9, 0, 0, 18, 19, 0, 39, 0, ''),
('MEL-151', 'BT19CSE011', 'Purvi Goyal', 9, 9, 0, 0, 18, 19, 0, 38, 0, ''),
('MEL-151', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 9, 0, 0, 18, 20, 0, 37, 0, ''),
('MEP-151', 'BT19CSE002', 'Anupam Panwar', 10, 8, 0, 0, 18, 19, 0, 38, 0, ''),
('MEP-151', 'BT19CSE003', 'Neha Dhyani', 10, 10, 0, 0, 19, 19, 0, 38, 0, ''),
('MEP-151', 'BT19CSE011', 'Purvi Goyal', 9, 8, 0, 0, 18, 20, 0, 39, 0, ''),
('MEP-151', 'BT19CSE020', 'Priyanshu Upadhyay', 10, 10, 0, 0, 19, 19, 0, 37, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `mct1` int(11) NOT NULL,
  `mct2` int(11) NOT NULL,
  `mct3` int(11) NOT NULL,
  `mct4` int(11) NOT NULL,
  `mmt1` int(11) NOT NULL,
  `mmt2` int(11) NOT NULL,
  `mta` int(11) NOT NULL,
  `met` int(11) NOT NULL,
  `mt` int(11) NOT NULL,
  `flag` tinyint(1) DEFAULT 0,
  `mean` int(11) DEFAULT 0,
  `standard_deviation` int(11) DEFAULT 0,
  `type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `batch`, `semester`, `mct1`, `mct2`, `mct3`, `mct4`, `mmt1`, `mmt2`, `mta`, `met`, `mt`, `flag`, `mean`, `standard_deviation`, `type`) VALUES
(3, 'Data Structures', 'CSL-251', '2017', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(3, 'Operating System', 'CSL-252', '2019', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Object Oriented Design', 'CSL-253', '2020', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(1, 'Computer Networks', 'CSL-255', '2018', 'Even 2021', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(1, 'Data Communication', 'CSL-257', '2019', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(1, 'Computer Organistaion', 'CSL-258', '2020', 'Even 2021', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(5, 'Software Engineering', 'CSL-307', '2018', 'Even 2021', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Course1', 'CSL-X1', '2020', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Course2', 'CSL-X2', '2019', 'Even 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Course3', 'CSL-X3', '2019', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Course4', 'CSL-X4', '2020', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Course5', 'CSL-X5', '2020', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Course6', 'CSL-X66', '2020', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Course7', 'CSL-X7', '2019', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Course8', 'CSL-X8', '2019', 'Even 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(2, 'Object Oriented Lab', 'CSP-253', '2019', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(4, 'Engineering Drawing', 'MEL-151', '2018', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL),
(4, 'Engineering Drawing Lab', 'MEP-151', '2017', 'Odd 2020', 10, 10, 0, 0, 20, 20, 60, 40, 100, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gradewindow`
--

CREATE TABLE `gradewindow` (
  `course_code` varchar(20) NOT NULL,
  `grade` varchar(5) NOT NULL,
  `lower_cutoff` float NOT NULL,
  `upper_cutoff` float NOT NULL,
  `no_of_students` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gradewindow`
--

INSERT INTO `gradewindow` (`course_code`, `grade`, `lower_cutoff`, `upper_cutoff`, `no_of_students`) VALUES
('CSL-251', 'AA', 86, 100, 2),
('CSL-251', 'AB', 75, 85, 1),
('CSL-251', 'BB', 66, 74, 1),
('CSL-251', 'BC', 56, 65, 0),
('CSL-251', 'CC', 46, 55, 0),
('CSL-251', 'DD', 36, 45, 0),
('CSL-251', 'FF', 0, 35, 0),
('CSL-252', 'AA', 86, 100, 0),
('CSL-252', 'AB', 75, 85, 0),
('CSL-252', 'BB', 66, 74, 0),
('CSL-252', 'BC', 56, 65, 0),
('CSL-252', 'CC', 46, 55, 0),
('CSL-252', 'DD', 36, 45, 0),
('CSL-252', 'FF', 0, 35, 4),
('CSL-253', 'AA', 86, 100, 4),
('CSL-253', 'AB', 75, 85, 0),
('CSL-253', 'BB', 66, 74, 0),
('CSL-253', 'BC', 56, 65, 0),
('CSL-253', 'CC', 46, 55, 0),
('CSL-253', 'DD', 36, 45, 0),
('CSL-253', 'FF', 0, 35, 0),
('CSL-255', 'AA', 86, 100, 2),
('CSL-255', 'AB', 75, 85, 1),
('CSL-255', 'BB', 66, 74, 1),
('CSL-255', 'BC', 56, 65, 0),
('CSL-255', 'CC', 46, 55, 0),
('CSL-255', 'DD', 36, 45, 0),
('CSL-255', 'FF', 0, 35, 0),
('CSL-257', 'AA', 86, 100, 2),
('CSL-257', 'AB', 75, 85, 1),
('CSL-257', 'BB', 66, 74, 1),
('CSL-257', 'BC', 56, 65, 0),
('CSL-257', 'CC', 46, 55, 0),
('CSL-257', 'DD', 36, 45, 0),
('CSL-257', 'FF', 0, 35, 0),
('CSL-258', 'AA', 86, 100, 2),
('CSL-258', 'AB', 75, 85, 1),
('CSL-258', 'BB', 66, 74, 1),
('CSL-258', 'BC', 56, 65, 0),
('CSL-258', 'CC', 46, 55, 0),
('CSL-258', 'DD', 36, 45, 0),
('CSL-258', 'FF', 0, 35, 0),
('CSL-307', 'AA', 86, 100, 2),
('CSL-307', 'AB', 75, 85, 1),
('CSL-307', 'BB', 66, 74, 1),
('CSL-307', 'BC', 56, 65, 0),
('CSL-307', 'CC', 46, 55, 0),
('CSL-307', 'DD', 36, 45, 0),
('CSL-307', 'FF', 0, 35, 0),
('CSL-X1', 'AA', 86, 100, 2),
('CSL-X1', 'AB', 75, 85, 1),
('CSL-X1', 'BB', 66, 74, 1),
('CSL-X1', 'BC', 56, 65, 0),
('CSL-X1', 'CC', 46, 55, 0),
('CSL-X1', 'DD', 36, 45, 0),
('CSL-X1', 'FF', 0, 35, 0),
('CSL-X2', 'AA', 86, 100, 2),
('CSL-X2', 'AB', 75, 85, 1),
('CSL-X2', 'BB', 66, 74, 1),
('CSL-X2', 'BC', 56, 65, 0),
('CSL-X2', 'CC', 46, 55, 0),
('CSL-X2', 'DD', 36, 45, 0),
('CSL-X2', 'FF', 0, 35, 0),
('CSL-X3', 'AA', 86, 100, 2),
('CSL-X3', 'AB', 75, 85, 1),
('CSL-X3', 'BB', 66, 74, 1),
('CSL-X3', 'BC', 56, 65, 0),
('CSL-X3', 'CC', 46, 55, 0),
('CSL-X3', 'DD', 36, 45, 0),
('CSL-X3', 'FF', 0, 35, 0),
('CSL-X4', 'AA', 86, 100, 2),
('CSL-X4', 'AB', 75, 85, 1),
('CSL-X4', 'BB', 66, 74, 1),
('CSL-X4', 'BC', 56, 65, 0),
('CSL-X4', 'CC', 46, 55, 0),
('CSL-X4', 'DD', 36, 45, 0),
('CSL-X4', 'FF', 0, 35, 0),
('CSL-X5', 'AA', 86, 100, 2),
('CSL-X5', 'AB', 75, 85, 1),
('CSL-X5', 'BB', 66, 74, 1),
('CSL-X5', 'BC', 56, 65, 0),
('CSL-X5', 'CC', 46, 55, 0),
('CSL-X5', 'DD', 36, 45, 0),
('CSL-X5', 'FF', 0, 35, 0),
('CSL-X66', 'AA', 86, 100, 2),
('CSL-X66', 'AB', 75, 85, 1),
('CSL-X66', 'BB', 66, 74, 1),
('CSL-X66', 'BC', 56, 65, 0),
('CSL-X66', 'CC', 46, 55, 0),
('CSL-X66', 'DD', 36, 45, 0),
('CSL-X66', 'FF', 0, 35, 0),
('CSL-X7', 'AA', 86, 100, 0),
('CSL-X7', 'AB', 75, 85, 0),
('CSL-X7', 'BB', 66, 74, 0),
('CSL-X7', 'BC', 56, 65, 0),
('CSL-X7', 'CC', 46, 55, 0),
('CSL-X7', 'DD', 36, 45, 0),
('CSL-X7', 'FF', 0, 35, 0),
('CSL-X8', 'AA', 86, 100, 2),
('CSL-X8', 'AB', 75, 85, 1),
('CSL-X8', 'BB', 66, 74, 1),
('CSL-X8', 'BC', 56, 65, 0),
('CSL-X8', 'CC', 46, 55, 0),
('CSL-X8', 'DD', 36, 45, 0),
('CSL-X8', 'FF', 0, 35, 0),
('CSP-253', 'AA', 86, 100, 4),
('CSP-253', 'AB', 75, 85, 0),
('CSP-253', 'BB', 66, 74, 0),
('CSP-253', 'BC', 56, 65, 0),
('CSP-253', 'CC', 46, 55, 0),
('CSP-253', 'DD', 36, 45, 0),
('CSP-253', 'FF', 0, 35, 0),
('MEL-151', 'AA', 86, 100, 2),
('MEL-151', 'AB', 75, 85, 1),
('MEL-151', 'BB', 66, 74, 1),
('MEL-151', 'BC', 56, 65, 0),
('MEL-151', 'CC', 46, 55, 0),
('MEL-151', 'DD', 36, 45, 0),
('MEL-151', 'FF', 0, 35, 0),
('MEP-151', 'AA', 86, 100, 2),
('MEP-151', 'AB', 75, 85, 1),
('MEP-151', 'BB', 66, 74, 1),
('MEP-151', 'BC', 56, 65, 0),
('MEP-151', 'CC', 46, 55, 0),
('MEP-151', 'DD', 36, 45, 0),
('MEP-151', 'FF', 0, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image_url`) VALUES
(1, 'Surendra Singh', 'surendra@nituk.ac.in', 'surendra', 'IMG-5f8954bd209a92.78214246.jpg'),
(2, 'Guest', 'guest@nituk.ac.in', 'guest', 'IMG-5f8954bd209a92.78214246.jpg'),
(3, 'Krishanveer Gangwar', 'kg@nituk.ac.in', 'krish', 'IMG-5f8954bd209a92.78214246.jpg'),
(4, 'Dungali Shreehari', 'dungali@nituk.ac.in', 'dungali', 'IMG-5f8954bd209a92.78214246.jpg'),
(5, 'Maheep Singh', 'maheep@nituk.ac.in', 'maheep', 'IMG-5f8954bd209a92.78214246.jpg'),
(6, 'Admin', 'admin@nituk.ac.in', 'Admin@123', 'IMG-5f8954bd209a92.78214246.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `controlsheet`
--
ALTER TABLE `controlsheet`
  ADD PRIMARY KEY (`course_code`,`roll_no`);

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
  ADD PRIMARY KEY (`course_code`,`grade`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `controlsheet`
--
ALTER TABLE `controlsheet`
  ADD CONSTRAINT `controlsheet_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gradewindow`
--
ALTER TABLE `gradewindow`
  ADD CONSTRAINT `gradewindow_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
