# StudentERP – Incremental Profiling Update (v1.7)

Since you have already run the previous `db.md`, only run this small block to add the **new** specific columns needed for the profile enhancement.

```sql
-- Run this block in phpMyAdmin
ALTER TABLE `students` 
ADD COLUMN IF NOT EXISTS `roll` VARCHAR(50) AFTER `registration_no`,
ADD COLUMN IF NOT EXISTS `roll_extra` VARCHAR(50) AFTER `roll`,
ADD COLUMN IF NOT EXISTS `identification_mark_extra` TEXT AFTER `identification_mark`,
ADD COLUMN IF NOT EXISTS `father_occupation` VARCHAR(255) AFTER `father_phone`,
ADD COLUMN IF NOT EXISTS `mother_occupation` VARCHAR(255) AFTER `mother_phone`,
ADD COLUMN IF NOT EXISTS `parent_address` TEXT AFTER `guardian_phone`;
```
