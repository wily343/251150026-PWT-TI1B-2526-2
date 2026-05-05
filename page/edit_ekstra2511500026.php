<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Ekstrakurikuler</h1>
      </div>
    </div>
  </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";
if(!isset($_GET['id'])) {
    echo 'ID tidak ditemukan';
    exit;
}
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$cek = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500026 WHERE id_ekstra026 = '$id'");
if(mysqli_num_rows($cek) == 0) {
    echo 'Data tidak ditemukan';
    exit;
}
$data = mysqli_fetch_assoc($cek);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $ket = mysqli_real_escape_string($koneksi, $_POST['ket']);
    $semester = mysqli_real_escape_string($koneksi, $_POST['semester']);
    $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun']);

    $update = mysqli_query($koneksi, "UPDATE ekstra_2511500026 SET nama_ekstra026='$nama', ket026='$ket', semester026='$semester', tahun_ajaran026='$tahun' WHERE id_ekstra026='$id'");
    if($update) {
        echo '<div class="alert alert-success">Berhasil diupdate</div>';
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
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama_ekstra026']) ?>" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="ket" class="form-control" value="<?= htmlspecialchars($data['ket026']) ?>">
          </div>
          <div class="form-group">
            <label>Semester</label>
            <input type="text" name="semester" class="form-control" value="<?= htmlspecialchars($data['semester026']) ?>">
          </div>
          <div class="form-group">
            <label>Tahun Ajaran</label>
            <input type="text" name="tahun" class="form-control" value="<?= htmlspecialchars($data['tahun_ajaran026']) ?>">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="index.php?page=ekstra_2511500026" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>