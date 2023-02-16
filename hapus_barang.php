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
$id_barang = (int)$_GET['id_barang'];

if (delete_barang($id_barang) > 0) {
    echo "<script>
    alert('Data Barang Berhasil Dihapus!!');
    document.location.href = 'index';
    </script>";
}else {
    echo "<script>
    alert('Data Barang Gagal Dihapus!!');
    document.location.href = 'index';
    </script>";
}