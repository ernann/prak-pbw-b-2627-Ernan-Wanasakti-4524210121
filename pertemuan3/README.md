# TUGAS 3 - PERTEMUAN 3

## Identitas

**Nama:** Ernan Wanasakti
**NIM:** 4524210121
**Pertemuan:** 3

---

## 1. Tujuan

Pada Tugas 3 ini dilakukan praktik pembuatan database dan tabel menggunakan PHP dan MySQL. Program dijalankan melalui Terminal VS Code dan hasil database diperiksa melalui phpMyAdmin.

Program juga dimodifikasi dengan menambahkan beberapa perubahan pada struktur database.

---

## 2. Database yang Digunakan

Database yang digunakan pada hasil modifikasi adalah:

```text
akademik2
```

Database dibuat menggunakan PHP dengan perintah:

```php
CREATE DATABASE IF NOT EXISTS akademik2
```

---

## 3. Tabel yang Dibuat

Program membuat 5 tabel, yaitu:

1. `mahasiswa`
2. `dosen`
3. `mata_kuliah`
4. `krs`
5. `mk_krs`

Tabel-tabel tersebut menggunakan database `akademik2` dan beberapa tabel memiliki hubungan menggunakan foreign key.

---

## 4. Modifikasi Program

### Modifikasi 1 - Menambahkan Nomor HP

Pada tabel `mahasiswa` ditambahkan field:

```sql
no_hp VARCHAR(15) NOT NULL
```

Field ini digunakan untuk menyimpan nomor HP mahasiswa.

### Modifikasi 2 - Menambahkan Validasi IPK

Pada tabel `mahasiswa` ditambahkan validasi:

```sql
CHECK (ipk >= 0.00 AND ipk <= 4.00)
```

Validasi ini digunakan agar nilai IPK hanya berada pada rentang 0.00 sampai 4.00.

### Modifikasi 3 - Menggunakan Database `akademik2`

Database dari program awal yang menggunakan `akademik` diubah menjadi:

```text
akademik2
```

Perubahan ini dilakukan agar hasil modifikasi tidak bercampur dengan database sebelumnya.

---

## 5. Lima Bagian Kode yang Penting

### 1. Koneksi Database

```php
require_once 'koneksi.php';
```

Digunakan untuk memanggil file koneksi agar program dapat terhubung dengan MySQL.

### 2. Membuat Database

```php
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS akademik2";
```

Digunakan untuk membuat database `akademik2` jika database tersebut belum tersedia.

### 3. Memilih Database

```php
mysqli_select_db($koneksi, 'akademik2');
```

Digunakan untuk memilih database yang akan digunakan oleh program.

### 4. Field Nomor HP

```sql
no_hp VARCHAR(15) NOT NULL
```

Digunakan untuk menyimpan nomor HP mahasiswa dan merupakan salah satu hasil modifikasi.

### 5. Validasi IPK

```sql
CHECK (ipk >= 0.00 AND ipk <= 4.00)
```

Digunakan untuk membatasi nilai IPK agar berada pada rentang 0.00 sampai 4.00.

---

## 6. Cara Menjalankan Program

Program dijalankan melalui Terminal VS Code.

Pastikan MySQL pada XAMPP sudah dalam keadaan **Running**.

Masuk ke folder:

```text
C:\xampp\htdocs\pertemuan3
```

Kemudian jalankan:

```powershell
C:\xampp\php\php.exe tugas3.php
```

Jika berhasil, akan muncul hasil bahwa database dan tabel berhasil dibuat atau sudah tersedia.

---

## 7. Screenshot Hasil Running di Terminal VS Code

Hasil running program dapat dilihat melalui Terminal VS Code.

Contoh hasil:

```text
Database berhasil dibuat atau sudah ada.
Tabel berhasil dibuat atau sudah ada.
Tabel berhasil dibuat atau sudah ada.
Tabel berhasil dibuat atau sudah ada.
Tabel berhasil dibuat atau sudah ada.
Tabel berhasil dibuat atau sudah ada.
```

**Screenshot hasil running:**

> **[MASUKKAN SCREENSHOT HASIL RUNNING DI TERMINAL VS CODE DI SINI]**

Screenshot ini digunakan sebagai bukti bahwa program berhasil dijalankan tanpa error kritis.

---

## 8. Screenshot Database di phpMyAdmin

Setelah program berhasil dijalankan, database diperiksa melalui phpMyAdmin.

Buka:

```text
http://localhost/phpmyadmin
```

Kemudian pilih database:

```text
akademik2
```

Di dalam database tersebut terdapat 5 tabel:

```text
mahasiswa
dosen
mata_kuliah
krs
mk_krs
```

**Screenshot database `akademik2`:**

> **[MASUKKAN SCREENSHOT DATABASE akademik2 DI PHPMYADMIN DI SINI]**

Screenshot ini menunjukkan bahwa database berhasil dibuat.

---

## 9. Screenshot Struktur Tabel Mahasiswa

Struktur tabel `mahasiswa` diperiksa melalui menu **Structure** pada phpMyAdmin.

Field yang terdapat pada tabel antara lain:

```text
id
nim
nama
email
no_hp
prodi
angkatan
ipk
```

Field `no_hp` merupakan tambahan dari hasil modifikasi.

**Screenshot Structure tabel mahasiswa:**

> **[MASUKKAN SCREENSHOT STRUCTURE MAHASISWA DI PHPMYADMIN DI SINI]**

---

## 10. Screenshot Isi/Database di phpMyAdmin

Selain melihat struktur tabel, hasil database juga dapat diperiksa melalui menu **Browse** atau tampilan tabel pada phpMyAdmin.

**Screenshot hasil pemeriksaan:**

> **[MASUKKAN SCREENSHOT BROWSE / HASIL TABEL DI PHPMYADMIN DI SINI]**

Screenshot ini digunakan sebagai bukti tambahan bahwa database dan tabel dapat diakses melalui phpMyAdmin.

---

## 11. Screenshot Sebelum Modifikasi

Sebelum dilakukan modifikasi, program menggunakan database:

```text
akademik
```

Tabel `mahasiswa` belum memiliki field:

```text
no_hp
```

**Screenshot sebelum modifikasi:**

> **[MASUKKAN SCREENSHOT SEBELUM MODIFIKASI DI SINI]**

---

## 12. Screenshot Sesudah Modifikasi

Setelah dilakukan modifikasi, program menggunakan:

```text
akademik2
```

Tabel `mahasiswa` memiliki tambahan:

```sql
no_hp VARCHAR(15) NOT NULL
```

dan validasi:

```sql
CHECK (ipk >= 0.00 AND ipk <= 4.00)
```

**Screenshot sesudah modifikasi:**

> **[MASUKKAN SCREENSHOT SESUDAH MODIFIKASI DI SINI]**

---

## 13. Error yang Pernah Muncul

Salah satu error yang dapat terjadi adalah program tidak dapat terhubung dengan MySQL.

### Penyebab

MySQL pada XAMPP belum dijalankan sehingga PHP tidak dapat melakukan koneksi ke database.

### Perbaikan

1. Membuka XAMPP.
2. Menjalankan MySQL dengan menekan tombol **Start**.
3. Membuka kembali Terminal VS Code.
4. Masuk ke folder `pertemuan3`.
5. Menjalankan kembali program:

```powershell
C:\xampp\php\php.exe tugas3.php
```

Setelah MySQL berjalan, program dapat dijalankan kembali.

---

## 14. Kesimpulan

Tugas 3 berhasil dilakukan dengan membuat database dan tabel menggunakan PHP dan MySQL. Database yang digunakan pada hasil modifikasi adalah `akademik2`.

Modifikasi yang dilakukan yaitu menambahkan field `no_hp` pada tabel `mahasiswa` dan menambahkan validasi nilai IPK dari 0.00 sampai 4.00.

Hasil program dapat diperiksa melalui Terminal VS Code dan phpMyAdmin. Database `akademik2` beserta lima tabel berhasil dibuat dan dapat diakses dengan baik.
