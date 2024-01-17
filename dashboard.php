<?php
session_start();
require_once 'db/db_config.php';

// Function untuk menampilkan semua siswa dari tabel "students"
function displayStudents($conn) {
    $sql = "SELECT * FROM students";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-hover">';
        echo '<thead class="thead-success">';
        echo '<tr>';
        echo '<th>No</th>'; // Kolom nomor urut
        echo '<th>Nama</th>'; // Kolom nama siswa
        echo '<th>Kelas</th>'; // Kolom kelas siswa
        echo '<th>Alamat</th>'; // Kolom alamat siswa
        echo '<th>Actions</th>'; // Kolom tindakan (aksi)
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $row_num = 1; // Nomor urut awal
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row_num . '</td>'; // Tampilkan nomor urut
            echo '<td>' . $row['name'] . '</td>'; // Tampilkan nama siswa
            echo '<td>' . getClassName($conn, $row['class_id']) . '</td>'; // Tampilkan kelas siswa berdasarkan class_id
            echo '<td>' . $row['address'] . '</td>'; // Tampilkan alamat siswa
            echo '<td>';
            echo '<a href="crud_student/edit_student.php?id=' . $row['id'] . '" class="btn btn-sm btn-success">Edit</a>'; // Tombol edit siswa
            echo ' <a href="crud_student/delete_student.php?id=' . $row['id'] . '" class="btn btn-sm btn-warning" onclick="return confirm(\'Apakah kamu yakin ingin menghapus siswa ini?\')">Hapus</a>'; // Tombol hapus siswa
            echo '</td>';
            echo '</tr>';
        
            $row_num++; // Tambah nomor urut setiap perulangan
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'Data tidak ditemukan.';
    }
}

// Function untuk menampilkan semua kelas dari tabel "classes"
function displayClasses($conn) {
    $sql = "SELECT * FROM classes";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-hover">';
        echo '<thead class="thead-Success">';
        echo '<tr>';
        echo '<th>No</th>'; // Kolom nomor urut
        echo '<th>Kelas</th>'; // Kolom nama kelas
        echo '<th>Actions</th>'; // Kolom tindakan (aksi)
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $row_num = 1; // Nomor urut awal
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row_num . '</td>'; // Tampilkan nomor urut
            echo '<td>' . $row['name'] . '</td>'; // Tampilkan nama kelas
            echo '<td>'; // Buka kolom "Actions"
            echo '<a href="crud_class/edit_class.php?id=' . $row['id'] . '" class="btn btn-sm btn-success">Edit</a>'; // Tombol edit kelas
            echo ' <a href="crud_class/delete_class.php?id=' . $row['id'] . '" class="btn btn-sm btn-warning" onclick="return confirm(\'Apakah kamu yakin mau menghapus kelas ini?\')">Hapus</a>'; // Tombol hapus kelas
            echo '</td>'; // Tutup kolom "Actions"
            echo '</tr>';

            $row_num++; // Tambah nomor urut setiap perulangan
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'Data tidak ditemukan.';
    }
}

// Function untuk mendapatkan nama kelas berdasarkan class_id dari tabel "classes"
function getClassName($conn, $class_id) {
    $sql = "SELECT name FROM classes WHERE id = $class_id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
    return 'N/A';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container mt-4{
            margin-top:50px;
        }
        
        .navbar {
            background-color: #2a9d8f;
        }

        .navbar-brand {
            color:white;
        }

        .nav-link {
            color: white;
        }

        table.table thead th {
            background-color: #2a9d8f; 
            color: white;
        }
    
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md sticky-top">
        <div class="container">
            <strong class="navbar-brand">Web Siswa</strong>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><b>Home</b></a>
                    </li>
                </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Dashboard Admin</h3>

        <!-- Menampilkan semua siswa -->
        <div class="table-container">
            <?php displayStudents($conn); ?>
        </div>

        <!-- Form Tambah Siswa Baru -->
        <h4>Tambah Siswa Baru:</h4>
        <form method="post" action="crud_student/add_student.php">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <select class="form-control" id="kelas" name="kelas" required>
                    <option value="">Pilih Kelas</option>
                    <?php
                    $sql = "SELECT * FROM classes";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Tambah Siswa</button>
        </form>
    </div>

    <br>
    <br>

    <div class="container mt-4">
        <!-- Menampilkan semua kelas -->
        <div class="table-container">
            <?php displayClasses($conn); ?>
        </div>

        <!-- Form Tambah Kelas Baru -->
        <h4>Tambah Kelas Baru:</h4>
        <form method="post" action="crud_class/add_class.php">
            <div class="form-group">
                <label for="nama">Kelas:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah Kelas</button>
        </form>
    </div><br>
    <footer>
        Created by Ghaida Sandie H.S. &copy; <?php echo date('Y'); ?>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
