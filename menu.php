<?php
session_start();

require_once 'config/connect.php';

if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $cek = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username='$username'");
    $data = mysqli_fetch_array($cek);
    $nama = $data['nama'];
    $nik = $data['nik'];
    $no_hp = $data['no_hp'];
} else {
    # code...
    echo "<script>document.location='index.php';</script>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioskop Isa</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" style="color: black;" aria-current="page" href="menu.php?hal=utama">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: black;" href="menu.php?hal=pengaduan">Pemesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: black;" href="logout.php">Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: black;" href="#">Reports</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-lg-9 my-3">
                <?php
                require 'config/connect.php';
                $hal = @$_GET['hal'];
                if ($hal == 'utama') {
                    require 'beranda.php';
                } else if ($hal == 'pengaduan') {
                    require 'pengaduan.php';
                } else if ($hal == 'edit_pengaduan') {
                    require 'edit_pengaduan.php';
                }
                ?>

                <!-- Main content goes here -->

            </main>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>