<?php

include 'header.php';
include '../koneksi.php';

?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data User</h4>
        </div>

        <div class="panel-body">
            <a href="user_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>
            <br><br>

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>

                <?php
                $no = 1;
                $data = mysqli_query($koneksi,"SELECT * FROM user");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['username']; ?></td>
                    <td><?= $d['user_nama']; ?></td>
                    <td><?= $d['user_alamat']; ?></td>
                    <td>
                        <?= ($d['user_status']==1) ? 
                            "<span class='label label-primary'>Admin</span>" : 
                            "<span class='label label-success'>User</span>"; ?>
                    </td>
                    <td>
                        <a href="user_edit.php?id=<?= $d['user_id']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="user_hapus.php?id=<?= $d['user_id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>