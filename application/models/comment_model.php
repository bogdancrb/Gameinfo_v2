<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model
{
	private $articleID;
	private $comment;

	public function __construct()
	{
		parent::__construct();
	}

	public function addComment($articleID, $post)
	{
		$this->articleID = $articleID;
		$this->comment = $post['comment'];

		$this->insertCommentIntoDB();

		return true; // TODO If there is an error, then this will not work properly, rethink it
	}

	private function insertCommentIntoDB()
	{
		$sqlSyntax = "INSERT INTO {PRE}comments (Content, Date, UserID, ArticleID) VALUES (?, ?, ?, ?)";
		$this->db->query($sqlSyntax, array($this->comment, date("Y-m-d H:i:s"), getUserId(), $this->articleID));
	}
}