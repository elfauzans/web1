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
    echo "<script>document.location='index.php';</script>";
}

$id = $_GET['id'];

$cekPengaduan = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan='$id' AND nik='$nik'");
if (mysqli_num_rows($cekPengaduan) > 0) {
    $ab = mysqli_fetch_array($cekPengaduan);
    $tgl_pengaduan = $ab['tgl_pengaduan'];
    $isi_laporan = $ab['isi_laporan'];
    $foto = $ab['foto'];
} else {
    echo "<script>
   alert('Data Tidak Ditemukan');
   document.location='menu.php?hal=utama';
   </script>";
}

if (isset($_POST['update'])) {
    $tgl_pengaduan = $_POST["tgl_pengaduan"];
    $isi_laporan = htmlspecialchars($_POST["isi_laporan"]);
    $namaFiles = $_FILES['foto']['name'];
    $namaSementara = $_FILES['foto']['tmp_name'];

    $folder = "images/";

    $uploadFile = move_uploaded_file($namaSementara, $folder . $namaFiles);
    if ($uploadFile) {
        mysqli_query($conn, "UPDATE pengaduan SET tgl_pengaduan='$tgl_pengaduan',isi_laporan='$isi_laporan', foto='$namaFiles' WHERE id_Pengaduan='$id'");
        echo "<script>
         alert('Data Berhasil Diupdate');
         document.location='menu.php?hal=utama';
         </script>";
    }
}

if (isset($_POST['hapus'])) {
    mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan='$id'");
    echo "<script>
   alert('Data Berhasil Dihapus');
   document.location='menu.php?hal=utama';
   </script>";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" style="color: black;" aria-current="page" href="menu.php?hal=utama">Kembali</a>
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

                <div class="text-center mt-5">
                    <h3>Detail PEMESANAN</h3>
                </div>

                <div class="mt-3">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Tanggal Pemesanan</label>
                            <input type="date" name="tgl_pengaduan" value="<?= $tgl_pengaduan; ?>" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Nama Bioskop</label>
                            <textarea class="form-control" name="isi_laporan"><?= $isi_laporan; ?></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Foto</label><br>
                            <img src="images/<?= $foto; ?>" width="100" height="100" class="mb-2">
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" name="update" class="btn btn-warning">Ubah Pemesanan</button>
                            <button type="submit" name="hapus"  class="btn btn-danger">Hapus Pemesanan</button>
                        </div>
                    </form>
                </div>

                <!-- Main content goes here -->

            </main>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>