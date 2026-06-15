<?php
// admin/dashboard.php - Dashboard Admin
require_once 'auth_check.php';
require_once '../db.php';

$admin_title = 'Dashboard';

// Statistik
$total_members  = $conn->query("SELECT COUNT(*) as t FROM members")->fetch_assoc()['t'];
$total_events   = $conn->query("SELECT COUNT(*) as t FROM events")->fetch_assoc()['t'];
$total_news     = $conn->query("SELECT COUNT(*) as t FROM news")->fetch_assoc()['t'];
$total_contacts = $conn->query("SELECT COUNT(*) as t FROM contacts")->fetch_assoc()['t'];

// 5 pesan terbaru
$recent_contacts = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5");

// 5 berita terbaru
$recent_news = $conn->query("SELECT * FROM news ORDER BY date DESC LIMIT 5");

include 'admin_header.php';
?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-icon blue"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-card-num"><?php echo $total_members; ?></div>
                <div class="stat-card-label">Total Anggota</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-icon teal"><i class="bi bi-images"></i></div>
            <div>
                <div class="stat-card-num"><?php echo $total_events; ?></div>
                <div class="stat-card-label">Total Galeri</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-icon green"><i class="bi bi-newspaper"></i></div>
            <div>
                <div class="stat-card-num"><?php echo $total_news; ?></div>
                <div class="stat-card-label">Total Berita</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-icon orange"><i class="bi bi-envelope-fill"></i></div>
            <div>
                <div class="stat-card-num"><?php echo $total_contacts; ?></div>
                <div class="stat-card-label">Pesan Masuk</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="fw-700 mb-0"><i class="bi bi-lightning-fill text-warning me-2"></i>Aksi Cepat</h6>
            </div>
            <div class="admin-card-body">
                <div class="d-flex flex-wrap gap-2">
                    <a href="members.php?action=add" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-person-plus me-2"></i>Tambah Anggota
                    </a>
                    <a href="news.php?action=add" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Berita
                    </a>
                    <a href="gallery.php?action=add" class="btn btn-info rounded-pill px-4 text-white">
                        <i class="bi bi-image-fill me-2"></i>Tambah Galeri
                    </a>
                    <a href="contacts.php" class="btn btn-warning rounded-pill px-4">
                        <i class="bi bi-envelope me-2"></i>Lihat Pesan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent News -->
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="fw-700 mb-0"><i class="bi bi-newspaper me-2"></i>Berita Terbaru</h6>
                <a href="news.php" class="btn btn-sm btn-outline-primary rounded-pill">Semua</a>
            </div>
            <div class="admin-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($recent_news && $recent_news->num_rows > 0):
                            $n = 1;
                            while ($news = $recent_news->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-muted"><?php echo $n++; ?></td>
                            <td>
                                <span class="fw-600" style="font-size:.88rem;"><?php echo htmlspecialchars(substr($news['title'], 0, 45)) . (strlen($news['title'])>45?'...':''); ?></span>
                            </td>
                            <td class="text-muted small"><?php echo date('d M Y', strtotime($news['date'])); ?></td>
                            <td>
                                <a href="news.php?action=edit&id=<?php echo $news['id']; ?>" class="btn btn-xs btn-outline-primary me-1" style="font-size:.75rem;padding:.2rem .5rem;">Edit</a>
                                <a href="news.php?action=delete&id=<?php echo $news['id']; ?>" class="btn btn-xs btn-outline-danger" style="font-size:.75rem;padding:.2rem .5rem;" onclick="return confirm('Hapus berita ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada berita</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="col-lg-5">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h6 class="fw-700 mb-0"><i class="bi bi-envelope me-2"></i>Pesan Terbaru</h6>
                <a href="contacts.php" class="btn btn-sm btn-outline-primary rounded-pill">Semua</a>
            </div>
            <div class="admin-card-body p-0">
                <?php
                if ($recent_contacts && $recent_contacts->num_rows > 0):
                    while ($contact = $recent_contacts->fetch_assoc()):
                ?>
                <div class="d-flex gap-3 p-3 border-bottom">
                    <div style="width:36px;height:36px;background:rgba(79,70,229,0.1);border-radius:9px;display:flex;align-items:center;justify-content:center;color:var(--primary);flex-shrink:0;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="flex-grow-1 min-w-0">
                        <div class="fw-600" style="font-size:.85rem;"><?php echo htmlspecialchars($contact['name']); ?></div>
                        <div class="text-muted" style="font-size:.78rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo htmlspecialchars(substr($contact['message'], 0, 50)); ?>...</div>
                        <div class="text-muted" style="font-size:.72rem;margin-top:.2rem;"><?php echo date('d M Y H:i', strtotime($contact['created_at'])); ?></div>
                    </div>
                </div>
                <?php endwhile; else: ?>
                <div class="text-center text-muted py-5">
                    <i class="bi bi-envelope-open" style="font-size:2rem;"></i>
                    <p class="small mt-2">Belum ada pesan</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'admin_footer.php'; ?>
