<?php
// view/courses/index.php — Course Management
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$rows = $pdo->query("SELECT c.*, p.name AS program_name, sub.name AS subject_name, b.batch_code, CONCAT(st.first_name,' ',st.last_name) AS faculty_name FROM course_mappings c JOIN academic_programs p ON c.program_id=p.id JOIN subjects sub ON c.subject_id=sub.id LEFT JOIN academic_batches b ON c.batch_id=b.id LEFT JOIN staff st ON c.faculty_id=st.id ORDER BY c.academic_year DESC, c.semester")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-book me-2" style="color:var(--olive)"></i>Course Management</h1><p class="page-subtitle">Program-subject mappings and faculty assignments.</p></div>
</div>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">Course Mappings <span class="badge bg-secondary"><?php echo count($rows); ?></span></h6><div class="d-flex"><select id="tableFilter" class="form-select form-select-sm me-2" style="width:120px"><option value="">All</option><option value="active">Active</option><option value="inactive">Inactive</option></select><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px"></div></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Program</th><th>Subject</th><th>Batch</th><th>Sem</th><th>Year</th><th>Faculty</th><th>Status</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo htmlspecialchars($r['program_name']); ?></td>
            <td><?php echo htmlspecialchars($r['subject_name']); ?></td>
            <td><?php echo htmlspecialchars($r['batch_code']??'All'); ?></td>
            <td><?php echo $r['semester']; ?></td>
            <td><?php echo htmlspecialchars($r['academic_year']); ?></td>
            <td><?php echo htmlspecialchars($r['faculty_name']??'—'); ?></td>
            <td><span class="badge <?php echo ($r['status'] === 'active')?'badge-active':'badge-inactive'; ?>"><?php echo ($r['status'] === 'active')?'Active':'Inactive'; ?></span></td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="8" class="text-center py-5 text-muted">No course mappings. Add via Programs and Subjects pages.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
