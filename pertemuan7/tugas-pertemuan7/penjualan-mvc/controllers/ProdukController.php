
<?php
require_once __DIR__ . '/../models/ProdukModel.php';

class ProdukController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new ProdukModel($koneksi);
    }

    public function jalankan()
    {
        $aksi = $_GET['aksi'] ?? 'index';

        switch ($aksi) {
            case 'create':
                require __DIR__ . '/../views/produk/create.php';
                break;

            case 'simpan':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama = trim($_POST['nama_produk'] ?? '');
                    $harga = $_POST['harga'] ?? '';
                    $stok = $_POST['stok'] ?? '';

                    if (
                        $nama !== '' &&
                        is_numeric($harga) &&
                        $harga >= 0 &&
                        filter_var($stok, FILTER_VALIDATE_INT) !== false &&
                        $stok >= 0
                    ) {
                        $this->model->tambah($nama, $harga, $stok);
                        header('Location: index.php');
                        exit;
                    }

                    die("Data produk tidak valid.");
                }
                break;

            case 'edit':
                $id = (int) ($_GET['id'] ?? 0);
                $produk = $this->model->cari($id);

                if (!$produk) {
                    die("Produk tidak ditemukan.");
                }

                require __DIR__ . '/../views/produk/edit.php';
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = (int) ($_POST['id'] ?? 0);
                    $nama = trim($_POST['nama_produk'] ?? '');
                    $harga = $_POST['harga'] ?? '';
                    $stok = $_POST['stok'] ?? '';

                    if (
                        $id > 0 &&
                        $nama !== '' &&
                        is_numeric($harga) &&
                        $harga >= 0 &&
                        filter_var($stok, FILTER_VALIDATE_INT) !== false &&
                        $stok >= 0
                    ) {
                        $this->model->ubah($id, $nama, $harga, $stok);
                        header('Location: index.php');
                        exit;
                    }

                    die("Data produk tidak valid.");
                }
                break;

            case 'hapus':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = (int) ($_POST['id'] ?? 0);

                    if ($id > 0) {
                        $this->model->hapus($id);
                    }

                    header('Location: index.php');
                    exit;
                }
                break;

            default:
                $produk = $this->model->semua();
                require __DIR__ . '/../views/produk/index.php';
                break;
        }
    }
}
?>
