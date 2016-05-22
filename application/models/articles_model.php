<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_model extends CI_Model
{
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

        return 'The news article was published.'; // TODO Make a lang for this
    }

    private function insertNewsArticleIntoDB()
    {
        $sqlSyntax = "INSERT INTO {PRE}articles (Title, Content, Date, UserID, GameID) VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sqlSyntax, array($this->title, $this->content, date("Y-m-d H:i:s"), getUserId(), $this->gameID));
    }
}