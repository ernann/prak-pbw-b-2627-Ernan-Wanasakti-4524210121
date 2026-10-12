<?php
include "koneksi1.php";

// Mengambil kata pencarian
$cari = trim($_GET['cari'] ?? '');

// Mengambil data mahasiswa
if ($cari !== '') {
    $stmt = mysqli_prepare(
        $koneksi,
        "SELECT * FROM mahasiswa
         WHERE nim LIKE ? OR nama LIKE ? OR prodi LIKE ?
         ORDER BY nama ASC"
    );

    $keyword = "%{$cari}%";

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $keyword,
        $keyword,
        $keyword
    );

    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
} else {
    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM mahasiswa ORDER BY nama ASC"
    );
}

// Menghitung total mahasiswa
$resultTotal = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS jumlah FROM mahasiswa"
);

$totalMahasiswa = mysqli_fetch_assoc($resultTotal)['jumlah'];

// Mengamankan output
function aman($data) {
    return htmlspecialchars(
        (string) $data,
        ENT_QUOTES,
        'UTF-8'
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Mahasiswa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        header {
            background: #1d4ed8;
            color: white;
            padding: 28px 6%;
        }

        header h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        header p {
            margin: 0;
            color: #dbeafe;
            line-height: 1.5;
        }

        main {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .summary {
            background: white;
            padding: 22px;
            border-radius: 14px;
            margin-bottom: 22px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
        }

        .summary-label {
            color: #64748b;
            font-size: 14px;
        }

        .summary-number {
            color: #1d4ed8;
            font-size: 32px;
            font-weight: bold;
            margin-top: 8px;
        }

        .content {
            background: white;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
        }

        .content h2 {
            margin: 0 0 20px;
            font-size: 21px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .search-form {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        input[type="search"] {
            width: 280px;
            max-width: 100%;
            padding: 11px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
        }

        input[type="search"]:focus {
            outline: 2px solid #bfdbfe;
            border-color: #2563eb;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-edit {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        thead {
            background: #f8fafc;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            color: #475569;
            font-size: 13px;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .ipk {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 5px 9px;
            border-radius: 20px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        .action-form {
            display: inline;
        }

        footer {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            padding: 25px 10px;
        }

        @media (max-width: 600px) {
            header {
                padding: 24px 20px;
            }

            main {
                padding: 0 12px;
                margin-top: 20px;
            }

            .content {
                padding: 16px;
            }

            .toolbar {
                align-items: stretch;
            }

            .search-form {
                width: 100%;
            }

            input[type="search"] {
                width: 100%;
                flex: 1;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>Data Mahasiswa</h1>
    <p>Sistem Informasi Pengelolaan Data Mahasiswa</p>
</header>

<main>

    <!-- Ringkasan jumlah mahasiswa -->
    <section class="summary">
        <div class="summary-label">Total Mahasiswa Terdaftar</div>
        <div class="summary-number">
            <?= aman($totalMahasiswa); ?>
        </div>
    </section>

    <!-- Tabel data mahasiswa -->
    <section class="content">

        <h2>Daftar Mahasiswa</h2>

        <div class="toolbar">

            <!-- Form pencarian -->
            <form action="index1.php" method="GET" class="search-form">
                <input
                    type="search"
                    name="cari"
                    placeholder="Cari NIM, nama, atau prodi..."
                    value="<?= aman($cari); ?>"
                >

                <button type="submit" class="btn btn-primary">
                    Cari
                </button>

                <a href="index1.php" class="btn btn-secondary">
                    Reset
                </a>
            </form>

            <!-- Tombol tambah mahasiswa -->
            <a href="create1.php" class="btn btn-primary">
                + Tambah Mahasiswa
            </a>

        </div>

        <div class="table-container">
            <table>

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>IPK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($query && mysqli_num_rows($query) > 0): ?>

                    <?php $no = 1; ?>

                    <?php while ($data = mysqli_fetch_assoc($query)): ?>

                        <tr>
                            <td><?= $no++; ?></td>

                            <td><?= aman($data['nim']); ?></td>

                            <td><?= aman($data['nama']); ?></td>

                            <td><?= aman($data['email']); ?></td>

                            <td><?= aman($data['prodi']); ?></td>

                            <td><?= aman($data['angkatan']); ?></td>

                            <td>
                                <span class="ipk">
                                    <?= number_format(
                                        (float) $data['ipk'],
                                        2,
                                        ',',
                                        '.'
                                    ); ?>
                                </span>
                            </td>

                            <td>
                                <!-- Tombol edit -->
                                <a
                                    href="edit1.php?nim=<?= urlencode($data['nim']); ?>"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>

                                <!-- Tombol hapus menggunakan POST -->
                                <form
                                    action="delete1.php"
                                    method="POST"
                                    class="action-form"
                                    onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?');"
                                >
                                    <input
                                        type="hidden"
                                        name="nim"
                                        value="<?= aman($data['nim']); ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="btn btn-delete"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="empty">
                            Data mahasiswa tidak ditemukan.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>
        </div>

    </section>

</main>

<footer>
    Sistem Informasi Data Mahasiswa &copy; <?= date('Y'); ?>
</footer>

</body>
</html>
