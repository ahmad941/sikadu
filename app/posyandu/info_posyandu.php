<?php
  //* define notice variable
  $result_notice = '';

  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator') && !defined('kader')) { die('Access denied, not enough level!'); }

  $nik  = isset($_GET['nik']) ? mysqli_real_escape_string($koneksi->db, $_GET['nik']) : null;

  //* simpan
  if (isset($_POST['simpan']))
  {
    $waktu_pelaksanaan = mysqli_real_escape_string($koneksi->db, $_POST['waktu_pelaksanaan']);

    $result = $posyandu->addPosyandu($waktu_pelaksanaan, $nik);
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Info Posyandu</h4>
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
				<a href="?p=posyandu">Pendaftaran Posyandu</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Info Posyandu</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cari Klien</h4>
        </div>
        <div class="card-body">
          <div class="d-flex align-items-center">
            <input type="text" class="form-control w-75 search-by-nik" name="nik" pattern="\d*" maxlength="18" onchange="searchNIK()"> 
            <button class="btn btn-primary btn-round btn-sm ml-3" data-toggle="modal" data-target=".modal-telusuri"> <i class="fas fa-address-book mr-2"></i> Telusuri</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Info Klien</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <?php echo $klien->getInfoKlienTable($nik); ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Info Posyandu Klien</h4>
            <button class="btn btn-primary btn-round btn-sm ml-auto" data-toggle="modal" data-target=".modal-tambah-posyandu"> <i class="fas fa-plus mr-2"></i> Tambah</button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <div class="table-responsive">
            <table id="DataTables" class="display table table-striped table-hover">
              <thead>
                <th>Periode</th>
                <th class='w-25'>Aksi</th>
              </thead>
              <tbody>
                <?php
                  $rows = $posyandu->getInfoPosyanduByNIK($nik);
                  if ($rows != false)
                  {
                    foreach ($rows as $info_posyandu)
                    {
                ?>
                  <tr>
                    <td> <?php echo $info_posyandu['periode'] ?> </td>
                    <td>
                      <a href="?p=hapus-posyandu&id_posyandu=<?php echo $info_posyandu['id_posyandu'] ?>&nik=<?php echo $info_posyandu['nik'] ?>" onclick="validateRemove(event)" class="btn btn-danger btn-round btn-sm"> <i class="fas fa-trash-alt mr-2"></i> Hapus</a>
                    </td>
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

<div class="modal fade modal-telusuri" tabindex="-1" role="dialog" aria-labelledby="modalTelusuri" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <b>Data Klien</b> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="display table table-striped table-hover DataTables">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Nama Ibu</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $rows = $klien->getListKlien();
                if ($rows != false)
                {
                  foreach ($rows as $data_klien)
                  {
              ?>
                <tr>
                  <td> <?php echo $data_klien['nik'] ?> </td>
                  <td> <?php echo $data_klien['nama'] ?> </td>
                  <td> <?php echo $data_klien['tempat_lahir'] ?> </td>
                  <td> <?php echo $data_klien['tgl_lahir'] ?> </td>
                  <td> <?php echo $data_klien['nama_ibu'] ?> </td>
                  <td>
                    <a href="?p=info-posyandu&nik=<?php echo $data_klien['nik'] ?>" class="btn btn-primary btn-round btn-sm"> <i class="fas fa-check mr-2"></i> Pilih</a> 
                  </td>
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

<div class="modal fade modal-tambah-posyandu" tabindex="-1" role="dialog" aria-labelledby="modalTambahPosyandu" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <b>Tambah Periode</b> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="frmTambahPosyandu" method="POST" action="">
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" name="nik" pattern="\d*" value="<?php echo $nik ?>" maxlength="18" required readonly>
          </div>
          <div class="form-group">
            <label for="waktu_pelaksanaan">Waktu Pelaksanaan</label>
            <input type="datetime-local" class="form-control" name="waktu_pelaksanaan" required>
          </div>
          <div class="form-group">
            <div class="d-flex align-items-center mt-4">
              <button type="submit" class="btn btn-primary btn-round btn-sm ml-auto" name="simpan"> <i class="fas fa-save mr-2"></i> Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function searchNIK()
  {
    location.href = "index.php?p=info-posyandu&nik=" + $(".search-by-nik").val();
  }
</script>