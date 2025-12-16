<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $kendaraan_nomor = $_POST['kendaraan_nomor'];
    $user_id        = $_POST['user_id'];
    $tgl_pinjam     = $_POST['tgl_pinjam'];
    $tgl_kembali    = $_POST['tgl_kembali'];

    $kendaraan = mysqli_query($koneksi, "SELECT kendaraan_harga_perhari FROM kendaraan WHERE kendaraan_nomor='$kendaraan_nomor'");
    $k = mysqli_fetch_assoc($kendaraan);
    $harga_per_hari = $k['kendaraan_harga_perhari'];

    $start = new DateTime($tgl_pinjam);
    $end   = new DateTime($tgl_kembali);
    $interval = $start->diff($end);
    $jumlah_hari = $interval->days + 1;

    $total_harga = $harga_per_hari * $jumlah_hari;
    $pinjam_status = 2;

    $query = "INSERT INTO pinjam (kendaraan_nomor, user_id, tgl_pinjam, tgl_kembali, total_harga, pinjam_status)
              VALUES ('$kendaraan_nomor', '$user_id', '$tgl_pinjam', '$tgl_kembali', '$total_harga', '$pinjam_status')";

    if (mysqli_query($koneksi, $query)) {
        mysqli_query($koneksi, "UPDATE kendaraan SET kendaraan_status=2 WHERE kendaraan_nomor='$kendaraan_nomor'");
        header("location:pinjam.php");
        exit();
    } else {
        echo "Gagal menambahkan peminjaman: " . mysqli_error($koneksi);
    }
} else {
    echo "Aksi tidak valid.";
}
?>