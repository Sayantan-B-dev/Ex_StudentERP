<?php
// view/performance/performance_modal.php — Modals for adding/editing performance records
if (!isset($pdo)) exit;

$subjects_list = $pdo->query("SELECT id, name, code FROM subjects WHERE status='active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$batches_list  = $pdo->query("SELECT id, batch_name, batch_code FROM academic_batches WHERE status='active' ORDER BY batch_name")->fetchAll(PDO::FETCH_ASSOC);
$exams_list    = $pdo->query("SELECT id, name FROM examinations ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$students_list = $pdo->query("SELECT id, CONCAT(first_name,' ',last_name) AS name, admission_number FROM students WHERE status='active' ORDER BY first_name")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="modal fade" id="addGradeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="gradeForm" class="modal-content">
            <input type="hidden" name="action" value="save_grade">
            <input type="hidden" name="edit_id" id="grade_edit_id">
            <div class="modal-header">
                <h5 class="modal-title" id="gradeModalLabel">Add Grade Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Student *</label>
                        <select name="student_id" id="grade_student_id" class="form-select" required>
                            <option value="">Select Student</option>
                            <?php foreach ($students_list as $s): ?>
                                <option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['name'].' ('.$s['admission_number'].')'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Subject *</label>
                        <select name="subject_id" id="grade_subject_id" class="form-select" required>
                            <option value="">Select Subject</option>
                            <?php foreach ($subjects_list as $sub): ?>
                                <option value="<?php echo $sub['id']; ?>"><?php echo htmlspecialchars($sub['code'].' - '.$sub['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Examination</label>
                        <select name="examination_id" id="grade_examination_id" class="form-select">
                            <option value="">N/A (Continuous Evaluation)</option>
                            <?php foreach ($exams_list as $e): ?>
                                <option value="<?php echo $e['id']; ?>"><?php echo htmlspecialchars($e['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Batch</label>
                        <select name="batch_id" id="grade_batch_id" class="form-select">
                            <option value="">Select</option>
                            <?php foreach ($batches_list as $b): ?>
                                <option value="<?php echo $b['id']; ?>"><?php echo htmlspecialchars($b['batch_code']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Year</label>
                        <input type="text" name="academic_year" id="grade_academic_year" class="form-control" value="<?php echo date('Y'); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Obtained Marks *</label>
                        <input type="number" name="marks_obtained" id="grade_marks_obtained" class="form-control" step="0.01" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Total Marks *</label>
                        <input type="number" name="total_marks" id="grade_total_marks" class="form-control" step="0.01" value="100" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Grade</label>
                        <input type="text" name="grade" id="grade_val" class="form-control" placeholder="A, B, C, etc.">
                    </div>
                    <div class="col-12">
                        <div class="d-flex gap-3">
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="is_internal" value="1" id="checkInt"><label class="form-check-label" for="checkInt">Internal</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="is_practical" value="1" id="checkPrac"><label class="form-check-label" for="checkPrac">Practical</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="is_project" value="1" id="checkProj"><label class="form-check-label" for="checkProj">Project</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="is_semester" value="1" id="checkSem"><label class="form-check-label" for="checkSem">Semester</label></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" id="grade_remarks" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-olive">Save Record</button>
            </div>
        </form>
    </div>
</div>
