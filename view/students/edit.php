<?php
// view/students/edit.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0);
$s  = $pdo->prepare("SELECT * FROM students WHERE id=?");
$s->execute([$id]);
$student = $s->fetch(PDO::FETCH_ASSOC);
if (!$student) { echo '<div class="alert alert-danger">Student not found.</div>'; return; }

$programs = $pdo->query("SELECT id, name, code FROM academic_programs WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$batches  = $pdo->query("SELECT id, batch_name, batch_code FROM academic_batches WHERE status='active' ORDER BY batch_name")->fetchAll(PDO::FETCH_ASSOC);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE students SET
        registration_no=?,roll=?,roll_extra=?,
        first_name=?,middle_name=?,last_name=?,date_of_birth=?,gender=?,blood_group=?,nationality=?,
        religion=?,caste_category=?,aadhaar_number=?,identification_mark=?,identification_mark_extra=?,personal_email=?,phone=?,alternate_phone=?,
        permanent_address=?,current_address=?,city=?,state=?,pincode=?,country=?,
        program_id=?,batch_id=?,current_semester=?,admission_type=?,admission_category=?,admission_date=?,
        father_name=?,father_phone=?,father_email=?,father_occupation=?,mother_name=?,mother_phone=?,mother_email=?,mother_occupation=?,
        guardian_name=?,guardian_relation=?,guardian_phone=?,guardian_email=?,parent_address=?,status=?
        WHERE id=?");
    $stmt->execute([
        $_POST['registration_no']??null,$_POST['roll']??null,$_POST['roll_extra']??null,
        $_POST['first_name'],$_POST['middle_name']??'',$_POST['last_name'],$_POST['date_of_birth'],$_POST['gender'],
        $_POST['blood_group']??null,$_POST['nationality']??'Indian',
        $_POST['religion']??null,$_POST['caste_category']??null,$_POST['aadhaar_number']??null,
        $_POST['identification_mark']??null, $_POST['identification_mark_extra']??null,
        $_POST['personal_email']??null,$_POST['phone']??null,$_POST['alternate_phone']??null,
        $_POST['permanent_address']??'',$_POST['current_address']??null,$_POST['city']??null,
        $_POST['state']??null,$_POST['pincode']??null,$_POST['country']??'India',
        $_POST['program_id']?:null,$_POST['batch_id']?:null,$_POST['current_semester']??1,
        $_POST['admission_type']??'regular',$_POST['admission_category']??'general',$_POST['admission_date'],
        $_POST['father_name']??null,$_POST['father_phone']??null,$_POST['father_email']??null,$_POST['father_occupation']??null,
        $_POST['mother_name']??null,$_POST['mother_phone']??null,$_POST['mother_email']??null,$_POST['mother_occupation']??null,
        $_POST['guardian_name']??null,$_POST['guardian_relation']??null,$_POST['guardian_phone']??null,$_POST['guardian_email']??null,$_POST['parent_address']??null,
        $_POST['status']??'active',$id
    ]);
    logActivity($pdo, 'Edit Student', 'Students', "Updated record for student ID: $id ($student[admission_number])");
    $_SESSION['flash'] = 'Student record updated.';
    header('Location: '.BASE_URL.'/index.php?page=student-information');
    exit;
}
$t = $student; // template data
$B = BASE_URL;
?>
<div class="page-header">
    <div>
        <h1 class="page-title"><i class="bi bi-pencil-square me-2" style="color:var(--olive)"></i>Edit Student</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $B; ?>/index.php?page=student-information">Students</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol></nav>
    </div>
    <a href="<?php echo $B; ?>/index.php?page=student-information" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<form method="POST" class="row g-4">
    <div class="col-12"><div class="card"><div class="card-header"><h6 class="mb-0">Personal Information</h6></div><div class="card-body">
        <div class="row g-3">
            <div class="col-md-2"><label class="form-label">Reg. No.</label><input type="text" name="registration_no" class="form-control" value="<?php echo htmlspecialchars($t['registration_no']??''); ?>"></div>
            <div class="col-md-1"><label class="form-label">Roll</label><input type="text" name="roll" class="form-control" value="<?php echo htmlspecialchars($t['roll']??''); ?>"></div>
            <div class="col-md-1"><label class="form-label">No.</label><input type="text" name="roll_extra" class="form-control" value="<?php echo htmlspecialchars($t['roll_extra']??''); ?>"></div>
            <div class="col-md-4"><label class="form-label">First Name</label><input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($t['first_name']); ?>" required></div>
            <div class="col-md-4"><label class="form-label">Middle Name</label><input type="text" name="middle_name" class="form-control" value="<?php echo htmlspecialchars($t['middle_name']??''); ?>"></div>
            <div class="col-md-4"><label class="form-label">Last Name</label><input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($t['last_name']); ?>" required></div>
            <div class="col-md-3"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" class="form-control" value="<?php echo $t['date_of_birth']; ?>" required></div>
            <div class="col-md-3"><label class="form-label">Gender</label><select name="gender" class="form-select">
                <?php foreach (['male','female','other'] as $g): ?><option value="<?php echo $g; ?>" <?php echo $t['gender']===$g?'selected':''; ?>><?php echo ucfirst($g); ?></option><?php endforeach; ?>
            </select></div>
            <div class="col-md-3"><label class="form-label">Blood Group</label><select name="blood_group" class="form-select">
                <option value="">Select</option><?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg): ?><option value="<?php echo $bg; ?>" <?php echo ($t['blood_group']??'')===$bg?'selected':''; ?>><?php echo $bg; ?></option><?php endforeach; ?>
            </select></div>
            <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select">
                <?php foreach (['active','inactive','graduated','suspended','discontinued'] as $st): ?><option value="<?php echo $st; ?>" <?php echo $t['status']===$st?'selected':''; ?>><?php echo ucfirst($st); ?></option><?php endforeach; ?>
            </select></div>
            <div class="col-md-3"><label class="form-label">Religion</label><input type="text" name="religion" class="form-control" value="<?php echo htmlspecialchars($t['religion']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">Caste Category</label><select name="caste_category" class="form-select"><option value="">Select</option><?php foreach (['General','OBC','SC','ST','EWS','Other'] as $c): ?><option value="<?php echo $c; ?>" <?php echo ($t['caste_category']??'')===$c?'selected':''; ?>><?php echo $c; ?></option><?php endforeach; ?></select></div>
            <div class="col-md-3"><label class="form-label">Aadhaar No.</label><input type="text" name="aadhaar_number" class="form-control" value="<?php echo htmlspecialchars($t['aadhaar_number']??''); ?>"></div>
            <div class="col-md-6"><label class="form-label">Identification Mark 1</label><input type="text" name="identification_mark" class="form-control" value="<?php echo htmlspecialchars($t['identification_mark']??''); ?>"></div>
            <div class="col-md-6"><label class="form-label">Identification Mark 2</label><input type="text" name="identification_mark_extra" class="form-control" value="<?php echo htmlspecialchars($t['identification_mark_extra']??''); ?>"></div>
            <div class="col-md-4"><label class="form-label">Personal Email</label><input type="email" name="personal_email" class="form-control" value="<?php echo htmlspecialchars($t['personal_email']??''); ?>"></div>
            <div class="col-md-4"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($t['phone']??''); ?>"></div>
            <div class="col-md-4"><label class="form-label">Alternate Phone</label><input type="text" name="alternate_phone" class="form-control" value="<?php echo htmlspecialchars($t['alternate_phone']??''); ?>"></div>
            <div class="col-md-6"><label class="form-label">Permanent Address</label><textarea name="permanent_address" class="form-control" rows="2"><?php echo htmlspecialchars($t['permanent_address']); ?></textarea></div>
            <div class="col-md-6"><label class="form-label">Current Address</label><textarea name="current_address" class="form-control" rows="2"><?php echo htmlspecialchars($t['current_address']??''); ?></textarea></div>
            <div class="col-md-3"><label class="form-label">City</label><input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($t['city']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">State</label><input type="text" name="state" class="form-control" value="<?php echo htmlspecialchars($t['state']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">Pincode</label><input type="text" name="pincode" class="form-control" value="<?php echo htmlspecialchars($t['pincode']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">Nationality</label><input type="text" name="nationality" class="form-control" value="<?php echo htmlspecialchars($t['nationality']??'Indian'); ?>"></div>
        </div>
    </div></div></div>
    <div class="col-12"><div class="card"><div class="card-header"><h6 class="mb-0">Academic Details</h6></div><div class="card-body">
        <div class="row g-3">
            <div class="col-md-4"><label class="form-label">Program</label><select name="program_id" class="form-select">
                <option value="">-- Select --</option><?php foreach ($programs as $p): ?><option value="<?php echo $p['id']; ?>" <?php echo ($t['program_id']==$p['id'])?'selected':''; ?>><?php echo htmlspecialchars($p['code'].' - '.$p['name']); ?></option><?php endforeach; ?>
            </select></div>
            <div class="col-md-4"><label class="form-label">Batch</label><select name="batch_id" class="form-select">
                <option value="">-- Select --</option><?php foreach ($batches as $b): ?><option value="<?php echo $b['id']; ?>" <?php echo ($t['batch_id']==$b['id'])?'selected':''; ?>><?php echo htmlspecialchars($b['batch_code'].' - '.$b['batch_name']); ?></option><?php endforeach; ?>
            </select></div>
            <div class="col-md-2"><label class="form-label">Semester</label><select name="current_semester" class="form-select">
                <?php for ($sem=1; $sem<=8; $sem++): ?><option value="<?php echo $sem; ?>" <?php echo $t['current_semester']==$sem?'selected':''; ?>>Sem <?php echo $sem; ?></option><?php endfor; ?>
            </select></div>
            <div class="col-md-3"><label class="form-label">Admission Date</label><input type="date" name="admission_date" class="form-control" value="<?php echo $t['admission_date']; ?>" required></div>
            <div class="col-md-3"><label class="form-label">Admission Type</label><select name="admission_type" class="form-select"><?php foreach (['regular','lateral','transfer','management','nri'] as $v): ?><option value="<?php echo $v; ?>" <?php echo $t['admission_type']===$v?'selected':''; ?>><?php echo ucfirst($v); ?></option><?php endforeach; ?></select></div>
            <div class="col-md-3"><label class="form-label">Category</label><select name="admission_category" class="form-select"><?php foreach (['general','obc','sc','st','ews','other'] as $c): ?><option value="<?php echo $c; ?>" <?php echo $t['admission_category']===$c?'selected':''; ?>><?php echo strtoupper($c); ?></option><?php endforeach; ?></select></div>
        </div>
    </div></div></div>
    <div class="col-12"><div class="card"><div class="card-header"><h6 class="mb-0">Guardian Info</h6></div><div class="card-body">
        <div class="row g-3">
            <div class="col-md-3"><label class="form-label">Father Name</label><input type="text" name="father_name" class="form-control" value="<?php echo htmlspecialchars($t['father_name']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">Father Phone</label><input type="text" name="father_phone" class="form-control" value="<?php echo htmlspecialchars($t['father_phone']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">Father Occupation</label><input type="text" name="father_occupation" class="form-control" value="<?php echo htmlspecialchars($t['father_occupation']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">Mother Name</label><input type="text" name="mother_name" class="form-control" value="<?php echo htmlspecialchars($t['mother_name']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">Mother Phone</label><input type="text" name="mother_phone" class="form-control" value="<?php echo htmlspecialchars($t['mother_phone']??''); ?>"></div>
            <div class="col-md-3"><label class="form-label">Mother Occupation</label><input type="text" name="mother_occupation" class="form-control" value="<?php echo htmlspecialchars($t['mother_occupation']??''); ?>"></div>
            <div class="col-md-4"><label class="form-label">Guardian Name</label><input type="text" name="guardian_name" class="form-control" value="<?php echo htmlspecialchars($t['guardian_name']??''); ?>"></div>
            <div class="col-md-4"><label class="form-label">Relation</label><input type="text" name="guardian_relation" class="form-control" value="<?php echo htmlspecialchars($t['guardian_relation']??''); ?>"></div>
            <div class="col-md-4"><label class="form-label">Guardian Phone</label><input type="text" name="guardian_phone" class="form-control" value="<?php echo htmlspecialchars($t['guardian_phone']??''); ?>"></div>
            <div class="col-12"><label class="form-label">Parent/Guardian Address</label><textarea name="parent_address" class="form-control" rows="2"><?php echo htmlspecialchars($t['parent_address']??''); ?></textarea></div>
        </div>
    </div></div></div>
    <div class="col-12 d-flex gap-2">
        <button type="submit" class="btn btn-olive"><i class="bi bi-check2-circle me-1"></i>Update Student</button>
        <a href="<?php echo $B; ?>/index.php?page=student-information" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>
