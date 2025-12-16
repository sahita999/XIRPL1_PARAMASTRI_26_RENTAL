<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Kendaraan</h4>
        </div>

        <div class="panel-body">

            <a href="kendaraan_tambah.php" class="btn btn-primary">+ Tambah Kendaraan</a>
            <br><br>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Kendaraan</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Harga / Hari</th>
                        <th>Status</th>
                        <th width="20%">Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM kendaraan ORDER BY kendaraan_nomor ASC");
                    while ($d = mysqli_fetch_assoc($data)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['kendaraan_nomor']; ?></td>
                        <td><?= $d['kendaraan_nama']; ?></td>
                        <td><?= $d['kendaraan_tipe']; ?></td>
                        <td>Rp <?= number_format($d['kendaraan_harga_perhari']); ?></td>
                        <td>
                            <?php if ($d['kendaraan_status'] == 0): ?>
                                <span class="label label-success">Tersedia</span>
                            <?php else: ?>
                                <span class="label label-warning">Dipinjam</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="kendaraan_edit.php?nomor=<?= $d['kendaraan_nomor']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a onclick="return confirm('Hapus kendaraan ini?')" 
                               href="kendaraan_hapus.php?aksi=hapus&nomor=<?= $d['kendaraan_nomor']; ?>" 
                               class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>

        </div>
    </div>
</div>