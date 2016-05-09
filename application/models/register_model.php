<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model
{
    private $nickname;
    private $username;
    private $password;
    private $email;
    private $country;

    public function __construct()
    {
        parent::__construct();
    }

    public function doRegister($post)
    {
        $this->nickname = $this->username = strtolower($post['username']);
        $this->password = hash('sha256', $post['password'], false);
        $this->email    = $post['email'];
        $this->country  = $post['country'];

        $this->insertUserIntoDB();

        return 'Thank you for your registration ! You can now login into your account.'; // TODO Make a lang for this
    }

    protected function insertUserIntoDB()
    {
        $sqlSyntax = "INSERT INTO gameinfoV2_users (Nickname, Username, Password, Email, RegDate, Country) VALUES (?, ?, ?, ?, ?, ?)";
        $this->db->query($sqlSyntax, array($this->nickname, $this->username, $this->password, $this->email, date("Y-m-d H:i:s"), $this->country));
    }
}