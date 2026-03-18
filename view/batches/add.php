<?php
// view/batches/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$programs = $pdo->query("SELECT id, name, code FROM academic_programs WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("INSERT INTO academic_batches (program_id,batch_year,batch_code,batch_name,start_date,end_date,current_semester,max_capacity,status,created_by) VALUES (?,?,?,?,?,?,?,?,?,?)")
        ->execute([$_POST['program_id'],$_POST['batch_year'],$_POST['batch_code'],$_POST['batch_name']??null,$_POST['start_date'],$_POST['end_date']??null,$_POST['current_semester']??1,$_POST['max_capacity']??60,'active',$_SESSION['user_id']]);
    $_SESSION['flash'] = 'Batch added.'; header('Location: '.BASE_URL.'/index.php?page=batch-management'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-grid-3x3-gap me-2" style="color:var(--olive)"></i>Add Batch</h1></div><a href="<?php echo $B; ?>/index.php?page=batch-management" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-4"><label class="form-label">Program *</label><select name="program_id" class="form-select" required><option value="">Select Program</option><?php foreach ($programs as $p): ?><option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['code'].' - '.$p['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Batch Code *</label><input type="text" name="batch_code" class="form-control" required placeholder="e.g. DIP1-2025"></div>
    <div class="col-md-3"><label class="form-label">Batch Name</label><input type="text" name="batch_name" class="form-control" placeholder="e.g. Diploma CST 2025"></div>
    <div class="col-md-2"><label class="form-label">Batch Year *</label><input type="number" name="batch_year" class="form-control" value="<?php echo date('Y'); ?>" min="2000" max="<?php echo date('Y')+5; ?>" required></div>
    <div class="col-md-3"><label class="form-label">Start Date *</label><input type="date" name="start_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
    <div class="col-md-3"><label class="form-label">End Date</label><input type="date" name="end_date" class="form-control"></div>
    <div class="col-md-2"><label class="form-label">Current Semester</label><input type="number" name="current_semester" class="form-control" value="1" min="1" max="12"></div>
    <div class="col-md-2"><label class="form-label">Max Capacity</label><input type="number" name="max_capacity" class="form-control" value="60"></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive">Save Batch</button><a href="<?php echo $B; ?>/index.php?page=batch-management" class="btn btn-outline-secondary">Cancel</a></div>
</form>
