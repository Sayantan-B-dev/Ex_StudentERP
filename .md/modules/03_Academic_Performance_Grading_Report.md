# Academic Performance & Grading

## A PROJECT REPORT

**By**

| Student Name | Registration Number |
|---|---|
| DIBADRITA BHADRA | D242507474 |
| SUDARSHAN PAL | D242507475 |
| ARDHENDU SEKHAR MAITY | D232419307 |
| SAMARESH METYA | D232419310 |
| SAYAN SANTRA | D232419311 |

---

**Guided By: Saikat Biswas**  
*Lecturer, Department of Computer Science & Technology*

**Department of Computer Science & Technology**  
Kingston Polytechnic College  
*(A UNIT OF KINGSTON EDUCATIONAL INSTITUTE)*  
*(AN ISO 9001-2000 Certified Institute)*  
BERUNANPUKURIA, BARASAT, 24 PGS (NORTH), KOLKATA-700126

**Date: March 2026**

---

## CERTIFICATE

This is to certify that the project entitled **"Academic Performance & Grading System"** is a bonafide work carried out by:

- DIBADRITA BHADRA (D242507474)
- SUDARSHAN PAL (D242507475)
- ARDHENDU SEKHAR MAITY (D232419307)
- SAMARESH METYA (D232419310)
- SAYAN SANTRA (D232419311)

under my guidance in partial fulfillment of the requirements for the completion of B.Tech. in Computer Science & Technology at Kingston Polytechnic College during the academic year 2025-2026.

The work has been completed as per my satisfaction and is ready for evaluation.

---

**Saikat Biswas**  
Lecturer, Department of Computer Science & Technology  
Kingston Polytechnic College

**Date:** March 2026

**Signature:** ___________________

---

## ACKNOWLEDGEMENT

We the students of B.Tech. 2nd year, Department of Computer Science & Technology, Kingston Polytechnic College, would like to express our sincere gratitude and deep regards to our guide **Saikat Biswas** (Lecturer, CST) for his excellent guidance, continuous support, and constructive criticism throughout the development of the **Academic Performance & Grading System** project.

We would also like to extend our thanks to all faculty members and staff of the Department of Computer Science & Technology, Kingston Polytechnic College, for their valuable suggestions and support. We are grateful to the Principal and the Administrative Staff of Kingston Polytechnic College for providing the necessary infrastructure and resources to complete this project.

Special thanks to all our friends and family members who directly or indirectly supported us during the entire development process.

---

**Submitted by:**

| Student Name | Registration Number |
|---|---|
| DIBADRITA BHADRA | D242507474 |
| SUDARSHAN PAL | D242507475 |
| ARDHENDU SEKHAR MAITY | D232419307 |
| SAMARESH METYA | D232419310 |
| SAYAN SANTRA | D232419311 |

**Date:** March 2026

---

## TABLE OF CONTENTS

| Sr. No. | Content | Page No. |
|---|---|---|
| 1 | Abstract | 6 |
| 2 | Chapter 1: Introduction | 8 |
| 2.1 | 1.1 Objective | 8 |
| 2.2 | 1.2 Scope of the Project | 9 |
| 2.3 | 1.3 Modules | 10 |
| 3 | Chapter 2: Requirement Specifications | 11 |
| 3.1 | 2.1 Hardware Requirements | 11 |
| 3.2 | 2.2 Software Requirements | 12 |
| 4 | Chapter 3: Analysis | 13 |
| 4.1 | 3.1 Existing System | 13 |
| 4.2 | 3.2 Proposed System | 14 |
| 4.3 | 3.3 Feasibility System | 15 |
| 4.4 | 3.4 Software Specification | 16 |
| 5 | Chapter 4: System Design | 17 |
| 5.1 | 4.1 Table Design | 17 |
| 5.2 | 4.2 Flowchart | 19 |
| 5.3 | 4.3 Data Flow Diagram | 20 |
| 5.4 | 4.4 E-R Diagram | 21 |
| 6 | Chapter 5: Sample Screenshots | 22 |
| 7 | Chapter 6: System Implementation | 24 |
| 8 | Chapter 7: Testing | 26 |
| 8.1 | 7.1 Introduction to System Testing | 26 |
| 8.2 | 7.2 Types of Testing | 27 |
| 9 | Chapter 8: Conclusion and Future Scope | 28 |
| 10 | Chapter 9: Reference | 29 |

---

## ABSTRACT

The Academic Performance & Grading System is a critical module of the Academic Monitoring System for Students, designed to assess, record, and analyze student academic performance across courses, semesters, and programs. This module provides a comprehensive platform for grade entry, GPA calculation, performance analytics, and academic standing determination.

The primary objective of this system is to automate grade management, eliminate manual calculation errors, and provide faculty, administrators, and students with transparent, real-time access to academic performance data. The system facilitates fair, consistent grade entry across multiple instructors and courses while generating insights for academic intervention and student support.

The proposed system addresses challenges in manual grading such as calculation errors in GPA, time-consuming grade processing, lack of performance transparency, and difficulty in identifying at-risk students. Key features include marks entry, grade calculation, GPA computation, performance analytics, and academic transcript generation. This report details the technical design, implementation approach, testing methodology, and future enhancements for the Academic Performance & Grading System.

---

## CHAPTER 1: INTRODUCTION

### 1.1 Objective

The Academic Performance & Grading System is developed with the following primary objectives:

1. **Automated Grade Management**: To automate the process of entering marks, calculating grades, and computing GPA, reducing manual effort and calculation errors.

2. **Transparent Performance Access**: To provide students and parents real-time access to grades, performance metrics, and academic standing information.

3. **Fair and Consistent Grading**: To implement standardized grading scales and calculation formulas that ensure consistency across all courses and instructors.

4. **Performance Analytics**: To analyze student performance patterns, identify at-risk students, and provide insights for academic intervention.

5. **Accurate Academic Transcript**: To automatically generate accurate academic transcripts with semester and cumulative GPA for institutional and external use.

### 1.2 Scope of the Project

The Academic Performance & Grading System is developed as an integral part of the Academic Monitoring System for Students. The scope includes:

**Functional Scope:**
- Marks entry for various assessment types (assignments, CA, mid-term, final exam)
- Automatic grade calculation based on institutional grading scale
- GPA and CGPA calculation
- Academic standing determination (Good, Warning, Probation)
- Performance analytics and trend analysis
- Academic transcript generation
- Export grades to CSV/Excel
- Revaluation and mark revision management

**Geographic Scope:**
- Applicable to all departments, programs, and courses within Kingston Polytechnic College
- Accessible to faculty, administrators, and students with appropriate permissions

**Time Scope:**
- Covers multiple semesters and academic years
- Enables historical performance comparison and trend analysis

**Technical Scope:**
- Web-based application using PHP, MySQL, HTML, CSS, and JavaScript
- Integration with Student Information and Course Management modules
- Statistical analysis and charting

### 1.3 Modules

The Academic Performance & Grading System comprises the following key features:

1. **Marks Entry Module**: Allows faculty to enter marks for assessments with validation rules.

2. **Grade Calculation Module**: Automatically calculates grades based on marks and institutional grading scale.

3. **GPA Calculation Module**: Computes semester GPA, cumulative GPA, and weighted averages.

4. **Academic Standing Module**: Determines student academic standing based on GPA thresholds.

5. **Performance Analytics Module**: Generates charts and insights on individual and class performance.

6. **Transcript Generation Module**: Creates academic transcripts with grades and GPA.

7. **Revaluation Management Module**: Handles mark revaluation requests and updates.

8. **Performance Trend Analysis**: Analyzes performance across semesters to identify improvement/decline.

---

## CHAPTER 2: REQUIREMENT SPECIFICATIONS

### 2.1 Hardware Requirements

For optimal performance of the Academic Performance & Grading System:

| Component | Requirement |
|---|---|
| **Processor** | Intel Core i5 (2.8 GHz) or equivalent dual-core processor |
| **RAM** | Minimum 4 GB (8 GB recommended) |
| **Hard Disk** | 500 GB with 10% free space for grade archives and transcripts |
| **Monitor** | 15-inch LED or LCD display with 1366×768 resolution minimum |
| **Network** | Internet connectivity with minimum 2 Mbps bandwidth |
| **Server Hardware** | Intel Xeon processor, 8 GB RAM, 1 TB HDD for production |

### 2.2 Software Requirements

| Component | Specification |
|---|---|
| **Operating System** | Windows 10/11, macOS, or Ubuntu Linux 20.04 LTS |
| **Web Server** | Apache HTTP Server 2.4.29 (XAMPP) |
| **Backend Language** | PHP 7.4.29 or higher |
| **Database** | MySQL 8.0 with PHP MySQLnd driver 7.4.29 |
| **Frontend Framework** | Bootstrap 5.3 Framework |
| **Frontend Languages** | HTML5, CSS3, JavaScript (Vanilla) |
| **Charting Library** | Chart.js for performance visualization |
| **PDF Generation** | TCPDF or similar for transcript generation |
| **Development IDE** | Visual Studio Code, Sublime Text, or PhpStorm |
| **Web Browser** | Google Chrome (latest), Mozilla Firefox, Microsoft Edge |

---

## CHAPTER 3: ANALYSIS

### 3.1 Existing System

In the present scenario, academic performance management involves:

1. **Manual Mark Recording**: Faculty maintain hand-written mark sheets or spreadsheets with:
   - Risk of errors in transcription
   - Difficult calculations for GPA
   - No centralized repository
   - Inconsistent grading scales

2. **Fragmented Grade Storage**: Grades scattered across:
   - Faculty personal files
   - Department office records
   - Individual spreadsheets
   - Manual transcripts

### 3.2 Proposed System

The Academic Performance & Grading System proposes:

1. **Centralized Grade Management**: Single database for all grades across all courses and semesters.

2. **Automated Calculations**: Automatic grade conversion and GPA computation with configurable scales.

3. **Real-Time Access**: Students and parents view grades immediately after entry.

4. **Performance Analytics**: Dashboards showing performance trends and comparative analysis.

5. **Audit Trail**: Complete record of all grade entries and modifications.

### 3.3 Feasibility System

#### Economic Feasibility
- **Cost Savings**: Eliminates manual transcript preparation and reduces administrative time.
- **Efficiency Gains**: Grade processing and distribution much faster.
- **Verdict**: **FEASIBLE** – Economically viable for institution.

#### Technical Feasibility
- **Technology Stack**: PHP, MySQL proven for educational systems.
- **Integration**: Compatible with existing student and course management modules.
- **Verdict**: **FEASIBLE** – Technically sound implementation possible.

#### Operational Feasibility
- **User Training**: Faculty can be trained on marks entry quickly.
- **Adoption**: System improves transparency and reduces complaints.
- **Verdict**: **FEASIBLE** – Operationally implementable.

### 3.4 Software Specification

#### HTML5
HTML5 structures:
- Mark entry forms with multiple assessment fields
- Grade display tables and transcripts
- Interactive performance dashboards
- PDF transcript rendering templates

#### CSS3
CSS3 ensures:
- Responsive grade sheet layouts
- Grade color-coding (Excellent=Green, Pass=Blue, Fail=Red)
- Print-friendly transcript styling
- Mobile-compatible performance charts

#### JavaScript
JavaScript provides:
- Real-time grade preview and calculation
- Form validation (marks within range 0-100)
- Dynamic GPA updates as marks are entered
- Chart rendering for performance visualization
- Export functionality

#### PHP
PHP handles:
- Marks entry and validation
- Grade calculation logic
- GPA computation algorithms
- Transcript generation
- Statistical analysis

#### MySQL
MySQL stores:
- **Marks**: Student, subject, assignment, assessment type, marks
- **Grades**: Grade scale definitions, grade points, letter grades
- **GPA Records**: Semester GPA, cumulative GPA, weighted averages
- **Transcripts**: Generated transcripts with timestamps

---

## CHAPTER 4: SYSTEM DESIGN

### 4.1 Table Design

#### Table 1: `student_grades` (Primary Data Hub)
*Note: The physical schema for this table is defined in **Module 01: Student Information Management** as part of the Student 360 profile. This module (Module 03) focuses on the processing and analytics of this data.*
| Field | Type | Description |
|---|---|---|
| id | int(11) | Primary Key, Auto Increment |
| student_id | int(11) | Reference to student |
| batch_id | int(11) | Reference to academic batch |
| academic_year | varchar(20) | Academic year (e.g., 2026-2027) |
| subject_id | int(11) | Reference to subject |
| examination_id | int(11) | Reference to examination |
| total_marks | decimal(5,2) | Total possible marks |
| marks_obtained | decimal(5,2) | Marks obtained by the student |
| grade | varchar(5) | Grade letter (A, B, C, etc.) |
| grade_point | decimal(3,2) | Calculated grade points |
| remarks | text | Additional comments |
| is_internal | tinyint(1) | Flag for internal assessment |
| is_practical | tinyint(1) | Flag for practical examination |
| is_project | tinyint(1) | Flag for project work |
| is_semester | tinyint(1) | Flag for end-semester examination |
| created_by | int(11) | Faculty who entered the grades |
| created_at | timestamp | Record creation time |

### 4.2 Flowchart

```mermaid
graph TD
    A[Start: Exam Grading] --> B[Faculty Selects Exam & Batch]
    B --> C[Fetch Student List]
    C --> D[Enter Marks Obtained]
    D --> E{Marks > Max Marks?}
    E -- Yes --> F[Display Error]
    F --> D
    E -- No --> G[Calculate Grade & Grade Point]
    G --> H[Submit Result]
    H --> I[Update student_grades Table]
    I --> J[Notify Students/Parents]
    J --> K[End]
```

### 4.3 Data Flow Diagram

```mermaid
graph LR
    Faculty((Faculty)) -- Marks Entry --> P1[Grading Process]
    P1 -- Records --> T1[(student_grades Table)]
    T1 -- Result Data --> P2[Reporting Process]
    P2 -- Performance Dashboard --> Student((Student))
    P2 -- Transcripts --> Admin((Admin))
```

### 4.4 E-R Diagram

```mermaid
erDiagram
    STUDENTS ||--o{ STUDENT_GRADES : "earns"
    SUBJECTS ||--o{ STUDENT_GRADES : "graded_in"
    EXAMINATIONS ||--o{ STUDENT_GRADES : "marks_for"
    ACADEMIC_BATCHES ||--o{ STUDENT_GRADES : "cohort_results"
```

---

## CHAPTER 5: SAMPLE SCREENSHOTS
**1. Academic Performance Dashboard**
*Overview of student grades and class performance statistics.*
![Performance Dashboard](https://example.com/screenshots/performance_dashboard.png)

**2. Individual Student Grade Modal**
*Detailed view of a single student's performance across all subjects.*
![Student Grade Modal](https://example.com/screenshots/performance_modal.png)

**3. Semester-wise Results View**
*Table display of results for a specific semester and batch.*
![Semester Results](https://example.com/screenshots/performance_results.png)

---

## CHAPTER 6: SYSTEM IMPLEMENTATION

### Marks Entry Form (HTML + PHP)

**HTML Form:**
```html
<form id="marksForm" method="POST" action="save_marks.php" class="marks-form">
    <div class="form-group">
        <label for="subjectSelect">Select Subject</label>
        <select id="subjectSelect" name="subject_id" class="form-control" required>
            <option value="">-- Select Subject --</option>
        </select>
    </div>

    <div class="form-group">
        <label for="semesterSelect">Semester</label>
        <select id="semesterSelect" name="semester_id" class="form-control" required>
            <option value="">-- Select Semester --</option>
        </select>
    </div>

    <div class="marks-table">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Registration No</th>
                    <th>CA1 (10)</th>
                    <th>CA2 (10)</th>
                    <th>Mid-Term (20)</th>
                    <th>Final Exam (60)</th>
                    <th>Total (100)</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody id="marksBody">
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-primary">Save Marks</button>
</form>
```

### PHP Marks Calculation

**save_marks.php:**
```php
<?php
session_start();
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = intval($_POST['subject_id'] ?? 0);
    $semester_id = intval($_POST['semester_id'] ?? 0);
    $marks_data = $_POST['marks'] ?? []; // Array: student_id => marks
    
    try {
        $pdo->beginTransaction();
        
        $insertSql = "INSERT INTO marks 
                      (student_id, subject_id, assignment_type, marks_obtained, 
                       marks_total, weightage, entered_by) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)
                      ON DUPLICATE KEY UPDATE marks_obtained = VALUES(marks_obtained)";
        
        $insertStmt = $pdo->prepare($insertSql);
        
        foreach ($marks_data as $student_id => $assessment_marks) {
            $student_id = intval($student_id);
            
            // Student marks: array with CA1, CA2, MidTerm, FinalExam
            $ca1 = floatval($assessment_marks['ca1'] ?? 0);
            $ca2 = floatval($assessment_marks['ca2'] ?? 0);
            $midterm = floatval($assessment_marks['midterm'] ?? 0);
            $final = floatval($assessment_marks['final'] ?? 0);
            
            // Validate marks
            if ($ca1 < 0 || $ca1 > 10 || $ca2 < 0 || $ca2 > 10 || 
                $midterm < 0 || $midterm > 20 || $final < 0 || $final > 60) {
                continue;
            }
            
            // Insert individual assessment marks
            $assessments = [
                ['CA1', $ca1, 10, 10],
                ['CA2', $ca2, 10, 10],
                ['MidTerm', $midterm, 20, 20],
                ['FinalExam', $final, 60, 60]
            ];
            
            foreach ($assessments as $assessment) {
                $insertStmt->execute([
                    $student_id,
                    $subject_id,
                    $assessment[0],
                    $assessment[1],
                    $assessment[2],
                    $assessment[3],
                    $_SESSION['user_id']
                ]);
            }
            
            // Calculate final grade
            $totalMarks = $ca1 + $ca2 + $midterm + $final;
            calculateAndSaveGrade($student_id, $subject_id, $totalMarks, $semester_id, $pdo);
        }
        
        // Recalculate GPA for affected students
        recalculateSemesterGPA($semester_id, $pdo);
        
        $pdo->commit();
        $_SESSION['success'] = 'Marks saved and grades calculated successfully';
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = 'Error saving marks: ' . $e->getMessage();
    }
    
    header('Location: marks_entry.php');
    exit();
}

function calculateAndSaveGrade($student_id, $subject_id, $totalMarks, $semester_id, $pdo) {
    // Get grade scale
    $sql = "SELECT letter_grade, grade_points FROM grade_scale 
            WHERE ? BETWEEN min_marks AND max_marks";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$totalMarks]);
    $gradeData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$gradeData) {
        $gradeData = ['letter_grade' => 'F', 'grade_points' => 0];
    }
    
    // Insert or update grade
    $insertGradeSql = "INSERT INTO grades 
                       (student_id, subject_id, semester_id, final_marks, 
                        letter_grade, grade_points, status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)
                       ON DUPLICATE KEY UPDATE 
                       final_marks = VALUES(final_marks),
                       letter_grade = VALUES(letter_grade),
                       grade_points = VALUES(grade_points),
                       status = VALUES(status)";
    
    $insertGradeStmt = $pdo->prepare($insertGradeSql);
    $insertGradeStmt->execute([
        $student_id,
        $subject_id,
        $semester_id,
        $totalMarks,
        $gradeData['letter_grade'],
        $gradeData['grade_points'],
        $totalMarks >= 40 ? 'Passed' : 'Failed'
    ]);
}

function recalculateSemesterGPA($semester_id, $pdo) {
    // Get all students in semester
    $sql = "SELECT DISTINCT g.student_id, 
            ROUND(AVG(g.grade_points), 2) as gpa
            FROM grades g
            WHERE g.semester_id = ? AND g.status = 'Passed'
            GROUP BY g.student_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$semester_id]);
    
    $updateSql = "INSERT INTO gpa_records 
                  (student_id, semester_id, semester_gpa, cumulative_gpa, academic_standing)
                  VALUES (?, ?, ?, ?, ?)
                  ON DUPLICATE KEY UPDATE 
                  semester_gpa = VALUES(semester_gpa),
                  cumulative_gpa = VALUES(cumulative_gpa),
                  academic_standing = VALUES(academic_standing)";
    
    $updateStmt = $pdo->prepare($updateSql);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cgpa = calculateCumulativeGPA($row['student_id'], $pdo);
        $standing = $cgpa >= 3.5 ? 'Good' : ($cgpa >= 2.0 ? 'Warning' : 'Probation');
        
        $updateStmt->execute([
            $row['student_id'],
            $semester_id,
            $row['gpa'],
            $cgpa,
            $standing
        ]);
    }
}
?>
```

### JavaScript for Dynamic Grade Calculation

```javascript
document.getElementById('marksForm').addEventListener('submit', function(e) {
    const form = this;
    const rows = form.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const ca1 = parseFloat(row.querySelector('input[name*="ca1"]').value) || 0;
        const ca2 = parseFloat(row.querySelector('input[name*="ca2"]').value) || 0;
        const midterm = parseFloat(row.querySelector('input[name*="midterm"]').value) || 0;
        const final = parseFloat(row.querySelector('input[name*="final"]').value) || 0;
        
        const total = ca1 + ca2 + midterm + final;
        row.querySelector('input[name*="total"]').value = total.toFixed(2);
        
        const gradeCell = row.querySelector('[data-grade]');
        if (gradeCell) {
            const grade = calculateGrade(total);
            gradeCell.textContent = grade;
        }
    });
});

function calculateGrade(marks) {
    if (marks >= 90) return 'A+';
    if (marks >= 80) return 'A';
    if (marks >= 70) return 'B';
    if (marks >= 60) return 'C';
    if (marks >= 50) return 'D';
    if (marks >= 40) return 'E';
    return 'F';
}
```

---

## CHAPTER 7: TESTING

### 7.1 Introduction to System Testing

System testing verifies:

1. Marks entered correctly and stored in database
2. Grades calculated accurately based on scale
3. GPA computations are mathematically correct
4. Academic standing determination works properly
5. Transcripts generated with correct information
6. System handles edge cases (failed students, borderline grades)

### 7.2 Types of Testing

#### Unit Testing
- Test grade calculation for all grade boundaries
- Test GPA calculation formula
- Test academic standing logic
- Test marks validation (0-100 range)

#### Integration Testing
- Marks entry → Grade calculation → GPA update → Transcript generation
- Mark modification → GPA recalculation
- Student performance view → Dashboard update

#### Functional Testing
- Enter marks for 50 students in a subject
- View individual student grades
- Generate academic transcript
- Export grades to CSV
- Access performance analytics

#### White Box Testing
- Test boundary conditions (90 marks for A+ threshold)
- Test GPA calculation with decimal places
- Test transaction handling for bulk updates
- Verify database constraints prevent invalid grades

#### Black Box Testing
- User enters marks → System calculates grade → Grade visible to student
- User generates transcript → PDF created with correct format
- User exports grades → CSV contains all data

#### Security Testing
- Non-faculty cannot enter grades
- Students cannot modify grades
- Grade modifications create audit logs
- Only authorized admins can approve marks

#### Performance Testing
- Enter marks for 500+ students simultaneously
- Generate transcript for student with 8 semesters of data
- Generate class performance report with 200+ students
- Chart rendering for performance analytics

---

## CHAPTER 8: CONCLUSION AND FUTURE SCOPE

### Conclusion

The Academic Performance & Grading System successfully automates grade management and provides transparent access to academic performance information. The system ensures fair, consistent grading while providing valuable insights for student support and institutional planning.

Key achievements:
- Automated grade calculation reducing manual errors
- Real-time performance transparency for students and parents
- Comprehensive analytics for identifying at-risk students
- Accurate, tamper-proof academic transcripts

### Future Scope

1. **Grade Prediction**: AI model to predict final grades based on mid-term performance
2. **Comparative Analysis**: Show student performance relative to class average
3. **Learning Path Recommendations**: Suggest courses based on academic strengths/weaknesses
4. **Mobile Grade Viewing**: App for students to view grades on mobile devices
5. **Parent Alerts**: Automated SMS/email when grades are uploaded
6. **Grade Appeals**: Online process for students to appeal grades
7. **Multiple Grade Scales**: Support different grading scales for different programs
8. **Weighted GPA**: Calculate GPA based on course credits
9. **Performance Prediction**: Predict graduation eligibility early
10. **Multi-Language Transcripts**: Generate transcripts in multiple languages

---

## CHAPTER 9: REFERENCE

1. **PHP Official Documentation**: https://www.php.net/manual/en/

2. **MySQL Documentation**: https://dev.mysql.com/doc/

3. **Bootstrap Framework**: https://getbootstrap.com/docs/5.3/

4. **Chart.js Documentation**: https://www.chartjs.org/docs/latest/

5. **MDN Web Docs**: https://developer.mozilla.org/en-US/

6. **W3Schools PHP**: https://www.w3schools.com/php/

7. **W3Schools MySQL**: https://www.w3schools.com/mysql/

8. **Educational Technology Standards**: https://www.ieee.org/

9. **Grading Rubrics and Assessment**: Brookhart, S. M. (2013)

10. **Database Design**: Silberschatz, A., Korth, H. F., & Sudarshan, S. (2010)

---

**End of Report**
