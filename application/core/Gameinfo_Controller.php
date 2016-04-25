<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gameinfo_Controller extends CI_Controller
{
    const SEPARATOR = "::";

    public function __construct()
    {
        parent::__construct();
    }

    protected function loadTemplate($template_name, $vars = array(), $return = false)
    {
        $cfg = array(
            'site_title'            => $this->config->item('site_title'),
            'site_copyright'        => $this->config->item('site_copyright'),
            'title_description'     => isset($vars['title_description']) ?  ' '. self::SEPARATOR . ' ' . $vars['title_description'] : ''
        );

        $content = $this->load->view('page/header', $cfg, $return);

        $content .= $this->load->view($template_name, $vars, $return);

        $content .= $this->load->view('page/footer', $cfg, $return);

        if ($return)
        {
            return $content;
        }
        else
        {
            return false;
        }
    }
}