<?php
// view/programs/edit.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0); $stmt = $pdo->prepare("SELECT * FROM academic_programs WHERE id=?"); $stmt->execute([$id]); $t = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$t) { echo '<div class="alert alert-danger">Program not found.</div>'; return; }
$departments = $pdo->query("SELECT id, name FROM departments ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("UPDATE academic_programs SET name=?,code=?,description=?,duration_years=?,total_credits=?,department_id=?,degree_type=?,program_level=?,total_semesters=?,max_students=?,program_fee=?,status=? WHERE id=?")
        ->execute([$_POST['name'],$_POST['code'],$_POST['description']??null,$_POST['duration_years'],$_POST['total_credits'],$_POST['department_id'],$_POST['degree_type'],$_POST['program_level'],$_POST['total_semesters'],$_POST['max_students'],$_POST['program_fee'],$_POST['status']??'active',$id]);
    $_SESSION['flash'] = 'Program updated.'; header('Location: '.BASE_URL.'/index.php?page=academic-programs'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-pencil me-2" style="color:var(--olive)"></i>Edit Program</h1></div><a href="<?php echo $B; ?>/index.php?page=academic-programs" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($t['name']); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Code *</label><input type="text" name="code" class="form-control" value="<?php echo htmlspecialchars($t['code']); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Department</label><select name="department_id" class="form-select"><?php foreach ($departments as $d): ?><option value="<?php echo $d['id']; ?>" <?php echo $t['department_id']==$d['id']?'selected':''; ?>><?php echo htmlspecialchars($d['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Degree Type</label><select name="degree_type" class="form-select"><?php foreach (['undergraduate','postgraduate','diploma','certificate','phd'] as $v): ?><option value="<?php echo $v; ?>" <?php echo $t['degree_type']===$v?'selected':''; ?>><?php echo ucfirst($v); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Level</label><select name="program_level" class="form-select"><?php foreach (['foundation','diploma','bachelor','master','doctoral'] as $v): ?><option value="<?php echo $v; ?>" <?php echo $t['program_level']===$v?'selected':''; ?>><?php echo ucfirst($v); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-2"><label class="form-label">Duration</label><input type="number" name="duration_years" class="form-control" value="<?php echo $t['duration_years']; ?>"></div>
    <div class="col-md-2"><label class="form-label">Semesters</label><input type="number" name="total_semesters" class="form-control" value="<?php echo $t['total_semesters']; ?>"></div>
    <div class="col-md-2"><label class="form-label">Credits</label><input type="number" name="total_credits" class="form-control" value="<?php echo $t['total_credits']; ?>"></div>
    <div class="col-md-2"><label class="form-label">Max Students</label><input type="number" name="max_students" class="form-control" value="<?php echo $t['max_students']; ?>"></div>
    <div class="col-md-3"><label class="form-label">Fee (₹)</label><input type="number" name="program_fee" class="form-control" value="<?php echo $t['program_fee']; ?>" step="0.01"></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select"><?php foreach (['active','inactive','draft'] as $s): ?><option value="<?php echo $s; ?>" <?php echo $t['status']===$s?'selected':''; ?>><?php echo ucfirst($s); ?></option><?php endforeach; ?></select></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($t['description']??''); ?></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Update</button><a href="<?php echo $B; ?>/index.php?page=academic-programs" class="btn btn-outline-secondary">Cancel</a></div>
</form>
