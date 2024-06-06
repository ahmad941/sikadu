<?php

class Tindakan
{
  public $koneksi;

  public function __construct()
  {
    $this->koneksi = new Koneksi();
  }

  public function getListMasterTindakan()
  {
    $query = "SELECT * FROM master_tindakan";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_array())
      {
        $listMasterTindakan[] = $row;
      }
      return $listMasterTindakan;
    }
    $stmt->close();
  }

  public function getNextIDMasterTindakan()
  {
    $query = "SELECT max(id_tindakan) FROM master_tindakan";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      $row = $result->fetch_array();
      $last_id      = substr($row[0], 2);
      $tmp_next_id  = (int)$last_id;
      $tmp_next_id  = $tmp_next_id + 1;
      $next_id      = "TD".str_pad($tmp_next_id, 2, "0", STR_PAD_LEFT);
    }
    else
    {
      $next_id      = "TD01";
    }
    $stmt->close();
    return $next_id;
  }

  public function addMasterTindakan($id_tindakan, $nama, $jenis, $keterangan)
  {
    $nama       = strtoupper(trim($nama));
    $keterangan = ucfirst(trim($keterangan));

    $verify = "SELECT * FROM master_tindakan WHERE id_tindakan=?";
    $stmt = $this->koneksi->db->prepare($verify);
    $stmt->bind_param("s", $id_tindakan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0)
    {
      $query = "INSERT INTO master_tindakan VALUES(?, ?, ?, ?)";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("ssss", $id_tindakan, $nama, $jenis, $keterangan);
      $result = $stmt->execute();

      if ($result)
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
                  <i class='fas fa-exclamation mr-2'></i> Ditemukan id tindakan yang sama pada sistem!
                 </div>";
    }
    $stmt->close();
    return $notice;
  }

  public function getInfoMasterTindakan($id_tindakan)
  {
    $query = "SELECT * FROM master_tindakan WHERE id_tindakan=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_tindakan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      return $row;
    }
    $stmt->close();
  }

  public function getSelectedJenisTindakan($jenis)
  {
    $jenis_tindakan = array("vitamin", "imunisasi");
    $is_selected = "";
    $result = "";

    foreach($jenis_tindakan as $data => $value)
    {
      if ($value == $jenis) {$is_selected = 'selected';} else {$is_selected = '';}
      $result .= "<option value='$value' $is_selected>".strtoupper($value)."</option>";
    }
    return ['data_selection' => $result];
  }

  public function editMasterTindakan($id_tindakan, $nama, $jenis, $keterangan)
  {
    $nama         = strtoupper(trim($nama));
    $keterangan   = ucfirst(trim($keterangan));

    $query = "UPDATE master_tindakan SET nama=?, jenis=?, keterangan=? WHERE id_tindakan=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("ssss", $nama, $jenis, $keterangan, $id_tindakan);
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

  public function deleteMasterTindakan($id_tindakan)
  {
    $query = "DELETE FROM master_tindakan WHERE id_tindakan=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_tindakan);
    $result = $stmt->execute();

    if ($result)
    {
      echo "<script>
              window.location.href = \"?p=master-tindakan\";
            </script>";
    }
    else
    {
      echo "<script>
              alert('Terjadi kesalahan pada database!');
              window.location.href = \"?p=master-tindakan\";
            </script>";
    }
  }

}

?>