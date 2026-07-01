<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php

require_once __DIR__ . "/../config/koneksi.php";

$nis = mysqli_real_escape_string($koneksi, $_GET['nis']);

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
$edit = mysqli_fetch_assoc($query);

if (!$edit) {
    echo "<script>
            alert('Data siswa tidak ditemukan');
            window.location='index.php?page=siswa';
          </script>";
    exit;
}

if (isset($_POST['tambah'])) {

    $nis       = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nm_siswa  = mysqli_real_escape_string($koneksi, $_POST['nm_siswa']);
    $jenkel    = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $hp        = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $id_kelas  = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);

    mysqli_begin_transaction($koneksi);

    try {

        // Update tabel siswa
        $update = mysqli_query($koneksi,"
            UPDATE siswa SET
                nm_siswa='$nm_siswa',
                jenkel='$jenkel',
                hp='$hp',
                id_kelas='$id_kelas'
            WHERE nis='$nis'
        ");

        if (!$update) {
            throw new Exception(mysqli_error($koneksi));
        }

        // Sinkronkan username (aman walaupun NIS readonly)
        $updateUser = mysqli_query($koneksi,"
            UPDATE users
            SET username='$nis'
            WHERE username='".$edit['nis']."'
            AND role='siswa'
        ");

        if (!$updateUser) {
            throw new Exception(mysqli_error($koneksi));
        }

        mysqli_commit($koneksi);

        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h5><i class="icon fas fa-check"></i> Berhasil</h5>
            Data siswa berhasil diubah.
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';

    } catch (Exception $e) {

        mysqli_rollback($koneksi);

        echo '
        <div class="alert alert-danger">
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
                        <label>NIS</label>
                        <input type="text"
                               name="nis"
                               class="form-control"
                               value="<?= $edit['nis']; ?>"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text"
                               name="nm_siswa"
                               class="form-control"
                               value="<?= $edit['nm_siswa']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>

                        <select name="jenkel" class="form-control" required>

                            <option value="L"
                            <?= ($edit['jenkel']=="L") ? "selected" : ""; ?>>
                            Laki-laki
                            </option>

                            <option value="P"
                            <?= ($edit['jenkel']=="P") ? "selected" : ""; ?>>
                            Perempuan
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
                        <label>ID Kelas</label>

                        <input type="text"
                               name="id_kelas"
                               class="form-control"
                               value="<?= $edit['id_kelas']; ?>"
                               required>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                                name="tambah"
                                class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="index.php?page=siswa"
                           class="btn btn-danger">
                            Batal
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>
</section>