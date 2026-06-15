<?php
// admin/gallery.php - CRUD Galeri Kegiatan
require_once 'auth_check.php';
require_once '../db.php';

$admin_title = 'Kelola Galeri';
$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// ===== DELETE =====
if ($action === 'delete' && $id > 0) {
    $item = $conn->query("SELECT image FROM events WHERE id = $id")->fetch_assoc();
    if ($item && !empty($item['image'])) {
        $img_path = '../assets/images/' . $item['image'];
        if (file_exists($img_path)) unlink($img_path);
    }
    $conn->query("DELETE FROM events WHERE id = $id");
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Kegiatan berhasil dihapus!'];
    header('Location: gallery.php');
    exit();
}

// ===== SAVE =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = clean($conn, $_POST['title'] ?? '');
    $date        = clean($conn, $_POST['date'] ?? date('Y-m-d'));
    $description = clean($conn, $_POST['description'] ?? '');
    $edit_id     = (int)($_POST['edit_id'] ?? 0);

    // Handle image upload
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed)) {
            $image = 'event_' . time() . '_' . rand(100,999) . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/' . $image);
        }
    }

    if ($edit_id > 0) {
        if ($image) {
            $old = $conn->query("SELECT image FROM events WHERE id = $edit_id")->fetch_assoc();
            if ($old && !empty($old['image'])) {
                $op = '../assets/images/' . $old['image'];
                if (file_exists($op)) unlink($op);
            }
            $conn->query("UPDATE events SET title='$title', date='$date', description='$description', image='$image' WHERE id=$edit_id");
        } else {
            $conn->query("UPDATE events SET title='$title', date='$date', description='$description' WHERE id=$edit_id");
        }
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Kegiatan berhasil diperbarui!'];
    } else {
        $stmt = $conn->prepare("INSERT INTO events (title, date, description, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $title, $date, $description, $image);
        $stmt->execute();
        $stmt->close();
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Kegiatan baru berhasil ditambahkan!'];
    }
    header('Location: gallery.php');
    exit();
}

// ===== EDIT DATA =====
$edit_data = null;
if ($action === 'edit' && $id > 0) {
    $edit_data = $conn->query("SELECT * FROM events WHERE id = $id")->fetch_assoc();
}

// ===== LIST =====
$events_list = $conn->query("SELECT * FROM events ORDER BY date DESC");

include 'admin_header.php';
?>

<?php if ($action === 'add' || $action === 'edit'): ?>
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h6 class="fw-700 mb-0">
            <i class="bi bi-images me-2"></i>
            <?php echo $action === 'edit' ? 'Edit Kegiatan' : 'Tambah Kegiatan Baru'; ?>
        </h6>
        <a href="gallery.php" class="btn btn-sm btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form method="POST" enctype="multipart/form-data">
            <?php if ($edit_data): ?>
            <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
            <?php endif; ?>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-600 small">Judul Kegiatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" required value="<?php echo htmlspecialchars($edit_data['title'] ?? ''); ?>" placeholder="Masukkan nama kegiatan...">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-600 small">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="date" required value="<?php echo htmlspecialchars($edit_data['date'] ?? date('Y-m-d')); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-600 small">Foto Kegiatan</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, GIF, WEBP. Maks 5MB.</small>
                    <?php if ($edit_data && !empty($edit_data['image']) && file_exists('../assets/images/'.$edit_data['image'])): ?>
                    <div class="mt-2">
                        <img src="../assets/images/<?php echo htmlspecialchars($edit_data['image']); ?>" style="height:80px;border-radius:8px;object-fit:cover;" alt="Foto">
                        <small class="text-muted ms-2">Foto saat ini</small>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-600 small">Deskripsi</label>
                    <textarea class="form-control" name="description" rows="4" placeholder="Deskripsi singkat kegiatan..."><?php echo htmlspecialchars($edit_data['description'] ?? ''); ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill">
                        <i class="bi bi-save me-2"></i>
                        <?php echo $action === 'edit' ? 'Simpan Perubahan' : 'Tambah Kegiatan'; ?>
                    </button>
                    <a href="gallery.php" class="btn btn-outline-secondary px-4 rounded-pill ms-2">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<!-- Gallery Grid Preview + Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h6 class="fw-700 mb-0"><i class="bi bi-images me-2"></i>Daftar Kegiatan/Galeri (<?php echo $events_list->num_rows; ?>)</h6>
        <a href="gallery.php?action=add" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i>Tambah Kegiatan
        </a>
    </div>
    <div class="admin-table">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($events_list && $events_list->num_rows > 0):
                    $n = 1;
                    while ($ev = $events_list->fetch_assoc()):
                ?>
                <tr>
                    <td class="text-muted"><?php echo $n++; ?></td>
                    <td>
                        <?php if (!empty($ev['image']) && file_exists('../assets/images/'.$ev['image'])): ?>
                            <img src="../assets/images/<?php echo htmlspecialchars($ev['image']); ?>" style="width:60px;height:42px;border-radius:8px;object-fit:cover;" alt="">
                        <?php else: ?>
                            <div style="width:60px;height:42px;border-radius:8px;background:var(--dark-2);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.2);">
                                <i class="bi bi-image"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><span class="fw-600" style="font-size:.88rem;"><?php echo htmlspecialchars(substr($ev['title'], 0, 45)) . (strlen($ev['title'])>45?'...':''); ?></span></td>
                    <td class="text-muted small"><?php echo date('d M Y', strtotime($ev['date'])); ?></td>
                    <td class="text-muted small"><?php echo htmlspecialchars(substr($ev['description'] ?? '', 0, 50)) . (strlen($ev['description']??'')>50?'...':''); ?></td>
                    <td>
                        <a href="gallery.php?action=edit&id=<?php echo $ev['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill me-1">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <a href="gallery.php?action=delete&id=<?php echo $ev['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill"
                           onclick="return confirm('Yakin hapus kegiatan ini?')">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-5">
                    <i class="bi bi-images" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                    Belum ada data galeri
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'admin_footer.php'; ?>
