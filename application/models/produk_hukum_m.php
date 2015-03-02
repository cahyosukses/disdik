<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Produk_hukum_m extends CI_Model
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
    function get($id_prod_hukum = null , $mode = null){
        
      $cari = $this->session->userdata('cari');
      $tahun = $this->session->userdata('tahun');

      $this->db->select('id,nomor,tahun,tentang,terbit');
      
      $rs = null;
      
      if($cari){         
         $this->db->where("(tentang LIKE '%$cari%')");                  
      }

      if($tahun){
      	 $this->db->where('tahun',$tahun);                  	
      }
      
      $this->db->where('id_produk_hukum',$id_prod_hukum);
      $this->db->where('terhapus','N');
      
      if($mode === 'numrows'){
        
        $rs = $this->db->get('produk_hukum_list a')->num_rows();  

      }elseif($mode === 'pagging'){

        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('produk_hukum_list a');      

      }elseif($mode === 'showall'){
      	
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('produk_hukum_list a');     
      }
      
      return $rs;
    }
}