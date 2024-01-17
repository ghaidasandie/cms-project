<?php
// Jika halaman ini dipanggil menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memastikan semua data yang dibutuhkan sudah diisi oleh pengguna
    if (isset($_POST['student_name']) && isset($_POST['new_nama']) && isset($_POST['new_kelas']) && isset($_POST['new_alamat'])) {
        // Menyimpan data dari form ke variabel-variabel
        $student_name = $_POST['student_name'];
        $new_nama = $_POST['new_nama'];
        $new_kelas = $_POST['new_kelas'];
        $new_alamat = $_POST['new_alamat'];

        // Memanggil file konfigurasi database
        require_once '../db/db_config.php';

        // Query SQL untuk melakukan update data siswa berdasarkan nama siswa yang dipilih
        $sql = "UPDATE students SET name = '$new_nama', class_id = $new_kelas, address = '$new_alamat' WHERE name = '$student_name'";

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
    <title>Web Siswa - Update Student</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Update Student</h2>
        <!-- Formulir untuk melakukan update data siswa -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <!-- Input untuk memasukkan nama siswa yang akan diupdate -->
            <div class="form-group">
                <label for="student_name">Nama Siswa:</label>
                <input type="text" class="form-control" id="student_name" name="student_name" required>
            </div>
            <!-- Input untuk memasukkan nama baru siswa -->
            <div class="form-group">
                <label for="new_nama">Nama Siswa Baru:</label>
                <input type="text" class="form-control" id="new_nama" name="new_nama" required>
            </div>
            <!-- Dropdown untuk memilih kelas baru siswa -->
            <div class="form-group">
                <label for="new_kelas">Kelas:</label>
                <select class="form-control" id="new_kelas" name="new_kelas" required>
                    <option value="">Pilih Kelas</option>
                    <?php
                    // Memanggil file konfigurasi database
                    require_once '../db/db_config.php';

                    // Query SQL untuk mengambil data kelas dari tabel "classes"
                    $sql = "SELECT * FROM classes";
                    $result = mysqli_query($conn, $sql);

                    // Menampilkan setiap nama kelas sebagai pilihan dalam dropdown
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }

                    // Menutup koneksi ke database
                    mysqli_close($conn);
                    ?>
                </select>
            </div>
            <!-- Textarea untuk memasukkan alamat baru siswa -->
            <div class="form-group">
                <label for="new_alamat">Alamat:</label>
                <textarea class="form-control" id="new_alamat" name="new_alamat" rows="3" required></textarea>
            </div>
            <!-- Tombol untuk melakukan update data siswa -->
            <button type="submit" class="btn btn-success">Perbarui Data</button>
        </form>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
