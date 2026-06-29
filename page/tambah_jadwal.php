<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php

// ===============================
// MEMBUAT ID JADWAL OTOMATIS
// ===============================

$queryKode = mysqli_query($koneksi, "SELECT MAX(id_jadwal) AS kode FROM jadwal");
$dataKode = mysqli_fetch_assoc($queryKode);

$id_jadwal = 1;

if ($dataKode['kode'] != "") {
    $id_jadwal = $dataKode['kode'] + 1;
}

// ===============================
// PROSES SIMPAN
// ===============================

if (isset($_POST['tambah'])) {

    $id_jadwal    = $_POST['id_jadwal'];
    $id_kelas     = $_POST['id_kelas'];
    $semester     = $_POST['semester'];
    $thn_ajaran   = $_POST['thn_ajaran'];

    $kd_guru   = $_POST['kd_guru'];
    $kd_mapel  = $_POST['kd_mapel'];
    $hari      = $_POST['hari'];
    $jam       = $_POST['jam'];

    // ============================
    // SIMPAN KE TABEL JADWAL
    // ============================

    $insertJadwal = mysqli_query($koneksi,"
        INSERT INTO jadwal
        (
            id_jadwal,
            id_kelas,
            thn_ajaran,
            semester
        )
        VALUES
        (
            '$id_jadwal',
            '$id_kelas',
            '$thn_ajaran',
            '$semester'
        )
    ");

    if (!$insertJadwal) {
        die("Gagal menyimpan jadwal : ".mysqli_error($koneksi));
    }

    // ============================
    // SIMPAN DETAIL JADWAL
    // ============================

    $berhasil = true;

    for($i=0; $i<count($kd_mapel); $i++){

        $pecahJam = explode("-", $jam[$i]);

        $jam_mulai   = trim($pecahJam[0]);
        $jam_selesai = trim($pecahJam[1]);

        $insertDetail = mysqli_query($koneksi,"
            INSERT INTO detail_jadwal
            (
                id_jadwal,
                kd_mapel,
                kd_guru,
                hari,
                jam_mulai,
                jam_selesai
            )
            VALUES
            (
                '$id_jadwal',
                '{$kd_mapel[$i]}',
                '{$kd_guru[$i]}',
                '{$hari[$i]}',
                '$jam_mulai',
                '$jam_selesai'
            )
        ");

        if(!$insertDetail){
            $berhasil = false;
            echo mysqli_error($koneksi);
        }
    }

    if($berhasil){

        echo "
        <div class='alert alert-success alert-dismissible fade show'>
            <strong>Berhasil!</strong> Data jadwal berhasil disimpan.
            <button type='button' class='close' data-dismiss='alert'>
                <span>&times;</span>
            </button>
        </div>";

        echo "<meta http-equiv='refresh' content='1;url=index.php?page=jadwal'>";

    }else{

        echo "
        <div class='alert alert-danger alert-dismissible fade show'>
            <strong>Gagal!</strong> Data tidak dapat disimpan.
            <button type='button' class='close' data-dismiss='alert'>
                <span>&times;</span>
            </button>
        </div>";

    }

}
?>
<div class="content">
    <div class="container-fluid">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-plus"></i>
                    Tambah Jadwal
                </h3>
            </div>

            <div class="card-body">

                <form method="POST">

                    <!-- ID JADWAL -->
                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <input
                            type="text"
                            name="id_jadwal"
                            class="form-control"
                            value="<?= $id_jadwal ?>"
                            readonly>
                    </div>

                    <!-- KELAS -->
                    <div class="form-group">
                        <label>Kelas</label>

                        <select name="id_kelas" class="form-control" required>

                            <option value="">-- Pilih Kelas --</option>

                            <?php

                            $kelas = mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY nm_kelas ASC");

                            while($k=mysqli_fetch_assoc($kelas)){

                                ?>

                                <option value="<?= $k['id_kelas']; ?>">
                                    <?= $k['nm_kelas']; ?>
                                </option>

                                <?php

                            }

                            ?>

                        </select>

                    </div>

                    <!-- SEMESTER -->
                    <div class="form-group">
                        <label>Semester</label>

                        <select name="semester" class="form-control" required>

                            <option value="">-- Pilih Semester --</option>

                            <option value="ganjil">
                                Ganjil
                            </option>

                            <option value="genap">
                                Genap
                            </option>

                        </select>

                    </div>

                    <!-- TAHUN AJARAN -->
                    <div class="form-group">

                        <label>Tahun Ajaran</label>

                        <input
                            type="text"
                            name="thn_ajaran"
                            class="form-control"
                            placeholder="Contoh : 2025/2026"
                            required>

                    </div>

                    <hr>

                    <h5>Detail Jadwal</h5>

                    <div id="detail_jadwal">

                        <div class="row mb-2">

                            <!-- GURU -->
                            <div class="col-md-3">

                                <select name="kd_guru[]" class="form-control" required>

                                    <option value="">-- Guru --</option>

                                    <?php

                                    $guru=mysqli_query($koneksi,"SELECT * FROM guru ORDER BY nm_guru");

                                    while($g=mysqli_fetch_assoc($guru)){

                                        ?>

                                        <option value="<?= $g['kd_guru']; ?>">
                                            <?= $g['nm_guru']; ?>
                                        </option>

                                        <?php

                                    }

                                    ?>

                                </select>

                            </div>

                            <!-- MAPEL -->
                            <div class="col-md-3">

                                <select name="kd_mapel[]" class="form-control" required>

                                    <option value="">-- Mapel --</option>

                                    <?php

                                    $mapel=mysqli_query($koneksi,"SELECT * FROM mapel ORDER BY nm_mapel");

                                    while($m=mysqli_fetch_assoc($mapel)){

                                        ?>

                                        <option value="<?= $m['kd_mapel']; ?>">
                                            <?= $m['nm_mapel']; ?>
                                        </option>

                                        <?php

                                    }

                                    ?>

                                </select>

                            </div>

                            <!-- HARI -->
                            <div class="col-md-2">

                                <select name="hari[]" class="form-control" required>

                                    <option value="">Hari</option>

                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>

                                </select>

                            </div>

                            <!-- JAM -->
                            <div class="col-md-2">

                                <select name="jam[]" class="form-control" required>

                                    <option value="">Jam</option>

                                    <option>07:00:00-08:30:00</option>
                                    <option>08:30:00-10:00:00</option>
                                    <option>10:15:00-11:45:00</option>
                                    <option>13:00:00-14:30:00</option>
                                    <option>14:30:00-16:00:00</option>

                                </select>

                            </div>

                            <!-- TOMBOL HAPUS -->
                            <div class="col-md-2">

                                <button
                                    type="button"
                                    class="btn btn-danger btn-block"
                                    onclick="hapusBaris(this)">

                                    -

                                </button>

                            </div>

                        </div>

                    </div>

                    <br>

                    <button
                        type="button"
                        class="btn btn-info"
                        onclick="tambahBaris()">

                        + Tambah Mapel

                    </button>

                    <button
                        type="submit"
                        name="tambah"
                        class="btn btn-primary">

                        Simpan

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
<script>

function tambahBaris() {

    // Ambil container
    let container = document.getElementById("detail_jadwal");

    // Clone baris pertama
    let row = container.firstElementChild.cloneNode(true);

    // Reset semua select
    row.querySelectorAll("select").forEach(function(select){
        select.selectedIndex = 0;
    });

    // Tambahkan ke bawah
    container.appendChild(row);

}


// ============================
// HAPUS BARIS DETAIL
// ============================

function hapusBaris(btn){

    let container = document.getElementById("detail_jadwal");

    // Jangan sampai semua baris habis
    if(container.children.length == 1){

        alert("Minimal harus ada satu mata pelajaran.");

        return;

    }

    btn.parentNode.parentNode.remove();

}

</script>