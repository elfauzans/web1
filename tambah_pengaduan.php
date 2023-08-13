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


if (isset($_POST['kirim'])) {
   $tgl_pengaduan = $_POST["tgl_pengaduan"];
   $isi_laporan = htmlspecialchars($_POST["isi_laporan"]);
   $namaFiles = $_FILES['foto']['name'];
   $namaSementara = $_FILES['foto']['tmp_name'];

   $folder = "images/";

   $uploadFile = move_uploaded_file($namaSementara, $folder . $namaFiles);
   if ($uploadFile) {
      mysqli_query($conn, "INSERT INTO pengaduan VALUES(NULL,'$tgl_pengaduan','$nik','$isi_laporan','$namaFiles','0')");
      echo "<script>
        alert('Berhasil Upload Foto');
        document.location='menu.php?hal=utama';
        </script>";
   } else {
      echo "<script>alert('Gagal Upload Foto');
        document.location='menu.php?hal=pengaduan';
        </script>";
   }
}

?>
