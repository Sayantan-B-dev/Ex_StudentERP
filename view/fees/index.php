<?php
// view/fees/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo->prepare("DELETE FROM fee_transactions WHERE id=?")->execute([$id]);
    logActivity($pdo, 'Delete Fee', 'Fees', "Deleted record for fee transaction ID: $id");
    $_SESSION['flash'] = 'Transaction deleted.'; header('Location: '.BASE_URL.'/index.php?page=fee-financial'); exit;
}
$rows = $pdo->query("SELECT ft.*, CONCAT(s.first_name,' ',s.last_name) AS student_name, s.admission_number FROM fee_transactions ft JOIN students s ON ft.student_id=s.id ORDER BY ft.transaction_date DESC LIMIT 80")->fetchAll(PDO::FETCH_ASSOC);
$totalCollected = $pdo->query("SELECT SUM(amount_paid) FROM fee_transactions WHERE payment_status='paid'")->fetchColumn();
$pending        = $pdo->query("SELECT SUM(amount_due) FROM fee_transactions WHERE payment_status='pending'")->fetchColumn();
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-cash-stack me-2" style="color:var(--olive)"></i>Fee & Financial</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=fee-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Record Payment</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="stat-card" style="background:var(--olive)"><div><h6>Total Collected</h6><h2>₹<?php echo number_format($totalCollected??0); ?></h2></div><i class="bi bi-cash-stack stat-icon"></i></div></div>
    <div class="col-md-4"><div class="stat-card" style="background:var(--maroon)"><div><h6>Pending Amount</h6><h2>₹<?php echo number_format($pending??0); ?></h2></div><i class="bi bi-exclamation-circle-fill stat-icon"></i></div></div>
    <div class="col-md-4"><div class="stat-card" style="background:var(--charcoal)"><div><h6>Total Transactions</h6><h2><?php echo count($rows); ?></h2></div><i class="bi bi-receipt stat-icon"></i></div></div>
</div>
<!-- Table -->
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">Fee Transactions</h6><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px"></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Receipt</th><th>Student</th><th>Adm. No.</th><th>Fee Type</th><th>Amount Due</th><th>Amount Paid</th><th>Date</th><th>Method</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r):
        $badge = match($r['payment_status']){'paid'=>'badge-active','pending'=>'badge-pending','overdue'=>'badge-inactive','partial'=>'badge-pending',default=>'badge-pending'};
    ?>
        <tr>
            <td><?php echo $i+1; ?></td><td><code><?php echo htmlspecialchars($r['receipt_number']??'—'); ?></code></td>
            <td><?php echo htmlspecialchars($r['student_name']); ?></td><td><code><?php echo htmlspecialchars($r['admission_number']); ?></code></td>
            <td><?php echo ucfirst(str_replace('_',' ',$r['fee_type']??'—')); ?></td>
            <td>₹<?php echo number_format($r['amount_due']); ?></td>
            <td>₹<?php echo number_format($r['amount_paid']); ?></td>
            <td><?php echo $r['transaction_date']; ?></td>
            <td><?php echo ucfirst(str_replace('_',' ',$r['payment_method']??'—')); ?></td>
            <td><span class="badge <?php echo $badge; ?>"><?php echo ucfirst($r['payment_status']); ?></span></td>
            <td><a href="?page=fee-financial&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a></td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="11" class="text-center py-5 text-muted">No fee transactions.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
