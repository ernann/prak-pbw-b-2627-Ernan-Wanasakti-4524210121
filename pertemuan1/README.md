# LAPORAN PRAKTIKUM PEMROGRAMAN BERBASIS WEB

## Pertemuan 1

### Identitas

**Nama:** Ernan Wanasakti
**NIM:** 4524210121
**Program Studi:** Teknik Informatika
**Mata Kuliah:** Pemrograman Berbasis Web

---

# 1. Contoh 1 — Pengolahan Data POST

**Nama File:** `contoh1.php`

## Penjelasan Program

Program `contoh1.php` merupakan program PHP sederhana yang digunakan untuk memahami pengolahan data menggunakan metode `POST`.

Pada program ini terdapat tiga data yang digunakan, yaitu:

* Username
* Email
* Password

Data tersebut disimulasikan seolah-olah dikirim melalui metode `POST`. Data kemudian diambil menggunakan `$_POST` dan disimpan ke dalam variabel untuk diproses.

Data yang digunakan dalam program adalah:

```php
$_POST['username'] = 'ErnanWanasakti';
$_POST['email'] = 'ernan@univpancasila.ac.id';
$_POST['password'] = 'rahasia123';
```

Setelah data tersedia, program mengambil masing-masing data menggunakan:

```php
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
```

Operator `??` digunakan untuk memberikan nilai kosong apabila data yang dicari tidak tersedia.

Program juga melakukan pengecekan terhadap data yang dikirim menggunakan:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_POST))
```

Pengecekan tersebut digunakan untuk memastikan bahwa terdapat data `POST` yang dapat diproses oleh program.

---

## Modifikasi 1 — Menambahkan Email

Modifikasi pertama yang dilakukan adalah menambahkan data email.

Pada program ditambahkan:

```php
$_POST['email'] = 'ernan@univpancasila.ac.id';
```

Kemudian data email diambil menggunakan:

```php
$email = $_POST['email'] ?? '';
```

Email juga ditampilkan pada hasil program menggunakan:

```php
echo "Email    : " . $email . "\n";
```

Dengan adanya modifikasi ini, program tidak hanya mengolah username dan password, tetapi juga dapat mengolah dan menampilkan data email.

---

## Modifikasi 2 — Validasi Panjang Password

Modifikasi kedua adalah menambahkan validasi panjang password.

Kode yang digunakan:

```php
if (strlen($password) < 6) {
    echo "Error: Password harus minimal 6 karakter!\n";
}
```

Fungsi `strlen()` digunakan untuk menghitung jumlah karakter pada password.

Jika password memiliki kurang dari 6 karakter, program akan menampilkan pesan error.

Jika password memiliki minimal 6 karakter, program akan melanjutkan proses dan menampilkan informasi bahwa data berhasil diproses.

Validasi ini digunakan untuk memberikan pemeriksaan sederhana terhadap password sebelum data diproses lebih lanjut.

---

## Alur Program

Alur kerja dari `contoh1.php` adalah sebagai berikut:

1. Program menyiapkan data username, email, dan password.
2. Program melakukan pengecekan terhadap data `POST`.
3. Data username, email, dan password diambil dari `$_POST`.
4. Password diperiksa menggunakan fungsi `strlen()`.
5. Jika password kurang dari 6 karakter, program menampilkan pesan error.
6. Jika password memenuhi ketentuan, program menampilkan informasi login.
7. Password tidak ditampilkan pada hasil output.

---

## Hasil Program

Dengan menggunakan password `rahasia123`, program menghasilkan output:

```text
=== BERHASIL LOGIN ===
Username : ErnanWanasakti
Email    : ernan@univpancasila.ac.id
Status   : Data berhasil diproses via POST (Password disembunyikan).
```

Hasil tersebut menunjukkan bahwa data berhasil diproses dan password memenuhi ketentuan minimal 6 karakter.

---

# 2. Contoh 2 — Biodata dan Predikat Mahasiswa

**Nama File:** `contoh2.php`

## Penjelasan Program

Program `contoh2.php` digunakan untuk menampilkan biodata mahasiswa dan menentukan predikat berdasarkan nilai IPK.

Data mahasiswa disimpan menggunakan associative array. Data tersebut terdiri dari NIM, nama, program studi, semester, IPK, dan status mahasiswa.

Data yang digunakan adalah:

```php
$mahasiswa = [
    'nim'      => '4524210121',
    'nama'     => 'Ernan Wanasakti',
    'prodi'    => 'Teknik Informatika',
    'semester' => 5,
    'ipk'      => 3.85,
    'status'   => 'Aktif'
];
```

Setiap data memiliki pasangan key dan value.

Contohnya:

* `nim` merupakan key.
* `4524210121` merupakan value.
* `nama` merupakan key.
* `Ernan Wanasakti` merupakan value.

Dengan menggunakan associative array, beberapa informasi mahasiswa dapat disimpan dalam satu variabel.

---

## Function `statusKelulusan()`

Program memiliki function bernama `statusKelulusan()`:

```php
function statusKelulusan(float $ipk): string
```

Function tersebut menerima nilai IPK sebagai parameter dan mengembalikan hasil berupa predikat.

Penentuan predikat dilakukan menggunakan beberapa kondisi `if`:

```php
if ($ipk >= 3.75) return 'Dengan Pujian (Cumlaude)';
if ($ipk >= 3.50) return 'Sangat Memuaskan';
if ($ipk >= 3.00) return 'Memuaskan';
if ($ipk >= 2.75) return 'Cukup';
return 'Perlu Peningkatan / Bimbingan';
```

Program memeriksa nilai IPK mulai dari kondisi paling tinggi.

Jika nilai IPK memenuhi salah satu kondisi, program akan mengembalikan predikat yang sesuai.

Sebagai contoh, nilai IPK `3.85` memenuhi kondisi `IPK >= 3.75`, sehingga predikat yang diberikan adalah `Dengan Pujian (Cumlaude)`.

---

## Modifikasi 1 — Menambahkan Predikat IPK

Modifikasi pertama adalah menambahkan beberapa kategori predikat berdasarkan nilai IPK.

Kategori yang digunakan adalah:

| Nilai IPK | Predikat                      |
| --------- | ----------------------------- |
| >= 3.75   | Dengan Pujian (Cumlaude)      |
| >= 3.50   | Sangat Memuaskan              |
| >= 3.00   | Memuaskan                     |
| >= 2.75   | Cukup                         |
| < 2.75    | Perlu Peningkatan / Bimbingan |

Penambahan kategori tersebut membuat program dapat memberikan informasi tambahan berdasarkan nilai IPK mahasiswa.

---

## Modifikasi 2 — Menambahkan Status Mahasiswa

Modifikasi kedua adalah menambahkan status mahasiswa ke dalam array.

Data yang ditambahkan adalah:

```php
'status' => 'Aktif'
```

Dengan adanya data tersebut, informasi mahasiswa menjadi lebih lengkap.

Status tersebut juga akan ditampilkan secara otomatis ketika program menjalankan perulangan `foreach`.

---

## Perulangan `foreach`

Program menggunakan `foreach` untuk menampilkan seluruh data yang terdapat dalam array:

```php
foreach ($mahasiswa as $kunci => $nilai) {
    echo ucfirst($kunci) . " : " . $nilai . "\n";
}
```

Perulangan tersebut mengambil dua bagian:

* `$kunci` digunakan untuk mengambil key dari array.
* `$nilai` digunakan untuk mengambil value dari array.

Fungsi `ucfirst()` digunakan untuk membuat huruf pertama dari key menjadi huruf kapital.

Sebagai contoh:

```text
nama
```

akan ditampilkan menjadi:

```text
Nama
```

Dengan menggunakan `foreach`, seluruh data mahasiswa dapat ditampilkan tanpa harus menuliskan perintah `echo` satu per satu.

---

## Menampilkan Predikat

Setelah seluruh data mahasiswa ditampilkan, program memanggil function `statusKelulusan()` menggunakan nilai IPK dari array:

```php
echo "Predikat : " . statusKelulusan($mahasiswa['ipk']) . "\n";
```

Nilai IPK yang digunakan adalah `3.85`.

Karena nilai tersebut lebih besar dari atau sama dengan `3.75`, maka program menghasilkan predikat:

```text
Dengan Pujian (Cumlaude)
```

---

## Hasil Program

Hasil keseluruhan dari `contoh2.php` adalah:

```text
=== BIODATA MAHASISWA ===
Nim : 4524210121
Nama : Ernan Wanasakti
Prodi : Teknik Informatika
Semester : 5
Ipk : 3.85
Status : Aktif
Predikat : Dengan Pujian (Cumlaude)
```

Hasil tersebut menunjukkan bahwa data mahasiswa berhasil ditampilkan dan function `statusKelulusan()` berhasil menentukan predikat berdasarkan nilai IPK.

---

# 3. Kesimpulan

Pada Pertemuan 1, dilakukan praktik dasar pemrograman menggunakan PHP melalui dua program.

Pada `contoh1.php`, dipelajari pengolahan data menggunakan `POST`, penggunaan variabel, percabangan, dan validasi password. Program dimodifikasi dengan menambahkan field email serta validasi password minimal 6 karakter.

Pada `contoh2.php`, dipelajari penggunaan associative array, function, percabangan `if`, dan perulangan `foreach`. Program dimodifikasi dengan menambahkan kategori predikat berdasarkan IPK dan status mahasiswa.

Melalui kedua program tersebut, dapat dipahami bagaimana PHP digunakan untuk menerima, mengolah, memvalidasi, dan menampilkan data.
