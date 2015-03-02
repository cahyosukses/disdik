<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sekolahstats_m extends CI_Model
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
        
      $rs = null;

      $this->db->where('a.id_sekolah',$id_sekolah);
      
      if($mode === 'numrows'){
        
        $rs = $this->db->get('sekolah_stats a')->num_rows();  

      }elseif($mode === 'pagging'){

        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('sekolah_stats a');      

      }elseif($mode === 'showall'){
      	
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('sekolah_stats a');     
      }
      
      return $rs;
    }
}