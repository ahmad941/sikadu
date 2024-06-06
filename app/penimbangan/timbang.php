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
    $tinggi_badan = mysqli_real_escape_string($koneksi->db, $_POST['tinggi_badan']);
    $berat_badan  = mysqli_real_escape_string($koneksi->db, $_POST['berat_badan']);

    $result = $posyandu->Timbang($id_posyandu, $tinggi_badan, $berat_badan);
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Timbang</h4>
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
				<a href="?p=penimbangan">Penimbangan Posyandu</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Timbang</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Timbang</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <form name="frmTimbang" method="POST" action="">
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
              <label for="tinggi_badan">Tinggi Badan (cm)</label>
              <input type="number" class="form-control" name="tinggi_badan" value="<?php echo $data_posyandu['tinggi_badan'] ?>" step="0.01" min="0" required>
            </div>
            <div class="form-group">
              <label for="berat_badan">Berat Badan (Kg)</label>
              <input type="number" class="form-control" name="berat_badan" value="<?php echo $data_posyandu['berat_badan'] ?>" step="0.01" min="0" required>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center mt-4">
                <a href="?p=penimbangan" class="btn btn-danger btn-round btn-sm mr-1 ml-auto"> <i class="fas fa-angle-left mr-2"></i> Kembali</a>
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