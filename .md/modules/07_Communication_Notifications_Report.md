# Communication & Notifications

## A PROJECT REPORT

**By**

| Student Name | Registration Number |
|---|---|
| RATNADEEP GHOSH | D232419332 |
| JIT ROY | D232419334 |
| MD ASHFIAR AHMAD | D232419335 |
| RUHIT CHANDA | D232419337 |
| MONODIP SARMA | D232419341 |

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

This is to certify that the project entitled **"Communication & Notifications System"** is a bonafide work carried out by:

- RATNADEEP GHOSH (D232419332)
- JIT ROY (D232419334)
- MD ASHFIAR AHMAD (D232419335)
- RUHIT CHANDA (D232419337)
- MONODIP SARMA (D232419341)

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

We the students of B.Tech. 2nd year, Department of Computer Science & Technology, Kingston Polytechnic College, would like to express our sincere gratitude and deep regards to our guide **Saikat Biswas** (Lecturer, CST) for his excellent guidance, continuous support, and constructive criticism throughout the development of the **Communication & Notifications System** project.

We would also like to extend our thanks to all faculty members and staff of the Department of Computer Science & Technology, Kingston Polytechnic College, for their valuable suggestions and support. We are grateful to the Principal and the Administrative Staff of Kingston Polytechnic College for providing the necessary infrastructure and resources to complete this project.

Special thanks to all our friends and family members who directly or indirectly supported us during the entire development process.

---

**Submitted by:**

| Student Name | Registration Number |
|---|---|
| RATNADEEP GHOSH | D232419332 |
| JIT ROY | D232419334 |
| MD ASHFIAR AHMAD | D232419335 |
| RUHIT CHANDA | D232419337 |
| MONODIP SARMA | D232419341 |

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

The Communication & Notifications System is an essential module of the Academic Monitoring System for Students, designed to facilitate systematic communication between institutional administrators, faculty, parents, and students. This module provides multiple channels for announcements, alerts, and important institutional information dissemination.

The primary objective is to ensure timely and reliable delivery of important information to relevant stakeholders. The system supports notifications via email, SMS, in-app alerts, and push notifications, enabling administrators to reach students and parents effectively with academic announcements, policy updates, and important alerts.

The proposed system addresses challenges in manual communication including delayed information dissemination, inconsistent message delivery, difficulty in targeting specific recipient groups, and lack of delivery confirmation. Key features include announcement posting, targeted notifications, multi-channel delivery, read status tracking, and message templates. This report details the technical design, implementation approach, testing methodology, and future enhancements for the Communication & Notifications System.

---

## CHAPTER 1: INTRODUCTION

### 1.1 Objective

The Communication & Notifications System is developed with the following objectives:

1. **Timely Information Dissemination**: To ensure quick delivery of important institutional information to students, faculty, and parents.

2. **Targeted Communication**: To send relevant information to specific groups (programs, batches, departments) minimizing irrelevant notifications.

3. **Multi-Channel Delivery**: To support email, SMS, and in-app notifications ensuring message reach through preferred channels.

4. **Message Persistence**: To maintain communication history and enable archival of important announcements.

5. **Delivery Confirmation**: To track message delivery and read status for accountability and follow-up.

### 1.2 Scope of the Project

The Communication & Notifications System covers:

**Functional Scope:**
- Announcement posting by administrators
- Notification scheduling and delivery
- Multi-channel delivery (Email, SMS, In-app)
- Recipient targeting and segmentation
- Message templates for common communications
- Delivery tracking and status monitoring
- Read status tracking
- Notification history and archival
- User preferences for notification settings

**Geographic Scope:**
- Institutional-wide communications
- Department-specific announcements
- Program and batch-specific messages
- Individual student/parent notifications

**Time Scope:**
- Real-time notification delivery
- Scheduled notifications for future delivery
- Historical message retention
- Recurring notifications (semester-wise)

**Technical Scope:**
- Web-based interface for message creation
- Automated notification queue processing
- Integration with email and SMS gateways
- Push notification support

### 1.3 Modules

The Communication & Notifications System comprises:

1. **Announcement Module**: Create and post announcements for institutional communication.

2. **Notification Scheduling Module**: Schedule notifications for future delivery with recurrence options.

3. **Email Gateway Module**: Send notifications via SMTP email service.

4. **SMS Gateway Module**: Send notifications via SMS provider (Twilio, Elision, etc.).

5. **In-App Notification Module**: Display notifications within the ERP system.

6. **Recipient Management Module**: Define and manage recipient groups and segmentation.

7. **Delivery Tracking Module**: Monitor notification delivery status and read receipts.

8. **Message Template Module**: Manage reusable message templates for common communications.

---

## CHAPTER 2: REQUIREMENT SPECIFICATIONS

### 2.1 Hardware Requirements

| Component | Requirement |
|---|---|
| **Processor** | Intel Core i5 (2.8 GHz) or equivalent |
| **RAM** | Minimum 4 GB (8 GB for high volume notifications) |
| **Hard Disk** | 500 GB for notification archives |
| **Monitor** | 15-inch LED display |
| **Network** | Internet with minimum 2 Mbps for gateway APIs |
| **Server Hardware** | Intel Xeon, 8 GB RAM, 1 TB HDD |

### 2.2 Software Requirements

| Component | Specification |
|---|---|
| **Operating System** | Windows 10/11, macOS, Ubuntu Linux |
| **Web Server** | Apache HTTP Server 2.4.29 (XAMPP) |
| **Backend Language** | PHP 7.4.29 or higher |
| **Database** | MySQL 8.0 with MySQLnd 7.4.29 |
| **Frontend Framework** | Bootstrap 5.3 |
| **Email Service** | SMTP (PHPMailer, Swift Mailer) |
| **SMS Gateway** | Twilio, Elision, or similar API |
| **Push Notifications** | Firebase Cloud Messaging (FCM) |
| **Job Queue** | Background processing for notifications |
| **Development IDE** | Visual Studio Code, PhpStorm |
| **Web Browser** | Chrome, Firefox, Edge (latest) |

---

## CHAPTER 3: ANALYSIS

### 3.1 Existing System

Challenges in manual communication:

1. **Information Silos**: Important information stuck with:
   - Faculty personal emails
   - Department notice boards
   - Word-of-mouth communication
   - No centralized repository

2. **Delayed Dissemination**: Manual communication causes:
   - Delays in reaching all stakeholders
   - Missing some intended recipients
   - No confirmation of message receipt

3. **No Record Keeping**: Important announcements:
   - Not archived for reference
   - Lost after removal from notice board
   - No historical tracking

### 3.2 Proposed System

Automated communication with:

1. **Centralized Platform**: All announcements in single system accessible anytime.

2. **Multi-Channel Delivery**: Reach students and parents via email, SMS, and app.

3. **Targeted Messaging**: Send relevant messages to specific groups based on program, batch, status.

4. **Delivery Tracking**: Confirm message delivery and track read status.

### 3.3 Feasibility System

#### Economic Feasibility
- **Cost Reduction**: Reduced printing and manual distribution costs.
- **Efficiency**: Administrators spend less time on communication.
- **Gateway Costs**: SMS gateway costs offset by delayed printing costs.
- **Verdict**: **FEASIBLE**

#### Technical Feasibility
- **Technology**: SMTP and SMS APIs readily integrated with PHP.
- **Background Processing**: Available through cron jobs or queue systems.
- **Verdict**: **FEASIBLE**

#### Operational Feasibility
- **Training**: Administrators easily learn system.
- **Adoption**: Students prefer digital notifications.
- **Verdict**: **FEASIBLE**

### 3.4 Software Specification

#### HTML5
- Announcement creation forms
- Notification scheduling interface
- Message template designer
- Recipient selection interface

#### CSS3
- Responsive notification pages
- Color-coding for message priority
- Print-friendly announcement layouts
- Mobile-optimized notification display

#### JavaScript
- Rich text editor for announcements
- Date/time picker for scheduling
- Recipient preview (how many will receive)
- Real-time delivery status updates
- Push notification handling

#### PHP
- Notification creation and scheduling logic
- Delivery queue processing
- Email and SMS send logic
- Delivery tracking and status updates
- Template processing and variable substitution

#### MySQL
- **Announcements**: Message content, priority, date created
- **Notifications**: Scheduled notifications with delivery info
- **DeliveryLog**: Delivery status, attempts, timestamps
- **ReadStatus**: Tracking whether recipients read message
- **Templates**: Reusable message templates

---

## CHAPTER 4: SYSTEM DESIGN

### 4.1 Table Design

The Communication & Notifications module utilizes the following table from the core database:

#### Table 1: `communications`
| Field | Type | Description |
|---|---|---|
| id | int(11) | Primary Key, Auto Increment |
| sender_id | int(11) | Reference to the user who sent the message |
| sender_type | varchar(50) | Role of the sender (admin, faculty) |
| title | varchar(255) | Subject or title of the communication |
| message | text | Content of the message |
| message_type | enum | notice, alert, email, sms |
| priority | enum | high, normal, low |
| target_type | varchar(50) | Targeted group (all, student, batch) |
| target_id | int(11) | ID of the target group if applicable |
| is_published | tinyint(1) | Whether the message is visible to users |
| published_at | timestamp | Date and time of publication |
| created_at | timestamp | Record creation timestamp |

### 4.2 Flowchart

```mermaid
graph TD
    A[Start: Send Communication] --> B[Sender Selects Target Type]
    B --> C{Target Type?}
    C -- Batch --> D[Select Academic Batch]
    C -- Individual --> E[Enter Student/Staff ID]
    C -- Department --> F[Select Department]
    D --> G[Compose Message/Notice]
    E --> G
    F --> G
    G --> H[Select Medium: Email/SMS/Portal]
    H --> I[Submit & Send]
    I --> J[Log in communications Table]
    J --> K[End]
```

### 4.3 Data Flow Diagram

```mermaid
graph LR
    Sender((Sender/Admin)) -- Message Content --> P1[Messaging Process]
    P1 -- Log --> T1[(communications Table)]
    P1 -- Dispatch --> P2[Email/SMS Service]
    P2 -- Notification --> Recipient((Recipient))
    Recipient -- Acknowledgement --> P1
```

### 4.4 E-R Diagram

```mermaid
erDiagram
    USERS ||--o{ COMMUNICATIONS : "sends"
    STUDENTS ||--o{ COMMUNICATIONS : "receives"
    ACADEMIC_BATCHES ||--o{ COMMUNICATIONS : "targeted_at"
```

---

## CHAPTER 5: SAMPLE SCREENSHOTS

**1. Create Institutional Announcement**
*Form used by administrators to post notices to students and faculty.*
- Fields: Title, Message Type, Priority, Message Content.
- *Sample Input:* Title: "Holiday on 26th January", Type: "notice", Priority: "normal".
![Announcement Form](https://example.com/screenshots/comm_create.png)

**2. Institutional Notice Board**
*View for students and faculty to see all published announcements.*
| Title | Date | Priority | Type |
|---|---|---|---|
| Holiday on 26th January | 2026-03-18 | normal | notice |
| Mid-Term Exam Schedule | 2026-03-18 | high | notice |
| Hostel Fee Reminder | 2026-03-18 | high | alert |
![Notice Board](https://example.com/screenshots/comm_dashboard.png)

**3. Targeted Email Notification**
*Interface for sending automated email notifications to specific batches.*
- Sender: Faculty (Rajesh Kumar)
- Target: Batch CSE2024
- Content: "Data Structures Lab Cancelled for 5th February."
![Email Notification](https://example.com/screenshots/comm_email.png)

---

## CHAPTER 6: SYSTEM IMPLEMENTATION

### Announcement Creation (PHP)

**create_announcement.php:**
```php
<?php
session_start();
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $priority = trim($_POST['priority'] ?? 'Normal');
    $recipient_type = trim($_POST['recipient_type'] ?? '');
    $channels = $_POST['channels'] ?? []; // Array of selected channels
    $schedule_date = $_POST['schedule_date'] ?? '';
    
    // Validate
    if (!$title || !$content || !$recipient_type || empty($channels)) {
        $_SESSION['error'] = 'Missing required fields';
        header('Location: announcement_create.php');
        exit();
    }
    
    try {
        $pdo->beginTransaction();
        
        // Create announcement
        $announcementSql = "INSERT INTO announcements 
                            (title, content, priority, created_by, created_at)
                            VALUES (?, ?, ?, ?, NOW())";
        
        $announcementStmt = $pdo->prepare($announcementSql);
        $announcementStmt->execute([$title, $content, $priority, $_SESSION['user_id']]);
        
        $announcement_id = $pdo->lastInsertId();
        
        // Create notification record
        $notificationSql = "INSERT INTO notifications
                            (announcement_id, recipient_type, recipient_filter, 
                             delivery_channels, scheduled_date, status)
                            VALUES (?, ?, ?, ?, ?, 'Scheduled')";
        
        $notificationStmt = $pdo->prepare($notificationSql);
        $channelsStr = implode(',', $channels);
        
        $notificationStmt->execute([
            $announcement_id,
            $recipient_type,
            isset($_POST['recipient_filter']) ? $_POST['recipient_filter'] : '',
            $channelsStr,
            $schedule_date ?? date('Y-m-d H:i:s')
        ]);
        
        $notification_id = $pdo->lastInsertId();
        
        // Queue notification for delivery
        queueNotificationDelivery($notification_id, $pdo);
        
        $pdo->commit();
        
        $_SESSION['success'] = 'Announcement created and scheduled for delivery';
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
    }
    
    header('Location: announcements.php');
    exit();
}

function queueNotificationDelivery($notification_id, $pdo) {
    // Get notification and announcement details
    $sql = "SELECT n.*, a.title, a.content FROM notifications n
            JOIN announcements a ON n.announcement_id = a.announcement_id
            WHERE n.notification_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$notification_id]);
    $notification = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get recipients based on filter
    $recipients = getRecipients($notification['recipient_type'], 
                                $notification['recipient_filter'], $pdo);
    
    // Create delivery log entries
    $logSql = "INSERT INTO delivery_log 
               (notification_id, recipient_id, channel, recipient_address, status)
               VALUES (?, ?, ?, ?, 'Pending')";
    
    $logStmt = $pdo->prepare($logSql);
    
    $channels = explode(',', $notification['delivery_channels']);
    
    foreach ($recipients as $recipient) {
        foreach ($channels as $channel) {
            $address = ($channel === 'Email') ? $recipient['email'] : $recipient['phone'];
            
            if ($address) {
                $logStmt->execute([
                    $notification_id,
                    $recipient['id'],
                    $channel,
                    $address
                ]);
            }
        }
    }
}

function getRecipients($type, $filter, $pdo) {
    $recipients = [];
    
    if ($type === 'AllStudents') {
        $sql = "SELECT student_id as id, email, phone->2 as phone FROM students WHERE status = 'Active'";
    } elseif ($type === 'AllParents') {
        $sql = "SELECT DISTINCT ec.contact_id as id, ec.email, ec.phone FROM emergency_contacts ec";
    } elseif ($type === 'ByProgram') {
        $filter_data = json_decode($filter, true);
        $sql = "SELECT student_id as id, email, phone FROM students s
                JOIN enrollments e ON s.student_id = e.student_id
                WHERE e.program_id = ?";
        // Execute with parameter...
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
```

### Notification Delivery Queue Processor

**process_notification_queue.php:**
```php
<?php
require_once 'config/config.php';

// Get pending deliveries
$sql = "SELECT * FROM delivery_log 
        WHERE status = 'Pending' 
        AND (last_attempt IS NULL OR TIMESTAMPDIFF(MINUTE, last_attempt, NOW()) > 5)
        LIMIT 100";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$pending = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($pending as $delivery) {
    if ($delivery['channel'] === 'Email') {
        sendEmailNotification($delivery, $pdo);
    } elseif ($delivery['channel'] === 'SMS') {
        sendSMSNotification($delivery, $pdo);
    } elseif ($delivery['channel'] === 'InApp') {
        createInAppNotification($delivery, $pdo);
    }
}

function sendEmailNotification($delivery, $pdo) {
    require_once 'libraries/PHPMailer/PHPMailer.php';
    
    // Get message content
    $sql = "SELECT a.title, a.content FROM delivery_log dl
            JOIN notifications n ON dl.notification_id = n.notification_id
            JOIN announcements a ON n.announcement_id = a.announcement_id
            WHERE dl.log_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$delivery['log_id']]);
    $message = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Send email
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    // Configure SMTP settings...
    
    $mail->From = 'noreply@kingston.edu';
    $mail->addAddress($delivery['recipient_address']);
    $mail->Subject = $message['title'];
    $mail->Body = $message['content'];
    
    if ($mail->send()) {
        updateDeliveryStatus($delivery['log_id'], 'Sent', $pdo);
    } else {
        updateDeliveryStatus($delivery['log_id'], 'Failed', $mail->ErrorInfo, $pdo);
    }
}

function updateDeliveryStatus($log_id, $status, $error = null, $pdo) {
    $sql = "UPDATE delivery_log 
            SET status = ?, last_attempt = NOW(), error_message = ?
            WHERE log_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$status, $error, $log_id]);
}
?>
```

---

## CHAPTER 7: TESTING

### 7.1 Introduction to System Testing

System testing verifies:

1. Announcements created and stored correctly
2. Notifications delivered via selected channels
3. Recipients properly selected based on filters
4. Delivery status tracked accurately
5. Read status updated when users view messages
6. Template variables replaced correctly

### 7.2 Types of Testing

#### Unit Testing
- Test recipient selection filters (by program, batch, status)
- Test template variable substitution
- Test priority-based notification ordering
- Test schedule date validation

#### Integration Testing
- Create announcement → Queue notification → Send email → Track delivery
- SMS delivery → Update delivery status → Read receipt
- Email bounce → Retry mechanism → Failed status

#### Functional Testing
- Create announcement for all students
- Schedule notification for future date
- Send SMS to specific batch
- View delivery status dashboard
- Mark message as read

#### White Box Testing
- Verify recipient query returns correct students
- Test queue processor handles concurrent deliveries
- Test error handling for email delivery failures
- Verify database constraints prevent invalid data

#### Black Box Testing
- Admin creates announcement → Appears in student inbox
- Student reads message → Read status updated
- Scheduled notification → Sends at scheduled time
- SMS delivery → Recipient receives message

#### Security Testing
- Non-admin cannot create announcements
- Student cannot access admin announcement area
- Email addresses cannot be harvested
- Notifications delivered only to intended recipients

#### Performance Testing
- Send notification to 5000+ students
- Process 1000+ delivery attempts simultaneously
- Generate delivery status report for 10000+ messages
- Template processing for 500+ variables

---

## CHAPTER 8: CONCLUSION AND FUTURE SCOPE

### Conclusion

The Communication & Notifications System successfully centralizes institutional communication and ensures timely dissemination of important information. The system provides multiple delivery channels and comprehensive tracking of message delivery and reading.

Key achievements:
- Centralized announcement platform
- Multi-channel notification delivery
- Targeted recipient selection
- Comprehensive delivery tracking
- Read receipt functionality

### Future Scope

1. **Two-Way Messaging**: WhatsApp integration for bidirectional communication
2. **Student Response Polling**: Announcement with response options (Yes/No/Maybe)
3. **Machine Learning Filtering**: Personalize notifications based on student interests
4. **Chatbot Integration**: AI chatbot for common queries
5. **Video Announcements**: Support for video content in announcements
6. **Team Communication**: Faculty-to-student discussion forums
7. **Mobile Push Notifications**: Native push notifications on student app
8. **Message Scheduling**: Recurring announcements (e.g., weekly updates)
9. **Sentiment Analysis**: Analyze parent/student feedback through emails
10. **Multi-Language Support**: Send notifications in preferred language

---

## CHAPTER 9: REFERENCE

1. **PHP Official Documentation**: https://www.php.net/manual/en/

2. **MySQL Documentation**: https://dev.mysql.com/doc/

3. **PHPMailer Library**: https://github.com/PHPMailer/PHPMailer

4. **SMS Gateway APIs**: Twilio, Elision documentation

5. **Bootstrap Framework**: https://getbootstrap.com/docs/5.3/

6. **Firebase Cloud Messaging**: https://firebase.google.com/docs/cloud-messaging

7. **Email Best Practices**: https://owasp.org/

8. **Queue Processing**: Redis, RabbitMQ documentation

9. **W3Schools**: https://www.w3schools.com/

10. **MDN Web Docs**: https://developer.mozilla.org/en-US/

---

**End of Report**
