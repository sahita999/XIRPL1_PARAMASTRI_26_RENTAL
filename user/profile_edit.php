<?php
session_start();
include 'header.php';
include '../koneksi.php';

// Pastikan user login
if (!isset($_SESSION['username'])) {
    header("location:../index.php?pesan=belum_login");
    exit();
}

// Ambil data user login
$user_login = $_SESSION['username'];
$user_query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user_login'");
$user = mysqli_fetch_assoc($user_query);
?>

<div class="container">
    <h4>Edit Profil</h4>
    <form method="post" action="profile_aksi.php">
        <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>" required>
        </div>

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="user_nama" class="form-control" value="<?= $user['user_nama']; ?>" required>
        </div>

        <div class="form-group">
            <label>Password (biarkan kosong jika tidak ingin diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="user_alamat" class="form-control" required><?= $user['user_alamat']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>