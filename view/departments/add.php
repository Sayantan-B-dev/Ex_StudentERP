<?php
// view/departments/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$institutes = $pdo->query("SELECT id, name FROM institutes WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("INSERT INTO departments (institute_id,name,code,type,head_of_department,email,phone,description,status) VALUES (?,?,?,?,?,?,?,?,?)")
        ->execute([$_POST['institute_id'],$_POST['name'],$_POST['code'],$_POST['type']??'academic',$_POST['hod']??null,$_POST['email']??null,$_POST['phone']??null,$_POST['description']??null,'active']);
    $_SESSION['flash'] = 'Department added.'; header('Location: '.BASE_URL.'/index.php?page=departments'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-diagram-3 me-2" style="color:var(--olive)"></i>Add Department</h1></div><a href="<?php echo $B; ?>/index.php?page=departments" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-4"><label class="form-label">Institute *</label><select name="institute_id" class="form-select" required><option value="">Select</option><?php foreach ($institutes as $ins): ?><option value="<?php echo $ins['id']; ?>"><?php echo htmlspecialchars($ins['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-5"><label class="form-label">Department Name *</label><input type="text" name="name" class="form-control" required></div>
    <div class="col-md-3"><label class="form-label">Code *</label><input type="text" name="code" class="form-control" required></div>
    <div class="col-md-3"><label class="form-label">Type</label><select name="type" class="form-select"><option value="academic">Academic</option><option value="administrative">Administrative</option><option value="support">Support</option></select></div>
    <div class="col-md-3"><label class="form-label">Head of Dept.</label><input type="text" name="hod" class="form-control"></div>
    <div class="col-md-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control"></div>
    <div class="col-md-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control"></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Save</button><a href="<?php echo $B; ?>/index.php?page=departments" class="btn btn-outline-secondary">Cancel</a></div>
</form>
