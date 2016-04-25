<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_controller extends Gameinfo_Controller
{
    const PAGE_TITLE_DESCRIPTION = 'Home'; // TODO I need to make a lang for this

    private $cfg;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->cfg = array(
            'title_description'   => self::PAGE_TITLE_DESCRIPTION
        );

        $this->loadTemplate('home', $this->cfg);
    }
}
