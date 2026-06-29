<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Siswa</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus") {
        $Nis =$_GET['Nis'];
        $query = mysqli_query($koneksi, "DELETE FROM siswa WHERE Nis ='$Nis'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil di hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_siswa" class="btn btn-primary btn-sm">Tambah Siswa</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama Siswa</th>
                            <th>jenis kelamin</th>
                            <th>Hp</th>
                            <th>Id Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM siswa");
                    while ($result = mysqli_fetch_array($query) ) {
                        $no++
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?=$result['nis']; ?></td>
                                <td><?=$result['nm_siswa']; ?></td>
                                <td><?=$result['jenkel']; ?></td>
                                <td><?=$result['hp']; ?></td>
                                <td><?=$result['id_kelas']; ?></td>

                                <td>
                                    <a href="index.php?page=siswa&action=hapus&Nis=<?= $result['nis']?>" title="">
                                        <span class="badge badge-danger">Hapus</span></a>
                                    <a href ="index.php?page=edit_siswa&Nis=<?= $result['nis']?>" title="">
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