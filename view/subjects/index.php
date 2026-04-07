<?php
// view/subjects/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM subjects WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Subject deleted.'; header('Location: '.BASE_URL.'/index.php?page=subjects'); exit;
}
$rows = $pdo->query("SELECT s.*, d.name AS dept_name FROM subjects s LEFT JOIN departments d ON s.department_id=d.id ORDER BY s.name")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-journal-text me-2" style="color:var(--olive)"></i>Subjects</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=subject-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Add Subject</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">All Subjects <span class="badge bg-secondary"><?php echo count($rows); ?></span></h6><div class="d-flex"><select id="tableFilter" class="form-select form-select-sm me-2" style="width:120px"><option value="">All</option><option value="active">Active</option><option value="inactive">Inactive</option></select><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px"></div></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Code</th><th>Name</th><th>Type</th><th>Department</th><th>Credits</th><th>Theory Hrs</th><th>Pract. Hrs</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td><td><code><?php echo htmlspecialchars($r['code']); ?></code></td>
            <td><?php echo htmlspecialchars($r['name']); ?></td><td><?php echo ucfirst($r['subject_type']); ?></td>
            <td><?php echo htmlspecialchars($r['dept_name']??'—'); ?></td>
            <td><?php echo $r['credit_hours']; ?></td><td><?php echo $r['theory_hours']; ?></td><td><?php echo $r['practical_hours']; ?></td>
            <td><span class="badge <?php echo $r['status']==='active'?'badge-active':'badge-inactive'; ?>"><?php echo ucfirst($r['status']); ?></span></td>
            <td>
                <a href="<?php echo $B; ?>/index.php?page=subject-edit&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <a href="?page=subjects&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="10" class="text-center py-5 text-muted">No subjects found.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
