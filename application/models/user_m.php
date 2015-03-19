<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model
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

      $rs = null;
      
      
      if($cari){         
         $this->db->where("(nama LIKE '%$cari%' OR u LIKE '%$cari%')");                  
      }
      
      $this->db->where('terhapus','N');

      if($mode === 'numrows'){
        
        $rs = $this->db->get('admin')->num_rows();  

      }elseif($mode === 'pagging'){

        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('admin');      

      }elseif($mode === 'showall'){     	
        
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('admin');     
      }
      
      return $rs;
    }
}