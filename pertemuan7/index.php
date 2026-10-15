<?php
// 1. Panggil koneksi database
include "koneksi.php";

// 2. Panggil file Controller
include "controllers/MahasiswaController.php";

// 3. Inisialisasi Controller dengan mengirimkan variabel $koneksi
$controller = new MahasiswaController($koneksi);

// 4. Jalankan fungsi index untuk menampilkan data
$controller->index();
?>