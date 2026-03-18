<?php
// view/batches/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM academic_batches WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Batch deleted.'; header('Location: '.BASE_URL.'/index.php?page=batch-management'); exit;
}
$rows = $pdo->query("SELECT b.*, p.name AS program_name FROM academic_batches b LEFT JOIN academic_programs p ON b.program_id=p.id ORDER BY b.batch_year DESC, b.batch_code")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-grid-3x3-gap me-2" style="color:var(--olive)"></i>Batch Management</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=batch-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Add Batch</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">All Batches <span class="badge bg-secondary"><?php echo count($rows); ?></span></h6><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px"></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Code</th><th>Batch</th><th>Program</th><th>Year</th><th>Semester</th><th>Students</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td><td><code><?php echo htmlspecialchars($r['batch_code']); ?></code></td>
            <td><?php echo htmlspecialchars($r['batch_name']??$r['batch_code']); ?></td>
            <td><?php echo htmlspecialchars($r['program_name']??'—'); ?></td>
            <td><?php echo $r['batch_year']; ?></td>
            <td>Sem <?php echo $r['current_semester']; ?></td>
            <td><?php echo $r['total_students']; ?>/<?php echo $r['max_capacity']; ?></td>
            <td><span class="badge <?php echo match($r['status']){'active'=>'badge-active','completed'=>'badge-completed','upcoming'=>'badge-pending',default=>'badge-inactive'}; ?>"><?php echo ucfirst($r['status']); ?></span></td>
            <td>
                <a href="<?php echo $B; ?>/index.php?page=batch-edit&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <a href="?page=batch-management&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="9" class="text-center py-5 text-muted">No batches found.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
