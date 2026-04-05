<?php
// view/performance/index.php — Academic Performance REVAMPED
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Handle POST actions (Save/Edit/Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'save_grade') {
        $data = [
            $_POST['student_id'], $_POST['batch_id'] ?: null, $_POST['academic_year'] ?: date('Y'),
            $_POST['subject_id'], $_POST['examination_id'] ?: null, $_POST['total_marks'], 
            $_POST['marks_obtained'], $_POST['grade'] ?: null, $_POST['remarks'] ?: null,
            $_POST['is_internal'] ?? 0, $_POST['is_practical'] ?? 0, 
            $_POST['is_project'] ?? 0, $_POST['is_semester'] ?? 0, $_SESSION['user_id']
        ];
        if (!empty($_POST['edit_id'])) {
            $pdo->prepare("UPDATE student_grades SET student_id=?, batch_id=?, academic_year=?, subject_id=?, examination_id=?, total_marks=?, marks_obtained=?, grade=?, remarks=?, is_internal=?, is_practical=?, is_project=?, is_semester=? WHERE id=?")
                ->execute(array_merge($data, [(int)$_POST['edit_id']]));
            $_SESSION['flash'] = 'Record updated successfully.';
        } else {
            $pdo->prepare("INSERT INTO student_grades (student_id, batch_id, academic_year, subject_id, examination_id, total_marks, marks_obtained, grade, remarks, is_internal, is_practical, is_project, is_semester, created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)")
                ->execute($data);
            $_SESSION['flash'] = 'Record added successfully.';
        }
    } elseif ($_POST['action'] === 'delete_grade' && isset($_POST['id'])) {
        $pdo->prepare("DELETE FROM student_grades WHERE id=?")->execute([(int)$_POST['id']]);
        echo json_encode(['success' => true]); exit;
    }
    header('Location: '.BASE_URL.'/index.php?page=academic-performance'); exit;
}

// Fetch Records with filters
$type_filter = $_GET['type'] ?? 'all';
$where = "WHERE 1=1";
if ($type_filter === 'internal') $where .= " AND sg.is_internal=1";
elseif ($type_filter === 'practical') $where .= " AND sg.is_practical=1";
elseif ($type_filter === 'project') $where .= " AND sg.is_project=1";
elseif ($type_filter === 'semester') $where .= " AND sg.is_semester=1";

$rows = $pdo->query("SELECT sg.*, CONCAT(s.first_name,' ',s.last_name) AS student_name, s.registration_no, s.roll, s.admission_number, sub.name AS subject_name, sub.code AS sub_code, b.batch_code, e.name AS exam_name, (sg.marks_obtained/NULLIF(sg.total_marks,0)*100) AS percentage, IF((sg.marks_obtained/NULLIF(sg.total_marks,0))>=0.4, 'pass', 'fail') AS result FROM student_grades sg JOIN students s ON sg.student_id=s.id JOIN subjects sub ON sg.subject_id=sub.id LEFT JOIN academic_batches b ON sg.batch_id=b.id LEFT JOIN examinations e ON sg.examination_id=e.id $where ORDER BY sg.created_at DESC LIMIT 200")->fetchAll(PDO::FETCH_ASSOC);

$B = BASE_URL;
?>
<div class="page-header justify-content-between">
    <div>
        <h1 class="page-title"><i class="bi bi-bar-chart-line me-2" style="color:var(--olive)"></i>Academic Performance</h1>
        <p class="page-subtitle">Unified result management for Internals, Practical, Projects, and Semester exams.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-olive" data-bs-toggle="modal" data-bs-target="#addGradeModal"><i class="bi bi-plus-circle me-1"></i>Add Record</button>
    </div>
</div>

<!-- Tabs for Modularity -->
<ul class="nav nav-pills mb-4 gap-2">
    <li class="nav-item"><a class="nav-link <?php echo $type_filter=='all'?'active bg-olive text-white':'text-muted border'; ?>" href="?page=academic-performance&type=all">All Results</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $type_filter=='internal'?'active bg-olive text-white':'text-muted border'; ?>" href="?page=academic-performance&type=internal">Internals</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $type_filter=='practical'?'active bg-olive text-white':'text-muted border'; ?>" href="?page=academic-performance&type=practical">Practicals</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $type_filter=='project'?'active bg-olive text-white':'text-muted border'; ?>" href="?page=academic-performance&type=project">Projects</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $type_filter=='semester'?'active bg-olive text-white':'text-muted border'; ?>" href="?page=academic-performance&type=semester">Semester</a></li>
</ul>

<?php if ($rows): 
    $avg = array_sum(array_column($rows,'percentage')) / count($rows);
    $pass = count(array_filter($rows, fn($r) => $r['result']==='pass'));
    $fail = count($rows) - $pass;
?>
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="stat-card" style="background:var(--olive)"><div><h6>Records</h6><h2><?php echo count($rows); ?></h2></div><i class="bi bi-list-ol stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:#27ae60"><div><h6>Pass</h6><h2><?php echo $pass; ?></h2></div><i class="bi bi-trophy-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--maroon)"><div><h6>Fail</h6><h2><?php echo $fail; ?></h2></div><i class="bi bi-x-octagon-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--charcoal)"><div><h6>Avg %</h6><h2><?php echo number_format($avg,1); ?>%</h2></div><i class="bi bi-percent stat-icon"></i></div></div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Grade Records <span class="badge bg-secondary ms-2"><?php echo count($rows); ?></span></h6>
        <div class="d-flex"><select id="tableFilter" class="form-select form-select-sm me-2" style="width:120px"><option value="">All Pass/Fail</option><option value="pass">Pass Only</option><option value="fail">Fail Only</option></select><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Quick Search Student/Subject…" style="width:220px"></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Reg/Roll</th><th>Student</th><th>Subject</th><th>Exam Detail</th><th>Marks</th><th>%</th><th>Grade</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if ($rows): foreach ($rows as $i => $r): ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><small class="text-muted">R:</small><code><?php echo htmlspecialchars($r['registration_no'] ?: $r['admission_number']); ?></code><br><small class="text-muted">P:</small><code><?php echo htmlspecialchars($r['roll'] ?: '—'); ?></code></td>
                        <td><strong><?php echo htmlspecialchars($r['student_name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($r['sub_code'].' - '.$r['subject_name']); ?></td>
                        <td>
                            <div class="small">
                                <div><?php echo htmlspecialchars($r['exam_name'] ?: 'Continuous'); ?></div>
                                <?php if($r['is_internal']) echo '<span class="badge bg-info px-1 py-0" style="font-size:0.6rem">Internal</span>'; ?>
                                <?php if($r['is_practical']) echo '<span class="badge bg-success px-1 py-0" style="font-size:0.6rem">Practical</span>'; ?>
                                <?php if($r['is_project']) echo '<span class="badge bg-warning text-dark px-1 py-0" style="font-size:0.6rem">Project</span>'; ?>
                                <?php if($r['is_semester']) echo '<span class="badge bg-primary px-1 py-0" style="font-size:0.6rem">Semester</span>'; ?>
                            </div>
                        </td>
                        <td><?php echo $r['marks_obtained']; ?>/<?php echo $r['total_marks']; ?></td>
                        <td><strong class="<?php echo $r['result']==='pass'?'text-success':'text-danger'; ?>"><?php echo number_format($r['percentage'],1); ?>%</strong></td>
                        <td><span class="badge" style="background:var(--olive-light);color:var(--olive)"><?php echo $r['grade']; ?></span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary edit-grade" data-json='<?php echo json_encode($r); ?>'><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger confirm-delete-grade" data-id="<?php echo $r['id']; ?>"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; else: ?><tr><td colspan="9" class="text-center py-5 text-muted"><i class="bi bi-inbox fs-2 d-block"></i>No records found in this category.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'performance_modal.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit Grade
    document.querySelectorAll('.edit-grade').forEach(btn => {
        btn.addEventListener('click', function() {
            const data = JSON.parse(this.dataset.json);
            document.getElementById('grade_edit_id').value = data.id;
            document.getElementById('grade_student_id').value = data.student_id;
            document.getElementById('grade_subject_id').value = data.subject_id;
            document.getElementById('grade_examination_id').value = data.examination_id || "";
            document.getElementById('grade_batch_id').value = data.batch_id || "";
            document.getElementById('grade_academic_year').value = data.academic_year || "";
            document.getElementById('grade_marks_obtained').value = data.marks_obtained;
            document.getElementById('grade_total_marks').value = data.total_marks;
            document.getElementById('grade_val').value = data.grade || "";
            document.getElementById('grade_remarks').value = data.remarks || "";
            
            document.getElementById('checkInt').checked = data.is_internal == 1;
            document.getElementById('checkPrac').checked = data.is_practical == 1;
            document.getElementById('checkProj').checked = data.is_project == 1;
            document.getElementById('checkSem').checked = data.is_semester == 1;
            
            document.getElementById('gradeModalLabel').textContent = "Edit Performance Record";
            new bootstrap.Modal(document.getElementById('addGradeModal')).show();
        });
    });

    // Delete Grade
    document.querySelectorAll('.confirm-delete-grade').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm("Delete this grade record?")) {
                const id = this.dataset.id;
                fetch('index.php?page=academic-performance', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'action=delete_grade&id=' + id
                }).then(res => res.json()).then(data => {
                    if(data.success) location.reload();
                });
            }
        });
    });
});
</script>
