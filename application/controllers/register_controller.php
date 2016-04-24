<?php

class Register_controller extends Gameinfo_Controller
{
    const PAGE_TITLE_DESCRPTION = 'Register'; // TODO I need to make a lang for this

    private $cfg;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->cfg = array(
            'title_description'   => self::PAGE_TITLE_DESCRPTION
        );

        $this->loadTemplate('register', $this->cfg);
    }
}
