<?php
// Memulai sesi (session) PHP untuk mengakses dan menggunakan data sesi yang ada.
session_start();

// Memasukkan file konfigurasi database (db_config.php) yang berisi informasi koneksi ke database.
require_once 'db/db_config.php';

// Cek apakah metode permintaan dari form adalah POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* Mendapatkan data dari form registrasi */

    // Mendapatkan data yang diinputkan oleh pengguna melalui form registrasi.
    $dataUsername = $_POST["username"];
    $dataPassword = $_POST["password"];

    // Mempersiapkan pernyataan SQL menggunakan prepared statement untuk mencegah SQL injection.
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

    // Melakukan hashing pada password sebelum menyimpannya ke database.
    $hashedPassword = password_hash($dataPassword, PASSWORD_DEFAULT);

    // Mengikat parameter (binding) untuk mencegah SQL injection.
    $stmt->bind_param("ss", $dataUsername, $hashedPassword);

    // Menjalankan pernyataan SQL.
    $stmt->execute();

    // Menutup pernyataan prepared statement.
    $stmt->close();

    // Redirect pengguna ke halaman login.php setelah registrasi berhasil.
    header('Location: halaman_login.php');
}

// Menutup koneksi ke database setelah selesai menggunakan.
$conn->close();
?>
