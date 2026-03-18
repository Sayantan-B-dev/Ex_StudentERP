<?php
// view/communication/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM communications WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Notice deleted.'; header('Location: '.BASE_URL.'/index.php?page=communication'); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject'])) {
    $pdo->prepare("INSERT INTO communications (sender_id,sender_type,title,message,message_type,priority,target_type,target_id,is_published,published_at) VALUES (?,?,?,?,?,?,?,?,?,NOW())")
        ->execute([$_SESSION['user_id'],'admin',$_POST['subject'],$_POST['message'],$_POST['message_type']??'notice',$_POST['priority']??'medium',$_POST['target_type']??'all',$_POST['target_id']??null,1]);
    $_SESSION['flash'] = 'Message/notice published.'; header('Location: '.BASE_URL.'/index.php?page=communication'); exit;
}
$rows = $pdo->query("SELECT * FROM communications ORDER BY created_at DESC LIMIT 50")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-chat-dots me-2" style="color:var(--olive)"></i>Communication & Notices</h1></div></div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="row g-4">
    <!-- Compose -->
    <div class="col-md-4"><div class="card"><div class="card-header"><h6 class="mb-0"><i class="bi bi-pencil me-2"></i>Compose Notice</h6></div><div class="card-body">
        <form method="POST">
            <div class="mb-3"><label class="form-label">Message Type</label><select name="message_type" class="form-select"><option value="notice">Notice</option><option value="announcement">Announcement</option><option value="alert">Alert</option><option value="event">Event</option></select></div>
            <div class="mb-3"><label class="form-label">Priority</label><select name="priority" class="form-select"><option value="low">Low</option><option value="medium" selected>Medium</option><option value="high">High</option><option value="urgent">Urgent</option></select></div>
            <div class="mb-3"><label class="form-label">Target</label><select name="target_type" class="form-select"><option value="all">All</option><option value="students">Students</option><option value="staff">Staff</option></select></div>
            <div class="mb-3"><label class="form-label">Subject *</label><input type="text" name="subject" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Message *</label><textarea name="message" class="form-control" rows="5" required></textarea></div>
            <button type="submit" class="btn btn-olive w-100"><i class="bi bi-send me-1"></i>Publish</button>
        </form>
    </div></div></div>
    <!-- Messages list -->
    <div class="col-md-8">
        <div class="card"><div class="card-header"><h6 class="mb-0">Recent Notices <span class="badge bg-secondary"><?php echo count($rows); ?></span></h6></div>
        <div class="card-body p-0">
            <?php if ($rows): foreach ($rows as $r):
                $icon = match($r['message_type']){'notice'=>'bi-megaphone','announcement'=>'bi-broadcast','alert'=>'bi-exclamation-triangle','event'=>'bi-calendar-event',default=>'bi-chat-dots'};
                $pcolor = match($r['priority']){'urgent'=>'#800000','high'=>'#d35400','medium'=>'#f39c12','low'=>'#4a7c59',default=>'#888'};
            ?>
            <div class="p-3 border-bottom" style="border-left:4px solid <?php echo $pcolor; ?> !important">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <i class="bi <?php echo $icon; ?> me-2" style="color:<?php echo $pcolor; ?>"></i>
                        <strong><?php echo htmlspecialchars($r['title']); ?></strong>
                        <span class="badge ms-2" style="background:<?php echo $pcolor; ?>;color:#fff"><?php echo ucfirst($r['priority']); ?></span>
                        <span class="badge ms-1 bg-light text-dark"><?php echo ucfirst($r['message_type']); ?></span>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <small class="text-muted d-none d-md-inline"><?php echo date('d M Y, H:i', strtotime($r['created_at'])); ?></small>
                        <a href="?page=communication&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-link text-danger confirm-delete p-0 ms-2"><i class="bi bi-trash"></i></a>
                    </div>
                </div>
                <p class="mt-2 mb-0 text-muted" style="font-size:.87rem"><?php echo nl2br(htmlspecialchars(substr($r['message'],0,200))); ?><?php if(strlen($r['message'])>200) echo '…'; ?></p>
            </div>
            <?php endforeach; else: ?>
            <div class="text-center py-5 text-muted"><i class="bi bi-chat-square fs-2 d-block mb-2"></i>No messages yet.</div>
            <?php endif; ?>
        </div></div>
    </div>
</div>
