<?php
// admin/members.php - CRUD Anggota
require_once 'auth_check.php';
require_once '../db.php';

$admin_title = 'Kelola Anggota';
$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// ===== DELETE =====
if ($action === 'delete' && $id > 0) {
    $member = $conn->query("SELECT photo FROM members WHERE id = $id")->fetch_assoc();
    if ($member && !empty($member['photo'])) {
        $img_path = '../assets/images/' . $member['photo'];
        if (file_exists($img_path)) unlink($img_path);
    }
    $conn->query("DELETE FROM members WHERE id = $id");
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Anggota berhasil dihapus!'];
    header('Location: members.php');
    exit();
}

// ===== SAVE (Add / Edit) =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = clean($conn, $_POST['name'] ?? '');
    $role  = clean($conn, $_POST['role'] ?? '');
    $bio   = clean($conn, $_POST['bio'] ?? '');
    $edit_id = (int)($_POST['edit_id'] ?? 0);

    // Handle photo upload
    $photo = '';
    if (!empty($_FILES['photo']['name'])) {
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed)) {
            $photo = 'member_' . time() . '_' . rand(100,999) . '.' . $ext;
            move_uploaded_file($_FILES['photo']['tmp_name'], '../assets/images/' . $photo);
        }
    }

    if ($edit_id > 0) {
        // UPDATE
        if ($photo) {
            // Hapus foto lama
            $old = $conn->query("SELECT photo FROM members WHERE id = $edit_id")->fetch_assoc();
            if ($old && !empty($old['photo'])) {
                $old_path = '../assets/images/' . $old['photo'];
                if (file_exists($old_path)) unlink($old_path);
            }
            $conn->query("UPDATE members SET name='$name', role='$role', bio='$bio', photo='$photo' WHERE id=$edit_id");
        } else {
            $conn->query("UPDATE members SET name='$name', role='$role', bio='$bio' WHERE id=$edit_id");
        }
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data anggota berhasil diperbarui!'];
    } else {
        // INSERT
        $stmt = $conn->prepare("INSERT INTO members (name, role, photo, bio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $name, $role, $photo, $bio);
        $stmt->execute();
        $stmt->close();
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Anggota baru berhasil ditambahkan!'];
    }
    header('Location: members.php');
    exit();
}

// ===== EDIT: Ambil data =====
$edit_data = null;
if ($action === 'edit' && $id > 0) {
    $edit_data = $conn->query("SELECT * FROM members WHERE id = $id")->fetch_assoc();
}

// ===== LIST =====
$members = $conn->query("SELECT * FROM members ORDER BY id ASC");

include 'admin_header.php';
?>

<?php if ($action === 'add' || $action === 'edit'): ?>
<!-- ===== FORM ADD/EDIT ===== -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h6 class="fw-700 mb-0">
            <i class="bi bi-person-<?php echo $action==='edit'?'gear':'plus'; ?>-fill me-2"></i>
            <?php echo $action === 'edit' ? 'Edit Anggota' : 'Tambah Anggota Baru'; ?>
        </h6>
        <a href="members.php" class="btn btn-sm btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form method="POST" enctype="multipart/form-data">
            <?php if ($edit_data): ?>
            <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
            <?php endif; ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-600 small">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" required value="<?php echo htmlspecialchars($edit_data['name'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-600 small">Jabatan/Peran <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="role" required value="<?php echo htmlspecialchars($edit_data['role'] ?? ''); ?>" placeholder="cth: Ketua Umum, Wakil Ketua...">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-600 small">Foto</label>
                    <input type="file" class="form-control" name="photo" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, GIF, WEBP. Maks 2MB.</small>
                    <?php if ($edit_data && !empty($edit_data['photo']) && file_exists('../assets/images/'.$edit_data['photo'])): ?>
                    <div class="mt-2">
                        <img src="../assets/images/<?php echo htmlspecialchars($edit_data['photo']); ?>" style="height:60px;border-radius:8px;" alt="Foto">
                        <small class="text-muted ms-2">Foto saat ini</small>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-600 small">Bio / Deskripsi</label>
                    <textarea class="form-control" name="bio" rows="4" placeholder="Deskripsi singkat tentang anggota..."><?php echo htmlspecialchars($edit_data['bio'] ?? ''); ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill">
                        <i class="bi bi-save me-2"></i>
                        <?php echo $action === 'edit' ? 'Simpan Perubahan' : 'Tambah Anggota'; ?>
                    </button>
                    <a href="members.php" class="btn btn-outline-secondary px-4 rounded-pill ms-2">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<!-- ===== TABLE LIST ===== -->
<div class="admin-card">
    <div class="admin-card-header">
        <h6 class="fw-700 mb-0"><i class="bi bi-people-fill me-2"></i>Daftar Anggota (<?php echo $members->num_rows; ?>)</h6>
        <a href="members.php?action=add" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i>Tambah Anggota
        </a>
    </div>
    <div class="admin-table">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Bio</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($members && $members->num_rows > 0):
                    $n = 1;
                    while ($m = $members->fetch_assoc()):
                ?>
                <tr>
                    <td class="text-muted"><?php echo $n++; ?></td>
                    <td>
                        <?php if (!empty($m['photo']) && file_exists('../assets/images/'.$m['photo'])): ?>
                            <img src="../assets/images/<?php echo htmlspecialchars($m['photo']); ?>" style="width:40px;height:40px;border-radius:8px;object-fit:cover;" alt="<?php echo htmlspecialchars($m['name']); ?>">
                        <?php else: ?>
                            <div style="width:40px;height:40px;border-radius:8px;background:rgba(79,70,229,0.1);display:flex;align-items:center;justify-content:center;color:var(--primary);">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><span class="fw-600"><?php echo htmlspecialchars($m['name']); ?></span></td>
                    <td><span class="badge-primary-custom" style="font-size:.75rem;"><?php echo htmlspecialchars($m['role']); ?></span></td>
                    <td class="text-muted small"><?php echo htmlspecialchars(substr($m['bio'] ?? '', 0, 60)) . (strlen($m['bio']??'')>60?'...':''); ?></td>
                    <td>
                        <a href="members.php?action=edit&id=<?php echo $m['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill me-1">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <a href="members.php?action=delete&id=<?php echo $m['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill"
                           onclick="return confirm('Yakin hapus anggota <?php echo addslashes($m['name']); ?>?')">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-5">
                    <i class="bi bi-people" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                    Belum ada data anggota
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'admin_footer.php'; ?>
