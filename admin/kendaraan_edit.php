<?php
include 'header.php';
include '../koneksi.php';

// Pastikan parameter nomor ada
if (!isset($_GET['nomor'])) {
    echo "ERROR: Parameter 'nomor' tidak ditemukan.";
    exit;
}

$nomor = $_GET['nomor'];

// Ambil data kendaraan dari database
$data = mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE kendaraan_nomor='$nomor'");
$d = mysqli_fetch_assoc($data);

if (!$d) {
    echo "Data kendaraan tidak ditemukan.";
    exit;
}
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit Kendaraan</h4>
        </div>

        <div class="panel-body">
            <form action="kendaraan_update.php" method="POST">

                <!-- Nomor Kendaraan readonly -->
                <div class="form-group">
                    <label>Nomor Kendaraan</label>
                    <input type="text" name="kendaraan_nomor" 
                           value="<?= $d['kendaraan_nomor']; ?>" 
                           class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input type="text" name="kendaraan_nama" 
                           value="<?= $d['kendaraan_nama']; ?>" 
                           class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tipe Kendaraan</label>
                    <input type="text" name="kendaraan_tipe" 
                           value="<?= $d['kendaraan_tipe']; ?>" 
                           class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Harga Per Hari (Rp)</label>
                    <input type="number" name="kendaraan_harga_perhari" 
                           value="<?= $d['kendaraan_harga_perhari']; ?>" 
                           class="form-control" required>
                </div>

                <input type="submit" value="Update" class="btn btn-primary">
                <a href="kendaraan.php" class="btn btn-default">Batal</a>

            </form>
        </div>
    </div>
</div>