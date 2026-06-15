<?php
// index.php - Halaman Utama
session_start();
require_once 'db.php';

$page_title = 'Beranda';

// Ambil 3 berita terbaru
$news_result = $conn->query("SELECT * FROM news ORDER BY date DESC LIMIT 3");

// Ambil 6 galeri terbaru
$gallery_result = $conn->query("SELECT * FROM events ORDER BY date DESC LIMIT 6");

// Ambil statistik
$total_members = $conn->query("SELECT COUNT(*) as total FROM members")->fetch_assoc()['total'];
$total_events  = $conn->query("SELECT COUNT(*) as total FROM events")->fetch_assoc()['total'];
$total_news    = $conn->query("SELECT COUNT(*) as total FROM news")->fetch_assoc()['total'];

include 'includes/header.php';
?>

<!-- ========== HERO SECTION ========== -->
<section class="hero-section">
    <div class="hero-bg-pattern"></div>
    <div class="hero-grid"></div>
    <div class="container hero-content">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-badge">
                    <i class="bi bi-stars"></i>
                    Organisasi Mahasiswa Unggulan 2025
                </div>
                <h1 class="hero-title">
                    Himpunan Mahasiswa<br>
                    <span class="gradient-text">Statistika</span>
                </h1>
                <p class="hero-desc">
                    Wadah pengembangan diri mahasiswa Statistika yang berfokus pada inovasi teknologi, kepemimpinan, dan pemberdayaan komunitas kampus.
                </p>
                <div class="hero-buttons">
                    <a href="about.php" class="btn-primary-custom">
                        <i class="bi bi-arrow-right-circle me-2"></i>Tentang Kami
                    </a>
                    <a href="members.php" class="btn-outline-custom">
                        <i class="bi bi-people me-2"></i>Profil Anggota
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-num"><?php echo $total_members; ?>+</div>
                        <div class="stat-label">Anggota Aktif</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num"><?php echo $total_events; ?>+</div>
                        <div class="stat-label">Kegiatan</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">5+</div>
                        <div class="stat-label">Tahun Berdiri</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="hero-visual">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="hero-card mb-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div style="width:36px;height:36px;background:rgba(79,70,229,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-trophy-fill text-warning"></i>
                                    </div>
                                    <div>
                                        <div class="text-white fw-bold" style="font-size:.85rem;">Prestasi</div>
                                        <div style="font-size:.7rem;color:var(--text-muted);">2025</div>
                                    </div>
                                </div>
                                <div class="text-white fw-semibold" style="font-size:.9rem;">Juara 1 Hackathon Nasional</div>
                                <div style="color:var(--text-muted);font-size:.78rem;margin-top:.25rem;">Jakarta Tech Festival</div>
                            </div>
                            <div class="hero-card hero-card-2">
                                <div class="text-center">
                                    <div class="text-white fw-bold" style="font-size:2rem;">500+</div>
                                    <div style="color:var(--primary-light);font-size:.8rem;">Anggota Bergabung</div>
                                    <div style="color:var(--text-muted);font-size:.75rem;margin-top:.25rem;">Sejak 2018</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" style="margin-top:1.5rem;">
                            <div class="hero-card mb-3">
                                <div class="text-center">
                                    <i class="bi bi-calendar-check-fill" style="font-size:2rem;color:var(--accent);"></i>
                                    <div class="text-white fw-bold mt-2" style="font-size:1.1rem;"><?php echo $total_events; ?> Kegiatan</div>
                                    <div style="color:var(--text-muted);font-size:.78rem;">Tahun Ini</div>
                                </div>
                            </div>
                            <div class="hero-card">
                                <div class="text-center">
                                    <div class="d-flex justify-content-center gap-1 mb-2">
                                        <span style="width:8px;height:8px;background:var(--success);border-radius:50%;display:inline-block;" class="pulse"></span>
                                        <span style="font-size:.78rem;color:var(--success);">Live</span>
                                    </div>
                                    <div class="text-white fw-semibold" style="font-size:.88rem;">Pendaftaran Anggota Baru</div>
                                    <div style="color:var(--text-muted);font-size:.75rem;margin-top:.3rem;">Oktober 2025</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== FEATURES SECTION ========== -->
<section class="section-padding" style="background:white;">
    <div class="container">
        <div class="section-header text-center">
            <div class="section-eyebrow">Mengapa HMSS</div>
            <h2 class="section-title">Platform Terbaik untuk <span class="gradient-text">Berkembang</span></h2>
            <p class="section-subtitle">HMSS menyediakan berbagai program dan fasilitas untuk mengembangkan potensi mahasiswa Statistika.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-code-slash"></i></div>
                    <h5 class="fw-700 mb-2">Workshop Teknologi</h5>
                    <p class="text-secondary small mb-0">Pelatihan intensif programming, AI, web dev, dan teknologi terkini bersama praktisi industri.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon" style="background:linear-gradient(135deg,#0d9488,#06b6d4);"><i class="bi bi-people-fill"></i></div>
                    <h5 class="fw-700 mb-2">Komunitas Solid</h5>
                    <p class="text-secondary small mb-0">Jaringan mahasiswa dan alumni yang saling mendukung dalam pengembangan karir dan akademik.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon" style="background:linear-gradient(135deg,#d97706,#f59e0b);"><i class="bi bi-trophy-fill"></i></div>
                    <h5 class="fw-700 mb-2">Kompetisi & Event</h5>
                    <p class="text-secondary small mb-0">Mengikuti dan menyelenggarakan kompetisi tingkat nasional untuk mengasah kemampuan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon" style="background:linear-gradient(135deg,#059669,#10b981);"><i class="bi bi-briefcase-fill"></i></div>
                    <h5 class="fw-700 mb-2">Pengembangan Karir</h5>
                    <p class="text-secondary small mb-0">Program mentoring dan koneksi dengan perusahaan teknologi terkemuka di Indonesia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== NEWS SECTION ========== -->
<section class="section-padding" style="background:#f8fafc;">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
            <div>
                <div class="section-eyebrow">Terbaru</div>
                <h2 class="section-title mb-1">Berita & <span class="gradient-text">Artikel</span></h2>
                <p class="text-secondary mb-0">Informasi dan update terkini dari HMSS</p>
            </div>
            <a href="news.php" class="btn btn-outline-primary rounded-pill px-4">
                Semua Berita <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            <?php
            if ($news_result && $news_result->num_rows > 0):
                while ($news = $news_result->fetch_assoc()):
            ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <div class="news-card">
                    <div class="news-img-wrap">
                        <?php if (!empty($news['image']) && file_exists('assets/images/' . $news['image'])): ?>
                            <img src="assets/images/<?php echo htmlspecialchars($news['image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
                        <?php else: ?>
                            <div class="news-img-placeholder"><i class="bi bi-newspaper"></i></div>
                        <?php endif; ?>
                    </div>
                    <div class="news-body">
                        <div class="news-date">
                            <i class="bi bi-calendar3 me-1"></i>
                            <?php echo date('d F Y', strtotime($news['date'])); ?>
                        </div>
                        <h5 class="news-title"><?php echo htmlspecialchars($news['title']); ?></h5>
                        <p class="news-excerpt"><?php echo htmlspecialchars(substr(strip_tags($news['content']), 0, 150)) . '...'; ?></p>
                        <a href="news.php?id=<?php echo $news['id']; ?>" class="text-primary fw-600 small">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
            else:
            ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-newspaper text-muted" style="font-size:3rem;"></i>
                <p class="text-muted mt-3">Belum ada berita tersedia.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========== GALLERY PREVIEW ========== -->
<section class="section-padding" style="background:white;">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
            <div>
                <div class="section-eyebrow">Dokumentasi</div>
                <h2 class="section-title mb-1">Galeri <span class="gradient-text">Kegiatan</span></h2>
                <p class="text-secondary mb-0">Momen-momen berharga dalam kegiatan HMSS</p>
            </div>
            <a href="gallery.php" class="btn btn-outline-primary rounded-pill px-4">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-3">
            <?php
            if ($gallery_result && $gallery_result->num_rows > 0):
                $i = 0;
                while ($event = $gallery_result->fetch_assoc()):
                    $i++;
            ?>
            <div class="col-6 col-md-4 col-lg-<?php echo $i<=2?'4':'4'; ?>" data-aos="zoom-in" data-aos-delay="<?php echo ($i-1)*50; ?>">
                <div class="gallery-card">
                    <?php if (!empty($event['image']) && file_exists('assets/images/' . $event['image'])): ?>
                        <img src="assets/images/<?php echo htmlspecialchars($event['image']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                    <?php else: ?>
                        <div class="gallery-placeholder">
                            <i class="bi bi-image"></i>
                            <span style="font-size:.75rem;"><?php echo htmlspecialchars(substr($event['title'],0,20)); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="gallery-icon"><i class="bi bi-zoom-in"></i></div>
                    <div class="gallery-overlay">
                        <div class="gallery-title"><?php echo htmlspecialchars($event['title']); ?></div>
                        <div class="gallery-date"><i class="bi bi-calendar3 me-1"></i><?php echo date('d M Y', strtotime($event['date'])); ?></div>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
            else:
            ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-images text-muted" style="font-size:3rem;"></i>
                <p class="text-muted mt-3">Belum ada galeri tersedia.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========== CTA SECTION ========== -->
<section class="section-padding" style="background:var(--gradient-dark);position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(circle at 50% 50%, rgba(79,70,229,0.2) 0%, transparent 60%);"></div>
    <div class="container text-center position-relative" data-aos="fade-up">
        <div class="hero-badge mx-auto mb-4" style="width:fit-content;">
            <i class="bi bi-rocket-takeoff"></i> Bergabung Sekarang
        </div>
        <h2 style="font-size:clamp(1.8rem,4vw,3rem);font-weight:800;color:white;margin-bottom:1rem;">
            Jadilah Bagian dari <span class="gradient-text">HMSS</span>
        </h2>
        <p style="color:var(--text-muted);max-width:600px;margin:0 auto 2.5rem;font-size:1.05rem;line-height:1.7;">
            Bergabunglah bersama ratusan mahasiswa Statistika yang bersemangat dan berprestasi. Daftarkan diri Anda sekarang!
        </p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="contact.php" class="btn-primary-custom">
                <i class="bi bi-envelope me-2"></i>Hubungi Kami
            </a>
            <a href="about.php" class="btn-outline-custom">
                <i class="bi bi-info-circle me-2"></i>Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
