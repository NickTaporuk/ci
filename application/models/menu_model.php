<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @return mixed
     */
    public function get_all_menu(){
        $query = $this->db->get('multi_level_menu');
        return $query->result_array();
    }
}

/* End of file welcome.php */
/* Location: ./application/controlalers/welcome.php */