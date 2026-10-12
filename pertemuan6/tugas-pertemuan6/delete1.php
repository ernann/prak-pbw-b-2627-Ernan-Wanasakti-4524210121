<?php
include "koneksi1.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index1.php");
    exit;
}

$nim = trim($_POST['nim'] ?? '');

if ($nim === '') {
    echo "<script>
        alert('NIM tidak ditemukan.');
        window.location.href = 'index1.php';
    </script>";
    exit;
}

$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM mahasiswa WHERE nim = ?"
);

if (!$stmt) {
    die("Query hapus gagal disiapkan: " . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($stmt, "s", $nim);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $pesan = "Data mahasiswa berhasil dihapus.";
    } else {
        $pesan = "Data tidak ditemukan. Periksa NIM dan database.";
    }
} else {
    $pesan = "Data gagal dihapus: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);

echo "<script>
    alert(" . json_encode($pesan) . ");
    window.location.href = 'index1.php';
</script>";
?>