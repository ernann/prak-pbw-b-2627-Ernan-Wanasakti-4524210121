<?php
mysqli_report(MYSQLI_REPORT_OFF);
include "koneksi1.php";

function kembali($pesan, $halaman = "index1.php") {
    echo "<script>alert(" . json_encode($pesan) . ");
    window.location.href=" . json_encode($halaman) . ";</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index1.php");
    exit;
}

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$prodi = trim($_POST['prodi'] ?? '');
$angkatan = filter_input(INPUT_POST, 'angkatan', FILTER_VALIDATE_INT);
$ipk = filter_input(INPUT_POST, 'ipk', FILTER_VALIDATE_FLOAT);

if (
    $nim === '' || $nama === '' || strlen($nama) > 100 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $prodi === '' ||
    $angkatan === false || $angkatan === null ||
    $angkatan < 2000 || $angkatan > 2100 ||
    $ipk === false || $ipk === null ||
    $ipk < 0 || $ipk > 4
) {
    kembali("Data tidak valid. Silakan periksa kembali.", "edit1.php?nim=" . urlencode($nim));
}

try {
    $stmt = mysqli_prepare(
        $koneksi,
        "UPDATE mahasiswa
         SET nama = ?, email = ?, prodi = ?, angkatan = ?, ipk = ?
         WHERE nim = ?"
    );

    mysqli_stmt_bind_param(
        $stmt, "ssssds",
        $nama, $email, $prodi, $angkatan, $ipk, $nim
    );

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($koneksi);
        kembali("Data mahasiswa berhasil diperbarui.");
    }

    mysqli_stmt_close($stmt);
    kembali("Data gagal diperbarui.");
} catch (mysqli_sql_exception $e) {
    kembali("Terjadi kesalahan saat memperbarui data.");
}
?>