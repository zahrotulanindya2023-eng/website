<?php
// admin/auth_check.php - Middleware cek sesi admin
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
?>
