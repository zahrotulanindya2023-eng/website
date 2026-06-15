<?php
// news.php - Halaman Berita / Artikel
session_start();
require_once 'db.php';
$page_title = 'Berita & Artikel';

// Detail berita jika ada id
$news_detail = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $res = $conn->query("SELECT * FROM news WHERE id = $id LIMIT 1");
    if ($res && $res->num_rows > 0) {
        $news_detail = $res->fetch_assoc();
    }
}

// Semua berita
$news_result = $conn->query("SELECT * FROM news ORDER BY date DESC");

include 'includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <?php if ($news_detail): ?>
                <li class="breadcrumb-item"><a href="news.php">Berita</a></li>
                <li class="breadcrumb-item active"><?php echo htmlspecialchars(substr($news_detail['title'], 0, 30)) . '...'; ?></li>
                <?php else: ?>
                <li class="breadcrumb-item active">Berita & Artikel</li>
                <?php endif; ?>
            </ol>
        </nav>
        <h1 class="page-hero-title">
            <?php echo $news_detail ? '<span class="gradient-text">Detail Berita</span>' : 'Berita & <span class="gradient-text">Artikel</span>'; ?>
        </h1>
        <p class="page-hero-subtitle">Informasi terkini tentang kegiatan, prestasi, dan perkembangan HMSS.</p>
    </div>
</section>

<?php if ($news_detail): ?>
<!-- ========== DETAIL BERITA ========== -->
<section class="section-padding" style="background:#f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="background:white;border-radius:16px;overflow:hidden;border:1px solid #e2e8f0;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
                    <!-- Image -->
                    <div style="height:300px;background:var(--gradient-dark);display:flex;align-items:center;justify-content:center;">
                        <?php if (!empty($news_detail['image']) && file_exists('assets/images/' . $news_detail['image'])): ?>
                            <img src="assets/images/<?php echo htmlspecialchars($news_detail['image']); ?>" alt="<?php echo htmlspecialchars($news_detail['title']); ?>" style="width:100%;height:100%;object-fit:cover;">
                        <?php else: ?>
                            <i class="bi bi-newspaper" style="font-size:4rem;color:rgba(255,255,255,0.2);"></i>
                        <?php endif; ?>
                    </div>
                    <!-- Content -->
                    <div class="p-4 p-lg-5">
                        <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                            <span class="badge-primary-custom">Berita</span>
                            <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i><?php echo date('d F Y', strtotime($news_detail['date'])); ?></span>
                        </div>
                        <h1 style="font-size:1.8rem;font-weight:800;color:var(--dark);margin-bottom:1.5rem;line-height:1.3;">
                            <?php echo htmlspecialchars($news_detail['title']); ?>
                        </h1>
                        <div style="color:#334155;line-height:1.9;font-size:1rem;">
                            <?php echo nl2br(htmlspecialchars($news_detail['content'])); ?>
                        </div>
                        <hr class="my-4">
                        <a href="news.php" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Berita
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div style="background:white;border-radius:16px;padding:1.5rem;border:1px solid #e2e8f0;position:sticky;top:90px;">
                    <h6 class="fw-700 mb-3">Berita Lainnya</h6>
                    <?php
                    $other_news = $conn->query("SELECT id, title, date FROM news WHERE id != " . $news_detail['id'] . " ORDER BY date DESC LIMIT 5");
                    if ($other_news && $other_news->num_rows > 0):
                        while ($on = $other_news->fetch_assoc()):
                    ?>
                    <div class="mb-3 pb-3 border-bottom">
                        <a href="news.php?id=<?php echo $on['id']; ?>" class="text-dark fw-600 small" style="font-size:.88rem;line-height:1.5;display:block;">
                            <?php echo htmlspecialchars($on['title']); ?>
                        </a>
                        <span class="text-muted" style="font-size:.75rem;"><i class="bi bi-calendar3 me-1"></i><?php echo date('d M Y', strtotime($on['date'])); ?></span>
                    </div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php else: ?>
<!-- ========== DAFTAR BERITA ========== -->
<section class="section-padding" style="background:#f8fafc;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <div class="section-eyebrow">Informasi</div>
            <h2 class="section-title">Semua <span class="gradient-text">Berita</span></h2>
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
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge-primary-custom" style="font-size:.7rem;">Berita</span>
                            <span class="news-date"><i class="bi bi-calendar3 me-1"></i><?php echo date('d F Y', strtotime($news['date'])); ?></span>
                        </div>
                        <h5 class="news-title"><?php echo htmlspecialchars($news['title']); ?></h5>
                        <p class="news-excerpt"><?php echo htmlspecialchars(substr(strip_tags($news['content']), 0, 150)) . '...'; ?></p>
                        <a href="news.php?id=<?php echo $news['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill mt-2">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
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
                <a href="admin/login.php" class="btn btn-primary btn-sm">Tambah Berita</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
