<?php
// view/institutes/types.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM institute_types WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Institute type deleted.'; header('Location: '.BASE_URL.'/index.php?page=institute-types'); exit;
}
$rows = $pdo->query("SELECT * FROM institute_types ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-tags me-2" style="color:var(--olive)"></i>Institute Types</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=institute-type-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Add Type</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="card"><div class="card-body p-0"><div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead><tr><th>#</th><th>Code</th><th>Name</th><th>Description</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        <?php if ($rows): foreach ($rows as $i => $r): ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><code><?php echo htmlspecialchars($r['code']); ?></code></td>
                <td><?php echo htmlspecialchars($r['name']); ?></td>
                <td><?php echo htmlspecialchars($r['description']??''); ?></td>
                <td><span class="badge <?php echo $r['status']==='active'?'badge-active':'badge-inactive'; ?>"><?php echo ucfirst($r['status']); ?></span></td>
                <td><a href="?page=institute-types&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a></td>
            </tr>
        <?php endforeach; else: ?><tr><td colspan="6" class="text-center py-4 text-muted">No types found.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div></div></div>
