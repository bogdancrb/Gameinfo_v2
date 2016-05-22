<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

        if ($user_info)
        {
            $user_info['isLogged'] = true;
            $user_info['isAdmin'] = ($user_info['AccessLevel'] ? true : false);

            $this->session->set_userdata($user_info);

            return false;
        }
        else
        {
            return 'There was a problem while fetching the user, please try again.'; // TODO I need to make a lang for this
        }
    }
}