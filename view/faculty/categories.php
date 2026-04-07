<?php
// view/faculty/categories.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM staff_categories WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Category deleted.'; header('Location: '.BASE_URL.'/index.php?page=staff-categories'); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['edit_id'])) {
        $pdo->prepare("UPDATE staff_categories SET name=?,code=?,description=? WHERE id=?")->execute([$_POST['name'],$_POST['code'],$_POST['description']??null,(int)$_POST['edit_id']]);
        $_SESSION['flash'] = 'Category updated.';
    } else {
        $pdo->prepare("INSERT INTO staff_categories (name,code,description,status) VALUES (?,?,?,?)")->execute([$_POST['name'],$_POST['code'],$_POST['description']??null,'active']);
        $_SESSION['flash'] = 'Category added.';
    }
    header('Location: '.BASE_URL.'/index.php?page=staff-categories'); exit;
}
$rows = $pdo->query("SELECT * FROM staff_categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$B = BASE_URL;
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-tag me-2" style="color:var(--olive)"></i>Staff Categories</h1></div></div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card"><div class="card-header"><h6 class="mb-0" id="form-title">Add Category</h6></div><div class="card-body">
            <form method="POST" id="category-form">
                <input type="hidden" name="edit_id" id="edit-id">
                <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" id="name" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Code *</label><input type="text" name="code" id="code" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Description</label><textarea name="description" id="description" class="form-control" rows="2"></textarea></div>
                <button type="submit" class="btn btn-olive w-100" id="submit-btn">Add Category</button>
                <button type="button" class="btn btn-outline-secondary w-100 mt-2 d-none" id="cancel-btn">Cancel Edit</button>
            </form>
        </div></div>
    </div>
    <div class="col-md-8">
        <div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>Code</th><th>Name</th><th>Description</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
            <?php if ($rows): foreach ($rows as $i => $r): ?>
                <tr><td><?php echo $i+1; ?></td><td><code><?php echo htmlspecialchars($r['code']); ?></code></td><td><?php echo htmlspecialchars($r['name']); ?></td><td><?php echo htmlspecialchars($r['description']??''); ?></td><td><span class="badge badge-active"><?php echo ucfirst($r['status']); ?></span></td>
                <td>
                    <button class="btn btn-sm btn-outline-primary edit-category" data-id="<?php echo $r['id']; ?>" data-name="<?php echo htmlspecialchars($r['name']); ?>" data-code="<?php echo htmlspecialchars($r['code']); ?>" data-description="<?php echo htmlspecialchars($r['description']??''); ?>"><i class="bi bi-pencil"></i></button>
                    <a href="?page=staff-categories&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a>
                </td></tr>
            <?php endforeach; else: ?><tr><td colspan="6" class="text-center py-4 text-muted">No categories.</td></tr><?php endif; ?>
            </tbody>
        </table></div></div></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.edit-category');
    const form = document.getElementById('category-form');
    const formTitle = document.getElementById('form-title');
    const submitBtn = document.getElementById('submit-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const data = this.dataset;
            document.getElementById('edit-id').value = data.id;
            document.getElementById('name').value = data.name;
            document.getElementById('code').value = data.code;
            document.getElementById('description').value = data.description;
            
            formTitle.textContent = 'Edit Category';
            submitBtn.textContent = 'Update Category';
            cancelBtn.classList.remove('d-none');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
    
    cancelBtn.addEventListener('click', function() {
        form.reset();
        document.getElementById('edit-id').value = '';
        formTitle.textContent = 'Add Category';
        submitBtn.textContent = 'Add Category';
        this.classList.add('d-none');
    });
});
</script>
