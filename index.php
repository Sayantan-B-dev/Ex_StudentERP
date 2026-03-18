<?php
// index.php — Main Router
ob_start();
require_once 'config/config.php';

if (isset($_SESSION['user_id'])) {

    $page = isset($_GET['page']) ? trim($_GET['page']) : 'dashboard';

    $allowed_pages = [
        // Core
        'dashboard',
        // Academic Monitoring sub-pages
        'academic-monitoring',
        'student-information', 'student-add', 'student-edit', 'student-view',
        'attendance-tracking', 'attendance-add',
        'academic-performance',
        'course-management',
        'examination-management', 'exam-add',
        'fee-financial', 'fee-add',
        'communication',
        'library-management', 'library-add',
        'parent-portal',
        'analytics',
        // Institutes sub-pages
        'institutes', 'institute-add', 'institute-edit',
        'institute-types', 'institute-type-add',
        'departments', 'department-add', 'department-edit',
        'branches', 'branch-add', 'branch-edit',
        // Academic Programs sub-pages
        'academic-programs', 'program-add', 'program-edit',
        'batch-management', 'batch-add', 'batch-edit',
        'subjects', 'subject-add', 'subject-edit',
        'class-scheduling',
        // Faculty / Staff
        'faculty', 'staff-add', 'staff-edit', 'staff-view',
        'staff-categories', 'staff-designations', 'staff-allocations',
        // System
        'settings', 'profile', 'logs',
    ];

    if (!in_array($page, $allowed_pages)) {
        $page = 'dashboard';
    }

    $role = $_SESSION['user_role'] ?? 'faculty';
    $admin_only = ['institutes','institute-add','institute-edit','institute-types','institute-type-add','departments','department-add','department-edit',
                   'branches','branch-add','branch-edit','faculty','staff-add','staff-edit','staff-view','staff-categories','staff-designations',
                   'staff-allocations','settings','analytics','logs'];
    
    if (in_array($page, $admin_only) && $role !== 'admin') {
        $_SESSION['flash'] = 'Restricted access: Admins only.';
        $page = 'dashboard';
    }

    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        if ($role === 'faculty' && in_array($page, $admin_only)) {
            $_SESSION['flash'] = 'Access denied: Faculty cannot delete administrative data.';
            header('Location: '.BASE_URL.'/index.php?page='.$page); exit;
        }
    }

    $current_page = $page;

    include 'view/layout/header.php';
    include 'view/layout/sidebar.php';

    echo '<div id="main-content" class="main-content p-4">';

    // ── Page routing ──────────────────────────────────────────────────────────
    switch ($page) {
        case 'dashboard':            include 'view/dashboard/index.php'; break;

        // Students
        case 'student-information':  include 'view/students/index.php'; break;
        case 'student-add':          include 'view/students/add.php'; break;
        case 'student-edit':         include 'view/students/edit.php'; break;
        case 'student-view':         include 'view/students/view.php'; break;

        // Attendance
        case 'attendance-tracking':  include 'view/attendance/index.php'; break;
        case 'attendance-add':       include 'view/attendance/add.php'; break;

        // Academic Performance
        case 'academic-performance': include 'view/performance/index.php'; break;

        // Course Management
        case 'course-management':    include 'view/courses/index.php'; break;

        // Examination
        case 'examination-management': include 'view/examination/index.php'; break;
        case 'exam-add':               include 'view/examination/add.php'; break;

        // Fee & Financial
        case 'fee-financial':        include 'view/fees/index.php'; break;
        case 'fee-add':              include 'view/fees/add.php'; break;

        // Communication
        case 'communication':        include 'view/communication/index.php'; break;

        // Library
        case 'library-management':   include 'view/library/index.php'; break;
        case 'library-add':          include 'view/library/add.php'; break;

        // Parent Portal
        case 'parent-portal':        include 'view/parent/index.php'; break;

        // Analytics
        case 'analytics':            include 'view/analytics/index.php'; break;

        // Institutes
        case 'institutes':           include 'view/institutes/index.php'; break;
        case 'institute-add':        include 'view/institutes/add.php'; break;
        case 'institute-edit':       include 'view/institutes/edit.php'; break;
        case 'institute-types':      include 'view/institutes/types.php'; break;
        case 'institute-type-add':   include 'view/institutes/type_add.php'; break;
        case 'departments':          include 'view/departments/index.php'; break;
        case 'department-add':       include 'view/departments/add.php'; break;
        case 'department-edit':      include 'view/departments/edit.php'; break;
        case 'branches':             include 'view/branches/index.php'; break;
        case 'branch-add':           include 'view/branches/add.php'; break;
        case 'branch-edit':          include 'view/branches/edit.php'; break;

        // Academic Programs
        case 'academic-programs':    include 'view/programs/index.php'; break;
        case 'program-add':          include 'view/programs/add.php'; break;
        case 'program-edit':         include 'view/programs/edit.php'; break;
        case 'batch-management':     include 'view/batches/index.php'; break;
        case 'batch-add':            include 'view/batches/add.php'; break;
        case 'batch-edit':           include 'view/batches/edit.php'; break;
        case 'subjects':             include 'view/subjects/index.php'; break;
        case 'subject-add':          include 'view/subjects/add.php'; break;
        case 'subject-edit':         include 'view/subjects/edit.php'; break;
        case 'class-scheduling':     include 'view/scheduling/index.php'; break;

        // Faculty / Staff
        case 'faculty':              include 'view/faculty/index.php'; break;
        case 'staff-add':            include 'view/faculty/add.php'; break;
        case 'staff-edit':           include 'view/faculty/edit.php'; break;
        case 'staff-view':           include 'view/faculty/view.php'; break;
        case 'staff-categories':     include 'view/faculty/categories.php'; break;
        case 'staff-designations':   include 'view/faculty/designations.php'; break;
        case 'staff-allocations':    include 'view/faculty/allocations.php'; break;

        // System
        case 'settings':             include 'view/system/settings.php'; break;
        case 'profile':              include 'view/system/profile.php'; break;
        case 'logs':                 include 'view/system/logs.php'; break;

        default:
            echo '<div class="alert alert-warning">Page not found.</div>';
    }

    echo '</div>';
    include 'view/layout/footer.php';

} else {
    include 'view/landing.php';
}
?>