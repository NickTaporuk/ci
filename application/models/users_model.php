<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
//        echo 111;
        $this->load->database();
//        var_dump($this->load->database());
    }
    public function get_users(){
        $query = $this->db->get('users');
        return $query->result_array();
    }
}

/* End of file welcome.php */
/* Location: ./application/controlalers/welcome.php */