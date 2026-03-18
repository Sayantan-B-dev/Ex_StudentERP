<?php
// view/subjects/edit.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0); $stmt = $pdo->prepare("SELECT * FROM subjects WHERE id=?"); $stmt->execute([$id]); $t = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$t) { echo '<div class="alert alert-danger">Subject not found.</div>'; return; }
$departments = $pdo->query("SELECT id, name FROM departments ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("UPDATE subjects SET name=?,code=?,description=?,credit_hours=?,theory_hours=?,practical_hours=?,subject_type=?,difficulty_level=?,department_id=?,prerequisites=?,learning_outcomes=?,status=? WHERE id=?")
        ->execute([$_POST['name'],$_POST['code'],$_POST['description']??null,$_POST['credit_hours'],$_POST['theory_hours'],$_POST['practical_hours'],$_POST['subject_type'],$_POST['difficulty_level'],$_POST['department_id']?:null,$_POST['prerequisites']??null,$_POST['learning_outcomes']??null,$_POST['status']??'active',$id]);
    $_SESSION['flash'] = 'Subject updated.'; header('Location: '.BASE_URL.'/index.php?page=subjects'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-pencil me-2" style="color:var(--olive)"></i>Edit Subject</h1></div><a href="<?php echo $B; ?>/index.php?page=subjects" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-5"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($t['name']); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Code *</label><input type="text" name="code" class="form-control" value="<?php echo htmlspecialchars($t['code']); ?>" required></div>
    <div class="col-md-4"><label class="form-label">Department</label><select name="department_id" class="form-select"><option value="">None</option><?php foreach ($departments as $d): ?><option value="<?php echo $d['id']; ?>" <?php echo $t['department_id']==$d['id']?'selected':''; ?>><?php echo htmlspecialchars($d['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Type</label><select name="subject_type" class="form-select"><?php foreach (['core','elective','lab','project','seminar','workshop'] as $tp): ?><option value="<?php echo $tp; ?>" <?php echo $t['subject_type']===$tp?'selected':''; ?>><?php echo ucfirst($tp); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Difficulty</label><select name="difficulty_level" class="form-select"><?php foreach (['basic','intermediate','advanced'] as $dl): ?><option value="<?php echo $dl; ?>" <?php echo $t['difficulty_level']===$dl?'selected':''; ?>><?php echo ucfirst($dl); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-2"><label class="form-label">Credits</label><input type="number" name="credit_hours" class="form-control" value="<?php echo $t['credit_hours']; ?>" step="0.5"></div>
    <div class="col-md-2"><label class="form-label">Theory Hrs</label><input type="number" name="theory_hours" class="form-control" value="<?php echo $t['theory_hours']; ?>"></div>
    <div class="col-md-2"><label class="form-label">Practical Hrs</label><input type="number" name="practical_hours" class="form-control" value="<?php echo $t['practical_hours']; ?>"></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" <?php echo $t['status']==='active'?'selected':''; ?>>Active</option><option value="inactive" <?php echo $t['status']==='inactive'?'selected':''; ?>>Inactive</option></select></div>
    <div class="col-md-6"><label class="form-label">Prerequisites</label><textarea name="prerequisites" class="form-control" rows="2"><?php echo htmlspecialchars($t['prerequisites']??''); ?></textarea></div>
    <div class="col-md-6"><label class="form-label">Learning Outcomes</label><textarea name="learning_outcomes" class="form-control" rows="2"><?php echo htmlspecialchars($t['learning_outcomes']??''); ?></textarea></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($t['description']??''); ?></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Update</button><a href="<?php echo $B; ?>/index.php?page=subjects" class="btn btn-outline-secondary">Cancel</a></div>
</form>
