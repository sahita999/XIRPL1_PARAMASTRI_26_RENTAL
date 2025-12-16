<?php
include 'header.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Tambah Kendaraan</h4>
        </div>

        <div class="panel-body">
            <form action="kendaraan_aksi.php?aksi=tambah" method="POST">

                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input type="text" name="kendaraan_nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nomor Kendaraan</label>
                    <input type="text" name="kendaraan_nomor" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <input type="text" name="kendaraan_tipe" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Harga per Hari</label>
                    <input type="number" name="kendaraan_harga_perhari" class="form-control" required>
                </div>

                <!-- default: tersedia -->
                <input type="hidden" name="kendaraan_status" value="0">

                <input type="submit" value="Simpan" class="btn btn-primary">
                <a href="kendaraan.php" class="btn btn-default">Batal</a>

            </form>
        </div>
    </div>
</div>