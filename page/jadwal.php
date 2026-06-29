<?php
// =======================
// HAPUS DATA
// =======================
if (isset($_GET['hapus'])) {

    $id_jadwal = mysqli_real_escape_string($koneksi, $_GET['hapus']);

    // Hapus detail jadwal
    mysqli_query($koneksi, "
        DELETE FROM detail_jadwal
        WHERE id_jadwal = '$id_jadwal'
    ");

    // Hapus jadwal
    $hapus = mysqli_query($koneksi, "
        DELETE FROM jadwal
        WHERE id_jadwal = '$id_jadwal'
    ");

    if ($hapus) {
        echo "
        <div class='alert alert-success alert-dismissible fade show'>
            <strong>Berhasil!</strong> Data jadwal berhasil dihapus.
            <button type='button' class='close' data-dismiss='alert'>
                <span>&times;</span>
            </button>
        </div>";
    } else {
        echo "
        <div class='alert alert-danger alert-dismissible fade show'>
            <strong>Gagal!</strong> Data tidak dapat dihapus.
            <button type='button' class='close' data-dismiss='alert'>
                <span>&times;</span>
            </button>
        </div>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>

    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <div class="card">

            <div class="card-header">
                <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Jadwal
                </a>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="thead-light text-center">
                        <tr>
                            <th width="10%">Kode Jadwal</th>
                            <th width="20%">Guru</th>
                            <th width="10%">Semester</th>
                            <th width="15%">Tahun Ajaran</th>
                            <th>Detail Jadwal</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

<?php

$query = mysqli_query($koneksi, "
    SELECT DISTINCT
        j.id_jadwal,
        j.semester,
        j.thn_ajaran,
        g.nm_guru
    FROM jadwal j
    JOIN detail_jadwal d
        ON j.id_jadwal = d.id_jadwal
    JOIN guru g
        ON d.kd_guru = g.kd_guru
");

if (!$query) {
    die(mysqli_error($koneksi));
}

while ($row = mysqli_fetch_assoc($query)) {

?>

<tr>

    <td class="text-center">
        <?= $row['id_jadwal']; ?>
    </td>

    <td>
        <?= $row['nm_guru']; ?>
    </td>

    <td class="text-center">
        <?= $row['semester']; ?>
    </td>

    <td class="text-center">
        <?= $row['thn_ajaran']; ?>
    </td>

    <td>

        <ul class="mb-0">

        <?php

        $detail = mysqli_query($koneksi, "
            SELECT
                d.*,
                m.nm_mapel
            FROM detail_jadwal d
            JOIN mapel m
                ON d.kd_mapel = m.kd_mapel
            WHERE d.id_jadwal = '{$row['id_jadwal']}'
        ");

        while ($d = mysqli_fetch_assoc($detail)) {

            echo "
                <li>
                    <strong>{$d['nm_mapel']}</strong> |
                    {$d['hari']} |
                    {$d['jam_mulai']} - {$d['jam_selesai']}
                </li>
            ";

        }

        ?>

        </ul>

    </td>

    <td class="text-center">

        <a href="index.php?page=jadwal&hapus=<?= $row['id_jadwal']; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin ingin menghapus data ini?')">

            <i class="fas fa-trash"></i> Hapus

        </a>

    </td>

</tr>

<?php
}
?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>