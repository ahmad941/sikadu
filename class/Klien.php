<?php

class Klien
{
  public $koneksi;

  public function __construct()
  {
    $this->koneksi = new Koneksi();
  }

  public function getListKlien()
  {
    $query = "SELECT * FROM klien";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array())
      {
        $listKlien[] = $row;
      }
      return $listKlien;
    }
    $stmt->close();
  }

  public function getSelectJK()
  {
    $row = array(array('L', "Laki-laki"), array('P', "Perempuan"));
    $result = "";

    foreach ($row as $data_jk => $value)
    {
      $result .= "<option value='$value[0]'>".$value[1]."</option>";
    }
    return ['data_selection' => $result];
  }

  public function addKlien($nik, $nama, $jk, $tempat_lahir, $tgl_lahir, $nama_ayah, $nama_ibu, $alamat)
  {
    $nik          = trim($nik);
    $nama         = strtoupper(trim($nama));
    $tempat_lahir = strtoupper(trim($tempat_lahir));
    $nama_ayah    = strtoupper(trim($nama_ayah));
    $nama_ibu     = strtoupper(trim($nama_ibu));
    $alamat       = strtoupper(trim($alamat));

    $verify = "SELECT * FROM klien WHERE nik=?";
    $stmt = $this->koneksi->db->prepare($verify);
    $stmt->bind_param("s", $nik);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0)
    {
      $query = "INSERT INTO klien VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("ssssssss", $nik, $nama, $jk, $tempat_lahir, $tgl_lahir, $nama_ayah, $nama_ibu, $alamat);
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
                  <i class='fas fa-exclamation mr-2'></i> Ditemukan nik yang sama pada sistem!
                 </div>";
    }
    $stmt->close();
    return $notice;
  }

  public function getInfoKlien($nik)
  {
    $query = "SELECT * FROM klien WHERE nik=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $nik);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      return $row;
    }
    $stmt->close();
  }

  public function getSelectedJK($jk)
  {
    $row = array(array('L', "Laki-laki"), array('P', "Perempuan"));
    $is_selected = "";
    $result = "";

    foreach ($row as $data_jk => $value)
    {
      if ($value[0] == $jk) {$is_selected = 'selected';} else {$is_selected = '';}
      $result .= "<option value='$value[0]' $is_selected>".$value[1]."</option>";
    }
    return ['data_selection' => $result];
  }

  public function editKlien($nik, $nama, $jk, $tempat_lahir, $tgl_lahir, $nama_ayah, $nama_ibu, $alamat)
  {
    $nik          = trim($nik);
    $nama         = strtoupper(trim($nama));
    $tempat_lahir = strtoupper(trim($tempat_lahir));
    $nama_ayah    = strtoupper(trim($nama_ayah));
    $nama_ibu     = strtoupper(trim($nama_ibu));
    $alamat       = strtoupper(trim($alamat));

    $query = "UPDATE klien SET nama=?, jk=?, tempat_lahir=?, tgl_lahir=?, nama_ayah=?, nama_ibu=?, alamat=? WHERE nik=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("ssssssss", $nama, $jk, $tempat_lahir, $tgl_lahir, $nama_ayah, $nama_ibu, $alamat, $nik);
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

  public function deleteKlien($nik)
  {
    $query = "DELETE FROM klien WHERE nik=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $nik);
    $result = $stmt->execute();

    if ($result)
    {
      echo "<script>
              window.location.href = \"?p=klien\";
            </script>";
    }
    else
    {
      echo "<script>
              alert('Terjadi kesalahan pada database!');
              window.location.href = \"?p=klien\";
            </script>";
    }
  }

  public function getInfoKlienTable($nik)
  {
    $table_header = array("NIK", "Nama", "Jenis Kelamin", "Tempat Lahir", "Tanggal Lahir", "Nama Ayah", "Nama Ibu", "Alamat");
    $row          = $this->getInfoKlien($nik);
    $result       = "";

    if ($row != '')
    {
      $i = 0;
      foreach ($table_header as $th)
      {
        $result .= "<tr>
                      <td class='w-25'>$th</td>
                      <td>";
                        if ($th == "Tanggal Lahir") { $result .= date("d-m-Y", strtotime($row[$i])); } else { $result .= $row[$i]; }
        $result .= "  </td>
                    </tr>";
        $i++;
      }
    }
    
    return $result;
  }

  public function getUmur($ret_option, $tgl_lahir, $tgl_hitung)
  {
    $dob    = new DateTime($tgl_lahir);
    $today  = new DateTime($tgl_hitung);
    $date   = date($tgl_hitung);

    switch ($ret_option)
    {
      case 1:
        $time_start = strtotime($tgl_lahir);
        $time_end   = strtotime($date);
        $count_month = (date("Y", $time_end) - date("Y", $time_start)) * 12;
        $count_month += date("m", $time_end)-date("m", $time_start);
        return $count_month;
      break;
      case 2:
        if ($dob > $today) { 
          exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($dob)->y;
	      $m = $today->diff($dob)->m;
	      $d = $today->diff($dob)->d;
	      return $y." tahun ".$m." bulan ".$d." hari";
      break;
    }
  }

}

?>