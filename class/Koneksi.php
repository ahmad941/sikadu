<?php

class Koneksi {
    private $dbhost = "localhost";
    private $dbuser = "belaj828_sikadu";
    private $dbpasswd = "sikadu2024";
    private $dbname = "belaj828_sikadu";
    
    public $db;

    public function __construct()
    {
      //* set default timezone
      date_default_timezone_set("Asia/Bangkok");

      $this->db = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpasswd, $this->dbname) or die("Koneksi ke db gagal!");
    } 
}

?>