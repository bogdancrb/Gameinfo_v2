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
        $this->password = hash('sha256', $post['password'], false);
        
        $user_info = $this->user_db_details->getUserDetails($this->username, $this->password);

        $user_info['isLogged'] = true;
        $user_info['isAdmin'] = ($user_info['AccessLevel']  ? true : false);

        $this->session->set_userdata($user_info);
    }
}