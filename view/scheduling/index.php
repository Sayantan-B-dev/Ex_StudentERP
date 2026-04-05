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

// Fetch holidays for the current month
$holidays = $pdo->query("SELECT * FROM holidays ORDER BY holiday_date")->fetchAll(PDO::FETCH_ASSOC);
$h_map = []; foreach ($holidays as $h) $h_map[$h['holiday_date']] = $h['title'];

$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
$subjects = $pdo->query("SELECT id, name, code FROM subjects WHERE status='active'")->fetchAll(PDO::FETCH_ASSOC);
$faculty = $pdo->query("SELECT id, first_name, last_name FROM staff WHERE status='active'")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;

// POST Handlers
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add_schedule') {
        // Conflict checking (Oversimplified for demo)
        $conf = $pdo->prepare("SELECT id FROM class_schedules WHERE batch_id=? AND day_of_week=? AND ((start_time < ? AND end_time > ?) OR (start_time < ? AND end_time > ?))");
        $conf->execute([$_POST['batch_id'], $_POST['day_of_week'], $_POST['end_time'], $_POST['start_time'], $_POST['start_time'], $_POST['end_time']]);
        if ($conf->fetch()) {
            $_SESSION['flash_err'] = "Schedule Conflict: Another class exists at this time for this batch.";
        } else {
            $pdo->prepare("INSERT INTO class_schedules (batch_id, subject_id, faculty_id, day_of_week, start_time, end_time, room_number) VALUES (?,?,?,?,?,?,?)")
                ->execute([$_POST['batch_id'], $_POST['subject_id'], $_POST['faculty_id']?:null, $_POST['day_of_week'], $_POST['start_time'], $_POST['end_time'], $_POST['room_number']]);
            $_SESSION['flash'] = "Schedule added.";
        }
    }
    if (isset($_POST['action']) && $_POST['action'] === 'add_holiday') {
        $pdo->prepare("INSERT IGNORE INTO holidays (holiday_date, title) VALUES (?,?)")->execute([$_POST['holiday_date'], $_POST['title']]);
        $_SESSION['flash'] = "Holiday marked.";
    }
    header("Location: $B/index.php?page=class-scheduling&batch_id=$batch_id"); exit;
}
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-calendar-event me-2" style="color:var(--olive)"></i>Timetable & Scheduling</h1></div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#holidayModal"><i class="bi bi-calendar-x me-1"></i>Mark Holiday</button>
        <button class="btn btn-olive" data-bs-toggle="modal" data-bs-target="#scheduleModal"><i class="bi bi-plus-circle me-1"></i>Add Class</button>
    </div>
</div>

<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<?php if (isset($_SESSION['flash_err'])): ?><div class="alert alert-danger"><?php echo $_SESSION['flash_err']; unset($_SESSION['flash_err']); ?></div><?php endif; ?>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-header"><h6 class="mb-0">Selection</h6></div>
            <div class="card-body">
                <form method="GET">
                    <input type="hidden" name="page" value="class-scheduling">
                    <div class="mb-3"><label class="form-label">Active Batch</label><select name="batch_id" class="form-select" onchange="this.form.submit()"><?php foreach ($batches as $b): ?><option value="<?php echo $b['id']; ?>" <?php echo $batch_id==$b['id']?'selected':''; ?>><?php echo htmlspecialchars($b['batch_code']); ?></option><?php endforeach; ?></select></div>
                </form>
                <div class="mt-4"><h6 class="small text-muted mb-3">UPCOMING HOLIDAYS</h6>
                    <ul class="list-unstyled">
                        <?php foreach (array_slice($holidays,0,5) as $h): ?>
                        <li class="mb-2 small"><i class="bi bi-dot text-danger"></i> <strong><?php echo date('M d', strtotime($h['holiday_date'])); ?>:</strong> <?php echo htmlspecialchars($h['title']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
<!-- Timetable grid -->
    <div class="card"><div class="card-header bg-light"><h6 class="mb-0">9:00 AM – 5:00 PM Timetable</h6></div><div class="card-body p-0">
    <div class="table-responsive"><table class="table table-bordered mb-0 text-center align-middle">
        <thead class="table-light"><tr><th style="width:120px">Day</th><th>Schedule Slots</th></tr></thead>
        <tbody>
        <?php foreach ($days as $day):
            $daySchedules = array_filter($schedules, fn($s) => $s['day_of_week'] === $day);
        ?>
        <tr>
            <td class="fw-bold py-4 bg-light"><?php echo $day; ?></td>
            <td class="text-start p-3">
                <?php if ($daySchedules): ?>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($daySchedules as $sc): ?>
                    <div class="px-3 py-2 rounded-pill border shadow-sm d-inline-flex align-items-center gap-3 mb-2 me-2" style="background:#fff; border-left:4px solid var(--olive) !important; min-width:220px; border-radius: 12px !important;">
                        <div class="text-start">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge rounded-pill bg-olive-light text-olive" style="font-size: 0.65rem; border: 1px solid var(--olive)"><?php echo htmlspecialchars($sc['sub_code']); ?></span>
                                <div class="fw-bold text-dark" style="font-size: 0.85rem;"><?php echo htmlspecialchars($sc['subject_name']); ?></div>
                            </div>
                            <div class="d-flex gap-3 mt-1" style="font-size:0.7rem; opacity: 0.8">
                                <span><i class="bi bi-clock me-1"></i><?php echo date('H:i', strtotime($sc['start_time'])); ?> - <?php echo date('H:i', strtotime($sc['end_time'])); ?></span>
                                <span><i class="bi bi-geo-alt me-1"></i>R:<?php echo htmlspecialchars($sc['room_number']??'—'); ?></span>
                                <span><i class="bi bi-person me-1"></i><?php echo htmlspecialchars(explode(' ', $sc['faculty_name'])[0]??'—'); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?><small class="text-muted italic">Free Day / Self Study</small><?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table></div></div></div>
    </div>
</div>

<!-- SCHEDULE MODAL -->
<div class="modal fade" id="scheduleModal" tabindex="-1">
    <div class="modal-dialog"><form method="POST" class="modal-content">
        <input type="hidden" name="action" value="add_schedule"><input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
        <div class="modal-header"><h5 class="modal-title">Add Class Schedule</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Subject *</label><select name="subject_id" class="form-select" required><?php foreach ($subjects as $su): ?><option value="<?php echo $su['id']; ?>"><?php echo htmlspecialchars($su['code'].' - '.$su['name']); ?></option><?php endforeach; ?></select></div>
            <div class="mb-3"><label class="form-label">Faculty</label><select name="faculty_id" class="form-select"><option value="">Select Faculty</option><?php foreach ($faculty as $f): ?><option value="<?php echo $f['id']; ?>"><?php echo htmlspecialchars($f['first_name'].' '.$f['last_name']); ?></option><?php endforeach; ?></select></div>
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Day *</label><select name="day_of_week" class="form-select"><?php foreach ($days as $d): ?><option value="<?php echo $d; ?>"><?php echo $d; ?></option><?php endforeach; ?></select></div>
                <div class="col-md-6 mb-3"><label class="form-label">Room</label><input type="text" name="room_number" class="form-control" placeholder="e.g. 302"></div>
            </div>
            <div class="row">
                <div class="col-md-6"><label class="form-label">Start Time *</label><input type="time" name="start_time" class="form-control" required></div>
                <div class="col-md-6"><label class="form-label">End Time *</label><input type="time" name="end_time" class="form-control" required></div>
            </div>
        </div>
        <div class="modal-footer"><button type="submit" class="btn btn-olive">Create Schedule</button></div>
    </form></div>
</div>

<!-- HOLIDAY MODAL -->
<div class="modal fade" id="holidayModal" tabindex="-1">
    <div class="modal-dialog"><form method="POST" class="modal-content">
        <input type="hidden" name="action" value="add_holiday">
        <div class="modal-header"><h5 class="modal-title">Mark Holiday</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Date *</label><input type="date" name="holiday_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
            <div><label class="form-label">Title *</label><input type="text" name="title" class="form-control" placeholder="e.g. Independence Day" required></div>
        </div>
        <div class="modal-footer"><button type="submit" class="btn btn-danger">Mark Holiday</button></div>
    </form></div>
</div>
