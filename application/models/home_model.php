<?php

class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getNewsArticles()
    {
        $sqlSyntax = "SELECT Title as news_title, 
                             DATE_FORMAT(Date, '%d/%m/%Y') as news_date, 
                             Content as news_content, 
                             ArticleID as news_id, 
                             Nickname as news_author,
                             a.UserID as news_author_id,
                             GameName as news_game
                      FROM {PRE}articles as a, {PRE}users as u, {PRE}games as g
                      WHERE u.UserID = a.UserID AND g.GameID = a.GameID
                      ORDER BY news_date DESC";
        $result = $this->db->query($sqlSyntax);

        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }

        return 'There are no news articles, check back later. :)'; // TODO I need to make a lang for this
    }
}