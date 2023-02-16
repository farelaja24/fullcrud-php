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

// membatasi halaman sesuai user login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
    echo "<script>
    alert('Anda tidak mempunyai hak akses!!')
    document.location.href = 'crud-modal';
    </script>";

    exit;
}

$title = 'Daftar Siswa';

include 'layout/header.php';

// menampilkan data siswa
$data_siswa = select("SELECT * FROM siswa ORDER BY id_siswa desc");


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container mt-4">
        <h2 class="fw-bold"><i class="bi bi-people-fill"></i>&nbsp;Data Siswa</h2>
        <hr>

        <a href="tambah-siswa" class="btn btn-primary mb-4"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Data</a>

        <a href="download-excel-siswa" class="btn btn-success mb-4"><i class="bi bi-file-earmark-excel-fill"></i>&nbsp;Download Excel</a>

        <a href="download-pdf-siswa" class="btn btn-danger mb-4"><i class="bi bi-file-earmark-pdf-fill"></i>&nbsp;Download PDF</a>

        <table class="table table-bordered table-hover table-striped" id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                foreach ($data_siswa as $siswa) :
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $siswa['nama'] ?></td>
                        <td><?= $siswa['jurusan'] ?></td>
                        <td><?= $siswa['jk'] ?></td>
                        <td><?= $siswa['telepon'] ?></td>
                        <td class="text-center" width="22%">
                            <a href="detail-siswa?id_siswa=<?= $siswa['id_siswa']; ?>" class="btn btn-secondary btn-sm"><i class="bi bi-eye-fill"></i>&nbsp;Detail</a>

                            <a href="ubah-siswa?id_siswa=<?= $siswa['id_siswa']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>&nbsp;Ubah</a>

                            <a href="hapus-siswa?id_siswa=<?= $siswa['id_siswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Yakin Ingin menghapus data <?= $siswa['nama'] ?>');"><i class="bi bi-trash3"></i>&nbsp;Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>




<?php

include 'layout/footer.php';

?>