<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekap_m extends CI_Model
{
    
   
    function __construct()
    {
        parent::__construct();
    }

    function lembaga($tahun){

    }

    function stats(){
         
        $ses_tahun        = $this->session->userdata('tahun');
        $ses_id_kabupaten = $this->session->userdata('id_kabupaten');

        $id_kabupaten = "";
        if($ses_id_kabupaten){          
          $id_kabupaten = 'WHERE id_kabupaten = ' . $ses_id_kabupaten;
        }

        $tahun = "";
        if($ses_tahun){
          $tahun =  "WHERE tahun = '$ses_tahun'";
        }

        $rs = $this->db->query("
                    SELECT a.alias as jenjang,
                        (IFNULL(SUM(c.lembaga),0)) as lembaga,
                        (IFNULL(SUM(c.rombel),0)) as rombel,
                        (IFNULL(SUM(c.murid),0)) as murid,
                        (IFNULL(SUM(c.guru),0)) as guru,   
                        (IFNULL(SUM(c.ruang_kelas),0)) as ruang_kelas,
                        (IFNULL(SUM(c.lulusan),0)) as lulusan   
                    FROM jenjang a
                    LEFT JOIN (SELECT * FROM data_sekolah $id_kabupaten) b ON a.nama = b.jenjang
                    LEFT JOIN (SELECT * FROM sekolah_stats $tahun) c ON b.id = c.id_sekolah 
                    GROUP BY a.id");
        return $rs;
    }

    
}