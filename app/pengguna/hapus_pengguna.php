<?php
  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('administrator')) { die('Access denied, not enough level!'); }

  //* check retrieved variable
  $id_pengguna = mysqli_real_escape_string($koneksi->db, $_GET['id_pengguna']);
  //* call delete function
  $pengguna->deleteUser($id_pengguna);
?>