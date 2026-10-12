
<?php
include "koneksi1.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Silakan isi form mahasiswa terlebih dahulu.");
}

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$prodi = trim($_POST['prodi'] ?? '');
$angkatan = filter_input(INPUT_POST, 'angkatan', FILTER_VALIDATE_INT);
$ipk = filter_input(INPUT_POST, 'ipk', FILTER_VALIDATE_FLOAT);

// Validasi data
if (
    $nim === '' ||
    !ctype_digit($nim) ||
    $nama === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $prodi === '' ||
    $angkatan === false ||
    $angkatan === null ||
    $angkatan < 2000 ||
    $angkatan > 2100 ||
    $ipk === false ||
    $ipk === null ||
    $ipk < 0 ||
    $ipk > 4
) {
    exit("Data tidak valid. Silakan periksa kembali form.");
}

// Simpan data menggunakan prepared statement
$stmt = mysqli_prepare(
    $koneksi,
    "INSERT INTO mahasiswa
    (nim, nama, email, prodi, angkatan, ipk)
    VALUES (?, ?, ?, ?, ?, ?)"
);

if (!$stmt) {
    exit("Terjadi kesalahan saat menyiapkan query.");
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssid",
    $nim,
    $nama,
    $email,
    $prodi,
    $angkatan,
    $ipk
);

$berhasil = mysqli_stmt_execute($stmt);

function aman($data) {
    return htmlspecialchars((string) $data, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penyimpanan Mahasiswa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .container {
            max-width: 560px;
            margin: 35px auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .header {
            text-align: center;
            padding: 30px 20px;
            background: #eff6ff;
        }

        .icon {
            width: 68px;
            height: 68px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #dcfce7;
            color: #15803d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: bold;
        }

        h1 {
            margin: 0 0 10px;
            font-size: 23px;
            color: #166534;
        }

        .header p {
            margin: 0;
            color: #64748b;
            line-height: 1.6;
        }

        .content {
            padding: 25px;
        }

        .section-title {
            margin: 0 0 18px;
            font-size: 17px;
        }

        .data-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 13px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .label {
            color: #64748b;
        }

        .value {
            text-align: right;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 12px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 13px;
            font-weight: bold;
        }

        .error {
            color: #b91c1c;
            background: #fef2f2;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            text-align: center;
            padding: 12px 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .primary {
            background: #2563eb;
            color: white;
        }

        .secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .footer {
            text-align: center;
            padding: 16px;
            color: #94a3b8;
            font-size: 12px;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 480px) {
            .actions {
                flex-direction: column;
            }

            .data-row {
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <?php if ($berhasil): ?>

        <div class="header">
            <div class="icon">&#10003;</div>
            <h1>Data Berhasil Disimpan!</h1>
            <p>Data mahasiswa telah berhasil ditambahkan ke database.</p>
        </div>

        <div class="content">
            <h2 class="section-title">Ringkasan Data Mahasiswa</h2>

            <div class="data-row">
                <span class="label">NIM</span>
                <span class="value"><?= aman($nim) ?></span>
            </div>

            <div class="data-row">
                <span class="label">Nama</span>
                <span class="value"><?= aman($nama) ?></span>
            </div>

            <div class="data-row">
                <span class="label">Email</span>
                <span class="value"><?= aman($email) ?></span>
            </div>

            <div class="data-row">
                <span class="label">Program Studi</span>
                <span class="value"><?= aman($prodi) ?></span>
            </div>

            <div class="data-row">
                <span class="label">Angkatan</span>
                <span class="value"><?= aman($angkatan) ?></span>
            </div>

            <div class="data-row">
                <span class="label">IPK</span>
                <span class="value"><?= number_format($ipk, 2, ',', '.') ?></span>
            </div>

            <div class="status">Status: Berhasil</div>

            <div class="actions">
                <a href="form1.php" class="btn primary">
                    Tambah Data Lagi
                </a>

                <a href="data1.php" class="btn secondary">
                    Lihat Data Mahasiswa
                </a>
            </div>
        </div>

    <?php else: ?>

        <div class="header">
            <div class="icon error">!</div>
            <h1 style="color:#b91c1c;">Data Gagal Disimpan</h1>
            <p>Data belum berhasil ditambahkan ke database.</p>
        </div>

        <div class="content">
            <p>Periksa apakah NIM sudah pernah digunakan atau apakah struktur tabel database sudah sesuai.</p>

            <div class="actions">
                <a href="form1.php" class="btn primary">
                    Kembali ke Form
                </a>

                <a href="data1.php" class="btn secondary">
                    Lihat Data Mahasiswa
                </a>
            </div>
        </div>

    <?php endif; ?>

    <div class="footer">
        Sistem Informasi Data Mahasiswa
    </div>

</div>

</body>
</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
