<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Berita_m extends CI_Model
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
         $this->db->where("(judul LIKE '%$cari%')");                  
      }
      
      if($mode === 'numrows'){
        
        $rs = $this->db->get('berita a')->num_rows();  

      }elseif($mode === 'pagging'){

        $this->db->select("a.*,IF(a.sticky = 'Y',0,1) as order_sticky",FALSE);
        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('berita a');      

      }elseif($mode === 'showall'){
      	
        $this->db->select("a.*,IF(a.sticky = 'Y',0,1) as order_sticky",FALSE);
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('berita a');     
      }
      
      return $rs;
    }
}