<?php
// contact.php - Halaman Kontak
session_start();
require_once 'db.php';
$page_title = 'Kontak';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = clean($conn, $_POST['name'] ?? '');
    $email   = clean($conn, $_POST['email'] ?? '');
    $message = clean($conn, $_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Semua field wajib diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $name, $email, $message);
        if ($stmt->execute()) {
            $success = 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.';
        } else {
            $error = 'Terjadi kesalahan. Silakan coba lagi.';
        }
        $stmt->close();
    }
}

include 'includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active">Kontak</li>
            </ol>
        </nav>
        <h1 class="page-hero-title">Hubungi <span class="gradient-text">Kami</span></h1>
        <p class="page-hero-subtitle">Ada pertanyaan atau ingin berkolaborasi? Kami siap membantu Anda.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section-padding" style="background:#f8fafc;">
    <div class="container">
        <div class="row g-4">
            <!-- Info Kontak -->
            <div class="col-lg-4" data-aos="fade-right">
                <div class="contact-info-card">
                    <h4 class="fw-700 text-white mb-4">Informasi Kontak</h4>
                    
                    <div class="contact-item">
                        <div class="contact-icon-wrap"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <div class="text-white fw-600 small mb-1">Alamat</div>
                            <div class="text-white-50 small">Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA) Universitas Negeri Yogyakarta.
							Jl. Colombo No.1, Karang Malang, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon-wrap"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="text-white fw-600 small mb-1">Email</div>
                            <div class="text-white-50 small">HMSS@cs.uny.ac.id</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon-wrap"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="text-white fw-600 small mb-1">Telepon</div>
                            <div class="text-white-50 small">+62 899-0909-590</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon-wrap"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <div class="text-white fw-600 small mb-1">Jam Operasional</div>
                            <div class="text-white-50 small">Senin - Jumat<br>09.00 - 17.00 WIB</div>
                        </div>
                    </div>

                    <hr style="border-color:rgba(255,255,255,0.1);margin:1.5rem 0;">
                    
                    <h6 class="text-white fw-700 mb-3">Media Sosial</h6>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="#" class="social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-btn" title="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-btn" title="GitHub"><i class="bi bi-github"></i></a>
                        <a href="#" class="social-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Form Kontak -->
            <div class="col-lg-8" data-aos="fade-left">
                <div class="contact-form-card">
                    <h4 class="fw-700 mb-1">Kirim Pesan</h4>
                    <p class="text-secondary small mb-4">Isi formulir di bawah ini dan kami akan merespons dalam 1x24 jam.</p>
                    
                    <?php if ($success): ?>
                    <div class="alert-custom alert-success-custom mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i><?php echo $success; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                    <div class="alert-custom alert-danger-custom mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-600 small" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-custom" id="name" name="name" placeholder="Masukkan nama Anda" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600 small" for="email">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-custom" id="email" name="email" placeholder="nama@email.com" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-600 small" for="subject">Subjek</label>
                                <input type="text" class="form-control form-control-custom" id="subject" name="subject" placeholder="Topik pesan Anda">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-600 small" for="message">Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-custom" id="message" name="message" rows="6" placeholder="Tulis pesan Anda di sini..." required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-primary-custom d-inline-flex align-items-center gap-2" id="submitBtn">
                                    <i class="bi bi-send-fill"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Google Maps Placeholder -->
        <div class="mt-4" data-aos="fade-up">
            <div style="background:var(--dark-2);border-radius:16px;height:300px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:1rem;border:1px solid rgba(255,255,255,0.05);">
                <i class="bi bi-geo-alt-fill" style="font-size:3rem;color:var(--primary-light);"></i>
                <div class="text-white fw-600">Lokasi Sekretariat HMSS</div>
                <div class="text-white-50 small">Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA) Universitas Negeri Yogyakarta</div>
                <a href="https://maps.app.goo.gl/mWGFH3NaaskXYjKw7" target="_blank" class="btn btn-sm btn-outline-light rounded-pill px-3">
                    <i class="bi bi-map me-2"></i>Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section-padding" style="background:white;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <div class="section-eyebrow">FAQ</div>
            <h2 class="section-title">Pertanyaan yang <span class="gradient-text">Sering Diajukan</span></h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <?php
                    $faqs = [
                        ['q' => 'Bagaimana cara mendaftar menjadi anggota HMSS?', 'a' => 'Pendaftaran anggota HMSS dibuka setiap awal semester genap. Calon anggota dapat mendaftar melalui website resmi kami atau datang langsung ke sekretariat di Gedung TI Lt. 2.'],
                        ['q' => 'Apa saja kegiatan yang diadakan oleh HMSS?', 'a' => 'HMSS mengadakan berbagai kegiatan meliputi: workshop teknologi, seminar, hackathon, kunjungan industri, pelatihan soft skill, lomba programming, dan kegiatan sosial.'],
                        ['q' => 'Apakah ada biaya untuk bergabung dengan HMSS?', 'a' => 'Tidak ada biaya pendaftaran untuk menjadi anggota HMSS. Beberapa kegiatan tertentu mungkin memiliki biaya pendaftaran yang sangat terjangkau.'],
                        ['q' => 'Bagaimana cara berkolaborasi dengan HMSS?', 'a' => 'Untuk keperluan kerjasama atau kolaborasi, silakan hubungi kami melalui email resmi di HMSS@cs.ui.ac.id atau mengisi formulir kontak di halaman ini.'],
                    ];
                    foreach ($faqs as $i => $faq):
                    ?>
                    <div class="accordion-item border mb-2 rounded-xl overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo $i*100; ?>">
                        <h2 class="accordion-header">
                            <button class="accordion-button <?php echo $i>0?'collapsed':''; ?> fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?php echo $i; ?>">
                                <?php echo $faq['q']; ?>
                            </button>
                        </h2>
                        <div id="faq<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i==0?'show':''; ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                <?php echo $faq['a']; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('contactForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';
    btn.disabled = true;
});
</script>

<?php include 'includes/footer.php'; ?>
