<?php
  $current_page = '';
  $title = '';

  if (array_key_exists('p', $_GET)) {
    $current_page = $_GET['p'];
  } else {
    $current_page = $_SERVER['PHP_SELF'];
  }

  switch ($current_page) {
    case 'login.php':
      $title = 'Login';
    break;
    default:
      $title = 'SI-KADU';
    break;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> <?php echo $title; ?> </title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon -->
  <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

  <!-- Fonts and icons -->
	<script src="../assets/plugins/webfont/js/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/plugins/webfont/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap/css/bootstrap.min.css">

  <!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="../assets/css/atlantis.min.css">
  
  <!-- CSS Si-KADU -->
  <link rel="stylesheet" type="text/css" href="../assets/css/sikadu.css">

  <!-- Daterange Table -->
  <link rel="stylesheet" type="text/css" href="../assets/plugins/daterangepicker/css/daterangepicker.css" />

  <!-- Form Editor -->
  <link rel="stylesheet" type="text/css" href="../assets/plugins/summernote-0.8.18/summernote-bs4.css" />

  <!-- Select2 -->
  <link rel="stylesheet" type="text/css" href="../assets/plugins/select2/css/select2.min.css" />

</head>