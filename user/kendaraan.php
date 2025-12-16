<?php
session_start();
include 'header.php';
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['user_status'] != 2) {
    header("location:../index.php?pesan=belum_login");
    exit();
}

$data = mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE kendaraan_status=0");
?>

<div class="container">
    <h4 class="text-center">Kendaraan Tersedia</h4>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Harga/Hari</th>
            <th>Opsi</th>
        </tr>
        <?php $no=1; while($d = mysqli_fetch_array($data)){ ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['kendaraan_nomor']; ?></td>
            <td><?= $d['kendaraan_nama']; ?></td>
            <td><?= number_format($d['kendaraan_harga_perhari']); ?></td>
            <td>
                <a href="pinjam.php?kendaraan_nomor=<?= $d['kendaraan_nomor']; ?>" class="btn btn-success btn-sm">
                    Pinjam
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>