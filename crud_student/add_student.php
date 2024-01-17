<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../db/db_config.php';

    // Ambil data dari form
    $nama = $_POST['nama']; // Ambil nama dari input "nama"
    $kelas = $_POST['kelas']; // Ambil kelas dari input "kelas"
    $alamat = $_POST['alamat']; // Ambil alamat dari input "alamat"

    // Query SQL untuk menambahkan data siswa ke tabel "students"
    $sql = "INSERT INTO students (name, class_id, address) VALUES ('$nama', $kelas, '$alamat')";

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
