<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_validation extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkUsername($username)
    {
        $sqlSyntax = "SELECT Username FROM {PRE}users WHERE Username = ? LIMIT 1";
        $error = $this->checkInDatabase($sqlSyntax, $username);

        return $error;
    }

    public function checkPassword($username, $password)
    {
        $sqlSyntax = "SELECT Username FROM {PRE}users WHERE Username = ? AND Password = ? LIMIT 1";
        $error = $this->checkInDatabase($sqlSyntax, array($username, $password), true);

        return $error;
    }

    public function checkEmailAddress($email)
    {
        $sqlSyntax = "SELECT Email FROM {PRE}users WHERE Email = ? LIMIT 1";
        $error = $this->checkInDatabase($sqlSyntax, $email);

        return $error;
    }

    private function checkInDatabase($sqlSyntax, $params, $exists = false)
    {
        $result = $this->db->query($sqlSyntax, $params);

        if ($result->num_rows() > 0)
        {
            return !$exists;
        }

        return $exists;
    }
}