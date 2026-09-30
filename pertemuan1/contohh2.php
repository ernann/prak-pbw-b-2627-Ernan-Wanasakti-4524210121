<?php
// Pertemuan 1 - contoh2.php

// Fungsi menentukan predikat kelulusan berdasarkan IPK
function statusKelulusan(float $ipk): string
{
    // MODIFIKASI 1: Menambahkan kategori predikat kelulusan
    if ($ipk >= 3.75) return 'Dengan Pujian (Cumlaude)';
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    if ($ipk >= 2.75) return 'Cukup';
    return 'Perlu Peningkatan / Bimbingan';
}

// Array data mahasiswa
$mahasiswa = [
    'nim'      => '4524210121',
    'nama'     => 'Ernan Wanasakti',
    'prodi'    => 'Teknik Informatika',
    'semester' => 5,
    'ipk'      => 3.85,

    // MODIFIKASI 2: Menambahkan status mahasiswa
    'status'   => 'Aktif'
];

// Menampilkan data mahasiswa
echo "<h3>=== BIODATA MAHASISWA ===</h3>";

foreach ($mahasiswa as $kunci => $nilai) {
    echo ucfirst($kunci) . " : " . $nilai . "<br>";
}

// Menampilkan predikat berdasarkan IPK
echo "Predikat : " . statusKelulusan($mahasiswa['ipk']) . "<br>";
?>