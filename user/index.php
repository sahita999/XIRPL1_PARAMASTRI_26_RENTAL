<?php
session_start();
include 'header.php';
include '../koneksi.php';

// Cek login
if (!isset($_SESSION['username']) || $_SESSION['user_status'] != 2) {
    header("location:../index.php?pesan=belum_login");
    exit();
}

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Total peminjaman 1 bulan terakhir
$riwayat_bulan = mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total FROM pinjam 
     WHERE user_id=$user_id 
       AND tgl_pinjam >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)"
);

// Ambil hasil query
$row3 = mysqli_fetch_assoc($riwayat_bulan);

?>

<div class="container">
    <div class="alert alert-info text-center">
        <h4 style="margin-bottom:0px;">
            <b>Selamat Datang!</b> Sistem Informasi Rental Kendaraan
        </h4>
    </div>

    <!-- Dashboard Panel -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Dashboard</h4>
        </div>
        <div class="panel-body">
            <div class="row">

                <!-- Kendaraan Tersedia -->
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-road"></i>
                                <span class="pull-right">
                                    <?php
                                    $kendaraan_tersedia = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kendaraan WHERE kendaraan_status=0");
                                    $row = mysqli_fetch_assoc($kendaraan_tersedia);
                                    echo $row['total'];
                                    ?>
                                </span>
                            </h1>
                            Kendaraan Tersedia
                        </div>
                    </div>
                </div>

                <!-- Kendaraan Dipinjam User -->
                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-retweet"></i>
                                <span class="pull-right">
                                    <?php
                                    $pinjam_user = mysqli_query($koneksi, 
                                        "SELECT COUNT(*) AS total FROM pinjam 
                                         WHERE user_id=$user_id AND pinjam_status=2"
                                    );
                                    $row2 = mysqli_fetch_assoc($pinjam_user);
                                    echo $row2['total'];
                                    ?>
                                </span>
                            </h1>
                            Kendaraan Dipinjam
                        </div>
                    </div>
                </div>


                <!-- Total Riwayat 1 Bulan -->
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-calendar"></i>
                                <span class="pull-right"><?= $row3['total']; ?></span>
                            </h1>
                            Peminjaman 1 Bulan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Peminjaman User -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Riwayat Peminjaman Terakhir</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>ID Pinjam</th>
                    <th>Kendaraan</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>

                <?php
                $no = 1;
                $data = mysqli_query($koneksi,
                    "SELECT pinjam.*, kendaraan.kendaraan_nama, kendaraan.kendaraan_nomor
                     FROM pinjam
                     JOIN kendaraan ON pinjam.kendaraan_nomor = kendaraan.kendaraan_nomor
                     WHERE pinjam.user_id=$user_id
                     ORDER BY pinjam_id DESC LIMIT 10"
                );

                while($d = mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['pinjam_id']; ?></td>
                    <td><?= $d['kendaraan_nama']; ?> (<?= $d['kendaraan_nomor']; ?>)</td>
                    <td><?= $d['tgl_pinjam']; ?></td>
                    <td><?= $d['tgl_kembali']; ?></td>
                    <td>
                        <?php
                        if($d['pinjam_status'] == 1){
                            echo "<span class='label label-warning'>Dikembalikan</span>";
                        } elseif($d['pinjam_status'] == 2){
                            echo "<span class='label label-success'>Dipinjam</span>";
                        } else {
                            echo "<span class='label label-default'>-</span>";
                        }
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>