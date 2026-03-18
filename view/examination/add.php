<?php
// view/examination/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$programs = $pdo->query("SELECT id, name, code FROM academic_programs WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$batches  = $pdo->query("SELECT id, batch_code FROM academic_batches WHERE status='active' ORDER BY batch_code")->fetchAll(PDO::FETCH_ASSOC);
$subjects = $pdo->query("SELECT id, name, code FROM subjects WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$id = (int)($_GET['id'] ?? 0);
$edit = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM examinations WHERE id=?");
    $stmt->execute([$id]);
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id) {
        $pdo->prepare("UPDATE examinations SET name=?,exam_type=?,program_id=?,batch_id=?,semester=?,academic_year=?,exam_date=?,start_time=?,end_time=?,duration_minutes=?,total_marks=?,passing_marks=?,exam_venue=?,description=?,status=? WHERE id=?")
            ->execute([$_POST['name'],$_POST['exam_type']??'internal',$_POST['program_id']?:null,$_POST['batch_id']?:null,(int)$_POST['semester']??1,$_POST['academic_year'],$_POST['exam_date']??null,$_POST['start_time']??null,$_POST['end_time']??null,(int)$_POST['duration_minutes']??60,(int)$_POST['total_marks']??100,(int)$_POST['passing_marks']??35,$_POST['exam_venue']??null,$_POST['description']??null,$_POST['status']??'scheduled',$id]);
        logActivity($pdo, 'Update Exam', 'Exams', "Updated exam schedule: $_POST[name] (ID: $id)");
        $_SESSION['flash'] = 'Exam updated.';
    } else {
        $pdo->prepare("INSERT INTO examinations (name,exam_type,program_id,batch_id,semester,academic_year,exam_date,start_time,end_time,duration_minutes,total_marks,passing_marks,exam_venue,description,status,created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")
            ->execute([$_POST['name'],$_POST['exam_type']??'internal',$_POST['program_id']?:null,$_POST['batch_id']?:null,(int)$_POST['semester']??1,$_POST['academic_year'],$_POST['exam_date']??null,$_POST['start_time']??null,$_POST['end_time']??null,(int)$_POST['duration_minutes']??60,(int)$_POST['total_marks']??100,(int)$_POST['passing_marks']??35,$_POST['exam_venue']??null,$_POST['description']??null,'scheduled',$_SESSION['user_id']]);
        logActivity($pdo, 'Add Exam', 'Exams', "Scheduled new exam: $_POST[name]");
        $_SESSION['flash'] = 'Exam scheduled.';
    }
    header('Location: '.BASE_URL.'/index.php?page=examination-management'); exit;
}
$B = BASE_URL; $t = $edit ?: [];
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-pencil-square me-2" style="color:var(--olive)"></i><?php echo $id?'Edit':'Schedule'; ?> Exam</h1></div><a href="<?php echo $B; ?>/index.php?page=examination-management" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Exam Name *</label><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($t['name']??''); ?>" required></div>
    <div class="col-md-3"><label class="form-label">Exam Type</label><select name="exam_type" class="form-select"><?php foreach (['internal'=>'Internal','external'=>'External','practical'=>'Practical','viva'=>'Viva','midterm'=>'Midterm','final'=>'Final'] as $v=>$l): ?><option value="<?php echo $v; ?>" <?php echo ($t['exam_type']??'')===$v?'selected':''; ?>><?php echo $l; ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Academic Year</label><input type="text" name="academic_year" class="form-control" value="<?php echo htmlspecialchars($t['academic_year']??(date('Y').'-'.date('Y',strtotime('+1 year')))); ?>"></div>
    <div class="col-md-4"><label class="form-label">Program</label><select name="program_id" class="form-select"><option value="">All Programs</option><?php foreach ($programs as $p): ?><option value="<?php echo $p['id']; ?>" <?php echo ($t['program_id']??0)==$p['id']?'selected':''; ?>><?php echo htmlspecialchars($p['code'].' - '.$p['name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-4"><label class="form-label">Batch</label><select name="batch_id" class="form-select"><option value="">All Batches</option><?php foreach ($batches as $b): ?><option value="<?php echo $b['id']; ?>" <?php echo ($t['batch_id']??0)==$b['id']?'selected':''; ?>><?php echo htmlspecialchars($b['batch_code']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-2"><label class="form-label">Semester</label><select name="semester" class="form-select"><?php for($i=1;$i<=8;$i++): ?><option value="<?php echo $i; ?>" <?php echo ($t['semester']??1)==$i?'selected':''; ?>>Sem <?php echo $i; ?></option><?php endfor; ?></select></div>
    <div class="col-md-3"><label class="form-label">Exam Date</label><input type="date" name="exam_date" class="form-control" value="<?php echo $t['exam_date']??''; ?>"></div>
    <div class="col-md-3"><label class="form-label">Start Time</label><input type="time" name="start_time" class="form-control" value="<?php echo $t['start_time']??''; ?>"></div>
    <div class="col-md-3"><label class="form-label">End Time</label><input type="time" name="end_time" class="form-control" value="<?php echo $t['end_time']??''; ?>"></div>
    <div class="col-md-3"><label class="form-label">Duration (min)</label><input type="number" name="duration_minutes" class="form-control" value="<?php echo $t['duration_minutes']??60; ?>"></div>
    <div class="col-md-3"><label class="form-label">Total Marks</label><input type="number" name="total_marks" class="form-control" value="<?php echo $t['total_marks']??100; ?>"></div>
    <div class="col-md-3"><label class="form-label">Passing Marks</label><input type="number" name="passing_marks" class="form-control" value="<?php echo $t['passing_marks']??35; ?>"></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select"><?php foreach (['scheduled','completed','cancelled','upcoming'] as $st): ?><option value="<?php echo $st; ?>" <?php echo ($t['status']??'')===$st?'selected':''; ?>><?php echo ucfirst($st); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Venue / Room</label><input type="text" name="exam_venue" class="form-control" value="<?php echo htmlspecialchars($t['exam_venue']??''); ?>"></div>
    <div class="col-12"><label class="form-label">Description / Instructions</label><textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($t['description']??''); ?></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive"><i class="bi bi-check2-circle me-1"></i><?php echo $id?'Update':'Save'; ?> Exam</button><a href="<?php echo $B; ?>/index.php?page=examination-management" class="btn btn-outline-secondary">Cancel</a></div>
</form>
