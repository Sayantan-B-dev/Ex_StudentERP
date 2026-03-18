<?php
// view/faculty/view.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT s.*, sc.name AS cat_name, sd.name AS desig_name FROM staff s LEFT JOIN staff_categories sc ON s.category_id=sc.id LEFT JOIN staff_designations sd ON s.designation_id=sd.id WHERE s.id=?");
$stmt->execute([$id]);
$s = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$s) { echo '<div class="alert alert-danger">Staff not found.</div>'; return; }
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-person-badge me-2" style="color:var(--olive)"></i>Staff Profile</h1></div>
    <div class="d-flex gap-2">
        <a href="<?php echo $B; ?>/index.php?page=staff-edit&id=<?php echo $s['id']; ?>" class="btn btn-olive"><i class="bi bi-pencil me-1"></i>Edit</a>
        <a href="<?php echo $B; ?>/index.php?page=faculty" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
    </div>
</div>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card text-center py-4">
            <div class="card-body">
                <div style="width:90px;height:90px;border-radius:50%;background:rgba(128,0,0,.1);margin:0 auto 16px;display:flex;align-items:center;justify-content:center"><i class="bi bi-person-badge-fill" style="font-size:2.5rem;color:var(--maroon)"></i></div>
                <h5><?php echo htmlspecialchars($s['first_name'].' '.$s['middle_name'].' '.$s['last_name']); ?></h5>
                <p class="text-muted"><?php echo htmlspecialchars($s['staff_id']); ?></p>
                <span class="badge <?php echo $s['status']==='active'?'badge-active':'badge-inactive'; ?> fs-6"><?php echo ucfirst($s['status']); ?></span>
                <hr>
                <div class="text-start small">
                    <div class="mb-1"><i class="bi bi-tag me-2 text-muted"></i><strong>Category:</strong> <?php echo htmlspecialchars($s['cat_name']??'—'); ?></div>
                    <div class="mb-1"><i class="bi bi-award me-2 text-muted"></i><strong>Designation:</strong> <?php echo htmlspecialchars($s['desig_name']??'—'); ?></div>
                    <div class="mb-1"><i class="bi bi-calendar me-2 text-muted"></i><strong>Joined:</strong> <?php echo $s['joining_date']??'—'; ?></div>
                    <div class="mb-1"><i class="bi bi-book me-2 text-muted"></i><strong>Qualification:</strong> <?php echo htmlspecialchars($s['qualification']??'—'); ?></div>
                    <div class="mb-1"><i class="bi bi-briefcase me-2 text-muted"></i><strong>Experience:</strong> <?php echo $s['experience_years']; ?> years</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card"><div class="card-body">
            <h6 class="form-section-title">Contact Information</h6>
            <div class="row g-2">
                <?php foreach (['Email'=>$s['email'],'Phone'=>$s['phone'],'Alternate Phone'=>$s['alternate_phone'],'Address'=>$s['address'],'City'=>$s['city'],'State'=>$s['state'],'Pincode'=>$s['pincode']] as $lbl=>$val): ?>
                <div class="col-md-6"><small class="text-muted"><?php echo $lbl; ?></small><div class="fw-medium"><?php echo htmlspecialchars($val??'—'); ?></div></div>
                <?php endforeach; ?>
            </div>
            <h6 class="form-section-title">Financial Details</h6>
            <div class="row g-2">
                <div class="col-md-4"><small class="text-muted">Salary</small><div class="fw-medium">₹<?php echo number_format($s['salary']??0, 2); ?></div></div>
                <div class="col-md-4"><small class="text-muted">PAN</small><div class="fw-medium"><?php echo htmlspecialchars($s['pan_number']??'—'); ?></div></div>
                <div class="col-md-4"><small class="text-muted">Aadhaar</small><div class="fw-medium"><?php echo htmlspecialchars($s['aadhaar_number']??'—'); ?></div></div>
            </div>
            <?php if ($s['notes']): ?><h6 class="form-section-title">Notes</h6><p><?php echo nl2br(htmlspecialchars($s['notes'])); ?></p><?php endif; ?>
        </div></div>
    </div>
</div>
