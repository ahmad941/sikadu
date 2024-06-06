<?php
  //* define notice variable
  $result_notice = '';

  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator') && !defined('kader')) { die('Access denied, not enough level!'); }

  //* simpan
  if (isset($_POST['simpan']))
  {
    $nik          = mysqli_real_escape_string($koneksi->db, $_POST['nik']);
    $nama         = mysqli_real_escape_string($koneksi->db, $_POST['nama']);
    $jk           = mysqli_real_escape_string($koneksi->db, $_POST['jk']);
    $tempat_lahir = mysqli_real_escape_string($koneksi->db, $_POST['tempat_lahir']);
    $tgl_lahir    = mysqli_real_escape_string($koneksi->db, $_POST['tgl_lahir']);
    $nama_ayah    = mysqli_real_escape_string($koneksi->db, $_POST['nama_ayah']);
    $nama_ibu     = mysqli_real_escape_string($koneksi->db, $_POST['nama_ibu']);
    $alamat       = mysqli_real_escape_string($koneksi->db, $_POST['alamat']);

    $result = $klien->addKlien($nik, $nama, $jk, $tempat_lahir, $tgl_lahir, $nama_ayah, $nama_ibu, $alamat);
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Tambah Klien</h4>
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
				<a href="?p=klien">Klien</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Tambah Klien</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Tambah Klien</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <form name="frmTambahKlien" method="POST" action="">
            <div class="form-group">
              <label for="nik">NIK</label>
              <input type="text" class="form-control" name="nik" pattern="\d*" maxlength="18" required>
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" maxlength="30" required>
            </div>
            <div class="form-group">
              <label for="jk">Jenis Kelamin</label>
              <select id="jk" class="form-control" name="jk">
                <?php
                  $data_selection = $klien->getSelectJK();
                  extract($data_selection);
                  echo $data_selection;
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="tempat_lahir">Tempat Lahir</label>
              <input type="text" class="form-control" name="tempat_lahir" maxlength="30" required>
            </div>
            <div class="form-group">
              <label for="tgl_lahir">Tanggal Lahir</label>
              <input type="date" class="form-control" name="tgl_lahir" required>
            </div>
            <div class="form-group">
              <label for="nama_ayah">Nama Ayah</label>
              <input type="text" class="form-control" name="nama_ayah" maxlength="30" required>
            </div>
            <div class="form-group">
              <label for="nama_ibu">Nama Ibu</label>
              <input type="text" class="form-control" name="nama_ibu" maxlength="30" required>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea class="form-control" name="alamat" maxlength="120" required></textarea>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center mt-4">
                <a href="?p=klien" class="btn btn-danger btn-round btn-sm mr-1 ml-auto"> <i class="fas fa-angle-left mr-2"></i> Kembali</a>
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