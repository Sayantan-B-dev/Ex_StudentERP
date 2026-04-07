// assets/js/custom.js — StudentERP JS

document.addEventListener('DOMContentLoaded', function () {

    // ── Sidebar toggle ──────────────────────────────────────────────────────
    const sidebar   = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle-btn');
    const toggleMobileBtn = document.getElementById('sidebar-toggle-mobile');

    const key = 'sidebar_collapsed';
    if (localStorage.getItem(key) === '1' && sidebar) {
        sidebar.classList.add('collapsed');
    }

    function toggleSidebar() {
        sidebar.classList.toggle('collapsed');
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem(key, isCollapsed ? '1' : '0');
        
        // Update toggle icon
        if (toggleBtn) {
            const icon = toggleBtn.querySelector('i');
            if (isCollapsed) {
                icon.classList.replace('bi-layout-sidebar-inset', 'bi-layout-sidebar-inset-reverse');
            } else {
                icon.classList.replace('bi-layout-sidebar-inset-reverse', 'bi-layout-sidebar-inset');
            }
        }
    }

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', toggleSidebar);
    }
    if (toggleMobileBtn && sidebar) {
        toggleMobileBtn.addEventListener('click', toggleSidebar);
    }

    // ── Flash messages / Toasts ────────────────────────────────────────────
    const flashes = document.querySelectorAll('.flash-msg');
    flashes.forEach(function (el) {
        // Add close button
        const closeBtn = document.createElement('span');
        closeBtn.innerHTML = '&times;';
        closeBtn.className = 'btn-close';
        closeBtn.onclick = function() {
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        };
        el.appendChild(closeBtn);

        // Auto-hide after 5 seconds
        setTimeout(function () {
            if (el.parentNode) {
                el.style.transition = 'opacity .5s, transform .5s';
                el.style.opacity = '0';
                el.style.transform = 'translate(-50%, 20px)';
                setTimeout(function () { el.remove(); }, 500);
            }
        }, 5000);
    });

    // ── Confirm delete ──────────────────────────────────────────────────────
    document.querySelectorAll('.confirm-delete').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            if (!confirm('Are you sure you want to delete this record? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });

    // ── Table search & filter ───────────────────────────────────────────────
    const searchInput = document.getElementById('tableSearch');
    const filterSelect = document.getElementById('tableFilter');

    function applyTableFilters() {
        const q = searchInput ? searchInput.value.toLowerCase() : '';
        const f = filterSelect ? filterSelect.value.toLowerCase() : '';
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(function (row) {
            const text = row.textContent.toLowerCase();
            const matchesSearch = text.includes(q);
            
            let matchesFilter = true;
            if (f !== '') {
                // simple word boundary match, so "inactive" doesn't falsely match "active"
                const regex = new RegExp('\\b' + f + '\\b');
                matchesFilter = regex.test(text);
            }
            
            row.style.display = (matchesSearch && matchesFilter) ? '' : 'none';
        });
    }

    if (searchInput) searchInput.addEventListener('keyup', applyTableFilters);
    if (filterSelect) filterSelect.addEventListener('change', applyTableFilters);

    // ── Form Validation Feedback ──────────────────────────────────────────
    const forms = document.querySelectorAll('form');
    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                // Show a brief warning toast if possible
                const errorToast = document.createElement('div');
                errorToast.className = 'flash-msg alert alert-warning alert-dismissible fade show';
                errorToast.innerHTML = '<i class="bi bi-exclamation-circle me-2"></i> Please fill in all required fields correctly. <button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                document.querySelector('.layout-wrapper')?.prepend(errorToast);
                // Trigger auto-hide for this new toast
                setTimeout(() => { errorToast.style.opacity = '0'; setTimeout(() => errorToast.remove(), 400); }, 3000);
            }
            form.classList.add('was-validated');
        }, false);
    });

    console.log('StudentERP ready.');
});