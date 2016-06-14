<?php

/**
 * @property CI_Input $input                      Pre-processes global input data for security
 * @property CI_Form_validation $form_validation  Form Validation Class
 * @property Article_db_details $article_db_details
 * @property Comment_model $comment_model
**/

class Article_controller extends Gameinfo_Controller
{
	const PAGE_NAME = 'Article'; // TODO I need to make a lang for this
	private $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model(array('db_details/article_db_details', 'comment_model'));
	}

	public function read($newsID)
	{
		$this->data = array(
			'page_name'   => self::PAGE_NAME
		);

		if (!empty($newsID) && ctype_xdigit($newsID))
		{
			$article = $this->article_db_details->getNewsArticle($newsID);

			if ($article)
			{
				$post = $this->input->post('article');

				$this->validateAddCommentForm();

				$this->data['form_run'] = false;

				if ($this->form_validation->run() == TRUE)
				{
					$this->comment_model->addComment($newsID, $post);
					$this->data['form_run'] = true;
				}

				$this->data['page_name'] = $article['news_title'];

				$this->data = array_merge($this->data, $article);

				$this->data['news_comments'] = $this->article_db_details->getNewsArticleComments($newsID);
			}
			else
			{
				$this->data['error'] = 'The article you are trying to view was not found.'; // Todo make lang for this
			}
		}
		else
		{
			$this->data['error'] = 'The article you are trying to view was not found.'; // Todo make lang for this
		}

		$this->loadTemplate('news_article', $this->data);
	}

	private function validateAddCommentForm()
	{
		$this->form_validation->set_rules('article[comment]', 'Article comment', 'trim|required|min_length[3]|max_length[255]|xss_clean');

		$this->form_validation->set_error_delimiters('<div style="color: #E13300">', '</div>');
	}
}