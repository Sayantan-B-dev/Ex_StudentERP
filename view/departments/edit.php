<?php
// view/departments/edit.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM departments WHERE id=?"); $stmt->execute([$id]);
$t = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$t) { echo '<div class="alert alert-danger">Not found.</div>'; return; }
$institutes = $pdo->query("SELECT id, name FROM institutes ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("UPDATE departments SET institute_id=?,name=?,code=?,type=?,head_of_department=?,email=?,phone=?,description=?,status=? WHERE id=?")
        ->execute([$_POST['institute_id'],$_POST['name'],$_POST['code'],$_POST['type'],$_POST['hod']??null,$_POST['email']??null,$_POST['phone']??null,$_POST['description']??null,$_POST['status']??'active',$id]);
    $_SESSION['flash'] = 'Department updated.'; header('Location: '.BASE_URL.'/index.php?page=departments'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-pencil me-2" style="color:var(--olive)"></i>Edit Department</h1></div><a href="<?php echo $B; ?>/index.php?page=departments" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-4"><label class="form-label">Institute</label><select name="institute_id" class="form-select"><?php foreach ($institutes as $ins): ?><option value="<?php echo $ins['id']; ?>" <?php echo $t['institute_id']==$ins['id']?'selected':''; ?>><?php echo htmlspecialchars($ins['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-5"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($t['name']); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Code</label><input type="text" name="code" class="form-control" value="<?php echo htmlspecialchars($t['code']); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Type</label><select name="type" class="form-select"><?php foreach (['academic','administrative','support'] as $tp): ?><option value="<?php echo $tp; ?>" <?php echo $t['type']===$tp?'selected':''; ?>><?php echo ucfirst($tp); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">HOD</label><input type="text" name="hod" class="form-control" value="<?php echo htmlspecialchars($t['head_of_department']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($t['email']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" <?php echo $t['status']==='active'?'selected':''; ?>>Active</option><option value="inactive" <?php echo $t['status']==='inactive'?'selected':''; ?>>Inactive</option></select></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($t['description']??''); ?></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Update</button><a href="<?php echo $B; ?>/index.php?page=departments" class="btn btn-outline-secondary">Cancel</a></div>
</form>
