<?php
// includes/header.php - Header & Navbar
$base_path = isset($base_path) ? $base_path : '';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="HMSS - Himpunan Mahasiswa Statistika. Organisasi mahasiswa yang berfokus pada pengembangan teknologi dan inovasi.">
    <title><?php echo isset($page_title) ? $page_title . ' | HMSS' : 'HMSS - Himpunan Mahasiswa Statistika'; ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo $base_path; ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo $base_path; ?>index.php">
            <div class="brand-icon">
                <i class="bi bi-cpu-fill"></i>
            </div>
            <div>
                <span class="brand-name">HMSS</span>
                <small class="brand-sub d-block">Statistika</small>
            </div>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='index.php'?'active':''; ?>" href="<?php echo $base_path; ?>index.php">
                        <i class="bi bi-house-fill me-1"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='about.php'?'active':''; ?>" href="<?php echo $base_path; ?>about.php">
                        <i class="bi bi-info-circle-fill me-1"></i>Tentang Kami
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='members.php'?'active':''; ?>" href="<?php echo $base_path; ?>members.php">
                        <i class="bi bi-people-fill me-1"></i>Anggota
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='gallery.php'?'active':''; ?>" href="<?php echo $base_path; ?>gallery.php">
                        <i class="bi bi-images me-1"></i>Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='news.php'?'active':''; ?>" href="<?php echo $base_path; ?>news.php">
                        <i class="bi bi-newspaper me-1"></i>Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='contact.php'?'active':''; ?>" href="<?php echo $base_path; ?>contact.php">
                        <i class="bi bi-envelope-fill me-1"></i>Kontak
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-accent btn-sm px-3" href="<?php echo $base_path; ?>admin/login.php">
                        <i class="bi bi-shield-lock-fill me-1"></i>Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
