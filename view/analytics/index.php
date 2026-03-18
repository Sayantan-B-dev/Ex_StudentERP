<?php
// view/analytics/index.php — Analytics Dashboard
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$totalStudents = $pdo->query("SELECT COUNT(*) FROM students WHERE status='active'")->fetchColumn();
$totalStaff    = $pdo->query("SELECT COUNT(*) FROM staff WHERE status='active'")->fetchColumn();
$totalRevenue  = $pdo->query("SELECT SUM(amount_paid) FROM fee_transactions WHERE payment_status='paid'")->fetchColumn();
$totalExams    = $pdo->query("SELECT COUNT(*) FROM examinations")->fetchColumn();

// Students by program
$byProgram = $pdo->query("SELECT p.name, COUNT(s.id) AS cnt FROM students s LEFT JOIN academic_programs p ON s.program_id=p.id WHERE s.status='active' GROUP BY p.name ORDER BY cnt DESC LIMIT 8")->fetchAll(PDO::FETCH_ASSOC);
// Students by batch year
$byYear = $pdo->query("SELECT YEAR(s.created_at) AS yr, COUNT(*) AS cnt FROM students s GROUP BY yr ORDER BY yr")->fetchAll(PDO::FETCH_ASSOC);
// Gender breakdown
$genders = $pdo->query("SELECT gender, COUNT(*) AS cnt FROM students GROUP BY gender")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-graph-up-arrow me-2" style="color:var(--olive)"></i>Analytics</h1><p class="page-subtitle">Insights and trends across the institution.</p></div></div>
<!-- KPIs -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3"><div class="stat-card" style="background:var(--olive)"><div><h6>Students</h6><h2><?php echo $totalStudents; ?></h2></div><i class="bi bi-people-fill stat-icon"></i></div></div>
    <div class="col-6 col-md-3"><div class="stat-card" style="background:var(--maroon)"><div><h6>Staff</h6><h2><?php echo $totalStaff; ?></h2></div><i class="bi bi-person-badge-fill stat-icon"></i></div></div>
    <div class="col-6 col-md-3"><div class="stat-card" style="background:var(--brown)"><div><h6>Revenue</h6><h2>₹<?php echo $totalRevenue > 1000 ? number_format($totalRevenue/1000,0).'K' : number_format($totalRevenue); ?></h2></div><i class="bi bi-bank stat-icon"></i></div></div>
    <div class="col-6 col-md-3"><div class="stat-card" style="background:var(--charcoal)"><div><h6>Exams</h6><h2><?php echo $totalExams; ?></h2></div><i class="bi bi-pencil-square stat-icon"></i></div></div>
</div>
<!-- Charts -->
<div class="row g-3 mb-4">
    <div class="col-lg-7"><div class="card"><div class="card-header"><h6 class="mb-0"><i class="bi bi-bar-chart me-2" style="color:var(--olive)"></i>Students by Program</h6></div><div class="card-body"><canvas id="programChart"></canvas></div></div></div>
    <div class="col-lg-5"><div class="card"><div class="card-header"><h6 class="mb-0"><i class="bi bi-pie-chart me-2" style="color:var(--maroon)"></i>Gender Distribution</h6></div><div class="card-body"><canvas id="genderChart"></canvas></div></div></div>
</div>
<div class="row g-3">
    <div class="col-12"><div class="card"><div class="card-header"><h6 class="mb-0"><i class="bi bi-graph-up me-2" style="color:var(--olive)"></i>Annual Enrollment Trend</h6></div><div class="card-body"><canvas id="yearChart"></canvas></div></div></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const programData = {
    labels: <?php echo json_encode(array_column($byProgram, 'name')); ?>,
    data:   <?php echo json_encode(array_column($byProgram, 'cnt')); ?>
};
const genderData = {
    labels: <?php echo json_encode(array_column($genders, 'gender')); ?>,
    data:   <?php echo json_encode(array_column($genders, 'cnt')); ?>
};
const yearData = {
    labels: <?php echo json_encode(array_column($byYear, 'yr')); ?>,
    data:   <?php echo json_encode(array_column($byYear, 'cnt')); ?>
};
document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('programChart'), {
        type: 'bar',
        data: { labels: programData.labels, datasets:[{ label:'Students', data: programData.data, backgroundColor:'rgba(74,124,89,.7)', borderColor:'#4a7c59', borderWidth:1 }] },
        options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}} }
    });
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: { labels: genderData.labels, datasets:[{ data: genderData.data, backgroundColor:['#4a7c59','#800000','#4a3c31'], borderWidth:0 }] },
        options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'bottom'}}, cutout:'65%' }
    });
    new Chart(document.getElementById('yearChart'), {
        type: 'line',
        data: { labels: yearData.labels, datasets:[{ label:'Enrollments', data: yearData.data, borderColor:'#4a7c59', backgroundColor:'rgba(74,124,89,.1)', tension:.4, fill:true, pointRadius:5 }] },
        options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}} }
    });
});
</script>
