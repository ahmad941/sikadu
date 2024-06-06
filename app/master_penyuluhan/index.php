<?php
  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator')) { die('Access denied, not enough level!'); }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Master Penyuluhan</h4>
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
				<a href="">Master Penyuluhan</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Data Master Penyuluhan</h4>
            <a href="?p=tambah-master-penyuluhan" class="btn btn-primary btn-round btn-sm ml-auto"> <i class="fas fa-plus mr-2"></i> Tambah</a>
          </div>
				</div>
				<div class="card-body">
          <div class="table-responsive">
            <table id="DataTables" class="display table table-striped table-hover">
              <thead>
                <th class="w-25">ID Penyuluhan</th>
                <th>Judul</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <?php
                  $rows = $penyuluhan->getListMasterPenyuluhan();
                  if ($rows != false)
                  {
                    foreach ($rows as $data_master_penyuluhan)
                    {
                ?>
                  <tr>
                    <td> <?php echo $data_master_penyuluhan['id_penyuluhan'] ?> </td>
                    <td> <?php echo $data_master_penyuluhan['judul'] ?> </td>
                    <td>
                      <a href="?p=ubah-master-penyuluhan&id_penyuluhan=<?php echo $data_master_penyuluhan['id_penyuluhan'] ?>" class="btn btn-primary btn-round btn-sm"> <i class="fas fa-edit mr-2"></i> Ubah</a> 
                      <a href="?p=hapus-master-penyuluhan&id_penyuluhan=<?php echo $data_master_penyuluhan['id_penyuluhan'] ?>" onclick="validateRemove(event)" class="btn btn-danger btn-round btn-sm"> <i class="fas fa-trash-alt mr-2"></i> Hapus</a>
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