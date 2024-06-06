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
    $result = $posyandu->editTindakan($id_posyandu, (isset($_POST['id_tindakan']) ? $_POST['id_tindakan'] : ''));
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Tindakan</h4>
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
				<a href="?p=tindakan-posyandu">Tindakan Posyandu</a>
			</li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Tindakan</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Info Klien</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <?php echo $klien->getInfoKlienTable($data_klien['nik']); ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Data Tindakan</h4>
            <button class="btn btn-primary btn-round btn-sm ml-auto" data-toggle="modal" data-target=".modal-ubah-tindakan"> <i class="fas fa-edit mr-2"></i> Ubah</button>
          </div>
				</div>
				<div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <div class="table-responsive">
            <table id="DataTables" class="display table table-striped table-hover">
              <thead>
                <th>ID Tindakan</th>
                <th>Nama</th>
                <th>Jenis Tindakan</th>
                <th>Keterangan</th>
              </thead>
              <tbody>
                <?php
                  $rows = $posyandu->getListTindakanKlien($id_posyandu);
                  if ($rows != false)
                  {
                    foreach ($rows as $data_tindakan_klien)
                    {
                ?>
                  <tr>
                    <td> <?php echo $data_tindakan_klien['id_tindakan'] ?> </td>
                    <td> <?php echo $data_tindakan_klien['nama'] ?> </td>
                    <td> <?php echo strtoupper($data_tindakan_klien['jenis']) ?> </td>
                    <td> <?php echo $data_tindakan_klien['keterangan'] ?> </td>
                  </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-ubah-tindakan" tabindex="-1" role="dialog" aria-labelledby="modalUbahTindakan" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <b>Data Tindakan</b> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="frmTambahPosyandu" method="POST" action="">
          <div class="table-responsive">
            <table class="display table table-striped table-hover DataTables">
              <thead>
                <tr>
                  <th> <input type="checkbox" class="checkbox mr-3" id="checkAll"> Check All</th>
                  <th>ID Tindakan</th>
                  <th>Nama Tindakan</th>
                  <th>Jenis Tindakan</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $rows = $tindakan->getListMasterTindakan();
                  if ($rows != false)
                  {
                    foreach ($rows as $data_tindakan)
                    {
                ?>
                  <tr>
                    <td> <input type="checkbox" class="checkbox" name="id_tindakan[]" value="<?php echo $data_tindakan['id_tindakan'] ?>" <?php echo $posyandu->isCheckedTindakan($id_posyandu, $data_tindakan['id_tindakan']) ?>> </td>
                    <td> <?php echo $data_tindakan['id_tindakan'] ?> </td>
                    <td> <?php echo $data_tindakan['nama'] ?> </td>
                    <td> <?php echo strtoupper($data_tindakan['jenis']) ?> </td>
                    <td> <?php echo $data_tindakan['keterangan'] ?> </td>
                  </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <div class="d-flex align-items-center mt-4">
              <button type="submit" class="btn btn-primary btn-round btn-sm ml-auto" name="perbarui"> <i class="fas fa-save mr-2"></i> Perbarui</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>