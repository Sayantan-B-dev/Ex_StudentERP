<?php
// view/performance/index.php — Academic Performance
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$rows = $pdo->query("SELECT sg.*, CONCAT(s.first_name,' ',s.last_name) AS student_name, s.admission_number, sub.name AS subject_name, sub.code AS sub_code, b.batch_code, e.name AS exam_name, (sg.marks_obtained/NULLIF(sg.total_marks,0)*100) AS percentage, IF((sg.marks_obtained/NULLIF(sg.total_marks,0))>=0.4, 'pass', 'fail') AS result FROM student_grades sg JOIN students s ON sg.student_id=s.id JOIN subjects sub ON sg.subject_id=sub.id LEFT JOIN academic_batches b ON s.batch_id=b.id LEFT JOIN examinations e ON sg.examination_id=e.id ORDER BY sg.created_at DESC LIMIT 100")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-bar-chart-line me-2" style="color:var(--olive)"></i>Academic Performance</h1><p class="page-subtitle">Student grades and result analysis.</p></div>
</div>
<?php if ($rows): ?>
<?php
$avg = array_sum(array_column($rows,'percentage')) / count($rows);
$pass = count(array_filter($rows, fn($r) => $r['result']==='pass'));
$fail = count($rows) - $pass;
?>
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="stat-card" style="background:var(--olive)"><div><h6>Total Records</h6><h2><?php echo count($rows); ?></h2></div><i class="bi bi-list-ol stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:#27ae60"><div><h6>Pass</h6><h2><?php echo $pass; ?></h2></div><i class="bi bi-trophy-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--maroon)"><div><h6>Fail</h6><h2><?php echo $fail; ?></h2></div><i class="bi bi-x-octagon-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--charcoal)"><div><h6>Avg %</h6><h2><?php echo number_format($avg,1); ?>%</h2></div><i class="bi bi-percent stat-icon"></i></div></div>
</div>
<?php endif; ?>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">Grade Records</h6><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px"></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Adm.No</th><th>Student</th><th>Subject</th><th>Exam</th><th>Marks</th><th>%</th><th>Grade</th><th>Result</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><code><?php echo htmlspecialchars($r['admission_number']); ?></code></td>
            <td><?php echo htmlspecialchars($r['student_name']); ?></td>
            <td><?php echo htmlspecialchars($r['sub_code'].' - '.$r['subject_name']); ?></td>
            <td><?php echo htmlspecialchars($r['exam_name']??'—'); ?></td>
            <td><?php echo $r['marks_obtained']; ?>/<?php echo $r['total_marks']; ?></td>
            <td><strong><?php echo number_format($r['percentage'],1); ?>%</strong></td>
            <td><span class="badge" style="background:var(--olive-light);color:var(--olive)"><?php echo $r['grade']; ?></span></td>
            <td><span class="badge <?php echo $r['result']==='pass'?'badge-active':'badge-inactive'; ?>"><?php echo ucfirst($r['result']); ?></span></td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="9" class="text-center py-5 text-muted">No grade records yet.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
