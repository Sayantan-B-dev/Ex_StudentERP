<?php
// view/system/settings.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['settings'] as $k => $v) {
        $exists = $pdo->prepare("SELECT id FROM system_settings WHERE setting_key=?")->execute([$k]);
        $check  = $pdo->prepare("SELECT COUNT(*) FROM system_settings WHERE setting_key=?");
        $check->execute([$k]);
        if ($check->fetchColumn() > 0) {
            $pdo->prepare("UPDATE system_settings SET setting_value=? WHERE setting_key=?")->execute([$v,$k]);
        } else {
            $pdo->prepare("INSERT INTO system_settings (setting_key,setting_value) VALUES (?,?)")->execute([$k,$v]);
        }
    }
    $_SESSION['flash'] = 'Settings saved.'; header('Location: '.BASE_URL.'/index.php?page=settings'); exit;
}
$settings = [];
$rows = $pdo->query("SELECT setting_key, setting_value FROM system_settings")->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $r) $settings[$r['setting_key']] = $r['setting_value'];
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-gear me-2" style="color:var(--olive)"></i>System Settings</h1></div></div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<form method="POST">
<div class="row g-4">
    <div class="col-md-6"><div class="card"><div class="card-header"><h6 class="mb-0"><i class="bi bi-building me-2"></i>Institution Settings</h6></div><div class="card-body"><div class="row g-3">
        <div class="col-12"><label class="form-label">Institution Name</label><input type="text" name="settings[institution_name]" class="form-control" value="<?php echo htmlspecialchars($settings['institution_name']??''); ?>"></div>
        <div class="col-12"><label class="form-label">Address</label><textarea name="settings[institution_address]" class="form-control" rows="2"><?php echo htmlspecialchars($settings['institution_address']??''); ?></textarea></div>
        <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="settings[institution_phone]" class="form-control" value="<?php echo htmlspecialchars($settings['institution_phone']??''); ?>"></div>
        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="settings[institution_email]" class="form-control" value="<?php echo htmlspecialchars($settings['institution_email']??''); ?>"></div>
        <div class="col-12"><label class="form-label">Website</label><input type="url" name="settings[institution_website]" class="form-control" value="<?php echo htmlspecialchars($settings['institution_website']??''); ?>"></div>
    </div></div></div></div>
    <div class="col-md-6"><div class="card"><div class="card-header"><h6 class="mb-0"><i class="bi bi-sliders me-2"></i>Academic Settings</h6></div><div class="card-body"><div class="row g-3">
        <div class="col-12"><label class="form-label">Current Academic Year</label><input type="text" name="settings[current_academic_year]" class="form-control" value="<?php echo htmlspecialchars($settings['current_academic_year']??date('Y').'-'.date('Y',strtotime('+1 year'))); ?>"></div>
        <div class="col-md-6"><label class="form-label">Current Semester</label><select name="settings[current_semester]" class="form-select"><?php for($i=1;$i<=8;$i++): ?><option value="<?php echo $i; ?>" <?php echo ($settings['current_semester']??1)==$i?'selected':''; ?>>Sem <?php echo $i; ?></option><?php endfor; ?></select></div>
        <div class="col-md-6"><label class="form-label">Min. Attendance %</label><input type="number" name="settings[minimum_attendance_percentage]" class="form-control" value="<?php echo htmlspecialchars($settings['minimum_attendance_percentage']??75); ?>" min="0" max="100"></div>
        <div class="col-md-6"><label class="form-label">Passing Marks %</label><input type="number" name="settings[passing_marks_percentage]" class="form-control" value="<?php echo htmlspecialchars($settings['passing_marks_percentage']??35); ?>" min="0" max="100"></div>
        <div class="col-md-6"><label class="form-label">Date Format</label><select name="settings[date_format]" class="form-select"><option value="d/m/Y" <?php echo ($settings['date_format']??'')==='d/m/Y'?'selected':''; ?>>DD/MM/YYYY</option><option value="Y-m-d" <?php echo ($settings['date_format']??'')==='Y-m-d'?'selected':''; ?>>YYYY-MM-DD</option></select></div>
    </div></div></div></div>
    <div class="col-12"><button type="submit" class="btn btn-olive"><i class="bi bi-check2-circle me-1"></i>Save Settings</button></div>
</div>
</form>
