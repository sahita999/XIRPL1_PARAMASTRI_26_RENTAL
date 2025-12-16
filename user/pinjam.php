<?php
session_start();
include 'header.php';
include '../koneksi.php';

$user_login = $_SESSION['username'];
$user_query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user_login'");
$user = mysqli_fetch_assoc($user_query);

$user_id = $user['user_id'];   
$user_nama = $user['user_nama'];  

$kendaraan_nomor = $_GET['kendaraan_nomor'];
$kendaraan = mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE kendaraan_nomor='$kendaraan_nomor'");
$d = mysqli_fetch_assoc($kendaraan);

?>

<div class="container">
    <h4>Form Peminjaman</h4>
    <form method="post" action="pinjam_aksi.php">
        <input type="hidden" name="user_id" value="<?= $user_id; ?>"> 
        <input type="hidden" name="kendaraan_nomor" value="<?= $d['kendaraan_nomor']; ?>">

        <div class="form-group">
            <label>Nama User</label>
            <input type="text" class="form-control" value="<?= $user_nama; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Kendaraan</label>
            <input type="text" class="form-control" value="<?= $d['kendaraan_nama']; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="date" class="form-control" name="tgl_pinjam" required>
        </div>

        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" class="form-control" name="tgl_kembali" required>
        </div>

        <div class="form-group">
            <label>Harga/Hari</label>
            <input type="text" class="form-control" value="<?= number_format($d['kendaraan_harga_perhari']); ?>" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Pinjam</button>
    </form>
</div>