<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Opini_m extends CI_Model
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
    function get($mode = null,$admin = false){
        
      $cari = $this->session->userdata('cari');
      $rs = null;      
      
      if($cari){         
         $this->db->where("(judul LIKE '%$cari%')");                  
      }
      
      $this->db->select("a.*,COUNT(b.id) as jml_tanggapan");  
      $this->db->join("opini_tanggapan b","a.id = b.id_opini","left");
      $this->db->group_by("a.id");

      if($mode === 'numrows'){        

        if($admin){
          $filter = $this->session->userdata('filter');
        
          if($filter){
            $this->db->where('publish',$filter);    
          }  

          $rs = $this->db->get('opini a')->num_rows();  
        }else{
          $this->db->where('publish','Y');
          $rs = $this->db->get('opini a')->num_rows();  
        }        
        
      }elseif($mode === 'pagging'){

        if($admin){
          $filter = $this->session->userdata('filter');
        
          if($filter){
            $this->db->where('publish',$filter);    
          } 

          $this->db->order_by($this->sort,$this->order);
          $this->db->limit($this->limit,$this->offset);   
          $rs = $this->db->get('opini a');      
        }else{
          $this->db->order_by($this->sort,$this->order);
          $this->db->limit($this->limit,$this->offset);   
          $this->db->where('publish','Y');
          $rs = $this->db->get('opini a');        
        }
        

      }elseif($mode === 'showall'){
      	
        $this->db->order_by($this->sort,$this->order);       
        $rs = $this->db->get('opini a');     
      }
      
      return $rs;
    }
}