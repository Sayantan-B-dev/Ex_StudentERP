<?php
// view/institutes/edit.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM institutes WHERE id=?"); $stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) { echo '<div class="alert alert-danger">Institute not found.</div>'; return; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("UPDATE institutes SET name=?,code=?,type=?,address=?,city=?,state=?,country=?,pincode=?,phone=?,email=?,website=?,established_year=?,description=?,status=? WHERE id=?")
        ->execute([$_POST['name'],$_POST['code'],$_POST['type']??'college',$_POST['address']??null,$_POST['city']??null,$_POST['state']??null,$_POST['country']??'India',$_POST['pincode']??null,$_POST['phone']??null,$_POST['email']??null,$_POST['website']??null,$_POST['established_year']?:null,$_POST['description']??null,$_POST['status']??'active',$id]);
    $_SESSION['flash'] = 'Institute updated.';
    header('Location: '.BASE_URL.'/index.php?page=institutes'); exit;
}
$B = BASE_URL; $t = $row;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-pencil me-2" style="color:var(--olive)"></i>Edit Institute</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=institutes" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($t['name']); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Code</label><input type="text" name="code" class="form-control" value="<?php echo htmlspecialchars($t['code']); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Type</label><select name="type" class="form-select"><?php foreach (['college','university','school','institute','training_center'] as $tp): ?><option value="<?php echo $tp; ?>" <?php echo $t['type']===$tp?'selected':''; ?>><?php echo ucfirst(str_replace('_',' ',$tp)); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-6"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="2"><?php echo htmlspecialchars($t['address']??''); ?></textarea></div>
    <div class="col-md-3"><label class="form-label">City</label><input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($t['city']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">State</label><input type="text" name="state" class="form-control" value="<?php echo htmlspecialchars($t['state']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Pincode</label><input type="text" name="pincode" class="form-control" value="<?php echo htmlspecialchars($t['pincode']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Country</label><input type="text" name="country" class="form-control" value="<?php echo htmlspecialchars($t['country']??'India'); ?>"></div>
    <div class="col-md-4"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($t['phone']??''); ?>"></div>
    <div class="col-md-4"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($t['email']??''); ?>"></div>
    <div class="col-md-4"><label class="form-label">Website</label><input type="url" name="website" class="form-control" value="<?php echo htmlspecialchars($t['website']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Est. Year</label><input type="number" name="established_year" class="form-control" value="<?php echo $t['established_year']??''; ?>"></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" <?php echo $t['status']==='active'?'selected':''; ?>>Active</option><option value="inactive" <?php echo $t['status']==='inactive'?'selected':''; ?>>Inactive</option></select></div>
    <div class="col-md-6"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($t['description']??''); ?></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive"><i class="bi bi-check2-circle me-1"></i>Update</button><a href="<?php echo $B; ?>/index.php?page=institutes" class="btn btn-outline-secondary">Cancel</a></div>
</form>
