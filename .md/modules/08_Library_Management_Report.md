# Library Management

## A PROJECT REPORT

**By**

| Student Name | Registration Number |
|---|---|
| MONAJIT MONDAL | D232419342 |
| SUMIT PARI | D232419343 |
| SAYAN BAIRAGI | D232419344 |
| SUROSHREE SENGUPTA | D232419345 |
| PROGGA GUPTA | D232419346 |

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

This is to certify that the project entitled **"Library Management System"** is a bonafide work carried out by:

- MONAJIT MONDAL (D232419342)
- SUMIT PARI (D232419343)
- SAYAN BAIRAGI (D232419344)
- SUROSHREE SENGUPTA (D232419345)
- PROGGA GUPTA (D232419346)

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

We the students of B.Tech. 2nd year, Department of Computer Science & Technology, Kingston Polytechnic College, would like to express our sincere gratitude and deep regards to our guide **Saikat Biswas** (Lecturer, CST) for his excellent guidance, continuous support, and constructive criticism throughout the development of the **Library Management System** project.

We would also like to extend our thanks to all faculty members and staff of the Department of Computer Science & Technology, Kingston Polytechnic College, for their valuable suggestions and support. We are grateful to the Principal and the Administrative Staff of Kingston Polytechnic College for providing the necessary infrastructure and resources to complete this project.

Special thanks to all our friends and family members who directly or indirectly supported us during the entire development process.

---

**Submitted by:**

| Student Name | Registration Number |
|---|---|
| MONAJIT MONDAL | D232419342 |
| SUMIT PARI | D232419343 |
| SAYAN BAIRAGI | D232419344 |
| SUROSHREE SENGUPTA | D232419345 |
| PROGGA GUPTA | D232419346 |

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

The Library Management System is a comprehensive module of the Academic Monitoring System for Students, designed to manage library operations including book inventory, student borrowing, returns, fines, and reservations. This module facilitates efficient library resource management and improves student access to learning materials.

The primary objective is to replace manual card-based library management with a digital system that tracks book inventory, manages student borrowing transactions, enforces borrowing policies, and generates library usage statistics. The system improves library service efficiency and provides students convenient access to book information and borrowing status.

The proposed system addresses challenges in manual library management including inaccurate inventory tracking, slow borrowing/return processing, difficulty in enforcing return deadlines, and lack of borrowing history. Key features include book catalog management, student borrowing/return processing, fine calculation, book reservation, and library usage analytics. This report details the technical design, implementation approach, testing methodology, and future enhancements for the Library Management System.

---

## CHAPTER 1: INTRODUCTION

### 1.1 Objective

The Library Management System is developed with the following objectives:

1. **Digital Inventory Management**: To maintain accurate, up-to-date book inventory with digital records replacing manual card catalogs.

2. **Efficient Borrowing Processing**: To streamline book borrowing and return processes, reducing time spent on manual transactions.

3. **Policy Enforcement**: To automatically enforce borrowing policies such as borrowing limits, return deadlines, and fine calculation.

4. **Availability Information**: To provide students real-time information on book availability and borrowing status.

5. **Usage Analytics**: To generate library usage statistics and popular book reports for collection development.

### 1.2 Scope of the Project

The Library Management System covers:

**Functional Scope:**
- Book catalog and inventory management
- Author and publisher management
- Book copy tracking and barcode management
- Student borrowing transaction processing
- Book return processing and condition checking
- Fine calculation and payment tracking
- Book reservation by students
- Borrowing history maintenance
- Overdue book tracking and reminders
- Library usage reports and analytics

**Geographic Scope:**
- Kingston Polytechnic College central library
- All students and faculty as library members
- Books in multiple languages and formats

**Time Scope:**
- Historical tracking of borrowing history
- Enables analysis of borrowing patterns over time
- Maintains archive of all library transactions

**Technical Scope:**
- Web-based interface for students and staff
- Barcode scanning for quick transactions
- Integration with student information system
- Automated fine calculation
- SMS/Email reminders for overdue books

### 1.3 Modules

The Library Management System comprises:

1. **Book Catalog Module**: Manage book database with ISBN, author, title, edition, copies.

2. **Inventory Management Module**: Track individual book copies, location, and condition.

3. **Member Management Module**: Maintain student library membership and borrow eligibility.

4. **Borrowing Module**: Process book borrowing with policy enforcement (limits, deadlines).

5. **Return Module**: Process book returns with condition checking and fine assessment.

6. **Reservation Module**: Allow students to reserve temporarily unavailable books.

7. **Fine Management Module**: Calculate and track library fines for overdue books.

8. **Library Reports Module**: Generate usage reports and popular book analytics.

---

## CHAPTER 2: REQUIREMENT SPECIFICATIONS

### 2.1 Hardware Requirements

| Component | Requirement |
|---|---|
| **Processor** | Intel Core i5 (2.8 GHz) or equivalent |
| **RAM** | Minimum 4 GB (8 GB recommended) |
| **Hard Disk** | 500 GB for book catalog and transaction history |
| **Monitor** | 15-inch LED display (barcode scanning workstations) |
| **Barcode Scanner** | USB-connected barcode scanner |
| **Printer** | Thermal printer for barcode labels |
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
| **Barcode Library** | TCPDF or similar for barcode generation |
| **Development IDE** | Visual Studio Code, PhpStorm |
| **Web Browser** | Chrome, Firefox, Edge (latest) |

---

## CHAPTER 3: ANALYSIS

### 3.1 Existing System

Challenges in manual library management:

1. **Card-Based Catalog**: Physical card system with:
   - Time-consuming manual searches
   - Difficult to find books quickly
   - High risk of lost or damaged cards
   - No availability information

2. **Manual Borrowing**: Paper-based transactions cause:
   - Slow borrowing/return process
   - Difficulty tracking overdue books
   - Manual fine calculation errors
   - No borrowing history available

### 3.2 Proposed System

Automated library management with:

1. **Digital Book Catalog**: Quick searchable database of all books and copies.

2. **Barcode System**: Fast borrowing/return through barcode scanning.

3. **Automatic Fine Calculation**: System calculates fines without manual intervention.

4. **Overdue Tracking**: Automatic identification and reminders for overdue books.

5. **Usage Analytics**: Reports on book popularity and borrowing trends.

### 3.3 Feasibility System

#### Economic Feasibility
- **Cost Reduction**: Eliminates manual catalog maintenance and staff overtime.
- **Efficiency**: Faster transactions reduce librarian time per borrowing.
- **Equipment Cost**: Barcode scanner and printer offset by labor savings.
- **Verdict**: **FEASIBLE**

#### Technical Feasibility
- **Technology**: PHP, MySQL proven for library systems.
- **Barcode Integration**: Standard barcode libraries readily available.
- **Verdict**: **FEASIBLE**

#### Operational Feasibility
- **Training**: Staff quickly learn barcode scanning.
- **Adoption**: Students prefer quick borrowing processes.
- **Verdict**: **FEASIBLE**

### 3.4 Software Specification

#### HTML5
- Book search and catalog pages
- Borrowing and return forms
- Student borrowing history display
- Fine payment pages

#### CSS3
- Responsive book catalog layout
- Book detail cards with images
- Print-friendly borrowing receipts
- Fine payment forms styling

#### JavaScript
- Real-time book search with filters
- Barcode scanning form handling
- Availability status updates
- Reservation AJAX requests

#### PHP
- Book catalog management
- Borrowing policy enforcement
- Fine calculation logic
- Overdue book tracking
- Usage statistics generation

#### MySQL
- **Books**: Book title, author, ISBN, edition
- **BookCopies**: Individual copy tracking, barcode, location
- **Members**: Student library membership status
- **Borrowing**: Borrow transactions with issue/return dates
- **Fines**: Fine records for overdue books

---

## CHAPTER 4: SYSTEM DESIGN

### 4.1 Table Design

The Library Management module utilizes the following table from the core database:

#### Table 1: `library_books`
| Field | Type | Description |
|---|---|---|
| id | int(11) | Primary Key, Auto Increment |
| title | varchar(255) | Book title |
| isbn | varchar(50) | ISBN number |
| author | varchar(255) | Primary author |
| co_author | varchar(255) | Co-author(s) |
| publisher | varchar(255) | Publisher name |
| publication_year | varchar(10) | Year of publication |
| edition | varchar(50) | Book edition |
| category | varchar(100) | Main category (e.g., Computer Science) |
| sub_category | varchar(100) | Sub-category (e.g., Algorithms) |
| language | varchar(50) | Book language |
| total_pages | int(11) | Total number of pages |
| total_copies | int(11) | Total copies available in library |
| available_copies | int(11) | Current available copies |
| rack_number | varchar(50) | Storage rack location |
| shelf_number | varchar(50) | Storage shelf location |
| status | enum | active, lost, damaged, withdrawn |
| created_at | timestamp | Record creation timestamp |

### 4.2 Flowchart

```mermaid
graph TD
    A[Start: Book Issue] --> B[Student Searches for Book]
    B --> C{Book Available?}
    C -- No --> D[Show Availability Date]
    C -- Yes --> E[Librarian scans Student ID]
    E --> F[Scans Book ISBN/Barcode]
    F --> G[Record Transaction]
    G --> H[Update library_books Table]
    H --> I[End]
```

### 4.3 Data Flow Diagram

```mermaid
graph LR
    Librarian((Librarian)) -- Issue Data --> P1[Transaction Process]
    P1 -- Entry --> T1[(library_books Table)]
    Student((Student)) -- Search Query --> P2[Search Process]
    P2 -- Book Info --> Student
    T1 -- Stock Data --> P2
```

### 4.4 E-R Diagram

```mermaid
erDiagram
    LIBRARY_BOOKS }|--|| ACADEMIC_PROGRAMS : "relevant_for"
    STUDENTS ||--o{ LIBRARY_BOOKS : "borrows"
    LIBRARY_BOOKS ||--o{ COMMUNICATIONS : "overdue_notice"
```

---

## CHAPTER 5: SAMPLE SCREENSHOTS

**1. Library Book Catalog**
*Searchable interface for students and librarians to locate books.*
| Book Title | Author | Category | Available | Rack/Shelf |
|---|---|---|---|---|
| Introduction to Algorithms | Thomas H. Cormen | Computer Science | 3 / 5 | A1 / S1 |
| Digital Design | M. Morris Mano | Electronics | 2 / 4 | B2 / S1 |
| Database System Concepts | Abraham Silberschatz | Computer Science | 4 / 4 | A2 / S1 |
![Book Catalog](https://example.com/screenshots/lib_catalog.png)

**2. Book Details View**
*Detailed information about a specific book title and its current status.*
- Title: Introduction to Algorithms
- ISBN: 978-0262033848
- Author: Thomas H. Cormen, Charles E. Leiserson
- Language: English
- Condition: Good
![Book Details](https://example.com/screenshots/lib_details.png)

**3. Book Borrowing Transaction**
*Interface for librarians to issue books using barcodes.*
- Student: Aarav Mehta (CSE24001)
- Book Scanned: Digital Design (ISBN: 978-0134549897)
- Issue Date: 2026-04-20
- Due Date: 2026-05-04
![Book Borrowing](https://example.com/screenshots/lib_borrow.png)

**4. Student Borrowing History**
*View for students to track their current borrowings and past history.*
- Current Borrowed: "Introduction to Algorithms"
- Due Date: 2026-05-10
- Overdue Fines: None
![Borrowing History](https://example.com/screenshots/lib_history.png)

---

## CHAPTER 6: SYSTEM IMPLEMENTATION

### Book Borrowing Transaction (PHP)

**process_borrowing.php:**
```php
<?php
session_start();
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = intval($_POST['student_id'] ?? 0);
    $barcode = trim($_POST['barcode'] ?? '');
    
    // Get book copy by barcode
    $copySql = "SELECT bc.copy_id, bc.book_id, bc.status, 
                b.title FROM book_copies bc
                JOIN books b ON bc.book_id = b.book_id
                WHERE bc.barcode = ?";
    
    $copyStmt = $pdo->prepare($copySql);
    $copyStmt->execute([$barcode]);
    $copy = $copyStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$copy) {
        $_SESSION['error'] = 'Invalid barcode';
        header('Location: borrowing.php');
        exit();
    }
    
    if ($copy['status'] !== 'Available') {
        $_SESSION['error'] = 'Book is not available for borrowing';
        header('Location: borrowing.php');
        exit();
    }
    
    // Check borrowing limit
    $borrowingSql = "SELECT COUNT(*) as active_borrows FROM borrowing
                     WHERE student_id = ? AND return_date IS NULL";
    
    $borrowingStmt = $pdo->prepare($borrowingSql);
    $borrowingStmt->execute([$student_id]);
    $borrows = $borrowingStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($borrows['active_borrows'] >= 5) { // Max 5 books
        $_SESSION['error'] = 'Borrowing limit reached (Maximum 5 books)';
        header('Location: borrowing.php');
        exit();
    }
    
    // Check for unpaid fines
    $finesSql = "SELECT SUM(fine_amount) as total_fines FROM fines
                 WHERE student_id = ? AND fine_status = 'Due'";
    
    $finesStmt = $pdo->prepare($finesSql);
    $finesStmt->execute([$student_id]);
    $fines = $finesStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($fines['total_fines'] > 0) {
        $_SESSION['error'] = 'Cannot borrow: Unpaid fines of Rs. ' . 
                            number_format($fines['total_fines'], 2);
        header('Location: borrowing.php');
        exit();
    }
    
    try {
        $pdo->beginTransaction();
        
        // Create borrowing record
        $issueSql = "INSERT INTO borrowing 
                     (student_id, copy_id, issue_date, due_date, created_at)
                     VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 14 DAY), NOW())";
        
        $issueStmt = $pdo->prepare($issueSql);
        $issueStmt->execute([$student_id, $copy['copy_id']]);
        
        $borrow_id = $pdo->lastInsertId();
        
        // Update copy status
        $updateSql = "UPDATE book_copies 
                      SET status = 'Borrowed'
                      WHERE copy_id = ?";
        
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$copy['copy_id']]);
        
        $pdo->commit();
        
        $_SESSION['success'] = 'Book borrowed successfully. Due date: ' .
                              date('d-m-Y', strtotime('+14 days'));
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = 'Borrowing failed: ' . $e->getMessage();
    }
    
    header('Location: borrowing.php');
    exit();
}
?>
```

### Book Return Processing

```php
function processReturn($borrow_id, $condition, $pdo) {
    try {
        $pdo->beginTransaction();
        
        // Get borrowing details
        $borrowSql = "SELECT b.student_id, b.copy_id, b.due_date,
                      bc.book_id FROM borrowing b
                      JOIN book_copies bc ON b.copy_id = bc.copy_id
                      WHERE b.borrow_id = ?";
        
        $stmt = $pdo->prepare($borrowSql);
        $stmt->execute([$borrow_id]);
        $borrow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Update borrowing with return date
        $returnSql = "UPDATE borrowing 
                      SET return_date = NOW(),
                          returned_condition = ?,
                          is_overdue = IF(NOW() > due_date, TRUE, FALSE)
                      WHERE borrow_id = ?";
        
        $returnStmt = $pdo->prepare($returnSql);
        $returnStmt->execute([$condition, $borrow_id]);
        
        // Update book copy status
        $copySql = "UPDATE book_copies 
                    SET status = 'Available'
                    WHERE copy_id = ?";
        
        $copyStmt = $pdo->prepare($copySql);
        $copyStmt->execute([$borrow['copy_id']]);
        
        // Calculate and record fine if overdue
        if (time() > strtotime($borrow['due_date'])) {
            $days_overdue = floor((time() - strtotime($borrow['due_date'])) / 86400);
            $fine_amount = $days_overdue * 2; // Rs. 2 per day
            
            $fineSql = "INSERT INTO fines 
                        (borrow_id, student_id, days_overdue, fine_amount)
                        VALUES (?, ?, ?, ?)";
            
            $fineStmt = $pdo->prepare($fineSql);
            $fineStmt->execute([
                $borrow_id,
                $borrow['student_id'],
                $days_overdue,
                $fine_amount
            ]);
        }
        
        $pdo->commit();
        return true;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}
```

---

## CHAPTER 7: TESTING

### 7.1 Introduction to System Testing

System testing verifies:

1. Books added to catalog correctly
2. Individual copies tracked with barcodes
3. Borrowing limits enforced
4. Overdue books identified correctly
5. Fines calculated accurately
6. Fine payments update status
7. Book availability updated properly

### 7.2 Types of Testing

#### Unit Testing
- Test borrowing limit enforcement
- Test fine calculation formula
- Test barcode uniqueness
- Test due date calculation

#### Integration Testing
- Book addition → Copy creation → Catalog appearance
- Borrowing → Copy status update → Availability change
- Return → Fine calculation → Student notification

#### Functional Testing
- Student borrows book with barcode
- System prevents borrowing over limit
- Student returns book
- Fine calculated for overdue book
- Student pays fine online

#### White Box Testing
- Verify borrowing policy enforces all business rules
- Test fine calculation for multiple overdue scenarios
- Test transaction rollback on copy update failure

#### Black Box Testing
- User scans barcode → Book borrowed successfully
- User returns book → Fine created if overdue
- Student views borrowing history → Shows correct details

#### Security Testing
- Student cannot override borrowing limits
- Non-librarians cannot modify fines
- Barcode checking prevents invalid entries
- Date calculations audited

#### Performance Testing
- Search through 10000+ book catalog
- Scan and borrow 500+ book copies
- Calculate fines for 5000+ overdue books
- Generate library usage reports

---

## CHAPTER 8: CONCLUSION AND FUTURE SCOPE

### Conclusion

The Library Management System successfully digitizes library operations and provides convenient book borrowing for students. The system tracks inventory accurately, enforces borrowing policies, and automates fine management.

Key achievements:
- Digital book catalog with barcode tracking
- Streamlined borrowing/return process
- Automatic fine calculation for overdue books
- Real-time book availability information

### Future Scope

1. **RFID Integration**: RFID-based checkout for faster transactions
2. **Mobile App**: Student app to search catalog and renew books
3. **E-Books**: Digital book catalog and access management
4. **Book Recommentations**: AI-based book suggestions based on borrowing history
5. **Interlibrary Loans**: Exchange books with other institutions
6. **Book Reservations Notifications**: SMS/Email when reserved book becomes available
7. **Library Analytics**: Dashboard with circulation statistics
8. **Automatic Renewal**: Students can renew books online before due date
9. **Library Events**: Manage library events and author programs
10. **Virtual Shelf**: Visual browsing of library collection

---

## CHAPTER 9: REFERENCE

1. **PHP Official Documentation**: https://www.php.net/manual/en/

2. **MySQL Documentation**: https://dev.mysql.com/doc/

3. **Barcode Standards**: ISO/IEC standards for barcodes

4. **Bootstrap Framework**: https://getbootstrap.com/docs/5.3/

5. **Library Science**: Ranganathan, S.R. (1931). Five Laws of Library Science

6. **Library Automation**: Automation in Libraries by Everett Walton

7. **RFID Technology**: https://www.rfidjournal.com/

8. **W3Schools**: https://www.w3schools.com/

9. **MDN Web Docs**: https://developer.mozilla.org/en-US/

10. **Software Engineering**: Sommerville, I. (2015)

---

**End of Report**
