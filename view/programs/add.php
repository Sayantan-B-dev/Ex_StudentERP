<?php
// view/programs/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$departments = $pdo->query("SELECT id, name FROM departments WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("INSERT INTO academic_programs (name,code,description,duration_years,total_credits,department_id,degree_type,program_level,total_semesters,max_students,program_fee,status,created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)")
        ->execute([$_POST['name'],$_POST['code'],$_POST['description']??null,$_POST['duration_years']??4,$_POST['total_credits']??120,$_POST['department_id'],$_POST['degree_type']??'undergraduate',$_POST['program_level']??'bachelor',$_POST['total_semesters']??8,$_POST['max_students']??100,$_POST['program_fee']??0,'active',$_SESSION['user_id']]);
    $_SESSION['flash'] = 'Program added.'; header('Location: '.BASE_URL.'/index.php?page=academic-programs'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-mortarboard me-2" style="color:var(--olive)"></i>Add Program</h1></div><a href="<?php echo $B; ?>/index.php?page=academic-programs" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Program Name *</label><input type="text" name="name" class="form-control" placeholder="e.g. B.Tech Computer Science" required></div>
    <div class="col-md-3"><label class="form-label">Code *</label><input type="text" name="code" class="form-control" placeholder="e.g. BTCS" required></div>
    <div class="col-md-3"><label class="form-label">Department *</label><select name="department_id" class="form-select" required><option value="">Select Department</option><?php foreach ($departments as $d): ?><option value="<?php echo $d['id']; ?>"><?php echo htmlspecialchars($d['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Degree Type</label><select name="degree_type" class="form-select"><?php foreach (['undergraduate','postgraduate','diploma','certificate','phd'] as $v): ?><option value="<?php echo $v; ?>"><?php echo ucfirst($v); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Program Level</label><select name="program_level" class="form-select"><?php foreach (['foundation','diploma','bachelor','master','doctoral'] as $v): ?><option value="<?php echo $v; ?>"><?php echo ucfirst($v); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-2"><label class="form-label">Duration (Yrs)</label><input type="number" name="duration_years" class="form-control" value="4" min="1" max="10"></div>
    <div class="col-md-2"><label class="form-label">Semesters</label><input type="number" name="total_semesters" class="form-control" value="8" min="1" max="12"></div>
    <div class="col-md-2"><label class="form-label">Total Credits</label><input type="number" name="total_credits" class="form-control" value="120" placeholder="e.g. 160"></div>
    <div class="col-md-2"><label class="form-label">Max Students</label><input type="number" name="max_students" class="form-control" value="100" placeholder="e.g. 60"></div>
    <div class="col-md-3"><label class="form-label">Program Fee (₹)</label><input type="number" name="program_fee" class="form-control" value="0" step="0.01" placeholder="Total Course Fee"></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3" placeholder="Overview of the course and objectives..."></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Save Program</button><a href="<?php echo $B; ?>/index.php?page=academic-programs" class="btn btn-outline-secondary">Cancel</a></div>
</form>

<div class="form-help-card">
    <h6><i class="bi bi-info-circle me-2"></i>Academic Program Help</h6>
    <div class="form-help-grid">
        <div class="help-item"><b>Program Code</b><span>Short identifier (e.g., BSC, MTECH). Used in student IDs.</span></div>
        <div class="help-item"><b>Degree Type</b><span>Broad classification (UG, PG, PhD).</span></div>
        <div class="help-item"><b>Total Credits</b><span>Total credit weight required to graduate from this program.</span></div>
    </div>
</div>
