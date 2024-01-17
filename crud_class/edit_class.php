<?php
// Jika halaman ini dipanggil menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memastikan semua data yang dibutuhkan sudah diisi oleh pengguna
    if (isset($_POST['classes_name']) && isset($_POST['new_kelas'])) {
        // Menyimpan data dari form ke variabel-variabel
        $classes_name = $_POST['classes_name'];
        $new_kelas = $_POST['new_kelas'];

        // Memanggil file konfigurasi database
        require_once '../db/db_config.php';

        // Query SQL untuk melakukan update data kelas berdasarkan nama kelas yang dipilih
        $sql = "UPDATE classes SET name = '$new_kelas' WHERE name = '$classes_name'";

        // Menjalankan query SQL
        if (mysqli_query($conn, $sql)) {
            // Jika berhasil, redirect ke halaman dashboard.php
            header('Location:../dashboard.php');
            exit;
        } else {
            // Jika terjadi error, tampilkan pesan error
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Menutup koneksi ke database
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perbarui Kelas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Perbarui Kelas</h2>
        <!-- Formulir untuk melakukan update data kelas -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <!-- Input untuk memasukkan nama kelas yang akan diupdate -->
            <div class="form-group">
                <label for="classes_name">Nama Kelas:</label>
                <input type="text" class="form-control" id="classes_name" name="classes_name" required>
            </div>
            <!-- Input untuk memasukkan nama kelas baru -->
            <div class="form-group">
                <label for="new_kelas">Nama Kelas Baru:</label>
                <input type="text" class="form-control" id="new_kelas" name="new_kelas" required>
            </div>
            <!-- Tombol untuk melakukan update data kelas -->
            <button type="submit" class="btn btn-success">Perbarui Data</button>
        </form>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
