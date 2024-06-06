<?php
  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator') && !defined('kader')) { die('Access denied, not enough level!'); }

  //* check retrieved variable
  $id_posyandu  = mysqli_real_escape_string($koneksi->db, $_GET['id_posyandu']);
  $nik          = mysqli_real_escape_string($koneksi->db, $_GET['nik']);
  //* call delete function
  $posyandu->deletePosyandu($id_posyandu, $nik);
?>