<?php
include("koneksi.php");
$db = new database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Agama</title>
</head>
<body>
    <h2>Data Agama</h2>
    <table border="1">
        <tr>
            <th>Id Agama</th>
            <th>Nama Agama</th>
            <th>Opsi</th>
        </tr>
        <?php
        foreach ($db->tampil_data_agama() as $x) {
        ?>
            <tr>
                <td><?php echo $x['idagama']; ?></td>
                <td><?php echo $x['namaAgama']; ?></td>
                <td>
                    <a href="edit_agama.php?idagama=<?php echo $x['idagama']; ?>&aksi=edit">Edit</a>
                    <a href="proses.php?idagama=<?php echo $x['idagama']; ?>&aksi=hapus">Hapus</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <a href="tambah_agama.php">Tambah Data</a>