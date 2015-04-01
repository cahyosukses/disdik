<?php

class MY_Controller extends CI_Controller{
  
    protected $_open_controllers = array('tampil');
    
    public function __construct()
    {
        parent::__construct(); 
        date_default_timezone_set("Asia/Jakarta"); 
               
        $this->_check_auth();
    }
    
    private function _is_allowed($method){
        
        $this->db->where('method',$method);
        $rs = $this->db->get('manage_menu')->row();

        $id = $rs->id;
        
        $menu_list = explode(',',$this->session->userdata('menu_list'));
        $result = FALSE;
        
        if(in_array($id,$menu_list)){
            $result = TRUE;
        }
        
        return $result;
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
        
        if($method !== 'generate_event_calendar'){
            if(!$curr_method){
            
                $this->session->set_userdata('curr_method',$method);
                
            }else{

                if($curr_method !== $method){
                    $this->session->unset_userdata('cari');
                    $this->session->unset_userdata('filter');
                    $this->session->unset_userdata('jenjang');
                    $this->session->unset_userdata('status');
                    $this->session->unset_userdata('id_kabupaten');
                    $this->session->unset_userdata('tahun');

                    //sort table header    
                    $this->session->unset_userdata('sort');
                    $this->session->unset_userdata('order');

                    $curr_method = $this->session->set_userdata('curr_method',$method);                    
                }        

            }    

        }
        
        if ( ! in_array($this->router->class, $this->_open_controllers)){
            if(!$this->_is_allowed($method)){
                redirect(base_url() . 'manage/index' , 'reload'); //go back kids!                
            }
        }

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');  
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
        
      }
      
    }
}