<?php
// view/batches/edit.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0); $stmt = $pdo->prepare("SELECT * FROM academic_batches WHERE id=?"); $stmt->execute([$id]); $t = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$t) { echo '<div class="alert alert-danger">Batch not found.</div>'; return; }
$programs = $pdo->query("SELECT id, name, code FROM academic_programs ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("UPDATE academic_batches SET program_id=?,batch_year=?,batch_code=?,batch_name=?,start_date=?,end_date=?,current_semester=?,max_capacity=?,status=? WHERE id=?")
        ->execute([$_POST['program_id'],$_POST['batch_year'],$_POST['batch_code'],$_POST['batch_name']??null,$_POST['start_date'],$_POST['end_date']??null,$_POST['current_semester'],$_POST['max_capacity'],$_POST['status']??'active',$id]);
    $_SESSION['flash'] = 'Batch updated.'; header('Location: '.BASE_URL.'/index.php?page=batch-management'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-pencil me-2" style="color:var(--olive)"></i>Edit Batch</h1></div><a href="<?php echo $B; ?>/index.php?page=batch-management" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-4"><label class="form-label">Program</label><select name="program_id" class="form-select"><?php foreach ($programs as $p): ?><option value="<?php echo $p['id']; ?>" <?php echo $t['program_id']==$p['id']?'selected':''; ?>><?php echo htmlspecialchars($p['code'].' - '.$p['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Batch Code</label><input type="text" name="batch_code" class="form-control" value="<?php echo htmlspecialchars($t['batch_code']); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Batch Name</label><input type="text" name="batch_name" class="form-control" value="<?php echo htmlspecialchars($t['batch_name']??''); ?>"></div>
    <div class="col-md-2"><label class="form-label">Year</label><input type="number" name="batch_year" class="form-control" value="<?php echo $t['batch_year']; ?>"></div>
    <div class="col-md-3"><label class="form-label">Start Date</label><input type="date" name="start_date" class="form-control" value="<?php echo $t['start_date']; ?>"></div>
    <div class="col-md-3"><label class="form-label">End Date</label><input type="date" name="end_date" class="form-control" value="<?php echo $t['end_date']??''; ?>"></div>
    <div class="col-md-2"><label class="form-label">Semester</label><input type="number" name="current_semester" class="form-control" value="<?php echo $t['current_semester']; ?>"></div>
    <div class="col-md-2"><label class="form-label">Max Capacity</label><input type="number" name="max_capacity" class="form-control" value="<?php echo $t['max_capacity']; ?>"></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select"><?php foreach (['active','completed','upcoming','cancelled'] as $s): ?><option value="<?php echo $s; ?>" <?php echo $t['status']===$s?'selected':''; ?>><?php echo ucfirst($s); ?></option><?php endforeach; ?></select></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Update</button><a href="<?php echo $B; ?>/index.php?page=batch-management" class="btn btn-outline-secondary">Cancel</a></div>
</form>
