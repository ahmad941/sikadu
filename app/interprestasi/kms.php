<?php
  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator') && !defined('kader')) { die('Access denied, not enough level!'); }

  //* check retrieved variable
  $id_posyandu  = isset($_GET['id_posyandu']) ? mysqli_real_escape_string($koneksi->db, $_GET['id_posyandu']) : null;

  //* call get info function
  $data_posyandu  = $posyandu->getInfoPosyanduByID($id_posyandu);
  $data_klien     = $klien->getInfoKlien($data_posyandu['nik']);
  $data_bb        = $posyandu->getDataBB($data_klien['jk']);
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Info Interprestasi</h4>
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
				<a href="?p=interprestasi">Interprestasi</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Info Interprestasi</a>
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
              <?php echo $klien->getInfoKlienTable($data_posyandu['nik']); ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Info 1</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <?php echo $posyandu->getInfoTimbanganTable($id_posyandu); ?>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered">
                  <?php echo $posyandu->getInfoInterprestasiBB($id_posyandu); ?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Info 2</h4>
            </div>
            <div class="card-body">
              <figure class="highcharts-figure">
                <div id="chart-container"></div>
              </figure>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var data_bb   = {};
  var klien_bb  = <?php echo json_encode(array($klien->getUmur(1, $data_klien['tgl_lahir'], substr($data_posyandu['cap_waktu'], 0, 10)), $data_posyandu['berat_badan'])) ?>;

  data_bb[0] = <?php echo json_encode($data_bb[0]) ?>;
  data_bb[1] = <?php echo json_encode($data_bb[1]) ?>;
  data_bb[2] = <?php echo json_encode($data_bb[2]) ?>;
  data_bb[3] = <?php echo json_encode($data_bb[3]) ?>;
  data_bb[4] = <?php echo json_encode($data_bb[4]) ?>;
  data_bb[5] = <?php echo json_encode($data_bb[5]) ?>;
  data_bb[6] = <?php echo json_encode($data_bb[6]) ?>;
</script>