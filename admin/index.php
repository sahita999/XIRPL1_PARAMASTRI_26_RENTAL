<?php
include 'header.php';
include '../koneksi.php';

?>


<div class="container">
    <div class="alert alert-info text-center">
        <h4 style="margin-bottom:0px;">
            <b>Selamat Datang!</b> Sistem Informasi Rental Kendaraan
        </h4>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h4>Dashboard Admin</h4>
        </div>

        <div class="panel-body">
            <div class="row">

                <!-- Jumlah Kendaraan -->
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-road"></i>
                                <span class="pull-right">
                                    <?php
                                    $kendaraan = mysqli_query($koneksi,"SELECT * FROM kendaraan");
                                    echo mysqli_num_rows($kendaraan);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Kendaraan
                        </div>
                    </div>
                </div>

                <!-- Kendaraan Dipinjam -->
                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-retweet"></i>
                                <span class="pull-right">
                                    <?php
                                    $dipinjam = mysqli_query($koneksi,
                                        "SELECT * FROM pinjam WHERE pinjam_status=2"
                                    );
                                    echo mysqli_num_rows($dipinjam);
                                    ?>
                                </span>
                            </h1>
                            Kendaraan Dipinjam
                        </div>
                    </div>
                </div>

                <!-- Kendaraan Ready / Kembali -->
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-ok"></i>
                                <span class="pull-right">
                                    <?php
                                    $ready = mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE kendaraan_status=0");
                                    echo mysqli_num_rows($ready);

                                    ?>
                                </span>
                            </h1>
                            Kendaraan Ready
                        </div>
                    </div>
                </div>

                <!-- User yang Meminjam -->
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-user"></i>
                                <span class="pull-right">
                                    <?php
                                    $user_pinjam = mysqli_query($koneksi, "SELECT DISTINCT user_id FROM pinjam WHERE pinjam_status=2");
                                    echo mysqli_num_rows($user_pinjam);
                                    ?>
                                </span>
                            </h1>
                            User Meminjam
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Riwayat Peminjaman -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Riwayat Peminjaman Terakhir</h4>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Kendaraan</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>

                <?php
                $no = 1;
               $data = mysqli_query($koneksi,
                    "SELECT pinjam.*, user.user_nama, kendaraan.kendaraan_nama
                    FROM pinjam
                    JOIN user ON pinjam.user_id = user.user_id
                    JOIN kendaraan ON pinjam.kendaraan_nomor = kendaraan.kendaraan_nomor
                    ORDER BY pinjam_id DESC
                    LIMIT 10"
                );

                while($d = mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['user_nama']; ?></td>
                    <td><?= $d['kendaraan_nama']; ?></td>
                    <td><?= $d['tgl_pinjam']; ?></td>
                    <td><?= $d['tgl_kembali']; ?></td>
                    <td>
                        <?php
                        if($d['pinjam_status']==1){
                            echo "<span class='label label-success'>KEMBALI</span>";
                        }else{
                            echo "<span class='label label-warning'>DIPINJAM</span>";
                        }
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</div>