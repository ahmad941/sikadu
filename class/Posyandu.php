<?php

class Posyandu
{
  public $koneksi;
  public $klien;
  public $penyuluhan;
  public $datetime;

  public function __construct()
  {
    $this->koneksi = new Koneksi();
    $this->klien = new Klien();
    $this->penyuluhan = new Penyuluhan();
    $this->datetime = date("Y-m-d H:i:s");
  }
  
  public function getListPendaftaranPosyandu()
  {
    $query = "SELECT * FROM `posyandu` JOIN `klien` USING(nik)";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array())
      {
        $listPendaftaranPosyandu[] = $row;
      }
      return $listPendaftaranPosyandu;
    }
    $stmt->close();
  }

  public function getInfoPosyanduByNIK($nik)
  {
    $query = "SELECT * FROM posyandu WHERE nik=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $nik);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array())
      {
        $listPendaftaranPosyandu[] = $row;
      }
      return $listPendaftaranPosyandu;
    }
    $stmt->close();
  }

  public function getInfoPosyanduByPeriodeAndNIK($periode, $nik)
  {
    $query = "SELECT * FROM posyandu WHERE periode=? AND nik=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("ss", $periode, $nik);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      return $row;
    }
    $stmt->close();
  }

  public function getInfoPosyanduByID($id_posyandu)
  {
    $query = "SELECT * FROM posyandu WHERE id_posyandu=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("i", $id_posyandu);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      return $row;
    }
    $stmt->close();
  }

  public function addPosyandu($waktu_pelaksanaan, $nik)
  {
    $verify = "SELECT * FROM posyandu WHERE periode=? AND nik=?";
    $stmt = $this->koneksi->db->prepare($verify);
    $stmt->bind_param("ss", $periode, $nik);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0)
    {
      $periode = substr($waktu_pelaksanaan, 0, 7);
      $query = "INSERT INTO posyandu (periode, nik, cap_waktu) VALUES(?, ?, ?)";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("sss", $periode, $nik, $waktu_pelaksanaan);
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
                  <i class='fas fa-exclamation mr-2'></i> Ditemukan periode yang sama pada sistem!
                 </div>";
    }
    $stmt->close();
    return $notice;
  }

  public function deletePosyandu($id_posyandu, $nik)
  {
    $query = "DELETE FROM posyandu WHERE id_posyandu=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("i", $id_posyandu);
    $result = $stmt->execute();

    if ($result)
    {
      echo "<script>
              window.location.href = \"?p=info-posyandu&nik=$nik\";
            </script>";
    }
    else
    {
      echo "<script>
              alert('Terjadi kesalahan pada database!');
              window.location.href = \"?p=info-posyandu&nik=$nik\";
            </script>";
    }
  }

  public function getStatusPenimbangan($id_posyandu)
  {
    $data_posyandu = $this->getInfoPosyanduByID($id_posyandu);
    $status = array();

    if ($data_posyandu > 0)
    {
      if ($data_posyandu['tinggi_badan'] != '' || $data_posyandu['berat_badan'] != '')
      {
        array_push($status, true, "<h6><span class='badge badge-success'>SUDAH</span></h6>");
      }
      else
      {
        array_push($status, false, "<h6><span class='badge badge-danger'>BELUM</span></h6>");
      }
    }
    else
    {
      array_push($status, false, "<h6><span class='badge badge-danger'>BELUM</span></h6>");
    }
    return $status;
  }

  public function Timbang($id_posyandu, $tinggi_badan, $berat_badan)
  {
    $verify = "SELECT * FROM posyandu WHERE id_posyandu=?";
    $stmt = $this->koneksi->db->prepare($verify);
    $stmt->bind_param("i", $id_posyandu);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      $query = "UPDATE posyandu SET tinggi_badan=?, berat_badan=? WHERE id_posyandu=?";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("ssi", $tinggi_badan, $berat_badan, $id_posyandu);
      $result = $stmt->execute();

      if ($result)
      {
        $notice = "<div class='alert alert-success alert-dismissible fade show mb-0'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <i class='fas fa-check mr-2'></i> Data berhasil perbarui!
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
    }
    $stmt->close();
    return $notice;
  }

  public function getStatusPenyuluhan($id_posyandu)
  {
    $query = "SELECT * FROM posyandu_penyuluhan WHERE id_posyandu=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_posyandu);
    $stmt->execute();
    $result = $stmt->get_result();
    $status = "";

    $data_posyandu = $this->getInfoPosyanduByID($id_posyandu);

    if ($result->num_rows > 0)
    {
      if ($data_posyandu['ket_penyuluhan'] != '')
      {
        $status = "<h6><span class='badge badge-success'>SUDAH</span></h6>";
      }
      else
      {
        $status = "<h6><span class='badge badge-danger'>BELUM</span></h6>";
      }
    }
    else
    {
      $status = "<h6><span class='badge badge-danger'>BELUM</span></h6>";
    }

    $stmt->close();
    return $status;
  }

  public function getInfoPenyuluhanList($id_posyandu)
  {
    $query = "SELECT * FROM posyandu_penyuluhan JOIN master_penyuluhan USING (id_penyuluhan) WHERE id_posyandu=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_posyandu);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array())
      {
        $listPenyuluhan[] = $row;
      }
      return $listPenyuluhan;
    }
    $stmt->close();
  }

  public function getSelectedPenyuluhan($id_posyandu)
  {
    $list_penyuluhan  = $this->penyuluhan->getListMasterPenyuluhan();
    $info_penyuluhan  = $this->getInfoPenyuluhanList($id_posyandu);
    $is_selected      = "";
    $result           = "";

    $selected_penyuluhan = array();
    foreach ($info_penyuluhan as $data_info_penyuluhan)
    {
      array_push($selected_penyuluhan, $data_info_penyuluhan['id_penyuluhan']);
    }

    foreach ($list_penyuluhan as $data_list_penyuluhan)
    {
      if (in_array($data_list_penyuluhan['id_penyuluhan'], $selected_penyuluhan)) {$is_selected = 'selected';} else {$is_selected = '';}
      $result .= "<option value='" . $data_list_penyuluhan['id_penyuluhan'] . "' $is_selected>" . $data_list_penyuluhan['judul'] . "</option>";
    }

    return ['data_selection' => $result];
  }

  public function editPenyuluhan($id_posyandu, $id_penyuluhan, $ket_penyuluhan)
  {
    $this->deleteTabelPosyandu($id_posyandu, "posyandu_penyuluhan");

    $count_inserted = 0;
    foreach ($id_penyuluhan as $value)
    {
      $query  = "INSERT INTO posyandu_penyuluhan VALUES(?, ?)";
      $stmt   = $this->koneksi->db->prepare($query);
      $stmt->bind_param("is", $id_posyandu, $value);
      $result = $stmt->execute();

      if ($result) { $count_inserted++; }
    }

    if ($count_inserted == count($id_penyuluhan))
    {
      $query  = "UPDATE posyandu SET ket_penyuluhan=? WHERE id_posyandu=?";
      $stmt   = $this->koneksi->db->prepare($query);
      $stmt->bind_param("si", $ket_penyuluhan, $id_posyandu);
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

  public function getStatusTindakan($id_posyandu)
  {
    $query = "SELECT * FROM posyandu_tindakan WHERE id_posyandu=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_posyandu);
    $stmt->execute();
    $result = $stmt->get_result();
    $status = "";

    $data_posyandu = $this->getInfoPosyanduByID($id_posyandu);

    if ($result->num_rows > 0)
    {
      $status = "<h6><span class='badge badge-success'>SUDAH</span></h6>";
    }
    else
    {
      $status = "<h6><span class='badge badge-danger'>BELUM</span></h6>";
    }
    $stmt->close();
    return $status;
  }

  public function getListTindakanKlien($id_posyandu)
  {
    $query = "SELECT * FROM posyandu_tindakan JOIN master_tindakan USING (id_tindakan) WHERE id_posyandu=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_posyandu);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array())
      {
        $listTindakanKlien[] = $row;
      }
      return $listTindakanKlien;
    }
    $stmt->close();
  }

  public function isCheckedTindakan($id_posyandu, $id_tindakan)
  {
    $info_tindakan = $this->getListTindakanKlien($id_posyandu);
    $is_checked    = "";
    $result        = "";

    $selected_tindakan = array();
    if (!empty($info_tindakan))
    {
      foreach ($info_tindakan as $data_info_tindakan)
      {
        array_push($selected_tindakan, $data_info_tindakan['id_tindakan']);
      }
    }

    if (in_array($id_tindakan, $selected_tindakan))
    {
      $result = 'checked';
    }
    else
    {
      $result = '';
    }
    return $result;
  }

  public function editTindakan($id_posyandu, $id_tindakan)
  {
    $this->deleteTabelPosyandu($id_posyandu, "posyandu_tindakan");

    if (!empty($id_tindakan))
    {
      $count_inserted = 0;
      foreach ($id_tindakan as $value)
      {
        $query  = "INSERT INTO posyandu_tindakan VALUES(?, ?)";
        $stmt   = $this->koneksi->db->prepare($query);
        $stmt->bind_param("is", $id_posyandu, $value);
        $result = $stmt->execute();
  
        if ($result) { $count_inserted++; }
      }
  
      if ($count_inserted == count($id_tindakan))
      {
        $notice = "<div class='alert alert-success alert-dismissible fade show mb-0'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <i class='fas fa-check mr-2'></i> Data berhasil diperbarui!
                   </div>";
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
  }

  public function deleteTabelPosyandu($id_posyandu, $table_name)
  {
    $query = "DELETE FROM $table_name WHERE id_posyandu=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id_posyandu);
    $stmt->execute();
  }

  public function getListStandarBB($jk)
  {
    $query = "SELECT * FROM standar_bb_by_umur WHERE jk=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $jk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array())
      {
        $listStandarBB[] = $row;
      }
      return $listStandarBB;
    }
    $stmt->close();
  }

  public function getListInterprestasi()
  {
    $data_posyandu = $this->getListPendaftaranPosyandu();
    
    $listPendaftaranPosyandu = null;
    if ($data_posyandu > 0)
    {
      foreach ($data_posyandu as $row)
      {
        $status = $this->getStatusPenimbangan($row['id_posyandu']);
        if ($status[0] == true)
        {
          $listPendaftaranPosyandu[] = $row;
        }
      }
      return $listPendaftaranPosyandu;
    }
    $stmt->close();
  }

  public function getInfoTimbanganTable($id_posyandu)
  {
    $info_posyandu  = $this->getInfoPosyanduByID($id_posyandu);
    $info_klien     = $this->klien->getInfoKlien($info_posyandu['nik']);
    $result       = "";

    $result .= "<tr>
                 <td class='w-25'>Umur</td>
                 <td> <b>" . $this->klien->getUmur(1, $info_klien['tgl_lahir'], substr($info_posyandu['cap_waktu'], 0, 10)) . " bulan</b> (" . $this->klien->getUmur(2, $info_klien['tgl_lahir'], substr($info_posyandu['cap_waktu'], 0, 10)) . ")</td>
                </tr>
                <tr>
                 <td>Tinggi Badan</td>
                 <td> <b>" . $info_posyandu['tinggi_badan'] . " cm</b> </td>
                </tr>
                <tr>
                 <td>Berat Badan</td>
                 <td> <b>" . $info_posyandu['berat_badan'] . " Kg</b> </td>
                </tr>";
    return $result;
  }

  public function getKamusBB($umur, $jk)
  {
    $query = "SELECT * FROM standar_bb_by_umur WHERE bulan=? AND jk=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("ss", $umur, $jk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      return $row;
    }
    $stmt->close();
  }

  public function getInfoInterprestasiBB($id_posyandu)
  {
    $table_header   = array("Umur (bulan)", "-3 SD", "-2 SD", "-1 SD", "Median", "+1 SD", "+2 SD", "+3 SD");
    $info_posyandu  = $this->getInfoPosyanduByID($id_posyandu);
    $info_klien     = $this->klien->getInfoKlien($info_posyandu['nik']);
    $kamus_bb       = $this->getKamusBB($this->klien->getUmur(1, $info_klien['tgl_lahir'], substr($info_posyandu['cap_waktu'], 0, 10)), $info_klien['jk']);
    $result         = "";

    $result .= "<tr>";
      foreach ($table_header as $th)
      {
        $result .= "<th>$th</th>";
      }
    $result .= "</tr>";

    $result .= "<tr>
                 <td>" . $kamus_bb['bulan'] . "</td>
                 <td style='background-color: #FF6347 !important;'>" . $kamus_bb['min_3'] . "</td>
                 <td style='background-color: #FFA07A !important;'>" . $kamus_bb['min_2'] . "</td>
                 <td style='background-color: #FFFF00 !important;'>" . $kamus_bb['min_1'] . "</td>
                 <td style='background-color: #98FB98 !important;'>" . $kamus_bb['median'] . "</td>
                 <td style='background-color: #FFFF00 !important;'>" . $kamus_bb['plus_1'] . "</td>
                 <td style='background-color: #FFA07A !important;'>" . $kamus_bb['plus_2'] . "</td>
                 <td style='background-color: #FF6347 !important;'>" . $kamus_bb['plus_3'] . "</td>
                </tr>";

    return $result;
  }

  public function getDataBB($jk)
  {
    $listStandarBB = $this->getListStandarBB($jk);

    $data_bb;
    for ($i = 0; $i <= 6; $i++)
    {
      $data_bb[$i] = array();
    }

    if ($listStandarBB != '')
    {
      foreach ($listStandarBB as $row => $key)
      {
        array_push($data_bb[0], $key[2]);
        array_push($data_bb[1], $key[3]);
        array_push($data_bb[2], $key[4]);
        array_push($data_bb[3], $key[5]);
        array_push($data_bb[4], $key[6]);
        array_push($data_bb[5], $key[7]);
        array_push($data_bb[6], $key[8]);
      }
    }

    return $data_bb;
  }

  public function getKlienPosyanduByPeriode($periode)
  {
    $periode = '%' . $periode . '%';

    $query = "SELECT DISTINCT nik FROM posyandu WHERE periode LIKE ?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $periode);
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

  public function getLaporanTahunan($periode)
  {
    $periode = substr($periode, 0, 4);
    $list_klien = $this->getKlienPosyanduByPeriode($periode);

    $output = "<table id='DataTables' class='table table-bordered'>";
    $output .= "<thead>
                <tr>
                  <th rowspan='2'>NIK</th>
                  <th rowspan='2'>Nama</th>
                  <th rowspan='2'>JK</th>
                  <th rowspan='2'>Tgl Lahir</th>
                  <th colspan='2'>Nama</th>
                  <th rowspan='2'>Alamat</th>
                  <th colspan='24'>Hasil Penimbangan</th>
                </tr>
                <tr>
                  <th>Ayah</th>
                  <th>Ibu</th>
                  <th colspan='2'>Jan</th>
                  <th colspan='2'>Feb</th>
                  <th colspan='2'>Mar</th>
                  <th colspan='2'>Apr</th>
                  <th colspan='2'>Mei</th>
                  <th colspan='2'>Jun</th>
                  <th colspan='2'>Jul</th>
                  <th colspan='2'>Aug</th>
                  <th colspan='2'>Sep</th>
                  <th colspan='2'>Okt</th>
                  <th colspan='2'>Nov</th>
                  <th colspan='2'>Des</th>
                </tr>
                </thead>";

    // $output .= "<tr>";
    //               for ($i = 0; $i <= 30; $i++)
    //               {
    //                 $output .= "<td>" . $i ."</td>";
    //               }
    // $output .= "</tr>";
    
    $output .= "<tbody>";

    if ($list_klien != null)
    {
      foreach ($list_klien as $row)
      {
        $data_klien = $this->klien->getInfoKlien($row['nik']);
  
        $output .= "<tr>";
          $output .= "<td>" . $data_klien['nik'] ."</td>";
          $output .= "<td>" . $data_klien['nama'] ."</td>";
          $output .= "<td>" . $data_klien['jk'] ."</td>";
          $output .= "<td>" . date("d-m-Y", strtotime($data_klien['tgl_lahir'])) ."</td>";
          $output .= "<td>" . $data_klien['nama_ayah'] ."</td>";
          $output .= "<td>" . $data_klien['nama_ibu'] ."</td>";
          $output .= "<td>" . $data_klien['alamat'] ."</td>";

          for ($i = 1; $i <= 12; $i++)
          {
            $month          = str_pad($i, 2, '0', STR_PAD_LEFT);
            $data_posyandu  = $this->getInfoPosyanduByPeriodeAndNIK(($periode . "-" . $month), $row['nik']);
            
            if ($data_posyandu != null)
            {
              $output .= "<td>" . $data_posyandu['tinggi_badan'] ."</td>";
              $output .= "<td>" . $data_posyandu['berat_badan'] ."</td>";
            }
            else
            {
              $output .= "<td></td>";
              $output .= "<td></td>";
            }
          }

        $output .= "</tr>";
      }
    }
    else
    {
      $output .= "<tr>
                    <td colspan='30'>NO DATA</td>
                  </tr>";
    }

    $output .= "</tbody>";

    $output .= "</table>";

    return $output;
  }

  public function getLaporanBulanan($id_posyandu)
  {
    $info_posyandu    = $this->getInfoPosyanduByID($id_posyandu);
    $info_penyuluhan  = $this->getInfoPenyuluhanList($id_posyandu);
    $info_tindakan    = $this->getListTindakanKlien($id_posyandu);

    $output = "<table id='DataTables' class='table table-bordered'>";

    $output .= "<tr>
                  <th colspan='2' height='25'>I. DATA KLIEN</th>
                </tr>";
    $output .= $this->klien->getInfoKlienTable($info_posyandu['nik']);

    $output .= "<tr>
                  <th colspan='2' height='25'>II. DETAIL POSYANDU</th>
                </tr>";

    $output .= "<tr>
                  <td colspan='2' height='25'>I. PERIODE</td>
                </tr>
                <tr>
                  <td>Periode</td>
                  <td>" . $info_posyandu['periode'] . "</td>
                </tr>";

    $output .= "<tr>
                  <td colspan='2' height='25'>II. PENIMBANGAN</td>
                </tr>";
    $output .= $this->getInfoTimbanganTable($id_posyandu);
    
    $output .= "<tr>
                  <td colspan='2' height='25'>III. PENYULUHAN</td>
                </tr>
                <tr>
                  <td>Penyuluhan</td>
                  <td>
                    <ul>";
                    if ($info_penyuluhan != null)
                    {
                      foreach ($info_penyuluhan as $row)
                      {
                        $output .= "<li>" . $row['judul'] . "</li>";
                      }
                    }
    $output .=      "</ul>
                  </td>
                </tr>";

    $output .= "<tr>
                  <td colspan='2' height='25'>IV. TINDAKAN</td>
                </tr>
                <tr>
                  <td>Tindakan</td>
                  <td>
                    <ul>";
                    if ($info_tindakan != null)
                    {
                      foreach ($info_tindakan as $row)
                      {
                        $output .= "<li>" . $row['nama'] . "</li>";
                      }
                    }
    $output .=      "</ul>
                  </td>
                </tr>";

    $output .= "</table>";

    return $output;
  }

}

?>