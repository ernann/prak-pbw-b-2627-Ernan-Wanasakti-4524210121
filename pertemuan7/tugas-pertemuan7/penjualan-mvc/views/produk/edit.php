
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #26364a;
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button, .kembali {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        button {
            background-color: #0d6efd;
            color: white;
        }

        .kembali {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Produk</h2>
    <p>Silakan ubah data produk di bawah ini.</p>

    <form action="index.php?aksi=update" method="POST">
        <input
            type="hidden"
            name="id"
            value="<?= (int) $produk['id'] ?>"
        >

        <label for="nama_produk">Nama Produk</label>
        <input
            type="text"
            id="nama_produk"
            name="nama_produk"
            maxlength="100"
            value="<?= htmlspecialchars($produk['nama_produk']) ?>"
            required
        >

        <label for="harga">Harga (Rp)</label>
        <input
            type="number"
            id="harga"
            name="harga"
            min="0"
            step="0.01"
            value="<?= htmlspecialchars((string) $produk['harga']) ?>"
            required
        >

        <label for="stok">Stok</label>
        <input
            type="number"
            id="stok"
            name="stok"
            min="0"
            step="1"
            value="<?= (int) $produk['stok'] ?>"
            required
        >

        <button type="submit">Simpan Perubahan</button>
        <a href="index.php" class="kembali">Kembali</a>
    </form>
</div>

</body>
</html>
