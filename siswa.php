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
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Siswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="tambah-siswa" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus"></i> Tambah</a>

                            <a href="download-excel-siswa" class="btn btn-success btn-sm mb-3 mx-2"><i class="fas fa-file-excel"></i>&nbsp;Download Excel</a>

                            <a href="download-pdf-siswa" class="btn btn-danger btn-sm mb-3"><i class="fas fa-file-pdf"></i>&nbsp;Download PDF</a>

                            <table id="example2" class="table table-bordered table-hover">
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
                                            <td class="text-center" width="24%">
                                                <a href="detail-siswa?id_siswa=<?= $siswa['id_siswa']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i>&nbsp;Detail</a>

                                                <a href="ubah-siswa?id_siswa=<?= $siswa['id_siswa']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>&nbsp;Ubah</a>

                                                <a href="hapus-siswa?id_siswa=<?= $siswa['id_siswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Yakin Ingin menghapus data <?= $siswa['nama'] ?>');"><i class="fas fa-trash-alt"></i>&nbsp;Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php

include 'layout/footer.php';

?>