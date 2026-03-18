<?php
// view/faculty/edit.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0); $stmt = $pdo->prepare("SELECT * FROM staff WHERE id=?"); $stmt->execute([$id]); $t = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$t) { echo '<div class="alert alert-danger">Staff record not found.</div>'; return; }
$categories   = $pdo->query("SELECT * FROM staff_categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$designations = $pdo->query("SELECT * FROM staff_designations ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("UPDATE staff SET first_name=?,middle_name=?,last_name=?,gender=?,date_of_birth=?,email=?,phone=?,alternate_phone=?,address=?,city=?,state=?,pincode=?,category_id=?,designation_id=?,qualification=?,experience_years=?,joining_date=?,salary=?,pan_number=?,aadhaar_number=?,status=?,notes=? WHERE id=?")
        ->execute([$_POST['first_name'],$_POST['middle_name']??'',$_POST['last_name'],$_POST['gender'],$_POST['date_of_birth']??null,$_POST['email']??null,$_POST['phone']??null,$_POST['alternate_phone']??null,$_POST['address']??null,$_POST['city']??null,$_POST['state']??null,$_POST['pincode']??null,$_POST['category_id'],$_POST['designation_id'],$_POST['qualification']??null,$_POST['experience_years']??0,$_POST['joining_date']??null,$_POST['salary']??null,$_POST['pan_number']??null,$_POST['aadhaar_number']??null,$_POST['status']??'active',$_POST['notes']??null,$id]);
    $_SESSION['flash'] = 'Staff record updated.'; header('Location: '.BASE_URL.'/index.php?page=faculty'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-pencil me-2" style="color:var(--olive)"></i>Edit Staff: <?php echo htmlspecialchars($t['first_name'].' '.$t['last_name']); ?></h1></div><a href="<?php echo $B; ?>/index.php?page=faculty" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST" class="row g-4">
    <div class="col-12"><div class="card"><div class="card-header"><h6 class="mb-0">Personal Details</h6></div><div class="card-body"><div class="row g-3">
        <div class="col-md-4"><label class="form-label">First Name</label><input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($t['first_name']); ?>" required></div>
        <div class="col-md-4"><label class="form-label">Middle Name</label><input type="text" name="middle_name" class="form-control" value="<?php echo htmlspecialchars($t['middle_name']??''); ?>"></div>
        <div class="col-md-4"><label class="form-label">Last Name</label><input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($t['last_name']); ?>" required></div>
        <div class="col-md-3"><label class="form-label">Gender</label><select name="gender" class="form-select"><?php foreach (['male','female','other'] as $g): ?><option value="<?php echo $g; ?>" <?php echo $t['gender']===$g?'selected':''; ?>><?php echo ucfirst($g); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-3"><label class="form-label">DOB</label><input type="date" name="date_of_birth" class="form-control" value="<?php echo $t['date_of_birth']??''; ?>"></div>
        <div class="col-md-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($t['email']??''); ?>"></div>
        <div class="col-md-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($t['phone']??''); ?>"></div>
        <div class="col-md-6"><label class="form-label">Address</label><input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($t['address']??''); ?>"></div>
        <div class="col-md-3"><label class="form-label">City</label><input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($t['city']??''); ?>"></div>
        <div class="col-md-3"><label class="form-label">State</label><input type="text" name="state" class="form-control" value="<?php echo htmlspecialchars($t['state']??''); ?>"></div>
    </div></div></div></div>
    <div class="col-12"><div class="card"><div class="card-header"><h6 class="mb-0">Employment Details</h6></div><div class="card-body"><div class="row g-3">
        <div class="col-md-4"><label class="form-label">Category</label><select name="category_id" class="form-select"><?php foreach ($categories as $c): ?><option value="<?php echo $c['id']; ?>" <?php echo $t['category_id']==$c['id']?'selected':''; ?>><?php echo htmlspecialchars($c['name']); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-4"><label class="form-label">Designation</label><select name="designation_id" class="form-select"><?php foreach ($designations as $d): ?><option value="<?php echo $d['id']; ?>" <?php echo $t['designation_id']==$d['id']?'selected':''; ?>><?php echo htmlspecialchars($d['name']); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><?php foreach (['active','inactive','suspended','resigned'] as $s): ?><option value="<?php echo $s; ?>" <?php echo $t['status']===$s?'selected':''; ?>><?php echo ucfirst($s); ?></option><?php endforeach; ?></select></div>
        <div class="col-md-4"><label class="form-label">Qualification</label><input type="text" name="qualification" class="form-control" value="<?php echo htmlspecialchars($t['qualification']??''); ?>"></div>
        <div class="col-md-2"><label class="form-label">Experience (Yrs)</label><input type="number" name="experience_years" class="form-control" value="<?php echo $t['experience_years']??0; ?>"></div>
        <div class="col-md-3"><label class="form-label">Joining Date</label><input type="date" name="joining_date" class="form-control" value="<?php echo $t['joining_date']??''; ?>"></div>
        <div class="col-md-3"><label class="form-label">Salary</label><input type="number" name="salary" class="form-control" value="<?php echo $t['salary']??''; ?>" step="0.01"></div>
        <div class="col-md-6"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="2"><?php echo htmlspecialchars($t['notes']??''); ?></textarea></div>
    </div></div></div></div>
    <div class="col-12 d-flex gap-2"><button type="submit" class="btn btn-olive">Update Staff</button><a href="<?php echo $B; ?>/index.php?page=faculty" class="btn btn-outline-secondary">Cancel</a></div>
</form>
