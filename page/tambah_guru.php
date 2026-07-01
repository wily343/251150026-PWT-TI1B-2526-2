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

if(isset($_POST['tambah'])){

    $Kd_guru       = mysqli_real_escape_string($koneksi,$_POST['kd_guru']);
    $Nm_guru       = mysqli_real_escape_string($koneksi,$_POST['nm_guru']);
    $Jenkel        = mysqli_real_escape_string($koneksi,$_POST['jenkel']);
    $Pend_terakhir = mysqli_real_escape_string($koneksi,$_POST['pend_terakhir']);
    $Hp            = mysqli_real_escape_string($koneksi,$_POST['hp']);
    $Alamat        = mysqli_real_escape_string($koneksi,$_POST['alamat']);

    //cek kode guru
    $cek = mysqli_query($koneksi,"SELECT * FROM guru WHERE Kd_guru='$Kd_guru'");

    if(mysqli_num_rows($cek)>0){

        echo "
        <div class='alert alert-danger'>
            Kode Guru sudah digunakan.
        </div>";

    }else{

        mysqli_begin_transaction($koneksi);

        try{

            $insert = mysqli_query($koneksi,"
            INSERT INTO guru
            (
                kd_guru,
                Nm_guru,
                Jenkel,
                Pend_terakhir,
                Hp,
                Alamat
            )
            VALUES
            (
                '$Kd_guru',
                '$Nm_guru',
                '$Jenkel',
                '$Pend_terakhir',
                '$Hp',
                '$Alamat'
            )");

            if(!$insert){
                throw new Exception(mysqli_error($koneksi));
            }

            //ambil id guru yang baru disimpan
            $id_guru = mysqli_insert_id($koneksi);

            //password default
       // Password default
$password = password_hash("1234", PASSWORD_DEFAULT);

$insertUser = mysqli_query($koneksi,"
INSERT INTO users
(
    username,
    password,
    role
)
VALUES
(
    '$kd_guru',
    '$password',
    'guru'
)");
            mysqli_commit($koneksi);

            echo "
            <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                <h5><i class='icon fas fa-check'></i> Berhasil</h5>
                Data Guru berhasil disimpan.<br>
                Username : <b>$kd_guru</b><br>
                Password : <b>1234</b>
            </div>";

            echo "<meta http-equiv='refresh' content='2;url=index.php?page=guru'>";

        }catch(Exception $e){

            mysqli_rollback($koneksi);

            echo "
            <div class='alert alert-danger'>
                ".$e->getMessage()."
            </div>";

        }

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
                        <input type="text" name="kd_guru" class="form-control" placeholder="Masukkan Kode Guru" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="nm_guru" class="form-control" placeholder="Masukkan Nama Guru" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenkel" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select name="pend_terakhir" class="form-control" required>
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
                        <input type="text" name="hp" class="form-control" placeholder="Masukkan Nomor HP" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="4" class="form-control" placeholder="Masukkan Alamat" required></textarea>
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