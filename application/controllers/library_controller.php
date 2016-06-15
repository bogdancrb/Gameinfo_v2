<?php

class Library_controller extends Gameinfo_Controller
{
    const PAGE_NAME = 'My Games';
    const VIEWS_FOLDER_NAME = 'library';

    private $data;

    public function __construct()
    {
        parent::__construct();

        $this->redirectIfUserNotLoggedIn();
    }

    public function index()
    {
        $this->viewGameDetails(null, true);
    }

    public function viewGameDetails($gameID, $accesFromIndex = false)
    {
        $this->load->model('db_details/game_db_details');

        $this->data = array(
            'page_name' => self::PAGE_NAME
        );

        $libraryGameIDs = $this->game_db_details->getAllLibraryGames(getUserId());

        if ($libraryGameIDs)
        {
            $this->data['library_games'] = $libraryGameIDs;
            $gameDetails = $this->game_db_details->getGameDetails($accesFromIndex ?
                $libraryGameIDs[0]['game_id'] : $gameID);

            if (is_array($gameDetails))
            {
                $this->data['game_details'] = $gameDetails;
            } else
            {
                $this->data['error'] = 'This game is not in your library !';
            }
        } else
        {
            $this->data['message'] = 'You do not have any games added in the library.';
        }

        $this->loadTemplate(self::VIEWS_FOLDER_NAME . DS . 'index', $this->data);
    }

    public function deleteGameFromLibrary($gameID)
    {

    }

    public function addGameToLibrary()
    {
        // This functionality is not ready unfortunately

        $this->load->helper('form');
        $this->load->model('db_details/game_db_details');
        $this->load->library('form_validation');

        $post = $this->input->post('library');

        $gamesData = $this->game_db_details->getAllGames();

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

        if ($post)
        {
            // here the game should be added to the library
            redirect('library');
        }

        $this->data['game_titles'] = $gameListOptions;

        echo $this->load->view(self::VIEWS_FOLDER_NAME . DS . 'library_add_game', $this->data, true);
    }
}