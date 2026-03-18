<?php
// view/faculty/designations.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM staff_designations WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Designation deleted.'; header('Location: '.BASE_URL.'/index.php?page=staff-designations'); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("INSERT INTO staff_designations (name,code,description,grade_level,salary_min,salary_max,status) VALUES (?,?,?,?,?,?,?)")
        ->execute([$_POST['name'],$_POST['code'],$_POST['description']??null,$_POST['grade_level']??null,$_POST['salary_min']??null,$_POST['salary_max']??null,'active']);
    $_SESSION['flash'] = 'Designation added.'; header('Location: '.BASE_URL.'/index.php?page=staff-designations'); exit;
}
$rows = $pdo->query("SELECT * FROM staff_designations ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-award me-2" style="color:var(--olive)"></i>Staff Designations</h1></div></div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="row g-4">
    <div class="col-md-4"><div class="card"><div class="card-header"><h6 class="mb-0">Add Designation</h6></div><div class="card-body">
        <form method="POST">
            <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Code *</label><input type="text" name="code" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Grade Level</label><input type="text" name="grade_level" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Salary Min</label><input type="number" name="salary_min" class="form-control" step="0.01"></div>
            <div class="mb-3"><label class="form-label">Salary Max</label><input type="number" name="salary_max" class="form-control" step="0.01"></div>
            <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
            <button type="submit" class="btn btn-olive w-100">Add Designation</button>
        </form>
    </div></div></div>
    <div class="col-md-8"><div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
        <thead><tr><th>#</th><th>Code</th><th>Name</th><th>Grade</th><th>Salary Range</th><th>Actions</th></tr></thead>
        <tbody>
        <?php if ($rows): foreach ($rows as $i => $r): ?>
            <tr><td><?php echo $i+1; ?></td><td><code><?php echo htmlspecialchars($r['code']); ?></code></td><td><?php echo htmlspecialchars($r['name']); ?></td><td><?php echo htmlspecialchars($r['grade_level']??'—'); ?></td>
            <td>₹<?php echo number_format($r['salary_min']??0); ?> – ₹<?php echo number_format($r['salary_max']??0); ?></td>
            <td><a href="?page=staff-designations&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a></td></tr>
        <?php endforeach; else: ?><tr><td colspan="6" class="text-center py-4 text-muted">No designations.</td></tr><?php endif; ?>
        </tbody>
    </table></div></div></div></div>
</div>
