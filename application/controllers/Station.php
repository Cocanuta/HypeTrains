<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('station_model'));
    }

    public function index()
    {
        $content['stations'] = $this->station_model->get_all_stations();
        $this->template->load_template('stations/all', "All Stations", $content);
    }
}