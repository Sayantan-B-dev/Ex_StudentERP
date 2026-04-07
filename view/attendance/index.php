<?php
// view/attendance/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$date_filter  = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$batch_filter = isset($_GET['batch_id']) ? (int)$_GET['batch_id'] : 0;
$batches = $pdo->query("SELECT id, batch_code, batch_name FROM academic_batches WHERE status='active' ORDER BY batch_code")->fetchAll(PDO::FETCH_ASSOC);

$where = "WHERE DATE(a.attendance_date)=?";
$params = [$date_filter];
if ($batch_filter) { $where .= " AND a.batch_id=?"; $params[] = $batch_filter; }

$stmt = $pdo->prepare("SELECT a.*, CONCAT(s.first_name,' ',s.last_name) AS student_name, s.admission_number, sub.name AS subject_name, b.batch_code FROM attendance a
    JOIN students s ON a.student_id=s.id LEFT JOIN subjects sub ON a.subject_id=sub.id LEFT JOIN academic_batches b ON a.batch_id=b.id
    $where ORDER BY a.attendance_date DESC, a.created_at DESC");
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total   = count($rows);
$present = count(array_filter($rows, fn($r) => $r['status']==='present'));
$absent  = count(array_filter($rows, fn($r) => $r['status']==='absent'));
$late    = count(array_filter($rows, fn($r) => $r['status']==='late'));
$B = BASE_URL;

// Batch Report Logic
if (isset($_GET['download']) && $batch_filter) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Attendance_Batch_'.$batch_filter.'_'.date('Y-m-d').'.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['Date', 'Adm No', 'Student', 'Subject', 'Status', 'Remarks']);
    foreach ($rows as $r) {
        fputcsv($out, [$r['attendance_date'], $r['admission_number'], $r['student_name'], $r['subject_name']??'N/A', $r['status'], $r['remarks']??'']);
    }
    fclose($out);
    exit;
}
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-calendar-check me-2" style="color:var(--olive)"></i>Attendance Tracking</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=attendance-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Mark Attendance</a>
</div>
<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="stat-card" style="background:var(--olive)"><div><h6>Total Records</h6><h2><?php echo $total; ?></h2></div><i class="bi bi-person-lines-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:#27ae60"><div><h6>Present</h6><h2><?php echo $present; ?></h2></div><i class="bi bi-check-circle-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--maroon)"><div><h6>Absent</h6><h2><?php echo $absent; ?></h2></div><i class="bi bi-x-circle-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:#f39c12"><div><h6>Late</h6><h2><?php echo $late; ?></h2></div><i class="bi bi-clock-fill stat-icon"></i></div></div>
</div>
<!-- Filters -->
<div class="card mb-3"><div class="card-body py-3">
    <form method="GET" class="row g-2 align-items-end">
        <input type="hidden" name="page" value="attendance-tracking">
        <div class="col-md-3"><label class="form-label">Date</label><input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($date_filter); ?>"></div>
        <div class="col-md-3"><label class="form-label">Batch</label><select name="batch_id" class="form-select"><option value="">All Batches</option><?php foreach ($batches as $b): ?><option value="<?php echo $b['id']; ?>" <?php echo $batch_filter==$b['id']?'selected':''; ?>><?php echo htmlspecialchars($b['batch_code']); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-2"><button type="submit" class="btn btn-olive w-100"><i class="bi bi-funnel me-1"></i>Filter</button></div>
        <div class="col-md-2">
            <?php if ($batch_filter): ?>
            <button type="submit" name="download" value="1" class="btn btn-outline-success w-100"><i class="bi bi-download me-1"></i>Report</button>
            <?php else: ?>
            <button type="button" class="btn btn-outline-secondary w-100" disabled title="Select a batch to download report"><i class="bi bi-download me-1"></i>Report</button>
            <?php endif; ?>
        </div>
        <div class="col-md-2"><a href="<?php echo $B; ?>/index.php?page=attendance-tracking" class="btn btn-outline-secondary w-100">Reset</a></div>
    </form>
</div></div>
<!-- Table -->
<div class="card"><div class="card-header"><h6 class="mb-0">Attendance Records</h6></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Adm. No.</th><th>Student</th><th>Subject</th><th>Batch</th><th>Date</th><th>Status</th><th>Remarks</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r):
        $badge = match($r['status']){'present'=>'badge-active','absent'=>'badge-inactive','late'=>'badge-pending','excused'=>'badge-completed', default=>'badge-pending'};
    ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><code><?php echo htmlspecialchars($r['admission_number']); ?></code></td>
            <td><?php echo htmlspecialchars($r['student_name']); ?></td>
            <td><?php echo htmlspecialchars($r['subject_name']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['batch_code']??'—'); ?></td>
            <td><?php echo $r['attendance_date']; ?></td>
            <td><span class="badge <?php echo $badge; ?>"><?php echo ucfirst($r['status']); ?></span></td>
            <td><?php echo htmlspecialchars($r['remarks']??''); ?></td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="8" class="text-center py-5 text-muted">No attendance records for this date/batch.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
