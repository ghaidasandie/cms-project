<?php
// Memulai sesi untuk menyimpan data sesi
session_start();

// Memanggil file konfigurasi database
require_once '../db/db_config.php';

// Jika halaman ini dipanggil menggunakan metode GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Memastikan parameter "id" dari URL ada
    if (isset($_GET['id'])) {
        // Menyimpan nilai "id" dari parameter URL ke dalam variabel
        $student_id = $_GET['id'];

        // Query SQL untuk menghapus data siswa berdasarkan id
        $sql = "DELETE FROM students WHERE id = $student_id";

        // Menjalankan query SQL
        if (mysqli_query($conn, $sql)) {
            // Jika berhasil menghapus data, redirect ke halaman dashboard.php
            header('Location:../dashboard.php');
            exit;
        } else {
            // Jika terjadi error, tampilkan pesan error beserta query SQL yang error
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Menutup koneksi ke database
        mysqli_close($conn);
    }
}
?>
