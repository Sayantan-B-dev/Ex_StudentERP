<?php
// view/attendance/add.php — Mark Attendance (bulk by batch/subject)
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$batches  = $pdo->query("SELECT id, batch_code, batch_name FROM academic_batches WHERE status='active' ORDER BY batch_code")->fetchAll(PDO::FETCH_ASSOC);
$subjects = $pdo->query("SELECT id, name, code FROM subjects WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

$students_for_batch = [];
$batch_id = $_GET['batch_id'] ?? $_POST['batch_id'] ?? 0;
if ($batch_id) {
    $stmt = $pdo->prepare("SELECT id, admission_number, first_name, last_name FROM students WHERE batch_id=? AND status='active' ORDER BY first_name");
    $stmt->execute([(int)$batch_id]);
    $students_for_batch = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attendance'])) {
    $date       = $_POST['attendance_date'];
    $subject_id = $_POST['subject_id'] ?: null;
    $batch_id_s = (int)$_POST['batch_id'];
    foreach ($_POST['attendance'] as $student_id => $status) {
        // Upsert
        $existing = $pdo->prepare("SELECT id FROM attendance WHERE student_id=? AND attendance_date=? AND subject_id<=>?");
        $existing->execute([(int)$student_id, $date, $subject_id]);
        if ($existing->fetch()) {
            $pdo->prepare("UPDATE attendance SET status=?, batch_id=? WHERE student_id=? AND attendance_date=? AND subject_id<=>?")
                ->execute([$status, $batch_id_s, (int)$student_id, $date, $subject_id]);
        } else {
            $pdo->prepare("INSERT INTO attendance (student_id,subject_id,batch_id,attendance_date,status,marked_by) VALUES (?,?,?,?,?,?)")
                ->execute([(int)$student_id, $subject_id, $batch_id_s, $date, $status, $_SESSION['user_id']]);
        }
    }
    logActivity($pdo, 'Mark Attendance', 'Attendance', "Marked attendance for batch ID: $batch_id_s on $date");
    $_SESSION['flash'] = 'Attendance saved for '.count($_POST['attendance']).' students.';
    header('Location: '.BASE_URL.'/index.php?page=attendance-tracking'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-calendar-plus me-2" style="color:var(--olive)"></i>Mark Attendance</h1></div><a href="<?php echo $B; ?>/index.php?page=attendance-tracking" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<div class="card mb-4"><div class="card-body">
    <form method="GET" class="row g-2 align-items-end" id="batch-select-form">
        <input type="hidden" name="page" value="attendance-add">
        <div class="col-md-4"><label class="form-label">Select Batch *</label><select name="batch_id" class="form-select" onchange="this.form.submit()" required><option value="">Choose Batch</option><?php foreach ($batches as $b): ?><option value="<?php echo $b['id']; ?>" <?php echo $batch_id==$b['id']?'selected':''; ?>><?php echo htmlspecialchars($b['batch_code'].' - '.($b['batch_name']??'')); ?></option><?php endforeach; ?></select></div>
    </form>
</div></div>
<?php if ($batch_id && $students_for_batch): ?>
<form method="POST">
    <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
    <div class="card mb-4"><div class="card-body">
        <div class="row g-3">
            <div class="col-md-4"><label class="form-label">Attendance Date *</label><input type="date" name="attendance_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
            <div class="col-md-4"><label class="form-label">Subject</label><select name="subject_id" class="form-select"><option value="">General / No Subject</option><?php foreach ($subjects as $s): ?><option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['code'].' - '.$s['name']); ?></option><?php endforeach; ?></select></div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="button" class="btn btn-sm btn-outline-success" onclick="setAll('present')">All Present</button>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="setAll('absent')">All Absent</button>
            </div>
        </div>
    </div></div>
    <div class="card"><div class="card-header"><h6 class="mb-0">Students (<?php echo count($students_for_batch); ?>)</h6></div>
    <div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
        <thead><tr><th>#</th><th>Adm. No.</th><th>Student Name</th><th>Status</th></tr></thead>
        <tbody>
        <?php foreach ($students_for_batch as $i => $s): ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><code><?php echo htmlspecialchars($s['admission_number']); ?></code></td>
                <td><?php echo htmlspecialchars($s['first_name'].' '.$s['last_name']); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <?php foreach (['present'=>'outline-success','absent'=>'outline-danger','late'=>'outline-warning','excused'=>'outline-secondary'] as $status => $variant): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input attendance-radio" type="radio" name="attendance[<?php echo $s['id']; ?>]" id="att_<?php echo $s['id'].'_'.$status; ?>" value="<?php echo $status; ?>" <?php echo $status==='present'?'checked':''; ?>>
                            <label class="form-check-label" for="att_<?php echo $s['id'].'_'.$status; ?>"><?php echo ucfirst($status); ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table></div></div>
    <div class="card-footer"><button type="submit" class="btn btn-olive"><i class="bi bi-save me-1"></i>Save Attendance</button></div>
    </div>
</form>
<script>
function setAll(status) {
    document.querySelectorAll('input[type=radio][value="'+status+'"]').forEach(r => r.checked = true);
}
</script>
<?php elseif ($batch_id): ?>
<div class="alert alert-info">No active students in this batch.</div>
<?php else: ?>
<div class="alert alert-secondary">Please select a batch above to mark attendance.</div>
<?php endif; ?>
