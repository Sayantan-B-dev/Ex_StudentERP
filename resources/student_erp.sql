-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2026 at 08:06 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_erp`
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
  `fee_structure` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fee_structure`)),
  `admission_criteria` text DEFAULT NULL,
  `status` enum('active','completed','upcoming','cancelled') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_programs`
--

INSERT INTO `academic_programs` (`id`, `name`, `code`, `description`, `duration_years`, `total_credits`, `department_id`, `degree_type`, `program_level`, `accreditation_status`, `start_date`, `end_date`, `total_semesters`, `max_students`, `current_students`, `program_fee`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Full Time Diploma Course', 'DIP1', 'Full Time Diploma Course Full Time Diploma Course', 3, 100, 1, 'diploma', 'diploma', 'accredited', '2025-08-01', '2026-01-31', 6, 60, 52, '152000.00', 'active', 1, '2025-11-14 07:06:54', '2025-12-04 05:14:36'),
(2, 'Vocational Diploma Course', 'DIP2', 'Vocational Diploma Course (2 years)', 2, 80, 1, 'diploma', 'diploma', 'accredited', '2025-08-01', '2026-01-31', 4, 20, 15, '100000.00', 'active', 1, '2025-11-14 07:08:32', '2025-12-04 05:14:36');

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
  `total_students` int(11) DEFAULT 0,
  `total_faculty` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `institute_id`, `name`, `code`, `type`, `head_of_department`, `email`, `phone`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'D-CST', 'CST', 'academic', 'S. Paul', 'kpchodcst@keical.edu.in', '1234658790', 'TestTestTestTestTestTestTestTestTestTestTestTest', 'active', '2025-10-11 07:18:40', '2025-10-11 07:19:48'),
(2, 1, 'CRC', 'CRC', 'administrative', 'S. BISWAS', 'abcf@domain.com', '1234658790', 'sgsdfgsdfgd', 'active', '2025-10-11 07:19:32', '2025-10-11 07:20:10');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `name`, `code`, `type`, `address`, `city`, `state`, `country`, `pincode`, `phone`, `email`, `website`, `established_year`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kingston Polytechnic College', 'KPC', 'college', 'KINGSTON EDUCATIONAL INSTITUTE, Berunanpukhuria, West Bengal', 'Barasat', 'West Bengal', 'India', '700122', '1234658790', 'kpcprincipal@keical.edu.in', 'https://www.keical.edu.in', 2004, 'Kingston Law College is a Legal education institution situated at Berunanpukuria, North 24 Parganas in the indian state of West Bengal. It is affiliated to the West Bengal State University. It offers 3 years and 5-year Integrated Course in Law leading to LL.B and B.A.', 'active', '2025-10-11 06:36:26', '2025-10-11 06:36:26');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institute_types`
--

INSERT INTO `institute_types` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'University', 'UNIV', 'Higher education and research institution', 'active', '2025-10-11 06:53:38', '2025-10-11 06:53:38'),
(2, 'College', 'COL', 'Educational institution or constituent part', 'active', '2025-10-11 06:53:38', '2025-10-11 06:53:38'),
(3, 'School', 'SCH', 'Primary or secondary educational institution', 'active', '2025-10-11 06:53:38', '2025-10-11 06:53:38'),
(4, 'Institute', 'INST', 'Specialized educational institution', 'active', '2025-10-11 06:53:38', '2025-10-11 06:53:38'),
(5, 'Training Center', 'TRG', 'Vocational and training institution', 'active', '2025-10-11 06:53:38', '2025-10-11 06:53:38'),
(6, 'Research Center', 'RES', 'Research and development institution', 'active', '2025-10-11 06:53:38', '2025-10-11 06:53:38'),
(7, 'Test', 'Test', 'TestTestTest', 'active', '2025-10-11 07:17:22', '2025-10-11 07:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `program_subjects`
--

CREATE TABLE `program_subjects` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `is_optional` tinyint(1) DEFAULT 0,
  `min_credits` decimal(4,2) DEFAULT NULL,
  `max_credits` decimal(4,2) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT NULL,
  `course_type` enum('mandatory','elective','audit') DEFAULT 'mandatory',
  `teaching_methodology` text DEFAULT NULL,
  `assessment_pattern` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`assessment_pattern`)),
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_subjects`
--

INSERT INTO `program_subjects` (`id`, `program_id`, `subject_id`, `semester`, `is_optional`, `min_credits`, `max_credits`, `course_code`, `course_type`, `teaching_methodology`, `assessment_pattern`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 4, 0, '2.00', '3.00', '', 'mandatory', 'sdfdsfds', NULL, 'active', '2025-12-09 05:34:59', '2025-12-09 05:34:59'),
(2, 2, 1, 1, 0, '5.00', '5.00', 'EM', 'mandatory', '', NULL, 'active', '2025-12-09 05:36:02', '2025-12-09 05:36:02'),
(3, 2, 3, 4, 0, '1.00', '3.00', 'COPC', 'mandatory', '', NULL, 'active', '2025-12-09 05:39:56', '2025-12-09 05:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
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
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `qualification` text DEFAULT NULL,
  `experience_years` int(11) DEFAULT 0,
  `joining_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(50) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  `pan_number` varchar(20) DEFAULT NULL,
  `aadhaar_number` varchar(20) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','suspended','retired','resigned') DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `email`, `phone`, `alternate_phone`, `address`, `city`, `state`, `pincode`, `emergency_contact_name`, `emergency_contact_phone`, `category_id`, `designation_id`, `qualification`, `experience_years`, `joining_date`, `salary`, `bank_name`, `bank_account_number`, `ifsc_code`, `pan_number`, `aadhaar_number`, `profile_image`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'TPRI2025120001', 'Sudipta', 'Ghosh', 'Sur', 'female', '1980-12-12', 'abcf@domain.com', '1234658790', '5648795610', 'barasat', 'Barasat', 'West Bengal', '700126', '3265745', '87656789', 1, 1, 'Mtech', 10, '2022-12-09', '50000.00', 'SBI', '4567892135648', 'SBIN001770', 'bpb47a', '456765892156', NULL, 'active', 'gfsdgsdgsfgs sdgfgsdgsdg', '2025-12-09 06:48:51', '2025-12-09 06:48:51'),
(2, 'TASS2026030001', 'Sovonesh', '', 'Pal', 'male', '1980-12-12', 'hodcst@keical.edu.in', '9874563278', '6297568923', 'kaikhali', 'Kolkata', 'WB', '700012', 'NA', 'NA', 1, 5, 'MCA', 20, '2004-03-12', '100000.00', 'SBI', '123654879132', 'SBIN0001700', 'BBAI3451J', '569823652156', NULL, 'active', 'LKHFLKHGDS', '2026-03-12 05:41:09', '2026-03-12 05:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `staff_allocations`
--

CREATE TABLE `staff_allocations` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `allocation_type` enum('primary','additional','temporary') DEFAULT 'primary',
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `reporting_to` int(11) DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `workload_hours` int(11) DEFAULT 40,
  `status` enum('active','completed','transferred','terminated') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_categories`
--

INSERT INTO `staff_categories` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Teaching Staff', 'TEACHING', 'Faculty and teaching personnel', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(2, 'Non-Teaching Staff', 'NON_TEACHING', 'Administrative and support staff', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `staff_designations`
--

CREATE TABLE `staff_designations` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `level` int(11) DEFAULT 1,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_designations`
--

INSERT INTO `staff_designations` (`id`, `category_id`, `name`, `code`, `level`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Principal', 'PRINCIPAL', 1, 'Institute Principal/Head', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(2, 1, 'Vice Principal', 'VICE_PRINCIPAL', 2, 'Assistant Principal', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(3, 1, 'Professor', 'PROFESSOR', 3, 'Senior Professor', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(4, 1, 'Associate Professor', 'ASSOC_PROF', 4, 'Associate Professor', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(5, 1, 'Assistant Professor', 'ASST_PROF', 5, 'Assistant Professor', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(6, 1, 'Lecturer', 'LECTURER', 6, 'Lecturer/Instructor', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(7, 1, 'Laboratory Technical Assistant', 'LAB_TECH', 7, 'Lab Technician/Assistant', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(8, 2, 'Admin Manager', 'ADMIN_MGR', 1, 'Administrative Manager', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(9, 2, 'Office Staff', 'OFFICE_STAFF', 2, 'Office Administration Staff', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(10, 2, 'Accountant', 'ACCOUNTANT', 3, 'Finance and Accounts', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(11, 2, 'Clerk', 'CLERK', 4, 'Office Clerk', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(12, 2, 'Peon', 'PEON', 5, 'Office Assistant', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(13, 2, 'Security Guard', 'SECURITY', 6, 'Security Personnel', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38'),
(14, 2, 'Cleaner', 'CLEANER', 7, 'Cleaning Staff', 'active', '2025-12-09 06:14:38', '2025-12-09 06:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `staff_documents`
--

CREATE TABLE `staff_documents` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_path` varchar(500) NOT NULL,
  `document_number` varchar(100) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0,
  `notes` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `earned_leave` int(11) DEFAULT 15,
  `maternity_leave` int(11) DEFAULT 180,
  `paternity_leave` int(11) DEFAULT 15,
  `other_leave` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_leave_balance`
--

INSERT INTO `staff_leave_balance` (`id`, `staff_id`, `leave_year`, `casual_leave`, `sick_leave`, `earned_leave`, `maternity_leave`, `paternity_leave`, `other_leave`, `created_at`, `updated_at`) VALUES
(1, 1, 2025, 12, 12, 15, 180, 15, 0, '2025-12-09 06:48:51', '2025-12-09 06:48:51'),
(2, 1, 2026, 12, 12, 15, 180, 15, 0, '2026-03-12 05:34:47', '2026-03-12 05:34:47'),
(3, 2, 2026, 12, 12, 15, 180, 15, 0, '2026-03-12 05:41:10', '2026-03-12 05:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admission_number` varchar(50) NOT NULL,
  `roll_number` varchar(50) DEFAULT NULL,
  `enrollment_number` varchar(50) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `nationality` varchar(50) DEFAULT 'Indian',
  `religion` varchar(50) DEFAULT NULL,
  `caste_category` varchar(50) DEFAULT NULL,
  `aadhaar_number` varchar(12) DEFAULT NULL,
  `pan_number` varchar(10) DEFAULT NULL,
  `personal_email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `alternate_phone` varchar(20) DEFAULT NULL,
  `permanent_address` text NOT NULL,
  `current_address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'India',
  `program_id` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `admission_date` date NOT NULL,
  `admission_type` enum('regular','lateral','transfer','management','nri') DEFAULT 'regular',
  `admission_category` enum('general','obc','sc','st','ews','other') DEFAULT 'general',
  `current_semester` int(11) DEFAULT 1,
  `father_name` varchar(200) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `father_phone` varchar(20) DEFAULT NULL,
  `father_email` varchar(100) DEFAULT NULL,
  `mother_name` varchar(200) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(20) DEFAULT NULL,
  `mother_email` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(200) DEFAULT NULL,
  `guardian_relation` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `guardian_email` varchar(100) DEFAULT NULL,
  `guardian_address` text DEFAULT NULL,
  `emergency_contact_name` varchar(200) DEFAULT NULL,
  `emergency_contact_relation` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `disability_status` tinyint(1) DEFAULT 0,
  `disability_details` text DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `height` decimal(4,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `signature_path` varchar(255) DEFAULT NULL,
  `id_card_path` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','graduated','suspended','discontinued','completed') DEFAULT 'active',
  `graduation_date` date DEFAULT NULL,
  `leaving_date` date DEFAULT NULL,
  `leaving_reason` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_academic_history`
--

CREATE TABLE `student_academic_history` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `institution_name` varchar(255) NOT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `board_university` varchar(255) DEFAULT NULL,
  `year_of_passing` year(4) DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `marks_obtained` int(11) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  `subject_stream` varchar(100) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `academic_year` varchar(20) DEFAULT NULL,
  `month_year` varchar(10) DEFAULT NULL,
  `total_classes` int(11) DEFAULT 0,
  `classes_present` int(11) DEFAULT 0,
  `classes_absent` int(11) DEFAULT 0,
  `classes_leave` int(11) DEFAULT 0,
  `attendance_percentage` decimal(5,2) DEFAULT 0.00,
  `status` enum('satisfactory','warning','unsatisfactory') DEFAULT 'satisfactory',
  `last_updated` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_batches`
--

CREATE TABLE `student_batches` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `enrollment_number` varchar(50) NOT NULL,
  `enrollment_date` date NOT NULL,
  `enrollment_type` enum('regular','lateral','transfer','exchange') DEFAULT 'regular',
  `roll_number` varchar(20) DEFAULT NULL,
  `academic_session` varchar(20) DEFAULT NULL,
  `current_semester` int(11) DEFAULT 1,
  `admission_category` enum('general','obc','sc','st','ews','pwd','sports','cultural') DEFAULT 'general',
  `quota_category` enum('management','government','nri','foreign') DEFAULT 'management',
  `fee_category` enum('regular','self_finance','scholarship','free_ship') DEFAULT 'regular',
  `academic_status` enum('active','completed','dropped','suspended','transfered','graduated') DEFAULT 'active',
  `promotion_status` enum('promoted','detained','under_review') DEFAULT 'promoted',
  `current_cgpa` decimal(4,2) DEFAULT 0.00,
  `total_credits_earned` decimal(6,2) DEFAULT 0.00,
  `total_backlogs` int(11) DEFAULT 0,
  `total_attendance_percentage` decimal(5,2) DEFAULT 0.00,
  `attendance_shortage` tinyint(1) DEFAULT 0,
  `fee_status` enum('paid','pending','partial','overdue') DEFAULT 'pending',
  `last_fee_paid_date` date DEFAULT NULL,
  `next_fee_due_date` date DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_relation` varchar(50) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `guardian_email` varchar(100) DEFAULT NULL,
  `guardian_address` text DEFAULT NULL,
  `previous_qualification` varchar(255) DEFAULT NULL,
  `previous_school_college` varchar(255) DEFAULT NULL,
  `previous_percentage` decimal(5,2) DEFAULT NULL,
  `previous_year` year(4) DEFAULT NULL,
  `documents_submitted` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`documents_submitted`)),
  `document_verification_status` enum('pending','verified','rejected') DEFAULT 'pending',
  `document_verification_notes` text DEFAULT NULL,
  `hostel_required` tinyint(1) DEFAULT 0,
  `transport_required` tinyint(1) DEFAULT 0,
  `hostel_room_number` varchar(20) DEFAULT NULL,
  `transport_route_id` int(11) DEFAULT NULL,
  `admission_confirmed_date` date DEFAULT NULL,
  `classes_started_date` date DEFAULT NULL,
  `last_attendance_date` date DEFAULT NULL,
  `expected_graduation_date` date DEFAULT NULL,
  `actual_graduation_date` date DEFAULT NULL,
  `status` enum('active','inactive','graduated','withdrawn') DEFAULT 'active',
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_batch_history`
--

CREATE TABLE `student_batch_history` (
  `id` int(11) NOT NULL,
  `student_batch_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `from_semester` int(11) DEFAULT NULL,
  `to_semester` int(11) DEFAULT NULL,
  `academic_status` enum('active','completed','dropped','suspended','transfered','graduated') DEFAULT NULL,
  `promotion_status` enum('promoted','detained','under_review') DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_documents`
--

CREATE TABLE `student_documents` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `document_type` enum('photo','signature','id_card','transfer_certificate','marksheet','aadhaar','pan','passport','caste_certificate','income_certificate','medical_certificate','other') DEFAULT 'other',
  `document_name` varchar(255) NOT NULL,
  `document_path` varchar(255) NOT NULL,
  `file_size` int(11) DEFAULT NULL,
  `mime_type` varchar(100) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0,
  `verified_by` int(11) DEFAULT NULL,
  `verification_date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_semester_registration`
--

CREATE TABLE `student_semester_registration` (
  `id` int(11) NOT NULL,
  `student_batch_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `registration_status` enum('registered','pending','rejected','completed') DEFAULT 'pending',
  `total_credits_registered` decimal(6,2) DEFAULT 0.00,
  `total_subjects_registered` int(11) DEFAULT 0,
  `fee_paid` tinyint(1) DEFAULT 0,
  `fee_amount` decimal(10,2) DEFAULT 0.00,
  `fee_paid_date` date DEFAULT NULL,
  `approval_status` enum('approved','pending','rejected') DEFAULT 'pending',
  `approved_by` int(11) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_enrollment`
--

CREATE TABLE `student_subject_enrollment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `program_subject_id` int(11) DEFAULT NULL,
  `semester` int(11) NOT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `enrollment_type` enum('regular','repeat','improvement','audit') DEFAULT 'regular',
  `enrollment_date` date NOT NULL,
  `status` enum('enrolled','completed','dropped','failed') DEFAULT 'enrolled',
  `attendance_percentage` decimal(5,2) DEFAULT 0.00,
  `internal_marks` decimal(5,2) DEFAULT NULL,
  `external_marks` decimal(5,2) DEFAULT NULL,
  `total_marks` decimal(5,2) DEFAULT NULL,
  `grade` varchar(2) DEFAULT NULL,
  `grade_point` decimal(3,2) DEFAULT NULL,
  `result_status` enum('pass','fail','pending') DEFAULT 'pending',
  `credit_earned` decimal(4,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `credit_hours`, `theory_hours`, `practical_hours`, `subject_type`, `difficulty_level`, `department_id`, `prerequisites`, `learning_outcomes`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Eng. Mechanics', 'EMECH', 'engineering mechanics', '3.00', 21, 19, 'core', 'basic', 1, 'fsdfsdf', 'sdfsdfsdf', 'active', 1, '2025-11-19 10:33:05', '2025-11-19 10:33:05'),
(2, 'INTERNET OF THINGS', 'IOT', 'FDSFDSFDSFSD', '10.00', 8, 2, 'core', 'basic', 1, 'BASIC ELECTRONICS,', '', 'active', 1, '2025-12-09 05:10:27', '2025-12-09 05:10:27'),
(3, 'Microprocessor', 'COPC301', 'MICROPROCESSOR AND MICROCONTROLLER BASED ON 8051 AND 8086', '3.00', 2, 1, 'core', 'intermediate', 1, '', '', 'active', 1, '2025-12-09 05:38:59', '2025-12-09 05:38:59');

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
  `status` enum('active','suspended','','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `created_at`, `status`) VALUES
(1, 'Gustavo Frienge', 'admin', 'abc@domain.com', '$2y$10$2boPZwPqY9MOFkPqkgDIKuYeVZMJG/TFAYr/LHY8gsYNZVhVPpxaq', '2025-10-10 06:22:40', 'active'),
(2, 'Ram Das', 'student', 'xyz@domain.com', '$2y$10$3jt7HYDgTy6ObpTrJNpwS.uYo8flKCZQEk0Dr5egJ6kduyyqJckm.', '2025-10-10 06:59:31', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_batches`
--
ALTER TABLE `academic_batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_batch_code` (`program_id`,`batch_code`),
  ADD KEY `class_teacher_id` (`class_teacher_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_batch_program` (`program_id`),
  ADD KEY `idx_batch_year` (`batch_year`),
  ADD KEY `idx_batch_status` (`status`);

--
-- Indexes for table `academic_programs`
--
ALTER TABLE `academic_programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_program_department` (`department_id`),
  ADD KEY `idx_program_status` (`status`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_branch_code` (`institute_id`,`code`),
  ADD KEY `idx_branch_institute` (`institute_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_dept_code` (`institute_id`,`code`),
  ADD KEY `idx_department_institute` (`institute_id`);

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
-- Indexes for table `program_subjects`
--
ALTER TABLE `program_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_program_subject` (`program_id`,`subject_id`,`semester`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `idx_program_subject_program` (`program_id`),
  ADD KEY `idx_program_subject_semester` (`semester`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `staff_allocations`
--
ALTER TABLE `staff_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `institute_id` (`institute_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `reporting_to` (`reporting_to`);

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
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `staff_documents`
--
ALTER TABLE `staff_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff_leave_balance`
--
ALTER TABLE `staff_leave_balance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_staff_year` (`staff_id`,`leave_year`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admission_number` (`admission_number`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `aadhaar_number` (`aadhaar_number`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_student_program` (`program_id`),
  ADD KEY `idx_student_batch` (`batch_id`),
  ADD KEY `idx_student_status` (`status`),
  ADD KEY `idx_student_admission_date` (`admission_date`),
  ADD KEY `idx_student_roll_number` (`roll_number`),
  ADD KEY `idx_student_admission_number` (`admission_number`);

--
-- Indexes for table `student_academic_history`
--
ALTER TABLE `student_academic_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_academic_history_student` (`student_id`);

--
-- Indexes for table `student_attendance_summary`
--
ALTER TABLE `student_attendance_summary`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_attendance_summary` (`student_id`,`batch_id`,`subject_id`,`semester`,`month_year`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `idx_attendance_summary_student` (`student_id`),
  ADD KEY `idx_attendance_summary_batch` (`batch_id`);

--
-- Indexes for table `student_batches`
--
ALTER TABLE `student_batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enrollment_number` (`enrollment_number`),
  ADD KEY `idx_student_batches_student` (`student_id`),
  ADD KEY `idx_student_batches_batch` (`batch_id`),
  ADD KEY `idx_student_batches_academic_status` (`academic_status`),
  ADD KEY `idx_student_batches_enrollment_date` (`enrollment_date`),
  ADD KEY `idx_student_batches_roll_number` (`roll_number`),
  ADD KEY `idx_student_batches_enrollment_number` (`enrollment_number`),
  ADD KEY `idx_student_batches_status` (`status`),
  ADD KEY `idx_student_batches_current_semester` (`current_semester`);

--
-- Indexes for table `student_batch_history`
--
ALTER TABLE `student_batch_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_batch_id` (`student_batch_id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `changed_by` (`changed_by`);

--
-- Indexes for table `student_documents`
--
ALTER TABLE `student_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verified_by` (`verified_by`),
  ADD KEY `idx_student_documents_student` (`student_id`),
  ADD KEY `idx_student_documents_type` (`document_type`);

--
-- Indexes for table `student_semester_registration`
--
ALTER TABLE `student_semester_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student_semester` (`student_batch_id`,`semester`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `student_subject_enrollment`
--
ALTER TABLE `student_subject_enrollment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_subject_enrollment` (`student_id`,`subject_id`,`semester`,`academic_year`),
  ADD KEY `program_subject_id` (`program_subject_id`),
  ADD KEY `idx_enrollment_student` (`student_id`),
  ADD KEY `idx_enrollment_subject` (`subject_id`),
  ADD KEY `idx_enrollment_semester` (`semester`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_subject_code` (`code`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_subject_department` (`department_id`),
  ADD KEY `idx_subject_type` (`subject_type`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `academic_programs`
--
ALTER TABLE `academic_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute_types`
--
ALTER TABLE `institute_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `program_subjects`
--
ALTER TABLE `program_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_allocations`
--
ALTER TABLE `staff_allocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_categories`
--
ALTER TABLE `staff_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_designations`
--
ALTER TABLE `staff_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff_documents`
--
ALTER TABLE `staff_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_leave_balance`
--
ALTER TABLE `staff_leave_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_academic_history`
--
ALTER TABLE `student_academic_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendance_summary`
--
ALTER TABLE `student_attendance_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_batches`
--
ALTER TABLE `student_batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_batch_history`
--
ALTER TABLE `student_batch_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_documents`
--
ALTER TABLE `student_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_semester_registration`
--
ALTER TABLE `student_semester_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_subject_enrollment`
--
ALTER TABLE `student_subject_enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_batches`
--
ALTER TABLE `academic_batches`
  ADD CONSTRAINT `academic_batches_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `academic_programs` (`id`),
  ADD CONSTRAINT `academic_batches_ibfk_2` FOREIGN KEY (`class_teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `academic_batches_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `academic_programs`
--
ALTER TABLE `academic_programs`
  ADD CONSTRAINT `academic_programs_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `academic_programs_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_subjects`
--
ALTER TABLE `program_subjects`
  ADD CONSTRAINT `program_subjects_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `academic_programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `program_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `staff_categories` (`id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `staff_designations` (`id`);

--
-- Constraints for table `staff_allocations`
--
ALTER TABLE `staff_allocations`
  ADD CONSTRAINT `staff_allocations_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_allocations_ibfk_2` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_allocations_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `staff_allocations_ibfk_4` FOREIGN KEY (`reporting_to`) REFERENCES `staff` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `staff_designations`
--
ALTER TABLE `staff_designations`
  ADD CONSTRAINT `staff_designations_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `staff_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_documents`
--
ALTER TABLE `staff_documents`
  ADD CONSTRAINT `staff_documents_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_leave_balance`
--
ALTER TABLE `staff_leave_balance`
  ADD CONSTRAINT `staff_leave_balance_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `academic_programs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`batch_id`) REFERENCES `academic_batches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `student_academic_history`
--
ALTER TABLE `student_academic_history`
  ADD CONSTRAINT `student_academic_history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_attendance_summary`
--
ALTER TABLE `student_attendance_summary`
  ADD CONSTRAINT `student_attendance_summary_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_attendance_summary_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `academic_batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_attendance_summary_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_batch_history`
--
ALTER TABLE `student_batch_history`
  ADD CONSTRAINT `student_batch_history_ibfk_1` FOREIGN KEY (`student_batch_id`) REFERENCES `student_batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_batch_history_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `academic_batches` (`id`),
  ADD CONSTRAINT `student_batch_history_ibfk_3` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `student_documents`
--
ALTER TABLE `student_documents`
  ADD CONSTRAINT `student_documents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_documents_ibfk_2` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `student_semester_registration`
--
ALTER TABLE `student_semester_registration`
  ADD CONSTRAINT `student_semester_registration_ibfk_1` FOREIGN KEY (`student_batch_id`) REFERENCES `student_batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_semester_registration_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `student_subject_enrollment`
--
ALTER TABLE `student_subject_enrollment`
  ADD CONSTRAINT `student_subject_enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_enrollment_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_enrollment_ibfk_3` FOREIGN KEY (`program_subject_id`) REFERENCES `program_subjects` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
