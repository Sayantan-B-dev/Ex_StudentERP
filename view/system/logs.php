<?php
// view/system/logs.php — Activity Logs for Admins
require_once __DIR__ . '/../../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Simple pagination logic
$page_no = (int)($_GET['p'] ?? 1);
$per_page = 50;
$offset = ($page_no - 1) * $per_page;
$ignore_auth = isset($_GET['ignore_auth']) && $_GET['ignore_auth'] == '1';

$where_clause = $ignore_auth ? "WHERE l.module != 'Auth'" : "";

$logs = $pdo->query("SELECT l.*, u.name as user_name, u.role as user_role 
                    FROM audit_logs l 
                    LEFT JOIN users u ON l.user_id = u.id 
                    $where_clause
                    ORDER BY l.created_at DESC 
                    LIMIT $per_page OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);

$total = $pdo->query("SELECT COUNT(*) FROM audit_logs l $where_clause")->fetchColumn();
$total_pages = ceil($total / $per_page);

$B = BASE_URL;
?>
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title"><i class="bi bi-shield-check me-2 text-olive"></i>System Audit Logs</h1>
        <p class="text-muted small">Tracking global system activity and modifications.</p>
    </div>
    <div class="d-flex align-items-center gap-3">
        <form method="GET" class="d-flex align-items-center gap-2 bg-light p-2 rounded border">
            <input type="hidden" name="page" value="logs">
            <div class="form-check form-switch mb-0">
                <input class="form-check-input" type="checkbox" name="ignore_auth" id="ignoreAuth" value="1" <?php echo $ignore_auth ? 'checked' : ''; ?> onchange="this.form.submit()">
                <label class="form-check-label small fw-bold text-muted" for="ignoreAuth">Hide Login/Logout</label>
            </div>
        </form>
        <span class="badge bg-olive py-2 px-3">Total Events: <?php echo number_format($total); ?></span>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Timestamp</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Details</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $l): ?>
                    <tr>
                        <td class="ps-4 text-nowrap small text-muted">
                            <?php echo date('M d, H:i:s', strtotime($l['created_at'])); ?>
                        </td>
                        <td>
                            <div class="fw-bold"><?php echo htmlspecialchars($l['user_name'] ?? 'System'); ?></div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border small text-uppercase">
                                <?php echo $l['user_role'] ?: 'Automated'; ?>
                            </span>
                        </td>
                        <td>
                            <span class="fw-semibold <?php 
                                echo strpos(strtolower($l['action']), 'delete') !== false ? 'text-danger' : 
                                    (strpos(strtolower($l['action']), 'add') !== false || strpos(strtolower($l['action']), 'create') !== false ? 'text-success' : 'text-primary'); 
                            ?>">
                                <?php echo htmlspecialchars($l['action']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary py-1 px-2 small">
                                <?php echo strtoupper($l['module'] ?: 'Generic'); ?>
                            </span>
                        </td>
                        <td class="small text-muted" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($l['details']); ?>">
                            <?php echo htmlspecialchars($l['details']); ?>
                        </td>
                        <td class="small font-monospace text-muted">
                            <?php echo $l['ip_address']; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <div class="card-footer bg-white py-3">
        <nav>
            <ul class="pagination pagination-sm justify-content-center mb-0">
                <?php for($i=1; $i<=$total_pages; $i++): 
                    $p_url = $B . "/index.php?page=logs&p=" . $i;
                    if ($ignore_auth) $p_url .= "&ignore_auth=1";
                ?>
                <li class="page-item <?php echo $i==$page_no?'active':''; ?>">
                    <a class="page-link" href="<?php echo $p_url; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>
</div>

<style>
    .table thead th { font-weight: 600; font-size: 0.75rem; text-uppercase; letter-spacing: 0.5px; border: 0; padding-top: 15px; padding-bottom: 15px; }
    .table tbody td { border-color: rgba(0,0,0,0.03); padding-top: 12px; padding-bottom: 12px; }
    .badge { font-weight: 500; font-size: 0.7rem; }
</style>
