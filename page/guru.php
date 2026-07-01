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

if (isset($_GET['action'])) {

    if ($_GET['action'] == "hapus" && isset($_GET['Kd'])) {

        $Kd = mysqli_real_escape_string($koneksi, $_GET['Kd']);

        // Hapus akun login guru
        mysqli_query($koneksi, "DELETE FROM users WHERE username='$Kd' AND role='guru'");

        // Hapus data guru
        $query = mysqli_query($koneksi, "DELETE FROM guru WHERE Kd_guru='$Kd'");

        if ($query) {

            echo '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5><i class="icon fas fa-trash"></i> Berhasil</h5>
                Data Guru berhasil dihapus.
            </div>';

            echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
        } else {

            echo '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5><i class="icon fas fa-times"></i> Gagal</h5>
                Data Guru gagal dihapus.
            </div>';

        }

    }

}
?>

<div class="content">
    <div class="container-fluid">

        <div class="card">

            <div class="card-body">

                <a href="index.php?page=tambah_guru" class="btn btn-primary btn-sm mb-3">
                    Tambah Guru
                </a>

                <table class="table table-striped table-bordered">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Guru</th>
                            <th>Nama Guru</th>
                            <th>Jenis Kelamin</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Nomor HP</th>
                            <th>Alamat</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        $no = 1;

                        $query = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY Kd_guru ASC");

                        while ($result = mysqli_fetch_assoc($query)) {

                        ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td><?= $result['kd_guru']; ?></td>

                            <td><?= $result['nm_guru']; ?></td>

                            <td><?= $result['jenkel']; ?></td>

                            <td><?= $result['pend_terakhir']; ?></td>

                            <td><?= $result['hp']; ?></td>

                            <td><?= $result['alamat']; ?></td>

                            <td>

                                <a href="index.php?page=edit_guru&Kd=<?= $result['kd_guru']; ?>"
                                   class="badge badge-warning"
                                   onclick="return confirm('Edit data guru ini?')">
                                    Edit
                                </a>

                                <a href="index.php?page=guru&action=hapus&Kd=<?= $result['kd_guru']; ?>"
                                   class="badge badge-danger"
                                   onclick="return confirm('Yakin ingin menghapus data guru beserta akun login?')">
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