<?php 

// render halaman menjadi json
header('Content-Type: application/json');

require '../config/app.php';

$query = select("SELECT * FROM barang ORDER BY id_barang desc");

echo json_encode(['data barang' => $query]);