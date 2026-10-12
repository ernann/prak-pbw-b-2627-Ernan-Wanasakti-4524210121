<?php
mysqli_report(MYSQLI_REPORT_OFF);
include "koneksi1.php";

function kembali($pesan) {
    echo "<script>alert(" . json_encode($pesan) . ");
    window.location.href='create1.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: create1.php");
    exit;
}

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$prodi = trim($_POST['prodi'] ?? '');
$angkatan = filter_input(INPUT_POST, 'angkatan', FILTER_VALIDATE_INT);
$ipk = filter_input(INPUT_POST, 'ipk', FILTER_VALIDATE_FLOAT);

if (
    $nim === '' || !ctype_digit($nim) ||
    $nama === '' || strlen($nama) > 100 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $prodi === '' ||
    $angkatan === false || $angkatan === null ||
    $angkatan < 2000 || $angkatan > 2100 ||
    $ipk === false || $ipk === null ||
    $ipk < 0 || $ipk > 4
) {
    kembali("Data tidak valid. Periksa kembali isian form.");
}

try {
    $cek = mysqli_prepare(
        $koneksi,
        "SELECT nim FROM mahasiswa WHERE nim = ?"
    );
    mysqli_stmt_bind_param($cek, "s", $nim);
    mysqli_stmt_execute($cek);
    mysqli_stmt_store_result($cek);

    if (mysqli_stmt_num_rows($cek) > 0) {
        mysqli_stmt_close($cek);
        kembali("NIM sudah terdaftar. Gunakan NIM lain.");
    }
    mysqli_stmt_close($cek);

    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk)
         VALUES (?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt, "sssssd",
        $nim, $nama, $email, $prodi, $angkatan, $ipk
    );

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($koneksi);
        echo "<script>alert('Data mahasiswa berhasil disimpan');
        window.location.href='index1.php';</script>";
        exit;
    }

    mysqli_stmt_close($stmt);
    kembali("Data gagal disimpan. Periksa data dan struktur tabel.");
} catch (mysqli_sql_exception $e) {
    kembali("Data gagal disimpan. Periksa kembali data yang dimasukkan.");
}
?>