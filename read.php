<?php
// Memasukkan file konfigurasi database (db_config.php) yang berisi informasi koneksi ke database.
require_once 'db/db_config.php';

// Function untuk menampilkan data seluruh siswa dari tabel "students".
function displayStudents($conn) {
    // Menyiapkan pernyataan SQL untuk mengambil data siswa.
    $sql = "SELECT * FROM students";
    $result = mysqli_query($conn, $sql);

    // Jika ada data siswa yang ditemukan.
    if (mysqli_num_rows($result) > 0) {
        // Membuat tabel untuk menampilkan data siswa.
        echo '<table class="table table-hover">';
        echo '<thead class="green">';
        echo '<tr>';
        echo '<th>No</th>';
        echo '<th>Nama</th>';
        echo '<th>Kelas</th>';
        echo '<th>Alamat</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $row_num = 1;
        // Melakukan loop untuk mengambil data siswa satu per satu.
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' .  $row_num . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . getClassName($conn, $row['class_id']) . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '</tr>';

            $row_num++;  // Increment nomor urut setiap perulangan
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        // Jika tidak ada data siswa yang ditemukan, tampilkan pesan "No data found."
        echo 'No data found.';
    }
}

// Function untuk mendapatkan nama kelas berdasarkan class_id dari tabel "classes".
function getClassName($conn, $class_id) {
    $sql = "SELECT name FROM classes WHERE id = $class_id";
    $result = mysqli_query($conn, $sql);
    // Jika hasil query berhasil dan ada data yang ditemukan.
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
    // Jika tidak ada data yang ditemukan, kembalikan nilai 'N/A'.
    return 'N/A';
}

// Function untuk menampilkan data seluruh kelas dari tabel "classes".
function displayClasses($conn) {
    // Menyiapkan pernyataan SQL untuk mengambil data kelas.
    $sql = "SELECT * FROM classes";
    $result = mysqli_query($conn, $sql);

    // Jika ada data kelas yang ditemukan.
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-hover">';
        echo '<thead class="green">';
        echo '<tr>';
        echo '<th>No</th>';
        echo '<th>Kelas</th>';
        echo '</tr>';
    
        echo '<tbody>';
        $row_num = 1; // Nomor urut awal
        // Melakukan loop untuk mengambil data kelas satu per satu.
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row_num . '</td>'; // Tampilkan nomor urut
            echo '<td>' . $row['name'] . '</td>';
            echo '</tr>';

            $row_num++; // Increment nomor urut setiap perulangan
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        // Jika tidak ada data kelas yang ditemukan, tampilkan pesan "No data found."
        echo 'No data found.';
    }
}
?>

<!-- Berikutnya, kode HTML dan tampilan website -->
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 

    <!-- Style tambahan untuk tampilan tabel -->
    <style>
        body {
            display:inline;
            justify-content: center;
            align-items: center;
            background-color: #faf3dd;
        }

        /* Style tambahan untuk tabel */
        table.table {
            background-color: #f6e7b9;
            color: black;
        }

        /* Style tambahan untuk header tabel */
        table.table thead th {
            background-color: #2a9d8f; 
            color: white;
        }

        .btn {
            color:white;
            background-color: #2a9d8f;
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


    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md ">
        <div class="container">
            <strong class="navbar-brand">SELAMAT DATANG DI WEB SISWA</strong>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><b>Home</b></a>
                    </li>
                </ul>      
        </div>
    </nav>

        <!-- Menampilkan tabel data siswa -->
        <div class="container mt-5">
            <h3 class="text-center mb-4">- Data Siswa -</h3>
            <div class="table-responsive">
                <?php displayStudents($conn); ?>
            </div>
        </div><br>

        <!-- Menampilkan tabel data kelas -->
        <div class="container mt-5">
            <h3 class="text-center mb-4">- Data Kelas -</h3>
            <div class="table-responsive">
                <?php displayClasses($conn); ?>
            </div>
        </div><br>

</body>
</html>
