<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";

$kd = '';
if (isset($_GET['Kd'])) {
    $kd = $_GET['Kd'];
} elseif (isset($_GET['kd'])) {
    $kd = $_GET['kd'];
} elseif (isset($_GET['id'])) {
    $kd = $_GET['id'];
}

if (!$kd) {
    echo "<script>
            alert('Parameter guru tidak ditemukan!');
            window.location='index.php?page=guru';
          </script>";
    exit;
}

$kd = mysqli_real_escape_string($koneksi, $kd);
$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru='$kd'");
$edit = mysqli_fetch_assoc($query);

if (!$edit) {
    echo "<script>
            alert('Data Guru tidak ditemukan!');
            window.location='index.php?page=guru';
          </script>";
    exit;
}

if (isset($_POST['tambah'])) {

    $kd_guru       = mysqli_real_escape_string($koneksi, $_POST['kd_guru']);
    $nm_guru       = mysqli_real_escape_string($koneksi, $_POST['nm_guru']);
    $jenkel        = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $pend_terakhir = mysqli_real_escape_string($koneksi, $_POST['pend_terakhir']);
    $hp            = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    mysqli_begin_transaction($koneksi);

    try {

        // Update tabel guru
        $update = mysqli_query($koneksi, "
            UPDATE guru SET
                Nm_guru='$nm_guru',
                Jenkel='$jenkel',
                Pend_terakhir='$pend_terakhir',
                Hp='$hp',
                Alamat='$alamat'
            WHERE Kd_guru='$kd_guru'
        ");

        if (!$update) {
            throw new Exception(mysqli_error($koneksi));
        }

        // Update username di tabel users (aman walaupun kd_guru readonly)
        $updateUser = mysqli_query($koneksi, "
            UPDATE users
            SET username='$kd_guru'
            WHERE username='$kd'
            AND role='guru'
        ");

        if (!$updateUser) {
            throw new Exception(mysqli_error($koneksi));
        }

        mysqli_commit($koneksi);

        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h5><i class="icon fas fa-check"></i> Berhasil</h5>
            Data Guru berhasil diubah.
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';

    } catch (Exception $e) {

        mysqli_rollback($koneksi);

        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h5><i class="icon fas fa-times"></i> Gagal</h5>
            '.$e->getMessage().'
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
                        <label>Kode Guru</label>
                        <input type="text"
                               name="kd_guru"
                               class="form-control"
                               value="<?= $edit['kd_guru']; ?>"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text"
                               name="nm_guru"
                               class="form-control"
                               value="<?= $edit['nm_guru']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenkel" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>

                            <option value="Laki-laki"
                            <?= ($edit['jenkel']=="Laki-laki") ? "selected" : ""; ?>>
                            Laki-laki
                            </option>

                            <option value="Perempuan"
                            <?= ($edit['jenkel']=="Perempuan") ? "selected" : ""; ?>>
                            Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select name="pend_terakhir" class="form-control" required>

                            <option value="SMA"
                            <?= ($edit['pend_terakhir']=="SMA") ? "selected" : ""; ?>>
                            SMA
                            </option>

                            <option value="D3"
                            <?= ($edit['pend_terakhir']=="D3") ? "selected" : ""; ?>>
                            D3
                            </option>

                            <option value="S1"
                            <?= ($edit['pend_terakhir']=="S1") ? "selected" : ""; ?>>
                            S1
                            </option>

                            <option value="S2"
                            <?= ($edit['pend_terakhir']=="S2") ? "selected" : ""; ?>>
                            S2
                            </option>

                            <option value="S3"
                            <?= ($edit['pend_terakhir']=="S3") ? "selected" : ""; ?>>
                            S3
                            </option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text"
                               name="hp"
                               class="form-control"
                               value="<?= $edit['hp']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat"
                                  class="form-control"
                                  rows="3"
                                  required><?= $edit['alamat']; ?></textarea>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="tambah" class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="index.php?page=guru" class="btn btn-danger">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</section>
