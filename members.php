<?php
// members.php - Profil Anggota
session_start();
require_once 'db.php';
$page_title = 'Profil Anggota';

// Ambil semua anggota
$members_result = $conn->query("SELECT * FROM members ORDER BY id ASC");

include 'includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active">Profil Anggota</li>
            </ol>
        </nav>
        <h1 class="page-hero-title">Profil <span class="gradient-text">Anggota</span></h1>
        <p class="page-hero-subtitle">Kenali para anggota tim inti yang berdedikasi membangun HMSS menjadi organisasi yang unggul.</p>
    </div>
</section>

<!-- Members Grid -->
<section class="section-padding" style="background:#f8fafc;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <div class="section-eyebrow">Tim Kami</div>
            <h2 class="section-title">Pengurus <span class="gradient-text">HMSS 2024/2025</span></h2>
            <p class="section-subtitle">Individu-individu berdedikasi yang menjalankan roda organisasi dengan penuh semangat.</p>
        </div>
        
        <div class="row g-4">
            <?php
            if ($members_result && $members_result->num_rows > 0):
                while ($member = $members_result->fetch_assoc()):
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up">
                <div class="member-card">
                    <div class="member-img-wrap">
                        <?php if (!empty($member['photo']) && file_exists('assets/images/' . $member['photo'])): ?>
                            <img src="assets/images/<?php echo htmlspecialchars($member['photo']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                        <?php else: ?>
                            <div class="member-avatar-placeholder">
                                <i class="bi bi-person-circle"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="member-body">
                        <div class="member-role-badge"><?php echo htmlspecialchars($member['role']); ?></div>
                        <h6 class="fw-700 mb-2 mt-1"><?php echo htmlspecialchars($member['name']); ?></h6>
                        <?php if (!empty($member['bio'])): ?>
                        <p class="text-secondary small mb-3" style="line-height:1.6;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                            <?php echo htmlspecialchars($member['bio']); ?>
                        </p>
                        <?php endif; ?>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="#" class="social-btn-sm" title="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-btn-sm" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="social-btn-sm" title="GitHub"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
            else:
            ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-people text-muted" style="font-size:3rem;"></i>
                <p class="text-muted mt-3">Belum ada data anggota tersedia.</p>
                <a href="admin/login.php" class="btn btn-primary btn-sm">Tambah Anggota</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Join Banner -->
<section class="section-padding" style="background:white;">
    <div class="container">
        <div class="row align-items-center g-4" style="background:var(--gradient-dark);border-radius:20px;padding:3rem;overflow:hidden;position:relative;">
            <div style="position:absolute;inset:0;background:radial-gradient(circle at 80% 50%, rgba(79,70,229,0.2) 0%, transparent 60%);"></div>
            <div class="col-lg-8 position-relative" data-aos="fade-right">
                <div class="hero-badge mb-3" style="width:fit-content;">
                    <i class="bi bi-person-plus-fill"></i> Bergabung
                </div>
                <h3 class="fw-800 text-white mb-2">Ingin Menjadi Bagian dari Tim Kami?</h3>
                <p class="text-white-50 mb-0">Daftarkan diri Anda sebagai anggota HMSS dan mulailah perjalanan luar biasa bersama kami.</p>
            </div>
            <div class="col-lg-4 text-lg-end position-relative">
                <a href="contact.php" class="btn-primary-custom">
                    <i class="bi bi-arrow-right-circle me-2"></i>Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.social-btn-sm {
    width: 30px;
    height: 30px;
    border-radius: 7px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    text-decoration: none;
}
.social-btn-sm:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
}
</style>

<?php include 'includes/footer.php'; ?>
