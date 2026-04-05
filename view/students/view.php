<?php
// view/students/view.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT s.*, p.name AS program_name, ab.batch_name FROM students s
    LEFT JOIN academic_programs p ON s.program_id = p.id
    LEFT JOIN academic_batches ab ON s.batch_id = ab.id WHERE s.id=?");
$stmt->execute([$id]);
$s = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$s) { echo '<div class="alert alert-danger">Student not found.</div>'; return; }
$B = BASE_URL;
$badge = match($s['status'] ?? '') { 'active'=>'badge-active','inactive'=>'badge-inactive','graduated'=>'badge-completed', default=>'badge-pending' };
?>
<div class="page-header">
    <div>
        <h1 class="page-title"><i class="bi bi-person-lines-fill me-2" style="color:var(--olive)"></i>Student Profile</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $B; ?>/index.php?page=student-information">Students</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($s['first_name'].' '.$s['last_name']); ?></li>
        </ol></nav>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo $B; ?>/index.php?page=student-edit&id=<?php echo $s['id']; ?>" class="btn btn-olive"><i class="bi bi-pencil me-1"></i>Edit</a>
        <a href="<?php echo $B; ?>/index.php?page=student-information" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    </div>
</div>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-md-4">
        <div class="card text-center py-4">
            <div class="card-body">
                <div style="width:90px;height:90px;border-radius:50%;background:var(--olive-light);margin:0 auto 16px;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-person-fill" style="font-size:2.5rem;color:var(--olive)"></i>
                </div>
                <h5 class="mb-1"><?php echo htmlspecialchars($s['first_name'].' '.$s['middle_name'].' '.$s['last_name']); ?></h5>
                <p class="text-muted mb-2"><?php echo htmlspecialchars($s['admission_number']); ?></p>
                <span class="badge <?php echo $badge; ?> fs-6"><?php echo ucfirst($s['status']); ?></span>
                <hr>
                <div class="text-start small">
                    <div class="mb-1"><i class="bi bi-mortarboard me-2 text-muted"></i><strong>Program:</strong> <?php echo htmlspecialchars($s['program_name'] ?? '—'); ?></div>
                    <div class="mb-1"><i class="bi bi-grid me-2 text-muted"></i><strong>Batch:</strong> <?php echo htmlspecialchars($s['batch_name'] ?? '—'); ?></div>
                    <div class="mb-1"><i class="bi bi-123 me-2 text-muted"></i><strong>Semester:</strong> <?php echo $s['current_semester']; ?></div>
                    <div class="mb-1"><i class="bi bi-calendar me-2 text-muted"></i><strong>Admitted:</strong> <?php echo $s['admission_date']; ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Tabs -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-0">
                <ul class="nav nav-tabs card-header-tabs" id="profileTabs">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal">Personal</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact">Contact</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#guardian">Guardian</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#fees">Fees</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#attendance">Attendance</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#results">Results</button></li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <!-- Personal -->
                <div class="tab-pane fade show active" id="personal">
                    <div class="row g-3 mt-1">
                        <?php
                        $fields_personal = [
                            'Reg. No.' => $s['registration_no'] ?? '—',
                            'Roll' => $s['roll'] ?? '—',
                            'No.' => $s['roll_extra'] ?? '—',
                            'Date of Birth' => $s['date_of_birth'] ?? '—',
                            'Gender' => ucfirst($s['gender'] ?? '—'),
                            'Blood Group' => $s['blood_group'] ?? '—',
                            'Nationality' => $s['nationality'] ?? '—'
                        ];
                        foreach ($fields_personal as $lbl => $val): ?>
                        <div class="col-md-4"><small class="text-muted d-block"><?php echo $lbl; ?></small><div class="fw-bold"><?php echo htmlspecialchars($val ?: '—'); ?></div></div>
                        <?php endforeach; ?>
                        <div class="col-md-4"><small class="text-muted d-block">Religion</small><div class="fw-bold"><?php echo htmlspecialchars($s['religion'] ?? '—'); ?></div></div>
                        <div class="col-md-4"><small class="text-muted d-block">Caste Category</small><div class="fw-bold"><?php echo htmlspecialchars($s['caste_category'] ?? '—'); ?></div></div>
                        <div class="col-md-4"><small class="text-muted d-block">Aadhaar</small><div class="fw-bold"><?php echo htmlspecialchars($s['aadhaar_number'] ?? '—'); ?></div></div>
                        <div class="col-12"><small class="text-muted d-block">Identification Marks</small><div class="fw-bold">1. <?php echo htmlspecialchars($s['identification_mark'] ?: '—'); ?><br>2. <?php echo htmlspecialchars($s['identification_mark_extra'] ?: '—'); ?></div></div>
                    </div>
                </div>
                <!-- Contact -->
                <div class="tab-pane fade" id="contact">
                    <div class="row g-3 mt-1">
                        <?php
                        $fields_contact = ['Phone'=>$s['phone'],'Alt Phone'=>$s['alternate_phone'],'Personal Email'=>$s['personal_email'],'City'=>$s['city'],'State'=>$s['state'],'Pincode'=>$s['pincode'],'Country'=>$s['country']];
                        foreach ($fields_contact as $lbl => $val): ?>
                        <div class="col-md-4"><small class="text-muted d-block"><?php echo $lbl; ?></small><div class="fw-bold"><?php echo htmlspecialchars($val ?: '—'); ?></div></div>
                        <?php endforeach; ?>
                        <div class="col-12"><small class="text-muted d-block">Address</small><div class="fw-bold"><?php echo htmlspecialchars($s['permanent_address'] ?? '—'); ?></div></div>
                    </div>
                </div>
                <!-- Guardian -->
                <div class="tab-pane fade" id="guardian">
                    <div class="row g-3 mt-1">
                        <?php
                        $fields_g = [
                            "Father's Name" => $s['father_name'] ?? '—',
                            "Father's Phone" => $s['father_phone'] ?? '—',
                            "Father's Occupation" => $s['father_occupation'] ?? '—',
                            "Mother's Name" => $s['mother_name'] ?? '—',
                            "Mother's Phone" => $s['mother_phone'] ?? '—',
                            "Mother's Occupation" => $s['mother_occupation'] ?? '—',
                            'Guardian Name' => $s['guardian_name'] ?? '—',
                            'Relation' => $s['guardian_relation'] ?? '—',
                            'Guardian Phone' => $s['guardian_phone'] ?? '—',
                        ];
                        foreach ($fields_g as $lbl => $val): ?>
                        <div class="col-md-4"><small class="text-muted d-block"><?php echo $lbl; ?></small><div class="fw-bold"><?php echo htmlspecialchars($val ?: '—'); ?></div></div>
                        <?php endforeach; ?>
                        <div class="col-12"><small class="text-muted d-block">Parent Address</small><div class="fw-bold"><?php echo htmlspecialchars($s['parent_address'] ?? '—'); ?></div></div>
                    </div>
                </div>
                <!-- Fees -->
                <div class="tab-pane fade" id="fees">
                    <?php
                    $stmtF = $pdo->prepare("SELECT * FROM fee_transactions WHERE student_id=? ORDER BY transaction_date DESC");
                    $stmtF->execute([$id]);
                    $fees = $stmtF->fetchAll(PDO::FETCH_ASSOC);
                    if ($fees): ?>
                    <div class="table-responsive"><table class="table table-sm table-hover border">
                        <thead class="bg-light"><tr><th>Receipt</th><th>Type</th><th>Paid</th><th>Fine</th><th>Date</th><th>Status</th></tr></thead>
                        <tbody><?php foreach($fees as $f): ?>
                            <tr><td><code><?php echo $f['receipt_number']; ?></code></td><td><?php echo ucfirst($f['fee_type']); ?></td><td class="fw-bold"><?php echo number_format($f['amount_paid'],2); ?></td><td class="text-danger">+<?php echo number_format($f['fine_amount'],0); ?></td><td><?php echo $f['transaction_date']; ?></td><td><span class="badge <?php echo $f['payment_status']==='paid'?'badge-active':'badge-inactive'; ?>"><?php echo ucfirst($f['payment_status']); ?></span></td></tr>
                        <?php endforeach; ?></tbody>
                    </table></div>
                    <?php else: ?><div class="text-center py-4 text-muted"><i class="bi bi-wallet2 fs-2 d-block"></i>No fee records found.</div><?php endif; ?>
                </div>
                <!-- Attendance -->
                <div class="tab-pane fade" id="attendance">
                    <?php
                    $stmtA = $pdo->prepare("SELECT status, COUNT(*) as count FROM attendance WHERE student_id=? GROUP BY status");
                    $stmtA->execute([$id]);
                    $attData = $stmtA->fetchAll(PDO::FETCH_KEY_PAIR);
                    $totalAtt = array_sum($attData);
                    $presentRate = $totalAtt > 0 ? round(($attData['present'] ?? 0) / $totalAtt * 100) : 0;
                    ?>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-5 text-center border-end">
                            <h2 class="fw-bold text-olive mb-0"><?php echo $presentRate; ?>%</h2>
                            <small class="text-muted">Attendance Rate</small>
                            <div class="progress mt-2" style="height:8px"><div class="progress-bar bg-success" style="width: <?php echo $presentRate; ?>%"></div></div>
                        </div>
                        <div class="col-md-7 ps-4">
                            <div class="d-flex justify-content-between mb-1"><span>Present</span><strong><?php echo $attData['present'] ?? 0; ?></strong></div>
                            <div class="d-flex justify-content-between mb-1"><span>Absent</span><strong class="text-danger"><?php echo $attData['absent'] ?? 0; ?></strong></div>
                            <div class="d-flex justify-content-between"><span>Total Classes</span><strong><?php echo $totalAtt; ?></strong></div>
                        </div>
                    </div>
                </div>
                <!-- Results -->
                <div class="tab-pane fade" id="results">
                    <?php
                    $stmtR = $pdo->prepare("SELECT sg.*, sub.name as sub_name, sub.code as sub_code FROM student_grades sg JOIN subjects sub ON sg.subject_id=sub.id WHERE student_id=? ORDER BY sg.created_at DESC");
                    $stmtR->execute([$id]);
                    $res = $stmtR->fetchAll(PDO::FETCH_ASSOC);
                    if ($res): ?>
                    <div class="table-responsive"><table class="table table-sm table-hover border">
                        <thead class="bg-light"><tr><th>Subject</th><th>Type</th><th>Score</th><th>Grade</th></tr></thead>
                        <tbody><?php foreach($res as $r): ?>
                            <tr><td><strong><?php echo $r['sub_code']; ?></strong><br><small class="text-muted"><?php echo $r['sub_name']; ?></small></td><td><?php echo $r['is_semester']?'Semester':'Internal'; ?></td><td class="fw-bold"><?php echo $r['marks_obtained']; ?>/<?php echo $r['total_marks']; ?></td><td><span class="badge" style="background:var(--olive-light);color:var(--olive)"><?php echo $r['grade']; ?></span></td></tr>
                        <?php endforeach; ?></tbody>
                    </table></div>
                    <?php else: ?><div class="text-center py-4 text-muted"><i class="bi bi-mortarboard fs-2 d-block"></i>No results posted yet.</div><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
