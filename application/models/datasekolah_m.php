<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Datasekolah_m extends CI_Model
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
    function get($mode = null){
        
      $cari = $this->session->userdata('cari');
      $jenjang = $this->session->userdata('jenjang');
      $status = $this->session->userdata('status');
      $kabupaten = $this->session->userdata('id_kabupaten');

      $this->db->select('a.id,a.npsn,a.nss,a.nama,c.nama as propinsi,
                         b.nama as kabupaten,c.nama as propinsi,a.jenjang,
                         a.kelurahan,a.kecamatan,a.status');
      $this->db->join('kabupaten b','a.id_kabupaten = b.id','left');
      $this->db->join('propinsi c','b.id_propinsi = c.id','left');      
      
      $rs = null;
      
      if($cari){         
         $this->db->where("(a.npsn LIKE '%$cari%' OR a.nss LIKE '%$cari%' OR a.nama LIKE '%$cari%')");                  
      }

      if($jenjang){
      	 $this->db->where('a.jenjang',$jenjang);                  	
      }

      if($status){
         $this->db->where('a.status',$status);                    
      }

      if($kabupaten){
         $this->db->where('a.id_kabupaten',$kabupaten);                    
      }


      $this->db->where('c.id','1');
      $this->db->where('a.terhapus','N');
      
      if($mode === 'numrows'){
        
        $rs = $this->db->get('data_sekolah a')->num_rows();  

      }elseif($mode === 'pagging'){

        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('data_sekolah a');      

      }elseif($mode === 'showall'){
      	
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('data_sekolah a');     
      }
      
      return $rs;
    }
}