<?php
// view/parent/index.php — Parent Portal
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$prog_id = (int)($_GET['program_id'] ?? 0);
$bat_id  = (int)($_GET['batch_id'] ?? 0);

$where_clauses = ["1=1"];
$params = [];

if ($search) {
    $where_clauses[] = "(s.father_name LIKE ? OR s.mother_name LIKE ? OR s.guardian_name LIKE ? OR s.first_name LIKE ?)";
    $params = array_merge($params, ["%$search%","%$search%","%$search%","%$search%"]);
}
if ($prog_id) {
    $where_clauses[] = "s.program_id = ?";
    $params[] = $prog_id;
}
if ($bat_id) {
    $where_clauses[] = "s.batch_id = ?";
    $params[] = $bat_id;
}

$where = "WHERE " . implode(" AND ", $where_clauses);

$stmt = $pdo->prepare("SELECT s.id, s.admission_number, s.first_name, s.last_name, s.father_name, s.father_phone, s.father_email, s.mother_name, s.mother_phone, s.guardian_name, s.guardian_phone, p.name AS program_name, s.status FROM students s LEFT JOIN academic_programs p ON s.program_id=p.id $where ORDER BY s.first_name LIMIT 100");
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$programs = $pdo->query("SELECT id, name FROM academic_programs ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$batches  = $pdo->query("SELECT id, batch_code FROM academic_batches ORDER BY batch_code")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-people me-2" style="color:var(--olive)"></i>Parent Portal</h1><p class="page-subtitle">Parent & guardian contact information and student links.</p></div></div>
<div class="card mb-3"><div class="card-body py-3">
    <form method="GET" class="row g-2">
        <input type="hidden" name="page" value="parent-portal">
        <div class="col-md-3"><input type="text" name="q" class="form-control" placeholder="Search parent/student name…" value="<?php echo htmlspecialchars($search); ?>"></div>
        <div class="col-md-3"><select name="program_id" class="form-select" onchange="this.form.submit()"><option value="">All Programs</option><?php foreach ($programs as $p): ?><option value="<?php echo $p['id']; ?>" <?php echo $prog_id==$p['id']?'selected':''; ?>><?php echo htmlspecialchars($p['name']); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-3"><select name="batch_id" class="form-select" onchange="this.form.submit()"><option value="">All Batches</option><?php foreach ($batches as $b): ?><option value="<?php echo $b['id']; ?>" <?php echo $bat_id==$b['id']?'selected':''; ?>><?php echo htmlspecialchars($b['batch_code']); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-olive flex-grow-1"><i class="bi bi-search me-1"></i>Search</button>
            <a href="<?php echo $B; ?>/index.php?page=parent-portal" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div></div>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">Guardian Directory <span class="badge bg-secondary"><?php echo count($rows); ?></span></h6><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Filter…" style="width:200px"></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Student</th><th>Program</th><th>Father</th><th>Father Phone</th><th>Mother</th><th>Mother Phone</th><th>Guardian</th><th>Guardian Phone</th><th>Status</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><a href="<?php echo $B; ?>/index.php?page=student-view&id=<?php echo $r['id']; ?>"><?php echo htmlspecialchars($r['first_name'].' '.$r['last_name']); ?></a><br><code style="font-size:.75rem"><?php echo $r['admission_number']; ?></code></td>
            <td><?php echo htmlspecialchars($r['program_name']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['father_name']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['father_phone']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['mother_name']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['mother_phone']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['guardian_name']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['guardian_phone']??'—'); ?></td>
            <td><span class="badge <?php echo $r['status']==='active'?'badge-active':'badge-inactive'; ?>"><?php echo ucfirst($r['status']); ?></span></td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="10" class="text-center py-5 text-muted">No records found.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
