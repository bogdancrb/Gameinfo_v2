<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game_db_details extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getGamesDetails($getAllData = true)
    {
        if ($getAllData)
        {
            $sqlSyntax = "SELECT GameID as game_id, 
                                 GameName as game_name, 
                                 Platform as game_platform, 
                                 Genre as game_genre, 
                                 WikiURL as game_wikiurl 
                          FROM {PRE}games;";
        }
        else
        {
            $sqlSyntax = "SELECT GameID as game_id, 
                                 GameName as game_name
                          FROM {PRE}games
                          ORDER BY game_name ASC;";
        }
        $result = $this->db->query($sqlSyntax);

        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }
        
        return false;
    }
}
