<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Mata Pelajaran</h1>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";

$kd = isset($_GET['kd']) ? mysqli_real_escape_string($koneksi, $_GET['kd']) : '';

$query = mysqli_query($koneksi, "SELECT * FROM mapel WHERE kd_mapel='$kd'");
$edit = mysqli_fetch_assoc($query);

if(isset($_POST['tambah'])){

    $original_kode = mysqli_real_escape_string($koneksi, $_POST['original_kode']);
    $kode_mapel    = mysqli_real_escape_string($koneksi, $_POST['kd_mapel']);
    $nama_mapel    = mysqli_real_escape_string($koneksi, $_POST['nm_mapel']);
    $kkm           = mysqli_real_escape_string($koneksi, $_POST['kkm']);

    $update = mysqli_query($koneksi,"
        UPDATE mapel
        SET
            kd_mapel = '$kode_mapel',
            nm_mapel = '$nama_mapel',
            kkm = '$kkm'
        WHERE kd_mapel = '$original_kode'
    ");

    if($update){
        echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data berhasil diubah.
              </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
    }else{
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
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

                <form method="POST" action="">

                    <input type="hidden" name="original_kode" value="<?= $edit['kd_mapel']; ?>">

                    <div class="form-group">
                        <label>Kode Mapel</label>
                        <input type="text"
                               name="Kd_mapel"
                               class="form-control"
                               value="<?= $edit['kd_mapel']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Nama Mapel</label>
                        <input type="text"
                               name="nm_mapel"
                               class="form-control"
                               value="<?= $edit['nm_mapel']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>KKM</label>
                        <input type="number"
                               name="kkm"
                               class="form-control"
                               value="<?= $edit['kkm']; ?>"
                               required>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="tambah" class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="index.php?page=mapel" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>