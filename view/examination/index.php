<?php
// view/examination/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo->prepare("DELETE FROM examinations WHERE id=?")->execute([$id]);
    logActivity($pdo, 'Delete Exam', 'Exams', "Deleted examination schedule ID: $id");
    $_SESSION['flash'] = 'Exam deleted.'; header('Location: '.BASE_URL.'/index.php?page=examination-management'); exit;
}
$rows = $pdo->query("SELECT e.*, p.name AS program_name, b.batch_code FROM examinations e LEFT JOIN academic_programs p ON e.program_id=p.id LEFT JOIN academic_batches b ON e.batch_id=b.id ORDER BY e.exam_date DESC")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-pencil-square me-2" style="color:var(--olive)"></i>Examination Management</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=exam-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Schedule Exam</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">All Exams <span class="badge bg-secondary"><?php echo count($rows); ?></span></h6><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px"></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Exam Name</th><th>Type</th><th>Program</th><th>Batch</th><th>Semester</th><th>Exam Date</th><th>Duration</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r):
        $badge = match($r['status']){'scheduled'=>'badge-pending','ongoing'=>'badge-active','completed'=>'badge-completed', 'cancelled'=>'badge-inactive', default=>'badge-pending'};
    ?>
        <tr>
            <td><?php echo $i+1; ?></td><td><strong><?php echo htmlspecialchars($r['name']); ?></strong></td><td><?php echo ucfirst($r['exam_type']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['program_name']??'—'); ?></td><td><?php echo htmlspecialchars($r['batch_code']??'All'); ?></td>
            <td>Sem <?php echo $r['semester']; ?></td><td><?php echo $r['exam_date']??'—'; ?></td>
            <td><?php echo $r['duration_minutes']; ?> min</td>
            <td><span class="badge <?php echo $badge; ?>"><?php echo ucfirst($r['status']); ?></span></td>
            <td>
                <a href="<?php echo $B; ?>/index.php?page=exam-add&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                <a href="?page=examination-management&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete" title="Delete"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="10" class="text-center py-5 text-muted">No exams scheduled.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
