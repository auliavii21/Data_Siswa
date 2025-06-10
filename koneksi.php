<?php
class database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $db = "sekolah";
    var $koneksi;

    function __construct() {
        $this->koneksi = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->db
        );

        if (!$this->koneksi) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    // Method untuk mendapatkan jumlah siswa
    function get_student_count() {
        $query = "SELECT COUNT(*) as total FROM siswa";
        $result = mysqli_query($this->koneksi, $query);
        if (!$result) {
            die("Query error: " . mysqli_error($this->koneksi));
        }
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    // Method untuk menampilkan data siswa
    function tampil_data_siswa() {
        $query = "SELECT s.idsiswa, s.nisn, s.nama, s.jeniskelamin, 
                         j.singkatan AS namajurusan, s.kelas, s.alamat, 
                         a.namaagama, s.nohp 
                  FROM siswa s
                  JOIN jurusan j ON s.kodejurusan = j.kodejurusan
                  JOIN agama a ON s.agama = a.idagama";
        
        $data = mysqli_query($this->koneksi, $query);
        
        if (!$data) {
            die("Query error: " . mysqli_error($this->koneksi));
        }
        
        $hasil = [];
        while ($row = mysqli_fetch_assoc($data)) {
            $row['jeniskelamin'] = ($row['jeniskelamin'] == 'L') ? 'Laki-laki' : 'Perempuan';
            $hasil[] = $row;
        }
        
        return $hasil;
    }

    // Method untuk menampilkan data jurusan
    function tampil_data_jurusan() {
        $data = mysqli_query($this->koneksi, "SELECT * FROM jurusan");
        $hasil = [];
        while ($row = mysqli_fetch_assoc($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // Method untuk menampilkan data agama
    function tampil_data_agama() {
        $data = mysqli_query($this->koneksi, "SELECT * FROM agama");
        $hasil = [];
        while ($row = mysqli_fetch_assoc($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // Method untuk menambah siswa
    function tambah_siswa($nisn, $nama, $jeniskelamin, $input_jurusan, $kelas, $alamat, $namaagama, $nohp) {
    // Normalisasi input jurusan
    $jurusanInput = strtolower(trim($input_jurusan));
    
    // Cari jurusan dengan LIKE untuk pencarian lebih fleksibel
    $query = mysqli_query($this->koneksi, "
        SELECT kodejurusan FROM jurusan 
        WHERE LOWER(namajurusan) LIKE '%$jurusanInput%'
           OR LOWER(singkatan) LIKE '%$jurusanInput%'
    ");
    
    if (mysqli_num_rows($query) == 0) {
        // Jika jurusan tidak ditemukan, tampilkan daftar jurusan yang tersedia
        $availableJurusan = $this->tampil_data_jurusan();
        $jurusanList = array_map(function($j) {
            return $j['namajurusan'] . " (" . $j['singkatan'] . ")";
        }, $availableJurusan);
        
        throw new Exception("Jurusan tidak ditemukan! Jurusan yang tersedia: " . implode(", ", $jurusanList));
    }
    
    $kodejurusan = mysqli_fetch_assoc($query)['kodejurusan'];
    
    // ... (lanjutan kode untuk agama dan insert siswa)


        // Cek atau tambahkan agama dengan prepared statement untuk menghindari SQL injection
$namaagama = trim($namaagama);  // Bersihkan input
if (empty($namaagama)) {
    throw new Exception("Nama agama tidak boleh kosong");
}

// 1. Cek apakah agama sudah ada
$stmt = $this->koneksi->prepare("SELECT idagama FROM agama WHERE namaagama = ?");
if (!$stmt) {
    throw new Exception("Error preparing statement: " . $this->koneksi->error);
}

$stmt->bind_param("s", $namaagama);
if (!$stmt->execute()) {
    throw new Exception("Error executing query: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Agama sudah ada
    $agama = $result->fetch_assoc();
    $idagama = $agama['idagama'];
    $stmt->close();
} else {
    $stmt->close();
    
    // 2. Jika agama belum ada, tambahkan baru
    $insertStmt = $this->koneksi->prepare("INSERT INTO agama (namaagama) VALUES (?)");
    if (!$insertStmt) {
        throw new Exception("Error preparing insert statement: " . $this->koneksi->error);
    }
    
    $insertStmt->bind_param("s", $namaagama);
    if (!$insertStmt->execute()) {
        throw new Exception("Error inserting agama: " . $insertStmt->error);
    }
    
    $idagama = $insertStmt->insert_id;
    $insertStmt->close();
}

        // Simpan siswa
        $result = mysqli_query($this->koneksi,
            "INSERT INTO siswa (nisn, nama, jeniskelamin, kodejurusan, kelas, alamat, agama, nohp)
             VALUES ('$nisn', '$nama', '$jeniskelamin', '$kodejurusan', '$kelas', '$alamat', '$idagama', '$nohp')");
        
        if (!$result) {
            throw new Exception("Gagal menambah siswa: " . mysqli_error($this->koneksi));
        }
        
        return $result;
    }

    // Method untuk update siswa
    function update_siswa($nisn, $nama, $jeniskelamin, $namajurusan, $kelas, $alamat, $namaagama, $nohp) {
        // Ambil kode jurusan
        $jurusanInput = strtolower(trim(str_replace(' ', '', $namajurusan)));
        $qJurusan = mysqli_query($this->koneksi, "
            SELECT kodejurusan FROM jurusan 
            WHERE LOWER(REPLACE(namajurusan, ' ', '')) = '$jurusanInput'
               OR LOWER(singkatan) = '$jurusanInput'
        ");
        
        if (mysqli_num_rows($qJurusan) > 0) {
            $kodejurusan = mysqli_fetch_assoc($qJurusan)['kodejurusan'];
        } else {
            throw new Exception("Jurusan tidak ditemukan!");
        }

        // Ambil atau tambahkan agama
        $qAgama = mysqli_query($this->koneksi, "SELECT idagama FROM agama WHERE namaagama = '$namaagama'");
        if (mysqli_num_rows($qAgama) > 0) {
            $idagama = mysqli_fetch_assoc($qAgama)['idagama'];
        } else {
            mysqli_query($this->koneksi, "INSERT INTO agama (namaagama) VALUES ('$namaagama')");
            $idagama = mysqli_insert_id($this->koneksi);
        }

        // Lakukan update
        $query = "
            UPDATE siswa SET 
                nama = '$nama',
                jeniskelamin = '$jeniskelamin',
                kodejurusan = '$kodejurusan',
                kelas = '$kelas',
                alamat = '$alamat',
                agama = '$idagama',
                nohp = '$nohp'
            WHERE nisn = '$nisn'
        ";
        
        $result = mysqli_query($this->koneksi, $query);
        
        if (!$result) {
            throw new Exception("Gagal mengupdate siswa: " . mysqli_error($this->koneksi));
        }
        
        return $result;
    }

    // Method untuk menghapus siswa
    function hapus_data_siswa($nisn) {
        $query = "DELETE FROM siswa WHERE nisn = '$nisn'";
        $result = mysqli_query($this->koneksi, $query);
        
        if (!$result) {
            throw new Exception("Gagal menghapus siswa: " . mysqli_error($this->koneksi));
        }
        
        return $result;
    }
}
?>