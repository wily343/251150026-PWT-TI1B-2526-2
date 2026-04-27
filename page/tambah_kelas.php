<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Kelas</h1>
        </div>
        </div>
    </div>
    </div>
    <?php
    session_start();
    require_once("../config/koneksi.php");
    //kode otomatis
    $carikode = mysqli_query($koneksi, "select max(Id_kelas) from kelas") or die (mysqli_error());
    $datakode = mysqli_fetch_array($carikode);
    if ($datakode[0] != null) {
        $kode = (int) $datakode[0];
        $kode ++;
        $hasilkode = $kode;
    } else {$hasilkode = 1; }
    $_SESSION["KODE"] = $hasilkode;

    if(isset($_POST['tambah'])){
        $Id_kelas = $_POST['Id_kelas'];
        $Nm_kelas = $_POST['Nm_kelas'];

        $insert = mysqli_query($koneksi, "INSERT INTO kelas values ('$Id_kelas', '$Nm_kelas')");
        if($insert){
            echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert"aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
        }else {
           echo '<div class="alert alert-warning-dismissible">
           <button type="button" class="close" data-dismiss="alert"aria-hidden="true">X</button>
           <h5><i class="icon fas fa-info"></i> Info </h5>
           <h4>Gagal Disimpan</h4></div>';
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
                                <label for="Id_kelas">Id Kelas</label>
                                <input type="text" name="Id_kelas" value="<?=$hasilkode; ?>" placeholder="Id Kelas" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Nm_kelas">Nama Kelas</label>
                                <input type="text" name="Nm_kelas" id="Nm_kelas" placeholder="Nama Kelas" class="form-control">
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>