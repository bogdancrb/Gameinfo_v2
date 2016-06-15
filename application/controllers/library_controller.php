<?php

class Library_controller extends Gameinfo_Controller
{
    const PAGE_NAME = 'My Games';

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

        $this->loadTemplate('library', $this->data);
    }
}