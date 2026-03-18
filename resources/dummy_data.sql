-- =====================================================
-- Complete Dummy Data for College ERP System
-- All foreign key relationships are maintained.
-- Run this script on an empty database (tables truncated).
-- =====================================================

-- -----------------------------------------------------
-- 1. institute_types (using INSERT IGNORE to avoid duplicates)
-- -----------------------------------------------------
INSERT IGNORE INTO `institute_types` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'University', 'UNIV', 'Degree granting university', 'active', NOW(), NOW()),
(2, 'College', 'COLL', 'Affiliated college', 'active', NOW(), NOW()),
(3, 'Institute', 'INST', 'Standalone institute', 'active', NOW(), NOW()),
(4, 'School', 'SCH', 'K-12 or professional school', 'active', NOW(), NOW());
-- -----------------------------------------------------
-- 2. institutes (one detailed college)
-- -----------------------------------------------------
INSERT INTO `institutes` (`id`, `name`, `code`, `type`, `address`, `city`, `state`, `country`, `pincode`, `phone`, `email`, `website`, `established_year`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'National Institute of Technology, Delhi', 'NITD', 'Institute', 'Sector A-7, Narela', 'Delhi', 'Delhi', 'India', '110040', '011-27787500', 'info@nitdelhi.ac.in', 'www.nitdelhi.ac.in', '2010', 'An Institute of National Importance', 'active', NOW(), NOW());

-- -----------------------------------------------------
-- 3. branches (main branch for the institute)
-- -----------------------------------------------------
INSERT INTO `branches` (`id`, `institute_id`, `name`, `code`, `type`, `address`, `city`, `state`, `country`, `pincode`, `phone`, `email`, `website`, `established_year`, `description`, `status`) VALUES
(1, 1, 'Main Campus', 'MC', 'main', 'Sector A-7, Narela', 'Delhi', 'Delhi', 'India', '110040', '011-27787501', 'main@nitdelhi.ac.in', 'www.nitdelhi.ac.in', '2010', 'Main campus of NIT Delhi', 'active');

-- -----------------------------------------------------
-- 4. departments (4 academic departments)
-- -----------------------------------------------------
INSERT INTO `departments` (`id`, `institute_id`, `name`, `code`, `type`, `head_of_department`, `email`, `phone`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Computer Science & Engineering', 'CSE', 'academic', 'Dr. A. Sharma', 'cse@nitdelhi.ac.in', '011-27787510', 'Department of Computer Science', 'active', NOW(), NOW()),
(2, 1, 'Electronics & Communication Engg.', 'ECE', 'academic', 'Dr. B. Verma', 'ece@nitdelhi.ac.in', '011-27787511', 'Department of Electronics', 'active', NOW(), NOW()),
(3, 1, 'Mechanical Engineering', 'ME', 'academic', 'Dr. C. Singh', 'mech@nitdelhi.ac.in', '011-27787512', 'Department of Mechanical Engg.', 'active', NOW(), NOW()),
(4, 1, 'Civil Engineering', 'CE', 'academic', 'Dr. D. Kapoor', 'civil@nitdelhi.ac.in', '011-27787513', 'Department of Civil Engg.', 'active', NOW(), NOW());

-- -----------------------------------------------------
-- 5. staff_categories
-- -----------------------------------------------------
INSERT INTO `staff_categories` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Teaching', 'TCH', 'Faculty members', 'active', NOW(), NOW()),
(2, 'Non-Teaching', 'NTCH', 'Support staff', 'active', NOW(), NOW()),
(3, 'Administrative', 'ADMIN', 'Administrative staff', 'active', NOW(), NOW());

-- -----------------------------------------------------
-- 6. staff_designations
-- -----------------------------------------------------
INSERT INTO `staff_designations` (`id`, `category_id`, `name`, `code`, `level`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Professor', 'PROF', 5, 'Professor', 'active', NOW(), NOW()),
(2, 1, 'Associate Professor', 'ASSO', 4, 'Associate Professor', 'active', NOW(), NOW()),
(3, 1, 'Assistant Professor', 'ASST', 3, 'Assistant Professor', 'active', NOW(), NOW()),
(4, 2, 'Lab Assistant', 'LAB', 2, 'Laboratory Assistant', 'active', NOW(), NOW()),
(5, 2, 'Office Assistant', 'OFF', 2, 'Office Assistant', 'active', NOW(), NOW()),
(6, 3, 'Registrar', 'REG', 6, 'Registrar', 'active', NOW(), NOW()),
(7, 3, 'Accountant', 'ACC', 3, 'Accountant', 'active', NOW(), NOW());

-- -----------------------------------------------------
-- 7. users (1 admin, 4 faculty, 12 students)
--    bcrypt hash for 'password123' (example)
-- -----------------------------------------------------
INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `created_at`, `status`) VALUES
(1, 'Admin User', 'admin', 'abc@domain.com', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
-- Faculty
(2, 'Dr. Rajesh Kumar', 'faculty', 'rajesh.kumar@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(3, 'Dr. Priya Sharma', 'faculty', 'priya.sharma@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(4, 'Dr. Anil Gupta', 'faculty', 'anil.gupta@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(5, 'Dr. Sunita Reddy', 'faculty', 'sunita.reddy@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
-- Students (12)
(6, 'Aarav Mehta', 'student', 'aarav.mehta@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(7, 'Vihaan Khanna', 'student', 'vihaan.khanna@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(8, 'Vivaan Saxena', 'student', 'vivaan.saxena@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(9, 'Ananya Singh', 'student', 'ananya.singh@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(10, 'Diya Patel', 'student', 'diya.patel@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(11, 'Advik Joshi', 'student', 'advik.joshi@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(12, 'Sai Iyer', 'student', 'sai.iyer@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(13, 'Arjun Nair', 'student', 'arjun.nair@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(14, 'Ishita Desai', 'student', 'ishita.desai@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(15, 'Rohan Das', 'student', 'rohan.das@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(16, 'Kavya Menon', 'student', 'kavya.menon@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active'),
(17, 'Reyansh Gupta', 'student', 'reyansh.gupta@nitdelhi.ac.in', '$2y$10$K9k2Rmz5dA04PaUMrsPnzeKdX0rMdlpGZ3esm8erfKdS58HK9511O', NOW(), 'active');

-- -----------------------------------------------------
-- 8. staff (4 faculty, referencing users 2-5)
-- -----------------------------------------------------
INSERT INTO `staff` (`id`, `staff_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `email`, `phone`, `alternate_phone`, `address`, `city`, `state`, `category_id`, `designation_id`, `qualification`, `salary`, `joining_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FAC001', 'Rajesh', 'K', 'Kumar', 'male', '1978-05-15', 'rajesh.kumar@nitdelhi.ac.in', '9876543210', '9876501234', '123 Faculty Colony', 'Delhi', 'Delhi', 1, 1, 'Ph.D. Computer Science', 150000.00, '2015-07-01', 'active', NOW(), NOW()),
(2, 'FAC002', 'Priya', 'S', 'Sharma', 'female', '1982-09-22', 'priya.sharma@nitdelhi.ac.in', '9876543211', NULL, '456 Teachers Apartment', 'Delhi', 'Delhi', 1, 2, 'Ph.D. Electronics', 120000.00, '2016-08-15', 'active', NOW(), NOW()),
(3, 'FAC003', 'Anil', 'K', 'Gupta', 'male', '1975-11-10', 'anil.gupta@nitdelhi.ac.in', '9876543212', '9876505678', '789 Faculty Housing', 'Delhi', 'Delhi', 1, 1, 'Ph.D. Mechanical', 155000.00, '2014-06-01', 'active', NOW(), NOW()),
(4, 'FAC004', 'Sunita', 'R', 'Reddy', 'female', '1980-03-18', 'sunita.reddy@nitdelhi.ac.in', '9876543213', NULL, '321 Staff Quarters', 'Delhi', 'Delhi', 1, 3, 'M.Tech, Ph.D.', 110000.00, '2017-09-01', 'active', NOW(), NOW());

-- -----------------------------------------------------
-- 9. academic_programs (3 programs)
-- -----------------------------------------------------
INSERT INTO `academic_programs` (`id`, `name`, `code`, `description`, `duration_years`, `total_credits`, `department_id`, `degree_type`, `program_level`, `accreditation_status`, `start_date`, `end_date`, `total_semesters`, `max_students`, `current_students`, `program_fee`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'B.Tech Computer Science & Engineering', 'BTCSE', 'Bachelor of Technology in CSE', 4, 160, 1, 'undergraduate', 'bachelor', 'accredited', '2024-08-01', '2028-05-31', 8, 60, 45, 250000.00, 'active', 1, NOW(), NOW()),
(2, 'B.Tech Electronics & Communication', 'BTECE', 'Bachelor of Technology in ECE', 4, 160, 2, 'undergraduate', 'bachelor', 'accredited', '2024-08-01', '2028-05-31', 8, 60, 38, 240000.00, 'active', 1, NOW(), NOW()),
(3, 'Diploma in Mechanical Engineering', 'DPME', 'Diploma in Mechanical', 3, 90, 3, 'diploma', 'diploma', 'approved', '2024-08-01', '2027-05-31', 6, 40, 30, 120000.00, 'active', 1, NOW(), NOW());

-- -----------------------------------------------------
-- 10. academic_batches (for each program)
-- -----------------------------------------------------
INSERT INTO `academic_batches` (`id`, `program_id`, `batch_year`, `batch_code`, `batch_name`, `start_date`, `end_date`, `current_semester`, `total_students`, `max_capacity`, `class_teacher_id`, `fee_structure`, `admission_criteria`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2024', 'CSE2024', 'B.Tech CSE Batch 2024', '2024-08-01', '2028-05-31', 2, 45, 60, 1, '{"tuition":125000,"hostel":80000,"other":15000}', 'JEE Main Rank', 'active', 1, NOW(), NOW()),
(2, 2, '2024', 'ECE2024', 'B.Tech ECE Batch 2024', '2024-08-01', '2028-05-31', 2, 38, 60, 2, '{"tuition":120000,"hostel":80000,"other":15000}', 'JEE Main Rank', 'active', 1, NOW(), NOW()),
(3, 3, '2024', 'ME2024', 'Diploma ME Batch 2024', '2024-08-01', '2027-05-31', 3, 30, 40, 3, '{"tuition":60000,"hostel":50000,"other":10000}', '10th Marks', 'active', 1, NOW(), NOW()),
(4, 1, '2025', 'CSE2025', 'B.Tech CSE Batch 2025', '2025-08-01', '2029-05-31', 1, 52, 60, 1, '{"tuition":130000,"hostel":85000,"other":15000}', 'JEE Main Rank', 'active', 1, NOW(), NOW());

-- -----------------------------------------------------
-- 11. subjects (12 subjects across departments)
-- -----------------------------------------------------
INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `credit_hours`, `theory_hours`, `practical_hours`, `subject_type`, `difficulty_level`, `department_id`, `prerequisites`, `learning_outcomes`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Data Structures', 'CSE201', 'Fundamental data structures', 4.0, 3, 2, 'core', 'intermediate', 1, 'Programming in C', 'Ability to implement and use data structures', 'active', 1, NOW(), NOW()),
(2, 'Digital Electronics', 'ECE202', 'Digital logic design', 4.0, 3, 2, 'core', 'intermediate', 2, 'Basic Electronics', 'Design combinational/sequential circuits', 'active', 1, NOW(), NOW()),
(3, 'Thermodynamics', 'ME203', 'Laws of thermodynamics', 3.0, 3, 0, 'core', 'intermediate', 3, 'Physics', 'Apply thermodynamic principles', 'active', 1, NOW(), NOW()),
(4, 'Database Management Systems', 'CSE204', 'DBMS concepts', 4.0, 3, 2, 'core', 'intermediate', 1, 'Data Structures', 'Design and query databases', 'active', 1, NOW(), NOW()),
(5, 'Signals and Systems', 'ECE205', 'Continuous and discrete signals', 4.0, 3, 2, 'core', 'advanced', 2, 'Mathematics', 'Analyze signals in time/frequency domain', 'active', 1, NOW(), NOW()),
(6, 'Fluid Mechanics', 'ME206', 'Fluid properties and dynamics', 3.0, 3, 0, 'core', 'intermediate', 3, 'Thermodynamics', 'Solve fluid flow problems', 'active', 1, NOW(), NOW()),
(7, 'Machine Learning', 'CSE401', 'Introduction to ML', 3.0, 2, 2, 'elective', 'advanced', 1, 'Data Structures, Probability', 'Build predictive models', 'active', 1, NOW(), NOW()),
(8, 'VLSI Design', 'ECE402', 'VLSI circuit design', 4.0, 3, 2, 'elective', 'advanced', 2, 'Digital Electronics', 'Design CMOS circuits', 'active', 1, NOW(), NOW()),
(9, 'Robotics', 'ME403', 'Fundamentals of robotics', 3.0, 2, 2, 'elective', 'advanced', 3, 'Kinematics', 'Program and control robots', 'active', 1, NOW(), NOW()),
(10, 'Computer Networks', 'CSE305', 'Network protocols', 4.0, 3, 2, 'core', 'intermediate', 1, 'Operating Systems', 'Understand TCP/IP stack', 'active', 1, NOW(), NOW()),
(11, 'Communication Systems', 'ECE306', 'Analog and digital comm', 4.0, 3, 2, 'core', 'intermediate', 2, 'Signals and Systems', 'Design communication links', 'active', 1, NOW(), NOW()),
(12, 'Engineering Mechanics', 'ME101', 'Statics and dynamics', 3.0, 3, 0, 'core', 'basic', 3, 'Physics', 'Analyze forces in structures', 'active', 1, NOW(), NOW());

-- -----------------------------------------------------
-- 12. course_mappings (link subjects to programs/batches/faculty)
-- -----------------------------------------------------
INSERT INTO `course_mappings` (`id`, `program_id`, `subject_id`, `batch_id`, `faculty_id`, `academic_year`, `semester`, `status`) VALUES
(1, 1, 1, 1, 1, '2024-25', 2, 'active'),   -- DS for CSE batch1, sem2
(2, 1, 4, 1, 1, '2024-25', 2, 'active'),   -- DBMS for CSE batch1, sem2
(3, 1, 10, 1, 1, '2024-25', 2, 'active'),  -- Networks for CSE batch1, sem2
(4, 2, 2, 2, 2, '2024-25', 2, 'active'),   -- Digital Elec for ECE batch2, sem2
(5, 2, 5, 2, 2, '2024-25', 2, 'active'),   -- Signals for ECE batch2, sem2
(6, 2, 11, 2, 2, '2024-25', 2, 'active'),  -- Comm Systems for ECE batch2, sem2
(7, 3, 3, 3, 3, '2024-25', 3, 'active'),   -- Thermodynamics for ME batch3, sem3
(8, 3, 6, 3, 3, '2024-25', 3, 'active'),   -- Fluid Mech for ME batch3, sem3
(9, 3, 12, 3, 3, '2024-25', 3, 'active'),  -- Engg Mechanics for ME batch3, sem3
(10, 1, 7, 4, 1, '2025-26', 1, 'active'),  -- ML for CSE batch4, sem1 (new batch)
(11, 2, 8, NULL, 2, '2025-26', 5, 'active'), -- VLSI for ECE, no batch (elective)
(12, 3, 9, NULL, 3, '2025-26', 5, 'active'); -- Robotics for ME, no batch

-- -----------------------------------------------------
-- 13. class_schedules (weekly schedule for active mappings)
-- -----------------------------------------------------
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

-- -----------------------------------------------------
-- 14. students (12 students, assign to batches)
--    Link to users (6-17) and set program/batch accordingly
-- -----------------------------------------------------
INSERT INTO `students` (`id`, `user_id`, `admission_number`, `roll_number`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `gender`, `email`, `phone`, `permanent_address`, `program_id`, `batch_id`, `admission_date`, `current_semester`, `father_name`, `father_email`, `father_phone`, `mother_name`, `mother_phone`, `mother_email`, `guardian_name`, `guardian_phone`, `guardian_email`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 6, 'ADM2024001', 'CSE24001', 'Aarav', 'K', 'Mehta', '2005-06-15', 'male', 'aarav.mehta@nitdelhi.ac.in', '9810012345', '12, Green Park, Delhi', 1, 1, '2024-08-10', 2, 'Rajesh Mehta', 'rajesh.mehta@example.com', '9810011111', 'Sunita Mehta', '9810022222', 'sunita.mehta@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(2, 7, 'ADM2024002', 'CSE24002', 'Vihaan', 'S', 'Khanna', '2005-09-20', 'male', 'vihaan.khanna@nitdelhi.ac.in', '9810012346', '34, Model Town, Delhi', 1, 1, '2024-08-10', 2, 'Sanjay Khanna', 'sanjay.khanna@example.com', '9810033333', 'Anita Khanna', '9810044444', 'anita.khanna@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(3, 8, 'ADM2024003', 'CSE24003', 'Vivaan', 'R', 'Saxena', '2005-11-02', 'male', 'vivaan.saxena@nitdelhi.ac.in', '9810012347', '56, Patel Nagar, Delhi', 1, 1, '2024-08-10', 2, 'Rakesh Saxena', 'rakesh.saxena@example.com', '9810055555', 'Poonam Saxena', '9810066666', 'poonam.saxena@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(4, 9, 'ADM2024004', 'ECE24001', 'Ananya', 'P', 'Singh', '2005-04-18', 'female', 'ananya.singh@nitdelhi.ac.in', '9810012348', '78, Vikaspuri, Delhi', 2, 2, '2024-08-10', 2, 'Arun Singh', 'arun.singh@example.com', '9810077777', 'Meena Singh', '9810088888', 'meena.singh@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(5, 10, 'ADM2024005', 'ECE24002', 'Diya', 'M', 'Patel', '2005-07-25', 'female', 'diya.patel@nitdelhi.ac.in', '9810012349', '90, Janakpuri, Delhi', 2, 2, '2024-08-10', 2, 'Mahesh Patel', 'mahesh.patel@example.com', '9810099999', 'Geeta Patel', '9810000001', 'geeta.patel@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(6, 11, 'ADM2024006', 'ECE24003', 'Advik', 'N', 'Joshi', '2005-12-12', 'male', 'advik.joshi@nitdelhi.ac.in', '9810012350', '23, Rohini, Delhi', 2, 2, '2024-08-10', 2, 'Nitin Joshi', 'nitin.joshi@example.com', '9810000111', 'Sangeeta Joshi', '9810000222', 'sangeeta.joshi@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(7, 12, 'ADM2024007', 'ME24001', 'Sai', 'K', 'Iyer', '2004-03-03', 'male', 'sai.iyer@nitdelhi.ac.in', '9810012351', '45, Dwarka, Delhi', 3, 3, '2024-08-10', 3, 'Krishna Iyer', 'krishna.iyer@example.com', '9810000333', 'Lakshmi Iyer', '9810000444', 'lakshmi.iyer@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(8, 13, 'ADM2024008', 'ME24002', 'Arjun', 'V', 'Nair', '2004-08-19', 'male', 'arjun.nair@nitdelhi.ac.in', '9810012352', '67, Noida', 3, 3, '2024-08-10', 3, 'Vijay Nair', 'vijay.nair@example.com', '9810000555', 'Radha Nair', '9810000666', 'radha.nair@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(9, 14, 'ADM2024009', 'ME24003', 'Ishita', 'D', 'Desai', '2004-10-10', 'female', 'ishita.desai@nitdelhi.ac.in', '9810012353', '89, Ghaziabad', 3, 3, '2024-08-10', 3, 'Dinesh Desai', 'dinesh.desai@example.com', '9810000777', 'Minal Desai', '9810000888', 'minal.desai@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(10, 15, 'ADM2024010', 'CSE25001', 'Rohan', 'K', 'Das', '2006-01-05', 'male', 'rohan.das@nitdelhi.ac.in', '9810012354', '12, Salt Lake, Delhi', 1, 4, '2025-08-10', 1, 'Kalyan Das', 'kalyan.das@example.com', '9810000999', 'Nandini Das', '9810001000', 'nandini.das@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(11, 16, 'ADM2024011', 'CSE25002', 'Kavya', 'R', 'Menon', '2006-02-14', 'female', 'kavya.menon@nitdelhi.ac.in', '9810012355', '34, Andheri, Delhi', 1, 4, '2025-08-10', 1, 'Ramesh Menon', 'ramesh.menon@example.com', '9810001111', 'Shobha Menon', '9810001222', 'shobha.menon@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW()),
(12, 17, 'ADM2024012', 'CSE25003', 'Reyansh', 'G', 'Gupta', '2006-03-22', 'male', 'reyansh.gupta@nitdelhi.ac.in', '9810012356', '56, Connaught Place, Delhi', 1, 4, '2025-08-10', 1, 'Gaurav Gupta', 'gaurav.gupta@example.com', '9810001333', 'Anjali Gupta', '9810001444', 'anjali.gupta@example.com', NULL, NULL, NULL, 'active', 1, NOW(), NOW());

-- -----------------------------------------------------
-- 15. attendance (generate ~500 random attendance records)
--    For each student, for each subject in their batch, mark attendance on random dates.
--    Marked_by = faculty of that subject.
-- -----------------------------------------------------
-- We'll generate for batch 1,2,3 (students 1-9) over 20 days.
-- Subjects per student:
--   batch1 (CSE2024): subjects 1,4,10
--   batch2 (ECE2024): subjects 2,5,11
--   batch3 (ME2024): subjects 3,6,12
-- Dates: 2025-02-01 to 2025-02-28 (excluding Sundays)
INSERT INTO `attendance` (`id`, `student_id`, `subject_id`, `batch_id`, `attendance_date`, `status`, `marked_by`, `created_at`) VALUES
-- We'll use a loop-like manual insert; for brevity, generate a representative sample.
-- For actual bulk, we'd use a script, but here we'll create ~30 records per student = 270 records.
-- We'll create a mix of present/absent/late/half_day.
-- Below is a sample; in production you would generate with a programming script.
-- We'll insert 10 records per student to keep SQL manageable.

-- Student 1 (batch1, subjects 1,4,10)
(1,1,1,1,'2025-02-03','present',1,NOW()),
(2,1,1,1,'2025-02-05','present',1,NOW()),
(3,1,1,1,'2025-02-07','late',1,NOW()),
(4,1,4,1,'2025-02-04','present',1,NOW()),
(5,1,4,1,'2025-02-06','absent',1,NOW()),
(6,1,4,1,'2025-02-08','present',1,NOW()),
(7,1,10,1,'2025-02-09','present',1,NOW()),
(8,1,10,1,'2025-02-10','half_day',1,NOW()),
(9,1,10,1,'2025-02-12','present',1,NOW()),
(10,1,1,1,'2025-02-14','present',1,NOW()),
-- Student 2 (batch1)
(11,2,1,1,'2025-02-03','present',1,NOW()),
(12,2,1,1,'2025-02-05','present',1,NOW()),
(13,2,1,1,'2025-02-07','present',1,NOW()),
(14,2,4,1,'2025-02-04','present',1,NOW()),
(15,2,4,1,'2025-02-06','present',1,NOW()),
(16,2,4,1,'2025-02-08','late',1,NOW()),
(17,2,10,1,'2025-02-09','present',1,NOW()),
(18,2,10,1,'2025-02-10','present',1,NOW()),
(19,2,10,1,'2025-02-12','absent',1,NOW()),
(20,2,1,1,'2025-02-14','present',1,NOW()),
-- Student 3 (batch1)
(21,3,1,1,'2025-02-03','present',1,NOW()),
(22,3,1,1,'2025-02-05','half_day',1,NOW()),
(23,3,1,1,'2025-02-07','present',1,NOW()),
(24,3,4,1,'2025-02-04','present',1,NOW()),
(25,3,4,1,'2025-02-06','present',1,NOW()),
(26,3,4,1,'2025-02-08','present',1,NOW()),
(27,3,10,1,'2025-02-09','late',1,NOW()),
(28,3,10,1,'2025-02-10','present',1,NOW()),
(29,3,10,1,'2025-02-12','present',1,NOW()),
(30,3,1,1,'2025-02-14','present',1,NOW()),
-- Student 4 (batch2, subjects 2,5,11)
(31,4,2,2,'2025-02-03','present',2,NOW()),
(32,4,2,2,'2025-02-05','present',2,NOW()),
(33,4,2,2,'2025-02-07','present',2,NOW()),
(34,4,5,2,'2025-02-04','absent',2,NOW()),
(35,4,5,2,'2025-02-06','present',2,NOW()),
(36,4,5,2,'2025-02-08','present',2,NOW()),
(37,4,11,2,'2025-02-09','present',2,NOW()),
(38,4,11,2,'2025-02-10','present',2,NOW()),
(39,4,11,2,'2025-02-12','late',2,NOW()),
(40,4,2,2,'2025-02-14','present',2,NOW()),
-- Student 5 (batch2)
(41,5,2,2,'2025-02-03','present',2,NOW()),
(42,5,2,2,'2025-02-05','present',2,NOW()),
(43,5,2,2,'2025-02-07','present',2,NOW()),
(44,5,5,2,'2025-02-04','present',2,NOW()),
(45,5,5,2,'2025-02-06','half_day',2,NOW()),
(46,5,5,2,'2025-02-08','present',2,NOW()),
(47,5,11,2,'2025-02-09','present',2,NOW()),
(48,5,11,2,'2025-02-10','present',2,NOW()),
(49,5,11,2,'2025-02-12','present',2,NOW()),
(50,5,2,2,'2025-02-14','present',2,NOW()),
-- Student 6 (batch2)
(51,6,2,2,'2025-02-03','present',2,NOW()),
(52,6,2,2,'2025-02-05','late',2,NOW()),
(53,6,2,2,'2025-02-07','present',2,NOW()),
(54,6,5,2,'2025-02-04','present',2,NOW()),
(55,6,5,2,'2025-02-06','present',2,NOW()),
(56,6,5,2,'2025-02-08','present',2,NOW()),
(57,6,11,2,'2025-02-09','absent',2,NOW()),
(58,6,11,2,'2025-02-10','present',2,NOW()),
(59,6,11,2,'2025-02-12','present',2,NOW()),
(60,6,2,2,'2025-02-14','present',2,NOW()),
-- Student 7 (batch3, subjects 3,6,12)
(61,7,3,3,'2025-02-03','present',3,NOW()),
(62,7,3,3,'2025-02-05','present',3,NOW()),
(63,7,3,3,'2025-02-07','present',3,NOW()),
(64,7,6,3,'2025-02-04','late',3,NOW()),
(65,7,6,3,'2025-02-06','present',3,NOW()),
(66,7,6,3,'2025-02-08','present',3,NOW()),
(67,7,12,3,'2025-02-09','present',3,NOW()),
(68,7,12,3,'2025-02-10','present',3,NOW()),
(69,7,12,3,'2025-02-12','present',3,NOW()),
(70,7,3,3,'2025-02-14','half_day',3,NOW()),
-- Student 8 (batch3)
(71,8,3,3,'2025-02-03','present',3,NOW()),
(72,8,3,3,'2025-02-05','present',3,NOW()),
(73,8,3,3,'2025-02-07','absent',3,NOW()),
(74,8,6,3,'2025-02-04','present',3,NOW()),
(75,8,6,3,'2025-02-06','present',3,NOW()),
(76,8,6,3,'2025-02-08','present',3,NOW()),
(77,8,12,3,'2025-02-09','present',3,NOW()),
(78,8,12,3,'2025-02-10','present',3,NOW()),
(79,8,12,3,'2025-02-12','present',3,NOW()),
(80,8,3,3,'2025-02-14','present',3,NOW()),
-- Student 9 (batch3)
(81,9,3,3,'2025-02-03','present',3,NOW()),
(82,9,3,3,'2025-02-05','present',3,NOW()),
(83,9,3,3,'2025-02-07','present',3,NOW()),
(84,9,6,3,'2025-02-04','present',3,NOW()),
(85,9,6,3,'2025-02-06','present',3,NOW()),
(86,9,6,3,'2025-02-08','late',3,NOW()),
(87,9,12,3,'2025-02-09','present',3,NOW()),
(88,9,12,3,'2025-02-10','present',3,NOW()),
(89,9,12,3,'2025-02-12','present',3,NOW()),
(90,9,3,3,'2025-02-14','present',3,NOW());

-- -----------------------------------------------------
-- 16. examinations (create exams for subjects in batches 1-3)
-- -----------------------------------------------------
INSERT INTO `examinations` (`id`, `name`, `exam_type`, `program_id`, `batch_id`, `semester`, `academic_year`, `exam_date`, `start_time`, `end_time`, `duration_minutes`, `total_marks`, `passing_marks`, `exam_venue`, `description`, `status`, `created_by`, `created_at`) VALUES
(1, 'Mid Term - Data Structures', 'Mid Term', 1, 1, 2, '2024-25', '2025-03-10', '10:00:00', '12:00:00', 120, 50, 20, 'LC-101', 'Mid term examination', 'scheduled', 1, NOW()),
(2, 'Final - Data Structures', 'Final', 1, 1, 2, '2024-25', '2025-05-15', '09:00:00', '12:00:00', 180, 100, 40, 'LC-101', 'Final exam', 'scheduled', 1, NOW()),
(3, 'Mid Term - DBMS', 'Mid Term', 1, 1, 2, '2024-25', '2025-03-12', '10:00:00', '12:00:00', 120, 50, 20, 'LC-102', 'Mid term', 'scheduled', 1, NOW()),
(4, 'Final - DBMS', 'Final', 1, 1, 2, '2024-25', '2025-05-17', '09:00:00', '12:00:00', 180, 100, 40, 'LC-102', 'Final', 'scheduled', 1, NOW()),
(5, 'Mid Term - Computer Networks', 'Mid Term', 1, 1, 2, '2024-25', '2025-03-14', '10:00:00', '12:00:00', 120, 50, 20, 'LC-103', 'Mid', 'scheduled', 1, NOW()),
(6, 'Final - Computer Networks', 'Final', 1, 1, 2, '2024-25', '2025-05-19', '09:00:00', '12:00:00', 180, 100, 40, 'LC-103', 'Final', 'scheduled', 1, NOW()),
(7, 'Mid Term - Digital Electronics', 'Mid Term', 2, 2, 2, '2024-25', '2025-03-11', '14:00:00', '16:00:00', 120, 50, 20, 'EC-201', 'Mid', 'scheduled', 1, NOW()),
(8, 'Final - Digital Electronics', 'Final', 2, 2, 2, '2024-25', '2025-05-16', '09:00:00', '12:00:00', 180, 100, 40, 'EC-201', 'Final', 'scheduled', 1, NOW()),
(9, 'Mid Term - Signals and Systems', 'Mid Term', 2, 2, 2, '2024-25', '2025-03-13', '14:00:00', '16:00:00', 120, 50, 20, 'EC-202', 'Mid', 'scheduled', 1, NOW()),
(10, 'Final - Signals and Systems', 'Final', 2, 2, 2, '2024-25', '2025-05-18', '09:00:00', '12:00:00', 180, 100, 40, 'EC-202', 'Final', 'scheduled', 1, NOW()),
(11, 'Mid Term - Communication Systems', 'Mid Term', 2, 2, 2, '2024-25', '2025-03-15', '14:00:00', '16:00:00', 120, 50, 20, 'EC-203', 'Mid', 'scheduled', 1, NOW()),
(12, 'Final - Communication Systems', 'Final', 2, 2, 2, '2024-25', '2025-05-20', '09:00:00', '12:00:00', 180, 100, 40, 'EC-203', 'Final', 'scheduled', 1, NOW()),
(13, 'Mid Term - Thermodynamics', 'Mid Term', 3, 3, 3, '2024-25', '2025-03-10', '10:00:00', '12:00:00', 120, 50, 20, 'ME-301', 'Mid', 'scheduled', 1, NOW()),
(14, 'Final - Thermodynamics', 'Final', 3, 3, 3, '2024-25', '2025-05-15', '09:00:00', '12:00:00', 180, 100, 40, 'ME-301', 'Final', 'scheduled', 1, NOW()),
(15, 'Mid Term - Fluid Mechanics', 'Mid Term', 3, 3, 3, '2024-25', '2025-03-12', '10:00:00', '12:00:00', 120, 50, 20, 'ME-302', 'Mid', 'scheduled', 1, NOW()),
(16, 'Final - Fluid Mechanics', 'Final', 3, 3, 3, '2024-25', '2025-05-17', '09:00:00', '12:00:00', 180, 100, 40, 'ME-302', 'Final', 'scheduled', 1, NOW()),
(17, 'Mid Term - Engineering Mechanics', 'Mid Term', 3, 3, 3, '2024-25', '2025-03-14', '10:00:00', '12:00:00', 120, 50, 20, 'ME-303', 'Mid', 'scheduled', 1, NOW()),
(18, 'Final - Engineering Mechanics', 'Final', 3, 3, 3, '2024-25', '2025-05-19', '09:00:00', '12:00:00', 180, 100, 40, 'ME-303', 'Final', 'scheduled', 1, NOW());

-- -----------------------------------------------------
-- 17. student_grades (for students 1-9, subjects they take)
--    Generate random marks, grade points based on marks.
-- -----------------------------------------------------
INSERT INTO `student_grades` (`id`, `student_id`, `subject_id`, `examination_id`, `total_marks`, `marks_obtained`, `grade`, `grade_point`, `remarks`, `created_at`) VALUES
-- Student 1
(1,1,1,1,50.00,42.00,'A',9.00,'Good',NOW()),
(2,1,1,2,100.00,81.00,'A',8.50,'',NOW()),
(3,1,4,3,50.00,38.00,'B+',8.00,'',NOW()),
(4,1,4,4,100.00,75.00,'B',7.50,'',NOW()),
(5,1,10,5,50.00,44.00,'A',9.00,'',NOW()),
(6,1,10,6,100.00,88.00,'A+',9.50,'Excellent',NOW()),
-- Student 2
(7,2,1,1,50.00,35.00,'B',7.00,'',NOW()),
(8,2,1,2,100.00,72.00,'B',7.00,'',NOW()),
(9,2,4,3,50.00,40.00,'A',8.50,'',NOW()),
(10,2,4,4,100.00,79.00,'B+',8.00,'',NOW()),
(11,2,10,5,50.00,32.00,'C+',6.50,'',NOW()),
(12,2,10,6,100.00,68.00,'B-',6.50,'',NOW()),
-- Student 3
(13,3,1,1,50.00,48.00,'A+',10.00,'',NOW()),
(14,3,1,2,100.00,95.00,'A+',10.00,'Outstanding',NOW()),
(15,3,4,3,50.00,45.00,'A',9.00,'',NOW()),
(16,3,4,4,100.00,90.00,'A+',9.50,'',NOW()),
(17,3,10,5,50.00,41.00,'A',8.50,'',NOW()),
(18,3,10,6,100.00,87.00,'A',9.00,'',NOW()),
-- Student 4
(19,4,2,7,50.00,37.00,'B+',8.00,'',NOW()),
(20,4,2,8,100.00,74.00,'B',7.50,'',NOW()),
(21,4,5,9,50.00,33.00,'C+',6.50,'',NOW()),
(22,4,5,10,100.00,71.00,'B-',6.50,'',NOW()),
(23,4,11,11,50.00,39.00,'B+',8.00,'',NOW()),
(24,4,11,12,100.00,76.00,'B',7.50,'',NOW()),
-- Student 5
(25,5,2,7,50.00,42.00,'A',9.00,'',NOW()),
(26,5,2,8,100.00,85.00,'A',9.00,'',NOW()),
(27,5,5,9,50.00,40.00,'A',8.50,'',NOW()),
(28,5,5,10,100.00,82.00,'A',8.50,'',NOW()),
(29,5,11,11,50.00,38.00,'B+',8.00,'',NOW()),
(30,5,11,12,100.00,79.00,'B+',8.00,'',NOW()),
-- Student 6
(31,6,2,7,50.00,30.00,'C',5.50,'',NOW()),
(32,6,2,8,100.00,62.00,'C+',6.00,'',NOW()),
(33,6,5,9,50.00,28.00,'C-',5.00,'',NOW()),
(34,6,5,10,100.00,55.00,'D',4.50,'Needs improvement',NOW()),
(35,6,11,11,50.00,31.00,'C',5.50,'',NOW()),
(36,6,11,12,100.00,64.00,'C+',6.00,'',NOW()),
-- Student 7
(37,7,3,13,50.00,43.00,'A',9.00,'',NOW()),
(38,7,3,14,100.00,87.00,'A',9.00,'',NOW()),
(39,7,6,15,50.00,41.00,'A',8.50,'',NOW()),
(40,7,6,16,100.00,83.00,'A',8.50,'',NOW()),
(41,7,12,17,50.00,45.00,'A',9.00,'',NOW()),
(42,7,12,18,100.00,91.00,'A+',9.50,'',NOW()),
-- Student 8
(43,8,3,13,50.00,36.00,'B',7.50,'',NOW()),
(44,8,3,14,100.00,73.00,'B',7.00,'',NOW()),
(45,8,6,15,50.00,34.00,'C+',6.50,'',NOW()),
(46,8,6,16,100.00,69.00,'B-',6.50,'',NOW()),
(47,8,12,17,50.00,37.00,'B+',8.00,'',NOW()),
(48,8,12,18,100.00,77.00,'B+',8.00,'',NOW()),
-- Student 9
(49,9,3,13,50.00,47.00,'A+',10.00,'',NOW()),
(50,9,3,14,100.00,93.00,'A+',10.00,'',NOW()),
(51,9,6,15,50.00,44.00,'A',9.00,'',NOW()),
(52,9,6,16,100.00,88.00,'A',9.00,'',NOW()),
(53,9,12,17,50.00,46.00,'A+',9.50,'',NOW()),
(54,9,12,18,100.00,94.00,'A+',10.00,'',NOW());

-- -----------------------------------------------------
-- 18. fee_transactions (2-3 per student)
-- -----------------------------------------------------
INSERT INTO `fee_transactions` (`id`, `student_id`, `receipt_number`, `fee_type`, `amount_due`, `amount_paid`, `payment_method`, `payment_status`, `transaction_date`) VALUES
(1, 1, 'RCPT/2024/001', 'tuition', 125000.00, 125000.00, 'online', 'paid', '2024-08-15'),
(2, 1, 'RCPT/2025/001', 'hostel', 80000.00, 80000.00, 'card', 'paid', '2025-01-10'),
(3, 1, 'RCPT/2025/099', 'other', 15000.00, 15000.00, 'cash', 'paid', '2025-01-15'),   -- changed from RCPT/2025/015
(4, 2, 'RCPT/2024/002', 'tuition', 125000.00, 125000.00, 'online', 'paid', '2024-08-16'),
(5, 2, 'RCPT/2025/002', 'hostel', 80000.00, 80000.00, 'online', 'paid', '2025-01-11'),
(6, 3, 'RCPT/2024/003', 'tuition', 125000.00, 125000.00, 'cash', 'paid', '2024-08-17'),
(7, 3, 'RCPT/2025/003', 'hostel', 80000.00, 40000.00, 'online', 'partial', '2025-01-12'),
(8, 4, 'RCPT/2024/004', 'tuition', 120000.00, 120000.00, 'online', 'paid', '2024-08-18'),
(9, 4, 'RCPT/2025/004', 'hostel', 80000.00, 80000.00, 'card', 'paid', '2025-01-13'),
(10, 5, 'RCPT/2024/005', 'tuition', 120000.00, 120000.00, 'online', 'paid', '2024-08-19'),
(11, 5, 'RCPT/2025/005', 'hostel', 80000.00, 80000.00, 'cash', 'paid', '2025-01-14'),
(12, 6, 'RCPT/2024/006', 'tuition', 120000.00, 120000.00, 'online', 'paid', '2024-08-20'),
(13, 6, 'RCPT/2025/006', 'hostel', 80000.00, 80000.00, 'online', 'paid', '2025-01-15'),
(14, 7, 'RCPT/2024/007', 'tuition', 60000.00, 60000.00, 'cash', 'paid', '2024-08-21'),
(15, 7, 'RCPT/2025/007', 'hostel', 50000.00, 50000.00, 'online', 'paid', '2025-01-16'),
(16, 8, 'RCPT/2024/008', 'tuition', 60000.00, 60000.00, 'online', 'paid', '2024-08-22'),
(17, 8, 'RCPT/2025/008', 'hostel', 50000.00, 25000.00, 'card', 'partial', '2025-01-17'),
(18, 9, 'RCPT/2024/009', 'tuition', 60000.00, 60000.00, 'online', 'paid', '2024-08-23'),
(19, 9, 'RCPT/2025/009', 'hostel', 50000.00, 50000.00, 'online', 'paid', '2025-01-18'),
(20, 10, 'RCPT/2025/010', 'tuition', 130000.00, 130000.00, 'online', 'paid', '2025-08-10'),
(21, 10, 'RCPT/2025/011', 'hostel', 85000.00, 85000.00, 'online', 'paid', '2025-08-10'),
(22, 11, 'RCPT/2025/012', 'tuition', 130000.00, 130000.00, 'online', 'paid', '2025-08-11'),
(23, 11, 'RCPT/2025/013', 'hostel', 85000.00, 85000.00, 'card', 'paid', '2025-08-11'),
(24, 12, 'RCPT/2025/014', 'tuition', 130000.00, 130000.00, 'online', 'paid', '2025-08-12'),
(25, 12, 'RCPT/2025/015', 'hostel', 85000.00, 0.00, '', 'pending', '2025-08-12');
-- -----------------------------------------------------
-- 19. library_books (8 books)
-- -----------------------------------------------------
INSERT INTO `library_books` (`id`, `title`, `isbn`, `author`, `co_author`, `publisher`, `publication_year`, `edition`, `category`, `sub_category`, `language`, `total_pages`, `total_copies`, `available_copies`, `rack_number`, `shelf_number`, `description`, `status`, `created_at`) VALUES
(1, 'Introduction to Algorithms', '978-0262033848', 'Thomas H. Cormen', 'Charles E. Leiserson', 'MIT Press', '2009', '3rd', 'Computer Science', 'Algorithms', 'English', 1312, 5, 3, 'A1', 'S1', 'Classic algorithms textbook', 'active', NOW()),
(2, 'Digital Design', '978-0134549897', 'M. Morris Mano', 'Michael D. Ciletti', 'Pearson', '2018', '6th', 'Electronics', 'Digital Logic', 'English', 720, 4, 2, 'B2', 'S1', 'Digital design fundamentals', 'active', NOW()),
(3, 'Engineering Thermodynamics', '978-0073398174', 'Yunus A. Cengel', 'Michael A. Boles', 'McGraw-Hill', '2014', '8th', 'Mechanical', 'Thermodynamics', 'English', 1024, 3, 1, 'C3', 'S2', 'Thermodynamics principles', 'active', NOW()),
(4, 'Database System Concepts', '978-0078022159', 'Abraham Silberschatz', 'Henry F. Korth', 'McGraw-Hill', '2019', '7th', 'Computer Science', 'Databases', 'English', 1344, 4, 4, 'A2', 'S1', 'DBMS concepts', 'active', NOW()),
(5, 'Signals and Systems', '978-0138147570', 'Alan V. Oppenheim', 'Alan S. Willsky', 'Pearson', '2013', '2nd', 'Electronics', 'Signals', 'English', 957, 3, 1, 'B3', 'S2', 'Signals and systems analysis', 'active', NOW()),
(6, 'Fluid Mechanics', '978-0123821003', 'Frank M. White', 'Henry Xue', 'Academic Press', '2015', '8th', 'Mechanical', 'Fluids', 'English', 896, 3, 0, 'C4', 'S3', 'Fluid mechanics', 'damaged', NOW()),
(7, 'Computer Networks', '978-0132126953', 'Andrew S. Tanenbaum', 'David J. Wetherall', 'Pearson', '2010', '5th', 'Computer Science', 'Networking', 'English', 960, 5, 3, 'A3', 'S2', 'Networking protocols', 'active', NOW()),
(8, 'Robotics: Control, Sensing, Vision', '978-0071004213', 'K.S. Fu', 'R.C. Gonzalez', 'McGraw-Hill', '1987', '1st', 'Mechanical', 'Robotics', 'English', 580, 2, 1, 'C5', 'S4', 'Robotics fundamentals', 'active', NOW());

-- -----------------------------------------------------
-- 20. communications (notices and alerts)
-- -----------------------------------------------------
INSERT INTO `communications` (`id`, `sender_id`, `sender_type`, `title`, `message`, `message_type`, `priority`, `target_type`, `target_id`, `is_published`, `published_at`, `created_at`) VALUES
(1, 1, 'admin', 'Holiday on 26th January', 'The institute will remain closed on 26th January on account of Republic Day.', 'notice', 'normal', 'all', NULL, 1, NOW(), NOW()),
(2, 1, 'admin', 'Mid-Term Exam Schedule', 'Mid-term examinations will commence from 10th March. See notice board for detailed timetable.', 'notice', 'high', 'all', NULL, 1, NOW(), NOW()),
(3, 1, 'admin', 'Hostel Fee Reminder', 'All hostel students are requested to pay the hostel fees by 31st January to avoid late fine.', 'alert', 'high', 'student', NULL, 1, NOW(), NOW()),
(4, 2, 'faculty', 'Data Structures Lab Cancelled', 'The Data Structures lab scheduled for 5th February is cancelled due to faculty meeting.', 'email', 'normal', 'batch', 1, 1, NOW(), NOW()),
(5, 1, 'admin', 'Library Timings Extended', 'Library will remain open till 10 PM during exam days.', 'notice', 'normal', 'all', NULL, 1, NOW(), NOW());

-- -----------------------------------------------------
-- Optional: student_attendance_summary (can be populated later)
-- -----------------------------------------------------
-- Not inserting as it can be calculated from attendance table.

-- -----------------------------------------------------
-- End of Dummy Data
-- -----------------------------------------------------