<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Anda belum login, silahkan login dulu!')
    document.location.href = 'login';
    </script>";

    exit;
}

$title = 'Daftar Akun';

include 'layout/header.php';

// tampil seluruh data
$data_akun =  select("SELECT * FROM akun");

// tampil data berdasarkan user login
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

// jika tombol tambah ditekan, jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
        alert('Data Akun Berhasil Ditambah!!');
        document.location.href = 'crud-modal';
        </script>";
    } else {
        echo "<script>
        alert('Data Akun Gagal Ditambah!!');
        document.location.href = 'crud-modal';
        </script>";
    }
}

// jika tombol tambah ditekan, jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
        alert('Data Akun Berhasil Diubah!!');
        document.location.href = 'crud-modal';
        </script>";
    } else {
        echo "<script>
        alert('Data Akun Gagal Diubah!!');
        document.location.href = 'crud-modal';
        </script>";
    }
}


?>

<div class="container mt-4">
    <h2 class="fw-bold"><i class="bi bi-person-circle"></i>&nbsp;Data Akun</h2>
    <hr>

    <?php if ($_SESSION['level'] == 1) : ?>
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Data</button>
    <?php endif; ?>

    <table class="table table-bordered table-hover table-striped" id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <!-- tampil seluruh data -->
            <?php if ($_SESSION['level'] == 1) : ?>
                <?php foreach ($data_akun as $akun) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $akun['nama'] ?></td>
                        <td><?= $akun['username'] ?></td>
                        <td><?= $akun['email'] ?></td>
                        <td>
                            < Encrypted password>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun'] ?>"><i class="bi bi-pencil-square"></i>&nbsp;Ubah</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun'] ?>"><i class="bi bi-trash3"></i>&nbsp;Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- tampil data berdasarkan user login -->
                <?php foreach ($data_bylogin as $akun) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $akun['nama'] ?></td>
                        <td><?= $akun['username'] ?></td>
                        <td><?= $akun['email'] ?></td>
                        <td>
                            < Encrypted password>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun'] ?>"><i class="bi bi-pencil-square"></i>&nbsp;Ubah</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

    </table>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- start form -->
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required minlength="6">
                    </div>

                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="">-- pilih level --</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator Barang</option>
                            <option value="3">Operator Siswa</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
            <!-- end form -->
        </div>
    </div>
</div>


<!-- Modal Ubah -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalUbah<?= $akun['id_akun'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- start form -->
                    <form action="" method="post">
                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun'] ?>">

                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required value="<?= $akun['nama'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required value="<?= $akun['username'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required value="<?= $akun['email'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="password">Password <small>(Masukkan password baru)</small> </label>
                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                        </div>

                        <?php if ($_SESSION['level'] == 1) : ?>
                            <div class="mb-3">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <?php $level = $akun['level'] ?>
                                    <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= $level == '2' ? 'selected' : null ?>>Operator Barang</option>
                                    <option value="3" <?= $level == '3' ? 'selected' : null ?>>Operator Siswa</option>
                                </select>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="level" value="<?= $akun['level']; ?>">
                        <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="ubah" class="btn btn-warning">Ubah</button>
                </div>
                </form>
                <!-- end form -->
            </div>
        </div>
    </div>
<?php endforeach; ?>



<!-- Modal Hapus-->

<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalHapus<?= $akun['id_akun'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus Data Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin Ingin Menghapus Akun <span class="fw-bold text-danger text-capitalize"><?= $akun['nama'] ?></span> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapus-akun?id_akun=<?= $akun['id_akun'] ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<?php

include 'layout/footer.php';

?>