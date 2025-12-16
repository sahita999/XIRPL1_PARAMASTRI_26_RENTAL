<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nomor   = $_POST['kendaraan_nomor'];
    $nama    = $_POST['kendaraan_nama'];
    $tipe    = $_POST['kendaraan_tipe'];
    $harga   = $_POST['kendaraan_harga_perhari'];

    $query = "INSERT INTO kendaraan (kendaraan_nomor, kendaraan_nama, kendaraan_tipe, kendaraan_harga_perhari)
              VALUES ('$nomor', '$nama', '$tipe', '$harga')";

    if (mysqli_query($koneksi, $query)) {
        header("location:kendaraan.php");
        exit();
    } else {
        echo "Gagal menambahkan kendaraan: " . mysqli_error($koneksi);
    }

} else {
    echo "Aksi tidak valid.";
}