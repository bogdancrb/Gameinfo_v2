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
    }

    public function index()
    {
        echo 'UID: ' . getUserId() . '<br>';
        echo 'Nickname: ' . getUserNickname() . '<br>';
        echo 'Email: ' . getUserEmail() . '<br>';
        echo 'Country: ' . getUserCountry() . '<br>';
        echo 'Admin: ' . isUserAdmin() . '<br>';
        echo 'Access level: ' . getAccessLevel() . '<br>';
        echo 'Logged in: ' . isUserLogged() . '<br>';

        echo '<a href="' . base_url() . 'sess_controller/destroy">Destroy session</a>';
    }

    public function destroy()
    {
        clear_session_data();
        redirect('sess_controller');
    }
}