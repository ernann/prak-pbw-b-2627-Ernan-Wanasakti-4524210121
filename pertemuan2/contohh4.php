<?php
// Pertemuan 2 - contoh4.php

interface BisaDihitung
{
    public function hargaAkhir(): float;
}

class Produk implements BisaDihitung
{
    public function __construct(
        protected string $nama,
        protected float $harga,

        // MODIFIKASI 1: Tambah property stok
        public int $stok = 5
    ) {}

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function getNama(): string
    {
        return $this->nama;
    }
}

class ProdukDiskon extends Produk
{
    public function __construct(
        string $nama,
        float $harga,
        private float $diskon,
        int $stok = 5
    ) {
        parent::__construct($nama, $harga, $stok);
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }
}

$daftar = [
    new Produk('Keyboard', 250000, 10),
    new ProdukDiskon('Mouse', 150000, 10, 8)
];

foreach ($daftar as $produk) {
    // MODIFIKASI 2: Menampilkan informasi stok
    echo $produk->getNama() .
         " (Stok: " . $produk->stok . ")" .
         " - Rp " .
         number_format($produk->hargaAkhir(), 0, ',', '.') .
         "\n";
}
?>