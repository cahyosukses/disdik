<?php

class MY_Controller extends CI_Controller{
  
    protected $_open_controllers = array('tampil');
    
    public function __construct()
    {
        parent::__construct();        
        $this->_check_auth();
    }
    
    private function _check_auth(){
      
      if(!$this->session->userdata('validated')){

            if ( ! in_array($this->router->class, $this->_open_controllers))
            {
              redirect(base_url() . 'tampil/login','reload'); //go back kids!   
            }

      }else{        

        $curr_method = $this->session->userdata('curr_method');
        $method = $this->router->method; 
        
        if(!$curr_method){
            $this->session->set_userdata('curr_method',$method);
        }else{
            if($curr_method !== $method){
                $this->session->unset_userdata('cari');
                $this->session->unset_userdata('filter');
                $this->session->unset_userdata('id_kabupaten');
                $this->session->unset_userdata('tahun');
                $curr_method = $this->session->set_userdata('curr_method',$method);                    
            }        
        }    

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');  
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
        
      }
      
    }
}