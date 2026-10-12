<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Mahasiswa</title>
<style>
*{box-sizing:border-box}
body{font-family:Arial,sans-serif;background:#f1f5f9;margin:0;padding:30px 15px;color:#1e293b}
.card{max-width:520px;margin:auto;background:white;padding:28px;border-radius:15px;box-shadow:0 5px 20px #0f172a10}
h1{margin-top:0;color:#1d4ed8}
p{color:#64748b;line-height:1.5}
label{display:block;font-weight:bold;font-size:14px;margin:16px 0 7px}
input{width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px}
input:focus{outline:2px solid #bfdbfe;border-color:#2563eb}
.actions{display:flex;gap:10px;margin-top:25px}
button,a{flex:1;text-align:center;padding:12px;border:0;border-radius:8px;text-decoration:none;font-weight:bold;cursor:pointer}
button{background:#2563eb;color:white}
a{background:#e2e8f0;color:#334155}
</style>
</head>
<body>
<div class="card">
    <h1>Tambah Mahasiswa</h1>
    <p>Lengkapi informasi mahasiswa pada formulir berikut.</p>

    <form action="store1.php" method="POST">
        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim"
               pattern="[0-9]+" title="NIM harus berupa angka" required>

        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" maxlength="100" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="prodi">Program Studi</label>
        <input type="text" id="prodi" name="prodi" required>

        <label for="angkatan">Angkatan</label>
        <input type="number" id="angkatan" name="angkatan"
               min="2000" max="2100" required>

        <label for="ipk">IPK (0–4)</label>
        <input type="number" id="ipk" name="ipk"
               min="0" max="4" step="0.01" required>

        <div class="actions">
            <a href="index1.php">Kembali</a>
            <button type="submit">Simpan Data</button>
        </div>
    </form>
</div>
</body>
</html>