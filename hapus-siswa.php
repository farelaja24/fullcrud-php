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

include 'config/app.php';

// menerima id barang yang dipilih user
$id_siswa = (int)$_GET['id_siswa'];

if (delete_siswa($id_siswa) > 0) {
    echo "<script>
    alert('Data Siswa Berhasil Dihapus!!');
    document.location.href = 'siswa';
    </script>";
}else {
    echo "<script>
    alert('Data Siswa Gagal Dihapus!!');
    document.location.href = 'siswa';
    </script>";
}