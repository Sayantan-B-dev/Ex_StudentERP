<?php
// view/dashboard/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$totalStudents  = $pdo->query("SELECT COUNT(*) FROM students WHERE status='active'")->fetchColumn();
$totalStaff     = $pdo->query("SELECT COUNT(*) FROM staff WHERE status='active'")->fetchColumn();
$totalPrograms  = $pdo->query("SELECT COUNT(*) FROM academic_programs WHERE status='active'")->fetchColumn();
$totalBatches   = $pdo->query("SELECT COUNT(*) FROM academic_batches WHERE status='active'")->fetchColumn();

// Real data for charts
$enrollments = $pdo->query("SELECT MONTHNAME(created_at) as month, COUNT(*) as count FROM students WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH) GROUP BY MONTH(created_at) ORDER BY created_at")->fetchAll(PDO::FETCH_KEY_PAIR);
$months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$chartData = [];
foreach($months as $m) $chartData[] = $enrollments[$m] ?? 0;

$attendanceRes = $pdo->query("SELECT status, COUNT(*) as count FROM attendance WHERE attendance_date = CURDATE() GROUP BY status")->fetchAll(PDO::FETCH_KEY_PAIR);
$attLabels = ['Present','Absent','Late','Leave'];
$attData = [];
foreach(['present','absent','late','excused'] as $s) $attData[] = $attendanceRes[$s] ?? 0;
?>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h1 class="page-title"><i class="bi bi-speedometer2 me-2" style="color:var(--olive)"></i>Dashboard</h1>
        <p class="page-subtitle">Welcome back, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?>! Here's an overview.</p>
    </div>
    <div>
        <span class="badge bg-light text-dark p-2 fs-6">
            <i class="bi bi-calendar3 me-1"></i><?php echo date('D, d M Y'); ?>
        </span>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <a href="<?php echo BASE_URL; ?>/index.php?page=student-information" class="text-decoration-none">
            <div class="stat-card d-flex justify-content-between align-items-center" style="background:var(--olive)">
                <div>
                    <h6>Total Students</h6>
                    <h2><?php echo number_format($totalStudents); ?></h2>
                    <small><i class="bi bi-people"></i> Active</small>
                </div>
                <i class="bi bi-people-fill stat-icon"></i>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="<?php echo BASE_URL; ?>/index.php?page=faculty" class="text-decoration-none">
            <div class="stat-card d-flex justify-content-between align-items-center" style="background:var(--maroon)">
                <div>
                    <h6>Faculty & Staff</h6>
                    <h2><?php echo number_format($totalStaff); ?></h2>
                    <small><i class="bi bi-person-badge"></i> Active</small>
                </div>
                <i class="bi bi-person-badge-fill stat-icon"></i>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="<?php echo BASE_URL; ?>/index.php?page=academic-programs" class="text-decoration-none">
            <div class="stat-card d-flex justify-content-between align-items-center" style="background:var(--brown)">
                <div>
                    <h6>Programs</h6>
                    <h2><?php echo number_format($totalPrograms); ?></h2>
                    <small><i class="bi bi-mortarboard"></i> Active</small>
                </div>
                <i class="bi bi-mortarboard-fill stat-icon"></i>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="<?php echo BASE_URL; ?>/index.php?page=batch-management" class="text-decoration-none">
            <div class="stat-card d-flex justify-content-between align-items-center" style="background:var(--charcoal)">
                <div>
                    <h6>Active Batches</h6>
                    <h2><?php echo number_format($totalBatches); ?></h2>
                    <small><i class="bi bi-grid"></i> Running</small>
                </div>
                <i class="bi bi-grid-fill stat-icon"></i>
            </div>
        </a>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="bi bi-graph-up me-2" style="color:var(--olive)"></i>Student Enrollment Trend</h6>
            </div>
            <div class="card-body">
                <canvas id="enrollmentChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-pie-chart me-2" style="color:var(--maroon)"></i>Attendance Overview</h6>
            </div>
            <div class="card-body">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Students Table -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="bi bi-table me-2" style="color:var(--olive)"></i>Recent Student Records</h6>
                <a href="<?php echo BASE_URL; ?>/index.php?page=student-information" class="btn btn-sm btn-olive">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th><th>Admission No.</th><th>Name</th>
                                <th>Program</th><th>Semester</th><th>Status</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT s.id, s.admission_number, s.first_name, s.last_name,
                            s.current_semester, s.status, p.name AS program_name
                            FROM students s
                            LEFT JOIN academic_programs p ON s.program_id = p.id
                            ORDER BY s.created_at DESC LIMIT 8");
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($rows):
                            foreach ($rows as $i => $row):
                                $badge = match($row['status']) {
                                    'active'   => 'badge-active',
                                    'inactive' => 'badge-inactive',
                                    'graduated'=> 'badge-completed',
                                    default    => 'badge-pending'
                                };
                        ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo htmlspecialchars($row['admission_number']); ?></td>
                                <td><i class="bi bi-person-circle me-1" style="color:var(--olive)"></i><?php echo htmlspecialchars($row['first_name'].' '.$row['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['program_name'] ?? '—'); ?></td>
                                <td>Sem <?php echo $row['current_semester']; ?></td>
                                <td><span class="badge <?php echo $badge; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/index.php?page=student-view&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                    <a href="<?php echo BASE_URL; ?>/index.php?page=student-edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="7" class="text-center text-muted py-4">No student records yet. <a href="<?php echo BASE_URL; ?>/index.php?page=student-add">Add one</a>.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Events & Alerts Row -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-calendar-event me-2" style="color:var(--maroon)"></i>Upcoming Events</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="bi bi-circle-fill me-2" style="color:var(--olive);font-size:.6rem"></i>Internal Exams Start</div>
                        <span class="badge bg-light text-dark">20 Mar 2026</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="bi bi-circle-fill me-2" style="color:var(--maroon);font-size:.6rem"></i>Parent-Teacher Meeting</div>
                        <span class="badge bg-light text-dark">25 Mar 2026</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="bi bi-circle-fill me-2" style="color:var(--brown);font-size:.6rem"></i>Fee Deadline</div>
                        <span class="badge bg-light text-dark">30 Mar 2026</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="bi bi-circle-fill me-2" style="color:var(--charcoal);font-size:.6rem"></i>Annual Sports Day</div>
                        <span class="badge bg-light text-dark">05 Apr 2026</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-exclamation-triangle me-2" style="color:#f0a500"></i>Alerts & Notices</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-warning custom-alert mb-2" role="alert">
                    <i class="bi bi-info-circle-fill"></i>
                    <div>Attendance shortage for students in Diploma CST.</div>
                </div>
                <div class="alert alert-danger custom-alert mb-2" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>Fee overdue for some students — follow up required.</div>
                </div>
                <div class="alert alert-success custom-alert mb-0" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>New academic programs approved for next session.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Chart(document.getElementById('enrollmentChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Enrollments',
                data: <?php echo json_encode($chartData); ?>,
                borderColor: '#4a7c59',
                backgroundColor: 'rgba(74,124,89,.12)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#4a7c59'
            }]
        },
        options: { responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
    new Chart(document.getElementById('attendanceChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($attLabels); ?>,
            datasets: [{ data: <?php echo json_encode($attData); ?>, backgroundColor: ['#4a7c59','#e74c3c','#f1c40f','#95a5a6'], borderWidth: 0 }]
        },
        options: { responsive: true, maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }, cutout: '65%'
        }
    });
});
</script>