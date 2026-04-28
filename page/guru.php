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
require_once __DIR__ . "/../config/koneksi.php";
if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus" && isset($_GET['Kd'])) {
        $Kd = mysqli_real_escape_string($koneksi, $_GET['Kd']);
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
                            <th>id guru</th>
                            <th>nip</th>
                            <th>nama_guru</th>
                            <th>jenis_kelamin</th>
                            <th>alamat</th>
                            <th>no_hp</th>
                            <th>email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM guru");
                    while ($result = mysqli_fetch_array($query) ) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no;?></td>
                            <td><?=$result['id_guru']; ?></td>
                            <td><?=$result['nip']; ?></td>
                            <td><?=$result['nama_guru']; ?></td>
                            <td><?=$result['jenis_kelamin']; ?></td>
                            <td><?=$result['alamat']; ?></td>
                            <td><?=$result['no_hp']; ?></td>
                            <td><?=$result['email']; ?></td>
                            <td>
                            <td>
                                <a href="index.php?page=guru&action=hapus&Kd=<?= $result['Kd_guru']?>" title="">
                                    <span class="badge badge-danger">Hapus</span></a>
                                <a href ="index.php?page=edit_guru&Kd=<?= $result['Kd_guru']?>" title="">
                                    <span class="badge badge-warning">Edit</span></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  