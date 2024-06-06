<?php
  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator')) { die('Access denied, not enough level!'); }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Master Tindakan</h4>
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
				<a href="">Master Tindakan</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Data Master Tindakan</h4>
            <a href="?p=tambah-master-tindakan" class="btn btn-primary btn-round btn-sm ml-auto"> <i class="fas fa-plus mr-2"></i> Tambah</a>
          </div>
				</div>
				<div class="card-body">
          <div class="table-responsive">
            <table id="DataTables" class="display table table-striped table-hover">
              <thead>
                <th>ID Tindakan</th>
                <th>Nama</th>
                <th>Jenis Tindakan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <?php
                  $rows = $tindakan->getListMasterTindakan();
                  if ($rows != false)
                  {
                    foreach ($rows as $data_master_tindakan)
                    {
                ?>
                  <tr>
                    <td> <?php echo $data_master_tindakan['id_tindakan'] ?> </td>
                    <td> <?php echo $data_master_tindakan['nama'] ?> </td>
                    <td> <?php echo strtoupper($data_master_tindakan['jenis']) ?> </td>
                    <td> <?php echo $data_master_tindakan['keterangan'] ?> </td>
                    <td>
                      <a href="?p=ubah-master-tindakan&id_tindakan=<?php echo $data_master_tindakan['id_tindakan'] ?>" class="btn btn-primary btn-round btn-sm"> <i class="fas fa-edit mr-2"></i> Ubah</a> 
                      <a href="?p=hapus-master-tindakan&id_tindakan=<?php echo $data_master_tindakan['id_tindakan'] ?>" onclick="validateRemove(event)" class="btn btn-danger btn-round btn-sm"> <i class="fas fa-trash-alt mr-2"></i> Hapus</a>
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