<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Home</title>
    <style>
        body {
            background-color: #f6e7b9;
        }

        .container {
            margin-bottom: 13%;
        }
        .small-caps {
            font-size: 50px;
            font-variant: small-caps;
            font-style: italic;
        }

        .btn {
            color: white;
            background-color: #2a9d8f;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Kelas "small-caps" memuat teks "Selamat Datang Di Page Home" dalam gaya huruf kecil kapital (small-caps) -->
        <h2 class="text-center"><span class="small-caps">Selamat Datang Di Page Home </span></h3>
        
    </div>

    <div class="container">
        <div class="card-deck">
            <!-- Dashboard Admin -->
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Menuju Dashboard Admin</h5>
                    <p class="card-text">Dashboard untuk menambah, mengubah, dan menghapus data dalam tabel.</p>
                    <a href="halaman_login.php" class="btn"><b>Klik Disini</b></a>
                </div>
            </div>

            <!-- Dashboard User -->
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Menuju Dashboard User</h5>
                    <p class="card-text">Dashboard untuk membaca data dalam tabel.</p>
                    <a href="read.php" class="btn"><b>Klik Disini</b></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
