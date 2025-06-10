<?php  
include("koneksi.php");
$db = new database();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="dist/assets/img/favicon.png" />
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Simple Tables</title>
    <meta name="title" content="AdminLTE 4 | Simple Tables" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-bell-fill"></i>
                            <span class="navbar-badge badge text-bg-warning">15</span>
                        </a>
                       
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image" />
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2023</small>
                                </p>
                           
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        
        <?php include "sidebar.php"; ?>
        
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6"><h3 class="mb-0">Data Siswa</h3></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container mt-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Siswa</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="tabelSiswa" class="display">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NISN</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Jurusan</th>
                                                    <th>Kelas</th>
                                                    <th>Alamat</th>
                                                    <th>Agama</th>
                                                    <th>No HP</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($db->tampil_data_siswa() as $x) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $x['nisn']; ?></td>
                                                        <td><?php echo $x['nama']; ?></td>
                                                        <td><?php echo $x['jeniskelamin']; ?></td>
                                                        <td><?php echo $x['namajurusan']; ?></td>
                                                        <td><?php echo $x['kelas']; ?></td>
                                                        <td><?php echo $x['alamat']; ?></td>
                                                        <td><?php echo $x['namaagama']; ?></td>
                                                        <td><?php echo $x['nohp']; ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button 
                                                                    type="button" 
                                                                    class="btn btn-warning btn-sm btn-edit"
                                                                    data-nisn="<?php echo $x['nisn']; ?>"
                                                                    data-nama="<?php echo $x['nama']; ?>"
                                                                    data-jk="<?php echo $x['jeniskelamin']; ?>"
                                                                    data-jurusan="<?php echo $x['namajurusan']; ?>"
                                                                    data-kelas="<?php echo $x['kelas']; ?>"
                                                                    data-alamat="<?php echo $x['alamat']; ?>"
                                                                    data-agama="<?php echo $x['namaagama']; ?>"
                                                                    data-nohp="<?php echo $x['nohp']; ?>"
                                                                >
                                                                    Edit
                                                                </button>
                                                                <button 
                                                                    type="button" 
                                                                    class="btn btn-danger btn-sm btn-hapus"
                                                                    data-nisn="<?php echo $x['nisn']; ?>"
                                                                    data-nama="<?php echo $x['nama']; ?>"
                                                                >
                                                                    Hapus
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-2">
                                           <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                              Tambah Data
                                          </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="app-footer">
        
        </footer>
    </div>

    <!-- Script Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="dist/js/adminlte.js"></script>
    
    <script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#tabelSiswa').DataTable();
        
        // Handler untuk tombol hapus
        $(document).on('click', '.btn-hapus', function() {
            const nisn = $(this).data('nisn');
            const nama = $(this).data('nama');
            
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                html: `Anda akan menghapus data siswa <b>${nama}</b> (NISN: ${nisn})`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan penghapusan dengan AJAX
                    $.ajax({
                        url: 'proses.php',
                        type: 'GET',
                        data: {
                            nisn: nisn,
                            aksi: 'hapus'
                        },
                        success: function(response) {
                            // Tampilkan notifikasi sukses
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data siswa berhasil dihapus',
                                icon: 'success'
                            }).then(() => {
                                // Reload halaman setelah penghapusan
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus data',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
        
        // Handler untuk tombol edit
        $(document).on('click', '.btn-edit', function() {
            const data = {
                nisn: $(this).data('nisn'),
                nama: $(this).data('nama'),
                jk: $(this).data('jk'),
                jurusan: $(this).data('jurusan'),
                kelas: $(this).data('kelas'),
                alamat: $(this).data('alamat'),
                agama: $(this).data('agama'),
                nohp: $(this).data('nohp')
            };
            
            // Isi form modal dengan data
            $('#editNISN').val(data.nisn);
            $('#editNama').val(data.nama);
            $('#editJK').val(data.jk);
            $('#editJurusan').val(data.jurusan);
            $('#editKelas').val(data.kelas);
            $('#editAlamat').val(data.alamat);
            $('#editAgama').val(data.agama);
            $('#editNoHP').val(data.nohp);
            
            // Tampilkan modal
            var modal = new bootstrap.Modal(document.getElementById('modalEdit'));
            modal.show();
        });
        
        // Handler untuk form submit edit
        $('#formEditSiswa').on('submit', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Tutup modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modalEdit'));
                    modal.hide();
                    
                    // Tampilkan notifikasi sukses
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data siswa berhasil diperbarui',
                        icon: 'success'
                    }).then(() => {
                        // Reload halaman setelah update
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan data',
                        icon: 'error'
                    });
                }
            });
        });
    });

// Handler form tambah siswa
$('#formTambahSiswa').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'), // proses.php
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            $('#modalTambah').modal('hide');
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data siswa berhasil ditambahkan',
                icon: 'success'
            }).then(() => {
                location.reload();
            });
        },
        error: function() {
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menyimpan data',
                icon: 'error'
            });
        }
    });
});

    </script>
    <!-- Modal Tambah Siswa -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formTambahSiswa" method="POST" action="proses.php">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Tambah Data Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="aksi" value="tambah">

          <div class="form-group mb-3">
            <label for="nisn">NISN</label>
            <input type="text" class="form-control" name="nisn" required placeholder="Masukkan NISN">
          </div>

          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" required placeholder="Masukkan nama lengkap">
          </div>

          <div class="form-group mb-3">
    <label for="jeniskelamin">Jenis Kelamin</label><br>
    <input type="radio" name="jeniskelamin" value="L" <?php echo (isset($data['jeniskelamin']) && $data['jeniskelamin'] == 'L' ? 'checked' : ''); ?> required> Laki-laki
    <input type="radio" name="jeniskelamin" value="P" <?php echo (isset($data['jeniskelamin']) && $data['jeniskelamin'] == 'P' ? 'checked' : ''); ?> required> Perempuan
</div>

          <div class="form-group mb-3">
    <label for="kodejurusan">Jurusan</label>
    <input type="text" class="form-control" name="kodejurusan" id="kodejurusan" value="<?php echo isset($data['kodejurusan']) ? htmlspecialchars($data['kodejurusan']) : ''; ?>" placeholder="Masukkan nama jurusan">
</div>

          <div class="form-group mb-3">
            <label for="kelas">Kelas</label>
            <select class="form-control" name="kelas" required>
              <option value="" disabled selected>Pilih kelas</option>
              <option value="X">X</option>
              <option value="XI">XI</option>
              <option value="XII">XII</option>
            </select>
          </div>

          <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" required placeholder="Masukkan nama kota/kabupaten">
          </div>

          <div class="form-group mb-3">
            <label for="agama">Agama</label>
            <input type="text" class="form-control" name="namaagama" placeholder="Masukkan agama">
          </div>

          <div class="form-group mb-3">
            <label for="nohp">No HP</label>
            <input type="text" class="form-control" name="nohp" required placeholder="Masukkan nomor HP aktif">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah Siswa</button>
        </div>
      </form>
    </div>
  </div>
</div>



    <!-- Modal Edit Siswa -->
    <div class="modal fade" id="modalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formEditSiswa" method="POST" action="proses.php">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="aksi" value="update">
                        <input type="hidden" name="nisn" id="editNISN">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" id="editNama" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jeniskelamin" id="editJK" class="form-select" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Jurusan</label>
                                <input type="text" name="namajurusan" id="editJurusan" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Kelas</label>
                                <select name="kelas" id="editKelas" class="form-select" required>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" id="editAlamat" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Agama</label>
                                <input type="text" name="namaagama" id="editAgama" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="form-label">No HP</label>
                                <input type="text" name="nohp" id="editNoHP" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>