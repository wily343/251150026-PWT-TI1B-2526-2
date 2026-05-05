<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data ekstrakurikuler</h1>
      </div>
    </div>
  </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";
if(isset($_GET['action']) && isset($_GET['id'])) {
    if($_GET['action'] == "hapus") {
        $Id = $_GET['id'];
        $query = mysqli_query($koneksi, "DELETE FROM ekstrakurikuler WHERE id_ekstrakurikuler ='$Id'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">Berhasil di hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstrakurikuler">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ekstrakurikuler" class="btn btn-primary btn-sm">Tambah ekstrakurikuler</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>id</th>
                            <th>nama</th>
                            <th>jenis_kelamin</th>
                            <th>tanggal_lahir</th>
                            <th>alamat</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler");
                    while ($result = mysqli_fetch_array($query) ) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?=$result['id_ekstrakurikuler']; ?></td>
                                <td><?=$result['nama']; ?></td>
                                <td><?=$result['jenis_kelamin']; ?></td>
                                <td><?=$result['tanggal_lahir']; ?></td>
                                <td><?=$result['alamat']; ?></td>
                               <td>
     <a href="index.php?page=ekstrakurikuler&action=hapus&id=<?= $result['id_ekstrakurikuler']?>" 
           onclick="return confirm('Yakin hapus?')">
            <span class="badge badge-danger">Hapus</span>
        </a>

        <a href="index.php?page=edit_ekstrakurikuler&id=<?= $result['id_ekstrakurikuler']?>">
            <span class="badge badge-warning">Edit</span>
        </a>
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