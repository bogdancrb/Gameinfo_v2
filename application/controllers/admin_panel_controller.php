<?php

class Admin_panel_controller extends Gameinfo_Controller
{
    const PAGE_NAME = 'Admin Panel';
    const VIEWS_FOLDER_NAME = 'admin_panel';

    private $data;
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('table');

        $this->load->model('game_validation');
        
        $this->redirectIfUserNotAdmin();

        $this->data = array(
            'page_name'     => self::PAGE_NAME,
            'menu'          => $this->load->view(self::VIEWS_FOLDER_NAME . DS . 'navigation_menu', '', true)
        );
    }

    public function index()
    {
        $this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'index', $this->data);
    }

    public function articles($action = null)
    {
        switch ($action)
        {
            case 'add':
                $this->addArticle();
                break;
            default:
               $this->showAllArticles();
                break;
        }
    }
    public function users()
    {
        $this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'users', $this->data);
    }

    public function showAllArticles()
    {
        $this->load->model('article_db_details');

        $articles = $this->article_db_details->getNewsArticlesDetails();

        if (is_array($articles))
        {
            $this->data['news_articles'] = $articles;
        }
        else
        {
            $this->data['error'] = $articles;
        }

        $this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'articles', $this->data);
    }

    public function addArticle()
    {
        $post = $this->input->post('article');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model(array('game_db_details', 'articles_model'));

        $this->validateAddArticleForm();

        $gamesData = $this->game_db_details->getGamesDetails(false);

        $gameListOptions[''] = 'None'; // TODO Make lang for this

        foreach ($gamesData as $key => $value)
        {
            $gameID = $value['game_id'];
            $gameName = $value['game_name'];

            $gameListOptions[$gameID] = $gameName;
        }

        $this->data['game_titles'] = $gameListOptions;

        if ($this->form_validation->run() == TRUE)
        {
            $error = $this->game_check($gameListOptions[$post['game']]);

            if ($error)
            {
                $this->data['error_message'] = $error;
            }
            else
            {
                $message = $this->articles_model->addNewsArticle($post);
                $this->data['message'] = $message;
            }
        }

        $this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'article_add', $this->data);
    }

    private function validateAddArticleForm()
    {
        $this->form_validation->set_rules('article[title]', 'Article title', 'trim|required|min_length[8]|max_length[50]|xss_clean');
        $this->form_validation->set_rules('article[game]', 'Game title', 'trim|xss_clean');
        $this->form_validation->set_rules('article[content]', 'Article content', 'trim|required|min_length[30]|xss_clean');

        $this->form_validation->set_error_delimiters('<div style="color: #E13300">', '</div>');
    }

    private function game_check($gameName)
    {
        $error = $this->game_validation->checkGameName($gameName);

        if ($error && $gameName != 'None')
        {
            return 'The Game field contains an invalid value.'; // TODO Make a lang file for this
        }

        return false;
    }
}