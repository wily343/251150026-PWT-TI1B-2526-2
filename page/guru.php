<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Guru</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus" && isset($_GET['Kd'])) {
        $Kd =$_GET['Kd'];
        $query = mysqli_query($koneksi, "DELETE FROM guru WHERE Kd_guru ='$Kd'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil di hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_guru" class="btn btn-primary btn-sm">Tambah Guru</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kd Guru</th>
                            <th>Id Guru</th>
                            <th>Nama Guru</th>
                            <th>Jenis Kelamin</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Nomor Hp</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM guru");
                    while ($result = mysqli_fetch_array($query) ) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?=$result['Kd_guru']; ?></td>
                                <td><?=$result['Id_guru']; ?></td>
                                <td><?=$result['Nm_guru']; ?></td>
                                <td><?=$result['Jenkel']; ?></td>
                                <td><?=$result['Pend_terakhir']; ?></td>
                                <td><?=$result['Hp']; ?></td>
                                <td><?=$result['Alamat']; ?></td>
                                <td>
                                    <a href="index.php?page=guru&action=hapus&Kd=<?= $result['Kd_guru']?>" title="">
                                        <span class="badge badge-danger">Hapus</span></a>
                                    <a href ="index.php?page=edit_guru&Kd=<?= $result['Kd_guru']?>" title="">
                                        <span class="badge badge-warning">Edit</span></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  