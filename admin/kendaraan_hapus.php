<?php
include '../koneksi.php';

if (!isset($_GET['nomor'])) {
    echo "ERROR: Parameter 'nomor' tidak ditemukan.";
    exit;
}

$nomor = $_GET['nomor'];
$query = "DELETE FROM kendaraan WHERE kendaraan_nomor = '$nomor'";

if (mysqli_query($koneksi, $query)) {  
    header("location:kendaraan.php");
    exit();
} else {
    echo "Gagal menghapus kendaraan: " . mysqli_error($koneksi);
}