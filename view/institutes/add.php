<?php
// view/institutes/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo  = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$types = $pdo->query("SELECT * FROM institute_types WHERE status='active'")->fetchAll(PDO::FETCH_ASSOC);
$errors = []; $old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST;
    if (empty($_POST['name']) || empty($_POST['code'])) $errors[]='Name and Code are required.';
    if (!$errors) {
        $pdo->prepare("INSERT INTO institutes (name,code,type,address,city,state,country,pincode,phone,email,website,established_year,description,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)")
            ->execute([$_POST['name'],$_POST['code'],$_POST['type']??'college',$_POST['address']??null,$_POST['city']??null,$_POST['state']??null,$_POST['country']??'India',$_POST['pincode']??null,$_POST['phone']??null,$_POST['email']??null,$_POST['website']??null,$_POST['established_year']?:null,$_POST['description']??null,'active']);
        $_SESSION['flash'] = 'Institute added.';
        header('Location: '.BASE_URL.'/index.php?page=institutes'); exit;
    }
}
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-building-add me-2" style="color:var(--olive)"></i>Add Institute</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=institutes" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<?php if ($errors): ?><div class="alert alert-danger"><?php foreach ($errors as $e) echo "<div>$e</div>"; ?></div><?php endif; ?>
<form method="POST">
<div class="card mb-4"><div class="card-body">
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Institute Name <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($old['name']??''); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Code <span class="text-danger">*</span></label><input type="text" name="code" class="form-control" value="<?php echo htmlspecialchars($old['code']??''); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Type</label><select name="type" class="form-select">
        <?php foreach (['college','university','school','institute','training_center'] as $t): ?><option value="<?php echo $t; ?>" <?php echo ($old['type']??'')===$t?'selected':''; ?>><?php echo ucfirst(str_replace('_',' ',$t)); ?></option><?php endforeach; ?>
    </select></div>
    <div class="col-md-6"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="2"><?php echo htmlspecialchars($old['address']??''); ?></textarea></div>
    <div class="col-md-3"><label class="form-label">City</label><input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($old['city']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">State</label><input type="text" name="state" class="form-control" value="<?php echo htmlspecialchars($old['state']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Pincode</label><input type="text" name="pincode" class="form-control" value="<?php echo htmlspecialchars($old['pincode']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Country</label><input type="text" name="country" class="form-control" value="<?php echo htmlspecialchars($old['country']??'India'); ?>"></div>
    <div class="col-md-4"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($old['phone']??''); ?>"></div>
    <div class="col-md-4"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($old['email']??''); ?>"></div>
    <div class="col-md-4"><label class="form-label">Website</label><input type="url" name="website" class="form-control" value="<?php echo htmlspecialchars($old['website']??''); ?>"></div>
    <div class="col-md-3"><label class="form-label">Established Year</label><input type="number" name="established_year" class="form-control" value="<?php echo htmlspecialchars($old['established_year']??''); ?>" min="1800" max="<?php echo date('Y'); ?>"></div>
    <div class="col-md-9"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($old['description']??''); ?></textarea></div>
</div>
</div></div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-olive"><i class="bi bi-check2-circle me-1"></i>Save Institute</button>
    <a href="<?php echo $B; ?>/index.php?page=institutes" class="btn btn-outline-secondary">Cancel</a>
</div>
</form>
