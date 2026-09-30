<?php
// Pertemuan 2 - contoh3.php

interface Identitas
{
    public function ringkasan(): string;
}

class Mahasiswa implements Identitas
{
    private string $nim;
    private string $nama;
    protected float $ipk;

    // MODIFIKASI 1: Tambah property jurusan
    private string $jurusan;

    public function __construct(
        string $nim,
        string $nama,
        float $ipk,
        string $jurusan = 'IF'
    ) {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->setIpk($ipk);
        $this->jurusan = $jurusan;
    }

    public function setIpk(float $ipk): void
    {
        if ($ipk < 0 || $ipk > 4) {
            throw new InvalidArgumentException('IPK harus 0 sampai 4.');
        }

        $this->ipk = $ipk;
    }

    public function ringkasan(): string
    {
        // MODIFIKASI 2: Tambah jurusan pada output
        return $this->nim . " - " .
               $this->nama . " (" .
               $this->jurusan . ") - IPK: " .
               $this->ipk;
    }
}

$mhs = new Mahasiswa(
    '4524210121',
    'Ernan Wanasakti',
    3.75,
    'Teknik Informatika'
);

echo $mhs->ringkasan();
?>