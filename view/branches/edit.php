<?php
// view/branches/edit.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0); $stmt = $pdo->prepare("SELECT * FROM branches WHERE id=?"); $stmt->execute([$id]); $t = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$t) { echo '<div class="alert alert-danger">Branch not found.</div>'; return; }
$institutes = $pdo->query("SELECT id, name FROM institutes ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("UPDATE branches SET institute_id=?,name=?,code=?,type=?,address=?,city=?,state=?,country=?,pincode=?,phone=?,email=?,website=?,status=? WHERE id=?")
        ->execute([$_POST['institute_id'],$_POST['name'],$_POST['code'],$_POST['type'],$_POST['address']??null,$_POST['city']??null,$_POST['state']??null,$_POST['country']??'India',$_POST['pincode']??null,$_POST['phone']??null,$_POST['email']??null,$_POST['website']??null,$_POST['status']??'active',$id]);
    $_SESSION['flash'] = 'Branch updated.'; header('Location: '.BASE_URL.'/index.php?page=branches'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-pencil me-2" style="color:var(--olive)"></i>Edit Branch</h1></div><a href="<?php echo $B; ?>/index.php?page=branches" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-4"><label class="form-label">Institute</label><select name="institute_id" class="form-select"><?php foreach ($institutes as $ins): ?><option value="<?php echo $ins['id']; ?>" <?php echo $t['institute_id']==$ins['id']?'selected':''; ?>><?php echo htmlspecialchars($ins['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-4"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($t['name']); ?>" required></div>
    <div class="col-md-2"><label class="form-label">Code</label><input type="text" name="code" class="form-control" value="<?php echo htmlspecialchars($t['code']); ?>" required></div>
    <div class="col-md-2"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" <?php echo $t['status']==='active'?'selected':''; ?>>Active</option><option value="inactive" <?php echo $t['status']==='inactive'?'selected':''; ?>>Inactive</option></select></div>
    <div class="col-md-6"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="2"><?php echo htmlspecialchars($t['address']??''); ?></textarea></div>
    <div class="col-md-3"><label class="form-label">City</label><input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($t['city']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">State</label><input type="text" name="state" class="form-control" value="<?php echo htmlspecialchars($t['state']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Pincode</label><input type="text" name="pincode" class="form-control" value="<?php echo htmlspecialchars($t['pincode']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($t['phone']??''); ?>"></div>
    <div class="col-md-4"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($t['email']??''); ?>"></div>
    <div class="col-md-4"><label class="form-label">Website</label><input type="url" name="website" class="form-control" value="<?php echo htmlspecialchars($t['website']??''); ?>"></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Update</button><a href="<?php echo $B; ?>/index.php?page=branches" class="btn btn-outline-secondary">Cancel</a></div>
</form>
