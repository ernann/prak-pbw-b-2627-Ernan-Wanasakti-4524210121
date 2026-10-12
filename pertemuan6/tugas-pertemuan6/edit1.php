<?php
include "koneksi1.php";

function e($nilai) {
    return htmlspecialchars((string)$nilai, ENT_QUOTES, 'UTF-8');
}

$nim = trim($_GET['nim'] ?? '');

if ($nim === '') {
    header("Location: index1.php");
    exit;
}

$stmt = mysqli_prepare($koneksi, "SELECT * FROM mahasiswa WHERE nim = ?");
mysqli_stmt_bind_param($stmt, "s", $nim);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$m = mysqli_fetch_assoc($hasil);

if (!$m) {
    echo "<script>alert('Data mahasiswa tidak ditemukan');
    window.location.href='index1.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Mahasiswa</title>
<style>
*{box-sizing:border-box}
body{font-family:Arial,sans-serif;background:#f1f5f9;margin:0;padding:30px 15px;color:#1e293b}
.card{max-width:520px;margin:auto;background:white;padding:28px;border-radius:15px;box-shadow:0 5px 20px #0f172a10}
h1{color:#1d4ed8;margin-top:0}
p{color:#64748b}
label{display:block;font-weight:bold;font-size:14px;margin:16px 0 7px}
input{width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px}
input:disabled{background:#e2e8f0;color:#64748b}
small{color:#64748b}
.actions{display:flex;gap:10px;margin-top:25px}
button,a{flex:1;text-align:center;padding:12px;border:0;border-radius:8px;text-decoration:none;font-weight:bold;cursor:pointer}
button{background:#2563eb;color:white}
a{background:#e2e8f0;color:#334155}
</style>
</head>
<body>
<div class="card">
    <h1>Edit Mahasiswa</h1>
    <p>Perbarui informasi mahasiswa, lalu simpan perubahan.</p>

    <form action="update1.php" method="POST">
        <label>NIM</label>
        <input type="text" value="<?= e($m['nim']) ?>" disabled>
        <input type="hidden" name="nim" value="<?= e($m['nim']) ?>">
        <small>NIM tidak dapat diubah.</small>

        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama"
               value="<?= e($m['nama']) ?>" maxlength="100" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?= e($m['email']) ?>" required>

        <label for="prodi">Program Studi</label>
        <input type="text" id="prodi" name="prodi"
               value="<?= e($m['prodi']) ?>" required>

        <label for="angkatan">Angkatan</label>
        <input type="number" id="angkatan" name="angkatan"
               min="2000" max="2100" value="<?= e($m['angkatan']) ?>" required>

        <label for="ipk">IPK (0–4)</label>
        <input type="number" id="ipk" name="ipk"
               min="0" max="4" step="0.01"
               value="<?= e($m['ipk']) ?>" required>

        <div class="actions">
            <a href="index1.php">Batal</a>
            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div>
</body>
</html>