<?php
require_once __DIR__ . "/../config/koneksi.php";

// SIMPAN
if (isset($_POST['simpan'])) {
    $kode = $_POST['Kd_mapel'];
    $nama = $_POST['Nm_mapel'];
    $kkm  = $_POST['Kkm'];

    mysqli_query($koneksi, "INSERT INTO mapel 
    (Kd_mapel, Nm_mapel, Kkm) 
    VALUES ('$kode','$nama','$kkm')");

    header("Location: mapel.php");
}
?>

<h2>Tambah Mapel</h2>

<form method="POST">
    <input type="text" name="Kd_mapel" placeholder="Kode"><br><br>
    <input type="text" name="Nm_mapel" placeholder="Nama"><br><br>
    <input type="number" name="Kkm" placeholder="KKM"><br><br>
    <button type="submit" name="simpan">Simpan</button>
</form>