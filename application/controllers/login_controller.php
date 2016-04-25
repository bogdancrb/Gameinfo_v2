<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_controller extends Gameinfo_Controller
{
    const PAGE_TITLE_DESCRIPTION = 'Login'; // TODO I need to make a lang for this

    private $cfg;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->cfg = array(
            'title_description'   => self::PAGE_TITLE_DESCRIPTION
        );

        $this->validateForm();

        if ($this->form_validation->run() == FALSE)
        {
            $this->loadTemplate('login', $this->cfg);
        }
        else
        {
            echo 'logged in';
        }
    }

    private function validateForm()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        $this->form_validation->set_error_delimiters('<div style="color: #E13300">', '</div>');
    }
}
