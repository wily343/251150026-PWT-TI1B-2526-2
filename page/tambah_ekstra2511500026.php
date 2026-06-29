<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Ekstrakurikuler</h1>
      </div>
    </div>
  </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_ekstra026']);
    $ket = mysqli_real_escape_string($koneksi, $_POST['ket026']);
    $semester = mysqli_real_escape_string($koneksi, $_POST['semester026']);
    $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran026']);

    $insert = mysqli_query($koneksi, "INSERT INTO  ekstra_2511500026 (nama_ekstra026, ket026, semester026, tahun_ajaran026) VALUES ('$nama', '$ket', '$semester', '$tahun')");
    if($insert) {
        echo '<div class="alert alert-success">Berhasil ditambahkan</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_2511500026">';
        exit;
    } else {
        echo '<div class="alert alert-danger">Gagal: '.mysqli_error($koneksi).'</div>';
    }
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>Nama Ekstra</label>
            <input type="text" name="nama_ekstra026" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="ket026" class="form-control">
          </div>
          <div class="form-group">
            <label>Semester</label>
            <input type="text" name="semester026" class="form-control">
          </div>
          <div class="form-group">
            <label>Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran026" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="index.php?page=ekstra_2511500026" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>