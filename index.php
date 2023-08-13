<?php
session_start();


if (!empty($_SESSION['admin'])) {
    echo '<script>document.location = "admin_menu.php?hal=utama";</script>';
}

if (!empty($_SESSION['username'])) {
    echo '<script>document.location = "menu.php?hal=utama";</script>';
}

require_once 'config/connect.php';

if (isset($_POST['masuk'])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars(md5($_POST["password"]));
    $level = $_POST["level"];

    if ($level == "admin") {
        $cek = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");
        if (mysqli_num_rows($cek) > 0) {
            $_SESSION['admin'] = $username;
            echo '<script>alert("Anda Berhasil Login");
            document.location = "admin_menu.php";</script>';
        } else {
            echo '<script>alert("Anda Gagal Login");</script>';
        }
    } else {
        $cek = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username' AND password = '$password'");
        if (mysqli_num_rows($cek) > 0) {
            $_SESSION['username'] = $username;
            echo '<script>alert("Anda Berhasil Login");
            document.location = "menu.php?hal=utama";</script>';
        } else {
            echo '<script>alert("Anda Gagal Login");</script>';
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
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="" method="post">
        <h2>Login Page</h2>
        <label for="">Username</label>
        <input type="text" name="username" id="username" placeholder="Masukan Username Anda" required>
        <label for="">Password</label>
        <input type="password" name="password" id="password" placeholder="Masukan Password Anda" required>
        <label for="">Level</label>
        <select name="level" id="level" required>
            <option value="">-- Pilih Level --</option>
            <option value="admin">Administrator</option>
            <option value="masyarakat">Masyarakat</option>
            <input type="submit" name="masuk" value="Login Sekarang">
        </select>
        <span>Belum Punya Akun daftar <a href="registrasi.php">Disini</a></span>
    </form>
</body>

</html>