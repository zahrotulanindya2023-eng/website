<!-- Footer -->
<footer class="footer-section">
    <div class="container">
        <div class="row g-4">
            <!-- Brand -->
            <div class="col-lg-4">
                <div class="footer-brand d-flex align-items-center gap-2 mb-3">
                    <div class="brand-icon">
                        <i class="bi bi-cpu-fill"></i>
                    </div>
                    <div>
                        <span class="brand-name text-white">HMSS</span>
                        <small class="brand-sub d-block text-white-50">Statistika</small>
                    </div>
                </div>
                <p class="text-white-50 small">Himpunan Mahasiswa Statistika adalah organisasi kemahasiswaan yang berfokus pada pengembangan teknologi dan inovasi untuk mempersiapkan generasi IT yang unggul.</p>
                <div class="social-links mt-3">
                    <a href="#" class="social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-btn" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-btn" title="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="social-btn" title="GitHub"><i class="bi bi-github"></i></a>
                    <a href="#" class="social-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <!-- Menu Cepat -->
            <div class="col-lg-2 col-md-4">
                <h6 class="footer-heading">Menu</h6>
                <ul class="footer-links">
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>index.php"><i class="bi bi-chevron-right"></i>Beranda</a></li>
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>about.php"><i class="bi bi-chevron-right"></i>Tentang Kami</a></li>
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>members.php"><i class="bi bi-chevron-right"></i>Anggota</a></li>
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>gallery.php"><i class="bi bi-chevron-right"></i>Galeri</a></li>
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>news.php"><i class="bi bi-chevron-right"></i>Berita</a></li>
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>contact.php"><i class="bi bi-chevron-right"></i>Kontak</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-3 col-md-4">
                <h6 class="footer-heading">Kontak Kami</h6>
                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA) Universitas Negeri Yogyakarta</span>
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill"></i>
                        <span>HMSS@cs.uny.ac.id</span>
                    </li>
                    <li>
                        <i class="bi bi-telephone-fill"></i>
                        <span>+62 899-0909-590</span>
                    </li>
                    <li>
                        <i class="bi bi-clock-fill"></i>
                        <span>Senin - Jumat, 09.00 - 17.00 WIB</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-4">
                <h6 class="footer-heading">Newsletter</h6>
                <p class="text-white-50 small">Daftarkan email Anda untuk mendapatkan informasi terbaru dari HMSS.</p>
                <form class="newsletter-form mt-2" onsubmit="return false;">
                    <div class="input-group">
                        <input type="email" class="form-control form-control-sm" placeholder="Email Anda...">
                        <button class="btn btn-accent btn-sm" type="submit">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </form>
                <div class="mt-3">
                    <span class="badge-stat">
                        <i class="bi bi-people-fill"></i> 500+ Anggota
                    </span>
                    <span class="badge-stat ms-2">
                        <i class="bi bi-calendar-event-fill"></i> 50+ Kegiatan
                    </span>
                </div>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="footer-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
            <p class="mb-0 text-white-50 small">
                &copy; <?php echo date('Y'); ?> <strong class="text-white">HMSS</strong> — Himpunan Mahasiswa Statistika. All rights reserved.
            </p>
            <p class="mb-0 text-white-50 small">
                Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> PHP & MySQL
            </p>
        </div>
    </div>
</footer>

<!-- Back to Top -->
<button class="back-to-top" id="backToTop" title="Kembali ke atas">
    <i class="bi bi-arrow-up-short"></i>
</button>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- Custom JS -->
<script>
// AOS Initialize
AOS.init({ duration: 700, once: true, offset: 50 });

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('mainNavbar');
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
});

// Back to top
const backToTop = document.getElementById('backToTop');
if (backToTop) {
    window.addEventListener('scroll', function() {
        backToTop.classList.toggle('visible', window.scrollY > 300);
    });
    backToTop.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}
</script>
</body>
</html>
