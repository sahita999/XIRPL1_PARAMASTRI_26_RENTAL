<!DOCTYPE html>
<html>
    <head>
        <title>Sistem Informasi Laundry</title>
        <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
        <script type="text/javascript" src="../asset/js/jquery.js"></script>
        <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
    </head>
    <body style="background: #f0f0f0">
        <?php
       session_start();
        if (!isset($_SESSION['username']) || $_SESSION['user_status'] != 1) {
        header("Location: ../login.php?pesan=belum_login");
        exit();
}
        ?>

        <nav class="navbar navbar-inverse" style="border-radius: 0px">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"></button>
                    <a class="navbar-brand" href="index.php">Laundry</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav">
                        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                        <li><a href="kendaraan.php"><i class="glyphicon glyphicon-road"></i> Kendaraan</a></li>
                        <li><a href="pinjam.php"><i class="glyphicon glyphicon-random"></i> Pinjam</a></li>
                        <li><a href="user.php"><i class="glyphicon glyphicon-user"></i> User</a></li>
                        <li><a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><p class="navbar-text">Halo, <b><?php echo $_SESSION['username']; ?></b></p></li>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>                                                                                   