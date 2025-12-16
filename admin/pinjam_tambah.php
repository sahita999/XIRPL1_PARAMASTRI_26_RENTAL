<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Tambah Peminjaman</h4>
        </div>
        <div class="panel-body">
            <form action="pinjam_aksi.php" method="POST">

                <!-- Pilih Kendaraan (hanya tersedia) -->
                <div class="form-group">
                    <label>Kendaraan</label>
                    <select name="kendaraan_nomor" class="form-control" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        <?php
                        $kendaraan = mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE kendaraan_status=0 ORDER BY kendaraan_nama ASC");
                        while ($k = mysqli_fetch_assoc($kendaraan)) {
                            echo "<option value='{$k['kendaraan_nomor']}'>{$k['kendaraan_nama']} ({$k['kendaraan_nomor']})</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Pilih User (dropdown) -->
                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        <?php
                        $users = mysqli_query($koneksi, "SELECT * FROM user ORDER BY user_nama ASC");
                        while ($u = mysqli_fetch_assoc($users)) {
                            echo "<option value='{$u['user_id']}'>{$u['user_nama']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali" class="form-control" required>
                </div>

                <input type="hidden" name="pinjam_status" value="2"> <!-- otomatis dipinjam -->

                <input type="submit" value="Simpan" class="btn btn-primary">
                <a href="pinjam.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>