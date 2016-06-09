<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game_db_details extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllGames($getAllData = true)
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
                          ORDER BY GameName ASC;";
        }
        $result = $this->db->query($sqlSyntax);

        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }
        
        return false;
    }

    public function getGame($gameID, $getAllData = true)
    {
        if ($getAllData)
        {
            $sqlSyntax = "SELECT GameID as game_id, 
                                 GameName as game_name, 
                                 Platform as game_platform, 
                                 Genre as game_genre, 
                                 WikiURL as game_wikiurl 
                          FROM {PRE}games;
                          WHERE GameID = ? LIMIT 1";
        }
        else
        {
            $sqlSyntax = "SELECT GameID as game_id, 
                                 GameName as game_name
                          FROM {PRE}games
                          WHERE GameID = ? LIMIT 1";
        }
        $result = $this->db->query($sqlSyntax, $gameID);

        if ($result->num_rows() == 1)
        {
            return $result->row_array();
        }

        return false;
    }
}
