<?php
// Memulai sesi (session) PHP untuk mengakses dan menggunakan data sesi yang ada.
session_start();

// Memasukkan file konfigurasi database (db_config.php) yang berisi informasi koneksi ke database.
require_once 'db/db_config.php';

// Cek apakah metode permintaan dari form adalah POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* Mendapatkan data dari tabel user */

    // Mendapatkan data yang diinputkan oleh pengguna melalui form login.
    $dataUsername = $_POST["username"];
    $dataPassword = $_POST["password"];

    // Mempersiapkan pernyataan SQL menggunakan prepared statement untuk mencegah SQL injection.
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");

    // Mengikat parameter (binding) untuk mencegah SQL injection.
    $stmt->bind_param("s", $dataUsername);

    // Menjalankan pernyataan SQL.
    $stmt->execute();

    // Mengambil hasil dari pernyataan SQL.
    $stmt->bind_result($userId, $dbUsername, $dbPasswordHash);

    // Memeriksa apakah data user ditemukan berdasarkan username yang diinputkan.
    if ($stmt->fetch() && password_verify($dataPassword, $dbPasswordHash)) {
        // Jika password cocok, redirect pengguna ke halaman dashboard.php karena login berhasil.
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $dbUsername;
        header('Location: dashboard.php');
    } else {
        // Jika tidak ada data user yang sesuai, tampilkan pesan "Login gagal" dengan warna teks merah.
        echo "<p style='color: red;'>Login gagal</p>";
    }

    // Menutup pernyataan prepared statement.
    $stmt->close();
}

// Menutup koneksi ke database setelah selesai menggunakan.
$conn->close();
?>
