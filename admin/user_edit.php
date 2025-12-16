<?php
include 'header.php';
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$id'");
$d = mysqli_fetch_assoc($data);
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit User</h4>
        </div>

        <div class="panel-body">
            <form action="user_update.php?aksi=update" method="POST">

                <input type="hidden" name="id" value="<?= $d['user_id']; ?>">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control"
                           value="<?= $d['username']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Kosongkan jika tidak diubah">
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="user_nama" class="form-control"
                           value="<?= $d['user_nama']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="user_alamat" class="form-control" required><?= $d['user_alamat']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Status User</label>
                    <select name="user_status" class="form-control">
                        <option value="1" <?= ($d['user_status']==1?'selected':''); ?>>Admin</option>
                        <option value="0" <?= ($d['user_status']==0?'selected':''); ?>>User Biasa</option>
                    </select>
                </div>

                <input type="submit" value="Update" class="btn btn-primary">
                <a href="user.php" class="btn btn-default">Batal</a>

            </form>
        </div>
    </div>
</div>