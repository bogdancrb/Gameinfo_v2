<?php

class User_db_details extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserDetails($username)
    {
        $sqlSyntax = "SELECT UserID, Nickname FROM gameinfoV2_users WHERE Username = ? LIMIT 1";
        $result = $this->db->query($sqlSyntax, array($username));

        if ($result->num_rows() == 1)
        {
            return $result->result_array()[0];
        }

        return false;
    }
}