<?php

class Login_model extends CI_Model
{
    private $username;
    private $password;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_db_details');
    }

    public function doLogin($post)
    {
        $this->username = strtolower($post['username']);
        $this->password = $post['password'];
        
        $user_info = $this->user_db_details->getUserDetails($this->username);

        $user_info['isLogged'] = true;

        $this->session->set_userdata($user_info);
    }
}