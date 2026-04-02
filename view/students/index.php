<?php
// view/students/index.php — Student Information Management (List)
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';

$where = "WHERE 1=1";
$params = [];
if ($search) {
    $where .= " AND (s.first_name LIKE ? OR s.last_name LIKE ? OR s.admission_number LIKE ? OR s.phone LIKE ?)";
    $params = array_merge($params, ["%$search%","%$search%","%$search%","%$search%"]);
}
if ($status_filter) {
    $where .= " AND s.status = ?";
    $params[] = $status_filter;
}

$stmt = $pdo->prepare("SELECT s.*, p.name AS program_name, ab.batch_name
    FROM students s
    LEFT JOIN academic_programs p ON s.program_id = p.id
    LEFT JOIN academic_batches ab ON s.batch_id = ab.id
    $where ORDER BY s.created_at DESC");
$stmt->execute($params);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header">
    <div>
        <h1 class="page-title"><i class="bi bi-person-lines-fill me-2" style="color:var(--olive)"></i>Student Information (SIM)</h1>
        <p class="page-subtitle">Manage all student records — view, add, edit, delete.</p>
    </div>
    <a href="<?php echo $B; ?>/index.php?page=student-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Add Student</a>
</div>

<?php if (isset($_SESSION['flash'])): ?>
<div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <input type="hidden" name="page" value="student-information">
            <div class="col-md-5">
                <input type="text" name="q" class="form-control" placeholder="Search by name, admission no, phone…" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" <?php echo $status_filter=='active'?'selected':''; ?>>Active</option>
                    <option value="inactive" <?php echo $status_filter=='inactive'?'selected':''; ?>>Inactive</option>
                    <option value="graduated" <?php echo $status_filter=='graduated'?'selected':''; ?>>Graduated</option>
                    <option value="suspended" <?php echo $status_filter=='suspended'?'selected':''; ?>>Suspended</option>
                    <option value="discontinued" <?php echo $status_filter=='discontinued'?'selected':''; ?>>Discontinued</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-olive w-100"><i class="bi bi-search me-1"></i>Search</button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo $B; ?>/index.php?page=student-information" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Students <span class="badge bg-secondary"><?php echo count($students); ?></span></h6>
        <div class="d-flex"><select id="tableFilter" class="form-select form-select-sm me-2" style="width:120px"><option value="">All</option><option value="active">Active</option><option value="inactive">Inactive</option><option value="graduated">Graduated</option><option value="suspended">Suspended</option></select><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Quick filter…" style="width:200px"></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th><th>Admission No.</th><th>Name</th><th>Gender</th>
                        <th>Program</th><th>Batch</th><th>Semester</th>
                        <th>Phone</th><th>Status</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($students): foreach ($students as $i => $s):
                    $badge = match($s['status']) {
                        'active'   => 'badge-active',
                        'inactive' => 'badge-inactive',
                        'graduated'=> 'badge-completed',
                        default    => 'badge-pending'
                    };
                ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><code><?php echo htmlspecialchars($s['admission_number']); ?></code></td>
                        <td><?php echo htmlspecialchars($s['first_name'].' '.$s['middle_name'].' '.$s['last_name']); ?></td>
                        <td><?php echo ucfirst($s['gender']); ?></td>
                        <td><?php echo htmlspecialchars($s['program_name'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($s['batch_name'] ?? '—'); ?></td>
                        <td>Sem <?php echo $s['current_semester']; ?></td>
                        <td><?php echo htmlspecialchars($s['phone'] ?? '—'); ?></td>
                        <td><span class="badge <?php echo $badge; ?>"><?php echo ucfirst($s['status']); ?></span></td>
                        <td>
                            <a href="<?php echo $B; ?>/index.php?page=student-view&id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                            <a href="<?php echo $B; ?>/index.php?page=student-edit&id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                            <a href="<?php echo $B; ?>/controller/StudentController.php?action=delete&id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete" title="Delete"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="10" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>No students found.
                        <a href="<?php echo $B; ?>/index.php?page=student-add">Add your first student</a>
                    </td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
