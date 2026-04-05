<?php
// view/students/add.php — Add New Student
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$programs = $pdo->query("SELECT id, name, code FROM academic_programs WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$batches  = $pdo->query("SELECT id, batch_name, batch_code, program_id FROM academic_batches WHERE status='active' ORDER BY batch_name")->fetchAll(PDO::FETCH_ASSOC);
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST;
    $required = ['first_name','last_name','date_of_birth','gender','permanent_address','admission_date'];
    foreach ($required as $f) {
        if (empty($_POST[$f])) $errors[] = "Field '$f' is required.";
    }
    if (!$errors) {
        // Generate admission number
        $year = date('Y');
        $count = $pdo->query("SELECT COUNT(*) FROM students WHERE YEAR(created_at)=$year")->fetchColumn();
        $adm_no = 'ADM'.$year.str_pad($count+1, 4, '0', STR_PAD_LEFT);

        $stmt = $pdo->prepare("INSERT INTO students (admission_number,registration_no,roll,roll_extra,first_name,middle_name,last_name,
            date_of_birth,gender,blood_group,nationality,religion,caste_category,aadhaar_number,identification_mark,identification_mark_extra,
            personal_email,phone,alternate_phone,permanent_address,current_address,city,state,pincode,country,
            program_id,batch_id,admission_date,admission_type,admission_category,current_semester,
            father_name,father_phone,father_email,father_occupation,mother_name,mother_phone,mother_email,mother_occupation,
            guardian_name,guardian_relation,guardian_phone,parent_address,status,created_by)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([
            $adm_no, $_POST['registration_no'] ?? null, $_POST['roll'] ?? null, $_POST['roll_extra'] ?? null,
            $_POST['first_name'], $_POST['middle_name'] ?? '', $_POST['last_name'],
            $_POST['date_of_birth'], $_POST['gender'], $_POST['blood_group'] ?? null,
            $_POST['nationality'] ?? 'Indian', $_POST['religion'] ?? null, $_POST['caste_category'] ?? null,
            $_POST['aadhaar_number'] ?? null, $_POST['identification_mark'] ?? null, $_POST['identification_mark_extra'] ?? null,
            $_POST['personal_email'] ?? null, $_POST['phone'] ?? null, $_POST['alternate_phone'] ?? null,
            $_POST['permanent_address'], $_POST['current_address'] ?? null,
            $_POST['city'] ?? null, $_POST['state'] ?? null, $_POST['pincode'] ?? null,
            $_POST['country'] ?? 'India',
            $_POST['program_id'] ?: null, $_POST['batch_id'] ?: null,
            $_POST['admission_date'], $_POST['admission_type'] ?? 'regular',
            $_POST['admission_category'] ?? 'general', $_POST['current_semester'] ?? 1,
            $_POST['father_name'] ?? null, $_POST['father_phone'] ?? null, $_POST['father_email'] ?? null, $_POST['father_occupation'] ?? null,
            $_POST['mother_name'] ?? null, $_POST['mother_phone'] ?? null, $_POST['mother_email'] ?? null, $_POST['mother_occupation'] ?? null,
            $_POST['guardian_name'] ?? null, $_POST['guardian_relation'] ?? null, $_POST['guardian_phone'] ?? null, $_POST['parent_address'] ?? null,
            'active', $_SESSION['user_id']
        ]);
        logActivity($pdo, 'Add Student', 'Students', "Added student: $_POST[first_name] $_POST[last_name] ($adm_no)");
        $_SESSION['flash'] = "Student '$adm_no' added successfully.";
        header('Location: '.BASE_URL.'/index.php?page=student-information');
        exit;
    }
}
$B = BASE_URL;
?>
<div class="page-header">
    <div>
        <h1 class="page-title"><i class="bi bi-person-plus me-2" style="color:var(--olive)"></i>Add New Student</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $B; ?>/index.php?page=student-information">Students</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol></nav>
    </div>
    <a href="<?php echo $B; ?>/index.php?page=student-information" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<?php if ($errors): ?>
<div class="alert alert-danger mb-4">
    <strong>Please fix the following errors:</strong>
    <ul class="mb-0 mt-1"><?php foreach ($errors as $e) echo "<li>$e</li>"; ?></ul>
</div>
<?php endif; ?>

<form method="POST" class="row g-4">
    <!-- Personal Info -->
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h6 class="mb-0"><i class="bi bi-person me-2"></i>Personal Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Reg. No.</label>
                        <input type="text" name="registration_no" class="form-control" value="<?php echo htmlspecialchars($old['registration_no'] ?? ''); ?>">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Roll</label>
                        <input type="text" name="roll" class="form-control" value="<?php echo htmlspecialchars($old['roll'] ?? ''); ?>">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">No.</label>
                        <input type="text" name="roll_extra" class="form-control" value="<?php echo htmlspecialchars($old['roll_extra'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($old['first_name'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="<?php echo htmlspecialchars($old['middle_name'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($old['last_name'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" name="date_of_birth" class="form-control" value="<?php echo htmlspecialchars($old['date_of_birth'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <select name="gender" class="form-select" required>
                            <option value="">Select</option>
                            <option value="male" <?php echo ($old['gender']??'')==='male'?'selected':''; ?>>Male</option>
                            <option value="female" <?php echo ($old['gender']??'')==='female'?'selected':''; ?>>Female</option>
                            <option value="other" <?php echo ($old['gender']??'')==='other'?'selected':''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Blood Group</label>
                        <select name="blood_group" class="form-select">
                            <option value="">Select</option>
                            <?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg): ?>
                            <option value="<?php echo $bg; ?>" <?php echo ($old['blood_group']??'')===$bg?'selected':''; ?>><?php echo $bg; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Caste Category</label>
                        <select name="caste_category" class="form-select">
                            <option value="">Select</option>
                            <?php foreach (['General','OBC','SC','ST','EWS','Other'] as $c): ?>
                            <option value="<?php echo $c; ?>" <?php echo ($old['caste_category']??'')===$c?'selected':''; ?>><?php echo $c; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Religion</label>
                        <input type="text" name="religion" class="form-control" value="<?php echo htmlspecialchars($old['religion'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Aadhaar No.</label>
                        <input type="text" name="aadhaar_number" class="form-control" value="<?php echo htmlspecialchars($old['aadhaar_number'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Identification Mark 1</label>
                        <input type="text" name="identification_mark" class="form-control" value="<?php echo htmlspecialchars($old['identification_mark'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Identification Mark 2</label>
                        <input type="text" name="identification_mark_extra" class="form-control" value="<?php echo htmlspecialchars($old['identification_mark_extra'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Personal Email</label>
                        <input type="email" name="personal_email" class="form-control" value="<?php echo htmlspecialchars($old['personal_email'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Alternate Phone</label>
                        <input type="text" name="alternate_phone" class="form-control" value="<?php echo htmlspecialchars($old['alternate_phone'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Permanent Address <span class="text-danger">*</span></label>
                        <textarea name="permanent_address" class="form-control" rows="2" required><?php echo htmlspecialchars($old['permanent_address'] ?? ''); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Current Address</label>
                        <textarea name="current_address" class="form-control" rows="2"><?php echo htmlspecialchars($old['current_address'] ?? ''); ?></textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($old['city'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-control" value="<?php echo htmlspecialchars($old['state'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pincode</label>
                        <input type="text" name="pincode" class="form-control" value="<?php echo htmlspecialchars($old['pincode'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nationality</label>
                        <input type="text" name="nationality" class="form-control" value="<?php echo htmlspecialchars($old['nationality'] ?? 'Indian'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Academic Info -->
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h6 class="mb-0"><i class="bi bi-mortarboard me-2"></i>Academic Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Program</label>
                        <select name="program_id" class="form-select">
                            <option value="">Select Program</option>
                            <?php foreach ($programs as $p): ?>
                            <option value="<?php echo $p['id']; ?>" <?php echo ($old['program_id']??'')==$p['id']?'selected':''; ?>>
                                <?php echo htmlspecialchars($p['code'].' - '.$p['name']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Batch</label>
                        <select name="batch_id" class="form-select">
                            <option value="">Select Batch</option>
                            <?php foreach ($batches as $b): ?>
                            <option value="<?php echo $b['id']; ?>" <?php echo ($old['batch_id']??'')==$b['id']?'selected':''; ?>>
                                <?php echo htmlspecialchars($b['batch_code'].' - '.$b['batch_name']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Semester</label>
                        <select name="current_semester" class="form-select">
                            <?php for ($sem=1; $sem<=8; $sem++): ?>
                            <option value="<?php echo $sem; ?>" <?php echo ($old['current_semester']??1)==$sem?'selected':''; ?>>Sem <?php echo $sem; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Admission Date <span class="text-danger">*</span></label>
                        <input type="date" name="admission_date" class="form-control" value="<?php echo htmlspecialchars($old['admission_date'] ?? date('Y-m-d')); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Admission Type</label>
                        <select name="admission_type" class="form-select">
                            <?php foreach (['regular'=>'Regular','lateral'=>'Lateral','transfer'=>'Transfer','management'=>'Management','nri'=>'NRI'] as $v=>$l): ?>
                            <option value="<?php echo $v; ?>" <?php echo ($old['admission_type']??'regular')===$v?'selected':''; ?>><?php echo $l; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Admission Category</label>
                        <select name="admission_category" class="form-select">
                            <?php foreach (['general','obc','sc','st','ews','other'] as $c): ?>
                            <option value="<?php echo $c; ?>" <?php echo ($old['admission_category']??'general')===$c?'selected':''; ?>><?php echo strtoupper($c); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Parent/Guardian -->
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h6 class="mb-0"><i class="bi bi-people me-2"></i>Parent / Guardian Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label">Father's Name</label><input type="text" name="father_name" class="form-control" value="<?php echo htmlspecialchars($old['father_name'] ?? ''); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Father's Phone</label><input type="text" name="father_phone" class="form-control" value="<?php echo htmlspecialchars($old['father_phone'] ?? ''); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Father's Email</label><input type="email" name="father_email" class="form-control" value="<?php echo htmlspecialchars($old['father_email'] ?? ''); ?>"></div>
                    <div class="col-md-3"><label class="form-label">Father's Occupation</label><input type="text" name="father_occupation" class="form-control" value="<?php echo htmlspecialchars($old['father_occupation'] ?? ''); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Mother's Name</label><input type="text" name="mother_name" class="form-control" value="<?php echo htmlspecialchars($old['mother_name'] ?? ''); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Mother's Phone</label><input type="text" name="mother_phone" class="form-control" value="<?php echo htmlspecialchars($old['mother_phone'] ?? ''); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Mother's Email</label><input type="email" name="mother_email" class="form-control" value="<?php echo htmlspecialchars($old['mother_email'] ?? ''); ?>"></div>
                    <div class="col-md-3"><label class="form-label">Mother's Occupation</label><input type="text" name="mother_occupation" class="form-control" value="<?php echo htmlspecialchars($old['mother_occupation'] ?? ''); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Guardian Name</label><input type="text" name="guardian_name" class="form-control" value="<?php echo htmlspecialchars($old['guardian_name'] ?? ''); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Relation</label><input type="text" name="guardian_relation" class="form-control" value="<?php echo htmlspecialchars($old['guardian_relation'] ?? ''); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Guardian Phone</label><input type="text" name="guardian_phone" class="form-control" value="<?php echo htmlspecialchars($old['guardian_phone'] ?? ''); ?>"></div>
                    <div class="col-12"><label class="form-label">Parent/Guardian Address</label><textarea name="parent_address" class="form-control" rows="2"><?php echo htmlspecialchars($old['parent_address'] ?? ''); ?></textarea></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit -->
    <div class="col-12 d-flex gap-2">
        <button type="submit" class="btn btn-olive"><i class="bi bi-check2-circle me-1"></i>Save Student</button>
        <a href="<?php echo $B; ?>/index.php?page=student-information" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>

<div class="form-help-card">
    <h6><i class="bi bi-info-circle me-2"></i>Student Registration Help</h6>
    <div class="form-help-grid">
        <div class="help-item"><b>Admission No</b><span>Generated automatically as ADM[Year][Sequence].</span></div>
        <div class="help-item"><b>Address</b><span>Permanent address is mandatory. Current address can be different (e.g., Hostel).</span></div>
        <div class="help-item"><b>Batch/Program</b><span>Ensure the batch is correctly assigned to avoid scheduling conflicts.</span></div>
    </div>
</div>
