<?php
// view/branches/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$institutes = $pdo->query("SELECT id, name FROM institutes WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("INSERT INTO branches (institute_id,name,code,type,address,city,state,country,pincode,phone,email,website,established_year,description,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")
        ->execute([$_POST['institute_id'],$_POST['name'],$_POST['code'],$_POST['type']??'branch',$_POST['address']??null,$_POST['city']??null,$_POST['state']??null,$_POST['country']??'India',$_POST['pincode']??null,$_POST['phone']??null,$_POST['email']??null,$_POST['website']??null,$_POST['established_year']?:null,$_POST['description']??null,'active']);
    $_SESSION['flash'] = 'Branch added.'; header('Location: '.BASE_URL.'/index.php?page=branches'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-sign-merge-left me-2" style="color:var(--olive)"></i>Add Branch</h1></div><a href="<?php echo $B; ?>/index.php?page=branches" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-4"><label class="form-label">Institute *</label><select name="institute_id" class="form-select" required><option value="">Select</option><?php foreach ($institutes as $ins): ?><option value="<?php echo $ins['id']; ?>"><?php echo htmlspecialchars($ins['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-4"><label class="form-label">Branch Name *</label><input type="text" name="name" class="form-control" required></div>
    <div class="col-md-2"><label class="form-label">Code *</label><input type="text" name="code" class="form-control" required></div>
    <div class="col-md-2"><label class="form-label">Type</label><select name="type" class="form-select"><option value="main">Main</option><option value="branch" selected>Branch</option><option value="extension">Extension</option><option value="online">Online</option></select></div>
    <div class="col-md-6"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="2"></textarea></div>
    <div class="col-md-3"><label class="form-label">City</label><input type="text" name="city" class="form-control"></div>
    <div class="col-md-3"><label class="form-label">State</label><input type="text" name="state" class="form-control"></div>
    <div class="col-md-3"><label class="form-label">Pincode</label><input type="text" name="pincode" class="form-control"></div>
    <div class="col-md-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control"></div>
    <div class="col-md-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control"></div>
    <div class="col-md-3"><label class="form-label">Website</label><input type="url" name="website" class="form-control"></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Save Branch</button><a href="<?php echo $B; ?>/index.php?page=branches" class="btn btn-outline-secondary">Cancel</a></div>
</form>
