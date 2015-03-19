<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aduan_m extends CI_Model
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
         $this->db->where("(topik LIKE '%$cari%')");                  
      }
      
      if($showall === 'FALSE'){
        $this->db->where('a.tampil','Y');  
      }else{

        $filter = $this->session->userdata('filter');
        
        if($filter){
          $this->db->where('a.tampil',$filter);    
        }  
      }

      $this->db->select("a.id,a.nama_pengadu,
                         a.email_pengadu,a.tampil,
                         a.topik,a.pesan,a.inserted_at");  
      /*
      $this->db->join("aduan_tanggapan b","a.id = b.id_aduan","left");
      $this->db->group_by("a.id");
      */
      if($mode === 'numrows'){
        
        $rs = $this->db->get('aduan a')->num_rows();  

      }elseif($mode === 'pagging'){

        $this->db->order_by($this->sort,$this->order);
        $this->db->limit($this->limit,$this->offset);   
        $rs = $this->db->get('aduan a');      

      }elseif($mode === 'showall'){
      	
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('aduan a');     
      }
      
      return $rs;
    }
}