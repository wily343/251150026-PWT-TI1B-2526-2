<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Mapel</h1>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . "/../config/koneksi.php";

if (isset($_GET['action']) && $_GET['action'] == "hapus" && isset($_GET['Kd'])) {

    $kd = mysqli_real_escape_string($koneksi, $_GET['Kd']);

    $hapus = mysqli_query($koneksi, "DELETE FROM mapel WHERE Kd_mapel='$kd'");

    if ($hapus) {
        echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Data berhasil dihapus.
              </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
    } else {
        echo '<div class="alert alert-danger">
                '.mysqli_error($koneksi).'
              </div>';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <a href="index.php?page=tambah_mapel" class="btn btn-primary btn-sm mb-3">
                    Tambah Mapel
                </a>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Mapel</th>
                            <th>Nama Mapel</th>
                            <th>KKM</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM mapel ORDER BY Kd_mapel ASC");

                    while ($result = mysqli_fetch_assoc($query)) {
                    ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $result['kd_mapel']; ?></td>
                            <td><?= $result['nm_mapel']; ?></td>
                            <td><?= $result['kkm']; ?></td>
                            <td>

                                <a href="index.php?page=edit_mapel&Kd=<?= $result['kd_mapel']; ?>"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="index.php?page=mapel&action=hapus&Kd=<?= $result['kd_mapel']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
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