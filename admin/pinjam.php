<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Peminjaman Kendaraan</h4>
        </div>

        <div class="panel-body">

            <a href="pinjam_tambah.php" class="btn btn-primary">+ Tambah Peminjaman</a>
            <br><br>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pinjam ID</th>
                        <th>Kendaraan</th>
                        <th>User ID</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th width="20%">Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($koneksi, "
                        SELECT p.*, k.kendaraan_nama 
                        FROM pinjam p
                        LEFT JOIN kendaraan k ON p.kendaraan_nomor = k.kendaraan_nomor
                        ORDER BY p.pinjam_id ASC
                    ");

                    while ($d = mysqli_fetch_assoc($data)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['pinjam_id']; ?></td>
                        <td><?= $d['kendaraan_nama']; ?> (<?= $d['kendaraan_nomor']; ?>)</td>
                        <td><?= $d['user_id']; ?></td>
                        <td><?= $d['tgl_pinjam']; ?></td>
                        <td><?= $d['tgl_kembali']; ?></td>
                        <td>
                            <?php if ($d['pinjam_status'] == 1): ?>
                                <span class="label label-success">Ready</span>
                            <?php else: ?>
                                <span class="label label-warning">Dipinjam</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="pinjam_edit.php?id=<?= $d['pinjam_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a onclick="return confirm('Hapus peminjaman ini?')" 
                               href="pinjam_hapus.php?id=<?= $d['pinjam_id']; ?>" 
                               class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>

        </div>
    </div>
</div>