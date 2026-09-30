# LAPORAN PRAKTIKUM PEMROGRAMAN BERBASIS WEB

## Pertemuan 2

### Identitas

**Nama:** Ernan Wanasakti
**NIM:** 4524210121
**Program Studi:** Teknik Informatika
**Mata Kuliah:** Pemrograman Berbasis Web

---

# 1. Contoh 3 — Interface dan Class Mahasiswa

**Nama File:** `contoh3.php`

## Penjelasan Program

Program `contoh3.php` merupakan program PHP yang digunakan untuk memahami konsep pemrograman berorientasi objek atau Object-Oriented Programming (OOP).

Pada program ini digunakan `interface` dan `class`. Interface digunakan untuk menentukan method yang harus dimiliki oleh class yang mengimplementasikannya.

Program memiliki interface bernama `Identitas`:

```php
interface Identitas
{
    public function ringkasan(): string;
}
```

Interface tersebut memiliki sebuah method bernama `ringkasan()`.

Class yang menggunakan interface tersebut adalah class `Mahasiswa`:

```php
class Mahasiswa implements Identitas
```

Dengan menggunakan `implements Identitas`, class `Mahasiswa` harus menyediakan method `ringkasan()` sesuai dengan yang telah ditentukan oleh interface.

---

## Property pada Class Mahasiswa

Class `Mahasiswa` memiliki beberapa property:

```php
private string $nim;
private string $nama;
protected float $ipk;
private string $jurusan;
```

Property tersebut digunakan untuk menyimpan informasi mahasiswa.

Penjelasannya:

* `$nim` digunakan untuk menyimpan nomor induk mahasiswa.
* `$nama` digunakan untuk menyimpan nama mahasiswa.
* `$ipk` digunakan untuk menyimpan nilai IPK.
* `$jurusan` digunakan untuk menyimpan program studi atau jurusan mahasiswa.

Property `$nim`, `$nama`, dan `$jurusan` menggunakan `private`, sedangkan `$ipk` menggunakan `protected`.

Penggunaan access modifier tersebut digunakan untuk mengatur akses terhadap property yang terdapat di dalam class.

---

## Constructor

Class `Mahasiswa` memiliki constructor:

```php
public function __construct(
    string $nim,
    string $nama,
    float $ipk,
    string $jurusan = 'IF'
)
```

Constructor digunakan untuk memberikan nilai awal ketika object `Mahasiswa` dibuat.

Nilai tersebut kemudian disimpan ke dalam property masing-masing:

```php
$this->nim = $nim;
$this->nama = $nama;
$this->setIpk($ipk);
$this->jurusan = $jurusan;
```

Untuk nilai IPK, program tidak langsung memasukkannya ke property, tetapi menggunakan method `setIpk()`.

---

## Validasi IPK

Program memiliki method:

```php
public function setIpk(float $ipk): void
```

Method tersebut digunakan untuk memberikan nilai IPK sekaligus melakukan validasi.

Kode validasinya adalah:

```php
if ($ipk < 0 || $ipk > 4) {
    throw new InvalidArgumentException('IPK harus 0 sampai 4.');
}
```

IPK harus berada pada rentang 0 sampai 4.

Jika nilai IPK kurang dari 0 atau lebih dari 4, program akan menghasilkan error karena nilai tersebut tidak sesuai dengan rentang IPK yang digunakan.

Jika nilai IPK berada dalam rentang yang benar, nilai tersebut akan disimpan:

```php
$this->ipk = $ipk;
```

---

## Modifikasi 1 — Menambahkan Property Jurusan

Modifikasi pertama pada `contoh3.php` adalah menambahkan property `$jurusan`.

Property tersebut ditambahkan pada class:

```php
private string $jurusan;
```

Sebelumnya class hanya menyimpan informasi seperti NIM, nama, dan IPK.

Dengan adanya property jurusan, informasi mahasiswa menjadi lebih lengkap.

Jurusan kemudian diterima melalui constructor:

```php
string $jurusan = 'IF'
```

Nilai tersebut disimpan menggunakan:

```php
$this->jurusan = $jurusan;
```

Pada saat object dibuat, jurusan dapat diberikan secara langsung:

```php
$mhs = new Mahasiswa(
    '4524210121',
    'Ernan Wanasakti',
    3.75,
    'Teknik Informatika'
);
```

Dengan demikian, object mahasiswa memiliki informasi NIM, nama, IPK, dan jurusan.

---

## Method `ringkasan()`

Method `ringkasan()` digunakan untuk menampilkan informasi singkat mengenai mahasiswa.

Kode yang digunakan:

```php
public function ringkasan(): string
{
    return $this->nim . " - " . $this->nama .
           " (" . $this->jurusan . ") - IPK: " . $this->ipk;
}
```

Method tersebut menggabungkan beberapa property menjadi satu informasi.

Data yang ditampilkan terdiri dari:

* NIM
* Nama
* Jurusan
* IPK

---

## Modifikasi 2 — Menambahkan Jurusan pada Output

Modifikasi kedua adalah menambahkan informasi jurusan pada hasil `ringkasan()`.

Bagian yang ditambahkan adalah:

```php
" (" . $this->jurusan . ")"
```

Dengan adanya modifikasi tersebut, output tidak hanya menampilkan NIM, nama, dan IPK, tetapi juga jurusan mahasiswa.

---

## Pembuatan Object

Object mahasiswa dibuat menggunakan:

```php
$mhs = new Mahasiswa(
    '4524210121',
    'Ernan Wanasakti',
    3.75,
    'Teknik Informatika'
);
```

Data tersebut kemudian diproses oleh class `Mahasiswa`.

Untuk menampilkan hasilnya, method `ringkasan()` dipanggil menggunakan:

```php
echo $mhs->ringkasan();
```

---

## Alur Program

Alur kerja `contoh3.php` adalah:

1. Program membuat interface `Identitas`.
2. Interface menentukan method `ringkasan()`.
3. Class `Mahasiswa` mengimplementasikan interface tersebut.
4. Class memiliki property NIM, nama, IPK, dan jurusan.
5. Constructor menerima data mahasiswa.
6. Nilai IPK diperiksa melalui method `setIpk()`.
7. Object mahasiswa dibuat menggunakan data yang telah ditentukan.
8. Method `ringkasan()` dipanggil.
9. Program menampilkan informasi mahasiswa.

---

## Hasil Program

Output yang dihasilkan adalah:

```text
4524210121 - Ernan Wanasakti (Teknik Informatika) - IPK: 3.75
```

Hasil tersebut menunjukkan bahwa data mahasiswa berhasil diproses dan informasi jurusan yang ditambahkan pada modifikasi berhasil ditampilkan.

---

# 2. Contoh 4 — Interface, Inheritance, dan Produk Diskon

**Nama File:** `contoh4.php`

## Penjelasan Program

Program `contoh4.php` digunakan untuk memahami konsep pemrograman berorientasi objek, khususnya penggunaan interface, class, inheritance, dan method yang dapat memiliki implementasi berbeda.

Program menggunakan interface bernama `BisaDihitung`:

```php
interface BisaDihitung
{
    public function hargaAkhir(): float;
}
```

Interface tersebut menentukan bahwa class yang mengimplementasikannya harus memiliki method `hargaAkhir()`.

---

## Class Produk

Program memiliki class `Produk`:

```php
class Produk implements BisaDihitung
```

Class tersebut mengimplementasikan interface `BisaDihitung`.

Class `Produk` memiliki beberapa property:

```php
protected string $nama;
protected float $harga;
public int $stok = 5;
```

Property tersebut digunakan untuk menyimpan:

* `$nama` untuk nama produk.
* `$harga` untuk harga produk.
* `$stok` untuk jumlah stok produk.

---

## Constructor Produk

Class `Produk` memiliki constructor:

```php
public function __construct(
    protected string $nama,
    protected float $harga,
    public int $stok = 5
) {}
```

Constructor digunakan untuk memberikan nilai awal pada produk.

Nilai stok memiliki nilai default `5`. Artinya, apabila stok tidak diberikan ketika object dibuat, nilai stok akan menggunakan 5.

Namun pada program ini, nilai stok diberikan secara langsung pada saat membuat object.

---

## Method `hargaAkhir()`

Class `Produk` memiliki method:

```php
public function hargaAkhir(): float
{
    return $this->harga;
}
```

Method tersebut mengembalikan harga asli produk tanpa potongan.

Program juga memiliki method:

```php
public function getNama(): string
{
    return $this->nama;
}
```

Method `getNama()` digunakan untuk mengambil nama produk.

---

## Class ProdukDiskon

Selain class `Produk`, terdapat class `ProdukDiskon`:

```php
class ProdukDiskon extends Produk
```

Kata `extends` menunjukkan bahwa `ProdukDiskon` merupakan turunan dari class `Produk`.

Dengan inheritance tersebut, `ProdukDiskon` dapat menggunakan property dan method yang berasal dari `Produk`.

Class `ProdukDiskon` memiliki property tambahan:

```php
private float $diskon;
```

Property tersebut digunakan untuk menyimpan persentase diskon.

---

## Perhitungan Harga Diskon

Pada `ProdukDiskon`, method `hargaAkhir()` dibuat kembali:

```php
public function hargaAkhir(): float
{
    return $this->harga * (1 - $this->diskon / 100);
}
```

Method tersebut menghitung harga setelah mendapatkan diskon.

Sebagai contoh, apabila harga produk adalah Rp150.000 dan diskonnya 10%, maka perhitungannya:

```text
Rp150.000 × (1 - 10 / 100)
= Rp150.000 × 0,9
= Rp135.000
```

Jadi harga akhir produk setelah diskon adalah Rp135.000.

---

## Modifikasi 1 — Menambahkan Property Stok

Modifikasi pertama pada `contoh4.php` adalah menambahkan property stok.

Property yang ditambahkan adalah:

```php
public int $stok = 5;
```

Property tersebut digunakan untuk menyimpan jumlah stok yang tersedia untuk setiap produk.

Ketika object dibuat, jumlah stok dapat ditentukan secara langsung.

Contohnya:

```php
new Produk('Keyboard', 250000, 10)
```

Artinya produk Keyboard memiliki stok sebanyak 10.

Untuk produk Mouse:

```php
new ProdukDiskon('Mouse', 150000, 10, 8)
```

Artinya produk Mouse memiliki stok sebanyak 8 dan mendapatkan diskon sebesar 10%.

---

## Modifikasi 2 — Menampilkan Informasi Stok

Modifikasi kedua adalah menambahkan informasi stok pada output.

Kode yang digunakan:

```php
echo $produk->getNama() .
     " (Stok: " . $produk->stok . ") - Rp " .
     number_format($produk->hargaAkhir(), 0, ',', '.') . "\n";
```

Dengan modifikasi tersebut, output tidak hanya menampilkan nama dan harga produk, tetapi juga jumlah stok yang tersedia.

Fungsi `number_format()` digunakan untuk membuat tampilan angka harga menjadi lebih mudah dibaca dengan format pemisah ribuan.

Contohnya:

```text
250000
```

akan ditampilkan menjadi:

```text
250.000
```

---

## Data Produk

Program memiliki dua object produk:

```php
$daftar = [
    new Produk('Keyboard', 250000, 10),
    new ProdukDiskon('Mouse', 150000, 10, 8)
];
```

Produk pertama adalah Keyboard dengan harga Rp250.000 dan stok 10.

Produk kedua adalah Mouse dengan harga Rp150.000, diskon 10%, dan stok 8.

Kedua object tersebut disimpan dalam array `$daftar`.

---

## Perulangan Produk

Program menggunakan `foreach` untuk memproses seluruh produk:

```php
foreach ($daftar as $produk) {
    echo $produk->getNama() .
         " (Stok: " . $produk->stok . ") - Rp " .
         number_format($produk->hargaAkhir(), 0, ',', '.') . "\n";
}
```

Perulangan tersebut mengambil setiap produk yang terdapat dalam array `$daftar`.

Setiap object kemudian memanggil method `hargaAkhir()`.

Pada object `Produk`, method tersebut mengembalikan harga asli.

Sedangkan pada object `ProdukDiskon`, method tersebut menghitung harga setelah diskon.

Hal ini menunjukkan bahwa method yang sama dapat menghasilkan perhitungan yang berbeda sesuai dengan class object yang digunakan.

---

## Alur Program

Alur kerja `contoh4.php` adalah:

1. Program membuat interface `BisaDihitung`.
2. Class `Produk` mengimplementasikan interface tersebut.
3. Class `Produk` memiliki nama, harga, dan stok.
4. Class `ProdukDiskon` dibuat sebagai turunan dari `Produk`.
5. `ProdukDiskon` memiliki tambahan data diskon.
6. Program membuat object Keyboard dan Mouse.
7. Kedua object dimasukkan ke dalam array `$daftar`.
8. Program melakukan perulangan menggunakan `foreach`.
9. Nama, stok, dan harga akhir setiap produk ditampilkan.
10. Harga produk diskon dihitung menggunakan method `hargaAkhir()` milik `ProdukDiskon`.

---

## Hasil Program

Output yang dihasilkan adalah:

```text
Keyboard (Stok: 10) - Rp 250.000
Mouse (Stok: 8) - Rp 135.000
```

Pada produk Keyboard, harga tetap Rp250.000 karena produk tersebut tidak memiliki diskon.

Pada produk Mouse, harga awal adalah Rp150.000 dan mendapatkan diskon 10%, sehingga harga akhirnya menjadi Rp135.000.

Informasi stok juga berhasil ditampilkan sesuai dengan data yang diberikan ketika object dibuat.

---

# 3. Kesimpulan

Pada Pertemuan 2, praktikum berfokus pada konsep pemrograman berorientasi objek menggunakan PHP.

Pada `contoh3.php`, digunakan interface `Identitas` dan class `Mahasiswa`. Program dimodifikasi dengan menambahkan property `jurusan` dan menampilkan jurusan tersebut pada method `ringkasan()`.

Pada `contoh4.php`, digunakan interface `BisaDihitung`, class `Produk`, dan class turunan `ProdukDiskon`. Program dimodifikasi dengan menambahkan property `stok` dan menampilkan informasi stok pada output.

Melalui kedua program tersebut, dapat dipahami penggunaan interface, class, object, constructor, property, method, inheritance, dan perulangan dalam pemrograman PHP berbasis objek.
