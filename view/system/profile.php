<?php
// view/system/profile.php — Enhanced Profile Management
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$user_id = $_SESSION['user_id'];
$role    = $_SESSION['user_role'] ?? 'admin';

// Fetch base user
$u = $pdo->prepare("SELECT * FROM users WHERE id=?");
$u->execute([$user_id]);
$user = $u->fetch(PDO::FETCH_ASSOC);

// Fetch extended info
$ext = [];
if ($role === 'student') {
    $s = $pdo->prepare("SELECT * FROM students WHERE user_id=?");
    $s->execute([$user_id]);
    $ext = $s->fetch(PDO::FETCH_ASSOC) ?: [];
} elseif ($role === 'faculty') {
    $f = $pdo->prepare("SELECT * FROM staff WHERE user_id=?");
    $f->execute([$user_id]);
    $ext = $f->fetch(PDO::FETCH_ASSOC) ?: [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    
    // Update basic user info
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    if (empty($name) || empty($email)) $errors[] = "Name and email are required.";
    
    if (!$errors) {
        $pdo->prepare("UPDATE users SET name=?, email=? WHERE id=?")->execute([$name, $email, $user_id]);
        $_SESSION['user_name'] = $name;

        // Update password if provided
        if (!empty($_POST['new_password'])) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $pdo->prepare("UPDATE users SET password=? WHERE id=?")->execute([password_hash($_POST['new_password'], PASSWORD_DEFAULT), $user_id]);
            } else { $errors[] = "Passwords do not match."; }
        }

        // Update extended info (Limited for students)
        if ($role === 'student' && $ext) {
            $pdo->prepare("UPDATE students SET phone=?, gender=?, date_of_birth=?, permanent_address=?, current_address=?, city=?, state=?, pincode=? WHERE user_id=?")
                ->execute([$_POST['phone'], $_POST['gender'], $_POST['dob'], $_POST['permanent_address'], $_POST['current_address'], $_POST['city'], $_POST['state'], $_POST['pincode'], $user_id]);
        } elseif ($role === 'faculty' && $ext) {
            $pdo->prepare("UPDATE staff SET phone=?, gender=?, date_of_birth=?, address=?, city=?, state=?, pincode=?, qualification=? WHERE user_id=?")
                ->execute([$_POST['phone'], $_POST['gender'], $_POST['dob'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['pincode'], $_POST['qualification'], $user_id]);
        }
        
        if (!$errors) {
            $_SESSION['flash'] = "Profile successfully updated.";
            logActivity($pdo, 'Update Profile', 'System', "User updated their personal profile.");
            header('Location: '.BASE_URL.'/index.php?page=profile'); exit;
        }
    }
}
$B = BASE_URL;
?>
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title"><i class="bi bi-person-bounding-box me-3 text-olive"></i>My Account</h1>
        <p class="text-muted small mb-0">Manage your personal information and security settings.</p>
    </div>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger shadow-sm border-0 mb-4">
        <ul class="mb-0"><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- Sidebar / Overview -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100 overflow-hidden">
            <div class="text-center py-5 bg-light border-bottom">
                <div class="position-relative d-inline-block mb-3">
                    <div class="profile-avatar-lg bg-olive text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width:100px; height:100px; font-size: 2.5rem; box-shadow: 0 8px 25px rgba(74,124,89,0.3)">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($user['name'] ?? 'User'); ?></h5>
                <p class="text-muted small mb-3"><?php echo htmlspecialchars($user['email']); ?></p>
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge bg-olive py-2 px-3"><?php echo strtoupper($role); ?></span>
                    <span class="badge bg-info py-2 px-3"><?php echo strtoupper($user['status']); ?></span>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush small">
                    <?php if ($role === 'student'): ?>
                        <li class="list-group-item px-4 py-3 d-flex justify-content-between">
                            <span class="text-muted">Admission No</span> <span class="fw-bold"><?php echo $ext['admission_number'] ?? '—'; ?></span>
                        </li>
                    <?php elseif ($role === 'faculty'): ?>
                        <li class="list-group-item px-4 py-3 d-flex justify-content-between">
                            <span class="text-muted">Staff ID</span> <span class="fw-bold"><?php echo $ext['staff_id'] ?? '—'; ?></span>
                        </li>
                    <?php endif; ?>
                    <li class="list-group-item px-4 py-3 d-flex justify-content-between">
                        <span class="text-muted">Joined on</span> <span><?php echo date('M d, Y', strtotime($user['created_at'])); ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                <i class="bi bi-pencil-square me-2 text-olive fs-5"></i>
                <h6 class="mb-0 fw-bold">Update Profile Information</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="row g-4">
                        <!-- Basic Info -->
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Full Display Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>

                        <?php if ($role !== 'admin'): ?>
                        <div class="col-12"><hr class="my-2 border-light"></div>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($ext['phone'] ?? ''); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="male" <?php if(($ext['gender']??'')=='male') echo 'selected'; ?>>Male</option>
                                <option value="female" <?php if(($ext['gender']??'')=='female') echo 'selected'; ?>>Female</option>
                                <option value="other" <?php if(($ext['gender']??'')=='other') echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" value="<?php echo $ext['date_of_birth'] ?? ''; ?>">
                        </div>

                        <?php if ($role === 'student'): ?>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Permanent Address</label>
                            <textarea name="permanent_address" class="form-control" rows="2"><?php echo htmlspecialchars($ext['permanent_address']??''); ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Current Address</label>
                            <textarea name="current_address" class="form-control" rows="2"><?php echo htmlspecialchars($ext['current_address']??''); ?></textarea>
                        </div>
                        <?php else: ?>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Residential Address</label>
                            <textarea name="address" class="form-control" rows="2"><?php echo htmlspecialchars($ext['address']??''); ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Highest Qualification</label>
                            <input type="text" name="qualification" class="form-control" value="<?php echo htmlspecialchars($ext['qualification']??''); ?>">
                        </div>
                        <?php endif; ?>

                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($ext['city']??''); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">State</label>
                            <input type="text" name="state" class="form-control" value="<?php echo htmlspecialchars($ext['state']??''); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Pincode</label>
                            <input type="text" name="pincode" class="form-control" value="<?php echo htmlspecialchars($ext['pincode']??''); ?>">
                        </div>
                        <?php endif; ?>

                        <!-- Password -->
                        <div class="col-12 mt-5">
                            <div class="p-3 bg-light rounded-3 d-flex align-items-center mb-4">
                                <i class="bi bi-shield-lock text-olive me-3 fs-3"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold">Security & Password</h6>
                                    <p class="text-muted small mb-0">Leave blank if you don't want to change your password.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="••••••••">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="••••••••">
                        </div>

                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-olive px-5 py-2 shadow-sm rounded-pill">
                                <i class="bi bi-save2 me-2"></i> Save Profile Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .badge { font-weight: 600; letter-spacing: 0.5px; border-radius: 6px; }
    .list-group-item { background: transparent; transition: var(--transition); border-color: rgba(0,0,0,0.03); }
    .list-group-item:hover { background: rgba(0,0,0,0.01); }
</style>
