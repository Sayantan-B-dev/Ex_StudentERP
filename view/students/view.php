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
$badge = match($s['status']) { 'active'=>'badge-active','inactive'=>'badge-inactive','graduated'=>'badge-completed', default=>'badge-pending' };
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
                </ul>
            </div>
            <div class="card-body tab-content">
                <!-- Personal -->
                <div class="tab-pane fade show active" id="personal">
                    <div class="row g-2 mt-1">
                        <?php
                        $fields_personal = ['Date of Birth'=>$s['date_of_birth'],'Gender'=>ucfirst($s['gender']),'Blood Group'=>$s['blood_group'],'Nationality'=>$s['nationality'],'Religion'=>$s['religion'],'Caste Category'=>$s['caste_category'],'Aadhaar'=>$s['aadhaar_number']];
                        foreach ($fields_personal as $lbl => $val): ?>
                        <div class="col-6"><small class="text-muted"><?php echo $lbl; ?></small><div class="fw-medium"><?php echo htmlspecialchars($val ?: '—'); ?></div></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Contact -->
                <div class="tab-pane fade" id="contact">
                    <div class="row g-2 mt-1">
                        <?php
                        $fields_contact = ['Phone'=>$s['phone'],'Alternate Phone'=>$s['alternate_phone'],'Personal Email'=>$s['personal_email'],'City'=>$s['city'],'State'=>$s['state'],'Pincode'=>$s['pincode'],'Country'=>$s['country'],'Address'=>$s['permanent_address']];
                        foreach ($fields_contact as $lbl => $val): ?>
                        <div class="col-6"><small class="text-muted"><?php echo $lbl; ?></small><div class="fw-medium"><?php echo htmlspecialchars($val ?: '—'); ?></div></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Guardian -->
                <div class="tab-pane fade" id="guardian">
                    <div class="row g-2 mt-1">
                        <?php
                        $fields_g = ["Father's Name"=>$s['father_name'],"Father's Phone"=>$s['father_phone'],"Mother's Name"=>$s['mother_name'],"Mother's Phone"=>$s['mother_phone'],'Guardian Name'=>$s['guardian_name'],'Relation'=>$s['guardian_relation'],'Guardian Phone'=>$s['guardian_phone']];
                        foreach ($fields_g as $lbl => $val): ?>
                        <div class="col-6"><small class="text-muted"><?php echo $lbl; ?></small><div class="fw-medium"><?php echo htmlspecialchars($val ?: '—'); ?></div></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
