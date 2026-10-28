
<?php
class ProdukModel
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    // Menampilkan semua data produk
    public function semua()
    {
        $query = "SELECT * FROM produk ORDER BY id DESC";
        $hasil = mysqli_query($this->koneksi, $query);

        $data = [];

        while ($row = mysqli_fetch_assoc($hasil)) {
            $data[] = $row;
        }

        return $data;
    }

    // Mencari produk berdasarkan ID
    public function cari($id)
    {
        $query = "SELECT * FROM produk WHERE id = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);
        $produk = mysqli_fetch_assoc($hasil);

        mysqli_stmt_close($stmt);

        return $produk;
    }

    // Menambahkan produk baru
    public function tambah($nama, $harga, $stok)
    {
        $query = "INSERT INTO produk (nama_produk, harga, stok)
                  VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sdi", $nama, $harga, $stok);

        $hasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $hasil;
    }

    // Mengubah data produk
    public function ubah($id, $nama, $harga, $stok)
    {
        $query = "UPDATE produk
                  SET nama_produk = ?, harga = ?, stok = ?
                  WHERE id = ?";

        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param(
            $stmt,
            "sdii",
            $nama,
            $harga,
            $stok,
            $id
        );

        $hasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $hasil;
    }

    // Menghapus produk
    public function hapus($id)
    {
        $query = "DELETE FROM produk WHERE id = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);

        $hasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $hasil;
    }
}
?>
