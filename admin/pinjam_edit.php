<?php
include 'header.php';
include '../koneksi.php';

if (!isset($_GET['id'])) {
    echo "ERROR: Parameter 'id' tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT p.*, k.kendaraan_nama 
                                FROM pinjam p
                                LEFT JOIN kendaraan k ON p.kendaraan_nomor = k.kendaraan_nomor
                                WHERE p.pinjam_id='$id'");
$d = mysqli_fetch_assoc($data);

if (!$d) {
    echo "Data peminjaman tidak ditemukan.";
    exit;
}
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit Peminjaman</h4>
        </div>

        <div class="panel-body">
            <form action="pinjam_update.php" method="POST">

                <input type="hidden" name="pinjam_id" value="<?= $d['pinjam_id']; ?>">

                <div class="form-group">
                    <label>Kendaraan</label>
                    <input type="text" class="form-control" value="<?= $d['kendaraan_nama']; ?> (<?= $d['kendaraan_nomor']; ?>)" readonly>
                    <input type="hidden" name="kendaraan_nomor" value="<?= $d['kendaraan_nomor']; ?>">
                </div>

                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" name="user_id" class="form-control" value="<?= $d['user_id']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" class="form-control" value="<?= $d['tgl_pinjam']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali" class="form-control" value="<?= $d['tgl_kembali']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Status Peminjaman</label>
                    <select name="pinjam_status" class="form-control">
                        <option value="1" <?= ($d['pinjam_status']==1)?'selected':''; ?>>Ready</option>
                        <option value="2" <?= ($d['pinjam_status']==2)?'selected':''; ?>>Dipinjam</option>
                    </select>
                </div>

                <input type="submit" value="Update" class="btn btn-primary">
                <a href="pinjam.php" class="btn btn-default">Batal</a>

            </form>
        </div>
    </div>
</div>