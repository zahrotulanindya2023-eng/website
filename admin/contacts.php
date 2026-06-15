<?php
// admin/contacts.php - Lihat & Kelola Pesan Masuk
require_once 'auth_check.php';
require_once '../db.php';

$admin_title = 'Pesan Masuk';

// Delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn->query("DELETE FROM contacts WHERE id = $id");
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Pesan berhasil dihapus!'];
    header('Location: contacts.php');
    exit();
}

$contacts = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");

include 'admin_header.php';
?>

<div class="admin-card">
    <div class="admin-card-header">
        <h6 class="fw-700 mb-0">
            <i class="bi bi-envelope-fill me-2"></i>
            Pesan Masuk (<?php echo $contacts->num_rows; ?>)
        </h6>
    </div>
    <div class="admin-table">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($contacts && $contacts->num_rows > 0):
                    $n = 1;
                    while ($c = $contacts->fetch_assoc()):
                ?>
                <tr>
                    <td class="text-muted"><?php echo $n++; ?></td>
                    <td><span class="fw-600"><?php echo htmlspecialchars($c['name']); ?></span></td>
                    <td>
                        <a href="mailto:<?php echo htmlspecialchars($c['email']); ?>" class="text-primary small">
                            <?php echo htmlspecialchars($c['email']); ?>
                        </a>
                    </td>
                    <td class="text-muted small" style="max-width:300px;">
                        <?php echo htmlspecialchars(substr($c['message'], 0, 100)) . (strlen($c['message'])>100?'...':''); ?>
                    </td>
                    <td class="text-muted small"><?php echo date('d M Y H:i', strtotime($c['created_at'])); ?></td>
                    <td>
                        <button class="btn btn-sm btn-outline-info rounded-pill me-1"
                            onclick="viewMsg('<?php echo addslashes(htmlspecialchars($c['name'])); ?>', '<?php echo addslashes(htmlspecialchars($c['email'])); ?>', '<?php echo addslashes(htmlspecialchars($c['message'])); ?>', '<?php echo date('d M Y H:i', strtotime($c['created_at'])); ?>')">
                            <i class="bi bi-eye me-1"></i>Lihat
                        </button>
                        <a href="contacts.php?action=delete&id=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill"
                           onclick="return confirm('Hapus pesan ini?')">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-5">
                    <i class="bi bi-envelope-open" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                    Belum ada pesan masuk
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Detail Pesan -->
<div class="modal fade" id="msgModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-xl">
            <div class="modal-header border-0" style="background:var(--gradient-primary);border-radius:12px 12px 0 0;">
                <h5 class="modal-title text-white fw-700" id="msgModalTitle">Detail Pesan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <span class="fw-600 small text-muted text-uppercase">Pengirim</span>
                    <p class="fw-700 mb-0" id="msgName"></p>
                </div>
                <div class="mb-3">
                    <span class="fw-600 small text-muted text-uppercase">Email</span>
                    <p class="mb-0" id="msgEmail"></p>
                </div>
                <div class="mb-3">
                    <span class="fw-600 small text-muted text-uppercase">Waktu</span>
                    <p class="mb-0 small text-muted" id="msgTime"></p>
                </div>
                <div>
                    <span class="fw-600 small text-muted text-uppercase">Pesan</span>
                    <div class="mt-1 p-3 rounded-xl" style="background:#f8fafc;line-height:1.8;" id="msgContent"></div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <a href="#" class="btn btn-primary rounded-pill px-4" id="msgReplyBtn">
                    <i class="bi bi-reply-fill me-2"></i>Balas via Email
                </a>
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewMsg(name, email, message, time) {
    document.getElementById('msgModalTitle').textContent = 'Pesan dari ' + name;
    document.getElementById('msgName').textContent = name;
    document.getElementById('msgEmail').textContent = email;
    document.getElementById('msgTime').textContent = time;
    document.getElementById('msgContent').textContent = message;
    document.getElementById('msgReplyBtn').href = 'mailto:' + email + '?subject=Re: Pesan dari Website HMSS';
    new bootstrap.Modal(document.getElementById('msgModal')).show();
}
</script>

<?php include 'admin_footer.php'; ?>
