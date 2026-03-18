<?php
// view/faculty/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM staff WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Staff record deleted.'; header('Location: '.BASE_URL.'/index.php?page=faculty'); exit;
}
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$where = $search ? "WHERE (s.first_name LIKE ? OR s.last_name LIKE ? OR s.email LIKE ? OR s.staff_id LIKE ?)" : "";
$params = $search ? ["%$search%","%$search%","%$search%","%$search%"] : [];
$stmt = $pdo->prepare("SELECT s.*, sc.name AS category_name, sd.name AS designation_name FROM staff s LEFT JOIN staff_categories sc ON s.category_id=sc.id LEFT JOIN staff_designations sd ON s.designation_id=sd.id $where ORDER BY s.first_name");
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-person-badge me-2" style="color:var(--olive)"></i>Faculty & Staff</h1><p class="page-subtitle">Manage teaching and non-teaching staff.</p></div>
    <a href="<?php echo $B; ?>/index.php?page=staff-add" class="btn btn-olive"><i class="bi bi-person-plus me-1"></i>Add Staff</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<?php
$total    = count($rows);
$teaching = count(array_filter($rows, fn($r) => $r['category_name']==='Teaching Staff'));
$active   = count(array_filter($rows, fn($r) => $r['status']==='active'));
?>
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="stat-card" style="background:var(--olive)"><div><h6>Total Staff</h6><h2><?php echo $total; ?></h2></div><i class="bi bi-people-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--maroon)"><div><h6>Teaching</h6><h2><?php echo $teaching; ?></h2></div><i class="bi bi-person-badge-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--charcoal)"><div><h6>Active</h6><h2><?php echo $active; ?></h2></div><i class="bi bi-check-circle-fill stat-icon"></i></div></div>
</div>
<!-- Search -->
<div class="card mb-3"><div class="card-body py-3"><form method="GET" class="d-flex gap-2"><input type="hidden" name="page" value="faculty"><input type="text" name="q" class="form-control" placeholder="Search name, email, ID…" value="<?php echo htmlspecialchars($search); ?>"><button class="btn btn-olive"><i class="bi bi-search"></i></button><a href="<?php echo $B; ?>/index.php?page=faculty" class="btn btn-outline-secondary">Reset</a></form></div></div>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">Staff List <span class="badge bg-secondary"><?php echo count($rows); ?></span></h6><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Filter…" style="width:200px"></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Staff ID</th><th>Name</th><th>Category</th><th>Designation</th><th>Email</th><th>Phone</th><th>Joined</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td><td><code><?php echo htmlspecialchars($r['staff_id']); ?></code></td>
            <td><i class="bi bi-person-circle me-1" style="color:var(--olive)"></i><?php echo htmlspecialchars($r['first_name'].' '.$r['last_name']); ?></td>
            <td><?php echo htmlspecialchars($r['category_name']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['designation_name']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['email']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['phone']??'—'); ?></td>
            <td><?php echo $r['joining_date']??'—'; ?></td>
            <td><span class="badge <?php echo match($r['status']){'active'=>'badge-active','inactive'=>'badge-inactive','suspended'=>'badge-inactive',default=>'badge-pending'}; ?>"><?php echo ucfirst($r['status']); ?></span></td>
            <td>
                <a href="<?php echo $B; ?>/index.php?page=staff-view&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                <a href="<?php echo $B; ?>/index.php?page=staff-edit&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <a href="?page=faculty&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="10" class="text-center py-5 text-muted"><i class="bi bi-person-x fs-2 d-block mb-2"></i>No staff records found.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
