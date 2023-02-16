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

$title = 'Detail Siswa';

include 'layout/header.php';

// mengambil id siswa dari url
$id_siswa = (int)$_GET['id_siswa'];

// menampilkan data siswa
$siswa = select("SELECT * FROM siswa WHERE  id_siswa =  $id_siswa")[0];


?>


<div class="container mt-4">
    <h2 class="fw-bold">Data <?= $siswa['nama']; ?></h2>
    <hr>

    <table class="table table-bordered table-hover table-striped">

        <tr>
            <td>Nama</td>
            <td>: <?= $siswa['nama'] ?></td>
        </tr>

        <tr>
            <td>Jurusan</td>
            <td>: <?= $siswa['jurusan'] ?></td>
        </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $siswa['jk'] ?></td>
        </tr>

        <tr>
            <td>Telepon</td>
            <td>: <?= $siswa['telepon'] ?></td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>: <?= $siswa['alamat'] ?></td>
        </tr>

        <tr>
            <td>Email</td>
            <td>: <?= $siswa['email'] ?></td>
        </tr>

        <tr>
            <td width="50%">Foto</td>
            <td>
                <a href="assets/img/<?=$siswa['foto']?>">
                    <img src="assets/img/<?=$siswa['foto']?>" width="50%">
                </a>
            </td>
        </tr>

    </table>

    <a href="siswa" class="btn btn-secondary btn-sm mb-3" style="float: right;">Kembali</a>
</div>




<?php

include 'layout/footer.php';

?>