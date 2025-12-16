<?php
session_start();
include '../koneksi.php';

if ($_GET['aksi'] == "update") {

    $id          = $_POST['id'];
    $username    = $_POST['username'];
    $password    = $_POST['password'];
    $user_nama   = $_POST['user_nama'];
    $user_alamat = $_POST['user_alamat'];
    $user_status = $_POST['user_status'];

    if ($password == "") {
        mysqli_query($koneksi, "
            UPDATE user SET
                username='$username',
                user_nama='$user_nama',
                user_alamat='$user_alamat',
                user_status='$user_status'
            WHERE user_id='$id'
        ");
    } else {
        mysqli_query($koneksi, "
            UPDATE user SET
                username='$username',
                password='$password',
                user_nama='$user_nama',
                user_alamat='$user_alamat',
                user_status='$user_status'
            WHERE user_id='$id'
        ");
    }

    header("location:user.php");
}
?>