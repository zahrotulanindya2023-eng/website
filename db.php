<?php
// =====================================================
// db.php - Koneksi Database MySQL
// =====================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Sesuaikan dengan username MySQL Anda
define('DB_PASS', '');           // Sesuaikan dengan password MySQL Anda
define('DB_NAME', 'website_profil_organisasi');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('<div style="font-family:sans-serif;padding:2rem;background:#fee2e2;color:#dc2626;border-radius:8px;margin:2rem;">
        <h2>❌ Koneksi Database Gagal</h2>
        <p><strong>Error:</strong> ' . $conn->connect_error . '</p>
        <p>Pastikan MySQL server berjalan dan konfigurasi database sudah benar di file <code>db.php</code></p>
    </div>');
}

$conn->set_charset("utf8mb4");

// Helper: Escape input
function clean($conn, $data) {
    return $conn->real_escape_string(trim($data));
}

// Helper: Redirect
function redirect($url) {
    header("Location: $url");
    exit();
}

// Helper: Flash message session
function setFlash($type, $message) {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}
?>
