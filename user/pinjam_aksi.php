<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../koneksi.php';

// Cek login
if (!isset($_SESSION['username']) || $_SESSION['user_status'] != 2) {
    header("location:../index.php?pesan=belum_login");
    exit();
}

// Ambil data dari form
$user_id = $_POST['user_id'];
$kendaraan_nomor = $_POST['kendaraan_nomor'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];

// Ambil data kendaraan
$k_query = mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE kendaraan_nomor='$kendaraan_nomor'");
if (!$k_query) die("Query kendaraan gagal: " . mysqli_error($koneksi));
$k = mysqli_fetch_assoc($k_query);
if (!$k) die("Kendaraan tidak ditemukan!");

// Hitung total harga di PHP (tidak disimpan di DB)
$harga_per_hari = $k['kendaraan_harga_perhari'];
if (!is_numeric($harga_per_hari)) die("Harga kendaraan tidak valid!");

$start = new DateTime($tgl_pinjam);
$end = new DateTime($tgl_kembali);
if ($end < $start) die("Tanggal kembali harus lebih besar dari tanggal pinjam.");

$jumlah_hari = $start->diff($end)->days + 1;
$total_harga = $harga_per_hari * $jumlah_hari;

// Simpan total_harga sementara di session
$_SESSION['total_harga'] = $total_harga;
$_SESSION['tgl_pinjam'] = $tgl_pinjam;
$_SESSION['tgl_kembali'] = $tgl_kembali;

// Status pinjam
$pinjam_status = 2;

// Insert data pinjam (tanpa total_harga)
$insert_query = "
INSERT INTO pinjam (user_id, kendaraan_nomor, tgl_pinjam, tgl_kembali, pinjam_status)
VALUES ('$user_id','$kendaraan_nomor','$tgl_pinjam','$tgl_kembali','$pinjam_status')
";
$query = mysqli_query($koneksi, $insert_query);
if (!$query) die("Insert pinjam gagal: " . mysqli_error($koneksi));

// Update status kendaraan
$update = mysqli_query($koneksi, "UPDATE kendaraan SET kendaraan_status=2 WHERE kendaraan_nomor='$kendaraan_nomor'");
if (!$update) die("Update kendaraan gagal: " . mysqli_error($koneksi));

// Redirect ke halaman konfirmasi atau dashboard
echo "<script>
        alert('Kendaraan berhasil dipinjam! Total harga: Rp " . number_format($total_harga) . "');
        window.location='kendaraan_pinjam.php';
      </script>";
?>