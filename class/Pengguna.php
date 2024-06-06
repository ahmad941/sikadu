<?php

class Pengguna
{
  public $koneksi;

  public function __construct()
  {
    $this->koneksi = new Koneksi();
  }
  
  public function addSession($index, $value)
  {
    $_SESSION[$index] = $value;
    return $_SESSION[$index];
  }

  public function delSession($index)
  {
    unset($_SESSION[$index]);
  }

  public function Login($id_pengguna, $sandi)
  {
    $query = "SELECT * FROM pengguna WHERE id_pengguna=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_pengguna);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      $data_pengguna = $result->fetch_assoc();

      if (password_verify(md5($sandi), $data_pengguna['sandi']))
      {
        $this->addSession('id_pengguna', $data_pengguna['id_pengguna']);
        $this->addSession('nama', $data_pengguna['nama']);
        $this->addSession('level', $data_pengguna['level']);

        echo "<script> window.location='../app/index.php?p=dashboard'; </script>";
      }
      else
      {
        $alert = "<div class='alert alert-danger mb-0'><i class='fa fa-exclamation-triangle'></i> Password salah!</div>";
      }
    }
    else
    {
      $alert = "<div class='alert alert-danger mb-0'><i class='fa fa-exclamation-triangle'></i> Username tidak terdaftar!</div>";
    }

    $stmt->close();
    return $alert;
  }
public function getListUser()
{
  $query = "SELECT id_pengguna, nama, email, level FROM pengguna";
  $stmt = $this->koneksi->db->prepare($query);
  $stmt->execute();
  
  $stmt->bind_result($id, $nama, $email, $level);
  
  $listUser = array();
  while ($stmt->fetch()) {
    $user = array(
      'id_pengguna' => $id,
      'nama' => $nama,
      'email' => $email,
      'level' => $level
    );
    $listUser[] = $user;
  }
  
  $stmt->close();
  return $listUser;
}


 
public function getSelectLevel()
{
  $daftar_level = array("administrator", "kader");
  $result = "";

  foreach ($daftar_level as $level)
  {
    $result .= "<option value='$level'>" . ucfirst($level) . "</option>";
  }
  return ['data_selection' => $result];
}

public function addUser($id_pengguna, $sandi, $nama, $level)
{
  $password_hash_option = ['cost' => 6];

  $id_pengguna  = strtolower(trim($id_pengguna));
  $sandi        = password_hash(md5(trim($sandi)), PASSWORD_DEFAULT, $password_hash_option);
  $nama         = ucwords(trim($nama));
  $level        = strtolower(trim($level));

  $verify = "SELECT * FROM pengguna WHERE id_pengguna=?";
  $stmt = $this->koneksi->db->prepare($verify);
  $stmt->bind_param("s", $id_pengguna);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 0)
  {
    $query = "INSERT INTO pengguna (id_pengguna, sandi, nama, level) VALUES (?, ?, ?, ?)";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("ssss", $id_pengguna, $sandi, $nama, $level);
    $stmt->execute();

    if ($stmt->affected_rows > 0)
    {
      $notice = "<div class='alert alert-success alert-dismissible fade show mb-0'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <i class='fas fa-check mr-2'></i> Data berhasil disimpan!
                 </div>";
    }
    else
    {
      $notice = "<div class='alert alert-danger alert-dismissible fade show mb-0'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <i class='fas fa-exclamation mr-2'></i> Terjadi kesalahan saat menyimpan data!
                 </div>";
    }
  }
  else
  {
    $notice = "<div class='alert alert-danger alert-dismissible fade show mb-0'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
                <i class='fas fa-exclamation mr-2'></i> Ditemukan id pengguna yang sama pada sistem!
               </div>";
  }
  $stmt->close();
  return $notice;
}


  public function getInfoUser($id_pengguna)
  {
    $query = "SELECT * FROM pengguna WHERE id_pengguna=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_pengguna);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      return $row;
    }
    $stmt->close();
  }

  public function getSelectedLevel($data)
  {
    $daftar_level = array("administrator", "kader");
    $is_selected = "";
    $result = "";

    foreach ($daftar_level as $level)
    {
      if ($level == $data) {$is_selected = 'selected';} else {$is_selected = '';}
      $result .= "<option value='$level' $is_selected>".ucfirst($level)."</option>";
    }
    return ['data_selection' => $result];
  }

  public function editUser($id_pengguna, $sandi, $nama, $level)
  {
    $password_hash_option = ['cost' => 6];

    $id_pengguna  = strtolower(trim($id_pengguna));
    $sandi        = trim($sandi);
    $nama         = ucwords(trim($nama));
    $level        = strtolower(trim($level));

    if ($sandi == "")
    {
      $query = "UPDATE pengguna SET nama=?, level=? WHERE id_pengguna=?";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("sss", $nama, $level, $id_pengguna);
    }
    else
    {
      $sandi = password_hash(md5($sandi), PASSWORD_DEFAULT, $password_hash_option);

      $query = "UPDATE pengguna SET sandi=?, nama=?, level=? WHERE id_pengguna=?";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("ssss", $sandi, $nama, $level, $id_pengguna);
    }
    $result = $stmt->execute();

    if ($result)
    {
      $notice = "<div class='alert alert-success alert-dismissible fade show mb-0'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <i class='fas fa-check mr-2'></i> Data berhasil diperbarui!
                 </div>";
      echo "<meta http-equiv='refresh' content='4'>";
    }
    else
    {
      $notice = "<div class='alert alert-danger alert-dismissible fade show mb-0'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <i class='fas fa-exclamation mr-2'></i> Terjadi kesalahan saat memperbarui data!
                 </div>";
    }
    $stmt->close();
    return $notice;
  }

  public function deleteUser($id_pengguna)
  {
    $query = "DELETE FROM pengguna WHERE id_pengguna=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_pengguna);
    $result = $stmt->execute();

    if ($result)
    {
      echo "<script>
              window.location.href = \"?p=pengguna\";
            </script>";
    }
    else
    {
      echo "<script>
              alert('Terjadi kesalahan pada database!');
              window.location.href = \"?p=pengguna\";
            </script>";
    }
  }

}

?>