<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("location:../index.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rental Kendaraan</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
    <script type="text/javascript" src="../asset/js/jquery.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
</head>
<body style="background: #f0f0f0">
<nav class="navbar navbar-inverse" style="border-radius: 0px">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" 
                    data-toggle="collapse" data-target="#navbar-collapse" 
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Rental Kendaraan</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                <li><a href="kendaraan.php"><i class="glyphicon glyphicon-road"></i> Kendaraan</a></li>
                <li><a href="kendaraan_pinjam.php"><i class="glyphicon glyphicon-random"></i> Pinjam</a></li>
                <li><a href="profile_edit.php"><i class="glyphicon glyphicon-user"></i> Edit Profil</a></li>
                <li><a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p class="navbar-text">
                        Halo, <b><?= htmlspecialchars($_SESSION['username']); ?></b>
                    </p>
                </li>
            </ul>
        </div>
    </div>
</nav>