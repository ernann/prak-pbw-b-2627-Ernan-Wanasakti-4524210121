<?php
// Pertemuan 1 - contoh1.php

// Simulasi data yang dikirim melalui metode POST
$_POST['username'] = 'ErnanWanasakti';
$_POST['email']    = 'ernan@univpancasila.ac.id';
$_POST['password'] = 'rahasia123';

// Mengecek apakah terdapat data POST
if (!empty($_POST)) {

    $username = $_POST['username'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // MODIFIKASI 2: Validasi panjang password
    if (strlen($password) < 6) {
        echo "Error: Password harus minimal 6 karakter!";
    } else {
        echo "=== BERHASIL LOGIN ===<br>";
        echo "Username : " . $username . "<br>";
        echo "Email    : " . $email . "<br>";
        echo "Status   : Data berhasil diproses via POST (Password disembunyikan).";
    }

} else {
    echo "Silakan kirim data menggunakan method POST.";
}
?>