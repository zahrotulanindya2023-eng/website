<?php
// gallery.php - Galeri Kegiatan
session_start();
require_once 'db.php';
$page_title = 'Galeri Kegiatan';

// Ambil semua data galeri
$gallery_result = $conn->query("SELECT * FROM events ORDER BY date DESC");

include 'includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active">Galeri Kegiatan</li>
            </ol>
        </nav>
        <h1 class="page-hero-title">Galeri <span class="gradient-text">Kegiatan</span></h1>
        <p class="page-hero-subtitle">Dokumentasi foto dari berbagai kegiatan dan program yang telah dilaksanakan oleh HMSS.</p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="section-padding" style="background:#f8fafc;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <div class="section-eyebrow">Dokumentasi</div>
            <h2 class="section-title">Momen Berkesan <span class="gradient-text">HMSS</span></h2>
        </div>
        
        <div class="row g-3">
            <?php
            if ($gallery_result && $gallery_result->num_rows > 0):
                $i = 0;
                while ($event = $gallery_result->fetch_assoc()):
                    $i++;
            ?>
            <div class="col-6 col-md-4 col-lg-4" data-aos="zoom-in" data-aos-delay="<?php echo (($i-1)%6)*50; ?>">
                <div class="gallery-card" onclick="openLightbox('<?php echo htmlspecialchars($event['title']); ?>', '<?php echo htmlspecialchars($event['description']); ?>', '<?php echo date('d F Y', strtotime($event['date'])); ?>', 'assets/images/<?php echo htmlspecialchars($event['image'] ?? ''); ?>')">
                    <?php if (!empty($event['image']) && file_exists('assets/images/' . $event['image'])): ?>
                        <img src="assets/images/<?php echo htmlspecialchars($event['image']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" loading="lazy">
                    <?php else: ?>
                        <div class="gallery-placeholder">
                            <i class="bi bi-image"></i>
                            <span style="font-size:.78rem;text-align:center;"><?php echo htmlspecialchars($event['title']); ?></span>
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
                <p class="text-muted mt-3">Belum ada data galeri tersedia.</p>
                <a href="admin/login.php" class="btn btn-primary btn-sm">Tambah Kegiatan</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Event List Section -->
<section class="section-padding" style="background:white;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <div class="section-eyebrow">Daftar Kegiatan</div>
            <h2 class="section-title">Semua <span class="gradient-text">Kegiatan</span></h2>
        </div>
        <?php
        $events_list = $conn->query("SELECT * FROM events ORDER BY date DESC");
        if ($events_list && $events_list->num_rows > 0):
        ?>
        <div class="row g-4">
            <?php while ($ev = $events_list->fetch_assoc()): ?>
            <div class="col-md-6" data-aos="fade-up">
                <div class="d-flex gap-3" style="background:#f8fafc;border-radius:12px;padding:1.25rem;border:1px solid #e2e8f0;">
                    <div style="width:60px;height:60px;border-radius:12px;background:var(--gradient-primary);display:flex;flex-direction:column;align-items:center;justify-content:center;color:white;flex-shrink:0;">
                        <span style="font-size:1.25rem;font-weight:800;line-height:1;"><?php echo date('d', strtotime($ev['date'])); ?></span>
                        <span style="font-size:.65rem;text-transform:uppercase;"><?php echo date('M', strtotime($ev['date'])); ?></span>
                    </div>
                    <div>
                        <h6 class="fw-700 mb-1"><?php echo htmlspecialchars($ev['title']); ?></h6>
                        <p class="text-secondary small mb-0" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                            <?php echo htmlspecialchars($ev['description']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="lightboxModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white fw-700" id="lightboxTitle">-</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img id="lightboxImg" src="" alt="" class="w-100" style="max-height:500px;object-fit:contain;display:none;">
                <div id="lightboxNoImg" class="text-center py-5" style="display:none;">
                    <i class="bi bi-image text-secondary" style="font-size:4rem;"></i>
                </div>
            </div>
            <div class="modal-footer border-0 flex-column align-items-start">
                <p class="text-white-50 small mb-1" id="lightboxDate"></p>
                <p class="text-white small mb-0" id="lightboxDesc"></p>
            </div>
        </div>
    </div>
</div>

<script>
function openLightbox(title, desc, date, imgSrc) {
    document.getElementById('lightboxTitle').textContent = title;
    document.getElementById('lightboxDesc').textContent = desc;
    document.getElementById('lightboxDate').innerHTML = '<i class="bi bi-calendar3 me-1"></i>' + date;
    
    const img = document.getElementById('lightboxImg');
    const noImg = document.getElementById('lightboxNoImg');
    
    // Try loading image
    const testImg = new Image();
    testImg.onload = function() {
        img.src = imgSrc;
        img.style.display = 'block';
        noImg.style.display = 'none';
    };
    testImg.onerror = function() {
        img.style.display = 'none';
        noImg.style.display = 'block';
    };
    testImg.src = imgSrc;
    
    new bootstrap.Modal(document.getElementById('lightboxModal')).show();
}
</script>

<?php include 'includes/footer.php'; ?>
