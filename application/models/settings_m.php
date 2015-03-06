<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    //public $tbl_name;

    function __construct()
    {
        parent::__construct();
    }
    
    function update_by_title($title,$data){
      $this->db->where('title', $title);
      $this->db->update('settings',$data);
    }
}