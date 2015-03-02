<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ekspresi_m extends CI_Model
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
    function get($mode = null,$showall = 'FALSE'){
        
      $cari = $this->session->userdata('cari');

      $rs = null;
      
      if($cari){         
         $this->db->where("(isi_ekspresi LIKE '%$cari%' OR judul LIKE '%$cari%')");                  
      }
      
      if($showall === 'FALSE'){

        $this->db->where('a.tampil','Y');  

      }else{

        $filter = $this->session->userdata('filter');
        
        if($filter){
          $this->db->where('a.tampil',$filter);    
        }  
      }
       
      $this->db->select("a.id,a.nama,a.email,a.judul,a.tampil,a.isi_ekspresi,a.inserted_at,COUNT(b.id) as jml");  
      $this->db->join("ekspresi_tanggapan b","a.id = b.id_ekspresi","left");
      $this->db->group_by("a.id");

      if($mode === 'numrows'){
        
        $rs = $this->db->get('ekspresi a')->num_rows();  

      }elseif($mode === 'pagging'){

        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('ekspresi a');      

      }elseif($mode === 'showall'){
      	
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('ekspresi a');     
      }
      
      return $rs;
    }
}