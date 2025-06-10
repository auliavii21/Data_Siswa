<?php
include("koneksi.php");
$db = new database();

// Ambil data jurusan dan agama untuk dropdown
$jurusan = $db->tampil_data_jurusan();
$agama = $db->tampil_data_agama();
?>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formTambahSiswa" method="POST" action="proses.php">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Siswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="aksi" value="tambah">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" required 
                                   pattern="[0-9]{10}" title="NISN harus 10 digit angka">
                            <div class="invalid-feedback">Harap masukkan NISN yang valid (10 digit angka)</div>
                        </div>
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="jkLaki" value="Laki-laki" required>
                                <label class="form-check-label" for="jkLaki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="jkPerempuan" value="Perempuan">
                                <label class="form-check-label" for="jkPerempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="" selected disabled>Pilih Kelas</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" id="jurusan" name="namajurusan" required>
                                <option value="" selected disabled>Pilih Jurusan</option>
                                <?php foreach ($jurusan as $j): ?>
                                <option value="<?php echo htmlspecialchars($j['namajurusan']); ?>">
                                    <?php echo htmlspecialchars($j['namajurusan']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-select" id="agama" name="namaagama" required>
                                <option value="" selected disabled>Pilih Agama</option>
                                <?php foreach ($agama as $a): ?>
                                <option value="<?php echo htmlspecialchars($a['namaagama']); ?>">
                                    <?php echo htmlspecialchars($a['namaagama']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="nohp" class="form-label">Nomor HP</label>
                        <input type="tel" class="form-control" id="nohp" name="nohp" 
                               pattern="[0-9]{10,13}" title="Nomor HP harus 10-13 digit angka">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Validasi form sebelum submit
document.getElementById('formTambahSiswa').addEventListener('submit', function(event) {
    let isValid = true;
    const inputs = this.querySelectorAll('input[required], select[required], textarea[required]');
    
    inputs.forEach(input => {
        if (!input.value) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });

    if (!isValid) {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Harap isi semua field yang wajib diisi!'
        });
    }
});
</script>