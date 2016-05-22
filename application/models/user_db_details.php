<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_db_details extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserDetails($username, $password)
    {
        $sqlSyntax = "SELECT u.UserID, Nickname, Email, Country, AccessLevel
                      FROM ({PRE}users as u LEFT JOIN {PRE}administrators as a ON u.UserID = a.UserID)
                      WHERE Username = ? AND Password = ? LIMIT 1";
        $result = $this->db->query($sqlSyntax, array($username, $password));

        if ($result->num_rows() == 1)
        {
            return $result->row_array();
        }

        return false;
    }
}