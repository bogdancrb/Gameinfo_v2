<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_controller extends Gameinfo_Controller
{
    const PAGE_NAME = 'News'; // TODO I need to make a lang for this
    const MAX_CONTENT_SIZE = 1000;

    private $data;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('article_db_details');
    }

    public function index()
    {
        $this->load->library('parser');

        $this->data = array(
            'page_name'   => self::PAGE_NAME
        );

        $articles = $this->article_db_details->getNewsArticlesDetails();

        if (is_array($articles))
        {
            foreach ($articles as $key => $news_article)
            {
                if (strlen($news_article['news_content']) > self::MAX_CONTENT_SIZE)
                {
                    $news_article['news_content'] = substr($news_article['news_content'], 0, self::MAX_CONTENT_SIZE) . '...';
                    $news_article['news_read_more'] = 'Read more';
                }
                else
                {
                    $news_article['news_read_more'] = null;
                }

                if (empty($news_article['news_game']))
                {
                    $news_article['news_game'] = 'gaming in general';
                }

                $articles[$key] = $news_article;
            }

            $this->data['news_articles'] = $articles;
        }
        else
        {
            $this->data['error'] = $articles;
        }

        $this->loadTemplate('home', $this->data, false, true);
    }
}
