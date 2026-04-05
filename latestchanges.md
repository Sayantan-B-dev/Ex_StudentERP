# StudentERP – Latest Changes Log

This document tracks major feature updates, database migrations, and UI/UX improvements made to the system.

## April 5, 2026 – [v1.7.2] – Profile Expansion & Schema Fix
Finalized the student profile revmap and resolved critical database join errors.

### 🚀 New Features
- **6-Tab Student Profile**: 
    - **Personal, Contact, Guardian, Fees, Attendance, Results**.
    - Integrated real-time tracking for academic performance and fee history.
    - Added progress bars and summary indicators for student attendance.
- **Enhanced Data Integrity**: Added null coalescing across the profile to prevent PHP warnings.

### 🛠️ Database Updates
- **students**: New columns for `roll`, `roll_extra`, `identification_mark_extra`, `father_occupation`, `mother_occupation`, and `parent_address`.
- **student_grades**: Added `batch_id`, `academic_year`, `is_internal`, `is_practical`, `is_project`, and `is_semester`.

### 🧹 Workspace Cleanup
- Consolidated `todo.md`, `db.md`, `implementation_plan.md`, and `instructions.md` into a single, dynamic **`instruction.md`** file for streamlined future development.

---

## April 5, 2026 – [v1.5] – Dynamic Scheduling & Academic Calendar
Integrated a professional timetable management system with conflict detection and holiday syncing.

### 🚀 New Features
- **Editable Timetable**: 
    - Interactive 9:00 AM – 5:00 PM weekly grid view.
    - Modal-based class creation with duration (Start/End time) and Room allocation.
- **Conflict Tracking**: Automated check to prevent multiple classes for the same batch at the same time.
- **Holiday Management**: 
    - Dedicated tool to mark holidays (Admin only).
    - Sidebar sync: Displays the next 5 upcoming holidays across the academic calendar.
- **Faculty Availability**: Links schedules directly to active staff records.

### 🛠️ Database Updates
- **holidays**: New table for institute-wide calendar management.
- **class_schedules**: Optimized for time-based conflict queries.

---

### [v1.6] - 2026-04-05
- **UI/UX Refinement**:
    -   Applied consistent **shadows** across all card elements for a more premium look.
    -   Redesigned Class Schedule view with **"Bubble Style"** rounded cards for subjects.
    -   Aligned Stat Card sizes in the Attendance Dashboard for consistent proportions.
- **Bug Fixes**:
    -   Resolved **PHP Parse Error** in `view/attendance/add.php` (unmatched closing brace in POST block).
    -   Optimized Attendance stats icons and layout.

---

## April 5, 2026 – [v1.4] – Staff Management Extensions (Activities & Salary)
Added comprehensive tracking for faculty activities and historical salary disbursements.

### 🚀 New Features
- **Staff Activity Log**: Tabbed section in Staff Profile to track duties, meetings, and tasks.
    - Modal-based entry for quick logging.
    - Status tracking (Pending/Completed).
- **Salary History Tracking**: Full history of monthly salary payments, including:
    - Base salary, Bonus, and Deductions.
    - Auto-summary of "Total Paid" on the profile sidebar.
    - Receipt/Reference number storage for bank transfers.

### 🛠️ Database Updates
- **staff_activities**: New table for tracking staff tasks and performance.
- **staff_salaries**: New table for recording financial disbursements.

---

## April 5, 2026 – [v1.3] – Attendance & Fee Management
Improved tracking with detailed reporting, session support, and automated financial rules.

### 🚀 New Features
- **Batch Attendance Reports**: One-click CSV download for all attendance records of a specific batch.
- **Enhanced Attendance Marking**: 
    - Support for multiple sessions per day.
    - Added "Half Day" status and mandatory remarks field.
    - Standardized "Mark All" Present/Absent buttons.
- **Automated Fee Engine**: 
    - Automated fine calculation: ₹150/day added if paid after the 11th of the month.
    - Support for diverse payment periods: Monthly, Quarterly, Half-Yearly, Yearly, One-time.
    - Dynamic receipt generation.

### 🛠️ Database Updates
- **attendance**: Added `session_id`, `remarks`, and expanded `status` enum.
- **fee_transactions**: Added `fine_amount`, `payment_period`, `due_date`, and expanded `payment_status`.

---

## April 5, 2026 – [v1.2] – Student Information & Bulk Upload
Enhanced the student profile to support full personal and identification data, along with a high-performance CSV import system.

### 🚀 New Features
- **Bulk Student Upload**: Added "Bulk Upload (CSV)" tab to the Add Student page. 
    - Supports auto-generation of Admission Numbers.
    - Automatic mapping for Programs and Batches via codes (e.g., `CSE`, `2023-27`).
    - Post-upload report showing success/total counts.
- **Enriched Student Profiles**: Full support for Aadhaar, Identification Marks, and detailed Parent/Guardian data.

### 🛠️ Database Updates (students table)
- Added columns: `blood_group`, `nationality`, `religion`, `caste_category`, `aadhaar_number`, `identification_mark`, `identification_mark_extra`.
- Added Parent/Guardian fields: `father_occupation`, `mother_occupation`, `parent_address`, `guardian_relation`.
- Expanded contact fields: `alternate_phone`, `current_address`, `city`, `state`, `pincode`, `country`.

### 🎨 UI/UX Improvements
- **Redesigned Add/Edit Forms**: Grouped into Personal, Academic, and Guardian sections.
- **Updated Student View**: Enhanced tabbed profile view to display all extended fields.
- **Sample Templates**: Created `assets/samples/students_template.csv` for bulk uploads.

---

## April 5, 2026 – [v1.1] – Academic Performance & Staff Management
Revamped internal grading and project tracking, and added full editability to staff records.

### 🚀 New Features
- **Academic Performance Revamp**: 
    - Modular tabbed view for Internal, Practical, Project, and Semester results.
    - Full CRUD functionality for grade entries with a unified POST handler.
    - Real-time performance metrics (Total, Pass, Fail, Avg %).
- **Staff Management Editability**:
    - Added "Edit" functionality to Staff Categories, Designations, and Subject Allocations.
    - Smooth form population and scroll behavior for administrative management.

### 🛠️ Database Updates
- **examinations**: Expanded `exam_type` enum (internal, practical, project, semester).
- **student_grades**: Added flags (`is_internal`, `is_project`, etc.) and batch/year links.
- **student_projects**: Created new table to track group projects.

---

## April 4, 2026 – [v1.0] – Sidebar & Universal Filtering
Optimized navigation and added standardized filtering across the application.

### 🚀 New Features
- **Standardized Filtering**: Global Search and Status filtering injected into all major list views.
- **Improved Navigation**: Fixed-height, compact sidebar with optimized link spacing and dropdowns.

---
*Next up: Attendance Tracking Reports and Fees & Fine Engine.*
