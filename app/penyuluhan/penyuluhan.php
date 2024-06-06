<?php
  //* define notice variable
  $result_notice = '';

  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator') && !defined('kader')) { die('Access denied, not enough level!'); }

  //* check retrieved variable
  $id_posyandu  = mysqli_real_escape_string($koneksi->db, $_GET['id_posyandu']);

  //* call get info function
  $data_posyandu  = $posyandu->getInfoPosyanduByID($id_posyandu);
  $data_klien     = $klien->getInfoKlien($data_posyandu['nik']);

  //* perbarui
  if (isset($_POST['perbarui']))
  {
    $id_penyuluhan  = $_POST['id_penyuluhan'];
    $ket_penyuluhan = mysqli_real_escape_string($koneksi->db, $_POST['ket_penyuluhan']);

    $result = $posyandu->editPenyuluhan($id_posyandu, $id_penyuluhan, $ket_penyuluhan);
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Penyuluhan</h4>
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
				<a href="?p=penyuluhan-posyandu">Penyuluhan Posyandu</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Penyuluhan</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Penyuluhan</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <form name="frmPenyuluhan" method="POST" action="">
            <div class="form-group">
              <label for="periode">Periode</label>
              <input type="month" class="form-control" name="periode" value="<?php echo $data_posyandu['periode'] ?>" required readonly>
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <input type="text" class="form-control" name="nik" pattern="\d*" value="<?php echo $data_posyandu['nik'] ?>" maxlength="18" required readonly>
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" value="<?php echo $data_klien['nama'] ?>" maxlength="30" required readonly>
            </div>
            <div class="form-group">
              <label for="id_penyuluhan">Penyuluhan</label>
              <select class="form-control select2 select2-multiple" multiple="multiple" multiple data-placeholder="Pilih ..." name="id_penyuluhan[]" required>
                <?php
                  $data_selection = $posyandu->getSelectedPenyuluhan($id_posyandu);
                  extract($data_selection);
                  echo $data_selection;
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="ket_penyuluhan">Keterangan</label>
              <textarea class="form-control" name="ket_penyuluhan" required><?php echo $data_posyandu['ket_penyuluhan'] ?></textarea>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center mt-4">
                <a href="?p=penyuluhan-posyandu" class="btn btn-danger btn-round btn-sm mr-1 ml-auto"> <i class="fas fa-angle-left mr-2"></i> Kembali</a>
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