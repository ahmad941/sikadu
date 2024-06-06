<?php
  if (isset($_SESSION['id_pengguna']))
  {
	  $pengguna->delSession('id_pengguna');
	  $pengguna->delSession('nama');
    $pengguna->delSession('level');
  }
	echo "<script> window.location=' ../auth/login.php'; </script>";
?>