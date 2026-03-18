<?php
// view/scheduling/index.php — Class Scheduling
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$batches = $pdo->query("SELECT id, batch_code, batch_name FROM academic_batches WHERE status='active' ORDER BY batch_code")->fetchAll(PDO::FETCH_ASSOC);
$batch_id = isset($_GET['batch_id']) ? (int)$_GET['batch_id'] : ($batches[0]['id'] ?? 0);
$schedules = [];
if ($batch_id) {
    $stmt = $pdo->prepare("SELECT cs.*, sub.name AS subject_name, sub.code AS sub_code, CONCAT(st.first_name,' ',st.last_name) AS faculty_name FROM class_schedules cs JOIN subjects sub ON cs.subject_id=sub.id LEFT JOIN staff st ON cs.faculty_id=st.id WHERE cs.batch_id=? ORDER BY FIELD(cs.day_of_week,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'), cs.start_time");
    $stmt->execute([$batch_id]);
    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-calendar-week me-2" style="color:var(--olive)"></i>Class Scheduling</h1></div></div>
<div class="card mb-4"><div class="card-body py-3">
    <form method="GET" class="d-flex gap-2 align-items-end">
        <input type="hidden" name="page" value="class-scheduling">
        <div><label class="form-label">Batch</label><select name="batch_id" class="form-select" onchange="this.form.submit()"><?php foreach ($batches as $b): ?><option value="<?php echo $b['id']; ?>" <?php echo $batch_id==$b['id']?'selected':''; ?>><?php echo htmlspecialchars($b['batch_code'].' - '.($b['batch_name']??'')); ?></option><?php endforeach; ?></select></div>
    </form>
</div></div>
<!-- Timetable grid -->
<div class="card"><div class="card-header"><h6 class="mb-0">Weekly Timetable</h6></div><div class="card-body p-0">
<div class="table-responsive"><table class="table table-bordered mb-0 text-center">
    <thead><tr><th style="width:120px">Day</th><th>Slots</th></tr></thead>
    <tbody>
    <?php foreach ($days as $day):
        $daySchedules = array_filter($schedules, fn($s) => $s['day_of_week'] === $day);
    ?>
    <tr>
        <td class="fw-bold py-3"><?php echo $day; ?></td>
        <td class="text-start">
            <?php if ($daySchedules): foreach ($daySchedules as $sc): ?>
            <div class="d-inline-block m-1 p-2 rounded" style="background:var(--olive-light);border:1px solid rgba(74,124,89,.3);min-width:150px">
                <div class="fw-bold" style="color:var(--olive);font-size:.85rem"><?php echo htmlspecialchars($sc['sub_code']); ?></div>
                <div style="font-size:.8rem"><?php echo htmlspecialchars($sc['subject_name']); ?></div>
                <div class="text-muted" style="font-size:.75rem"><?php echo $sc['start_time']; ?> – <?php echo $sc['end_time']; ?></div>
                <div class="text-muted" style="font-size:.75rem"><?php echo htmlspecialchars($sc['faculty_name']??'—'); ?></div>
                <div style="font-size:.72rem;color:#888"><?php echo htmlspecialchars($sc['room_number']??''); ?></div>
            </div>
            <?php endforeach; else: ?>
            <small class="text-muted">No classes</small>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table></div></div></div>
