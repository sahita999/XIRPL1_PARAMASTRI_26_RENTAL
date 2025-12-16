<?php
session_start();
include '../koneksi.php';

$id = $_GET['id'];

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
    header("location:user.php?pesan=tidak_bisa_hapus_diri");
    exit;
}

mysqli_query($koneksi, "DELETE FROM user WHERE user_id='$id'");

header("location:user.php");
?>