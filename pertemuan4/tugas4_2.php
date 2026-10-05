<?php

require_once 'koneksi.php';

// Memilih database
mysqli_select_db($koneksi, 'akademik2');

// ==========================================
// 1. UPDATE: Mengubah data IPK
// ==========================================

echo "=== 1. PROSES UPDATE DATA ===<br>";

$sqlUpdate = "UPDATE mahasiswa 
              SET ipk = 3.50 
              WHERE nim = '2025003'";

if (mysqli_query($koneksi, $sqlUpdate)) {

    echo "Data IPK mahasiswa dengan NIM 2025003 berhasil diubah menjadi 3.50.<br><br>";

} else {

    echo "Gagal UPDATE: " . mysqli_error($koneksi) . "<br><br>";

}

// ==========================================
// 2. SELECT & GROUP BY: Rekap jumlah mahasiswa per prodi
// ==========================================

echo "=== 2. REKAP MAHASISWA PER PRODI ===<br>";

$sqlRekap = "SELECT prodi, COUNT(*) AS jumlah, 
             ROUND(AVG(ipk),2) AS rata_ipk
             FROM mahasiswa
             GROUP BY prodi
             ORDER BY jumlah DESC";

$resultRekap = mysqli_query($koneksi, $sqlRekap);

if (mysqli_num_rows($resultRekap) > 0) {

    while ($row = mysqli_fetch_assoc($resultRekap)) {

        echo "Prodi         : " . $row['prodi'] . "<br>";
        echo "Jumlah        : " . $row['jumlah'] . " Mahasiswa<br>";
        echo "Rata-rata IPK : " . $row['rata_ipk'] . "<br>";
        echo "-----------------------------------<br>";

    }

} else {

    echo "Belum ada data rekap prodi.<br>";

}

echo "<br>";

// ==========================================
// 3. SELECT: Verifikasi sebelum penghapusan
// ==========================================

echo "=== 3. VERIFIKASI DATA (NIM 2025003) ===<br>";

$sqlVerifikasi = "SELECT * FROM mahasiswa 
                  WHERE nim = '2025003'";

$resultVerifikasi = mysqli_query($koneksi, $sqlVerifikasi);

// Cek apakah data yang mau dihapus benar-benar ada

if (mysqli_num_rows($resultVerifikasi) > 0) {

    $row = mysqli_fetch_assoc($resultVerifikasi);

    echo "Data Ditemukan!<br>";
    echo "NIM     : " . $row['nim'] . "<br>";
    echo "Nama    : " . $row['nama'] . "<br>";
    echo "No. HP  : " . $row['no_hp'] . "<br>";
    echo "IPK     : " . $row['ipk'] . "<br><br>";

    // ==========================================
    // 4. DELETE: Menghapus data
    // ==========================================

    echo "=== 4. PROSES HAPUS DATA ===<br>";

    $sqlDelete = "DELETE FROM mahasiswa 
                  WHERE nim = '2025003'";

    if (mysqli_query($koneksi, $sqlDelete)) {

        echo "[SUKSES] Data mahasiswa dengan NIM 2025003 berhasil dihapus dari database.<br>";

    } else {

        echo "[ERROR] Gagal menghapus data: " . mysqli_error($koneksi) . "<br>";

    }

} else {

    echo "Data mahasiswa dengan NIM 2025003 TIDAK DITEMUKAN (Mungkin sudah terhapus sebelumnya).<br>";

}

mysqli_close($koneksi);

?>