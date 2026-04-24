# Fee & Financial Management

## A PROJECT REPORT

**By**

| Student Name | Registration Number |
|---|---|
| ROHIT MAITY | D232419326 |
| SK ASIF | D232419327 |
| PALASH MONDAL | D232419328 |
| HRIDAY BAIRAGI | D232419329 |
| ANKUSH KUMAR | D232419331 |

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

This is to certify that the project entitled **"Fee & Financial Management System"** is a bonafide work carried out by:

- ROHIT MAITY (D232419326)
- SK ASIF (D232419327)
- PALASH MONDAL (D232419328)
- HRIDAY BAIRAGI (D232419329)
- ANKUSH KUMAR (D232419331)

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

We the students of B.Tech. 2nd year, Department of Computer Science & Technology, Kingston Polytechnic College, would like to express our sincere gratitude and deep regards to our guide **Saikat Biswas** (Lecturer, CST) for his excellent guidance, continuous support, and constructive criticism throughout the development of the **Fee & Financial Management System** project.

We would also like to extend our thanks to all faculty members and staff of the Department of Computer Science & Technology, Kingston Polytechnic College, for their valuable suggestions and support. We are grateful to the Principal and the Administrative Staff of Kingston Polytechnic College for providing the necessary infrastructure and resources to complete this project.

Special thanks to all our friends and family members who directly or indirectly supported us during the entire development process.

---

**Submitted by:**

| Student Name | Registration Number |
|---|---|
| ROHIT MAITY | D232419326 |
| SK ASIF | D232419327 |
| PALASH MONDAL | D232419328 |
| HRIDAY BAIRAGI | D232419329 |
| ANKUSH KUMAR | D232419331 |

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

The Fee & Financial Management System is a critical module of the Academic Monitoring System for Students, designed to manage student fees collection, payment processing, receipts, financial records, and accounting. This module streamlines financial operations, ensures transparency, and provides comprehensive financial reporting.

The primary objective is to automate fee collection, payment processing, receipt generation, and financial tracking. The system tracks payment status, manages fee reminders, handles fee waivers and concessions, and generates financial reports for institutional planning and accounting.

The proposed system addresses challenges in manual fee management including manual receipt writing, difficulty in tracking payments, delayed financial reporting, and lack of transparent fee information to students. Key features include fee structure definition, payment processing, receipt generation, payment history tracking, and financial analytics. This report details the technical design, implementation approach, testing methodology, and future enhancements for the Fee & Financial Management System.

---

## CHAPTER 1: INTRODUCTION

### 1.1 Objective

The Fee & Financial Management System is developed with the following objectives:

1. **Automated Payment Processing**: To automate fee payment collection and processing, reducing manual effort and payment errors.

2. **Transparent Fee Information**: To provide students and parents clear fee structures, payment status, and outstanding balance information.

3. **Receipt Management**: To automatically generate digital receipts for all payments with proper documentation.

4. **Payment Tracking**: To maintain complete payment history and enable quick verification of payment status.

5. **Financial Reporting**: To generate accurate financial reports for accounting, budgeting, and institutional planning.

### 1.2 Scope of the Project

The Fee & Financial Management System covers:

**Functional Scope:**
- Fee structure definition for different programs and categories
- Student fee assignment and modification
- Payment processing (online and offline)
- Receipt generation and distribution
- Payment reminders and notifications
- Fee waivers and concessions management
- Financial reports and accounting integration
- Late fee management
- Payment reconciliation

**Geographic Scope:**
- All students and programs at Kingston Polytechnic College
- Accessible to finance staff, parents, and students

**Time Scope:**
- Covers entire academic year and multiple years
- Historical financial data for auditing and analysis

**Technical Scope:**
- Web-based payment processing
- Integration with online payment gateways
- Automated reminders and notifications
- Financial report generation

### 1.3 Modules

The Fee & Financial Management System comprises:

1. **Fee Structure Module**: Define fee components, categories, and payment schedules.

2. **Fee Assignment Module**: Assign fees to students based on program and category.

3. **Payment Processing Module**: Record and process fee payments from students.

4. **Receipt Generation Module**: Automatically generate digital receipts for all payments.

5. **Payment Tracking Module**: Maintain payment history and status for each student.

6. **Fee Reminder Module**: Send automated reminders for pending fee payments.

7. **Concession Management Module**: Manage fee waivers, scholarships, and concessions.

8. **Financial Reporting Module**: Generate financial reports for accounting and analysis.

---

## CHAPTER 2: REQUIREMENT SPECIFICATIONS

### 2.1 Hardware Requirements

| Component | Requirement |
|---|---|
| **Processor** | Intel Core i5 (2.8 GHz) or equivalent |
| **RAM** | Minimum 4 GB (8 GB recommended) |
| **Hard Disk** | 500 GB for fee records and receipts |
| **Monitor** | 15-inch LED display with 1366×768 resolution |
| **Network** | Internet with minimum 2 Mbps for payment gateway |
| **Server Hardware** | Intel Xeon, 8 GB RAM, 1 TB HDD (production) |

### 2.2 Software Requirements

| Component | Specification |
|---|---|
| **Operating System** | Windows 10/11, macOS, Ubuntu Linux |
| **Web Server** | Apache HTTP Server 2.4.29 (XAMPP) |
| **Backend Language** | PHP 7.4.29 or higher |
| **Database** | MySQL 8.0 with MySQLnd 7.4.29 |
| **Frontend Framework** | Bootstrap 5.3 |
| **PDF Generation** | TCPDF, mPDF for receipt generation |
| **Payment Gateway** | Razorpay, PayU, or similar integration |
| **Email Service** | SMTP for payment notifications |
| **Development IDE** | Visual Studio Code, PhpStorm |
| **Web Browser** | Chrome, Firefox, Edge (latest) |

---

## CHAPTER 3: ANALYSIS

### 3.1 Existing System

Challenges in manual fee management:

1. **Manual Receipt Writing**: Paper-based receipts with:
   - Risk of loss or damage
   - Difficult record keeping
   - No digital backup

2. **Payment Tracking Issues**: Manual tracking causes:
   - Delays in payment verification
   - Duplicate payment risks
   - Difficult reconciliation

3. **Poor Transparency**: Students and parents unaware of:
   - Exact fee amounts
   - Payment deadlines
   - Outstanding balance

### 3.2 Proposed System

Automated fee management with:

1. **Digital Payment Processing**: Online and offline payment recording with verification.

2. **Automatic Receipt Generation**: Digital receipts emailed to parents immediately.

3. **Real-Time Payment Status**: Students view payment status anytime.

4. **Automated Reminders**: Email/SMS reminders before payment deadlines.

### 3.3 Feasibility System

#### Economic Feasibility
- **Cost Savings**: Eliminates manual receipt writing and tracking time.
- **Reduced Bad Debts**: Reminders help improve payment collection.
- **Verdict**: **FEASIBLE**

#### Technical Feasibility
- **Payment Gateway**: Integration APIs readily available.
- **Technology**: PHP, MySQL proven for financial systems.
- **Verdict**: **FEASIBLE**

#### Operational Feasibility
- **Training**: Finance staff quick to learn system.
- **Adoption**: Students prefer online payment convenience.
- **Verdict**: **FEASIBLE**

### 3.4 Software Specification

#### HTML5
- Fee structure and payment forms
- Payment history and receipt displays
- Online payment pages
- Financial report templates

#### CSS3
- Responsive payment interface
- Color-coding for payment status
- Print-friendly receipt layouts
- Mobile-optimized payment page

#### JavaScript
- Form validation for payment details
- Real-time balance calculation
- Payment gateway integration
- Receipt download and printing

#### PHP
- Payment processing and verification
- Receipt generation logic
- Fee calculation and tracking
- Financial report generation

#### MySQL
- **FeeStructure**: Fee components, amounts, categories
- **StudentFees**: Assigned fees per student
- **Payments**: Payment records with date, amount, method
- **Receipts**: Generated receipt information
- **FinancialRecords**: Accounting entries

---

## CHAPTER 4: SYSTEM DESIGN

### 4.1 Table Design

The Fee & Financial Management module utilizes the following tables from the core database:

#### Table 1: `fee_transactions`
| Field | Type | Description |
|---|---|---|
| id | int(11) | Primary Key, Auto Increment |
| student_id | int(11) | Reference to student |
| receipt_number | varchar(50) | Unique receipt number |
| fee_type | varchar(50) | tuition, hostel, other |
| academic_year | varchar(20) | Academic year |
| semester | int(11) | Semester number |
| amount_due | decimal(10,2) | Total due amount |
| amount_paid | decimal(10,2) | Amount paid |
| fine_amount | decimal(10,2) | Late fee/Fine |
| payment_method | varchar(50) | cash, online, card |
| payment_status | enum | paid, partial, pending |
| bank_reference | varchar(255) | Reference for online payments |
| transaction_date | date | Date of payment |
| due_date | date | Payment deadline |

#### Table 2: `staff_salaries`
| Field | Type | Description |
|---|---|---|
| id | int(11) | Primary Key, Auto Increment |
| staff_id | int(11) | Reference to staff member |
| amount_paid | decimal(10,2) | Base salary paid |
| bonus | decimal(10,2) | Bonus amount |
| deductions | decimal(10,2) | Salary deductions |
| month_year | varchar(20) | Payment month (e.g., April 2026) |
| payment_date | date | Date of salary disbursement |
| payment_method | varchar(50) | bank_transfer, cheque, cash |
| receipt_no | varchar(50) | Unique transaction ID |

### 4.2 Flowchart

```mermaid
graph TD
    A[Start: Fee Payment] --> B[Student/Admin Selects Student ID]
    B --> C[Fetch Pending Dues]
    C --> D[Select Payment Method]
    D --> E[Enter Payment Amount]
    E --> F[Process Transaction]
    F --> G{Payment Successful?}
    G -- No --> H[Show Failure & Retry]
    H --> D
    G -- Yes --> I[Update fee_transactions Table]
    I --> J[Generate Digital Receipt]
    J --> K[End]
```

### 4.3 Data Flow Diagram

```mermaid
graph LR
    Student((Student)) -- Payment Data --> P1[Transaction Process]
    P1 -- Entry --> T1[(fee_transactions Table)]
    T1 -- Receipt Data --> P2[Receipt Generation]
    P2 -- Digital Receipt --> Student
    P1 -- Salary Data --> T2[(staff_salaries Table)]
    Admin((Admin)) -- Payroll Request --> P3[Payroll Process]
    P3 -- Disbursement --> T2
```

### 4.4 E-R Diagram

```mermaid
erDiagram
    STUDENTS ||--o{ FEE_TRANSACTIONS : "pays"
    STAFF ||--o{ STAFF_SALARIES : "receives"
    ACADEMIC_BATCHES ||--o{ FEE_TRANSACTIONS : "fee_structure_for"
```

---

## CHAPTER 5: SAMPLE SCREENSHOTS

**1. Student Fee Payment Interface**
*Portal for recording student fee payments and generating receipts.*
- Student: Aarav Mehta (CSE24001)
- Fee Type: Tuition
- Amount Paid: 1,25,000.00
- Payment Mode: Online
![Fee Payment Form](https://example.com/screenshots/fee_payment.png)

**2. Fee Transaction Dashboard**
*Overview of all financial transactions within the system.*
| Receipt Number | Student Name | Amount | Status | Date |
|---|---|---|---|---|
| RCPT/2024/001 | Aarav Mehta | 125000.00 | paid | 2024-08-15 |
| RCPT/2025/001 | Aarav Mehta | 80000.00 | paid | 2025-01-10 |
| RCPT/2025/003 | Vivaan Saxena | 40000.00 | partial | 2025-01-12 |
![Fee Dashboard](https://example.com/screenshots/fee_dashboard.png)

**3. Digital Payment Receipt**
*Sample digital receipt generated for a student payment.*
- Receipt No: ERP_RCP_101
- Student: Aarav Mehta
- Amount: 25,600.00 (Including 600.00 fine)
- Date: 2026-04-15
![Digital Receipt](https://example.com/screenshots/fee_receipt.png)

**4. Staff Salary Disbursement**
*Interface for managing staff payroll and salary history.*
- Staff: Rajesh Kumar (FAC001)
- Month/Year: April 2026
- Net Paid: 1,53,800.00 (150000 base + 5000 bonus - 1200 deduction)
- Receipt No: ERP_PAY_APRIL_001
![Staff Salary](https://example.com/screenshots/staff_salary.png)

---

## CHAPTER 6: SYSTEM IMPLEMENTATION

### Payment Processing (PHP)

**process_payment.php:**
```php
<?php
session_start();
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_fee_id = intval($_POST['student_fee_id'] ?? 0);
    $amount_paid = floatval($_POST['amount_paid'] ?? 0);
    $payment_method = trim($_POST['payment_method'] ?? '');
    $reference_no = trim($_POST['reference_no'] ?? '');
    
    // Validate amount
    $feeSql = "SELECT sf.amount_due, sf.student_id FROM student_fees sf WHERE sf.student_fee_id = ?";
    $feeStmt = $pdo->prepare($feeSql);
    $feeStmt->execute([$student_fee_id]);
    $feeData = $feeStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$feeData || $amount_paid <= 0 || $amount_paid > $feeData['amount_due']) {
        $_SESSION['error'] = 'Invalid payment amount';
        header('Location: payment_form.php');
        exit();
    }
    
    try {
        $pdo->beginTransaction();
        
        // Record payment
        $paymentSql = "INSERT INTO payments 
                       (student_fee_id, student_id, amount_paid, payment_method, 
                        payment_date, reference_no, payment_status, processed_by)
                       VALUES (?, ?, ?, ?, NOW(), ?, 'Success', ?)";
        
        $paymentStmt = $pdo->prepare($paymentSql);
        $paymentStmt->execute([
            $student_fee_id,
            $feeData['student_id'],
            $amount_paid,
            $payment_method,
            $reference_no,
            $_SESSION['user_id']
        ]);
        
        $payment_id = $pdo->lastInsertId();
        
        // Update student fee status
        $updateFeeSql = "UPDATE student_fees 
                         SET amount_due = amount_due - ?
                         WHERE student_fee_id = ?";
        
        $updateStmt = $pdo->prepare($updateFeeSql);
        $updateStmt->execute([$amount_paid, $student_fee_id]);
        
        // Generate receipt
        generateReceipt($payment_id, $student_fee_id, $amount_paid, $pdo);
        
        // Create financial record
        $finRecordSql = "INSERT INTO financial_records 
                         (payment_id, transaction_type, amount, narration, entry_date)
                         VALUES (?, 'Credit', ?, 'Fee payment received', NOW())";
        
        $finStmt = $pdo->prepare($finRecordSql);
        $finStmt->execute([$payment_id, $amount_paid]);
        
        $pdo->commit();
        
        $_SESSION['success'] = 'Payment processed successfully. Receipt generated.';
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = 'Payment processing failed: ' . $e->getMessage();
    }
    
    header('Location: payments.php');
    exit();
}

function generateReceipt($payment_id, $student_fee_id, $amount_paid, $pdo) {
    require_once 'libraries/TCPDF/tcpdf.php';
    
    // Get payment and student details
    $sql = "SELECT p.payment_id, p.payment_date, p.amount_paid, 
            s.first_name, s.last_name, s.registration_no, s.email,
            g.contact_name as parent_name, g.email as parent_email
            FROM payments p
            JOIN students s ON p.student_id = s.student_id
            LEFT JOIN emergency_contacts g ON s.student_id = g.student_id
            WHERE p.payment_id = ?
            LIMIT 1";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$payment_id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Create PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_PAGE_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Kingston Polytechnic College', 0, 1, 'C');
    
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Fee Receipt', 0, 1, 'C');
    
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Ln(5);
    
    $receiptNo = date('Y') . str_pad($payment_id, 6, '0', STR_PAD_LEFT);
    $pdf->Cell(50, 5, 'Receipt No: ' . $receiptNo);
    $pdf->Cell(0, 5, 'Date: ' . date('d-m-Y', strtotime($data['payment_date'])), 0, 1);
    
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(50, 5, 'Student Details:');
    $pdf->Ln(5);
    
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(50, 5, 'Name: ' . $data['first_name'] . ' ' . $data['last_name']);
    $pdf->Cell(0, 5, 'Reg. No: ' . $data['registration_no'], 0, 1);
    
    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(50, 5, 'Amount Received:');
    $pdf->Ln(5);
    
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(50, 5, 'Amount: Rs. ' . number_format($data['amount_paid'], 2));
    $pdf->Ln(10);
    
    // Save PDF
    $filename = 'receipts/receipt_' . $receiptNo . '.pdf';
    $pdf->Output($filename, 'F');
    
    // Save receipt record
    $saveSql = "INSERT INTO receipts (payment_id, receipt_number, receipt_date, receipt_path)
                VALUES (?, ?, NOW(), ?)";
    
    $saveStmt = $pdo->prepare($saveSql);
    $saveStmt->execute([$payment_id, $receiptNo, $filename]);
    
    // Send email
    sendReceiptEmail($data['parent_email'], $filename, $data['first_name']);
}
?>
```

### Fee Reminder Script

**send_fee_reminders.php:**
```php
<?php
require_once 'config/config.php';

// Find students with overdue fees
$sql = "SELECT DISTINCT s.student_id, s.first_name, s.last_name, s.email,
        gc.email as parent_email, SUM(sf.amount_due) as total_due
        FROM students s
        JOIN student_fees sf ON s.student_id = sf.student_id
        LEFT JOIN emergency_contacts gc ON s.student_id = gc.student_id
        WHERE sf.status IN ('Pending', 'Overdue')
        AND sf.due_date < NOW()
        GROUP BY s.student_id";

$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $emailData = [
        'student_name' => $row['first_name'] . ' ' . $row['last_name'],
        'total_due' => number_format($row['total_due'], 2),
        'parent_email' => $row['parent_email']
    ];
    
    // Send email reminder
    sendReminderEmail($emailData);
}
?>
```

---

## CHAPTER 7: TESTING

### 7.1 Introduction to System Testing

System testing verifies:

1. Payments recorded correctly
2. Receipts generated accurately
3. Fee status updated properly
4. Financial records maintained
5. Payment reminders sent appropriately
6. Reporting shows correct balances

### 7.2 Types of Testing

#### Unit Testing
- Test payment amount validation
- Test receipt number generation
- Test fee status transitions
- Test financial record calculation

#### Integration Testing
- Payment entry → Receipt generation → Email sending
- Payment recording → Fee status update → Student balance update
- Multiple payments → Total balance calculation

#### Functional Testing
- Student pays partial fee
- Student pays multiple fees simultaneously
- View payment history
- Generate financial report
- Export fee data

#### White Box Testing
- Verify receipt number generation is unique
- Test transaction rollback on email failure
- Verify financial record entries match payments

#### Black Box Testing
- User records payment → Receipt generated and emailed
- User views fee status → Shows accurate balance
- Finance staff generates report → Report totals correct

#### Security Testing
- Student cannot modify payment amount
- Non-finance staff cannot void payments
- Payment amounts limited to fee outstanding
- Email verification of receipts

#### Performance Testing
- Process payments for 1000+ students
- Generate receipts in bulk
- Send reminders to 500+ students
- Generate monthly financial reports

---

## CHAPTER 8: CONCLUSION AND FUTURE SCOPE

### Conclusion

The Fee & Financial Management System successfully automates fee collection and financial management. The system ensures transparent fee information, rapid payment processing, and accurate financial record-keeping.

Key achievements:
- Automated payment processing and receipt generation
- Real-time payment status tracking
- Transparent fee information for students/parents
- Accurate financial reporting

### Future Scope

1. **Online Payment Gateway**: Direct online payment integration (Razorpay, PayU)
2. **QR Code Payments**: QR code-based payment receipts
3. **Schedule-Based Reminders**: Automated reminders before due date
4. **Partial Payment Plans**: Flexible payment installment options
5. **Scholarship Integration**: Automatic scholarship adjustment in fees
6. **Refund Processing**: Automated refund workflows
7. **Multi-Currency Support**: Handle fees in multiple currencies
8. **Expense Tracking**: Track college expenses against income
9. **Mobile Payment**: Payment option from mobile app
10. **Financial Analytics**: Predictive analytics for collection forecasting

---

## CHAPTER 9: REFERENCE

1. **PHP Official Documentation**: https://www.php.net/manual/en/

2. **MySQL Documentation**: https://dev.mysql.com/doc/

3. **TCPDF Library**: https://tcpdf.org/

4. **Payment Gateway APIs**: Razorpay, PayU documentation

5. **Bootstrap Framework**: https://getbootstrap.com/docs/5.3/

6. **Financial Management**: Damodaran, A. (2012). Investment Valuation

7. **Accounting Standards**: https://www.icai.org/

8. **Database Security**: OWASP: https://owasp.org/

9. **W3Schools**: https://www.w3schools.com/

10. **MDN Web Docs**: https://developer.mozilla.org/en-US/

---

**End of Report**
