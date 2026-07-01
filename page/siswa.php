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
require_once __DIR__ . "/../config/koneksi.php";

if (isset($_GET['action'])) {

    if ($_GET['action'] == "hapus" && isset($_GET['nis'])) {

        $nis = mysqli_real_escape_string($koneksi, $_GET['nis']);

        // Hapus akun login siswa
        mysqli_query($koneksi, "
            DELETE FROM users
            WHERE username='$nis'
            AND role='siswa'
        ");

        // Hapus data siswa
        $query = mysqli_query($koneksi, "
            DELETE FROM siswa
            WHERE nis='$nis'
        ");

        if ($query) {

            echo '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5><i class="icon fas fa-trash"></i> Berhasil</h5>
                Data siswa berhasil dihapus.
            </div>';

            echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';

        } else {

            echo '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5><i class="icon fas fa-times"></i> Gagal</h5>
                '.mysqli_error($koneksi).'
            </div>';

        }

    }

}
?>

<div class="content">
    <div class="container-fluid">

        <div class="card">

            <div class="card-body">

                <a href="index.php?page=tambah_siswa" class="btn btn-primary btn-sm mb-3">
                    Tambah Siswa
                </a>

                <table class="table table-striped table-bordered">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>ID Kelas</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php

                    $no = 1;

                    $query = mysqli_query($koneksi,"
                        SELECT *
                        FROM siswa
                        ORDER BY nis ASC
                    ");

                    while($result = mysqli_fetch_assoc($query)){

                    ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td><?= $result['nis']; ?></td>

                            <td><?= $result['nm_siswa']; ?></td>

                            <td><?= $result['jenkel']; ?></td>

                            <td><?= $result['hp']; ?></td>

                            <td><?= $result['id_kelas']; ?></td>

                            <td>

                                <a href="index.php?page=edit_siswa&nis=<?= $result['nis']; ?>"
                                   class="badge badge-warning">
                                    Edit
                                </a>

                                <a href="index.php?page=siswa&action=hapus&nis=<?= $result['nis']; ?>"
                                   class="badge badge-danger"
                                   onclick="return confirm('Yakin ingin menghapus data siswa beserta akun login?')">
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