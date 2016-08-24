<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
    public function load_template($view, $title, $data=array())
    {
        $ci = &get_instance();

        $header['title'] = $title;
        $ci->load->view('header', $header);

        $ci->load->view($view, $data);

        $ci->load->view('footer');
    }
}