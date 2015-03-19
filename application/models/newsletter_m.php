<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter_m extends CI_Model
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
        $rs = $this->db->get('newsletter a')->num_rows();  
      }elseif($mode === 'pagging'){
        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('newsletter a');      
      }elseif($mode === 'showall'){
      	$this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('newsletter a');     
      }
      
      return $rs;
    }
}