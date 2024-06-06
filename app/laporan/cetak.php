<?php
  if(session_id() == ''){ session_start();}

  //* load & init class
  require_once "../../class/Koneksi.php";
  require_once "../../class/Pengguna.php";
  require_once "../../class/Penyuluhan.php";
  require_once "../../class/Tindakan.php";
  require_once "../../class/Klien.php";
  require_once "../../class/Posyandu.php";
  $koneksi    = new Koneksi();
  $pengguna   = new Pengguna();
  $penyuluhan = new Penyuluhan();
  $tindakan   = new Tindakan();
  $klien      = new Klien();
  $posyandu   = new Posyandu();

  $periode  = (isset($_GET['periode'])) ? $_GET['periode'] : null;

  //* check retrieved variable
  $id_posyandu  = mysqli_real_escape_string($koneksi->db, (isset($_GET['id_posyandu'])) ? $_GET['id_posyandu'] :  null);

  // if ($id_posyandu != null)
  // {
  //   echo "<pre>";
  //   echo $posyandu->getLaporanBulanan($id_posyandu);
  //   echo "</pre>";
  // }
  // else
  // {
  //   echo "<pre>";
  //   echo $posyandu->getLaporanTahunan($periode);
  //   echo "</pre>";
  // }

  echo "<script>
         window.print();
        </script>";
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div class="prn-container">
    <div class="row">
        <div class="col-sm-12">
          <div class="prn-header">
            <div class="prn-logo">
              <img src="../../assets/img/icon.ico" alt="">
            </div>
            <br>
            <div class="prn-instansi">
              <h5>POSYANDU DELIMA</h5>
              <h7>Jl. Wirasaba No.54, Adiarsa Tim., Kec. Karawang Timur., Kab. Karawang.</h7>
            </div>
          </div>
        </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-12">
        <div class="prn-periode">
          <h6>LAPORAN POSYANDU</h6>
          <?php
            if($id_posyandu == null) {
              echo "<h7><b>TAHUN ".substr($periode, 0, 4)."</b></h7>";
            }
          ?>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="prn-report">
          <?php
            if ($id_posyandu != null)
            {
              echo $posyandu->getLaporanBulanan($id_posyandu);
            }
            else
            {
              echo $posyandu->getLaporanTahunan($periode);
            }
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 mt-3">
        <div class="sign">
          <div class="sign-title">Divalidasi Oleh,</div>
          <div class="sign-body"></div>
          <div class="sign-footer">( <?= $_SESSION['nama']; ?> )</div>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script type="text/javascript" src="../assets/js/core/jquery.3.2.1.min.js"></script>
  <script type="text/javascript" src="../assets/js/core/popper.min.js"></script>
  <!-- Bootstrap -->
  <script type="text/javascript" src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <!-- Datatables -->
	<script type="text/javascript" src="../assets/plugins/datatables/datatables.min.js"></script>
</body>

<style>
  .prn-container hr {
    border-top: 1px solid #000000;
    border: groove;
  }
  .prn-logo {position: fixed;}
  .prn-logo img {width: 80px; margin-top: 5px;}
  .prn-header {text-align: center; height: 80px;}
  .prn-periode {text-align: center; font-size: small;}
  .prn-report {margin-top: 20px;}
  .table {font-size: smaller;}
  .sign {float: right; margin-right: 20px; text-align: center;}
  .sign-body {margin: 35px 0px;}

  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }

  @media print {
    * { color: black; background: white; }
    <?php
    if ($id_posyandu != null) {
    ?>
    @page {size: portrait; }
    table { font-size: 100%; border-collapse:collapse; border: 1px solid gray; text-align:left; width: 50%; }
    <?php
    } else {
    ?>
    @page {size: landscape; margin: 0; }
    table { font-size: 80%; border-collapse:collapse; border: 1px solid black; text-align:center; width: 100%; }
    <?php
    }
    ?>
  }
</style>