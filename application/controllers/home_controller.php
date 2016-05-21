<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_controller extends Gameinfo_Controller
{
    const PAGE_NAME = 'News'; // TODO I need to make a lang for this

    private $data;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {
        $this->load->library('parser');

        $this->data = array(
            'page_name'   => self::PAGE_NAME
        );

        $articles = $this->home_model->getNewsArticles();

        if (is_array($articles))
        {
            $this->data['news_articles'] = $articles;

            if (strlen($this->data['news_articles']['news_content']) > 100)
            {
                $this->data['news_articles']['news_read_more'] = 'Read more';
            }
            else
            {
                $this->data['news_articles']['news_read_more'] = '';
            }
        }
        else
        {
            $this->data['error'] = $articles;
        }

        $this->loadTemplate('home', $this->data, false, true);
    }
}
