<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Informasi</h1>
      </div>
    </div>
  </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";
if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $Id = '';
    if (isset($_GET['Kd'])) {
        $Id = $_GET['Kd'];
    } elseif (isset($_GET['Id'])) {
        $Id = $_GET['Id'];
    }

    $query = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas='$Id'");

if ($query) {
    echo "<script>
            alert('Data berhasil dihapus');
            window.location='index.php?page=kelas';
          </script>";
    exit;
} else {
    die(mysqli_error($koneksi));
}
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_kelas" class="btn btn-primary btn-sm">Tambah Kelas</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                    while ($result = mysqli_fetch_array($query) ) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no;?></td>
                            <td><?=$result['id_kelas']; ?></td>
                            <td><?=$result['nm_kelas']; ?></td>
                            <td>
                               <a href="index.php?page=kelas&action=hapus&Kd=<?= $result['id_kelas']; ?>"
                              class="btn btn-danger btn-sm"
                                  onclick="return confirm('Yakin ingin menghapus data ini?')">
                                      Hapus
                                </a>
                                <a href="index.php?page=edit_kelas&Kd=<?= $result['id_kelas']?>" title="">
                                    <span class="badge badge-warning">Edit</span>
                                </a>
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
</div>  