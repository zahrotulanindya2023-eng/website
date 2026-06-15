<?php
// about.php - Halaman Tentang Kami
session_start();
require_once 'db.php';
$page_title = 'Tentang Kami';
include 'includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active">Tentang Kami</li>
            </ol>
        </nav>
        <h1 class="page-hero-title">Tentang <span class="gradient-text">HMSS</span></h1>
        <p class="page-hero-subtitle">Mengenal lebih dalam tentang organisasi kami, sejarah, visi, misi, dan nilai-nilai yang kami junjung tinggi.</p>
    </div>
</section>

<!-- Deskripsi Organisasi -->
<section class="section-padding" style="background:white;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="section-eyebrow">Siapa Kami</div>
                <h2 class="section-title">Himpunan Mahasiswa<br><span class="gradient-text">Statistika</span></h2>
                <p class="text-secondary lh-lg mb-3">
                    HMSS adalah organisasi kemahasiswaan resmi yang bernaung di bawah Fakultas Statistika. Berdiri sejak tahun 2018, HMSS telah menjadi rumah bagi ratusan mahasiswa yang bersemangat dalam dunia teknologi dan inovasi.
                </p>
                <p class="text-secondary lh-lg mb-4">
                    Kami berkomitmen untuk menciptakan ekosistem yang mendukung pengembangan akademik, softskill, dan profesionalisme mahasiswa dalam menghadapi tantangan industri teknologi global.
                </p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="small fw-500">Organisasi Resmi Kampus</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="small fw-500">500+ Anggota Aktif</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="small fw-500">50+ Kegiatan per Tahun</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span class="small fw-500">Berprestasi Nasional</span>
                        </div>
                    </div>
                </div>
                <a href="contact.php" class="btn-primary-custom d-inline-flex align-items-center gap-2 mt-4">
                    <i class="bi bi-envelope"></i> Hubungi Kami
                </a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-4 rounded-xl text-center" style="background:linear-gradient(135deg,#4f46e5,#818cf8);">
                            <div style="font-size:2.5rem;font-weight:800;color:white;font-family:'Poppins',sans-serif;">2018</div>
                            <div class="text-white-50 small mt-1">Tahun Berdiri</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-xl text-center" style="background:linear-gradient(135deg,#0d9488,#06b6d4);">
                            <div style="font-size:2.5rem;font-weight:800;color:white;font-family:'Poppins',sans-serif;">500+</div>
                            <div class="text-white-50 small mt-1">Anggota Aktif</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-xl text-center" style="background:linear-gradient(135deg,#d97706,#f59e0b);">
                            <div style="font-size:2.5rem;font-weight:800;color:white;font-family:'Poppins',sans-serif;">50+</div>
                            <div class="text-white-50 small mt-1">Kegiatan</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-xl text-center" style="background:linear-gradient(135deg,#059669,#10b981);">
                            <div style="font-size:2.5rem;font-weight:800;color:white;font-family:'Poppins',sans-serif;">15+</div>
                            <div class="text-white-50 small mt-1">Penghargaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi, Misi, Nilai -->
<section class="section-padding" style="background:#f8fafc;">
    <div class="container">
        <div class="section-header text-center">
            <div class="section-eyebrow">Landasan Organisasi</div>
            <h2 class="section-title">Visi, Misi & <span class="gradient-text">Nilai</span></h2>
        </div>
        <div class="row g-4">
            <!-- Visi -->
            <div class="col-lg-4" data-aos="fade-up">
                <div class="vm-card">
                    <div class="vm-icon vision">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <h4 class="fw-700 mb-3">Visi</h4>
                    <p class="text-secondary lh-lg">
                        Menjadi Himpunan Mahasiswa Statistika yang unggul, inovatif, dan berdaya saing tinggi di tingkat nasional, serta mampu berkontribusi nyata dalam pengembangan teknologi informasi di Indonesia.
                    </p>
                </div>
            </div>
            <!-- Misi -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="vm-card">
                    <div class="vm-icon mission">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h4 class="fw-700 mb-3">Misi</h4>
                    <ul class="text-secondary" style="padding-left:1.25rem;line-height:2;">
                        <li>Mengembangkan kemampuan akademik dan non-akademik anggota</li>
                        <li>Menyelenggarakan kegiatan yang meningkatkan kompetensi teknologi</li>
                        <li>Membangun jaringan kolaborasi dengan industri dan akademisi</li>
                        <li>Menanamkan jiwa kepemimpinan dan kewirausahaan</li>
                        <li>Berkontribusi positif bagi lingkungan kampus dan masyarakat</li>
                    </ul>
                </div>
            </div>
            <!-- Nilai -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="vm-card">
                    <div class="vm-icon value">
                        <i class="bi bi-gem"></i>
                    </div>
                    <h4 class="fw-700 mb-3">Nilai-Nilai</h4>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge-primary-custom">🚀 Inovasi</span>
                        <span class="badge-primary-custom">🤝 Kolaborasi</span>
                        <span class="badge-primary-custom">💡 Kreativitas</span>
                        <span class="badge-primary-custom">⭐ Integritas</span>
                        <span class="badge-primary-custom">🎯 Komitmen</span>
                        <span class="badge-primary-custom">🌱 Pertumbuhan</span>
                        <span class="badge-primary-custom">🔬 Keilmuan</span>
                        <span class="badge-primary-custom">🌐 Inklusivitas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Organisasi -->
<section class="section-padding" style="background:white;">
    <div class="container">
        <div class="section-header text-center">
            <div class="section-eyebrow">Organisasi</div>
            <h2 class="section-title">Struktur <span class="gradient-text">Kepengurusan</span></h2>
            <p class="section-subtitle">Periode kepengurusan 2024/2025</p>
        </div>

        <!-- Dewan Pengurus Inti -->
        <div class="text-center mb-4">
            <span class="badge-primary-custom fs-6 px-3 py-2">Pengurus Inti</span>
        </div>
        <div class="row g-3 justify-content-center mb-4">
            <div class="col-md-4 col-lg-3" data-aos="fade-up">
                <div class="structure-card" style="border-top:3px solid var(--primary);">
                    <i class="bi bi-person-badge-fill text-primary mb-2" style="font-size:2rem;"></i>
                    <h6 class="fw-700">Ketua Umum</h6>
                    <p class="text-secondary small mb-0">Pemimpin dan penanggungjawab utama organisasi</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="structure-card" style="border-top:3px solid var(--accent);">
                    <i class="bi bi-person-fill text-info mb-2" style="font-size:2rem;"></i>
                    <h6 class="fw-700">Wakil Ketua</h6>
                    <p class="text-secondary small mb-0">Mendampingi dan membantu tugas Ketua Umum</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="150">
                <div class="structure-card" style="border-top:3px solid var(--success);">
                    <i class="bi bi-file-text-fill text-success mb-2" style="font-size:2rem;"></i>
                    <h6 class="fw-700">Sekretaris</h6>
                    <p class="text-secondary small mb-0">Pengelolaan administrasi dan dokumentasi</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="structure-card" style="border-top:3px solid var(--warning);">
                    <i class="bi bi-cash-stack text-warning mb-2" style="font-size:2rem;"></i>
                    <h6 class="fw-700">Bendahara</h6>
                    <p class="text-secondary small mb-0">Pengelolaan keuangan organisasi</p>
                </div>
            </div>
        </div>

        <!-- Divisi -->
        <div class="text-center mb-4">
            <span class="badge-primary-custom fs-6 px-3 py-2">Divisi</span>
        </div>
        <div class="row g-3" data-aos="fade-up">
            <?php
            $divisions = [
                ['icon' => 'bi-mortarboard-fill', 'name' => 'Akademik', 'desc' => 'Program akademik & penelitian', 'color' => '#4f46e5'],
                ['icon' => 'bi-megaphone-fill', 'name' => 'Humas', 'desc' => 'Komunikasi & relasi publik', 'color' => '#06b6d4'],
                ['icon' => 'bi-controller', 'name' => 'Minat Bakat', 'desc' => 'Pengembangan hobi & bakat', 'color' => '#f59e0b'],
                ['icon' => 'bi-laptop-fill', 'name' => 'Teknologi', 'desc' => 'Inovasi & pengembangan IT', 'color' => '#10b981'],
                ['icon' => 'bi-heart-fill', 'name' => 'Sosial', 'desc' => 'Kegiatan sosial & kemasyarakatan', 'color' => '#ef4444'],
                ['icon' => 'bi-palette-fill', 'name' => 'Kreativitas', 'desc' => 'Desain & konten kreatif', 'color' => '#8b5cf6'],
            ];
            foreach ($divisions as $div):
            ?>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="structure-card h-100">
                    <i class="bi <?php echo $div['icon']; ?> mb-2" style="font-size:1.75rem;color:<?php echo $div['color']; ?>;"></i>
                    <h6 class="fw-700 mb-1" style="font-size:.9rem;"><?php echo $div['name']; ?></h6>
                    <p class="text-secondary" style="font-size:.75rem;margin:0;"><?php echo $div['desc']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Sejarah Timeline -->
<section class="section-padding" style="background:#f8fafc;">
    <div class="container">
        <div class="section-header text-center">
            <div class="section-eyebrow">Perjalanan</div>
            <h2 class="section-title">Sejarah <span class="gradient-text">HMSS</span></h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php
                $timeline = [
                    ['year' => '2018', 'title' => 'HMSS Berdiri', 'desc' => 'HMSS resmi berdiri dengan 50 anggota pendiri yang penuh semangat dan dedikasi tinggi.', 'color' => 'var(--primary)'],
                    ['year' => '2019', 'title' => 'Workshop Perdana', 'desc' => 'Mengadakan workshop programming perdana yang diikuti 100 mahasiswa dari berbagai jurusan.', 'color' => 'var(--accent)'],
                    ['year' => '2021', 'title' => 'Hackathon Pertama', 'desc' => 'Menyelenggarakan hackathon tingkat universitas pertama dengan 30 tim peserta.', 'color' => 'var(--success)'],
                    ['year' => '2023', 'title' => 'Juara Nasional', 'desc' => 'Tim HMSS meraih Juara 2 Hackathon Nasional pertama kalinya, membuka era prestasi internasional.', 'color' => 'var(--warning)'],
                    ['year' => '2025', 'title' => 'Juara 1 Nasional', 'desc' => 'Meraih Juara 1 Hackathon Nasional 2025 dan mencapai 500+ anggota aktif.', 'color' => 'var(--danger)'],
                ];
                foreach ($timeline as $i => $item):
                ?>
                <div class="d-flex gap-4 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $i*100; ?>">
                    <div class="flex-shrink-0 text-center" style="width:80px;">
                        <div class="fw-800 mb-1" style="font-size:1.1rem;color:<?php echo $item['color']; ?>;font-family:'Poppins',sans-serif;"><?php echo $item['year']; ?></div>
                        <div style="width:2px;height:calc(100% - 30px);background:<?php echo $item['color']; ?>;margin:0 auto;opacity:.3;"></div>
                    </div>
                    <div class="flex-grow-1 pb-4">
                        <div style="background:white;border-radius:12px;padding:1.25rem;border:1px solid #e2e8f0;border-left:4px solid <?php echo $item['color']; ?>;">
                            <h6 class="fw-700 mb-1"><?php echo $item['title']; ?></h6>
                            <p class="text-secondary small mb-0"><?php echo $item['desc']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
