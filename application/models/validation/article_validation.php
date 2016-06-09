<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_validation extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkArticleID($newsID)
    {
        $sqlSyntax = "SELECT ArticleID FROM {PRE}articles WHERE ArticleID = ? LIMIT 1";
        $error = $this->checkInDatabase($sqlSyntax, $newsID, true);

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