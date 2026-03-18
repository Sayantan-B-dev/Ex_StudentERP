<?php
// view/fees/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$students = $pdo->query("SELECT id, admission_number, first_name, last_name FROM students WHERE status='active' ORDER BY first_name")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year   = date('Y');
    $count  = $pdo->query("SELECT COUNT(*) FROM fee_transactions WHERE YEAR(created_at)=".date('Y'))->fetchColumn();
    $receipt = 'RCP'.$year.str_pad($count+1, 5, '0', STR_PAD_LEFT);
    $pdo->prepare("INSERT INTO fee_transactions (student_id,receipt_number,fee_type,academic_year,semester,amount_due,amount_paid,discount,late_fee,payment_method,payment_status,transaction_date,bank_reference,remarks,created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")
        ->execute([$_POST['student_id'],$receipt,$_POST['fee_type']??'tuition',$_POST['academic_year'],intval($_POST['semester']),$_POST['amount_due'],$_POST['amount_paid'],$_POST['discount']??0,$_POST['late_fee']??0,$_POST['payment_method']??'cash',$_POST['payment_status']??'paid',$_POST['transaction_date']??date('Y-m-d'),$_POST['bank_reference']??null,$_POST['remarks']??null,$_SESSION['user_id']]);
    logActivity($pdo, 'Record Fee', 'Fees', "Recorded payment of ₹$_POST[amount_paid] (Receipt: $receipt)");
    $_SESSION['flash'] = "Payment recorded. Receipt: $receipt";
    header('Location: '.BASE_URL.'/index.php?page=fee-financial'); exit;
}
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-cash-coin me-2" style="color:var(--olive)"></i>Record Fee Payment</h1></div><a href="<?php echo $B; ?>/index.php?page=fee-financial" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Student *</label><select name="student_id" class="form-select" required><option value="">Select Student</option><?php foreach ($students as $s): ?><option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['admission_number'].' - '.$s['first_name'].' '.$s['last_name']); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Fee Type</label><select name="fee_type" class="form-select"><?php foreach (['tuition','examination','library','hostel','transport','lab','admission','other'] as $ft): ?><option value="<?php echo $ft; ?>"><?php echo ucfirst($ft); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Transaction Date</label><input type="date" name="transaction_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"></div>
    <div class="col-md-3"><label class="form-label">Academic Year</label><input type="text" name="academic_year" class="form-control" value="<?php echo date('Y').'-'.date('Y',strtotime('+1 year')); ?>"></div>
    <div class="col-md-2"><label class="form-label">Semester</label><select name="semester" class="form-select"><?php for($i=1;$i<=8;$i++): ?><option value="<?php echo $i; ?>">Sem <?php echo $i; ?></option><?php endfor; ?></select></div>
    <div class="col-md-2"><label class="form-label">Amount Due (₹)</label><input type="number" name="amount_due" class="form-control" step="0.01" required></div>
    <div class="col-md-2"><label class="form-label">Discount</label><input type="number" name="discount" class="form-control" step="0.01" value="0"></div>
    <div class="col-md-2"><label class="form-label">Late Fee</label><input type="number" name="late_fee" class="form-control" step="0.01" value="0"></div>
    <div class="col-md-2"><label class="form-label">Amount Paid (₹)</label><input type="number" name="amount_paid" class="form-control" step="0.01" required></div>
    <div class="col-md-3"><label class="form-label">Payment Method</label><select name="payment_method" class="form-select"><?php foreach (['cash','cheque','online_transfer','neft','rtgs','upi','demand_draft'] as $pm): ?><option value="<?php echo $pm; ?>"><?php echo ucfirst(str_replace('_',' ',$pm)); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="payment_status" class="form-select"><?php foreach (['paid','partial','pending','overdue'] as $ps): ?><option value="<?php echo $ps; ?>"><?php echo ucfirst($ps); ?></option><?php endforeach; ?></select></div>
    <div class="col-md-6"><label class="form-label">Bank Reference / Transaction ID</label><input type="text" name="bank_reference" class="form-control" placeholder="UTR / Ref No"></div>
    <div class="col-md-6"><label class="form-label">Remarks</label><input type="text" name="remarks" class="form-control" placeholder="Any additional notes"></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive"><i class="bi bi-check2-circle me-1"></i>Record Payment</button><a href="<?php echo $B; ?>/index.php?page=fee-financial" class="btn btn-outline-secondary">Cancel</a></div>
</form>

<div class="form-help-card">
    <h6><i class="bi bi-info-circle me-2"></i>Fee Payment Help</h6>
    <div class="form-help-grid">
        <div class="help-item"><b>Receipt No</b><span>Automatically generated (e.g., RCP202400001).</span></div>
        <div class="help-item"><b>Amount Due</b><span>The total amount to be paid before any discounts.</span></div>
        <div class="help-item"><b>Bank Ref</b><span>Mandatory for Online/UPI transactions. Enter UTR or Transaction ID.</span></div>
    </div>
</div>
