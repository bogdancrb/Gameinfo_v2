<?php
/**
 * @property CI_Input $input                      Pre-processes global input data for security
 * @property CI_Form_validation $form_validation  Form Validation Class
 * @property Article_db_details $article_db_details
 * @property Game_db_details $game_db_details
 * @property Article_model $article_model
 * @property Game_validation $game_validation
 * @property Article_validation $article_validation
**/

class Admin_panel_controller extends Gameinfo_Controller
{
    const PAGE_NAME = 'Admin Panel';
    const VIEWS_FOLDER_NAME = 'admin_panel';

    private $data;

    public function __construct()
    {
        parent::__construct();

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

    public function articles($action = null, $newsID = null)
    {
        switch ($action)
        {
            case 'add':
                $this->addArticle();
                break;
	        case 'edit':
		        $this->editArticle($newsID);
		        break;
            case 'remove':
                $this->removeArticle($newsID);
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

	private function showAllArticles()
    {
        $this->load->helper('form');
        $this->load->model('db_details/article_db_details');

        $articles = $this->article_db_details->getAllNewsArticles();

        if (is_array($articles))
        {
            $this->data['news_articles'] = $articles;
        }
        else
        {
            $this->data['error'] = 'There are no news articles, check back later. :)'; //TODO I need to make a lang for this
        }

        $this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'articles', $this->data);
    }

    private function addArticle()
    {
        $post = $this->input->post('article');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model(array('db_details/game_db_details', 'article_model'));

        $this->validateAddArticleForm();

        $gamesData = $this->game_db_details->getAllGames(false);

        $gameListOptions[''] = 'None'; // TODO Make lang for this

	    if ($gamesData)
	    {
		    foreach ($gamesData as $key => $value)
		    {
			    $gameID = $value['game_id'];
			    $gameName = $value['game_name'];

			    $gameListOptions[$gameID] = $gameName;
		    }
	    }

        $this->data['game_titles'] = $gameListOptions;

        if ($this->form_validation->run() == TRUE)
        {
	        $error = isset($gameListOptions[$post['game']]) ?
		        $this->validate_game_name($gameListOptions[$post['game']]) : 'The Game field contains an invalid value.'; // TODO Make a lang for this

            if ($error)
            {
                $this->data['error_message'] = $error;
            }
            else
            {
                $this->article_model->addNewsArticle($post);
                $this->data['message'] = 'The news article was published.'; // TODO Make a lang for this
            }
        }

        $this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'article_add', $this->data);
    }

	private function editArticle($newsID)
	{
		if (!empty($newsID) && ctype_xdigit($newsID))
		{
			$post = $this->input->post('article');

			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model(array('db_details/game_db_details', 'db_details/article_db_details', 'article_model'));

			$article = $this->article_db_details->getNewsArticle($newsID);

			if ($article)
			{
				$this->validateAddArticleForm();

				$gamesData = $this->game_db_details->getAllGames(false);

				$gameListOptions[''] = 'None'; // TODO Make lang for this

				if ($gamesData)
				{
					foreach ($gamesData as $key => $value)
					{
						$gameID = $value['game_id'];
						$gameName = $value['game_name'];

						$gameListOptions[$gameID] = $gameName;
					}
				}

				$this->data['game_titles'] = $gameListOptions;

				$this->data = array_merge($this->data, $article);

				if ($this->form_validation->run() == TRUE)
				{
					$error = $this->validate_game_name($gameListOptions[$post['game']]);

					if ($error)
					{
						$this->data['error_message'] = $error;
					}
					else
					{
						$this->article_model->editNewsArticle($this->data['news_id'], $post);
						$this->data['message'] = 'The news article was edited.'; // TODO Make a lang for this
					}
				}
			}
		}
		else
		{
			$this->data['error_message'] = 'The article you are trying to edit was not found.';
		}

		$this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'article_edit', $this->data);
	}

	private function removeArticle($newsID)
    {
        if (!empty($newsID) && ctype_xdigit($newsID))
        {
            $error = $this->validate_article_id($newsID);

            if ($error)
            {
                $this->data['error_message'] = $error;
            }
            else
            {
                $this->load->model('article_model');

                $this->article_model->removeNewsArticle($newsID);
                $this->data['message'] = 'The news article has been deleted.'; // TODO Make a lang for this
            }
        }
        else
        {
            $this->data['error_message'] = 'The article you are trying to delete was not found. Redirecting to previous page in 5 seconds.';
        }

        $this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'article_remove', $this->data);
    }

    private function validateAddArticleForm()
    {
        $this->form_validation->set_rules('article[title]', 'Article title', 'trim|required|min_length[8]|max_length[50]|xss_clean');
        $this->form_validation->set_rules('article[game]', 'Game title', 'trim|xss_clean');
        $this->form_validation->set_rules('article[content]', 'Article content', 'trim|required|min_length[30]|xss_clean');

        $this->form_validation->set_error_delimiters('<div style="color: #E13300">', '</div>');
    }

    private function validate_game_name($gameName)
    {
        $this->load->model('validation/game_validation');

        $error = $this->game_validation->checkGameName($gameName);

        if ($error && $gameName != 'None')
        {
            return 'The Game field contains an invalid value.'; // TODO Make a lang file for this
        }

        return false;
    }

    private function validate_article_id($newsID)
    {
        $this->load->model('validation/article_validation');

        $error = $this->article_validation->checkArticleID($newsID);

        if ($error)
        {
            return 'The article you are trying to delete was not found. Redirecting to previous page in 5 seconds.'; // TODO Make a lang file for this
        }

        return false;
    }
}