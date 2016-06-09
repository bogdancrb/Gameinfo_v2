<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    private $username;
    private $password;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('db_details/user_db_details');
    }

    public function doLogin($post)
    {
        $this->username = strtolower($post['username']);
        $this->password = hash('sha256', $post['password'], false);

        $user_info = $this->user_db_details->getUser($this->username, $this->password);

        if ($user_info)
        {
            $user_info['isLogged'] = true;
            $user_info['isAdmin'] = ($user_info['user_access_level'] ? true : false);

            $this->session->set_userdata($user_info);

            return null;
        }
        else
        {
            return 'There was a problem while fetching the user, please try again.'; // TODO I need to make a lang for this
        }
    }
}