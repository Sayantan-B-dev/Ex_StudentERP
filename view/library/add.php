<?php
// view/library/add.php
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$id = (int)($_GET['edit'] ?? 0);
$editBook = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM library_books WHERE id=?");
    $stmt->execute([$id]);
    $editBook = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id) {
        $pdo->prepare("UPDATE library_books SET title=?,isbn=?,author=?,co_author=?,publisher=?,publication_year=?,edition=?,category=?,sub_category=?,language=?,total_pages=?,total_copies=?,available_copies=?,rack_number=?,shelf_number=?,description=?,status=? WHERE id=?")
            ->execute([$_POST['title'],$_POST['isbn']??null,$_POST['author'],$_POST['co_author']??null,$_POST['publisher']??null,$_POST['publication_year']??null,$_POST['edition']??null,$_POST['category']??null,$_POST['sub_category']??null,$_POST['language']??'English',$_POST['total_pages']??0,$_POST['total_copies']??1,$_POST['total_copies']??1,$_POST['rack_number']??null,$_POST['shelf_number']??null,$_POST['description']??null,$_POST['status']??'active',$id]);
        $_SESSION['flash'] = 'Book updated.';
    } else {
        $pdo->prepare("INSERT INTO library_books (title,isbn,author,co_author,publisher,publication_year,edition,category,sub_category,language,total_pages,total_copies,available_copies,rack_number,shelf_number,description,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")
            ->execute([$_POST['title'],$_POST['isbn']??null,$_POST['author'],$_POST['co_author']??null,$_POST['publisher']??null,$_POST['publication_year']??null,$_POST['edition']??null,$_POST['category']??null,$_POST['sub_category']??null,$_POST['language']??'English',$_POST['total_pages']??0,$_POST['total_copies']??1,$_POST['total_copies']??1,$_POST['rack_number']??null,$_POST['shelf_number']??null,$_POST['description']??null,'available']);
        $_SESSION['flash'] = 'Book added to library.';
    }
    header('Location: '.BASE_URL.'/index.php?page=library-management'); exit;
}
$B = BASE_URL; $t = $editBook ?: [];
?>
<div class="page-header"><div><h1 class="page-title"><i class="bi bi-journal-plus me-2" style="color:var(--olive)"></i><?php echo $id?'Edit':'Add'; ?> Book</h1></div><a href="<?php echo $B; ?>/index.php?page=library-management" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST"><div class="card mb-4"><div class="card-body"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($t['title']??''); ?>" placeholder="e.g. Introduction to Algorithms" required></div>
    <div class="col-md-3"><label class="form-label">ISBN</label><input type="text" name="isbn" class="form-control" value="<?php echo htmlspecialchars($t['isbn']??''); ?>" placeholder="13-digit ISBN"></div>
    <div class="col-md-3"><label class="form-label">Edition</label><input type="text" name="edition" class="form-control" value="<?php echo htmlspecialchars($t['edition']??''); ?>" placeholder="e.g. 3rd Edition"></div>
    <div class="col-md-4"><label class="form-label">Author *</label><input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($t['author']??''); ?>" placeholder="Primary Author Name" required></div>
    <div class="col-md-4"><label class="form-label">Co-Author</label><input type="text" name="co_author" class="form-control" value="<?php echo htmlspecialchars($t['co_author']??''); ?>" placeholder="Secondary Authors"></div>
    <div class="col-md-4"><label class="form-label">Publisher</label><input type="text" name="publisher" class="form-control" value="<?php echo htmlspecialchars($t['publisher']??''); ?>" placeholder="Publisher Name"></div>
    <div class="col-md-3"><label class="form-label">Publication Year</label><input type="number" name="publication_year" class="form-control" value="<?php echo $t['publication_year']??''; ?>" placeholder="YYYY"></div>
    <div class="col-md-3"><label class="form-label">Category</label><select name="category" class="form-select"><?php foreach (['Computer Science','Engineering','Mathematics','Science','Arts','Commerce','General','Reference'] as $cat): ?><option value="<?php echo $cat; ?>" <?php echo ($t['category']??'')===$cat?'selected':''; ?>><?php echo $cat; ?></option><?php endforeach; ?></select></div>
    <div class="col-md-3"><label class="form-label">Language</label><input type="text" name="language" class="form-control" value="<?php echo htmlspecialchars($t['language']??'English'); ?>" placeholder="e.g. English"></div>
    <div class="col-md-3"><label class="form-label">Total Pages</label><input type="number" name="total_pages" class="form-control" value="<?php echo $t['total_pages']??''; ?>" placeholder="0"></div>
    <div class="col-md-3"><label class="form-label">Total Copies</label><input type="number" name="total_copies" class="form-control" value="<?php echo $t['total_copies']??1; ?>" required></div>
    <div class="col-md-3"><label class="form-label">Rack Number</label><input type="text" name="rack_number" class="form-control" value="<?php echo htmlspecialchars($t['rack_number']??''); ?>" placeholder="e.g. R-12"></div>
    <div class="col-md-3"><label class="form-label">Shelf Number</label><input type="text" name="shelf_number" class="form-control" value="<?php echo htmlspecialchars($t['shelf_number']??''); ?>" placeholder="e.g. S-4"></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="available" <?php echo ($t['status']??'')==='available'?'selected':''; ?>>Available</option><option value="active" <?php echo ($t['status']??'')==='active'?'selected':''; ?>>Active</option><option value="lost" <?php echo ($t['status']??'')==='lost'?'selected':''; ?>>Lost</option><option value="damaged" <?php echo ($t['status']??'')==='damaged'?'selected':''; ?>>Damaged</option></select></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2" placeholder="Brief book summary or condition notes..."><?php echo htmlspecialchars($t['description']??''); ?></textarea></div>
</div></div></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-olive"><?php echo $id?'Update':'Add to Library'; ?></button><a href="<?php echo $B; ?>/index.php?page=library-management" class="btn btn-outline-secondary">Cancel</a></div>
</form>

<div class="form-help-card">
    <h6><i class="bi bi-info-circle me-2"></i>Library Entry Help</h6>
    <div class="form-help-grid">
        <div class="help-item"><b>ISBN</b><span>International Standard Book Number. Use 10 or 13 digit format without dashes.</span></div>
        <div class="help-item"><b>Rack/Shelf</b><span>Physical location code to help staff find the book in the library.</span></div>
        <div class="help-item"><b>Total Copies</b><span>The total number of physical units available for this title.</span></div>
    </div>
</div>
