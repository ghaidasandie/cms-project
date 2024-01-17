<!-- Dokumen HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tag untuk responsivitas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Judul halaman -->
    <title>Web Siswa - Login</title>
    
    <!-- Menghubungkan file CSS Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Gaya khusus untuk tampilan halaman -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Membuat body mengisi tinggi viewport */
            background-image: url("bg/morocco.png");
        }

        .card {
            width: 100%; /* Menyesuaikan lebar card */
            max-width: 500px; /* Menetapkan lebar maksimum untuk card */
        }

        .btn-login {
            background-color: #2a9d8f;
            color: #fff;
        }

        .btn-register {
            background-color: #e76f51;
            color: #fff;
        }

        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Container untuk mengatur tata letak elemen -->
    <div class="container mt-4">
        <!-- Baris untuk menempatkan elemen dalam satu baris secara horizontal dan center (justify-content-center) -->
        <div class="row justify-content-center">
            <!-- Kolom medium (6/12) untuk menempatkan card -->
            <div class="col-md-6">
                <!-- Elemen card dari Bootstrap -->
                <div class="card bg-light">
                    <!-- Header card -->
                    <div class="card-header bg-primary text-white">
                        <!-- Judul halaman login -->
                        <h2 class="text-center">Login</h2>
                    </div>    
                    <!-- Bagian isi card -->
                    <div class="card-body">
                        <!-- Form login -->
                        <form action="login.php" method="post">
                            <!-- Input untuk username -->
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                            </div>
                            <!-- Input untuk password -->
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                            </div>
                            <!-- Tombol untuk melakukan login -->
                            <button type="submit" class="btn btn-login btn-block">Login</button>
                        </form>
                        <!-- Tombol untuk menuju halaman registrasi -->
                        <a href="register.php" class="btn btn-register btn-block mt-3">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menghubungkan file JavaScript Bootstrap (opsional) -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
