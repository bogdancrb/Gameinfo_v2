<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_controller extends Gameinfo_Controller
{
    const PAGE_NAME = 'Home'; // TODO I need to make a lang for this

    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data = array(
            'page_name'   => self::PAGE_NAME
        );

        $this->loadTemplate('home', $this->data);
    }
}
