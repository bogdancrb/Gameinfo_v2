<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_db_details extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAllNewsArticles()
    {
        $sqlSyntax = "SELECT Title as news_title, 
                             DATE_FORMAT(Date, '%d.%m.%Y %T') as news_date, 
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
                      ORDER BY Date DESC";
        $result = $this->db->query($sqlSyntax);

        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }

        return false;
    }

    public function getNewsArticle($newsID)
    {
        $sqlSyntax = "SELECT Title as news_title, 
                             DATE_FORMAT(Date, '%d.%m.%Y %T') as news_date, 
                             Content as news_content, 
                             ArticleID as news_id, 
                             Nickname as news_author,
                             a.UserID as news_author_id,
                             GameName as news_game,
                             a.GameID as news_game_id
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
                      WHERE ArticleID = ? LIMIT 1";
        $result = $this->db->query($sqlSyntax, $newsID);

        if ($result->num_rows() == 1)
        {
            return $result->row_array();
        }

        return false;
    }

    public function getNewsArticleComments($newsID)
    {
        $sqlSyntax = "SELECT CommentID as news_comment_id, 
                             DATE_FORMAT(Date, '%d.%m.%Y %T') as news_comment_date, 
                             Content as news_comment_content,
                             Nickname as news_comment_user_nickname,
                             c.UserID as news_comment_user_id
                      FROM (
                              {PRE}comments as c
                              LEFT JOIN 
                              {PRE}users as u 
                              ON u.UserID = c.UserID
                           )
                      WHERE ArticleID = ?
                      ORDER BY Date ASC";
        $result = $this->db->query($sqlSyntax, $newsID);

        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }

        return false;
    }
}