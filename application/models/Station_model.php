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

        return $this->db->insert('stations', $data);
    }

    public function get_all_stations()
    {
        $stations = array();
        $query = $this->db->get('stations');
        foreach($query->result() as $row)
        {
            $stations[] = new StationObject($row->ID, $row->Name, $row->Date, $row->Type, $row->Tags, $row->Slug);
        }
        return $stations;
    }

    public function get_station($id)
    {
        $this->db->from('stations');
        $this->db->where('ID', $id);
        $data = $this->db->get()->row();

        if($data !== null)
        {
            return new StationObject($data->ID, $data->Name, $data->Date, $data->Type, $data->Tags, $data->Slug);
        }
        else
        {
            return null;
        }
    }

    public function get_station_from_slug($slug)
    {
        $this->db->from('stations');
        $this->db->where('Slug', $slug);
        $data = $this->db->get()->row();

        if($data !== null)
        {
            return new StationObject($data->ID, $data->Name, $data->Date, $data->Type, $data->Tags, $data->Slug);
        }
        else
        {
            return null;
        }

    }

    public function name_to_slug($name)
    {
        $name = preg_replace('~[^\pL\d]+~u', '-', $name);

        $name = iconv('utf-8', 'us-ascii//TRANSLIT', $name);

        $name = preg_replace('~[^-\w]+~', '', $name);

        $name = trim($name, '-');

        $name = preg_replace('~-+~', '-', $name);

        $name = strtolower($name);

        if (empty($name)) {
            return 'n-a';
        }

        return $name;
    }

}

class StationObject
{
    public $ID;
    public $Name;
    public $Date;
    public $Type;
    public $Tags;
    public $Slug;

    public function __construct($id, $name, $date, $type, $tags, $slug)
    {
        $this->ID = $id;
        $this->Name = $name;
        $this->Date = $date;
        $this->Type = $type;
        $this->Tags = $tags;
        $this->Slug = $slug;
    }
}



abstract class StationType
{
    const Movie = 0;
    const Game = 1;
    const TV = 2;

    public static function getName($id)
    {
        if($id == self::Movie)
        {
            return "Movie";
        }
        elseif($id == self::Game)
        {
            return "Game";
        }
        elseif($id == self::TV)
        {
            return "Television";
        }
        else
        {
            return "Null";
        }
    }
}