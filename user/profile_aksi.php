<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header("location:../index.php?pesan=belum_login");
    exit();
}

$user_id = $_POST['user_id'];
$username = $_POST['username'];
$user_nama = $_POST['user_nama'];
$password = $_POST['password'];
$user_alamat = $_POST['user_alamat'];

$pass_sql = $password ? ", password='" . md5($password) . "'" : "";

$update = mysqli_query($koneksi, "
    UPDATE user SET 
        username='$username',
        user_nama='$user_nama',
        user_alamat='$user_alamat'
        $pass_sql
    WHERE user_id='$user_id'
");

if ($update) {
    $_SESSION['username'] = $username;
    echo "<script>alert('Profil berhasil diperbarui'); window.location='index.php';</script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>