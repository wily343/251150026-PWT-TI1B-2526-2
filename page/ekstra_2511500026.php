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

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Hapus
    if($action == 'hapus' && isset($_GET['id'])) {
        $Id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $query = mysqli_query($koneksi, "DELETE FROM ekstra_2511500026 WHERE id_ekstra026 ='$Id'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">Berhasil di hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_2511500026">';
            exit;
        } else {
            echo '<div class="alert alert-danger">Gagal: '.mysqli_error($koneksi).'</div>';
        }
    }

    // Tambah (POST)
    if($action == 'tambah' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama_ekstra026']);
        $ket = mysqli_real_escape_string($koneksi, $_POST['ket026']);
        $semester = mysqli_real_escape_string($koneksi, $_POST['semester026']);
        $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran026']);

        $insert = mysqli_query($koneksi, "INSERT INTO  ekstra_2511500026 (nama_ekstra026, ket026, semester026, tahun_ajaran026) VALUES ('$nama', '$ket', '$semester', '$tahun')");
        if($insert) {
            echo '<div class="alert alert-success">Berhasil ditambahkan</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_2511500026">';
            exit;
        } else {
            echo '<div class="alert alert-danger">Gagal: '.mysqli_error($koneksi).'</div>';
        }
    }

    // Edit (POST)
    if($action == 'edit' && isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $Id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama_ekstra026']);
        $ket = mysqli_real_escape_string($koneksi, $_POST['ket026']);
        $semester = mysqli_real_escape_string($koneksi, $_POST['semester026']);
        $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran026']);

        $update = mysqli_query($koneksi, "UPDATE ekstra_2511500026 SET nama_ekstra026='$nama', ket026='$ket', semester026='$semester', tahun_ajaran026='$tahun' WHERE id_ekstra026='$Id'");
        if($update) {
            echo '<div class="alert alert-success">Berhasil diupdate</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_2511500026">';
            exit;
        } else {
            echo '<div class="alert alert-danger">Gagal: '.mysqli_error($koneksi).'</div>';
        }
    }

    ?>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <?php if($action == 'tambah'): ?>
                        <h4>Tambah Ekstrakurikuler</h4>
                        <form method="post">
                          <div class="form-group">
                            <label>Nama Ekstra</label>
                            <input type="text" name="nama_ekstra026" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="ket026" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Semester</label>
                            <input type="text" name="semester026" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran026" class="form-control">
                          </div>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a href="index.php?page=ekstra_2511500026" class="btn btn-secondary">Batal</a>
                        </form>
                    <?php elseif($action == 'edit' && isset($_GET['id'])): ?>
                        <?php
                            $Id = mysqli_real_escape_string($koneksi, $_GET['id']);
                            $res = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500026 WHERE id_ekstra026='$Id'");
                            if(mysqli_num_rows($res) == 0) {
                                echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
                            } else {
                                $data = mysqli_fetch_assoc($res);
                            }
                        ?>
                        <?php if(!empty($data)): ?>
                        <h4>Edit Ekstrakurikuler</h4>
                        <form method="post" action="index.php?page=ekstra_2511500026&action=edit&id=<?= $Id ?>">
                          <div class="form-group">
                            <label>Nama Ekstra</label>
                            <input type="text" name="nama_ekstra026" class="form-control" value="<?= htmlspecialchars($data['nama_ekstra026']) ?>" required>
                          </div>
                          <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="ket026" class="form-control" value="<?= htmlspecialchars($data['ket026']) ?>">
                          </div>
                          <div class="form-group">
                            <label>Semester</label>
                            <input type="text" name="semester026" class="form-control" value="<?= htmlspecialchars($data['semester026']) ?>">
                          </div>
                          <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran026" class="form-control" value="<?= htmlspecialchars($data['tahun_ajaran026']) ?>">
                          </div>
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a href="index.php?page=ekstra_2511500026" class="btn btn-secondary">Batal</a>
                        </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="index.php?page=ekstra_2511500026&action=tambah" class="btn btn-primary btn-sm">Tambah ekstrakurikuler</a>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                        <td><?= htmlspecialchars($result['id_ekstra026']); ?></td>
                                        <td><?= htmlspecialchars($result['nama_ekstra026']); ?></td>
                                        <td><?= htmlspecialchars($result['ket026']); ?></td>
                                        <td><?= htmlspecialchars($result['semester026']); ?></td>
                                        <td><?= htmlspecialchars($result['tahun_ajaran026']); ?></td>
                                       <td>
                             <a href="index.php?page=ekstra_2511500026&action=hapus&id=<?= $result['id_ekstra026']?>" 
                                   onclick="return confirm('Yakin hapus?')">
                                    <span class="badge badge-danger">Hapus</span>
                                </a>

                                <a href="index.php?page=ekstra_2511500026&action=edit&id=<?= $result['id_ekstra026']?>">
                                    <span class="badge badge-warning">Edit</span>
                                </a>
                            </td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>