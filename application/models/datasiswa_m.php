<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Datasiswa_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;

    function __construct()
    {
        parent::__construct();
    }

    //tipe : pagging, numrows, showall
    function get($id_sekolah,$mode = null){
        
      $cari = $this->session->userdata('cari');

      $rs = null;
      
      if($cari){         
         $this->db->where("(a.nisn LIKE '%$cari%' OR a.nama LIKE '%$cari%')");                  
      }

      $this->db->where('a.id_sekolah',$id_sekolah);
      $this->db->where('a.terhapus','N');
      
      if($mode === 'numrows'){
        
        $rs = $this->db->get('data_siswa a')->num_rows();  

      }elseif($mode === 'pagging'){

        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('data_siswa a');      

      }elseif($mode === 'showall'){
      	
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('data_siswa a');     
      }
      
      return $rs;
    }
}