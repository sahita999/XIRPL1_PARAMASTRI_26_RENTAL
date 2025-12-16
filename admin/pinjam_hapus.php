<?php
include '../koneksi.php';

if (!isset($_GET['id'])) {
    die("ID peminjaman tidak ditemukan.");
}

$pinjam_id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT kendaraan_nomor FROM pinjam WHERE pinjam_id='$pinjam_id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Peminjaman tidak ditemukan.");
}
$kendaraan_nomor = $data['kendaraan_nomor'];
$hapus = mysqli_query($koneksi, "DELETE FROM pinjam WHERE pinjam_id='$pinjam_id'");
if ($hapus) {
    mysqli_query($koneksi, "UPDATE kendaraan SET kendaraan_status=0 WHERE kendaraan_nomor='$kendaraan_nomor'");
    header("location:pinjam.php");
    exit();
} else {
    echo "Gagal menghapus peminjaman: " . mysqli_error($koneksi);
}