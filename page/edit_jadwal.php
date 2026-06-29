<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";
$Id_jadwal = $_GET['Id_jadwal'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Id_jadwal='$Id_jadwal'"));

if(isset($_POST['tambah'])){
    $Id_jadwal = $_POST['Id_jadwal'];
    $kd_mapel = $_POST['Kd_mapel'];
    $kd_guru = $_POST['Kd_guru'];
    $tahun_ajaran = $_POST['Tahun_ajaran'];
    $hari = $_POST['Hari'];
    $jam_mulai = $_POST['Jam_mulai'];
    $jam_selesai = $_POST['Jam_selesai'];

    $insert = mysqli_query($koneksi, "UPDATE jadwal SET Kd_mapel='$kd_mapel', Kd_guru='$kd_guru', Tahun_ajaran='$tahun_ajaran', Hari='$hari', Jam_mulai='$jam_mulai', Jam_selesai='$jam_selesai' WHERE Id_jadwal='$Id_jadwal'");
    if($insert){
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"aria-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
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
                            <label for="Id_jadwal">Id Jadwal</label>
                            <input type="text" name="Id_jadwal" value="<?=$edit['Id_jadwal']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Kd_mapel">Kode Mata Pelajaran</label>
                            <input type="text" name="Kd_mapel" value="<?=$edit['Kd_mapel']; ?>" id="Kd_mapel" placeholder="Kode Mata Pelajaran" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Kd_guru">Kode Guru</label>
                            <input type="text" name="Kd_guru" value="<?=$edit['Kd_guru']; ?>" id="Kd_guru" placeholder="Kode Guru" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Tahun_ajaran">Tahun Ajaran</label>
                            <input type="text" name="Tahun_ajaran" value="<?=$edit['Tahun_ajaran']; ?>" id="Tahun_ajaran" placeholder="Tahun Ajaran" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Hari">Hari</label>
                            <input type="text" name="Hari" value="<?=$edit['Hari']; ?>" id="Hari" placeholder="Hari" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Jam_mulai">Jam Mulai</label>
                            <input type="time" name="Jam_mulai" value="<?=$edit['Jam_mulai']; ?>" id="Jam_mulai" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Jam_selesai">Jam Selesai</label>
                            <input type="time" name="Jam_selesai" value="<?=$edit['Jam_selesai']; ?>" id="Jam_selesai" class="form-control">
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>