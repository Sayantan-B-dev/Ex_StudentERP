# Examination Management

## A PROJECT REPORT

**By**

| Student Name | Registration Number |
|---|---|
| PANKAJ KUMAR | D232419319 |
| SK MD SADIQUE | D232419320 |
| BISHESWAR BHATTACHARJEE | D232419321 |
| PALLAB SARKAR | D232419324 |
| RAMA MAITY | D232419325 |

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

This is to certify that the project entitled **"Examination Management System"** is a bonafide work carried out by:

- PANKAJ KUMAR (D232419319)
- SK MD SADIQUED (D232419320)
- BISHESWAR BHATTACHARJEE (D232419321)
- PALLAB SARKAR (D232419324)
- RAMA MAITY (D232419325)

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

We the students of B.Tech. 2nd year, Department of Computer Science & Technology, Kingston Polytechnic College, would like to express our sincere gratitude and deep regards to our guide **Saikat Biswas** (Lecturer, CST) for his excellent guidance, continuous support, and constructive criticism throughout the development of the **Examination Management System** project.

We would also like to extend our thanks to all faculty members and staff of the Department of Computer Science & Technology, Kingston Polytechnic College, for their valuable suggestions and support. We are grateful to the Principal and the Administrative Staff of Kingston Polytechnic College for providing the necessary infrastructure and resources to complete this project.

Special thanks to all our friends and family members who directly or indirectly supported us during the entire development process.

---

**Submitted by:**

| Student Name | Registration Number |
|---|---|
| PANKAJ KUMAR | D232419319 |
| SK MD SADIQUED | D232419320 |
| BISHESWAR BHATTACHARJEE | D232419321 |
| PALLAB SARKAR | D232419324 |
| RAMA MAITY | D232419325 |

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

The Examination Management System is a comprehensive module of the Academic Monitoring System for Students, designed to manage all aspects of the examination process including exam scheduling, question paper generation, seat allocation, result processing, and availability. This module streamlines examination administration and provides transparency to students and stakeholders.

The primary objective is to automate examination processes, eliminate scheduling conflicts, ensure fair seat allocation, and provide quick results processing. The system facilitates secure question paper storage, randomized seat allocation to prevent cheating, and transparent result publication with revaluation request management.

The proposed system addresses challenges in manual examination management including scheduling errors, unfair seat allocation, slow result processing, and lack of result transparency. Key features include exam scheduling, seat allocation, question paper management, result entry and publication, and revaluation request handling. This report details the technical design, implementation approach, testing methodology, and future enhancements for the Examination Management System.

---

## CHAPTER 1: INTRODUCTION

### 1.1 Objective

The Examination Management System is developed with the following objectives:

1. **Automated Exam Scheduling**: To efficiently schedule examinations across multiple courses with conflict resolution.

2. **Fair Seat Allocation**: To allocate exam seats to students randomly and fairly, preventing cheating.

3. **Question Paper Security**: To securely store question papers with controlled access during examinations.

4. **Rapid Result Processing**: To quickly process exam marks and publish results to students.

5. **Revaluation Management**: To manage student revaluation requests with transparency and fairness.

### 1.2 Scope of the Project

The Examination Management System is part of the Academic Monitoring System. Scope includes:

**Functional Scope:**
- Exam scheduling across semesters
- Hall ticket generation
- Seat/invigilator allocation
- Question paper management
- Result entry and processing
- Result publication and transcript update
- Revaluation request management
- Exam analytics and statistics

**Geographic Scope:**
- All departments and programs at Kingston Polytechnic College
- Accessible to administrators, faculty, students

**Time Scope:**
- Covers multiple examination schedules and semesters
- Maintains historical exam records

**Technical Scope:**
- Web-based application
- PDF generation for hall tickets
- Integration with marks and performance modules

### 1.3 Modules

The Examination Management System comprises:

1. **Exam Schedule Module**: Create and manage exam schedule avoiding conflicts.

2. **Hall Ticket Module**: Generate and distribute hall tickets to students.

3. **Seat Allocation Module**: Randomly allocate exam seats and generate invigilator rosters.

4. **Question Paper Management Module**: Securely store and control access to question papers.

5. **Result Entry Module**: Faculty enters exam marks with validation.

6. **Result Publication Module**: Publishes results and updates student transcripts.

7. **Revaluation Module**: Processes revaluation/retotalling requests.

8. **Exam Analytics Module**: Generates exam statistics and performance analysis.

---

## CHAPTER 2: REQUIREMENT SPECIFICATIONS

### 2.1 Hardware Requirements

| Component | Requirement |
|---|---|
| **Processor** | Intel Core i5 (2.8 GHz) or equivalent |
| **RAM** | Minimum 4 GB (8 GB recommended) |
| **Hard Disk** | 500 GB for exam archives and question papers |
| **Monitor** | 15-inch LED display with 1366×768 resolution |
| **Network** | Internet with minimum 2 Mbps |
| **Server Hardware** | Intel Xeon, 8 GB RAM, 1 TB HDD |

### 2.2 Software Requirements

| Component | Specification |
|---|---|
| **Operating System** | Windows 10/11, macOS, Ubuntu Linux |
| **Web Server** | Apache HTTP Server 2.4.29 (XAMPP) |
| **Backend Language** | PHP 7.4.29 or higher |
| **Database** | MySQL 8.0 with MySQLnd 7.4.29 |
| **Frontend Framework** | Bootstrap 5.3 |
| **PDF Generation** | TCPDF, mPDF |
| **File Storage** | Secure encrypted file system |
| **Development IDE** | Visual Studio Code, PhpStorm |
| **Web Browser** | Chrome, Firefox, Edge |

---

## CHAPTER 3: ANALYSIS

### 3.1 Existing System

Challenges in manual examination management:

1. **Scheduling Conflicts**: Manual scheduling with:
   - Subject/venue/faculty conflicts
   - Student timetable clashes
   - Resource over-allocation

2. **Manual Seat Allocation**: Paper-based processes with:
   - Unfair allocations
   - Seating errors
   - Risk of cheating through known allocations

3. **Slow Result Processing**: Manual mark entry and compilation causes:
   - Delayed result publication
   - Transcription errors
   - Student anxiety

### 3.2 Proposed System

Automated examination management with:

1. **Conflict-Free Scheduling**: System generates schedules with automatic conflict detection.

2. **Fair Seat Allocation**: Random, transparent seat allocation algorithm.

3. **Quick Result Processing**: Automated mark entry, calculation, and publication.

4. **Digital Hall Tickets**: PDF hall tickets with student and exam details.

### 3.3 Feasibility System

#### Economic Feasibility
- **Cost Reduction**: Eliminates manual scheduling time and printing costs.
- **ROI**: Recovered through staff efficiency and faster result publication.
- **Verdict**: **FEASIBLE**

#### Technical Feasibility
- **Technology**: PHP, MySQL suitable for exam management.
- **PDF Generation**: TCPDF library readily available.
- **Verdict**: **FEASIBLE**

#### Operational Feasibility
- **Training**: Administrators quickly learn scheduling interface.
- **Adoption**: Improves result distribution and student satisfaction.
- **Verdict**: **FEASIBLE**

### 3.4 Software Specification

#### HTML5
- Exam scheduling form with date/time pickers
- Seat allocation confirmation pages
- Result entry forms with marks input
- Revaluation request forms

#### CSS3
- Responsive exam timetable displays
- Color-coded examination periods
- Print-friendly hall tickets
- Mobile-optimized result viewing

#### JavaScript
- Real-time schedule conflict checking
- Dynamic seat allocation preview
- Form validation for marks entry
- Export functionality to PDF/Excel

#### PHP
- Exam scheduling with conflict resolution
- Randomized seat allocation algorithm
- Result calculation and processing
- Revaluation workflow management

#### MySQL
- **Exams**: Exam schedule, course, date, time, venue
- **SeatAllocation**: Student exam seat numbers
- **Results**: Student marks, grades, status
- **Revaluation**: Request tracking and processing

---

## CHAPTER 4: SYSTEM DESIGN

### 4.1 Table Design

The Examination Management module primarily interacts with the following table from the core database:

#### Table 1: `examinations`
| Field | Type | Description |
|---|---|---|
| id | int(11) | Primary Key, Auto Increment |
| name | varchar(255) | Name of the exam (e.g., Mid Term - Data Structures) |
| exam_type | varchar(50) | Type of exam (Mid Term, Final, etc.) |
| program_id | int(11) | Reference to academic program |
| batch_id | int(11) | Reference to academic batch |
| semester | int(11) | Semester number |
| academic_year | varchar(20) | Academic year (e.g., 2024-25) |
| exam_date | date | Date of the exam |
| start_time | time | Start time of the exam |
| end_time | time | End time of the exam |
| duration_minutes | int(11) | Duration in minutes |
| total_marks | int(11) | Maximum marks |
| passing_marks | int(11) | Minimum marks to pass |
| exam_venue | varchar(255) | Venue/Room number |
| status | enum | scheduled, completed, cancelled, upcoming |

### 4.2 Flowchart

```mermaid
graph TD
    A[Start: Exam Planning] --> B[Define Exam Type & Name]
    B --> C[Select Academic Batch]
    C --> D[Set Max & Passing Marks]
    D --> E[Assign Exam Date & Time]
    E --> F[Select Venue/Room]
    F --> G[Publish Exam Schedule]
    G --> H[End]
```

### 4.3 Data Flow Diagram

```mermaid
graph LR
    Admin((Admin)) -- Exam Config --> P1[Schedule Creation]
    P1 -- Details --> T1[(examinations Table)]
    T1 -- Schedule --> P2[Reporting Process]
    P2 -- Exam Notice --> Student((Student))
    P2 -- Invigilation Sheet --> Faculty((Faculty))
```

### 4.4 E-R Diagram

```mermaid
erDiagram
    EXAMINATIONS }|--|| ACADEMIC_BATCHES : "scheduled_for"
    EXAMINATIONS }|--|| SUBJECTS : "covers"
    EXAMINATIONS ||--o{ STUDENT_GRADES : "results_in"
```

---

## CHAPTER 5: SAMPLE SCREENSHOTS

**1. Exam Schedule Creation**
*Interface for administrators to define new examination dates and venues.*
- Fields: Exam Name, Type, Program, Batch, Date, Time, Venue.
- *Sample Input:* Name: "Mid Term - Data Structures", Date: 2025-03-10, Venue: LC-101.
![Exam Schedule Creation](https://example.com/screenshots/exam_schedule.png)

**2. Examination Dashboard / List View**
*Displays all scheduled and upcoming examinations.*
| Exam Name | Date | Time | Venue | Status |
|---|---|---|---|---|
| Mid Term - Data Structures | 2025-03-10 | 10:00 AM | LC-101 | scheduled |
| Mid Term - DBMS | 2025-03-12 | 10:00 AM | LC-102 | scheduled |
| Mid Term - Computer Networks | 2025-03-14 | 10:00 AM | LC-103 | scheduled |
![Examination Dashboard](https://example.com/screenshots/exam_dashboard.png)

**3. Exam Hall Ticket**
*Generated PDF view for students containing their exam schedule.*
- Student Name: Aarav K Mehta
- Roll Number: CSE24001
- Subject: Data Structures (CSE201)
- Venue: LC-101
![Exam Hall Ticket](https://example.com/screenshots/exam_hall_ticket.png)

---

## CHAPTER 6: SYSTEM IMPLEMENTATION

### Exam Scheduling (PHP)

**create_exam.php:**
```php
<?php
session_start();
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exam_code = trim($_POST['exam_code'] ?? '');
    $course_id = intval($_POST['course_id'] ?? 0);
    $exam_date = $_POST['exam_date'] ?? '';
    $exam_time_start = $_POST['exam_time_start'] ?? '';
    $exam_time_end = $_POST['exam_time_end'] ?? '';
    $venue_id = intval($_POST['venue_id'] ?? 0);
    $total_marks = intval($_POST['total_marks'] ?? 0);
    
    if (!checkConflicts($course_id, $exam_date, $exam_time_start, $exam_time_end, $pdo)) {
        $_SESSION['error'] = 'Exam schedule conflicts with existing exams';
        header('Location: exam_create.php');
        exit();
    }
    
    try {
        $sql = "INSERT INTO exams 
                (exam_code, course_id, exam_date, exam_time_start, exam_time_end, 
                 venue_id, total_marks) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([
            $exam_code, $course_id, $exam_date, $exam_time_start, 
            $exam_time_end, $venue_id, $total_marks
        ])) {
            $exam_id = $pdo->lastInsertId();
            
            // Generate seat allocations
            allocateSeats($exam_id, $course_id, $pdo);
            
            $_SESSION['success'] = 'Exam created and seats allocated';
            header('Location: exams.php');
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    }
    
    header('Location: exam_create.php');
    exit();
}

function checkConflicts($course_id, $exam_date, $start_time, $end_time, $pdo) {
    // Check for faculty conflicts
    $sql = "SELECT COUNT(*) as count FROM exams 
            WHERE exam_date = ? 
            AND ((exam_time_start < ? AND exam_time_end > ?)
                 OR (exam_time_start < ? AND exam_time_end > ?))
            AND course_id != ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$exam_date, $end_time, $start_time, $end_time, $start_time, $course_id]);
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] == 0;
}

function allocateSeats($exam_id, $course_id, $pdo) {
    // Get enrolled students
    $studentSql = "SELECT DISTINCT s.student_id FROM students s
                   JOIN enrollments e ON s.student_id = e.student_id
                   JOIN courses c ON e.subject_id = c.course_id
                   WHERE c.course_id = ?";
    
    $stmt = $pdo->prepare($studentSql);
    $stmt->execute([$course_id]);
    $students = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Shuffle for random allocation
    shuffle($students);
    
    // Allocate seats
    $seatNumber = 1;
    $allocateSql = "INSERT INTO seat_allocation 
                    (exam_id, student_id, seat_number, venue_id)
                    VALUES (?, ?, ?, ?)";
    
    $allocateStmt = $pdo->prepare($allocateSql);
    
    foreach ($students as $student_id) {
        $allocateStmt->execute([$exam_id, $student_id, $seatNumber++, 1]); // venue_id hardcoded for example
    }
}
?>
```

### Seat Allocation Algorithm

```php
function generateSeatAllocation($exam_id, $capacity_per_venue) {
    // Get students enrolled in this exam
    $studentSql = "SELECT DISTINCT sa.student_id 
                   FROM seat_allocation sa 
                   WHERE sa.exam_id = ?";
    
    $stmt = $pdo->prepare($studentSql);
    $stmt->execute([$exam_id]);
    $students = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Shuffle students for randomness
    shuffle($students);
    
    // Allocate to seats sequentially
    $allocation = [];
    $seat_count = 0;
    $venue = 1;
    
    foreach ($students as $student_id) {
        $seat = ($seat_count % $capacity_per_venue) + 1;
        
        if ($seat == 1 && $seat_count > 0) {
            $venue++;
        }
        
        $allocation[] = [
            'student_id' => $student_id,
            'seat_number' => "ROOM{$venue}-SEAT{$seat}",
            'venue_id' => $venue
        ];
        
        $seat_count++;
    }
    
    return $allocation;
}
```

### Result Processing

```php
public function publishResults($exam_id, $pdo) {
    // Get all results for exam
    $sql = "SELECT er.result_id, er.student_id, er.marks_obtained 
            FROM exam_results er 
            WHERE er.exam_id = ? AND er.published = FALSE";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$exam_id]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $updateSql = "UPDATE exam_results SET published = TRUE WHERE result_id = ?";
    $updateStmt = $pdo->prepare($updateSql);
    
    foreach ($results as $result) {
        // Send notification to student
        sendResultNotification($result['student_id'], $exam_id);
        
        // Mark as published
        $updateStmt->execute([$result['result_id']]);
    }
}
```

---

## CHAPTER 7: TESTING

### 7.1 Introduction to System Testing

System testing verifies:

1. No scheduling conflicts exist
2. Seats allocated fairly and randomly
3. Hall tickets generate correctly
4. Result entry prevents invalid marks
5. Results published to correct students
6. Revaluation requests processed properly

### 7.2 Types of Testing

#### Unit Testing
- Test scheduling conflict detection
- Test randomized seat allocation
- Test marks validation (0-100 range)
- Test revaluation status transitions

#### Integration Testing
- Exam creation → Seat allocation → Hall ticket generation
- Mark entry → Result calculation → Transcript update
- Revaluation request → Mark update → Transcript recalculation

#### Functional Testing
- Create exam for 200 students without conflicts
- Allocate seats and verify randomization
- Enter marks for all students
- Publish results and verify visibility to students
- Process revaluation requests

#### White Box Testing
- Verify shuffle algorithm for true randomization
- Test SQL conflict detection covers all scenarios
- Test transaction rollback on allocation failure

#### Black Box Testing
- User creates exam → System prevents conflicts
- User allocates seats → All students assigned
- User enters marks → Validation enforces limits
- Student views result → Information correct

#### Security Testing
- Non-admin cannot create exams
- Student cannot view other student results
- Faculty cannot modify published results without audit trail
- Question papers accessible only during exam time

#### Performance Testing
- Generate schedule for 1000+ students
- Allocate seats for 500+ students without lag
- Publish results for 1000+ students
- Generate hall tickets for 500+ students

---

## CHAPTER 8: CONCLUSION AND FUTURE SCOPE

### Conclusion

The Examination Management System successfully automates examination processes and ensures fair, transparent exam administration. The system eliminates scheduling conflicts, provides fair seat allocation, and enables rapid result processing.

Key achievements:
- Conflict-free exam scheduling
- Fair, random seat allocation
- Rapid result processing and publication
- Secure question paper management

### Future Scope

1. **Online Examinations**: Support for computer-based tests and online exam administration
2. **Question Bank Management**: Automated question paper generation from question bank
3. **Biometric Attendance**: Attendance verification during exams
4. **Eye-Movement Detection**: Anti-cheating measures using computer vision
5. **Exam Analytics**: Detailed analysis of question difficulty and student performance
6. **Mobile Hall Tickets**: QR code-based digital hall tickets
7. **Real-Time Supervision**: Live video proctoring for online exams
8. **Adaptive Testing**: Difficulty-adjusted exams based on student responses
9. **Exam Rehearsals**: Practice exam environment for students
10. **Export Compliance**: Import/export to external examination systems

---

## CHAPTER 9: REFERENCE

1. **PHP Official Documentation**: https://www.php.net/manual/en/

2. **MySQL Documentation**: https://dev.mysql.com/doc/

3. **TCPDF Library**: https://tcpdf.org/

4. **Bootstrap Framework**: https://getbootstrap.com/docs/5.3/

5. **Educational Assessment**: Brookhart, S. M. (2013). How to Assess Higher-Order Thinking

6. **Examination Best Practices**: Frey, B. B. (2018). The SAGE Encyclopedia of Educational Research

7. **Database Security**: OWASP: https://owasp.org/

8. **W3Schools**: https://www.w3schools.com/

9. **MDN Web Docs**: https://developer.mozilla.org/en-US/

10. **Software Engineering**: Sommerville, I. (2015)

---

**End of Report**
