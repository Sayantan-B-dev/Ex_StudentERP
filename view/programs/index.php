<?php
// view/programs/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM academic_programs WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Program deleted.'; header('Location: '.BASE_URL.'/index.php?page=academic-programs'); exit;
}
$rows = $pdo->query("SELECT p.*, d.name AS dept_name FROM academic_programs p LEFT JOIN departments d ON p.department_id=d.id ORDER BY p.name")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-mortarboard me-2" style="color:var(--olive)"></i>Academic Programs</h1><p class="page-subtitle">Manage degree programs and courses.</p></div>
    <a href="<?php echo $B; ?>/index.php?page=program-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Add Program</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<!-- Summary -->
<div class="row g-3 mb-4">
    <?php
    $total  = count($rows);
    $active = count(array_filter($rows, fn($r) => $r['status']==='active'));
    ?>
    <div class="col-md-3"><div class="stat-card" style="background:var(--olive)"><div><h6>Total Programs</h6><h2><?php echo $total; ?></h2></div><i class="bi bi-mortarboard-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--maroon)"><div><h6>Active</h6><h2><?php echo $active; ?></h2></div><i class="bi bi-check-circle-fill stat-icon"></i></div></div>
</div>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">All Programs</h6><div class="d-flex"><select id="tableFilter" class="form-select form-select-sm me-2" style="width:120px"><option value="">All</option><option value="active">Active</option><option value="inactive">Inactive</option></select><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px"></div></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Code</th><th>Name</th><th>Degree</th><th>Department</th><th>Duration</th><th>Fee</th><th>Students</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td><td><code><?php echo htmlspecialchars($r['code']); ?></code></td>
            <td><strong><?php echo htmlspecialchars($r['name']); ?></strong></td>
            <td><?php echo ucfirst($r['degree_type']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['dept_name']??'—'); ?></td>
            <td><?php echo $r['duration_years']; ?> yrs</td>
            <td>₹<?php echo number_format($r['program_fee']); ?></td>
            <td><?php echo $r['current_students']; ?>/<?php echo $r['max_students']; ?></td>
            <td><span class="badge <?php echo $r['status']==='active'?'badge-active':($r['status']==='inactive'?'badge-inactive':'badge-pending'); ?>"><?php echo ucfirst($r['status']); ?></span></td>
            <td>
                <a href="<?php echo $B; ?>/index.php?page=program-edit&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <a href="?page=academic-programs&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="10" class="text-center py-5 text-muted">No programs found.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
