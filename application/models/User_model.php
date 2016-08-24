<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create_user($username, $password, $email, $firstname, $lastname)
    {
        $data = array(
            'Username'      => $username,
            'Password'      => $password,
            'Email'         => $email,
            'FirstName'     => $firstname,
            'LastName'      => $lastname
        );

        return $this->db->insert('users', $data);
    }


}