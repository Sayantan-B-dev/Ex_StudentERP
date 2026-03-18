<?php
// view/institutes/type_add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("INSERT INTO institute_types (name,code,description,status) VALUES (?,?,?,?)")
        ->execute([$_POST['name'],$_POST['code'],$_POST['description']??null,'active']);
    $_SESSION['flash'] = 'Institute type added.';
    header('Location: '.BASE_URL.'/index.php?page=institute-types'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-tag me-2" style="color:var(--olive)"></i>Add Institute Type</h1></div>
<a href="<?php echo $B; ?>/index.php?page=institute-types" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card"><div class="card-body"><div class="row g-3">
    <div class="col-md-5"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" required></div>
    <div class="col-md-3"><label class="form-label">Code *</label><input type="text" name="code" class="form-control" required></div>
    <div class="col-md-4"><label class="form-label">Description</label><input type="text" name="description" class="form-control"></div>
</div></div></div>
<div class="mt-3 d-flex gap-2"><button type="submit" class="btn btn-olive">Save</button><a href="<?php echo $B; ?>/index.php?page=institute-types" class="btn btn-outline-secondary">Cancel</a></div>
</form>
