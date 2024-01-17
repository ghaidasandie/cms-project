<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../db/db_config.php';

    // Ambil data dari form
    $nama = $_POST['nama']; // Ambil nama kelas dari input "nama"

    // Query SQL untuk menambahkan data kelas ke tabel "classes"
    $sql = "INSERT INTO classes (name) VALUES ('$nama')";

    // Cek apakah query berhasil dieksekusi atau tidak
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, redirect ke halaman dashboard.php
        header('Location:../dashboard.php');
        exit;
    } else {
        // Jika gagal, tampilkan pesan error beserta query SQL yang gagal dan pesan error MySQL
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>
