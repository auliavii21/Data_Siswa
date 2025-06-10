<?php
include("koneksi.php");
$db = new database();

if (isset($_POST['simpan'])) {
    $db->tambah_jurusan(
        $_POST['kodejurusan'],
        $_POST['namajurusan']
    );
    header("Location:data_jurusan.php");
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jurusan</title>
</head>
<style>
    /* Mengatur tampilan utama */
body {
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
}

/* Style form */
.tambah-form {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
}

/* Style label */
.tambah-form label {
    display: block;
    margin-bottom: 5px;
    text-align: left;
}

/* Style input text */
.tambah-form input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 16px;
}

/* Style tombol submit */
.tambah-btn {
    background-color: #007bff; /* Biru */
    color: white;
    border: none;
    padding: 12px;
    width: 100%;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s ease;
}

.tambah-btn:hover {
    background-color: #0056b3;
}

/* Style untuk judul */
h2 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

</style>
<body>
    <form action="" method="post" class="tambah-form">
        <h2>Tambah Jurusan</h2>
        <label for="namajurusan">Nama Jurusan</label>
        <input type="text" name="namajurusan" id="namajurusan" required>

        <input type="submit" name="simpan" value="Tambah Jurusan" class="tambah-btn">
    </form> 
</body>
</html>
