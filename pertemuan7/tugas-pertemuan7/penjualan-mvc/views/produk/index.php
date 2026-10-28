
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #26364a;
        }

        p {
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #26364a;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        a, button {
            display: inline-block;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .tambah {
            background-color: #198754;
        }

        .edit {
            background-color: #0d6efd;
        }

        .hapus {
            background-color: #dc3545;
        }

        .aksi {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .pesan {
            padding: 10px;
            margin-top: 15px;
            background-color: #d1e7dd;
            color: #0f5132;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Penjualan Produk</h2>
    <p>Daftar produk yang tersimpan di database penjualan_mvc.</p>

    <?php if (isset($_GET['pesan'])): ?>
        <div class="pesan">
            <?php
            $pesan = [
                'tambah' => 'Produk berhasil ditambahkan.',
                'ubah' => 'Produk berhasil diperbarui.',
                'hapus' => 'Produk berhasil dihapus.'
            ];

            echo htmlspecialchars(
                $pesan[$_GET['pesan']] ?? 'Proses selesai.'
            );
            ?>
        </div>
    <?php endif; ?>

    <br>

    <a href="index.php?aksi=create" class="tambah">
        + Tambah Produk
    </a>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($produk)): ?>
                <tr>
                    <td colspan="5">Belum ada data produk.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($produk as $i => $p): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>

                        <td>
                            <?= htmlspecialchars($p['nama_produk']) ?>
                        </td>

                        <td>
                            Rp <?= number_format(
                                (float) $p['harga'],
                                0,
                                ',',
                                '.'
                            ) ?>
                        </td>

                        <td><?= (int) $p['stok'] ?></td>

                        <td>
                            <div class="aksi">
                                <a
                                    href="index.php?aksi=edit&id=<?= (int) $p['id'] ?>"
                                    class="edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="index.php?aksi=hapus"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >
                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= (int) $p['id'] ?>"
                                    >

                                    <button type="submit" class="hapus">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
