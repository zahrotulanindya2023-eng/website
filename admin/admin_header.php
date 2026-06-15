<?php
// admin/admin_header.php - Header untuk halaman admin
$current_admin_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($admin_title) ? $admin_title . ' | Admin HMSS' : 'Admin Panel | HMSS'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@700;800&display=swap" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body style="padding-top:0;background:#f1f5f9;">

<!-- Sidebar -->
<div class="admin-sidebar">
    <div class="sidebar-logo">
        <div class="d-flex align-items-center gap-2">
            <div class="brand-icon" style="width:38px;height:38px;font-size:1rem;">
                <i class="bi bi-cpu-fill"></i>
            </div>
            <div>
                <div class="brand-name" style="font-size:1rem;">HMSS Admin</div>
                <div class="brand-sub">Panel Manajemen</div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Menu Utama</div>
        <a href="dashboard.php" class="sidebar-nav-item <?php echo $current_admin_page=='dashboard.php'?'active':''; ?>">
            <div class="nav-icon"><i class="bi bi-speedometer2"></i></div>
            Dashboard
        </a>
        
        <div class="sidebar-section-label">Konten</div>
        <a href="members.php" class="sidebar-nav-item <?php echo $current_admin_page=='members.php'?'active':''; ?>">
            <div class="nav-icon"><i class="bi bi-people-fill"></i></div>
            Kelola Anggota
        </a>
        <a href="news.php" class="sidebar-nav-item <?php echo $current_admin_page=='news.php'?'active':''; ?>">
            <div class="nav-icon"><i class="bi bi-newspaper"></i></div>
            Kelola Berita
        </a>
        <a href="gallery.php" class="sidebar-nav-item <?php echo $current_admin_page=='gallery.php'?'active':''; ?>">
            <div class="nav-icon"><i class="bi bi-images"></i></div>
            Kelola Galeri
        </a>
        <a href="contacts.php" class="sidebar-nav-item <?php echo $current_admin_page=='contacts.php'?'active':''; ?>">
            <div class="nav-icon"><i class="bi bi-envelope-fill"></i></div>
            Pesan Masuk
        </a>

        <div class="sidebar-section-label">Akun</div>
        <a href="../index.php" class="sidebar-nav-item" target="_blank">
            <div class="nav-icon"><i class="bi bi-globe"></i></div>
            Lihat Website
        </a>
        <a href="logout.php" class="sidebar-nav-item" onclick="return confirm('Yakin ingin keluar?')">
            <div class="nav-icon"><i class="bi bi-box-arrow-right"></i></div>
            Logout
        </a>
    </nav>

    <div style="padding:1rem 1.5rem;border-top:1px solid rgba(255,255,255,0.07);">
        <div class="d-flex align-items-center gap-2">
            <div style="width:32px;height:32px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-size:.85rem;">
                <i class="bi bi-person-fill"></i>
            </div>
            <div>
                <div class="text-white" style="font-size:.82rem;font-weight:600;"><?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></div>
                <div style="font-size:.7rem;color:var(--text-muted);"><?php echo ucfirst($_SESSION['admin_role'] ?? 'admin'); ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="admin-content">
    <!-- Topbar -->
    <div class="admin-topbar">
        <div>
            <h6 class="fw-700 mb-0"><?php echo isset($admin_title) ? $admin_title : 'Dashboard'; ?></h6>
            <p class="text-muted small mb-0"><?php echo date('l, d F Y'); ?></p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="../index.php" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                <i class="bi bi-globe me-1"></i>Website
            </a>
            <a href="logout.php" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Yakin ingin keluar?')">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>
    </div>

    <!-- Flash Message -->
    <?php
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        $alertClass = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';
        $icon = $flash['type'] === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill';
        echo "<div class='alert {$alertClass} alert-dismissible fade show m-3 rounded-xl' role='alert'>
            <i class='bi bi-{$icon} me-2'></i>" . htmlspecialchars($flash['message']) . "
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
    }
    ?>

    <div class="admin-main">
