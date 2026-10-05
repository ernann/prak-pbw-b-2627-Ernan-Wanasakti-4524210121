<?php

require_once 'koneksi.php';

mysqli_select_db($koneksi, 'akademik2');

$sqlInsert = "INSERT IGNORE INTO mahasiswa 
(nim, nama, email, no_hp, prodi, angkatan, ipk) VALUES

('2026001','Andi Pratama','andi@kampus.ac.id','081234567801','Teknik Informatika',2026,3.75),

('2026002','Siti Rahma','siti@kampus.ac.id','081234567802','Sistem Informasi',2026,3.82),

('2025003','Budi Santoso','budi@kampus.ac.id','081234567803','Teknik Informatika',2025,3.20),

('2025004','Dina Maharani','dina@kampus.ac.id','081234567804','Sistem Informasi',2025,3.45)";

if (mysqli_query($koneksi, $sqlInsert)) {

    echo "[INSERT] Data mahasiswa berhasil dimasukkan ke tabel.<br><br>";

} else {

    echo "[ERROR] Gagal memasukkan data: " . mysqli_error($koneksi) . "<br><br>";

}

$sqlSelect = "SELECT nim, nama, prodi, angkatan, ipk

    FROM mahasiswa

    WHERE ipk >= 3.25

    ORDER BY ipk DESC, nama ASC

    LIMIT 10";

$result = mysqli_query($koneksi, $sqlSelect);

echo "--- HASIL QUERY SELECT ---<br><br>";

if ($result && mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        echo "NIM      : " . $row['nim'] . "<br>";
        echo "Nama     : " . $row['nama'] . "<br>";
        echo "Prodi    : " . $row['prodi'] . "<br>";
        echo "Angkatan : " . $row['angkatan'] . "<br>";
        echo "IPK      : " . $row['ipk'] . "<br>";
        echo "<br>";

    }

} else {

    echo "Tidak ada data mahasiswa dengan kriteria tersebut.<br>";

}

mysqli_close($koneksi);

?>