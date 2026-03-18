# MEMORY — Academic Monitoring & Institute Management System

## 1. Project Overview
- Project Name: Academic Monitoring & Institute Management System
- Project Folder Name: studentErpFin/
- Domain: Education Technology (EdTech)
- Scope: Multi-entity system handling Students, Faculty, Institutes, and Academic Programs
- Architecture Style: Modular Monolithic (PHP MVC)
- UI Framework: Bootstrap-based dashboard system

---

## 2. Core Modules

### Student-Centric Modules
- Student Information Management (SIM)
- Attendance Tracking
- Academic Performance & Grading
- Examination Management
- Fee & Financial Management

### Faculty / Teacher Management
- Faculty Listing & Profiles
- Faculty Assignment to Courses & Subjects
- Attendance / Class Handling by Faculty
- Faculty Role-based Access (Admin / Teacher)
- Performance Tracking (optional future extension)

### Academic Structure
- Course & Curriculum Management
- Programs & Courses
- Batch Management
- Subject Management
- Class Scheduling

### Institutional Management
- Institute Management
- Institute Types
- Departments
- Branches

### Communication Layer
- Communication & Notifications
- Parent & Guardian Portal

### System Intelligence
- Analytics & Reporting

### Auxiliary Systems
- Library Management

---

## 3. UI Navigation Architecture (Sidebar Driven)

### Context-Based Sidebar Rendering
- Sidebar dynamically changes based on `$current_page`
- Conditional rendering ensures modular navigation experience

#### Academic Monitoring Menu
- Student Information (SIM)
- Attendance Tracking
- Academic Performance
- Course Management
- Examination Management
- Fee & Financial
- Communication
- Library Management
- Parent Portal
- Analytics

#### Institutes Menu
- Manage Institutes
- Add Institute
- Institute Types
- Departments
- Branches

#### Academic Programs Menu
- Programs & Courses
- Batch Management
- Subjects
- Class Scheduling

#### Default Menu
- Dashboard Home
- All Students
- Faculty List

---

## 4. Dashboard System Design

### Key Metrics Cards
- Total Students
- Faculty Count
- Programs Count
- Revenue (Month-To-Date)

### Visualization Layer
- Chart.js Integration

#### Charts Implemented
- Line Chart: Student Enrollment Trend
- Doughnut Chart: Attendance Overview

### Data Tables
- Recent Student Enrollments Table
- Includes:
  - Admission Number
  - Name
  - Program
  - Batch
  - Status (Active / Pending / Inactive)

### Event & Alert System
- Upcoming Events Panel
- Alerts & Notices Panel
  - Attendance shortage warnings
  - Fee overdue alerts
  - System updates

---

## 5. Tech Stack

### Front-End
- HTML5
- CSS3 (Custom + Bootstrap 4.6)
- JavaScript (ES6)
- jQuery
- Bootstrap Icons
- Chart.js (Data Visualization)

### Back-End
- PHP (MVC pattern)
- MySQL (Relational DB)

### Dev Tools
- Git
- Node.js (tooling)
- NPM
- VS Code
- XAMPP
- NGrok

---

## 6. UI Design System

### Color Palette (CSS Variables)
- Beige: `#f5f5dc`
- Light Grey: `#f8f9fa`
- Olive Green: `#4a7c59`
- Maroon: `#800000`
- Brown: `#4a3c31`
- Pale Blue: `#a7c7e7`
- Dark Charcoal: `#2c3e50`
- Soft Light Grey: `#e9ecef`

### UI Characteristics
- Soft shadows with hover elevation effects
- Rounded cards (12px radius)
- Minimalist dashboard aesthetic
- Consistent iconography using Bootstrap Icons

### Components
- Cards with hover animations
- Responsive tables
- Badges for status indication
- Sidebar navigation with collapse functionality

---

## 7. Sidebar System Behavior

### Toggle Logic
- JavaScript function `toggleSidebar()`
- Dynamically hides/shows `.sidebar-content`

### UX Implication
- Allows compact mode for smaller screens
- Enhances usability in data-heavy dashboards

---

## 8. System Architecture

### Flow
1. Client Request → PHP Router (`index.php`)
2. Controller resolves logic
3. Model interacts with MySQL
4. View renders UI (Bootstrap templates)

### Pattern
- MVC (Model View Controller)

---

## 9. Database Design (Extended)

### Core Entities
- students
- faculty
- institutes
- departments
- branches
- programs
- batches
- subjects
- courses
- attendance
- exams
- grades
- fees
- users
- notifications
- library_records

### Faculty Table (Important)
- id
- name
- designation
- department_id
- email
- phone
- status

---

## 10. Authentication & Roles

### Roles
- Admin
- Faculty (Teacher)
- Student
- Parent

### Access Control
- Role-based routing
- Session-based authentication

---

## 11. Feature Mapping (UI → Backend)

| UI Component | Backend Responsibility |
|-------------|----------------------|
| Sidebar Menu | Route resolution |
| Dashboard Cards | Aggregated SQL queries |
| Charts | API or inline PHP data injection |
| Tables | Paginated SELECT queries |
| Alerts | Rule-based triggers |

---

## 12. State Management
- PHP Sessions for login state
- Cookies (optional persistent login)

---

## 13. Security
- Prepared statements (SQL Injection prevention)
- Input validation and sanitization
- Session regeneration
- XSS prevention via output escaping

---

## 14. Performance Strategy
- Indexed database queries
- Lazy rendering for charts
- Minified assets
- Pagination for tables

---

## 15. Deployment
- Local: XAMPP
- Production:
  - Apache / Nginx
  - VPS (DigitalOcean)
  - SSL (Let's Encrypt)

---

## 16. Conventions
- Folder Structure:
  - /models
  - /views
  - /controllers
  - /assets
  - /config

- Naming:
  - DB → snake_case
  - Variables → camelCase

---

## 17. Future Enhancements
- Teacher performance analytics
- Real-time notifications (WebSockets)
- REST API layer
- React-based frontend migration
- Role-based dashboards per user

---

## 18. Session Notes
- System now includes full institute + faculty ecosystem
- UI is dashboard-first, data-driven architecture
- Sidebar is central navigation control system
- Memory must be updated when adding new modules or schema changes