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
        $query = mysqli_query($koneksi, "DELETE FROM ekstra_2511500026 WHERE id_ekstra026 ='$Id'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">Berhasil di hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_2511500026">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ekstra_2511500026" class="btn btn-primary btn-sm">Tambah ekstrakurikuler</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>nama</th>
                            <th>keterangan</th>
                            <th>semester</th>
                            <th>tahun_ajaran</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500026");
                    while ($result = mysqli_fetch_array($query) ) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?=$result['id_ekstra026']; ?></td>
                                <td><?=$result['nama_ekstra026']; ?></td>
                                <td><?=$result['ket026']; ?></td>
                                <td><?=$result['semester026']; ?></td>
                                <td><?=$result['tahun_ajaran026']; ?></td>
                               <td>
     <a href="index.php?page=ekstra_2511500026&action=hapus&id=<?= $result['id_ekstra026']?>" 
           onclick="return confirm('Yakin hapus?')">
            <span class="badge badge-danger">Hapus</span>
        </a>

        <a href="index.php?page=edit_ekstra_2511500026&id=<?= $result['id_ekstra026']?>">
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