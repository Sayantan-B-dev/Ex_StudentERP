<?php
// view/branches/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM branches WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Branch deleted.'; header('Location: '.BASE_URL.'/index.php?page=branches'); exit;
}
$rows = $pdo->query("SELECT b.*, i.name AS institute_name FROM branches b LEFT JOIN institutes i ON b.institute_id=i.id ORDER BY b.name")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-sign-merge-left me-2" style="color:var(--olive)"></i>Branches</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=branch-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Add Branch</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Code</th><th>Name</th><th>Institute</th><th>City</th><th>Type</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td><td><code><?php echo htmlspecialchars($r['code']); ?></code></td>
            <td><?php echo htmlspecialchars($r['name']); ?></td><td><?php echo htmlspecialchars($r['institute_name']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['city']??'—'); ?></td><td><?php echo ucfirst($r['type']); ?></td>
            <td><span class="badge <?php echo $r['status']==='active'?'badge-active':'badge-inactive'; ?>"><?php echo ucfirst($r['status']); ?></span></td>
            <td>
                <a href="<?php echo $B; ?>/index.php?page=branch-edit&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <a href="?page=branches&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="8" class="text-center py-5 text-muted">No branches found.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
