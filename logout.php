<?php
// Memulai sesi (session) PHP untuk mengakses dan menggunakan data sesi yang ada.
session_start();

// Destroy semua data sesi yang ada, sehingga pengguna ter-logout dari akun mereka.
session_destroy();

// Mengalihkan (redirect) pengguna ke halaman login (index.php) setelah proses logout selesai.
header('Location: index.php');
exit;
?>
