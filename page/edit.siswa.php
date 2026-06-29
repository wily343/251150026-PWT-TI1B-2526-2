<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php

$Nis = $_GET['Nis'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE Nis='$Nis'"));

if(isset($_POST['tambah'])){
    $Nis = $_POST['Nis'];
    $Nm_siswa = $_POST['Nm_siswa'];
    $Jenkel = $_POST['Jenkel'];
    $Hp = $_POST['Hp'];
    $Id_kelas = $_POST['Id_kelas'];

    $insert = mysqli_query($koneksi, "UPDATE siswa SET Nm_siswa='$Nm_siswa', Jenkel='$Jenkel' WHERE Nis='$Nis'");
    if($insert){
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"aria-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
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
                            <label for="Nis">Nis</label>
                            <input type="text" name="Nis" value="<?=$edit['Nis']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Nm_siswa">Nama Siswa</label>
                            <input type="text" name="Nm_siswa" value="<?=$edit['Nm_siswa']; ?>" id="Nm_siswa" placeholder="Nama Siswa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Jenkel">Jenis Kelamin</label>
                            <input type="text" name="Jenkel" value="<?=$edit['Jenkel']; ?>" id="Jenkel" placeholder="Jenis Kelamin" class="form-control">
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