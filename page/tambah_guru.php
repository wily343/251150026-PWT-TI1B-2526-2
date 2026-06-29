<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['tambah'])) {

    $Kd_guru       = $_POST['Kd_guru'];
    $Nm_guru       = $_POST['Nm_guru'];
    $Jenkel        = $_POST['Jenkel'];
    $Pend_terakhir = $_POST['Pend_terakhir'];
    $Hp            = $_POST['Hp'];
    $Alamat        = $_POST['Alamat'];

    $insert = mysqli_query($koneksi, "
        INSERT INTO guru
        (Kd_guru, Nm_guru, Jenkel, Pend_terakhir, Hp, Alamat)
        VALUES
        ('$Kd_guru','$Nm_guru','$Jenkel','$Pend_terakhir','$Hp','$Alamat')
    ") or die(mysqli_error($koneksi));

    $insertusers = mysqli_query($koneksi, "
        INSERT INTO users
        (Username, Password, Role)
        VALUES
        ('$Kd_guru','1234','guru')
    ") or die(mysqli_error($koneksi));

    if ($insert) {
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5><i class="icon fas fa-check"></i> Berhasil</h5>
            Data Guru berhasil disimpan.
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5><i class="icon fas fa-times"></i> Gagal</h5>
            Data Guru gagal disimpan.
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Form Tambah Data Guru</h3>
            </div>

            <div class="card-body">

                <form method="POST" action="">

                    <div class="form-group">
                        <label>Kode Guru</label>
                        <input type="text" name="Kd_guru" class="form-control" placeholder="Masukkan Kode Guru" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="Nm_guru" class="form-control" placeholder="Masukkan Nama Guru" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="Jenkel" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select name="Pend_terakhir" class="form-control" required>
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SMA">SMA</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="Hp" class="form-control" placeholder="Masukkan Nomor HP" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="Alamat" rows="4" class="form-control" placeholder="Masukkan Alamat" required></textarea>
                    </div>

                    <button type="submit" name="tambah" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>

                    <a href="index.php?page=guru" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                </form>

            </div>
        </div>
    </div>
</section>