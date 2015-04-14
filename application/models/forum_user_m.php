<?php

class Forum_user_m extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function check_role()
    {
        $user_id = $this->session->userdata('forum_user_id');
        // get roles
        if ($user_id) {
            $row = $this->db->get_where(TBL_USERS, array('id' => $user_id))->row();
            $roles = $this->db->get_where(TBL_ROLES, array('id' => $row->role_id))->row_array();
            foreach ($roles as $key => $value) {
                $this->session->set_userdata($key, $value);
            }
        }
    }
    
    public function check_login()
    {
        $row = $this->input->post('row');
        //$key = $this->config->item('encryption_key');
        

        $data = array('username' => $row['username']);

        $query = $this->db->get_where(TBL_USERS, $data);
        
        $password = '';

        if ( ($query->num_rows() == 1) ) {
            $user = $query->row();
            //$plain_password = $this->encrypt->decode($user->password, $key);
            $password = $user->password;
        }
        
        // if user found
        if ( ($query->num_rows() == 1) && ($password == md5($row['password']))) {
            $row = $query->row();
            $this->session->set_userdata('forum_logged_in', 1);
            $this->session->set_userdata('forum_user_id'  , $row->id);
            $this->session->set_userdata('forum_username' , $row->username);
			$this->session->set_userdata('forum_user_roleid' , $row->role_id);
            
            // get roles
            $roles = $this->db->get_where(TBL_ROLES, array('id' => $row->role_id))->row_array();
            foreach ($roles as $key => $value) {
                $this->session->set_userdata($key, $value);
            }
        } else {
            $this->error['login'] = 'User tidak ditemukan ';
            $this->error_count = 1;
        }
    }
    
    public function register()
    {
        $row = $this->input->post('row');
        
        // check username 
        $is_exist_username = $this->db->get_where(TBL_USERS, 
                array('username' => $row['username']))->num_rows();
        if ($is_exist_username > 0) {
            $this->error['username'] = 'Username ini telah digunakan';
        }
        if (strlen($row['username']) < 5) {
            $this->error['username'] = 'Username minimum 5 character';
        }
        
        // check password
        if ($row['password'] != $this->input->post('password2')) {
            $this->error['password'] = 'Password tidak sama';
        } else if (strlen($row['password']) < 5) {
            $this->error['password'] = 'Password minimum 5 character';
        }
        
        if (count($this->error) == 0) {
            //$key = $this->config->item('encryption_key');
            $row['role_id'] = 2;
            $row['password'] = md5($row['password']);
            $this->db->insert(TBL_USERS, $row);
        } else {
            $this->error_count = count($this->error);
        }
    }

    public function user_edit($user_id)
    {
        $row = $this->input->post('row');
        if ($row['password'] != "" || $row['password2'] != "") {
            if ($row['password'] != $row['password2']) {
                $this->error['password'] = 'Password not match';
            } else if (strlen($row['password']) < 5) {
                $this->error['password'] = 'Password minimum 5 character';
            }
        }       
        
        if (count($this->error) == 0) {
            
            if ($row['password'] != "" && $row['password2'] != "") {               
                $row['password'] = md5($row['password']);
            } else {
                unset($row['password']);
            }
            
            unset($row['password2']);
            
            $this->db->where('id', $user_id);
            $this->db->update(TBL_USERS, $row);
        } else {
            $this->error_count = count($this->error);
        }
    }
}