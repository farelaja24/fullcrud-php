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

$title = 'Ubah Siswa';

include 'layout/header.php';

// Jika tombol tambah diklik
if (isset($_POST['ubah'])) {
    if (update_siswa($_POST) > 0) {
        echo "<script>
        alert('Data Siswa Berhasil Diubah!!');
        document.location.href = 'siswa';
        </script>";
    } else {
        echo "<script>
        alert('Data Siswa Gagal Diubah!!');
        document.location.href = 'siswa';
        </script>";
    }
}

// ambil id mahasiswa dari url
$id_siswa = (int)$_GET['id_siswa'];

// query ambil data mahasiswa
$siswa = select("SELECT * FROM siswa WHERE id_siswa = $id_siswa")[0];



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-edit"></i> Ubah Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="siswa">Data Siswa</a></li>
                        <li class="breadcrumb-item active">Ubah Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $siswa['foto']; ?>">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required value="<?= $siswa['nama']; ?>">
                </div>

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control" required>
                            <?php $jurusan = $siswa['jurusan']; ?>
                            <option value="TKR" <?= $jurusan == 'TKR' ? 'selected' : null ?>>Teknik Kendaraan Ringan Otomotif</option>
                            <option value="TP" <?= $jurusan == 'TP' ? 'selected' : null ?>>Teknik Pemesinan</option>
                            <option value="TPL" <?= $jurusan == 'TPL' ? 'selected' : null ?>>Teknik Pengelasan</option>
                            <option value="TITL" <?= $jurusan == 'TITL' ? 'selected' : null ?>>Teknik Instalasi Tenaga Listrik</option>
                            <option value="TOI" <?= $jurusan == 'TOI' ? 'selected' : null ?>>Teknik Otomasi Industri</option>
                            <option value="TKR" <?= $jurusan == 'TKR' ? 'selected' : null ?>>Teknik Kendaraan Ringan Otomotif</option>
                            <option value="BKP" <?= $jurusan == 'BKP' ? 'selected' : null ?>>Bisnis Konstruksi dan Properti</option>
                            <option value="DPIB" <?= $jurusan == 'DPIB' ? 'selected' : null ?>>Desain Permodelan dan Informasi Bangunan</option>
                            <option value="TAV" <?= $jurusan == 'TAV' ? 'selected' : null ?>>Teknik Audio Video</option>
                            <option value="TEI" <?= $jurusan == 'TEI' ? 'selected' : null ?>>Teknik Elektronika Industri</option>
                            <option value="TKJ" <?= $jurusan == 'TKJ' ? 'selected' : null ?>>Teknik Komputer dan Jaringan</option>
                            <option value="RPL" <?= $jurusan == 'RPL' ? 'selected' : null ?>>Rekayasa Perangkat Lunak</option>
                            <option value="GP" <?= $jurusan == 'GP' ? 'selected' : null ?>>Geologi Pertambangan</option>
                            <option value="GEOM" <?= $jurusan == 'GEOM' ? 'selected' : null ?>>Geomatika</option>
                        </select>
                    </div>

                    <div class="mb-3 col-6">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control" required>
                            <?php $jk = $siswa['jk']; ?>
                            <option value="Laki-Laki" <?= $jk == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                            <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="mb-2">Enter a telepon number:</label><br>
                    <input type="tel" id="telepon" name="telepon" placeholder="1234-5678-9999" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" class="w-100" required value="<?= $siswa['telepon']; ?>">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="mb-2">Alamat</label><br>
                    <textarea name="alamat" id="alamat"><?= $siswa['alamat'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required value="<?= $siswa['email']; ?>">
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="Upload Foto" onchange="previewImg()">

                    <img src="assets/img/<?= $siswa['foto']; ?>" alt="" class="img-thumbnail img-preview mt-2" width="15%">
                </div>

                <div class="mb-3" style="float: right;">
                    <a href="siswa" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="ubah" class="btn btn-warning">Ubah</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- preview image -->
<script>
    function previewImg(){
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php

include 'layout/footer.php';

?>