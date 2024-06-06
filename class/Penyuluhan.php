<?php

class Penyuluhan
{
  public $koneksi;

  public function __construct()
  {
    $this->koneksi  = new Koneksi();
  }

  public function getListMasterPenyuluhan()
  {
    $query = "SELECT * FROM master_penyuluhan";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array())
      {
        $listMasterPenyuluhan[] = $row;
      }
      return $listMasterPenyuluhan;
    }
    $stmt->close();
  }

  public function getNextIDMasterPenyuluhan()
  {
    $query = "SELECT max(id_penyuluhan) FROM master_penyuluhan";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      $row = $result->fetch_array();
      $last_id      = substr($row[0], 2);
      $tmp_next_id  = (int)$last_id;
      $tmp_next_id  = $tmp_next_id + 1;
      $next_id      = "PL".str_pad($tmp_next_id, 2, "0", STR_PAD_LEFT);
    }
    else
    {
      $next_id      = "PL01";
    }
    $stmt->close();
    return $next_id;
  }

  public function addMasterPenyuluhan($id_penyuluhan, $judul, $konten)
  {
    $judul = strtoupper(trim($judul));

    $verify = "SELECT * FROM master_penyuluhan WHERE id_penyuluhan=?";
    $stmt = $this->koneksi->db->prepare($verify);
    $stmt->bind_param("s", $id_penyuluhan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0)
    {
      $query = "INSERT INTO master_penyuluhan VALUES(?, ?, ?)";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("sss", $id_penyuluhan, $judul, $konten);
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
                  <i class='fas fa-exclamation mr-2'></i> Ditemukan id jenis yang sama pada sistem!
                 </div>";
    }
    $stmt->close();
    return $notice;
  }

  public function getInfoMasterPenyuluhan($id_penyuluhan)
  {
    $query = "SELECT * FROM master_penyuluhan WHERE id_penyuluhan=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_penyuluhan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      return $row;
    }
    $stmt->close();
  }

  public function editMasterPenyuluhan($id_penyuluhan, $judul, $konten)
  {
    $judul = strtoupper(trim($judul));

    $query = "UPDATE master_penyuluhan SET judul=?, konten=? WHERE id_penyuluhan=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("sss", $judul, $konten, $id_penyuluhan);
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

  public function deleteMasterPenyuluhan($id_penyuluhan)
  {
    $query = "DELETE FROM master_penyuluhan WHERE id_penyuluhan=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_penyuluhan);
    $result = $stmt->execute();

    if ($result)
    {
      echo "<script>
              window.location.href = \"?p=master-penyuluhan\";
            </script>";
    }
    else
    {
      echo "<script>
              alert('Terjadi kesalahan pada database!');
              window.location.href = \"?p=master-penyuluhan\";
            </script>";
    }
  }

}

?>