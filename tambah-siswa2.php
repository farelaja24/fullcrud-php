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

$title = 'Tambah Siswa';

include 'layout/header.php';

// Jika tombol tambah diklik
if (isset($_POST['tambah'])) {
    if (create_siswa($_POST) > 0) {
        echo "<script>
        alert('Data Siswa Berhasil Ditambah!!');
        document.location.href = 'siswa';
        </script>";
    } else {
        echo "<script>
        alert('Data Siswa Gagal Ditambah!!');
        document.location.href = 'siswa';
        </script>";
    }
}

?>

<div class="container mt-4">
    <h2 class="fw-bold">Tambah Data Siswa</h2>
    <hr>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="jurusan" class="form-label">Jurusan</label>
                <select name="jurusan" id="jurusan" class="form-control" required>
                    <option value="">-- pilih jurusan --</option>
                    <option value="TKR">Teknik Kendaraan Ringan Otomotif</option>
                    <option value="TP">Teknik Pemesinan</option>
                    <option value="TPL">Teknik Pengelasan</option>
                    <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                    <option value="TOI">Teknik Otomasi Industri</option>
                    <option value="TKR">Teknik Kendaraan Ringan Otomotif</option>
                    <option value="BKP">Bisnis Konstruksi dan Properti</option>
                    <option value="DPIB">Desain Permodelan dan Informasi Bangunan</option>
                    <option value="TAV">Teknik Audio Video</option>
                    <option value="TEI">Teknik Elektronika Industri</option>
                    <option value="TKJ">Teknik Komputer dan Jaringan</option>
                    <option value="RPL">Rekayasa Perangkat Lunak</option>
                    <option value="GP">Geologi Pertambangan</option>
                    <option value="GEOM">Geomatika</option>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control" required>
                    <option value="">-- pilih jenis kelamin --</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="telepon" class="mb-2">Enter a telepon number:</label><br>
            <input type="tel" id="telepon" name="telepon" placeholder="1234-5678-9999" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" class="w-100" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="mb-2">Alamat</label><br>
            <textarea name="alamat" id="alamat"></textarea>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="Upload Foto" onchange="previewImg()">

            <img src="" alt="" class="img-thumbnail img-preview mt-2" width="15%">
        </div>

        <div class="mb-3" style="float: right;">
            <a href="siswa" class="btn btn-secondary">Kembali</a>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
        </div>
    </form>

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