<?php
  //* define notice variable
  $result_notice = '';

  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator')) { die('Access denied, not enough level!'); }

  //* check retrieved variable
  $id_penyuluhan = mysqli_real_escape_string($koneksi->db, $_GET['id_penyuluhan']);

  //* call get info function
  $data_master_penyuluhan = $penyuluhan->getInfoMasterPenyuluhan($id_penyuluhan);

  //* simpan
  if (isset($_POST['perbarui']))
  {
    $judul          = mysqli_real_escape_string($koneksi->db, $_POST['judul']);
    $konten         = $_POST['konten'];

    $result = $penyuluhan->editMasterPenyuluhan($id_penyuluhan, $judul, $konten);
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Ubah Master Penyuluhan</h4>
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
				<a href="?p=master-penyuluhan">Master Penyuluhan</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Ubah Master Penyuluhan</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Ubah Master Penyuluhan</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <form name="frmUbahMasterPenyuluhan" method="POST" action="">
            <div class="form-group">
              <label for="id_penyuluhan">ID Penyuluhan</label>
              <input type="text" class="form-control" name="id_penyuluhan" value="<?php echo $data_master_penyuluhan['id_penyuluhan'] ?>" maxlength="4" required readonly>
            </div>
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" class="form-control" name="judul" value="<?php echo $data_master_penyuluhan['judul'] ?>" maxlength="128" required>
            </div>
            <div class="form-group">
              <label for="konten">Konten</label>
              <textarea class="summernote" name="konten" required> <?php echo $data_master_penyuluhan['konten'] ?> </textarea>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center">
                <a href="?p=master-penyuluhan" class="btn btn-danger btn-round btn-sm mr-1 ml-auto"> <i class="fas fa-angle-left mr-2"></i> Kembali</a>
                <button type="reset" class="btn btn-default btn-round btn-sm mr-1" name="batal"> <i class="fas fa-sync-alt mr-2"></i> Batal</button>
                <button type="submit" class="btn btn-primary btn-round btn-sm mr-1" name="perbarui"> <i class="fas fa-save mr-2"></i> Perbarui</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>