<?php

class Article_db_details extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getNewsArticlesDetails()
    {
        $sqlSyntax = "SELECT Title as news_title, 
                             DATE_FORMAT(Date, '%d/%m/%Y %T') as news_date, 
                             Content as news_content, 
                             ArticleID as news_id, 
                             Nickname as news_author,
                             a.UserID as news_author_id,
                             GameName as news_game
                      FROM (
                            ( 
                              {PRE}articles as a 
                              LEFT JOIN 
                              {PRE}users as u 
                              ON u.UserID = a.UserID
                            ) 
                            LEFT JOIN 
                            {PRE}games as g 
                            ON a.GameID = g.GameID
                           )
                      ORDER BY news_date DESC";
        $result = $this->db->query($sqlSyntax);

        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }

        return 'There are no news articles, check back later. :)'; // TODO I need to make a lang for this
    }
}