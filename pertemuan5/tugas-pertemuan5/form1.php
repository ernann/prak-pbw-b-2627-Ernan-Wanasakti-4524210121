
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 30px;
        }

        .container {
            max-width: 450px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 6px 0 14px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Data Mahasiswa</h2>

        <form action="simpan1.php" method="post">
            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim"
                   pattern="[0-9]+" title="NIM harus berupa angka"
                   required>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama"
                   maxlength="100" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="prodi">Prodi:</label>
            <input type="text" id="prodi" name="prodi" required>

            <label for="angkatan">Angkatan:</label>
            <input type="number" id="angkatan" name="angkatan"
                   min="2000" max="2100" required>

            <label for="ipk">IPK:</label>
            <input type="number" id="ipk" name="ipk"
                   min="0" max="4" step="0.01" required>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
