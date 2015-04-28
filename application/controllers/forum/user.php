<?php

class User extends CI_Controller {
    public $data = array();
    
    public function __construct() {
        parent::__construct();

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');  
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        
        $this->load->model('forum_user_m');
        $this->forum_user_m->check_role();
    }
    

    public function join()
    {
        // event register button
        if ($this->input->post('btn-reg')) 
        {
            $this->forum_user_m->register();
            if ($this->forum_user_m->error_count != 0) {
                $this->data['error']    = $this->forum_user_m->error;
            } else {
                $this->session->set_userdata('tmp_success', 1);
                redirect('user/join');
            }
        }
        
        $tmp_success = $this->session->userdata('tmp_success');
        if ($tmp_success != NULL) {
            // new user created
            $this->session->unset_userdata('tmp_success');
            $this->data['tmp_success'] = 1;
        }
        
        // event login button
        if ($this->input->post('btn-login'))
        {
            $this->load->model('forum_user_m');
            $this->forum_user_m->check_login();
            if ($this->forum_user_m->error_count != 0) {
                $this->data['error_login']    = $this->forum_user_m->error;
            } else {
                redirect('forum/thread');
            }
        }
        
        $this->data['title']   = 'User Join or Login :: '.FORUM_TITLE;
        
        $this->load->view('forum/header', $this->data);
        $this->load->view('forum/user/join');
        $this->load->view('forum/footer');
    }
    
    public function user_edit($user_id)
    {
        if (!$this->session->userdata('forum_user_id')) {
            redirect('forum/user/join');
        }

        if ($this->session->userdata('forum_user_id') != $user_id) {
            redirect('forum/user/user_edit/' . $this->session->userdata('forum_user_id') );
        }

        if ($this->input->post('btn-save')) {
            $this->forum_user_m->user_edit($user_id);
            if ($this->forum_user_m->error_count != 0) {
                $this->data['error']    = $this->forum_user_m->error;
            } else {
                $this->session->set_userdata('tmp_success', 1);
                redirect('forum/admin/user_view');
            }
        }
        
        
        $this->data['user']    = $this->db->get_where(TBL_USERS, array('id' => $user_id))->row();
        $this->data['title']   = 'Admin Users Edit :: '.FORUM_TITLE;
        $this->load->view('forum/header', $this->data);        
        $this->load->view('forum/user/user_edit');
        $this->load->view('forum/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('forum/user/join');
    }
    
    public function index()
    {
        $this->data['title']   = 'User Index :: '.FORUM_TITLE;
        $this->load->view('forum/header', $this->data);
        $this->load->view('forum/user/index');
        $this->load->view('forum/footer');
    }
}