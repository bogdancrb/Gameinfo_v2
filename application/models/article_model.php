<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends CI_Model
{
    private $id;
    private $title;
    private $gameID;
    private $content;

    public function __construct()
    {
        parent::__construct();
    }

    public function addNewsArticle($post)
    {
        $this->title = $post['title'];
        $this->gameID = $post['game'];
        $this->content = $post['content'];

        $this->insertNewsArticleIntoDB();

        return true; // TODO If there is an error, then this will not work properly, rethink it
    }

    public function editNewsArticle($newsID, $post)
    {
        $this->id = $newsID;
        $this->title = $post['title'];
        $this->gameID = $post['game'];
        $this->content = $post['content'];

        $this->updateNewsArticleIntoDB();

        return true; // TODO If there is an error, then this will not work properly, rethink it
    }

    public function removeNewsArticle($gameID)
    {
        $this->gameID = $gameID;

        $this->deleteNewsArticleFromDB();

        return true; // TODO If there is an error, then this will not work properly, rethink it
    }

    private function insertNewsArticleIntoDB()
    {
        $sqlSyntax = "INSERT INTO {PRE}articles (Title, Content, Date, UserID, GameID) VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sqlSyntax, array($this->title, $this->content, date("Y-m-d H:i:s"), getUserId(), $this->gameID));
    }

    private function updateNewsArticleIntoDB()
    {
        $sqlSyntax = "UPDATE {PRE}articles SET Title = ?, Content = ?, GameID = ? WHERE ArticleID = ?";
        $this->db->query($sqlSyntax, array($this->title, $this->content, $this->gameID, $this->id));
    }

    private function deleteNewsArticleFromDB()
    {
        $sqlSyntax = "DELETE FROM {PRE}articles WHERE ArticleID = ?";
        $this->db->query($sqlSyntax, $this->gameID);
    }
}