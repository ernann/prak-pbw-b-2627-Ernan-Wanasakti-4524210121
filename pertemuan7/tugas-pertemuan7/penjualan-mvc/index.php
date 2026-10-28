<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/controllers/ProdukController.php';

$controller = new ProdukController($koneksi);
$controller->jalankan();
?>