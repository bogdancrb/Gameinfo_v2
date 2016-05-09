<?php

/**
 * This is only for testing the session variables.
 *
 * WARNING: REMOVE THIS ON PRODUCTION ENVIROMENT !
 */
class Sess_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
    }

    public function index()
    {
        echo 'UID: ' . $this->session->userdata('UserID') . '<br>';
        echo 'Nickname: ' . $this->session->userdata('Nickname') . '<br>';
        echo 'Logged in: ' . $this->session->userdata('isLogged') . '<br>';

        echo '<a href="' . base_url() . 'sess_controller/destroy">Destroy session</a>';
    }

    public function destroy()
    {
        $this->session->sess_destroy();
        redirect('sess_controller');
    }
}