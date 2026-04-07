### 🛠️ Developer Protocol
Maintain one task at a time. When a new request arrives, reflect it in the **Dynamic Roadmap** below.

### 📜 Active Instructions
1. **Dynamic Task Management**: For every request, automatically break it down into an `Implementation Plan` and a `TODO List` within this session's context. 
2. **Schema Synchronization**: If a change requires database updates, always append the SQL query to a temporary `db.md` (or similar) but ensure the final logic is summarized in `latestchanges.md`.
3. **Commit Rule**: After completing a task, run `git add . && git commit -m "feat: [vX.X] description"` and update the **Latest Changes** log.

---
## 🎯 Dynamic Roadmap
- [x] **v1.7: Student Profile Expansion**: 6-tab UI (Personal, Contact, Guardian, Fees, Attendance, Results) with real-time tracking and schema fix.
- [ ] **Next Task**: Waiting for user input...

---
## 💾 Database Migration Log (Incremental)
*Assume all previous versions are executed. Only run the latest block below in phpMyAdmin.*

#### v1.7 (Latest)
```sql
-- Add profile columns to students
ALTER TABLE `students` 
ADD COLUMN IF NOT EXISTS `roll` VARCHAR(50) AFTER `registration_no`,
ADD COLUMN IF NOT EXISTS `roll_extra` VARCHAR(50) AFTER `roll`,
ADD COLUMN IF NOT EXISTS `identification_mark` TEXT AFTER `aadhaar_number`,
ADD COLUMN IF NOT EXISTS `identification_mark_extra` TEXT AFTER `identification_mark`,
ADD COLUMN IF NOT EXISTS `father_occupation` VARCHAR(255) AFTER `father_phone`,
ADD COLUMN IF NOT EXISTS `mother_occupation` VARCHAR(255) AFTER `mother_phone`,
ADD COLUMN IF NOT EXISTS `parent_address` TEXT AFTER `guardian_phone`;

-- Sync student_grades table
ALTER TABLE `student_grades` ADD COLUMN IF NOT EXISTS `batch_id` INT AFTER `student_id`;
ALTER TABLE `student_grades` ADD COLUMN IF NOT EXISTS `academic_year` VARCHAR(20) AFTER `batch_id`;
ALTER TABLE `student_grades` ADD COLUMN IF NOT EXISTS `is_internal` TINYINT(1) DEFAULT 0 AFTER `remarks`;
ALTER TABLE `student_grades` ADD COLUMN IF NOT EXISTS `is_practical` TINYINT(1) DEFAULT 0 AFTER `is_internal`;
ALTER TABLE `student_grades` ADD COLUMN IF NOT EXISTS `is_project` TINYINT(1) DEFAULT 0 AFTER `is_practical`;
ALTER TABLE `student_grades` ADD COLUMN IF NOT EXISTS `is_semester` TINYINT(1) DEFAULT 0 AFTER `is_project`;
ALTER TABLE `student_grades` ADD COLUMN IF NOT EXISTS `created_by` INT AFTER `is_semester`;
```
