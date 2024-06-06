<?php
  //* session start
  session_start();
  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  //* load & init class
  require_once "../class/Koneksi.php";
  require_once "../class/Pengguna.php";
  $koneksi  = new Koneksi();
  $pengguna = new Pengguna();

  //* define alert variable
  $alert = '';

  //* login
  if (isset($_POST['login'])) {
    $id_pengguna  = mysqli_real_escape_string($koneksi->db, $_POST['id_pengguna']);
    $sandi        = mysqli_real_escape_string($koneksi->db, $_POST['sandi']);
  
    $result = $pengguna->Login($id_pengguna, $sandi);
    $alert  = $result;
  }

  //* define session data
  $_SESSION['id_pengguna']  = isset($_SESSION['id_pengguna']) ? $_SESSION['id_pengguna'] : '';
  $_SESSION['nama']         = isset($_SESSION['nama']) ? $_SESSION['nama'] : '';
  $_SESSION['level']        = isset($_SESSION['level']) ? $_SESSION['level'] : '';

  //* session check
  if ($_SESSION['id_pengguna'] == '' && $_SESSION['nama'] == '' && $_SESSION['level'] == '')
  {
?>

<!-- Header -->
<?php include '../layouts/header.php' ?>

<div class="wrapper-login">
  <div class="card overflow-hidden account-card mx-3">
    <div class="bg-primary p-4 text-white text-center position-relative">
      <h4 class="font-20 m-b-5">Selamat datang kembali!</h4>
      <p class="text-white-50 mb-4">Masuk untuk melanjutkan</p>
      <a href="" class="logo logo-admin"><img class="rounded-circle" src="../assets/img/profile.jpg" height="78" alt="logo"></a>
    </div>

    <div class="account-card-content">
      <form action="" method="POST">
        <div class="form-group">
          <?php echo $alert; ?>
        </div>

        <div class="form-group">
          <label for="id_pengguna">ID Pengguna</label>
          <input type="text" class="form-control" id="id_pengguna" name="id_pengguna" placeholder="Enter username">
        </div>

        <div class="form-group">
          <label for="sandi">Kata Sandi</label>
          <input type="password" class="form-control" id="sandi" name="sandi" placeholder="Enter password">
        </div>

        <div class="form-group row m-t-20">
          <div class="col-sm-6">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customControlInline" disabled>
              <label class="custom-control-label" for="customControlInline">Simpan kata sandi</label>
            </div>
          </div>
          <div class="col-sm-6 text-right">
            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="login">Masuk</button>
          </div>
        </div>

        <div class="form-group m-t-10 mb-0 row">
          <div class="col-12 m-t-20">
            <a href="" class="disabled"><i class="fas fa-lock"></i>&nbsp; Anda lupa kata sandi?</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>

<?php
  }
  else
  {
    header("Location: ../app/");
  }
?>