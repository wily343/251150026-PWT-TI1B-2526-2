<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Mapel</h1>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";


if (isset($_POST['tambah'])) {

   $kode_mapel = mysqli_real_escape_string($koneksi, $_POST['kd_mapel'] ?? '');
$nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nm_mapel'] ?? '');
$kkm = mysqli_real_escape_string($koneksi, $_POST['kkm'] ?? '');

    $insert = mysqli_query($koneksi, "INSERT INTO mapel (kd_mapel, nm_mapel, kkm)
        VALUES ('$kode_mapel', '$nama_mapel', '$kkm')
    ");

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data mapel berhasil disimpan.
              </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-times"></i> Gagal</h5>
                '.mysqli_error($koneksi).'
              </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form method="POST">

                    <div class="form-group">
                        <label>Kode Mapel</label>
                        <input type="text" name="kd_mapel" class="form-control" placeholder="Masukkan Kode Mapel" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Mapel</label>
                        <input type="text" name="nm_mapel" class="form-control" placeholder="Masukkan Nama Mapel" required>
                    </div>

                    <div class="form-group">
                        <label>KKM</label>
                        <input type="number" name="kkm" class="form-control" placeholder="Masukkan KKM" required>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="tambah" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>