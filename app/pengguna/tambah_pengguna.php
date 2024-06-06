<?php
  //* define notice variable
  $result_notice = '';

  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator')) { die('Access denied, not enough level!'); }

  //* simpan
  if (isset($_POST['simpan']))
  {
    $id_pengguna  = mysqli_real_escape_string($koneksi->db, $_POST['id_pengguna']);
    $sandi        = mysqli_real_escape_string($koneksi->db, $_POST['sandi']);
    $nama         = mysqli_real_escape_string($koneksi->db, $_POST['nama']);
    $level        = mysqli_real_escape_string($koneksi->db, $_POST['level']);

    $result = $pengguna->addUser($id_pengguna, $sandi, $nama, $level);
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Tambah Pengguna</h4>
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="?p=dashboard">
					<i class="flaticon-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="?p=pengguna">Pengguna</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Tambah Pengguna</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Tambah Pengguna</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <form name="frmTambahPengguna" method="POST" action="">
            <div class="form-group">
              <label for="id_pengguna">ID Pengguna</label>
              <input type="text" class="form-control" name="id_pengguna" maxlength="12" required>
            </div>
            <div class="form-group">
              <label for="sandi">Sandi</label>
              <input type="password" class="form-control" name="sandi" maxlength="16" required>
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" maxlength="30" required>
            </div>
            <div class="form-group">
              <label for="level">Level</label>
              <select id="level" class="form-control" name="level">
                <?php
                  $data_selection = $pengguna->getSelectLevel();
                  extract($data_selection);
                  echo $data_selection;
                ?>
              </select>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center mt-4">
                <a href="?p=pengguna" class="btn btn-danger btn-round btn-sm mr-1 ml-auto"> <i class="fas fa-angle-left mr-2"></i> Kembali</a>
                <button type="reset" class="btn btn-default btn-round btn-sm mr-1" name="batal"> <i class="fas fa-sync-alt mr-2"></i> Batal</button>
                <button type="submit" class="btn btn-primary btn-round btn-sm mr-1" name="simpan"> <i class="fas fa-save mr-2"></i> Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>