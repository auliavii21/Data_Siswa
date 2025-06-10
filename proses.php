<?php
include("koneksi.php");
$db = new database();

try {
    // Hapus siswa
    if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus" && isset($_GET['nisn'])) {
        $nisn = $_GET['nisn'];
        $db->hapus_data_siswa($nisn);
        header("Location: index.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['aksi'])) {
            $aksi = $_POST['aksi'];

            // Konversi Jenis Kelamin ke format database (L/P)
            $jeniskelamin = $_POST['jeniskelamin'];

            if ($aksi == "tambah") {
                $db->tambah_siswa(
                    $_POST['nisn'],
                    $_POST['nama'],
                    $jeniskelamin,
                    $_POST['kodejurusan'],
                    $_POST['kelas'],
                    $_POST['alamat'],
                    $_POST['namaagama'],
                    $_POST['nohp']
                );
                header("Location: index.php");
                exit();
            }

            if ($aksi == "update") {
                $db->update_siswa(
                    $_POST['nisn'],
                    $_POST['nama'],
                    $jeniskelamin,
                    $_POST['kodejurusan'],
                    $_POST['kelas'],
                    $_POST['alamat'],
                    $_POST['namaagama'],
                    $_POST['nohp']
                );
                header("Location: index.php");
                exit();
            }
        }
    }
} catch (Exception $e) {
    // Tangani error dengan menampilkan pesan ke user
    echo "<script>
            alert('Terjadi kesalahan: " . addslashes($e->getMessage()) . "');
            window.history.back();
          </script>";
    exit();
}
?>