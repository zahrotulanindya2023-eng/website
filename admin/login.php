<?php
// admin/login.php - Halaman Login Admin
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../db.php';
    
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Username dan password wajib diisi!';
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['admin_id']   = $user['id'];
                $_SESSION['admin_name'] = $user['username'];
                $_SESSION['admin_role'] = $user['role'];
                header('Location: dashboard.php');
                exit();
            } else {
                $error = 'Password salah!';
            }
        } else {
            $error = 'Username tidak ditemukan!';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | HMSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@700;800&display=swap" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body style="padding-top:0;">

<div class="login-page">
    <div class="login-card" data-aos="fade-up">
        <!-- Logo -->
        <div class="text-center mb-4">
            <div class="brand-icon mx-auto mb-3" style="width:56px;height:56px;font-size:1.5rem;">
                <i class="bi bi-cpu-fill"></i>
            </div>
            <h4 class="fw-800 text-white mb-1">Admin Panel</h4>
            <p class="text-white-50 small">Masuk ke panel admin HMSS</p>
        </div>

        <?php if ($error): ?>
        <div class="alert-custom alert-danger-custom mb-3">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <form method="POST" id="loginForm">
            <div class="mb-3">
                <label class="form-label text-white-50 small fw-600" for="username">Username</label>
                <div class="input-group">
                    <span class="input-group-text" style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-right:none;color:var(--text-muted);">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required
                        style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-left:none;color:white;"
                        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label text-white-50 small fw-600" for="password">Password</label>
                <div class="input-group">
                    <span class="input-group-text" style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-right:none;color:var(--text-muted);">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required
                        style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-left:none;border-right:none;color:white;">
                    <button class="input-group-text" type="button" onclick="togglePass()" style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-left:none;color:var(--text-muted);cursor:pointer;">
                        <i class="bi bi-eye-fill" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn-primary-custom w-100 justify-content-center" id="loginBtn">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="../index.php" class="text-white-50 small" style="text-decoration:none;">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
            </a>
        </div>

        <div class="mt-4 p-3 rounded-xl" style="background:rgba(79,70,229,0.1);border:1px solid rgba(79,70,229,0.2);">
            <p class="text-white-50 small mb-1 fw-600">Demo Credentials:</p>
            <p class="text-white-50 small mb-0">Username: <code class="text-primary-light">admin</code></p>
            <p class="text-white-50 small mb-0">Password: <code class="text-primary-light">password</code></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePass() {
    const pass = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (pass.type === 'password') {
        pass.type = 'text';
        icon.className = 'bi bi-eye-slash-fill';
    } else {
        pass.type = 'password';
        icon.className = 'bi bi-eye-fill';
    }
}

document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
    btn.disabled = true;
});
</script>
</body>
</html>
