<?php
  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator') && !defined('kader')) { die('Access denied, not enough level!'); }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Interprestasi</h4>
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
				<a href="">Interprestasi</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Data Interprestasi</h4>
          </div>
				</div>
				<div class="card-body">
          <div class="table-responsive">
            <table id="dtMonthFilter" class="display table table-striped table-hover">
              <thead>
                <th>Periode</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Nama Ibu</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <?php
                  $rows = $posyandu->getListInterprestasi();
                  if ($rows != false)
                  {
                    foreach ($rows as $data_pendaftaran_posyandu)
                    {
                ?>
                  <tr>
                    <td> <?php echo $data_pendaftaran_posyandu['periode'] ?> </td>
                    <td> <?php echo $data_pendaftaran_posyandu['nik'] ?> </td>
                    <td> <?php echo $data_pendaftaran_posyandu['nama'] ?> </td>
                    <td> <?php echo $data_pendaftaran_posyandu['tgl_lahir'] ?> </td>
                    <td> <?php echo $data_pendaftaran_posyandu['nama_ibu'] ?> </td>
                    <td>
                      <a href="?p=kms&id_posyandu=<?php echo $data_pendaftaran_posyandu['id_posyandu'] ?>" class="btn btn-primary btn-round btn-sm"> <i class="fas fa-edit mr-2"></i> Interprestasi</a>
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