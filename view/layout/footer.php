<?php // view/layout/footer.php ?>
    </div><!-- /.layout-wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/custom.js?v=<?php echo time(); ?>"></script>
<?php if (!empty($_SESSION['is_guest'])): ?>
<!-- ── GUEST MODE: read-only modal + blocker (to revert, delete this block) ── -->
<style>
    #guestModal .modal-content { border-radius:18px; border:none; box-shadow:0 20px 60px rgba(0,0,0,.25); }
    #guestModal .guest-cross { position:absolute; top:12px; right:12px; z-index:10; }
    #guestModal .guest-icon {
        width:74px; height:74px; border-radius:50%;
        background:rgba(128,0,0,.08); color:var(--maroon,#800000);
        display:flex; align-items:center; justify-content:center; font-size:2.4rem;
    }
</style>
<div class="modal fade" id="guestModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px">
        <div class="modal-content text-center p-4 position-relative">
            <button type="button" class="btn-close guest-cross" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            <div class="mb-3 d-flex justify-content-center">
                <div class="guest-icon"><i class="bi bi-x-circle-fill"></i></div>
            </div>
            <h5 class="fw-bold mb-2">Sorry, you are only a Guest Admin</h5>
            <p class="text-muted small mb-0">This action is disabled in read-only demo mode. Please log in with a real account to make changes.</p>
        </div>
    </div>
</div>
<script>
(function () {
    var modalEl = document.getElementById('guestModal');
    var modal = modalEl ? new bootstrap.Modal(modalEl) : null;
    var showGuest = function () { if (modal) modal.show(); };

    // Block form submissions (all mutation forms are POST; GET filters stay usable)
    document.addEventListener('submit', function (e) {
        if (e.target.tagName === 'FORM' && String(e.target.method).toLowerCase() === 'post') {
            e.preventDefault();
            e.stopImmediatePropagation();
            showGuest();
        }
    }, true);

    // Block delete / add / edit actions
    document.addEventListener('click', function (e) {
        var a = e.target.closest ? e.target.closest('a.confirm-delete, a.confirm-delete-grade, a[href*="action=delete"], a[href*="-add"], a[href*="-edit"], .confirm-delete-grade') : null;
        if (a) {
            e.preventDefault();
            e.stopImmediatePropagation();
            showGuest();
        }
    }, true);
})();
</script>
<?php endif; ?>
</body>
</html>
