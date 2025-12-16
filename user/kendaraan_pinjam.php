<?php
session_start();
include 'header.php';
include '../koneksi.php';

// Pastikan user login
if (!isset($_SESSION['username']) || $_SESSION['user_status'] != 2) {
    header("location:../index.php?pesan=belum_login");
    exit();
}

// Ambil info user
$user_login = $_SESSION['username'];
$user_query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user_login'");
$user = mysqli_fetch_assoc($user_query);
$user_id = $user['user_id'];
?>

<div class="container">
    <h4>Kendaraan yang Kamu Pinjam</h4>
    <table class="table table-bordered table-striped">
        <tr>
            <th>No</th>
            <th>Kendaraan</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Total Harga</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "
            SELECT pinjam.*, kendaraan.kendaraan_nama, kendaraan.kendaraan_harga_perhari, pinjam.pinjam_status
            FROM pinjam
            JOIN kendaraan ON pinjam.kendaraan_nomor = kendaraan.kendaraan_nomor
            WHERE pinjam.user_id='$user_id'
            ORDER BY pinjam_id DESC
        ");

        if (!$data) {
            echo "<tr><td colspan='7'>Query gagal: " . mysqli_error($koneksi) . "</td></tr>";
        } else {
            while ($d = mysqli_fetch_assoc($data)) {
                // Status kendaraan
                $status_text = intval($d['pinjam_status']) == 2 ? 'Dipinjam' : 'Kembali';

                // Hitung total harga jika null atau 0
                if (!isset($d['total_harga']) || $d['total_harga'] == 0) {
                    $start = new DateTime($d['tgl_pinjam']);
                    $end = new DateTime($d['tgl_kembali']);
                    $interval = $start->diff($end);
                    $jumlah_hari = $interval->days + 1;
                    $total_harga = $d['kendaraan_harga_perhari'] * $jumlah_hari;
                } else {
                    $total_harga = $d['total_harga'];
                }
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['kendaraan_nama']; ?></td>
            <td><?= $d['tgl_pinjam']; ?></td>
            <td><?= $d['tgl_kembali']; ?></td>
            <td><?= $status_text; ?></td>
            <td><?= number_format($total_harga); ?></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
</div>