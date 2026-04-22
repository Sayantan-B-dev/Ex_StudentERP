# Attendance Tracking

## A PROJECT REPORT

**By**

| Student Name | Registration Number |
|---|---|
| ARNAB HALDER | D242507469 |
| PRIYANKA DAS | D242507470 |
| PALLABI HALDER | D242507471 |
| PARAMITA DAS | D242507472 |
| ALAMIN GAZI | D242507473 |

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

This is to certify that the project entitled **"Attendance Tracking System"** is a bonafide work carried out by:

- ARNAB HALDER (D242507469)
- PRIYANKA DAS (D242507470)
- PALLABI HALDER (D242507471)
- PARAMITA DAS (D242507472)
- ALAMIN GAZI (D242507473)

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

We the students of B.Tech. 2nd year, Department of Computer Science & Technology, Kingston Polytechnic College, would like to express our sincere gratitude and deep regards to our guide **Saikat Biswas** (Lecturer, CST) for his excellent guidance, continuous support, and constructive criticism throughout the development of the **Attendance Tracking System** project.

We would also like to extend our thanks to all faculty members and staff of the Department of Computer Science & Technology, Kingston Polytechnic College, for their valuable suggestions and support. We are grateful to the Principal and the Administrative Staff of Kingston Polytechnic College for providing the necessary infrastructure and resources to complete this project.

Special thanks to all our friends and family members who directly or indirectly supported us during the entire development process.

---

**Submitted by:**

| Student Name | Registration Number |
|---|---|
| ARNAB HALDER | D242507469 |
| PRIYANKA DAS | D242507470 |
| PALLABI HALDER | D242507471 |
| PARAMITA DAS | D242507472 |
| ALAMIN GAZI | D242507473 |

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

The Attendance Tracking System is a critical module of the Academic Monitoring System for Students, designed to efficiently monitor and record student attendance in classes and academic activities. This module provides a systematic approach to tracking classroom attendance, generating attendance reports, and monitoring compliance with institutional attendance policies.

The primary objective of this system is to eliminate manual attendance marking through paper-based registers and provide real-time, accurate attendance records accessible to faculty, administrators, and students. The system facilitates efficient attendance management across multiple courses, batches, and departments while maintaining attendance history for academic and administrative purposes.

The proposed system addresses challenges in manual attendance tracking such as errors in record-keeping, time consumption, difficulty in generating reports, and inability to identify attendance patterns and trends. Key features include daily attendance marking, bulk attendance import, attendance reports generation, and automated alerts for low attendance. This report details the technical design, implementation approach, testing methodology, and future enhancements for the Attendance Tracking System.

---

## CHAPTER 1: INTRODUCTION

### 1.1 Objective

The Attendance Tracking System is developed with the following primary objectives:

1. **Automated Attendance Recording**: To eliminate manual attendance marking through paper-based registers, reducing time and human errors in attendance recording.

2. **Real-Time Attendance Monitoring**: To provide faculty, administrators, and students with real-time access to attendance records and attendance status.

3. **Comprehensive Reporting**: To generate detailed attendance reports by class, course, student, faculty, and date range for administrative analysis and decision-making.

4. **Attendance Analysis**: To track and analyze attendance patterns to identify students at risk of poor academic performance due to low attendance.

5. **Compliance and Alert System**: To enforce institutional attendance policies and send automated alerts for students with attendance below threshold levels.

### 1.2 Scope of the Project

The Attendance Tracking System is developed as an integral part of the Academic Monitoring System for Students. The scope includes:

**Functional Scope:**
- Daily attendance marking for scheduled classes
- Bulk attendance import from CSV files
- Attendance reporting by various criteria
- Permissions and exemptions management
- Automated alerts for low attendance
- Attendance verification and modification by authorized users

**Geographic Scope:**
- Applicable to all departments, programs, and courses within Kingston Polytechnic College
- Accessible to faculty, administrators, and students

**Time Scope:**
- Covers entire academic year with historical data retention for multiple years
- Enables semester-wise and course-wise attendance analysis

**Technical Scope:**
- Web-based application using PHP, MySQL, HTML, CSS, and JavaScript
- Integration with Student Information Management and Course Management modules
- Compatibility with modern web browsers

### 1.3 Modules

The Attendance Tracking System comprises the following key components:

1. **Attendance Marking Module**: Allows faculty to mark attendance for each class session with provisions for excused absences and leaves.

2. **Bulk Attendance Import Module**: Enables administrators to upload attendance data from external sources (spreadsheets) in bulk.

3. **Attendance Reporting Module**: Generates comprehensive reports of attendance by class, course, date range, and student.

4. **Student Attendance Dashboard**: Provides students personal access to view their own attendance record and percentage.

5. **Attendance Analysis Module**: Analyzes attendance trends, identifies chronically absent students, and generates insights.

6. **Alert and Notification Module**: Sends automated alerts to students and parents for low attendance or excessive absenteeism.

7. **Leave and Exemption Management**: Maintains records of legitimate absences (medical leave, permission, etc.) and adjusts attendance calculations.

8. **Attendance Verification Module**: Allows administrators to verify, modify (with audit trail), and approve attendance records.

---

## CHAPTER 2: REQUIREMENT SPECIFICATIONS

### 2.1 Hardware Requirements

For optimal performance of the Attendance Tracking System, the following hardware specifications are recommended:

| Component | Requirement |
|---|---|
| **Processor** | Intel Core i5 (2.8 GHz) or equivalent dual-core processor |
| **RAM** | Minimum 4 GB (8 GB recommended) |
| **Hard Disk** | 500 GB with 10% free space for attendance archives |
| **Monitor** | 15-inch LED or LCD display with 1366×768 resolution minimum |
| **Input Devices** | Keyboard and Mouse |
| **Network** | Internet connectivity with minimum 2 Mbps bandwidth |
| **Server Hardware** | Intel Xeon processor, 8 GB RAM, 1 TB HDD for production deployment |

### 2.2 Software Requirements

| Component | Specification |
|---|---|
| **Operating System** | Windows 10/11, macOS, or Ubuntu Linux 20.04 LTS |
| **Web Server** | Apache HTTP Server 2.4.29 (XAMPP) |
| **Backend Language** | PHP 7.4.29 or higher |
| **Database** | MySQL 8.0 with PHP MySQLnd driver 7.4.29 |
| **Frontend Framework** | Bootstrap 5.3 Framework |
| **Frontend Languages** | HTML5, CSS3, JavaScript (Vanilla) |
| **Chart Libraries** | Chart.js for attendance visualization |
| **Development IDE** | Visual Studio Code, Sublime Text, or PhpStorm |
| **Web Browser** | Google Chrome (latest), Mozilla Firefox, Microsoft Edge |
| **Database Tool** | phpMyAdmin 5.1 or MySQL Workbench |
| **Version Control** | Git with GitHub repository |

---

## CHAPTER 3: ANALYSIS

### 3.1 Existing System

In the present scenario, most educational institutions manage attendance through:

1. **Manual Attendance Registers**: Faculty manually maintain paper-based attendance registers with:
   - Risk of data loss or damage
   - Difficult searches and retrieval
   - No automated reporting capabilities
   - Inconsistent formatting across departments

2. **Fragmented Digital Records**: Some institutions use:
   - Separate spreadsheets per faculty
   - Email-based attendance submission
   - Incomplete historical records
   - Difficulty in consolidation and analysis

3. **Problems with Existing System**:
   - **Time-Consuming**: Manual marking and record-keeping takes significant class time
   - **Error-Prone**: Calculation errors, illegible entries, and duplicate records
   - **Poor Accessibility**: Students cannot view attendance; parents unaware of absence
   - **No Real-Time Monitoring**: Administrators cannot track attendance patterns
   - **Compliance Issues**: Difficult to enforce institutional policies
   - **Limited Reporting**: Generating reports requires manual compilation
   - **No Alerts**: Students and parents unaware until semester end

### 3.2 Proposed System

The Attendance Tracking System proposes a modern, integrated solution:

1. **Automated Marking**: Faculty quickly mark attendance using web interface or mobile app.

2. **Real-Time Access**: Students and parents can view attendance anytime, anywhere.

3. **Comprehensive Reports**: Automatic generation of attendance reports with filters and exports.

4. **Pattern Analysis**: Identify students with chronic absenteeism and early intervention.

5. **Automated Alerts**: Real-time notifications for low attendance to students, parents, and advisors.

6. **Leave Management**: Track and manage approved leaves separately from unexcused absences.

7. **Data Integrity**: Secure recording with audit trails for attendance modifications.

8. **Integration**: Seamless integration with other ERP modules for holistic student monitoring.

### 3.3 Feasibility System

#### Economic Feasibility
- **Cost Reduction**: Eliminates paper usage, reduces administrative overhead, and saves faculty time.
- **ROI**: Investment recovered through increased efficiency and reduced manual labor.
- **Scalability**: System can handle increasing enrollment without proportional cost increase.
- **Verdict**: **FEASIBLE** – Economically viable for Kingston Polytechnic College.

#### Technical Feasibility
- **Technology Stack**: PHP, MySQL proven and widely supported technologies.
- **Infrastructure**: College infrastructure supports the system requirements.
- **Integration**: Easy integration with existing Student Information Management module.
- **Verdict**: **FEASIBLE** – Technically sound implementation possible.

#### Operational Feasibility
- **User Training**: Faculty can be trained on attendance marking within hours.
- **Adoption**: System is intuitive and improves working efficiency.
- **Change Management**: Transition from manual to automated can be phased.
- **Verdict**: **FEASIBLE** – Operationally implementable with minimal disruption.

### 3.4 Software Specification

#### HTML5
HTML5 provides semantic structure for attendance marking forms and reports:
- Form elements for attendance input (checkboxes, date pickers, selects)
- Table structures for attendance display
- Input masks for efficient data entry
- Accessibility features for screen reader compatibility

#### CSS3
CSS3 styling with Bootstrap framework ensures:
- Responsive attendance sheets that work on tablets and desktops
- Color-coded attendance status (Present=Green, Absent=Red, Leave=Yellow)
- Print-friendly styles for attendance reports
- Mobile-optimized interface for faculty

#### JavaScript
JavaScript enhances user interaction:
- Real-time form validation
- Quick attendance marking with keyboard shortcuts
- Dynamic updates without page reload
- Chart rendering for attendance visualization
- Export functionality to CSV/PDF

#### PHP
PHP handles business logic:
- Attendance marking and storage
- Report generation with filters
- Alert triggering based on thresholds
- Data validation and sanitization
- Session management for role-based access

#### MySQL
MySQL database stores:
- **Attendance Records**: Class, date, student, and status.
- **Holidays**: Master list of non-working days affecting academic schedules.
- **Referential Integrity**: Linking attendance to students, subjects, and batches.

---

## CHAPTER 4: SYSTEM DESIGN

### 4.1 Table Design

#### Table 1: `attendance`
| Field | Type | Description |
|---|---|---|
| id | int(11) | Primary Key, Auto Increment |
| student_id | int(11) | Reference to student |
| subject_id | int(11) | Reference to subject |
| batch_id | int(11) | Reference to academic batch |
| session_id | int(11) | Session identifier |
| attendance_date | date | Date of class |
| status | enum('present','absent','late','half_day') | Attendance status |
| remarks | text | Additional notes |
| marked_by | int(11) | Reference to faculty/admin who marked it |
| created_at | timestamp | Record creation time |

#### Table 2: `holidays`
| Field | Type | Description |
|---|---|---|
| id | int(11) | Primary Key, Auto Increment |
| holiday_date | date | Date of the holiday |
| title | varchar(255) | Name of the holiday |
| description | text | Details about the holiday |
| created_by | int(11) | User who created the record |
| created_at | timestamp | Record creation time |

### 4.2 Flowchart

[Placeholder: Provide flowchart illustrating the daily attendance marking process including: faculty login, class selection, student list display, marking attendance (present/absent/leave), validation, database storage, and confirmation. Include decision points for leave verification and alert generation.]

### 4.3 Data Flow Diagram

[Placeholder: Provide DFD showing flow from faculty initiating attendance marking through validation, database storage, to report generation and alert triggering. Show interactions with student information, leave management, and notification systems.]

### 4.4 E-R Diagram

[Placeholder: Provide ER diagram showing entities: Students, Classes, Subjects, Faculty, Attendance, LeaveApplications, Users, AttendanceSettings, and their relationships with proper cardinality notations.]

---

## CHAPTER 5: SAMPLE SCREENSHOTS

**1. Attendance Dashboard**
*Overview of attendance statistics for different batches and subjects.*
![Attendance Dashboard](https://example.com/screenshots/attendance_dashboard.png)

**2. Mark Attendance Interface**
*Faculty interface to mark daily attendance for students.*
- Batch: CSE 2024 | Subject: Data Structures
- Student List with Present/Absent/Late toggles.
![Mark Attendance](https://example.com/screenshots/attendance_mark.png)

**3. Attendance Reports**
*Filterable reports showing student-wise and subject-wise attendance percentages.*
![Attendance Reports](https://example.com/screenshots/attendance_report.png)

---

## CHAPTER 6: SYSTEM IMPLEMENTATION

### Attendance Marking Form (HTML + PHP)

**HTML Form:**
```html
<form id="attendanceForm" method="POST" action="save_attendance.php" class="attendance-form">
    <div class="form-section">
        <h4>Mark Attendance for Class</h4>
        
        <div class="form-group">
            <label for="classSelect">Select Class/Section</label>
            <select id="classSelect" name="class_id" class="form-control" required 
                    onchange="loadStudents(this.value)">
                <option value="">-- Select Class --</option>
            </select>
        </div>

        <div class="form-group">
            <label for="subjectSelect">Select Subject</label>
            <select id="subjectSelect" name="subject_id" class="form-control" required>
                <option value="">-- Select Subject --</option>
            </select>
        </div>

        <div class="form-group">
            <label for="attendanceDate">Date</label>
            <input type="date" id="attendanceDate" name="attendance_date" 
                   class="form-control" required value="">
        </div>
    </div>

    <div class="form-section">
        <h4>Student Attendance</h4>
        <table id="studentTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Leave</th>
                    <th>Medical</th>
                </tr>
            </thead>
            <tbody id="studentBody">
                <tr><td colspan="6" class="text-center text-muted">Select a class to load students</td></tr>
            </tbody>
        </table>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary btn-lg">Save Attendance</button>
        <button type="reset" class="btn btn-secondary btn-lg">Clear</button>
    </div>
</form>
```

### PHP Backend Implementation

**save_attendance.php:**
```php
<?php
session_start();
require_once 'config/config.php';

// Verify faculty authentication
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'faculty') {
    header('HTTP/1.0 403 Forbidden');
    exit('Unauthorized');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $class_id = intval($_POST['class_id'] ?? 0);
    $subject_id = intval($_POST['subject_id'] ?? 0);
    $attendance_date = $_POST['attendance_date'] ?? '';
    $attendance_data = $_POST['attendance'] ?? []; // Array: student_id => status
    
    // Validate inputs
    if (!$class_id || !$subject_id || !$attendance_date || empty($attendance_data)) {
        $_SESSION['error'] = 'Invalid attendance data';
        header('Location: attendance_mark.php');
        exit();
    }
    
    // Validate date format
    $dateObj = DateTime::createFromFormat('Y-m-d', $attendance_date);
    if (!$dateObj || $dateObj->format('Y-m-d') !== $attendance_date) {
        $_SESSION['error'] = 'Invalid date format';
        header('Location: attendance_mark.php');
        exit();
    }
    
    // Future date check
    if (strtotime($attendance_date) > time()) {
        $_SESSION['error'] = 'Cannot mark attendance for future dates';
        header('Location: attendance_mark.php');
        exit();
    }

    try {
        $pdo->beginTransaction();
        
        $sql = "INSERT INTO attendance 
                (class_id, student_id, subject_id, attendance_date, status, marked_by) 
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                status = VALUES(status), 
                marked_at = NOW()";
        
        $stmt = $pdo->prepare($sql);
        
        $validStatuses = ['Present', 'Absent', 'Leave', 'Medical'];
        $insertCount = 0;
        
        foreach ($attendance_data as $student_id => $status) {
            $student_id = intval($student_id);
            
            // Validate status
            if (!in_array($status, $validStatuses)) {
                continue;
            }
            
            if ($stmt->execute([
                $class_id,
                $student_id,
                $subject_id,
                $attendance_date,
                $status,
                $_SESSION['user_id']
            ])) {
                $insertCount++;
            }
        }
        
        $pdo->commit();
        
        $_SESSION['success'] = "Attendance marked for $insertCount students";
        
        // Check and trigger alerts for low attendance
        checkAndTriggerAlerts($class_id, $subject_id);
        
        header('Location: attendance_success.php');
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = 'Failed to save attendance: ' . $e->getMessage();
        header('Location: attendance_mark.php');
    }
    exit();
}
?>
```

### JavaScript for Student Loading

```javascript
function loadStudents(classId) {
    if (!classId) {
        document.getElementById('studentBody').innerHTML = 
            '<tr><td colspan="6" class="text-center">Select a class to load students</td></tr>';
        return;
    }

    fetch('ajax/get_class_students.php?class_id=' + classId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let html = '';
                data.students.forEach(student => {
                    html += `
                        <tr>
                            <td>${student.roll_no}</td>
                            <td>${student.first_name} ${student.last_name}</td>
                            <td><input type="radio" name="attendance[${student.student_id}]" value="Present"></td>
                            <td><input type="radio" name="attendance[${student.student_id}]" value="Absent"></td>
                            <td><input type="radio" name="attendance[${student.student_id}]" value="Leave"></td>
                            <td><input type="radio" name="attendance[${student.student_id}]" value="Medical"></td>
                        </tr>
                    `;
                });
                document.getElementById('studentBody').innerHTML = html;
            }
        })
        .catch(error => console.error('Error:', error));
}
```

### Attendance Report Query

```php
public function getAttendanceReport($filters = []) {
    $sql = "SELECT 
            s.student_id,
            s.first_name,
            s.last_name,
            s.registration_no,
            COUNT(CASE WHEN a.status = 'Present' THEN 1 END) as present_days,
            COUNT(CASE WHEN a.status IN ('Absent', 'Leave', 'Medical') THEN 1 END) as absent_days,
            COUNT(a.attendance_id) as total_classes,
            ROUND(
                (COUNT(CASE WHEN a.status = 'Present' THEN 1 END) / 
                 COUNT(a.attendance_id) * 100), 2
            ) as attendance_percent
            FROM students s
            LEFT JOIN attendance a ON s.student_id = a.student_id
            WHERE 1=1";
    
    $params = [];
    
    if (!empty($filters['class_id'])) {
        $sql .= " AND a.class_id = ?";
        $params[] = $filters['class_id'];
    }
    
    if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
        $sql .= " AND a.attendance_date BETWEEN ? AND ?";
        $params[] = $filters['from_date'];
        $params[] = $filters['to_date'];
    }
    
    $sql .= " GROUP BY s.student_id ORDER BY attendance_percent ASC";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
```

---

## CHAPTER 7: TESTING

### 7.1 Introduction to System Testing

System testing for the Attendance Tracking System verifies that:

1. Attendance can be marked accurately for all students in a class
2. Leave applications are processed correctly
3. Attendance reports generate accurate percentages
4. Alerts trigger appropriately for low attendance
5. Data integrity is maintained with audit trails
6. System performs well with hundreds of daily attendance records
7. Unauthorized users cannot modify attendance

### 7.2 Types of Testing

#### Unit Testing
- Test attendance status validation (Present/Absent/Leave/Medical)
- Test attendance percentage calculation formula
- Test date validation (no future dates)
- Test leave application approval logic
- Test alert threshold checking

#### Integration Testing
- Attendance marking → Database storage → Report generation
- Leave application → Attendance status update → Percentage recalculation
- Faculty marking → Student viewing on dashboard
- Attendance records → Export to CSV

#### Functional Testing
- Mark attendance for a class of 50+ students
- Modify attendance for previous dates
- Generate attendance report by date range
- View personal attendance on student dashboard
- Apply and approve leave requests
- Download attendance report as PDF/CSV

#### White Box Testing
- Validate DISTINCT student fetching avoids duplicates
- Test transaction rollback on database errors
- Test SQL injection prevention with parameterized queries
- Test permission checking before allowing modifications
- Verify audit logs record all changes

#### Black Box Testing
- User marks attendance → System saves correctly
- User applies for leave → Appears in attendance records
- User generates report → Calculations accurate
- User exports data → CSV format correct
- Invalid date rejected silently

#### Security Testing
- Test non-faculty users cannot mark attendance
- Test administrators can modify attendance with audit trail
- Test student cannot modify own attendance
- Test input validation prevents XSS in remarks field
- Test session timeout enforcement

#### Performance Testing
- Mark attendance for 500+ students without lag
- Generate monthly report with 10,000+ records
- Handle concurrent faculty marking same class
- Test query optimization for attendance percentage calculation

---

## CHAPTER 8: CONCLUSION AND FUTURE SCOPE

### Conclusion

The Attendance Tracking System successfully modernizes attendance management at Kingston Polytechnic College. The system eliminates manual processes, provides real-time monitoring, and enables data-driven interventions for at-risk students.

Key achievements include:
- Automated attendance recording reducing manual errors
- Real-time student/parent access to attendance information
- Comprehensive reporting and analytics capabilities
- Integration with institutional alert systems

### Future Scope

1. **Biometric Integration**: Fingerprint/facial recognition for automated attendance marking
2. **Mobile Application**: Faculty app for offline attendance marking with sync
3. **Geolocation Verification**: Verify faculty location during attendance marking
4. **AI-Based Prediction**: Machine learning to predict student dropout risk based on attendance
5. **SMS Alerts**: Real-time SMS notifications to parents of chronic absentees
6. **RFID Card Integration**: Automated attendance through RFID card swiping
7. **Excuse Submission Portal**: Student portal to upload and request leave online
8. **Attendance Appeals**: Process for students to appeal or challenge marked absence
9. **Cross-Subject Analytics**: Identify patterns of absences for specific subjects
10. **Integration with Academic Performance**: Correlate attendance with academic results

---

## CHAPTER 9: REFERENCE

1. **PHP Official Documentation**: https://www.php.net/manual/en/

2. **MySQL Documentation**: https://dev.mysql.com/doc/

3. **Bootstrap Framework**: https://getbootstrap.com/docs/5.3/

4. **MDN Web Docs – HTML**: https://developer.mozilla.org/en-US/docs/Web/HTML

5. **W3Schools – PHP Tutorial**: https://www.w3schools.com/php/

6. **W3Schools – MySQL Database**: https://www.w3schools.com/mysql/

7. **Chart.js Documentation**: https://www.chartjs.org/docs/latest/

8. **OWASP Security Guidelines**: https://owasp.org/www-project-top-ten/

9. **Database Design Principles**: Silberschatz, A., Korth, H. F., & Sudarshan, S. (2010)

10. **Software Engineering Practices**: Sommerville, I. (2015). Software Engineering (10th ed.)

---

**End of Report**
