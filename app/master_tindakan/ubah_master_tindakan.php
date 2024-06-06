<?php
  //* define notice variable
  $result_notice = '';

  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator')) { die('Access denied, not enough level!'); }

  //* check retrieved variable
  $id_tindakan = mysqli_real_escape_string($koneksi->db, $_GET['id_tindakan']);

  //* call get info function
  $data_master_tindakan = $tindakan->getInfoMasterTindakan($id_tindakan);

  //* perbarui
  if (isset($_POST['perbarui']))
  {
    $nama         = mysqli_real_escape_string($koneksi->db, $_POST['nama']);
    $jenis        = mysqli_real_escape_string($koneksi->db, $_POST['jenis']);
    $keterangan   = mysqli_real_escape_string($koneksi->db, $_POST['keterangan']);

    $result = $tindakan->editMasterTindakan($id_tindakan, $nama, $jenis, $keterangan);
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Ubah Master Tindakan</h4>
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
				<a href="?p=master-tindakan">Master Tindakan</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Ubah Master Tindakan</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Ubah Master Tindakan</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <form name="frmUbahMasterTindakan" method="POST" action="">
            <div class="form-group">
              <label for="id_tindakan">ID Tindakan</label>
              <input type="text" class="form-control" name="id_tindakan" value="<?php echo $data_master_tindakan['id_tindakan'] ?>" maxlength="4" required readonly>
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" value="<?php echo $data_master_tindakan['nama'] ?>" maxlength="30" required>
            </div>
            <div class="form-group">
              <label for="jenis">Jenis Tindakan</label>
              <select id="jenis" class="form-control" name="jenis">
                <?php
                  $data_selection = $tindakan->getSelectedJenisTindakan($data_master_tindakan['jenis']);
                  extract($data_selection);
                  echo $data_selection;
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea class="form-control" name="keterangan" maxlength="100" required><?php echo $data_master_tindakan['keterangan'] ?></textarea>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center mt-4">
                <a href="?p=master-tindakan" class="btn btn-danger btn-round btn-sm mr-1 ml-auto"> <i class="fas fa-angle-left mr-2"></i> Kembali</a>
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