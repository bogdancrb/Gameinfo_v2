<?php

class Register_model extends CI_Model
{
    private $username;
    private $password;
    private $email;
    private $country;

    public function addNewUser($post)
    {
        $this->username = $post['username'];
        $this->password = hash('sha256', $post['password'], false);
        $this->email    = $post['email'];
        $this->country  = $post['country'];

        $this->insertUserIntoDB();

        return 'Thank you for your registration ! You can now login into your account.'; // TODO Make a lang for this, and move the error if necessary
    }

    public function checkUsername($username)
    {
        $sqlSyntax = "SELECT Username FROM gameinfoV2_users WHERE Username = ? LIMIT 1";
        $error = $this->checkDatabase($sqlSyntax, $username);

        return $error;
    }

    public function checkEmailAddress($email)
    {
        $sqlSyntax = "SELECT Email FROM gameinfoV2_users WHERE Email = ? LIMIT 1";
        $error = $this->checkDatabase($sqlSyntax, $email);

        return $error;
    }

    private function checkDatabase($sqlSyntax, $params)
    {
        $result = $this->db->query($sqlSyntax, $params);

        if ($result->num_rows() > 0)
        {
            return true;
        }

        return false;
    }

    private function insertUserIntoDB()
    {
        $sqlSyntax = "INSERT INTO gameinfoV2_users (Username, Password, Email, RegDate, Country) VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sqlSyntax, array($this->username, $this->password, $this->email, date("Y-m-d H:i:s"),$this->country));
    }
}