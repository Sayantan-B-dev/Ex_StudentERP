<?php
// view/subjects/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$departments = $pdo->query("SELECT id, name FROM departments WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("INSERT INTO subjects (name,code,description,credit_hours,theory_hours,practical_hours,subject_type,difficulty_level,department_id,prerequisites,learning_outcomes,status,created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)")
        ->execute([$_POST['name'],$_POST['code'],$_POST['description']??null,$_POST['credit_hours']??3,$_POST['theory_hours']??0,$_POST['practical_hours']??0,$_POST['subject_type']??'core',$_POST['difficulty_level']??'intermediate',$_POST['department_id']?:null,$_POST['prerequisites']??null,$_POST['learning_outcomes']??null,'active',$_SESSION['user_id']]);
    logActivity($pdo, 'Add Subject', 'Academics', "New subject added: $_POST[name] ($_POST[code])");
    $_SESSION['flash'] = 'Subject added.'; header('Location: '.BASE_URL.'/index.php?page=subjects'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-journal-plus me-2" style="color:var(--olive)"></i>Add Subject</h1></div><a href="<?php echo $B; ?>/index.php?page=subjects" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-5"><label class="form-label">Subject Name *</label><input type="text" name="name" class="form-control" required></div>
    <div class="col-md-3"><label class="form-label">Code *</label><input type="text" name="code" class="form-control" required></div>
    <div class="col-md-4"><label class="form-label">Department</label><select name="department_id" class="form-select"><option value="">Select</option><?php foreach ($departments as $d): ?><option value="<?php echo $d['id']; ?>"><?php echo htmlspecialchars($d['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Type</label><select name="subject_type" class="form-select"><?php foreach (['core','elective','lab','project','seminar','workshop'] as $t): ?><option value="<?php echo $t; ?>"><?php echo ucfirst($t); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Difficulty</label><select name="difficulty_level" class="form-select"><?php foreach (['basic','intermediate','advanced'] as $d): ?><option value="<?php echo $d; ?>"><?php echo ucfirst($d); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-2"><label class="form-label">Credits</label><input type="number" name="credit_hours" class="form-control" value="3" step="0.5"></div>
    <div class="col-md-2"><label class="form-label">Theory Hours</label><input type="number" name="theory_hours" class="form-control" value="0"></div>
    <div class="col-md-2"><label class="form-label">Practical Hours</label><input type="number" name="practical_hours" class="form-control" value="0"></div>
    <div class="col-md-6"><label class="form-label">Prerequisites</label><textarea name="prerequisites" class="form-control" rows="2"></textarea></div>
    <div class="col-md-6"><label class="form-label">Learning Outcomes</label><textarea name="learning_outcomes" class="form-control" rows="2"></textarea></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Save Subject</button><a href="<?php echo $B; ?>/index.php?page=subjects" class="btn btn-outline-secondary">Cancel</a></div>
</form>
