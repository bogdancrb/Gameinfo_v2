<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game_db_details extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllGames()
    {
       $sqlSyntax = "SELECT GameID as game_id, 
                            GameName as game_name
                     FROM {PRE}games
                     ORDER BY GameName ASC;";
        $result = $this->db->query($sqlSyntax);

        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }
        
        return false;
    }

    public function getAllLibraryGames($userID)
    {
        $sqlSyntax = "SELECT g.GameID as game_id,
                             GameName as game_name
                      FROM (
                              {PRE}games as g 
                              INNER JOIN 
                              {PRE}library as l 
                              ON g.GameID = l.GameID
                           )
                      WHERE UserID = ?
                      ORDER BY GameName ASC";
        $result = $this->db->query($sqlSyntax, $userID);

        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }

        return false;
    }

    public function getGameDetails($gameID)
    {
        $sqlSyntax = "SELECT GameName as game_name, 
                             Platform as game_platform, 
                             Genre as game_genre, 
                             WikiURL as game_wikiurl, 
                             Image as game_image,
                             Description as game_description,
                             Trailer as game_trailer,
                             OS as game_os_req,
                             CPU as game_cpu_req,
                             RAM as game_ram_req,
                             Video as game_video_req
                      FROM {PRE}games
                      WHERE GameID = ? LIMIT 1;";
        $result = $this->db->query($sqlSyntax, $gameID);

        if ($result->num_rows() == 1)
        {
            return $result->row_array();
        }

        return false;
    }
}
