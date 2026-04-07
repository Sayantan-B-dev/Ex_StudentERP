-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2026 at 05:45 PM
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
-- Database: `college_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_batches`
--

CREATE TABLE `academic_batches` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `batch_year` year(4) NOT NULL,
  `batch_code` varchar(50) NOT NULL,
  `batch_name` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `current_semester` int(11) DEFAULT 1,
  `total_students` int(11) DEFAULT 0,
  `max_capacity` int(11) DEFAULT 60,
  `class_teacher_id` int(11) DEFAULT NULL,
  `fee_structure` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `admission_criteria` text DEFAULT NULL,
  `status` enum('active','completed','upcoming','cancelled') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_batches`
--

INSERT INTO `academic_batches` (`id`, `program_id`, `batch_year`, `batch_code`, `batch_name`, `start_date`, `end_date`, `current_semester`, `total_students`, `max_capacity`, `class_teacher_id`, `fee_structure`, `admission_criteria`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2024', 'CSE2024', 'B.Tech CSE Batch 2024', '2024-08-01', '2028-05-31', 2, 45, 60, 1, '{\"tuition\":125000,\"hostel\":80000,\"other\":15000}', 'JEE Main Rank', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(2, 2, '2024', 'ECE2024', 'B.Tech ECE Batch 2024', '2024-08-01', '2028-05-31', 2, 38, 60, 2, '{\"tuition\":120000,\"hostel\":80000,\"other\":15000}', 'JEE Main Rank', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(4, 2, '2025', 'CSE2025', 'B.Tech CSE Batch 2025', '2025-08-01', '2029-05-31', 1, 52, 60, 1, '{\"tuition\":130000,\"hostel\":85000,\"other\":15000}', 'JEE Main Rank', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 11:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `academic_programs`
--

CREATE TABLE `academic_programs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `duration_years` int(11) DEFAULT 4,
  `total_credits` int(11) DEFAULT 120,
  `department_id` int(11) NOT NULL,
  `degree_type` enum('undergraduate','postgraduate','diploma','certificate','phd') DEFAULT 'undergraduate',
  `program_level` enum('foundation','diploma','bachelor','master','doctoral') DEFAULT 'bachelor',
  `accreditation_status` enum('approved','pending','rejected','accredited') DEFAULT 'pending',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_semesters` int(11) DEFAULT 8,
  `max_students` int(11) DEFAULT 100,
  `current_students` int(11) DEFAULT 0,
  `program_fee` decimal(10,2) DEFAULT 0.00,
  `status` enum('active','inactive','draft') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_programs`
--

INSERT INTO `academic_programs` (`id`, `name`, `code`, `description`, `duration_years`, `total_credits`, `department_id`, `degree_type`, `program_level`, `accreditation_status`, `start_date`, `end_date`, `total_semesters`, `max_students`, `current_students`, `program_fee`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'B.Tech Computer Science & Engineering', 'BTCSE', 'Bachelor of Technology in CSEE', 4, 160, 1, 'diploma', 'bachelor', 'accredited', '2024-08-01', '2028-05-31', 8, 60, 45, 2500000.00, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 12:19:17'),
(2, 'B.Tech Electronics & Communication', 'BTECE', 'Bachelor of Technology in ECE', 4, 160, 2, 'undergraduate', 'bachelor', 'accredited', '2024-08-01', '2028-05-31', 8, 60, 38, 240000.00, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `batch_id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT 1,
  `attendance_date` date NOT NULL,
  `status` enum('present','absent','late','half_day') DEFAULT 'present',
  `remarks` text DEFAULT NULL,
  `marked_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `subject_id`, `batch_id`, `session_id`, `attendance_date`, `status`, `remarks`, `marked_by`, `created_at`) VALUES
(1, 1, 1, 1, 1, '2025-02-03', 'present', NULL, 1, '2026-03-18 10:43:07'),
(2, 1, 1, 1, 1, '2025-02-05', 'present', NULL, 1, '2026-03-18 10:43:07'),
(3, 1, 1, 1, 1, '2025-02-07', 'late', NULL, 1, '2026-03-18 10:43:07'),
(4, 1, 4, 1, 1, '2025-02-04', 'present', NULL, 1, '2026-03-18 10:43:07'),
(5, 1, 4, 1, 1, '2025-02-06', 'absent', NULL, 1, '2026-03-18 10:43:07'),
(6, 1, 4, 1, 1, '2025-02-08', 'present', NULL, 1, '2026-03-18 10:43:07'),
(7, 1, 10, 1, 1, '2025-02-09', 'present', NULL, 1, '2026-03-18 10:43:07'),
(8, 1, 10, 1, 1, '2025-02-10', 'half_day', NULL, 1, '2026-03-18 10:43:07'),
(9, 1, 10, 1, 1, '2025-02-12', 'present', NULL, 1, '2026-03-18 10:43:07'),
(10, 1, 1, 1, 1, '2025-02-14', 'present', NULL, 1, '2026-03-18 10:43:07'),
(11, 2, 1, 1, 1, '2025-02-03', 'present', NULL, 1, '2026-03-18 10:43:07'),
(12, 2, 1, 1, 1, '2025-02-05', 'present', NULL, 1, '2026-03-18 10:43:07'),
(13, 2, 1, 1, 1, '2025-02-07', 'present', NULL, 1, '2026-03-18 10:43:07'),
(14, 2, 4, 1, 1, '2025-02-04', 'present', NULL, 1, '2026-03-18 10:43:07'),
(15, 2, 4, 1, 1, '2025-02-06', 'present', NULL, 1, '2026-03-18 10:43:07'),
(16, 2, 4, 1, 1, '2025-02-08', 'late', NULL, 1, '2026-03-18 10:43:07'),
(17, 2, 10, 1, 1, '2025-02-09', 'present', NULL, 1, '2026-03-18 10:43:07'),
(18, 2, 10, 1, 1, '2025-02-10', 'present', NULL, 1, '2026-03-18 10:43:07'),
(19, 2, 10, 1, 1, '2025-02-12', 'absent', NULL, 1, '2026-03-18 10:43:07'),
(20, 2, 1, 1, 1, '2025-02-14', 'present', NULL, 1, '2026-03-18 10:43:07'),
(21, 3, 1, 1, 1, '2025-02-03', 'present', NULL, 1, '2026-03-18 10:43:07'),
(22, 3, 1, 1, 1, '2025-02-05', 'half_day', NULL, 1, '2026-03-18 10:43:07'),
(23, 3, 1, 1, 1, '2025-02-07', 'present', NULL, 1, '2026-03-18 10:43:07'),
(24, 3, 4, 1, 1, '2025-02-04', 'present', NULL, 1, '2026-03-18 10:43:07'),
(25, 3, 4, 1, 1, '2025-02-06', 'present', NULL, 1, '2026-03-18 10:43:07'),
(26, 3, 4, 1, 1, '2025-02-08', 'present', NULL, 1, '2026-03-18 10:43:07'),
(27, 3, 10, 1, 1, '2025-02-09', 'late', NULL, 1, '2026-03-18 10:43:07'),
(28, 3, 10, 1, 1, '2025-02-10', 'present', NULL, 1, '2026-03-18 10:43:07'),
(29, 3, 10, 1, 1, '2025-02-12', 'present', NULL, 1, '2026-03-18 10:43:07'),
(30, 3, 1, 1, 1, '2025-02-14', 'present', NULL, 1, '2026-03-18 10:43:07'),
(31, 4, 2, 2, 1, '2025-02-03', 'present', NULL, 2, '2026-03-18 10:43:07'),
(32, 4, 2, 2, 1, '2025-02-05', 'present', NULL, 2, '2026-03-18 10:43:07'),
(33, 4, 2, 2, 1, '2025-02-07', 'present', NULL, 2, '2026-03-18 10:43:07'),
(34, 4, 5, 2, 1, '2025-02-04', 'absent', NULL, 2, '2026-03-18 10:43:07'),
(35, 4, 5, 2, 1, '2025-02-06', 'present', NULL, 2, '2026-03-18 10:43:07'),
(36, 4, 5, 2, 1, '2025-02-08', 'present', NULL, 2, '2026-03-18 10:43:07'),
(37, 4, 11, 2, 1, '2025-02-09', 'present', NULL, 2, '2026-03-18 10:43:07'),
(38, 4, 11, 2, 1, '2025-02-10', 'present', NULL, 2, '2026-03-18 10:43:07'),
(39, 4, 11, 2, 1, '2025-02-12', 'late', NULL, 2, '2026-03-18 10:43:07'),
(40, 4, 2, 2, 1, '2025-02-14', 'present', NULL, 2, '2026-03-18 10:43:07'),
(41, 5, 2, 2, 1, '2025-02-03', 'present', NULL, 2, '2026-03-18 10:43:07'),
(42, 5, 2, 2, 1, '2025-02-05', 'present', NULL, 2, '2026-03-18 10:43:07'),
(43, 5, 2, 2, 1, '2025-02-07', 'present', NULL, 2, '2026-03-18 10:43:07'),
(44, 5, 5, 2, 1, '2025-02-04', 'present', NULL, 2, '2026-03-18 10:43:07'),
(45, 5, 5, 2, 1, '2025-02-06', 'half_day', NULL, 2, '2026-03-18 10:43:07'),
(46, 5, 5, 2, 1, '2025-02-08', 'present', NULL, 2, '2026-03-18 10:43:07'),
(47, 5, 11, 2, 1, '2025-02-09', 'present', NULL, 2, '2026-03-18 10:43:07'),
(48, 5, 11, 2, 1, '2025-02-10', 'present', NULL, 2, '2026-03-18 10:43:07'),
(49, 5, 11, 2, 1, '2025-02-12', 'present', NULL, 2, '2026-03-18 10:43:07'),
(50, 5, 2, 2, 1, '2025-02-14', 'present', NULL, 2, '2026-03-18 10:43:07'),
(51, 6, 2, 2, 1, '2025-02-03', 'present', NULL, 2, '2026-03-18 10:43:07'),
(52, 6, 2, 2, 1, '2025-02-05', 'late', NULL, 2, '2026-03-18 10:43:07'),
(53, 6, 2, 2, 1, '2025-02-07', 'present', NULL, 2, '2026-03-18 10:43:07'),
(54, 6, 5, 2, 1, '2025-02-04', 'present', NULL, 2, '2026-03-18 10:43:07'),
(55, 6, 5, 2, 1, '2025-02-06', 'present', NULL, 2, '2026-03-18 10:43:07'),
(56, 6, 5, 2, 1, '2025-02-08', 'present', NULL, 2, '2026-03-18 10:43:07'),
(57, 6, 11, 2, 1, '2025-02-09', 'absent', NULL, 2, '2026-03-18 10:43:07'),
(58, 6, 11, 2, 1, '2025-02-10', 'present', NULL, 2, '2026-03-18 10:43:07'),
(59, 6, 11, 2, 1, '2025-02-12', 'present', NULL, 2, '2026-03-18 10:43:07'),
(60, 6, 2, 2, 1, '2025-02-14', 'present', NULL, 2, '2026-03-18 10:43:07'),
(61, 7, 3, 3, 1, '2025-02-03', 'present', NULL, 3, '2026-03-18 10:43:07'),
(62, 7, 3, 3, 1, '2025-02-05', 'present', NULL, 3, '2026-03-18 10:43:07'),
(63, 7, 3, 3, 1, '2025-02-07', 'present', NULL, 3, '2026-03-18 10:43:07'),
(64, 7, 6, 3, 1, '2025-02-04', 'late', NULL, 3, '2026-03-18 10:43:07'),
(65, 7, 6, 3, 1, '2025-02-06', 'present', NULL, 3, '2026-03-18 10:43:07'),
(66, 7, 6, 3, 1, '2025-02-08', 'present', NULL, 3, '2026-03-18 10:43:07'),
(67, 7, 12, 3, 1, '2025-02-09', 'present', NULL, 3, '2026-03-18 10:43:07'),
(68, 7, 12, 3, 1, '2025-02-10', 'present', NULL, 3, '2026-03-18 10:43:07'),
(69, 7, 12, 3, 1, '2025-02-12', 'present', NULL, 3, '2026-03-18 10:43:07'),
(70, 7, 3, 3, 1, '2025-02-14', 'half_day', NULL, 3, '2026-03-18 10:43:07'),
(71, 8, 3, 3, 1, '2025-02-03', 'present', NULL, 3, '2026-03-18 10:43:07'),
(72, 8, 3, 3, 1, '2025-02-05', 'present', NULL, 3, '2026-03-18 10:43:07'),
(73, 8, 3, 3, 1, '2025-02-07', 'absent', NULL, 3, '2026-03-18 10:43:07'),
(74, 8, 6, 3, 1, '2025-02-04', 'present', NULL, 3, '2026-03-18 10:43:07'),
(75, 8, 6, 3, 1, '2025-02-06', 'present', NULL, 3, '2026-03-18 10:43:07'),
(76, 8, 6, 3, 1, '2025-02-08', 'present', NULL, 3, '2026-03-18 10:43:07'),
(77, 8, 12, 3, 1, '2025-02-09', 'present', NULL, 3, '2026-03-18 10:43:07'),
(78, 8, 12, 3, 1, '2025-02-10', 'present', NULL, 3, '2026-03-18 10:43:07'),
(79, 8, 12, 3, 1, '2025-02-12', 'present', NULL, 3, '2026-03-18 10:43:07'),
(80, 8, 3, 3, 1, '2025-02-14', 'present', NULL, 3, '2026-03-18 10:43:07'),
(81, 9, 3, 3, 1, '2025-02-03', 'present', NULL, 3, '2026-03-18 10:43:07'),
(82, 9, 3, 3, 1, '2025-02-05', 'present', NULL, 3, '2026-03-18 10:43:07'),
(83, 9, 3, 3, 1, '2025-02-07', 'present', NULL, 3, '2026-03-18 10:43:07'),
(84, 9, 6, 3, 1, '2025-02-04', 'present', NULL, 3, '2026-03-18 10:43:07'),
(85, 9, 6, 3, 1, '2025-02-06', 'present', NULL, 3, '2026-03-18 10:43:07'),
(86, 9, 6, 3, 1, '2025-02-08', 'late', NULL, 3, '2026-03-18 10:43:07'),
(87, 9, 12, 3, 1, '2025-02-09', 'present', NULL, 3, '2026-03-18 10:43:07'),
(88, 9, 12, 3, 1, '2025-02-10', 'present', NULL, 3, '2026-03-18 10:43:07'),
(89, 9, 12, 3, 1, '2025-02-12', 'present', NULL, 3, '2026-03-18 10:43:07'),
(90, 9, 3, 3, 1, '2025-02-14', 'present', NULL, 3, '2026-03-18 10:43:07'),
(91, 1, NULL, 1, 1, '2026-04-06', 'absent', NULL, 1, '2026-04-05 15:09:47'),
(92, 2, NULL, 1, 1, '2026-04-06', 'present', NULL, 1, '2026-04-05 15:09:47'),
(93, 3, NULL, 1, 1, '2026-04-06', 'present', NULL, 1, '2026-04-05 15:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `module`, `details`, `ip_address`, `created_at`) VALUES
(1, 19, 'Update Profile', 'System', 'User updated their personal profile.', '::1', '2026-03-18 12:12:03'),
(2, 19, 'User Logout', 'Auth', '', '::1', '2026-03-18 12:15:29'),
(3, 19, 'User Login', 'Auth', 'User logged in via email: abcs@domain.com', '::1', '2026-03-18 12:16:05'),
(4, 19, 'User Logout', 'Auth', '', '::1', '2026-03-18 12:16:09'),
(5, 1, 'User Login', 'Auth', 'User logged in via email: abc@domain.com', '::1', '2026-03-18 12:16:36'),
(6, 1, 'Edit Student', 'Students', 'Updated record for student ID: 13 (ADM20265479)', '::1', '2026-03-18 12:18:53'),
(7, 1, 'User Logout', 'Auth', '', '::1', '2026-03-18 12:19:04'),
(8, 18, 'User Login', 'Auth', 'User logged in via email: abcf@domain.com', '::1', '2026-03-18 12:19:10'),
(9, 18, 'User Logout', 'Auth', '', '::1', '2026-03-18 12:19:19'),
(10, 1, 'User Login', 'Auth', 'User logged in via email: abc@domain.com', '::1', '2026-03-18 12:19:23'),
(11, 1, 'User Logout', 'Auth', '', '::1', '2026-03-18 12:24:07'),
(12, 18, 'User Login', 'Auth', 'User logged in via email: abcf@domain.com', '::1', '2026-03-18 12:24:10'),
(13, 18, 'Delete Fee', 'Fees', 'Deleted record for fee transaction ID: 24', '::1', '2026-03-18 12:24:20'),
(14, 18, 'User Logout', 'Auth', '', '::1', '2026-03-18 12:24:23'),
(15, 1, 'User Login', 'Auth', 'User logged in via email: abc@domain.com', '::1', '2026-03-18 12:24:27'),
(16, 1, 'User Login', 'Auth', 'User logged in via email: abc@domain.com', '::1', '2026-04-01 05:11:46'),
(17, 1, 'User Login', 'Auth', 'User logged in via email: abc@domain.com', '::1', '2026-04-02 17:28:48'),
(18, 1, 'User Login', 'Auth', 'User logged in via email: abc@domain.com', '::1', '2026-04-05 14:30:49'),
(19, 1, 'Mark Attendance', 'Attendance', 'Marked attendance for batch ID: 1 on 2026-04-06', '::1', '2026-04-05 15:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `type` enum('main','branch','extension','online') DEFAULT 'branch',
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'India',
  `pincode` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `established_year` year(4) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `institute_id`, `name`, `code`, `type`, `address`, `city`, `state`, `country`, `pincode`, `phone`, `email`, `website`, `established_year`, `description`, `status`) VALUES
(1, 1, 'Main Campus', 'MC', 'main', 'Sector A-7, Narela', 'Delhi', 'Delhi', 'India', '110040', '011-27787501', 'main@nitdelhi.ac.in', 'www.nitdelhi.ac.in', '2010', 'Main campus of NIT Delhi', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedules`
--

CREATE TABLE `class_schedules` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `day_of_week` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room_number` varchar(50) DEFAULT NULL,
  `status` enum('active','cancelled') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_schedules`
--

INSERT INTO `class_schedules` (`id`, `batch_id`, `subject_id`, `faculty_id`, `day_of_week`, `start_time`, `end_time`, `room_number`, `status`) VALUES
(1, 1, 1, 1, 'Monday', '10:00:00', '11:00:00', 'LC-101', 'active'),
(2, 1, 1, 1, 'Wednesday', '10:00:00', '11:00:00', 'LC-101', 'active'),
(3, 1, 4, 1, 'Tuesday', '11:00:00', '12:00:00', 'LC-102', 'active'),
(4, 1, 4, 1, 'Thursday', '11:00:00', '12:00:00', 'LC-102', 'active'),
(5, 1, 10, 1, 'Friday', '09:00:00', '10:00:00', 'LC-103', 'active'),
(6, 2, 2, 2, 'Monday', '14:00:00', '15:00:00', 'EC-201', 'active'),
(7, 2, 2, 2, 'Wednesday', '14:00:00', '15:00:00', 'EC-201', 'active'),
(8, 2, 5, 2, 'Tuesday', '15:00:00', '16:00:00', 'EC-202', 'active'),
(9, 2, 5, 2, 'Thursday', '15:00:00', '16:00:00', 'EC-202', 'active'),
(10, 2, 11, 2, 'Friday', '14:00:00', '15:00:00', 'EC-203', 'active'),
(11, 3, 3, 3, 'Monday', '09:00:00', '10:00:00', 'ME-301', 'active'),
(12, 3, 3, 3, 'Wednesday', '09:00:00', '10:00:00', 'ME-301', 'active'),
(13, 3, 6, 3, 'Tuesday', '10:00:00', '11:00:00', 'ME-302', 'active'),
(14, 3, 6, 3, 'Thursday', '10:00:00', '11:00:00', 'ME-302', 'active'),
(15, 3, 12, 3, 'Friday', '11:00:00', '12:00:00', 'ME-303', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `communications`
--

CREATE TABLE `communications` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `sender_type` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `message_type` enum('notice','alert','email','sms') DEFAULT 'notice',
  `priority` enum('high','normal','low') DEFAULT 'normal',
  `target_type` varchar(50) DEFAULT NULL,
  `target_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communications`
--

INSERT INTO `communications` (`id`, `sender_id`, `sender_type`, `title`, `message`, `message_type`, `priority`, `target_type`, `target_id`, `is_published`, `published_at`, `created_at`) VALUES
(1, 1, 'admin', 'Holiday on 26th January', 'The institute will remain closed on 26th January on account of Republic Day.', 'notice', 'normal', 'all', NULL, 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(2, 1, 'admin', 'Mid-Term Exam Schedule', 'Mid-term examinations will commence from 10th March. See notice board for detailed timetable.', 'notice', 'high', 'all', NULL, 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(3, 1, 'admin', 'Hostel Fee Reminder', 'All hostel students are requested to pay the hostel fees by 31st January to avoid late fine.', 'alert', 'high', 'student', NULL, 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(4, 2, 'faculty', 'Data Structures Lab Cancelled', 'The Data Structures lab scheduled for 5th February is cancelled due to faculty meeting.', 'email', 'normal', 'batch', 1, 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(5, 1, 'admin', 'Library Timings Extended', 'Library will remain open till 10 PM during exam days.', 'notice', 'normal', 'all', NULL, 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `course_mappings`
--

CREATE TABLE `course_mappings` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_mappings`
--

INSERT INTO `course_mappings` (`id`, `program_id`, `subject_id`, `batch_id`, `faculty_id`, `academic_year`, `semester`, `status`) VALUES
(1, 1, 1, 1, 1, '2024-25', 2, 'active'),
(2, 1, 4, 1, 1, '2024-25', 2, 'active'),
(3, 1, 10, 1, 1, '2024-25', 2, 'active'),
(4, 2, 2, 2, 2, '2024-25', 2, 'active'),
(5, 2, 5, 2, 2, '2024-25', 2, 'active'),
(6, 2, 11, 2, 2, '2024-25', 2, 'active'),
(7, 3, 3, 3, 3, '2024-25', 3, 'active'),
(8, 3, 6, 3, 3, '2024-25', 3, 'active'),
(9, 3, 12, 3, 3, '2024-25', 3, 'active'),
(10, 1, 7, 4, 1, '2025-26', 1, 'active'),
(11, 2, 8, NULL, 2, '2025-26', 5, 'active'),
(12, 3, 9, NULL, 3, '2025-26', 5, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `type` enum('academic','administrative','support') DEFAULT 'academic',
  `head_of_department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `institute_id`, `name`, `code`, `type`, `head_of_department`, `email`, `phone`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Computer Science & Engineering', 'CSE', 'academic', 'Dr. A. Sharma', 'cse@nitdelhi.ac.in', '011-27787510', 'Department of Computer Science', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(2, 1, 'Electronics & Communication Engg.', 'ECE', 'academic', 'Dr. B. Verma', 'ece@nitdelhi.ac.in', '011-27787511', 'Department of Electronics', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(3, 1, 'Mechanical Engineering', 'ME', 'academic', 'Dr. C. Singh', 'mech@nitdelhi.ac.in', '011-27787512', 'Department of Mechanical Engg.', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(4, 1, 'Civil Engineering', 'CE', 'academic', 'Dr. D. Kapoor', 'civil@nitdelhi.ac.in', '011-27787513', 'Department of Civil Engg.', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `exam_type` varchar(50) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `passing_marks` int(11) DEFAULT NULL,
  `exam_venue` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled','upcoming') DEFAULT 'scheduled',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`id`, `name`, `exam_type`, `program_id`, `batch_id`, `semester`, `academic_year`, `exam_date`, `start_time`, `end_time`, `duration_minutes`, `total_marks`, `passing_marks`, `exam_venue`, `description`, `status`, `created_by`, `created_at`) VALUES
(1, 'Mid Term - Data Structures', 'Mid Term', 1, 1, 2, '2024-25', '2025-03-10', '10:00:00', '12:00:00', 120, 50, 20, 'LC-101', 'Mid term examination', 'scheduled', 1, '2026-03-18 10:43:07'),
(2, 'Final - Data Structures', 'Final', 1, 1, 2, '2024-25', '2025-05-15', '09:00:00', '12:00:00', 180, 100, 40, 'LC-101', 'Final exam', 'scheduled', 1, '2026-03-18 10:43:07'),
(3, 'Mid Term - DBMS', 'Mid Term', 1, 1, 2, '2024-25', '2025-03-12', '10:00:00', '12:00:00', 120, 50, 20, 'LC-102', 'Mid term', 'scheduled', 1, '2026-03-18 10:43:07'),
(4, 'Final - DBMS', 'Final', 1, 1, 2, '2024-25', '2025-05-17', '09:00:00', '12:00:00', 180, 100, 40, 'LC-102', 'Final', 'scheduled', 1, '2026-03-18 10:43:07'),
(5, 'Mid Term - Computer Networks', 'Mid Term', 1, 1, 2, '2024-25', '2025-03-14', '10:00:00', '12:00:00', 120, 50, 20, 'LC-103', 'Mid', 'scheduled', 1, '2026-03-18 10:43:07'),
(6, 'Final - Computer Networks', 'Final', 1, 1, 2, '2024-25', '2025-05-19', '09:00:00', '12:00:00', 180, 100, 40, 'LC-103', 'Final', 'scheduled', 1, '2026-03-18 10:43:07'),
(7, 'Mid Term - Digital Electronics', 'Mid Term', 2, 2, 2, '2024-25', '2025-03-11', '14:00:00', '16:00:00', 120, 50, 20, 'EC-201', 'Mid', 'scheduled', 1, '2026-03-18 10:43:07'),
(8, 'Final - Digital Electronics', 'Final', 2, 2, 2, '2024-25', '2025-05-16', '09:00:00', '12:00:00', 180, 100, 40, 'EC-201', 'Final', 'scheduled', 1, '2026-03-18 10:43:07'),
(9, 'Mid Term - Signals and Systems', 'Mid Term', 2, 2, 2, '2024-25', '2025-03-13', '14:00:00', '16:00:00', 120, 50, 20, 'EC-202', 'Mid', 'scheduled', 1, '2026-03-18 10:43:07'),
(11, 'Mid Term - Communication Systems', 'Mid Term', 2, 2, 2, '2024-25', '2025-03-15', '14:00:00', '16:00:00', 120, 50, 20, 'EC-203', 'Mid', 'scheduled', 1, '2026-03-18 10:43:07'),
(12, 'Final - Communication Systems', 'Final', 2, 2, 2, '2024-25', '2025-05-20', '09:00:00', '12:00:00', 180, 100, 40, 'EC-203', 'Final', 'scheduled', 1, '2026-03-18 10:43:07'),
(13, 'Mid Term - Thermodynamics', 'Mid Term', 3, 3, 3, '2024-25', '2025-03-10', '10:00:00', '12:00:00', 120, 50, 20, 'ME-301', 'Mid', 'scheduled', 1, '2026-03-18 10:43:07'),
(15, 'Mid Term - Fluid Mechanics', 'Mid Term', 3, 3, 3, '2024-25', '2025-03-12', '10:00:00', '12:00:00', 120, 50, 20, 'ME-302', 'Mid', 'scheduled', 1, '2026-03-18 10:43:07'),
(17, 'Mid Term - Engineering Mechanics', 'Mid Term', 3, 3, 3, '2024-25', '2025-03-14', '10:00:00', '12:00:00', 120, 50, 20, 'ME-303', 'Mid', 'scheduled', 1, '2026-03-18 10:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `fee_transactions`
--

CREATE TABLE `fee_transactions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `fee_type` varchar(50) DEFAULT 'tuition',
  `academic_year` varchar(20) DEFAULT NULL,
  `semester` int(11) DEFAULT 1,
  `amount_due` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `fine_amount` decimal(10,2) DEFAULT 0.00,
  `payment_period` varchar(50) DEFAULT 'Monthly',
  `discount` decimal(10,2) DEFAULT 0.00,
  `late_fee` decimal(10,2) DEFAULT 0.00,
  `payment_method` varchar(50) DEFAULT 'cash',
  `payment_status` enum('paid','partial','pending') DEFAULT 'paid',
  `bank_reference` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` enum('paid','partial','pending','failed') DEFAULT 'paid',
  `transaction_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_transactions`
--

INSERT INTO `fee_transactions` (`id`, `student_id`, `receipt_number`, `fee_type`, `academic_year`, `semester`, `amount_due`, `amount_paid`, `fine_amount`, `payment_period`, `discount`, `late_fee`, `payment_method`, `payment_status`, `bank_reference`, `remarks`, `created_by`, `status`, `transaction_date`, `due_date`, `created_at`) VALUES
(1, 1, 'RCPT/2024/001', 'tuition', NULL, 1, 125000.00, 125000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2024-08-15', NULL, '2026-03-18 11:48:42'),
(2, 1, 'RCPT/2025/001', 'hostel', NULL, 1, 80000.00, 80000.00, 0.00, 'Monthly', 0.00, 0.00, 'card', 'paid', NULL, NULL, NULL, 'paid', '2025-01-10', NULL, '2026-03-18 11:48:42'),
(3, 1, 'RCPT/2025/099', 'other', NULL, 1, 15000.00, 15000.00, 0.00, 'Monthly', 0.00, 0.00, 'cash', 'paid', NULL, NULL, NULL, 'paid', '2025-01-15', NULL, '2026-03-18 11:48:42'),
(4, 2, 'RCPT/2024/002', 'tuition', NULL, 1, 125000.00, 125000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2024-08-16', NULL, '2026-03-18 11:48:42'),
(5, 2, 'RCPT/2025/002', 'hostel', NULL, 1, 80000.00, 80000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2025-01-11', NULL, '2026-03-18 11:48:42'),
(6, 3, 'RCPT/2024/003', 'tuition', NULL, 1, 125000.00, 125000.00, 0.00, 'Monthly', 0.00, 0.00, 'cash', 'paid', NULL, NULL, NULL, 'paid', '2024-08-17', NULL, '2026-03-18 11:48:42'),
(7, 3, 'RCPT/2025/003', 'hostel', NULL, 1, 80000.00, 40000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'partial', NULL, NULL, NULL, 'paid', '2025-01-12', NULL, '2026-03-18 11:48:42'),
(8, 4, 'RCPT/2024/004', 'tuition', NULL, 1, 120000.00, 120000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2024-08-18', NULL, '2026-03-18 11:48:42'),
(9, 4, 'RCPT/2025/004', 'hostel', NULL, 1, 80000.00, 80000.00, 0.00, 'Monthly', 0.00, 0.00, 'card', 'paid', NULL, NULL, NULL, 'paid', '2025-01-13', NULL, '2026-03-18 11:48:42'),
(10, 5, 'RCPT/2024/005', 'tuition', NULL, 1, 120000.00, 120000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2024-08-19', NULL, '2026-03-18 11:48:42'),
(11, 5, 'RCPT/2025/005', 'hostel', NULL, 1, 80000.00, 80000.00, 0.00, 'Monthly', 0.00, 0.00, 'cash', 'paid', NULL, NULL, NULL, 'paid', '2025-01-14', NULL, '2026-03-18 11:48:42'),
(12, 6, 'RCPT/2024/006', 'tuition', NULL, 1, 120000.00, 120000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2024-08-20', NULL, '2026-03-18 11:48:42'),
(13, 6, 'RCPT/2025/006', 'hostel', NULL, 1, 80000.00, 80000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2025-01-15', NULL, '2026-03-18 11:48:42'),
(14, 7, 'RCPT/2024/007', 'tuition', NULL, 1, 60000.00, 60000.00, 0.00, 'Monthly', 0.00, 0.00, 'cash', 'paid', NULL, NULL, NULL, 'paid', '2024-08-21', NULL, '2026-03-18 11:48:42'),
(15, 7, 'RCPT/2025/007', 'hostel', NULL, 1, 50000.00, 50000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2025-01-16', NULL, '2026-03-18 11:48:42'),
(16, 8, 'RCPT/2024/008', 'tuition', NULL, 1, 60000.00, 60000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2024-08-22', NULL, '2026-03-18 11:48:42'),
(18, 9, 'RCPT/2024/009', 'tuition', NULL, 1, 60000.00, 60000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2024-08-23', NULL, '2026-03-18 11:48:42'),
(19, 9, 'RCPT/2025/009', 'hostel', NULL, 1, 50000.00, 50000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2025-01-18', NULL, '2026-03-18 11:48:42'),
(22, 11, 'RCPT/2025/012', 'tuition', NULL, 1, 130000.00, 130000.00, 0.00, 'Monthly', 0.00, 0.00, 'online', 'paid', NULL, NULL, NULL, 'paid', '2025-08-11', NULL, '2026-03-18 11:48:42'),
(23, 11, 'RCPT/2025/013', 'hostel', NULL, 1, 85000.00, 85000.00, 0.00, 'Monthly', 0.00, 0.00, 'card', 'paid', NULL, NULL, NULL, 'paid', '2025-08-11', NULL, '2026-03-18 11:48:42'),
(25, 12, 'RCPT/2025/015', 'hostel', NULL, 1, 85000.00, 0.00, 0.00, 'Monthly', 0.00, 0.00, '', 'pending', NULL, NULL, NULL, 'paid', '2025-08-12', NULL, '2026-03-18 11:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `holiday_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'India',
  `pincode` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `established_year` year(4) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `name`, `code`, `type`, `address`, `city`, `state`, `country`, `pincode`, `phone`, `email`, `website`, `established_year`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Sayantan Bharatiasdfasdf  safda', 'BTCSE', 'school', 'West Bengle', 'kolkatas', 'West Bengal', 'India', '743287', '01234125125', 'sayantanbharati611@gmail.com', 'https://www.nitdelhi.ac.in', '0000', 'adfga', 'active', '2026-03-18 11:10:09', '2026-03-18 11:33:29'),
(3, 'asdf', '51251', 'college', 'asdfasdfasd', '', '', 'India', 'asdfasdfa', '', '', '', NULL, '', 'active', '2026-03-18 11:33:45', '2026-03-18 11:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `institute_types`
--

CREATE TABLE `institute_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institute_types`
--

INSERT INTO `institute_types` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'College', 'COLL', 'Affiliated college', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(3, 'Institute', 'INST', 'Standalone institute', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(4, 'School', 'SCH', 'K-12 or professional school', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(5, 'asdf', 'asdfa', 'sdfasdf', 'active', '2026-03-18 11:10:44', '2026-03-18 11:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `library_books`
--

CREATE TABLE `library_books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `co_author` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_year` varchar(10) DEFAULT NULL,
  `edition` varchar(50) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `sub_category` varchar(100) DEFAULT NULL,
  `language` varchar(50) DEFAULT 'English',
  `total_pages` int(11) DEFAULT NULL,
  `total_copies` int(11) DEFAULT 0,
  `available_copies` int(11) DEFAULT 0,
  `rack_number` varchar(50) DEFAULT NULL,
  `shelf_number` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','lost','damaged','withdrawn') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library_books`
--

INSERT INTO `library_books` (`id`, `title`, `isbn`, `author`, `co_author`, `publisher`, `publication_year`, `edition`, `category`, `sub_category`, `language`, `total_pages`, `total_copies`, `available_copies`, `rack_number`, `shelf_number`, `description`, `status`, `created_at`) VALUES
(1, 'Introduction to Algorithms', '978-0262033848', 'Thomas H. Cormen', 'Charles E. Leiserson', 'MIT Press', '2009', '3rd', 'Computer Science', 'Algorithms', 'English', 1312, 5, 3, 'A1', 'S1', 'Classic algorithms textbook', 'active', '2026-03-18 10:43:07'),
(2, 'Digital Design', '978-0134549897', 'M. Morris Mano', 'Michael D. Ciletti', 'Pearson', '2018', '6th', 'Electronics', 'Digital Logic', 'English', 720, 4, 2, 'B2', 'S1', 'Digital design fundamentals', 'active', '2026-03-18 10:43:07'),
(3, 'Engineering Thermodynamics', '978-0073398174', 'Yunus A. Cengel', 'Michael A. Boles', 'McGraw-Hill', '2014', '8th', 'Mechanical', 'Thermodynamics', 'English', 1024, 3, 1, 'C3', 'S2', 'Thermodynamics principles', 'active', '2026-03-18 10:43:07'),
(4, 'Database System Concepts', '978-0078022159', 'Abraham Silberschatz', 'Henry F. Korth', 'McGraw-Hill', '2019', '7th', 'Computer Science', 'Databases', 'English', 1344, 4, 4, 'A2', 'S1', 'DBMS concepts', 'active', '2026-03-18 10:43:07'),
(5, 'Signals and Systems', '978-0138147570', 'Alan V. Oppenheim', 'Alan S. Willsky', 'Pearson', '2013', '2nd', 'Electronics', 'Signals', 'English', 957, 3, 1, 'B3', 'S2', 'Signals and systems analysis', 'active', '2026-03-18 10:43:07'),
(6, 'Fluid Mechanics', '978-0123821003', 'Frank M. White', 'Henry Xue', 'Academic Press', '2015', '8th', 'Mechanical', 'Fluids', 'English', 896, 3, 0, 'C4', 'S3', 'Fluid mechanics', 'damaged', '2026-03-18 10:43:07'),
(7, 'Computer Networks', '978-0132126953', 'Andrew S. Tanenbaum', 'David J. Wetherall', 'Pearson', '2010', '5th', 'Computer Science', 'Networking', 'English', 960, 5, 3, 'A3', 'S2', 'Networking protocols', 'active', '2026-03-18 10:43:07'),
(8, 'Robotics: Control, Sensing, Vision', '978-0071004213', 'K.S. Fu', 'R.C. Gonzalez', 'McGraw-Hill', '1987', '1st', 'Mechanical', 'Robotics', 'English', 580, 2, 1, 'C5', 'S4', 'Robotics fundamentals', 'active', '2026-03-18 10:43:07'),
(9, 'asdfsdfasdf', 'sdf', 'sdfa', 'dsfasdf', 'asdfa', '1800', 'asdfasdf', 'Arts', NULL, 'English', 0, 1, 1, 'sdfasdf', 'asdfa', 'sdfasdfasdf', '', '2026-03-18 11:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `staff_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `alternate_phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `qualification` text DEFAULT NULL,
  `experience_years` int(11) DEFAULT 0,
  `salary` decimal(10,2) DEFAULT NULL,
  `pan_number` varchar(20) DEFAULT NULL,
  `aadhaar_number` varchar(20) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `status` enum('active','inactive','suspended','retired','resigned') DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `staff_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `email`, `phone`, `alternate_phone`, `address`, `city`, `state`, `pincode`, `category_id`, `designation_id`, `qualification`, `experience_years`, `salary`, `pan_number`, `aadhaar_number`, `joining_date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, 'FAC001', 'Rajesh', 'K', 'Kumar', 'male', '1978-05-15', 'rajesh.kumar@nitdelhi.ac.in', '9876543210', '9876501234', '123 Faculty Colony', 'Delhi', 'Delhi', NULL, 1, 1, 'Ph.D. Computer Science', 0, 150000.00, NULL, NULL, '2015-07-01', 'active', NULL, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(3, NULL, 'FAC003', 'Anil', 'K', 'Gupta', 'male', '1975-11-10', 'anil.gupta@nitdelhi.ac.in', '9876543212', NULL, '789 Faculty Housing', 'Delhi', 'Delhi', NULL, 1, 1, 'Ph.D. Mechanical', 2, 155000.00, NULL, NULL, '2014-06-01', 'active', '', '2026-03-18 10:43:07', '2026-04-05 15:16:07'),
(4, NULL, 'FAC004', 'Sunita', 'R', 'Reddy', 'female', '1980-03-18', 'sunita.reddy@nitdelhi.ac.in', '9876543213', NULL, '321 Staff Quarters', 'Delhi', 'Delhi', NULL, 1, 3, 'M.Tech, Ph.D.', 0, 110000.00, NULL, NULL, '2017-09-01', 'active', NULL, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(5, 18, 'TCH2026333', 'Sayantan Bharati', '', 'Bharati', 'male', '0000-00-00', 'abcf@domain.com', '+911234125125', NULL, 'West Bengle', 'kolkata', 'West Bengal', NULL, 1, 1, '', 0, 0.00, NULL, NULL, '2026-04-30', 'active', '', '2026-03-18 12:06:21', '2026-04-05 15:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `staff_activities`
--

CREATE TABLE `staff_activities` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `activity_title` varchar(255) NOT NULL,
  `activity_description` text DEFAULT NULL,
  `activity_date` date NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_activities`
--

INSERT INTO `staff_activities` (`id`, `staff_id`, `activity_title`, `activity_description`, `activity_date`, `category`, `status`, `created_by`, `created_at`) VALUES
(1, 1, 'Monthly Faculty Meeting', 'Discussed syllabus progress.', '2026-04-01', 'Meeting', 'completed', 1, '2026-04-05 15:44:42'),
(2, 1, 'Workshop Prep', 'Preparing lab manuals.', '2026-04-10', 'Duties', 'pending', 1, '2026-04-05 15:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `staff_categories`
--

CREATE TABLE `staff_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_categories`
--

INSERT INTO `staff_categories` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Teaching', 'TCH', 'Faculty members', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(2, 'Non-Teaching', 'NTCH', 'Support staff', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(3, 'Administrative', 'ADMIN', 'Administrative staff', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(4, 'q351351', '51251', '251251', 'active', '2026-03-18 11:05:57', '2026-03-18 11:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `staff_designations`
--

CREATE TABLE `staff_designations` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `grade_level` int(11) DEFAULT 1,
  `salary_min` decimal(15,2) DEFAULT NULL,
  `salary_max` decimal(15,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_designations`
--

INSERT INTO `staff_designations` (`id`, `category_id`, `name`, `code`, `grade_level`, `salary_min`, `salary_max`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Professor', 'PROF', 5, NULL, NULL, 'Professor', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(2, 1, 'Associate Professor', 'ASSO', 4, NULL, NULL, 'Associate Professor', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(3, 1, 'Assistant Professor', 'ASST', 3, NULL, NULL, 'Assistant Professor', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(4, 2, 'Lab Assistant', 'LAB', 2, NULL, NULL, 'Laboratory Assistant', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(5, 2, 'Office Assistant', 'OFF', 2, NULL, NULL, 'Office Assistant', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(6, 3, 'Registrar', 'REG', 6, NULL, NULL, 'Registrar', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(7, 3, 'Accountant', 'ACC', 3, NULL, NULL, 'Accountant', 'active', '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(8, 0, 'Sayantan Bharati', 'BTCSE', 6, 43.00, 457.00, 'sdfh', 'active', '2026-03-18 11:41:45', '2026-03-18 11:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave_balance`
--

CREATE TABLE `staff_leave_balance` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `leave_year` year(4) NOT NULL,
  `casual_leave` int(11) DEFAULT 12,
  `sick_leave` int(11) DEFAULT 12,
  `earned_leave` int(11) DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_salaries`
--

CREATE TABLE `staff_salaries` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `bonus` decimal(10,2) DEFAULT 0.00,
  `deductions` decimal(10,2) DEFAULT 0.00,
  `month_year` varchar(20) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(50) DEFAULT 'bank_transfer',
  `receipt_no` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_salaries`
--

INSERT INTO `staff_salaries` (`id`, `staff_id`, `amount_paid`, `bonus`, `deductions`, `month_year`, `payment_date`, `payment_method`, `receipt_no`, `remarks`, `created_by`, `created_at`) VALUES
(1, 1, 45000.00, 2000.00, 500.00, 'March 2026', '2026-03-31', 'bank_transfer', 'TXN_MARCH_001', NULL, 1, '2026-04-05 15:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `staff_subject_allocations`
--

CREATE TABLE `staff_subject_allocations` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `allocation_type` varchar(50) DEFAULT 'primary',
  `hours_per_week` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_subject_allocations`
--

INSERT INTO `staff_subject_allocations` (`id`, `staff_id`, `subject_id`, `batch_id`, `academic_year`, `semester`, `allocation_type`, `hours_per_week`, `status`) VALUES
(1, 2, 1, 4, '2026-2027', 3, 'tutorial', 5, 'active'),
(2, 2, 9, 4, '2026-2027', 1, 'theory', 3, 'active'),
(3, 4, 10, 0, '2026-2027', 1, 'theory', 3, 'active'),
(4, 4, 2, 1, '2026-2027', 5, 'tutorial', 3, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admission_number` varchar(50) NOT NULL,
  `registration_no` varchar(50) DEFAULT NULL,
  `roll_number` varchar(50) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT 'Indian',
  `religion` varchar(100) DEFAULT NULL,
  `caste_category` varchar(100) DEFAULT NULL,
  `aadhaar_number` varchar(20) DEFAULT NULL,
  `identification_mark` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `personal_email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `alternate_phone` varchar(20) DEFAULT NULL,
  `permanent_address` text NOT NULL,
  `current_address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'India',
  `program_id` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `admission_date` date NOT NULL,
  `admission_type` varchar(50) DEFAULT 'regular',
  `admission_category` varchar(50) DEFAULT 'general',
  `current_semester` int(11) DEFAULT 1,
  `father_name` varchar(200) DEFAULT NULL,
  `father_email` varchar(100) DEFAULT NULL,
  `father_phone` varchar(20) DEFAULT NULL,
  `mother_name` varchar(200) DEFAULT NULL,
  `mother_phone` varchar(20) DEFAULT NULL,
  `mother_email` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(200) DEFAULT NULL,
  `guardian_relation` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `guardian_email` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive','graduated','suspended','discontinued','completed') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `admission_number`, `registration_no`, `roll_number`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `gender`, `blood_group`, `nationality`, `religion`, `caste_category`, `aadhaar_number`, `identification_mark`, `email`, `personal_email`, `phone`, `alternate_phone`, `permanent_address`, `current_address`, `city`, `state`, `pincode`, `country`, `program_id`, `batch_id`, `admission_date`, `admission_type`, `admission_category`, `current_semester`, `father_name`, `father_email`, `father_phone`, `mother_name`, `mother_phone`, `mother_email`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_email`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 6, 'ADM2024001', NULL, 'CSE24001', 'Aarav', 'K', 'Mehta', '2005-06-15', 'male', NULL, 'Indian', NULL, NULL, NULL, NULL, 'aarav.mehta@nitdelhi.ac.in', NULL, '9810012345', NULL, '12, Green Park, Delhi', NULL, NULL, NULL, NULL, 'India', 1, 1, '2024-08-10', 'regular', 'general', 2, 'Rajesh Mehta', 'rajesh.mehta@example.com', '9810011111', 'Sunita Mehta', '9810022222', 'sunita.mehta@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(2, 7, 'ADM2024002', NULL, 'CSE24002', 'Vihaan', 'S', 'Khanna', '2005-09-20', 'male', NULL, 'Indian', NULL, NULL, NULL, NULL, 'vihaan.khanna@nitdelhi.ac.in', NULL, '9810012346', NULL, '34, Model Town, Delhi', NULL, NULL, NULL, NULL, 'India', 1, 1, '2024-08-10', 'regular', 'general', 2, 'Sanjay Khanna', 'sanjay.khanna@example.com', '9810033333', 'Anita Khanna', '9810044444', 'anita.khanna@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(3, 8, 'ADM2024003', NULL, 'CSE24003', 'Vivaan', 'R', 'Saxena', '2005-11-02', 'male', NULL, 'Indian', NULL, NULL, NULL, NULL, 'vivaan.saxena@nitdelhi.ac.in', NULL, '9810012347', NULL, '56, Patel Nagar, Delhi', NULL, NULL, NULL, NULL, 'India', 1, 1, '2024-08-10', 'regular', 'general', 2, 'Rakesh Saxena', 'rakesh.saxena@example.com', '9810055555', 'Poonam Saxena', '9810066666', 'poonam.saxena@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(4, 9, 'ADM2024004', NULL, 'ECE24001', 'Ananya', 'P', 'Singh', '2005-04-18', 'female', NULL, 'Indian', NULL, NULL, NULL, NULL, 'ananya.singh@nitdelhi.ac.in', NULL, '9810012348', NULL, '78, Vikaspuri, Delhi', NULL, NULL, NULL, NULL, 'India', 2, 2, '2024-08-10', 'regular', 'general', 2, 'Arun Singh', 'arun.singh@example.com', '9810077777', 'Meena Singh', '9810088888', 'meena.singh@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(5, 10, 'ADM2024005', NULL, 'ECE24002', 'Diya', 'M', 'Patel', '2005-07-25', 'female', NULL, 'Indian', NULL, NULL, NULL, NULL, 'diya.patel@nitdelhi.ac.in', NULL, '9810012349', NULL, '90, Janakpuri, Delhi', NULL, NULL, NULL, NULL, 'India', 2, 2, '2024-08-10', 'regular', 'general', 2, 'Mahesh Patel', 'mahesh.patel@example.com', '9810099999', 'Geeta Patel', '9810000001', 'geeta.patel@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(6, 11, 'ADM2024006', NULL, 'ECE24003', 'Advik', 'N', 'Joshi', '2005-12-12', 'male', NULL, 'Indian', NULL, NULL, NULL, NULL, 'advik.joshi@nitdelhi.ac.in', NULL, '9810012350', NULL, '23, Rohini, Delhi', NULL, NULL, NULL, NULL, 'India', 2, 2, '2024-08-10', 'regular', 'general', 2, 'Nitin Joshi', 'nitin.joshi@example.com', '9810000111', 'Sangeeta Joshi', '9810000222', 'sangeeta.joshi@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(8, 13, 'ADM2024008', NULL, 'ME24002', 'Arjun', 'V', 'Nair', '2004-08-19', 'male', NULL, 'Indian', NULL, NULL, NULL, NULL, 'arjun.nair@nitdelhi.ac.in', NULL, '9810012352', NULL, '67, Noida', NULL, NULL, NULL, NULL, 'India', 3, 3, '2024-08-10', 'regular', 'general', 3, 'Vijay Nair', 'vijay.nair@example.com', '9810000555', 'Radha Nair', '9810000666', 'radha.nair@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(9, 14, 'ADM2024009', NULL, 'ME24003', 'Ishita', 'D', 'Desai', '2004-10-10', 'female', NULL, 'Indian', NULL, NULL, NULL, NULL, 'ishita.desai@nitdelhi.ac.in', NULL, '9810012353', NULL, '89, Ghaziabad', NULL, NULL, NULL, NULL, 'India', 3, 3, '2024-08-10', 'regular', 'general', 3, 'Dinesh Desai', 'dinesh.desai@example.com', '9810000777', 'Minal Desai', '9810000888', 'minal.desai@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(10, 15, 'ADM2024010', NULL, 'CSE25001', 'Rohan', 'K', 'Das', '2006-01-05', 'male', NULL, 'Indian', NULL, NULL, NULL, NULL, 'rohan.das@nitdelhi.ac.in', NULL, '9810012354', NULL, '12, Salt Lake, Delhi', NULL, NULL, NULL, NULL, 'India', 1, 4, '2025-08-10', 'regular', 'general', 1, 'Kalyan Das', 'kalyan.das@example.com', '9810000999', 'Nandini Das', '9810001000', 'nandini.das@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(11, 16, 'ADM2024011', NULL, 'CSE25002', 'Kavya', 'R', 'Menon', '2006-02-14', 'female', NULL, 'Indian', NULL, NULL, NULL, NULL, 'kavya.menon@nitdelhi.ac.in', NULL, '9810012355', NULL, '34, Andheri, Delhi', NULL, NULL, NULL, NULL, 'India', 1, 4, '2025-08-10', 'regular', 'general', 1, 'Ramesh Menon', 'ramesh.menon@example.com', '9810001111', 'Shobha Menon', '9810001222', 'shobha.menon@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(12, 17, 'ADM2024012', NULL, 'CSE25003', 'Reyansh', 'G', 'Gupta', '2006-03-22', 'male', NULL, 'Indian', NULL, NULL, NULL, NULL, 'reyansh.gupta@nitdelhi.ac.in', NULL, '9810012356', NULL, '56, Connaught Place, Delhi', NULL, NULL, NULL, NULL, 'India', 1, 4, '2025-08-10', 'regular', 'general', 1, 'Gaurav Gupta', 'gaurav.gupta@example.com', '9810001333', 'Anjali Gupta', '9810001444', 'anjali.gupta@example.com', NULL, NULL, NULL, NULL, 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(13, 19, 'ADM20265479', NULL, NULL, 'Sayantan Bharati', '', 'Bharati', '2026-03-31', 'male', '', 'Indian', NULL, NULL, NULL, NULL, NULL, 'abcs@domain.com', '+911234125125', '', 'asdf', 'asdfas', 'dfasdf', 'asdfa', 'sdfasdf', 'India', NULL, NULL, '2026-03-18', 'transfer', 'general', 1, '', NULL, '', '', '', NULL, '', '', '', NULL, 'active', NULL, '2026-03-18 12:07:03', '2026-03-18 12:18:53'),
(14, NULL, 'ADM20260001', 'REG2024101', NULL, 'Arjun', NULL, 'Mehta', '2005-06-15', 'male', 'O+', 'Indian', 'Hinduism', 'General', '123456789012', 'Mole on right cheek', NULL, NULL, '9876543210', NULL, '123, Rose Villa, MG Road, Mumbai', NULL, NULL, NULL, NULL, 'India', 1, 1, '2026-04-05', 'regular', 'general', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, '2026-04-05 15:44:42', '2026-04-05 15:44:42'),
(15, NULL, 'ADM20260002', 'REG2024102', NULL, 'Sanya', NULL, 'Iyer', '2005-09-22', 'female', 'B+', 'Indian', 'Hinduism', 'OBC', '987654321098', 'Scar on left arm', NULL, NULL, '9876543211', NULL, '45, Skyline Apts, Adyar, Chennai', NULL, NULL, NULL, NULL, 'India', 1, 1, '2026-04-05', 'regular', 'general', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, '2026-04-05 15:44:42', '2026-04-05 15:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_summary`
--

CREATE TABLE `student_attendance_summary` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `attendance_percentage` decimal(5,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `examination_id` int(11) DEFAULT NULL,
  `total_marks` decimal(5,2) DEFAULT NULL,
  `marks_obtained` decimal(5,2) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL,
  `grade_point` decimal(3,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_grades`
--

INSERT INTO `student_grades` (`id`, `student_id`, `subject_id`, `examination_id`, `total_marks`, `marks_obtained`, `grade`, `grade_point`, `remarks`, `created_at`) VALUES
(1, 1, 1, 1, 50.00, 42.00, 'A', 9.00, 'Good', '2026-03-18 10:43:07'),
(2, 1, 1, 2, 100.00, 81.00, 'A', 8.50, '', '2026-03-18 10:43:07'),
(3, 1, 4, 3, 50.00, 38.00, 'B+', 8.00, '', '2026-03-18 10:43:07'),
(4, 1, 4, 4, 100.00, 75.00, 'B', 7.50, '', '2026-03-18 10:43:07'),
(5, 1, 10, 5, 50.00, 44.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(6, 1, 10, 6, 100.00, 88.00, 'A+', 9.50, 'Excellent', '2026-03-18 10:43:07'),
(7, 2, 1, 1, 50.00, 35.00, 'B', 7.00, '', '2026-03-18 10:43:07'),
(8, 2, 1, 2, 100.00, 72.00, 'B', 7.00, '', '2026-03-18 10:43:07'),
(9, 2, 4, 3, 50.00, 40.00, 'A', 8.50, '', '2026-03-18 10:43:07'),
(10, 2, 4, 4, 100.00, 79.00, 'B+', 8.00, '', '2026-03-18 10:43:07'),
(11, 2, 10, 5, 50.00, 32.00, 'C+', 6.50, '', '2026-03-18 10:43:07'),
(12, 2, 10, 6, 100.00, 68.00, 'B-', 6.50, '', '2026-03-18 10:43:07'),
(13, 3, 1, 1, 50.00, 48.00, 'A+', 9.99, '', '2026-03-18 10:43:07'),
(14, 3, 1, 2, 100.00, 95.00, 'A+', 9.99, 'Outstanding', '2026-03-18 10:43:07'),
(15, 3, 4, 3, 50.00, 45.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(16, 3, 4, 4, 100.00, 90.00, 'A+', 9.50, '', '2026-03-18 10:43:07'),
(17, 3, 10, 5, 50.00, 41.00, 'A', 8.50, '', '2026-03-18 10:43:07'),
(18, 3, 10, 6, 100.00, 87.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(19, 4, 2, 7, 50.00, 37.00, 'B+', 8.00, '', '2026-03-18 10:43:07'),
(20, 4, 2, 8, 100.00, 74.00, 'B', 7.50, '', '2026-03-18 10:43:07'),
(21, 4, 5, 9, 50.00, 33.00, 'C+', 6.50, '', '2026-03-18 10:43:07'),
(22, 4, 5, 10, 100.00, 71.00, 'B-', 6.50, '', '2026-03-18 10:43:07'),
(23, 4, 11, 11, 50.00, 39.00, 'B+', 8.00, '', '2026-03-18 10:43:07'),
(24, 4, 11, 12, 100.00, 76.00, 'B', 7.50, '', '2026-03-18 10:43:07'),
(25, 5, 2, 7, 50.00, 42.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(26, 5, 2, 8, 100.00, 85.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(27, 5, 5, 9, 50.00, 40.00, 'A', 8.50, '', '2026-03-18 10:43:07'),
(28, 5, 5, 10, 100.00, 82.00, 'A', 8.50, '', '2026-03-18 10:43:07'),
(29, 5, 11, 11, 50.00, 38.00, 'B+', 8.00, '', '2026-03-18 10:43:07'),
(30, 5, 11, 12, 100.00, 79.00, 'B+', 8.00, '', '2026-03-18 10:43:07'),
(31, 6, 2, 7, 50.00, 30.00, 'C', 5.50, '', '2026-03-18 10:43:07'),
(32, 6, 2, 8, 100.00, 62.00, 'C+', 6.00, '', '2026-03-18 10:43:07'),
(33, 6, 5, 9, 50.00, 28.00, 'C-', 5.00, '', '2026-03-18 10:43:07'),
(34, 6, 5, 10, 100.00, 55.00, 'D', 4.50, 'Needs improvement', '2026-03-18 10:43:07'),
(35, 6, 11, 11, 50.00, 31.00, 'C', 5.50, '', '2026-03-18 10:43:07'),
(36, 6, 11, 12, 100.00, 64.00, 'C+', 6.00, '', '2026-03-18 10:43:07'),
(37, 7, 3, 13, 50.00, 43.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(38, 7, 3, 14, 100.00, 87.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(39, 7, 6, 15, 50.00, 41.00, 'A', 8.50, '', '2026-03-18 10:43:07'),
(40, 7, 6, 16, 100.00, 83.00, 'A', 8.50, '', '2026-03-18 10:43:07'),
(41, 7, 12, 17, 50.00, 45.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(42, 7, 12, 18, 100.00, 91.00, 'A+', 9.50, '', '2026-03-18 10:43:07'),
(43, 8, 3, 13, 50.00, 36.00, 'B', 7.50, '', '2026-03-18 10:43:07'),
(44, 8, 3, 14, 100.00, 73.00, 'B', 7.00, '', '2026-03-18 10:43:07'),
(45, 8, 6, 15, 50.00, 34.00, 'C+', 6.50, '', '2026-03-18 10:43:07'),
(46, 8, 6, 16, 100.00, 69.00, 'B-', 6.50, '', '2026-03-18 10:43:07'),
(47, 8, 12, 17, 50.00, 37.00, 'B+', 8.00, '', '2026-03-18 10:43:07'),
(48, 8, 12, 18, 100.00, 77.00, 'B+', 8.00, '', '2026-03-18 10:43:07'),
(49, 9, 3, 13, 50.00, 47.00, 'A+', 9.99, '', '2026-03-18 10:43:07'),
(50, 9, 3, 14, 100.00, 93.00, 'A+', 9.99, '', '2026-03-18 10:43:07'),
(51, 9, 6, 15, 50.00, 44.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(52, 9, 6, 16, 100.00, 88.00, 'A', 9.00, '', '2026-03-18 10:43:07'),
(53, 9, 12, 17, 50.00, 46.00, 'A+', 9.50, '', '2026-03-18 10:43:07'),
(54, 9, 12, 18, 100.00, 94.00, 'A+', 9.99, '', '2026-03-18 10:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `credit_hours` decimal(4,2) DEFAULT 3.00,
  `theory_hours` int(11) DEFAULT 0,
  `practical_hours` int(11) DEFAULT 0,
  `subject_type` enum('core','elective','lab','project','seminar','workshop') DEFAULT 'core',
  `difficulty_level` enum('basic','intermediate','advanced') DEFAULT 'intermediate',
  `department_id` int(11) DEFAULT NULL,
  `prerequisites` text DEFAULT NULL,
  `learning_outcomes` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `credit_hours`, `theory_hours`, `practical_hours`, `subject_type`, `difficulty_level`, `department_id`, `prerequisites`, `learning_outcomes`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Data Structures', 'CSE201', 'Fundamental data structures', 4.00, 3, 2, 'lab', 'intermediate', 1, 'Programming in C', 'Ability to implement and use data structures', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 11:08:15'),
(2, 'Digital Electronics', 'ECE202', 'Digital logic design', 4.00, 3, 2, 'core', 'intermediate', 2, 'Basic Electronics', 'Design combinational/sequential circuits', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(3, 'Thermodynamics', 'ME203', 'Laws of thermodynamics', 3.00, 3, 0, 'core', 'intermediate', 3, 'Physics', 'Apply thermodynamic principles', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(4, 'Database Management Systems', 'CSE204', 'DBMS concepts', 4.00, 3, 2, 'core', 'intermediate', 1, 'Data Structures', 'Design and query databases', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(5, 'Signals and Systems', 'ECE205', 'Continuous and discrete signals', 4.00, 3, 2, 'core', 'advanced', 2, 'Mathematics', 'Analyze signals in time/frequency domain', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(6, 'Fluid Mechanics', 'ME206', 'Fluid properties and dynamics', 3.00, 3, 0, 'core', 'intermediate', 3, 'Thermodynamics', 'Solve fluid flow problems', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(7, 'Machine Learning', 'CSE401', 'Introduction to ML', 3.00, 2, 2, 'elective', 'advanced', 1, 'Data Structures, Probability', 'Build predictive models', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(8, 'VLSI Design', 'ECE402', 'VLSI circuit design', 4.00, 3, 2, 'elective', 'advanced', 2, 'Digital Electronics', 'Design CMOS circuits', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(9, 'Robotics', 'ME403', 'Fundamentals of robotics', 3.00, 2, 2, 'elective', 'advanced', 3, 'Kinematics', 'Program and control robots', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(10, 'Computer Networks', 'CSE305', 'Network protocols', 4.00, 3, 2, 'core', 'intermediate', 1, 'Operating Systems', 'Understand TCP/IP stack', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07'),
(11, 'Communication Systems', 'ECE306', 'Analog and digital comm', 4.00, 3, 2, 'core', 'intermediate', 2, 'Signals and Systems', 'Design communication links', 'active', 1, '2026-03-18 10:43:07', '2026-03-18 10:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `setting_key`, `setting_value`) VALUES
(1, 'institution_name', 'dsafsdf'),
(2, 'institution_address', 'asdfasdfa'),
(3, 'institution_phone', 'asdfasdf'),
(4, 'institution_email', 'adfadf@gmail.com'),
(5, 'institution_website', 'https://adfadfgmail.com'),
(6, 'current_academic_year', '2026-2027'),
(7, 'current_semester', '1'),
(8, 'minimum_attendance_percentage', '75'),
(9, 'passing_marks_percentage', '35'),
(10, 'date_format', 'd/m/Y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('admin','faculty','student') DEFAULT 'student',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','suspended','') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `created_at`, `status`) VALUES
(1, 'Admin', 'admin', 'abc@domain.com', '$2y$10$H/odR/w1wilG8yifOx7BrO0xsd0N04Nlb8QshQWcSN54J0b92RcDe', '2026-03-18 10:53:43', 'active'),
(18, 'Sayantan Bharati', 'faculty', 'abcf@domain.com', '$2y$10$2B5eR7gzXfZEnI55lTioBuiPFXO8l3CiKMzgGD6gxFe2seGXljPmC', '2026-03-18 12:06:21', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_batches`
--
ALTER TABLE `academic_batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_batch_code` (`program_id`,`batch_code`);

--
-- Indexes for table `academic_programs`
--
ALTER TABLE `academic_programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communications`
--
ALTER TABLE `communications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_mappings`
--
ALTER TABLE `course_mappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_dept_code` (`institute_id`,`code`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_transactions`
--
ALTER TABLE `fee_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt_number` (`receipt_number`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `holiday_date` (`holiday_date`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `institute_types`
--
ALTER TABLE `institute_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `library_books`
--
ALTER TABLE `library_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `staff_activities`
--
ALTER TABLE `staff_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_categories`
--
ALTER TABLE `staff_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `staff_designations`
--
ALTER TABLE `staff_designations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `staff_leave_balance`
--
ALTER TABLE `staff_leave_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_salaries`
--
ALTER TABLE `staff_salaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt_no` (`receipt_no`);

--
-- Indexes for table `staff_subject_allocations`
--
ALTER TABLE `staff_subject_allocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admission_number` (`admission_number`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `student_attendance_summary`
--
ALTER TABLE `student_attendance_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_subject_code` (`code`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_batches`
--
ALTER TABLE `academic_batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `academic_programs`
--
ALTER TABLE `academic_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_schedules`
--
ALTER TABLE `class_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `communications`
--
ALTER TABLE `communications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_mappings`
--
ALTER TABLE `course_mappings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fee_transactions`
--
ALTER TABLE `fee_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `institute_types`
--
ALTER TABLE `institute_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `library_books`
--
ALTER TABLE `library_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_activities`
--
ALTER TABLE `staff_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_categories`
--
ALTER TABLE `staff_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_designations`
--
ALTER TABLE `staff_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff_leave_balance`
--
ALTER TABLE `staff_leave_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_salaries`
--
ALTER TABLE `staff_salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_subject_allocations`
--
ALTER TABLE `staff_subject_allocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_attendance_summary`
--
ALTER TABLE `student_attendance_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
