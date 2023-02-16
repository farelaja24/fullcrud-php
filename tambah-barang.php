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

$title = 'Tambah Barang';

include 'layout/header.php';

// Jika tombol tambah diklik
if (isset($_POST['tambah'])) {
    if (create_barang($_POST) > 0) {
        echo "<script>
        alert('Data Barang Berhasil Ditambah!!');
        document.location.href = 'index';
        </script>";
    } else {
        echo "<script>
        alert('Data Barang Gagal Ditambah!!');
        document.location.href = 'index';
        </script>";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-plus"></i> Tambah Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index">Data Barang</a></li>
                        <li class="breadcrumb-item active">Tambah Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Barang" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" min="0" step="1000" class="form-control" id="harga" name="harga" placeholder="Harga Barang" required>
                </div>

                <div style="float: right;">
                    <a href="index" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>

            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php

include 'layout/footer.php';

?>