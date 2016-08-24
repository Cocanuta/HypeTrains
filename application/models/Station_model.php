<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create_station($name, $date, $type, $tags)
    {
        $data = array(
            'Name'      => $name,
            'Date'      => $date,
            'Type'      => $type,
            'Tags'      => $tags
        );

        return $this->db->insert('events', $data);
    }

    public function get_all_stations()
    {
        $stations = array();
        $query = $this->db->get('events');
        foreach($query->result() as $row)
        {
            $stations[] = new StationObject($row->ID, $row->Name, $row->Date, $row->Type, $row->Tags);
        }
        return $stations;
    }

    public function get_station($id)
    {
        $this->db->from('events');
        $this->db->where('ID', $id);
        $data = $this->db->get()->row();

        if($data !== null)
        {
            return new StationObject($data->ID, $data->Name, $data->Date, $data->Type, $data->Tags);
        }
        else
        {
            return null;
        }
    }

}

class StationObject
{
    public $ID;
    public $Name;
    public $Date;
    public $Type;
    public $Tags;

    public function __construct($id, $name, $date, $type, $tags)
    {
        $this->ID = $id;
        $this->Name = $name;
        $this->Date = $date;
        $this->Type = $type;
        $this->Tags = $tags;
    }
}



abstract class StationType
{
    const Movie = 0;
    const Game = 1;
    const TV = 2;
}