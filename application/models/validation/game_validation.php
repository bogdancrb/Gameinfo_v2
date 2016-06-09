<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game_validation extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkGameName($gameName)
    {
        $sqlSyntax = "SELECT GameName FROM {PRE}games WHERE GameName = ? LIMIT 1";
        $error = $this->checkInDatabase($sqlSyntax, $gameName, true);

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