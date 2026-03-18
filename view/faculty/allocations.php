<?php
// view/faculty/allocations.php - Staff Subject Allocations
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM staff_subject_allocations WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Allocation removed.'; header('Location: '.BASE_URL.'/index.php?page=staff-allocations'); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("INSERT INTO staff_subject_allocations (staff_id,subject_id,batch_id,academic_year,semester,allocation_type,hours_per_week,status) VALUES (?,?,?,?,?,?,?,?)")
        ->execute([$_POST['staff_id'],$_POST['subject_id'],$_POST['batch_id']??null,$_POST['academic_year'],intval($_POST['semester']),$_POST['allocation_type']??'theory',$_POST['hours_per_week']??0,'active']);
    $_SESSION['flash'] = 'Allocation saved.'; header('Location: '.BASE_URL.'/index.php?page=staff-allocations'); exit;
}
$staff    = $pdo->query("SELECT id, CONCAT(first_name,' ',last_name) AS name, staff_id FROM staff WHERE status='active' ORDER BY first_name")->fetchAll(PDO::FETCH_ASSOC);
$subjects = $pdo->query("SELECT id, name, code FROM subjects WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$batches  = $pdo->query("SELECT id, batch_code, batch_name FROM academic_batches WHERE status='active' ORDER BY batch_code")->fetchAll(PDO::FETCH_ASSOC);
$rows     = $pdo->query("SELECT a.*, CONCAT(s.first_name,' ',s.last_name) AS staff_name, s.staff_id AS sid, sub.name AS subject_name, sub.code AS sub_code, b.batch_code FROM staff_subject_allocations a
    JOIN staff s ON a.staff_id=s.id JOIN subjects sub ON a.subject_id=sub.id LEFT JOIN academic_batches b ON a.batch_id=b.id ORDER BY a.id DESC")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-shuffle me-2" style="color:var(--olive)"></i>Staff Subject Allocations</h1></div></div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="row g-4">
    <div class="col-md-4"><div class="card"><div class="card-header"><h6 class="mb-0">New Allocation</h6></div><div class="card-body">
        <form method="POST">
            <div class="mb-3"><label class="form-label">Staff *</label><select name="staff_id" class="form-select" required><option value="">Select Staff</option><?php foreach ($staff as $s): ?><option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['name'].' ('.$s['staff_id'].')'); ?></option><?php endforeach; ?></select></div>
            <div class="mb-3"><label class="form-label">Subject *</label><select name="subject_id" class="form-select" required><option value="">Select Subject</option><?php foreach ($subjects as $s): ?><option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['code'].' - '.$s['name']); ?></option><?php endforeach; ?></select></div>
            <div class="mb-3"><label class="form-label">Batch</label><select name="batch_id" class="form-select"><option value="">All Batches</option><?php foreach ($batches as $b): ?><option value="<?php echo $b['id']; ?>"><?php echo htmlspecialchars($b['batch_code']); ?></option><?php endforeach; ?></select></div>
            <div class="mb-3"><label class="form-label">Academic Year</label><input type="text" name="academic_year" class="form-control" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>" required></div>
            <div class="mb-3"><label class="form-label">Semester</label><select name="semester" class="form-select"><?php for ($i=1;$i<=8;$i++): ?><option value="<?php echo $i; ?>">Sem <?php echo $i; ?></option><?php endfor; ?></select></div>
            <div class="mb-3"><label class="form-label">Type</label><select name="allocation_type" class="form-select"><option value="theory">Theory</option><option value="practical">Practical</option><option value="tutorial">Tutorial</option></select></div>
            <div class="mb-3"><label class="form-label">Hours/Week</label><input type="number" name="hours_per_week" class="form-control" value="3"></div>
            <button type="submit" class="btn btn-olive w-100">Save Allocation</button>
        </form>
    </div></div></div>
    <div class="col-md-8"><div class="card"><div class="card-header"><h6 class="mb-0">All Allocations <span class="badge bg-secondary"><?php echo count($rows); ?></span></h6></div>
        <div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>Staff</th><th>Subject</th><th>Batch</th><th>Year</th><th>Sem</th><th>Type</th><th>Hrs</th><th>Actions</th></tr></thead>
            <tbody>
            <?php if ($rows): foreach ($rows as $i => $r): ?>
                <tr><td><?php echo $i+1; ?></td><td><?php echo htmlspecialchars($r['staff_name'].' ('.$r['sid'].')'); ?></td><td><?php echo htmlspecialchars($r['sub_code'].' - '.$r['subject_name']); ?></td><td><?php echo htmlspecialchars($r['batch_code']??'All'); ?></td><td><?php echo $r['academic_year']; ?></td><td><?php echo $r['semester']; ?></td><td><?php echo ucfirst($r['allocation_type']); ?></td><td><?php echo $r['hours_per_week']; ?></td>
                <td><a href="?page=staff-allocations&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a></td></tr>
            <?php endforeach; else: ?><tr><td colspan="9" class="text-center py-4 text-muted">No allocations.</td></tr><?php endif; ?>
            </tbody>
        </table></div></div>
    </div></div>
</div>
