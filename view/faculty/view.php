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
                <div class="text-start small">
                    <div class="mb-1"><i class="bi bi-tag me-2 text-muted"></i><strong>Category:</strong> <?php echo htmlspecialchars($s['cat_name']??'—'); ?></div>
                    <div class="mb-1"><i class="bi bi-award me-2 text-muted"></i><strong>Designation:</strong> <?php echo htmlspecialchars($s['desig_name']??'—'); ?></div>
                    <div class="mb-1"><i class="bi bi-calendar me-2 text-muted"></i><strong>Joined:</strong> <?php echo $s['joining_date']??'—'; ?></div>
                    <div class="mb-1"><i class="bi bi-book me-2 text-muted"></i><strong>Qualification:</strong> <?php echo htmlspecialchars($s['qualification']??'—'); ?></div>
                </div>
            </div>
        </div>
        
        <?php
        $act_stmt = $pdo->prepare("SELECT COUNT(*) FROM staff_activities WHERE staff_id=? AND status='pending'");
        $act_stmt->execute([$id]);
        $pending_acts = $act_stmt->fetchColumn();
        
        $sal_stmt = $pdo->prepare("SELECT SUM(amount_paid + bonus - deductions) FROM staff_salaries WHERE staff_id=?");
        $sal_stmt->execute([$id]);
        $total_paid = $sal_stmt->fetchColumn();
        ?>
        <div class="card mt-3">
            <div class="card-body">
                <h6 class="mb-3">Management Summary</h6>
                <div class="d-flex justify-content-between mb-2"><span>Pending Activities</span><span class="badge bg-warning"><?php echo $pending_acts; ?></span></div>
                <div class="d-flex justify-content-between"><span>Total Salary Paid</span><span class="fw-bold text-success">₹<?php echo number_format($total_paid??0); ?></span></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-0">
                <ul class="nav nav-tabs card-header-tabs" id="staffTabs">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info">Information</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#activities">Activities</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#salary">Salary History</button></li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <!-- Info Tab -->
                <div class="tab-pane fade show active" id="info">
                    <h6 class="form-section-title">Contact Information</h6>
                    <div class="row g-2">
                        <?php foreach (['Email'=>$s['email'],'Phone'=>$s['phone'],'Alternate Phone'=>$s['alternate_phone'],'Address'=>$s['address'],'City'=>$s['city'],'State'=>$s['state'],'Pincode'=>$s['pincode']] as $lbl=>$val): ?>
                        <div class="col-md-6"><small class="text-muted"><?php echo $lbl; ?></small><div class="fw-medium"><?php echo htmlspecialchars($val??'—'); ?></div></div>
                        <?php endforeach; ?>
                    </div>
                    <h6 class="form-section-title mt-4">Financial Details</h6>
                    <div class="row g-2">
                        <div class="col-md-4"><small class="text-muted">Salary</small><div class="fw-medium">₹<?php echo number_format($s['salary']??0, 2); ?></div></div>
                        <div class="col-md-4"><small class="text-muted">PAN</small><div class="fw-medium"><?php echo htmlspecialchars($s['pan_number']??'—'); ?></div></div>
                        <div class="col-md-4"><small class="text-muted">Aadhaar</small><div class="fw-medium"><?php echo htmlspecialchars($s['aadhaar_number']??'—'); ?></div></div>
                    </div>
                    <?php if ($s['notes']): ?><h6 class="form-section-title mt-4">Notes</h6><p class="small text-muted"><?php echo nl2br(htmlspecialchars($s['notes'])); ?></p><?php endif; ?>
                </div>

                <!-- Activities Tab -->
                <div class="tab-pane fade" id="activities">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Staff Activities</h6>
                        <button class="btn btn-sm btn-olive" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-plus-circle me-1"></i>Add Activity</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover border">
                            <thead class="table-light"><tr><th>Date</th><th>Title</th><th>Category</th><th>Status</th></tr></thead>
                            <tbody class="small">
                                <?php
                                $acts = $pdo->prepare("SELECT * FROM staff_activities WHERE staff_id=? ORDER BY activity_date DESC");
                                $acts->execute([$id]);
                                $alist = $acts->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($alist as $a):
                                ?>
                                <tr>
                                    <td><?php echo $a['activity_date']; ?></td>
                                    <td><strong><?php echo htmlspecialchars($a['activity_title']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($a['category']); ?></td>
                                    <td><span class="badge <?php echo $a['status']==='completed'?'bg-success':'bg-warning text-dark'; ?>"><?php echo ucfirst($a['status']); ?></span></td>
                                </tr>
                                <?php endforeach; if (!$alist) echo '<tr><td colspan="4" class="text-center py-3">No activities recorded.</td></tr>'; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Salary Tab -->
                <div class="tab-pane fade" id="salary">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Salary Disbursements</h6>
                        <button class="btn btn-sm btn-olive" data-bs-toggle="modal" data-bs-target="#salaryModal"><i class="bi bi-cash me-1"></i>Record Payment</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover border">
                            <thead class="table-light"><tr><th>Month</th><th>Amount</th><th>Method</th><th>Date</th></tr></thead>
                            <tbody class="small">
                                <?php
                                $salaries = $pdo->prepare("SELECT * FROM staff_salaries WHERE staff_id=? ORDER BY payment_date DESC");
                                $salaries->execute([$id]);
                                $slist = $salaries->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($slist as $sl):
                                ?>
                                <tr>
                                    <td><?php echo $sl['month_year']; ?></td>
                                    <td><strong>₹<?php echo number_format($sl['amount_paid'] + $sl['bonus'] - $sl['deductions']); ?></strong></td>
                                    <td><?php echo ucfirst(str_replace('_',' ',$sl['payment_method'])); ?></td>
                                    <td><?php echo $sl['payment_date']; ?></td>
                                </tr>
                                <?php endforeach; if (!$slist) echo '<tr><td colspan="4" class="text-center py-3">No salary history.</td></tr>'; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ACTIVITY MODAL -->
<div class="modal fade" id="activityModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?php echo $B; ?>/controller/StaffController.php?action=add_activity" method="POST" class="modal-content">
            <input type="hidden" name="staff_id" value="<?php echo $id; ?>">
            <div class="modal-header"><h5 class="modal-title">Record Staff Activity</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Activity Title *</label><input type="text" name="activity_title" class="form-control" required></div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label">Date *</label><input type="date" name="activity_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Category</label><input type="text" name="category" class="form-control" placeholder="Duty, Meeting, etc."></div>
                </div>
                <div class="mb-3"><label class="form-label">Description</label><textarea name="activity_description" class="form-control" rows="2"></textarea></div>
                <div><label class="form-label">Status</label><select name="status" class="form-select"><option value="pending">Pending</option><option value="completed">Completed</option></select></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-olive">Save Activity</button></div>
        </form>
    </div>
</div>

<!-- SALARY MODAL -->
<div class="modal fade" id="salaryModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?php echo $B; ?>/controller/StaffController.php?action=add_salary" method="POST" class="modal-content">
            <input type="hidden" name="staff_id" value="<?php echo $id; ?>">
            <div class="modal-header"><h5 class="modal-title">Record Salary Payment</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label">For Month/Year *</label><input type="text" name="month_year" class="form-control" placeholder="April 2026" required></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Payment Date *</label><input type="date" name="payment_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3"><label class="form-label">Base Amount *</label><input type="number" name="amount_paid" class="form-control" value="<?php echo $s['salary']; ?>" step="0.01" required></div>
                    <div class="col-md-4 mb-3"><label class="form-label">Bonus</label><input type="number" name="bonus" class="form-control" value="0" step="0.01"></div>
                    <div class="col-md-4 mb-3"><label class="form-label">Deductions</label><input type="number" name="deductions" class="form-control" value="0" step="0.01"></div>
                </div>
                <div class="mb-3"><label class="form-label">Payment Method</label><select name="payment_method" class="form-select"><option value="bank_transfer">Bank Transfer</option><option value="cash">Cash</option><option value="cheque">Cheque</option></select></div>
                <div class="mb-3"><label class="form-label">Receipt/Ref No.</label><input type="text" name="receipt_no" class="form-control"></div>
                <div><label class="form-label">Remarks</label><input type="text" name="remarks" class="form-control"></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-olive">Record Payment</button></div>
        </form>
    </div>
</div>
