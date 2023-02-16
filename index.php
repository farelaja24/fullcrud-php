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
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
    echo "<script>
    alert('Anda tidak mempunyai hak akses!!')
    document.location.href = 'crud-modal';
    </script>";

    exit;
}

$title = 'Daftar Barang';

include 'layout/header.php';

$data_barang = select("SELECT * FROM barang ORDER BY id_barang desc");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Barang</li>
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
                            <h3 class="card-title">Tabel Data Barang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="tambah-barang" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus"></i> Tambah</a>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_barang as $barang) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $barang['nama'] ?></td>
                                            <td><?= $barang['jumlah'] ?></td>
                                            <td>Rp. <?= number_format($barang['harga'], 0, ',', '.') ?></td>
                                            <td><?= date('d/m/Y | H:i:s', strtotime($barang['tanggal'])) ?></td>
                                            <td width="20%" class="text-center">
                                                <a href="ubah-barang?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp;Ubah</a>
                                                <a href="hapus_barang?id_barang=<?= $barang['id_barang']; ?>" onclick="return confirm('Yakin Data Barang Akan Dihapus?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp;Hapus</a>
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