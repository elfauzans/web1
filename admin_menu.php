<?php
session_start();

require_once 'config/connect.php';

if (!empty($_SESSION['admin'])) {
    $username = $_SESSION['admin'];

    $cek = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username'");
    $data = mysqli_fetch_array($cek);
    $nama_petugas = $data['nama_petugas'];
    $no_hp = $data['no_hp'];
    $level = $data['level'];
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
    <title>Administrator</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-primary text-dark sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_menu.php?hal=utama">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Komentar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-lg-8 my-3 mx-auto">
                <?php
                require 'config/connect.php';
                $hal = @$_GET['hal'];
                if ($hal == 'utama') {
                    require 'admin_beranda.php';
                } else if ($hal == 'edit_pengaduan') {
                    require 'admin_edit_pengaduan.php';
                } else if ($hal == 'komentar') {
                    require 'admin_komentar.php';
                }
                ?>

                <!-- Main content goes here -->

            </main>
        </div>
    </div>

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .sidebar-sticky {
            position: sticky;
            top: 48px;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollbar styling */
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, .5) rgba(0, 0, 0, .1);
        }

        .sidebar-sticky::-webkit-scrollbar {
            width: 12px;
        }

        .sidebar-sticky::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, .5);
        }

        .sidebar-sticky::-webkit-scrollbar-track {
            background-color: rgba(0, 0, 0, .1);
        }

        .nav-link {
            color: white;
            font-weight: bold;
            margin-bottom: 20px;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: -100%;
                z-index: 1031;
                display: block;
                width: 100%;
                height: calc(100% - 60px);
                margin-top: 60px;
                overflow-y: auto;
                transition: all .25s ease-in-out;
                background-color: #f5f5f5;
            }

            .sidebar.open {
                left: 0;
                transition: all .25s ease-in-out;
            }
        }
    </style>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>