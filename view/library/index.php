<?php
// view/library/index.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM library_books WHERE id=?")->execute([(int)$_GET['id']]);
    $_SESSION['flash'] = 'Book removed.'; header('Location: '.BASE_URL.'/index.php?page=library-management'); exit;
}
$rows = $pdo->query("SELECT * FROM library_books ORDER BY title")->fetchAll(PDO::FETCH_ASSOC);
$totalBooks    = array_sum(array_column($rows,'total_copies'));
$availableBooks= array_sum(array_column($rows,'available_copies'));
$B = BASE_URL;
?>
<div class="page-header">
    <div><h1 class="page-title"><i class="bi bi-journal-bookmark me-2" style="color:var(--olive)"></i>Library Management</h1></div>
    <a href="<?php echo $B; ?>/index.php?page=library-add" class="btn btn-olive"><i class="bi bi-plus-circle me-1"></i>Add Book</a>
</div>
<?php if (isset($_SESSION['flash'])): ?><div class="alert alert-success flash-msg"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></div><?php endif; ?>
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="stat-card" style="background:var(--olive)"><div><h6>Total Titles</h6><h2><?php echo count($rows); ?></h2></div><i class="bi bi-journals stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--maroon)"><div><h6>Total Copies</h6><h2><?php echo $totalBooks; ?></h2></div><i class="bi bi-book-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:#27ae60"><div><h6>Available</h6><h2><?php echo $availableBooks; ?></h2></div><i class="bi bi-check-circle-fill stat-icon"></i></div></div>
    <div class="col-md-3"><div class="stat-card" style="background:var(--charcoal)"><div><h6>Issued</h6><h2><?php echo $totalBooks - $availableBooks; ?></h2></div><i class="bi bi-arrow-right-circle-fill stat-icon"></i></div></div>
</div>
<div class="card"><div class="card-header d-flex justify-content-between"><h6 class="mb-0">Library Catalog</h6><input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px"></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>ISBN</th><th>Title</th><th>Author</th><th>Category</th><th>Publisher</th><th>Year</th><th>Copies</th><th>Available</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if ($rows): foreach ($rows as $i => $r): ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><code><?php echo htmlspecialchars($r['isbn']??'—'); ?></code></td>
            <td><strong><?php echo htmlspecialchars($r['title']); ?></strong></td>
            <td><?php echo htmlspecialchars($r['author']); ?></td>
            <td><?php echo htmlspecialchars($r['category']??'—'); ?></td>
            <td><?php echo htmlspecialchars($r['publisher']??'—'); ?></td>
            <td><?php echo $r['publication_year']??'—'; ?></td>
            <td><?php echo $r['total_copies']; ?></td>
            <td><span class="badge <?php echo $r['available_copies']>0?'badge-active':'badge-inactive'; ?>"><?php echo $r['available_copies']; ?></span></td>
            <td>
                <a href="<?php echo $B; ?>/index.php?page=library-add&edit=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <a href="?page=library-management&action=delete&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-danger confirm-delete"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; else: ?><tr><td colspan="10" class="text-center py-5 text-muted">No books in catalog.</td></tr><?php endif; ?>
    </tbody>
</table></div></div></div>
