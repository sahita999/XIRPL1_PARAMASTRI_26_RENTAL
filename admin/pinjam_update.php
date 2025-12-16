<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pinjam_id       = $_POST['pinjam_id'];
    $kendaraan_nomor = $_POST['kendaraan_nomor'];
    $user_id         = $_POST['user_id'];
    $tgl_pinjam      = $_POST['tgl_pinjam'];
    $tgl_kembali     = $_POST['tgl_kembali'];
    $pinjam_status   = $_POST['pinjam_status'];

    $query = "UPDATE pinjam SET
                user_id = '$user_id',
                tgl_pinjam = '$tgl_pinjam',
                tgl_kembali = '$tgl_kembali',
                pinjam_status = '$pinjam_status'
              WHERE pinjam_id = '$pinjam_id'";

    if (mysqli_query($koneksi, $query)) {
        if ($pinjam_status == 1) {
            mysqli_query($koneksi, "UPDATE kendaraan SET kendaraan_status=0 WHERE kendaraan_nomor='$kendaraan_nomor'");
        } elseif ($pinjam_status == 2) {
            mysqli_query($koneksi, "UPDATE kendaraan SET kendaraan_status=2 WHERE kendaraan_nomor='$kendaraan_nomor'");
        }

        header("location:pinjam.php");
        exit();

    } else {
        echo "Gagal mengupdate peminjaman: " . mysqli_error($koneksi);
    }

} else {
    echo "Aksi tidak valid.";
}