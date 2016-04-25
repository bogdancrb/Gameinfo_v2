<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_controller extends Gameinfo_Controller
{
    const PAGE_TITLE_DESCRIPTION = 'Register'; // TODO I need to make a lang for this

    private $cfg;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->load->model('register_model');
    }

    public function index()
    {
        $this->cfg = array(
            'title_description'   => self::PAGE_TITLE_DESCRIPTION
        );

        $this->validateForm();

        if ($this->form_validation->run() == FALSE)
        {
            $this->loadTemplate('register', $this->cfg);
        }
        else
        {
            $post = $this->input->post('register');

            $message = $this->register_model->addNewUser($post);

            echo $message;
        }
    }

    private function validateForm()
    {
        $this->form_validation->set_rules('register[username]', 'Username', 'trim|required|min_length[4]|max_length[15]|callback_username_check|xss_clean');
        $this->form_validation->set_rules('register[password]', 'Password', 'trim|required|min_length[6]|callback_password_check|xss_clean');
        //$this->form_validation->set_rules('register[passconf]', 'Password Confirmation', 'trim|required|matches[register[password]]|xss_clean'); // TODO Investigate why matches[] doesn't work with array
        $this->form_validation->set_rules('register[email]', 'Email', 'trim|required|valid_email|callback_email_check|xss_clean');
        $this->form_validation->set_rules('register[country]', 'Country', 'required|xss_clean');

        $this->form_validation->set_error_delimiters('<div style="color: #E13300">', '</div>');
    }

    public function username_check($username)
    {
        $error = $this->register_model->checkUsername($username);

        if ($error)
        {
            $this->form_validation->set_message('username_check',
                'The Username is already taken, please chose another one.'); // TODO I need to make a lang for this
            return false;
        }
        
        return true;
    }

    public function email_check($email)
    {
        $error = $this->register_model->checkEmailAddress($email);

        if ($error)
        {
            $this->form_validation->set_message('email_check',
                'The Email is already taken, did you <a href="#">forget the password</a> ?'); // TODO I need to make a lang for this
            return false;
        }

        return true;
    }

    public function password_check($password)
    {
        // check if the password has at least an uppercase and a number included
        if ( !(preg_match('~[A-Z]~', $password) && preg_match('~[a-z]~', $password) && preg_match('~\d~', $password)) )
        {
            $this->form_validation->set_message('password_check',
                    'The Password field does not contain at least a number and an uppercase letter.'); // TODO I need to make a lang for this
            return false;
        }

        return true;
    }
}
