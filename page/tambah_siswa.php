<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Siswa</h1>
        </div>
        </div>
    </div>
    </div>
    <?php
    require_once __DIR__ . "/../config/koneksi.php";

    // kode otomatis
    $carikode = mysqli_query($koneksi, "SELECT MAX(nis) AS kode FROM siswa");
    $datakode = mysqli_fetch_assoc($carikode);

    if (!empty($datakode['kode'])) {
        $nilaikode = substr($datakode['kode'], 3);
        $kode = (int) $nilaikode;
        $kode++;
        $hasilkode = "123" . str_pad($kode, 3, "0", STR_PAD_LEFT);
    } else {
        $hasilkode = "123001";
    }

   if (isset($_POST['tambah'])) {

    $nis       = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nm_siswa  = mysqli_real_escape_string($koneksi, $_POST['nm_siswa']);
    $jenkel    = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $hp        = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $id_kelas  = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);

    // Cek apakah NIS sudah digunakan
    $cek = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");

    if (mysqli_num_rows($cek) > 0) {

        echo '
        <div class="alert alert-danger">
            NIS sudah digunakan.
        </div>';

    } else {

        mysqli_begin_transaction($koneksi);

        try {

            // Simpan ke tabel siswa
            $insert = mysqli_query($koneksi, "
                INSERT INTO siswa
                (
                    nis,
                    nm_siswa,
                    jenkel,
                    hp,
                    id_kelas
                )
                VALUES
                (
                    '$nis',
                    '$nm_siswa',
                    '$jenkel',
                    '$hp',
                    '$id_kelas'
                )
            ");

            if (!$insert) {
                throw new Exception(mysqli_error($koneksi));
            }

            // Password default
            $password = password_hash("1234", PASSWORD_DEFAULT);

            // Simpan akun login
            $insertUser = mysqli_query($koneksi, "
                INSERT INTO users
                (
                    username,
                    password,
                    role
                )
                VALUES
                (
                    '$nis',
                    '$password',
                    'siswa'
                )
            ");

            if (!$insertUser) {
                throw new Exception(mysqli_error($koneksi));
            }

            mysqli_commit($koneksi);

            echo '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                Data siswa berhasil disimpan.<br>
                Username : <b>'.$nis.'</b><br>
                Password : <b>1234</b>
            </div>';

            echo '<meta http-equiv="refresh" content="2;url=index.php?page=siswa">';

        } catch (Exception $e) {

            mysqli_rollback($koneksi);

            echo '
            <div class="alert alert-danger">
                '.$e->getMessage().'
            </div>';

        }

    }

}
?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-body p-2">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="nis">Nis</label>
                                <input type="text" name="nis" value="<?=$hasilkode; ?>" placeholder="nis" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nm_siswa">Nama Siswa</label>
                                <input type="text" name="nm_siswa" id="m_siswa" placeholder="Nama Siswa" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jenkel">Jenis Kelamin</label>
                                <select name="jenkel" id="jenkel" class="form-control">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="hp">No HP</label>
                                <input type="text" name="hp" id="hp" placeholder="No hp" class="form-control">
                            </div>
                            <div class="form-group">
                    <label>Kelas</label>
    <select name="id_kelas" class="form-control" required>
        <option value="">-- Pilih Kelas --</option>
        <?php
        $kelas = mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY nm_kelas ASC");
        while($k = mysqli_fetch_assoc($kelas)){
            echo "<option value='".$k['id_kelas']."'>".$k['nm_kelas']."</option>";
       
            }
        ?>
    </select>
</div>
                            <div class="form-group">
                                <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                                <a href="index.php?page=siswa" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
