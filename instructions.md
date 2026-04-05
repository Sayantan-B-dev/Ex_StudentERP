### note: .mark one job at a time when its done...also add a db.md in root(append each time...with version..assume the previous one is executed)..there put all the new queries or fake data i need to run in the xampp mysql db, after one task run `git add . && git commit -m "feat:....."` command

## create or check a todo.md(if created just check and proceed) on the root make your own list with these:
[ ] in academic perfomentce page "http://localhost/Ex_StudentERP/index.php?page=academic-performance" its showing "Fatal error: Uncaught PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column 's.roll' in 'field list' in C:\xampp\htdocs\Ex_StudentERP\view\performance\index.php:40 Stack trace: #0 C:\xampp\htdocs\Ex_StudentERP\view\performance\index.php(40): PDO->query('SELECT sg.*, CO...') #1 C:\xampp\htdocs\Ex_StudentERP\index.php(85): include('C:\\xampp\\htdocs...') #2 {main} thrown in C:\xampp\htdocs\Ex_StudentERP\view\performance\index.php on line 40"
[ ] in Student Profile in personal its showing "Warning
: Undefined array key "roll" in
C:\xampp\htdocs\Ex_StudentERP\view\students\view.php
on line
68


Warning
: Undefined array key "roll_extra" in
C:\xampp\htdocs\Ex_StudentERP\view\students\view.php
on line
69

Registration No.
REG2024_01
Roll
—
No.
—
Date of Birth
2005-06-15
Gender
Male
Blood Group
O+
Nationality
Indian
Religion
Hinduism
Caste Category
General
Aadhaar
123456789012
Identification Marks
1. Mole on right cheek
2.
Warning: Undefined array key "identification_mark_extra" in C:\xampp\htdocs\Ex_StudentERP\view\students\view.php on line 81
—"
[ ] in student profile in guardian its showing "Warning
: Undefined array key "father_occupation" in
C:\xampp\htdocs\Ex_StudentERP\view\students\view.php
on line
101


Warning
: Undefined array key "mother_occupation" in
C:\xampp\htdocs\Ex_StudentERP\view\students\view.php
on line
104


Warning
: Undefined array key "parent_address" in
C:\xampp\htdocs\Ex_StudentERP\view\students\view.php
on line
108

Father's Name
—
Father's Phone
—
Father's Occupation
—
Mother's Name
—
Mother's Phone
—
Mother's Occupation
—
Guardian Name
—
Relation
—
Guardian Phone
—"

[ ] i needed the fee update and tracking in student profile for each student that will be synced with other stuff acressos the project and would be updated automatically..
[ ] also in that student profile i need another tab showing his attendence..so far and all kind of info ...
[ ] in the same student profile i need another info regarding to all his or her results...
[ ] so there will be total of 6 tabs in student profile page :Personal,Contact,Guardian,Fees,Attendence,Results