<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_controller extends Gameinfo_Controller
{
    const PAGE_NAME = 'Login'; // TODO I need to make a lang for this

    private $data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->load->model(array('login_model', 'user_validation'));
    }

    public function index()
    {
        $this->data = array(
            'page_name'     => self::PAGE_NAME,
        );

        $this->validateForm();

        if ($this->form_validation->run() == FALSE)
        {
            $this->loadTemplate('login', $this->data);
        }
        else
        {
            $post = $this->input->post('login');

            $error = $this->password_check($post['username'], $post['password']);

            if ($error)
            {
                $this->data['error'] = $error;
                $this->loadTemplate('login', $this->data);
            }
            else
            {
                $this->login_model->doLogin($post);
                redirect('home');
            }
        }
    }

    private function validateForm()
    {
        $this->form_validation->set_rules('login[username]', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('login[password]', 'Password', 'trim|required|xss_clean');

        $this->form_validation->set_error_delimiters('<div style="color: #E13300">', '</div>');
    }

    public function password_check($username, $password)
    {
        $error = $this->user_validation->checkPassword(strtolower($username), hash('sha256', $password, false));

        if ($error)
        {
            return 'Username or password are incorect, did you <a href="#">forget the password</a> ?'; // TODO I need to make a lang for this
        }

        return false;
    }
}
