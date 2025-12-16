<?php 
include 'header.php'; ?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Tambah User</h4>
        </div>

        <div class="panel-body">
            <form action="user_aksi.php?aksi=tambah" method="POST">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="user_nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="user_alamat" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Status User</label>
                    <select name="user_status" class="form-control">
                        <option value="1">Admin</option>
                        <option value="0">User Biasa</option>
                    </select>
                </div>

                <input type="submit" value="Simpan" class="btn btn-primary">
                <a href="user.php" class="btn btn-default">Batal</a>

            </form>
        </div>
    </div>
</div>