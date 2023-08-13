<?php
session_start();
require_once "config/connect.php";

if (isset($_POST['daftar'])) {
    # code...
    $nik = htmlspecialchars($_POST["nik"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars(md5($_POST["password"]));
    $no_hp = htmlspecialchars($_POST["no_hp"]);

    $cek = mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    if (mysqli_num_rows($cek) > 0) {
        # code...
        echo "<script>alert('Nik sudah Terdaftar !');</script>";
    } else {
        # code...
        $cekUser = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username'");
        if (mysqli_num_rows($cekUser) > 0) {
            # code...
            echo "<script>alert('Username sudah Terdaftar!');</script>";
        } else {
            # code...
            $cekHp = mysqli_query($conn, "SELECT * FROM masyarakat WHERE no_hp = '$no_hp'");
            if (mysqli_num_rows($cekHp) > 0) {
                # code...
                echo "<script>alert('Nomor Ponsel sudah Terdaftar!');</script>";
            } else {
                # code...
                mysqli_query($conn, "INSERT INTO masyarakat VALUES('$nik','$nama','$username','$password','$no_hp')");
                echo "
                 <script>
                    alert('Pendaftatan berhasil, silahkan Login!');
                    document.location='index.php';
                 </script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="" method="post">
        <h2>Registrasi Pengguna</h2>
        <label for="">NIK</label>
        <input type="text" name="nik" id="nik" placeholder="Masukan NIK Anda" required>
        <label for="">Nama Lengkap</label>
        <input type="text" name="nama" id="nama_petugas" placeholder="Masukan Nama Anda" required>
        <label for="">Username</label>
        <input type="text" name="username" id="username" placeholder="Masukan Username Anda" required>
        <label for="">Password</label>
        <input type="text" name="password" id="password" placeholder="Masukan Password Anda" required>
        <label for="">Nomor Ponsel</label>
        <input type="text" name="no_hp" id="no_hp" placeholder="Masukan Nomor Ponsel Anda" required>
        <input type="submit" name="daftar" value="Daftar Sekarang">
        <span>Sudah Punya Akun, Login <a href="index.php">Disini</a></span>
    </form>
</body>

</html>