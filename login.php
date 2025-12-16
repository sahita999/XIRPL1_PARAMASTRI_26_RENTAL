<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$data = mysqli_query($koneksi,
    "SELECT * FROM user WHERE username='$username' AND password='$password'"
);
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $d = mysqli_fetch_assoc($data);

    $_SESSION['status'] = "login";
    $_SESSION['username'] = $d['username'];
    $_SESSION['user_status'] = $d['user_status'];
    $_SESSION['user_id'] = $d['user_id']; 
    
    if ($d['user_status'] == 1) {
        header("location:admin/index.php");
    } elseif ($d['user_status'] == 2) {
        header("location:user/index.php");
    } else {
        header("location:index.php?pesan=akses_ditolak");
    }
} else {
    header("location:index.php?pesan=gagal");
}