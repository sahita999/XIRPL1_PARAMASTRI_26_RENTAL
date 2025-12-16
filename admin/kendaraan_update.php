<?php
include '../koneksi.php';

// Pastikan form dikirim via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nomor  = $_POST['kendaraan_nomor'];   // primary key, readonly
    $nama   = $_POST['kendaraan_nama'];
    $tipe   = $_POST['kendaraan_tipe'];
    $harga  = $_POST['kendaraan_harga_perhari'];
    $status = $_POST['kendaraan_status'];

    // Update data kendaraan
    $query = "UPDATE kendaraan SET
                kendaraan_nama = '$nama',
                kendaraan_tipe = '$tipe',
                kendaraan_harga_perhari = '$harga',
                kendaraan_status = '$status'
              WHERE kendaraan_nomor = '$nomor'";

    if (mysqli_query($koneksi, $query)) {
        // Redirect ke daftar kendaraan
        header("location:kendaraan.php");
        exit();
    } else {
        echo "Gagal mengupdate kendaraan: " . mysqli_error($koneksi);
    }

} else {
    echo "Aksi tidak valid.";
}