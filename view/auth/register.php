<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student ERP – Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root { --olive:#4a7c59; --maroon:#800000; --charcoal:#4a3c31; }
        body {
            min-height:100vh;
            background: linear-gradient(135deg, #1a2a1a 0%, #2c4a2c 40%, #4a3c31 100%);
            display:flex; align-items:center; justify-content:center;
            font-family:'Inter',system-ui,sans-serif;
            padding: 20px 0;
        }
        .register-card {
            background:rgba(255,255,255,.96);
            border-radius:20px;
            box-shadow:0 30px 80px rgba(0,0,0,.45);
            overflow:hidden; width:100%; max-width:550px;
        }
        .register-header {
            background: linear-gradient(135deg, var(--olive), var(--olive-dark));
            padding:2rem; text-align:center; color:#fff;
        }
        .register-body { padding:2rem; }
        .form-control, .form-select {
            border-radius:10px; border:1.5px solid #ddd;
            padding:.6rem 1rem;
        }
        .btn-register {
            width:100%; padding:.75rem; border-radius:10px; font-weight:700;
            background: var(--olive); border:none; color:#fff;
        }
        .role-icon-box {
            display: flex; gap: 15px; margin-bottom: 2rem; justify-content: center;
        }
        .role-option {
            flex: 1; text-align: center; padding: 15px; border: 2px solid #eee;
            border-radius: 15px; cursor: pointer; transition: all 0.2s;
        }
        .role-option i { font-size: 1.5rem; display: block; margin-bottom: 5px; color: #888; }
        .role-option.active { border-color: var(--olive); background: var(--olive-light); }
        .role-option.active i { color: var(--olive); }
    </style>
</head>
<body>
<div class="register-card">
    <div class="register-header">
        <h4 class="fw-bold mb-1">Create Account</h4>
        <p style="opacity:.7;font-size:.88rem">Join the Student ERP Community</p>
    </div>
    <div class="register-body">
        <?php session_start(); if (isset($_SESSION['reg_error'])): ?>
        <div class="alert alert-danger mb-3 py-2 small"><?php echo $_SESSION['reg_error']; unset($_SESSION['reg_error']); ?></div>
        <?php endif; ?>
        
        <form action="../../controller/AuthController.php?action=register" method="POST">
            <div class="row g-3">
                <div class="col-12 text-center mb-1"><label class="small fw-bold text-muted text-uppercase">Select Your Account Type</label></div>
                <div class="col-12 d-flex gap-3 mb-3 justify-content-center">
                    <label style="width: 200px;">
                        <input type="radio" name="role" value="faculty" class="btn-check" id="r-faculty" checked>
                        <div class="role-option p-3 border rounded text-center" for="r-faculty" style="cursor:pointer">
                            <i class="bi bi-person-badge-fill d-block mb-1 fs-4"></i> Faculty Member
                        </div>
                    </label>
                    <label style="width: 200px;">
                        <input type="radio" name="role" value="admin" class="btn-check" id="r-admin">
                        <div class="role-option p-3 border rounded text-center" for="r-admin" style="cursor:pointer">
                            <i class="bi bi-shield-lock-fill d-block mb-1 fs-4"></i> System Admin
                        </div>
                    </label>
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold">Full Name</label>
                    <input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Mobile Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="+91 00000 00000" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-register py-2">Create Account</button>
                    <div class="text-center mt-3 small">
                        Already have an account? <a href="../../index.php" class="text-olive fw-bold text-decoration-none">Sign In</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Just a bit of UI polish for the radio buttons
    document.querySelectorAll('input[name="role"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.role-option').forEach(opt => opt.classList.remove('active', 'border-success', 'bg-light'));
            if(this.checked) {
                this.nextElementSibling.classList.add('active', 'border-success', 'bg-light');
            }
        });
    });
    // Initialize first one
    document.getElementById('r-faculty').dispatchEvent(new Event('change'));
</script>
</body>
</html>
