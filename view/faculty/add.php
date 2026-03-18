<?php
// view/faculty/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$categories    = $pdo->query("SELECT * FROM staff_categories WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$designations  = $pdo->query("SELECT * FROM staff_designations WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate staff ID
    $year = date('Y');
    $prefix = strtoupper(substr($_POST['first_name'],0,1).substr($_POST['last_name'],0,2));
    $count  = $pdo->query("SELECT COUNT(*) FROM staff")->fetchColumn();
    $staff_id = 'T'.$prefix.date('Y').str_pad($count+1, 4, '0', STR_PAD_LEFT);

    $pdo->prepare("INSERT INTO staff (staff_id,first_name,middle_name,last_name,gender,date_of_birth,email,phone,alternate_phone,address,city,state,pincode,category_id,designation_id,qualification,experience_years,joining_date,salary,pan_number,aadhaar_number,status,notes) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")
        ->execute([$staff_id,$_POST['first_name'],$_POST['middle_name']??'',$_POST['last_name'],$_POST['gender'],$_POST['date_of_birth']??null,$_POST['email']??null,$_POST['phone']??null,$_POST['alternate_phone']??null,$_POST['address']??null,$_POST['city']??null,$_POST['state']??null,$_POST['pincode']??null,$_POST['category_id'],$_POST['designation_id'],$_POST['qualification']??null,$_POST['experience_years']??0,$_POST['joining_date']??null,$_POST['salary']??null,$_POST['pan_number']??null,$_POST['aadhaar_number']??null,'active',$_POST['notes']??null]);
    $_SESSION['flash'] = "Staff '$staff_id' added.";
    header('Location: '.BASE_URL.'/index.php?page=faculty'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-person-plus me-2" style="color:var(--olive)"></i>Add Staff Member</h1></div><a href="<?php echo $B; ?>/index.php?page=faculty" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST" class="row g-4">
    <div class="col-12"><div class="card"><div class="card-header"><h6 class="mb-0">Personal Details</h6></div><div class="card-body"><div class="row g-3">
        <div class="col-md-4"><label class="form-label">First Name *</label><input type="text" name="first_name" class="form-control" placeholder="e.g. John" required></div>
        <div class="col-md-4"><label class="form-label">Middle Name</label><input type="text" name="middle_name" class="form-control" placeholder="e.g. P."></div>
        <div class="col-md-4"><label class="form-label">Last Name *</label><input type="text" name="last_name" class="form-control" placeholder="e.g. Doe" required></div>
        <div class="col-md-3"><label class="form-label">Gender *</label><select name="gender" class="form-select" required><option value="">Select</option><option value="male">Male</option><option value="female">Female</option><option value="other">Other</option></select></div>
        <div class="col-md-3"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" class="form-control"></div>
        <div class="col-md-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" placeholder="john.doe@example.com"></div>
        <div class="col-md-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" placeholder="+91 0000000000"></div>
        <div class="col-md-3"><label class="form-label">Alternate Phone</label><input type="text" name="alternate_phone" class="form-control"></div>
        <div class="col-md-9"><label class="form-label">Address</label><input type="text" name="address" class="form-control" placeholder="House No, Street, Area"></div>
        <div class="col-md-3"><label class="form-label">City</label><input type="text" name="city" class="form-control" placeholder="City"></div>
        <div class="col-md-3"><label class="form-label">State</label><input type="text" name="state" class="form-control" placeholder="State"></div>
        <div class="col-md-3"><label class="form-label">Pincode</label><input type="text" name="pincode" class="form-control" placeholder="6-digit ZIP"></div>
    </div></div></div></div>
    <div class="col-12"><div class="card"><div class="card-header"><h6 class="mb-0">Employment Details</h6></div><div class="card-body"><div class="row g-3">
        <div class="col-md-4"><label class="form-label">Category *</label><select name="category_id" class="form-select" required><option value="">Select</option><?php foreach ($categories as $c): ?><option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-4"><label class="form-label">Designation *</label><select name="designation_id" class="form-select" required><option value="">Select</option><?php foreach ($designations as $d): ?><option value="<?php echo $d['id']; ?>"><?php echo htmlspecialchars($d['name']); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-4"><label class="form-label">Qualification</label><input type="text" name="qualification" class="form-control" placeholder="e.g. PhD in CS, M.Tech"></div>
        <div class="col-md-3"><label class="form-label">Experience (Yrs)</label><input type="number" name="experience_years" class="form-control" value="0"></div>
        <div class="col-md-3"><label class="form-label">Joining Date</label><input type="date" name="joining_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"></div>
        <div class="col-md-3"><label class="form-label">Salary</label><input type="number" name="salary" class="form-control" step="0.01" placeholder="Monthly Gross"></div>
        <div class="col-md-3"><label class="form-label">PAN Number</label><input type="text" name="pan_number" class="form-control" placeholder="ABCDE1234F"></div>
        <div class="col-md-3"><label class="form-label">Aadhaar Number</label><input type="text" name="aadhaar_number" class="form-control" placeholder="12-digit UID"></div>
        <div class="col-md-9"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="2" placeholder="Any additional employment remarks..."></textarea></div>
    </div></div></div></div>
    <div class="col-12 d-flex gap-2"><button type="submit" class="btn btn-olive"><i class="bi bi-check2-circle me-1"></i>Save Staff</button><a href="<?php echo $B; ?>/index.php?page=faculty" class="btn btn-outline-secondary">Cancel</a></div>
</form>

<div class="form-help-card">
    <h6><i class="bi bi-info-circle me-2"></i>Staff Addition Help</h6>
    <div class="form-help-grid">
        <div class="help-item"><b>Staff ID</b><span>Automatically generated based on name and year (e.g., TDOE20240001).</span></div>
        <div class="help-item"><b>PAN/Aadhaar</b><span>Required for payroll and statutory compliance.</span></div>
        <div class="help-item"><b>Category</b><span>Defines the nature of employment (Teaching vs Non-Teaching).</span></div>
    </div>
</div>
