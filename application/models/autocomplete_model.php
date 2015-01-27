<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class autocomplete_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    /**
     * @return mixed
     */
    public function city_autocomplete()
    {
//        $q = urldecode($_POST['term']);
        $q = $_POST['q'];
        $qr = 'SELECT name,id FROM city where name LIKE "'.$q.'%"';
        $query = $this->db->query($qr);
        $data = array();
        if ($query->num_rows() >= 1) {
            $rows = $query->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                /*$data[] =array(
                    'label'      => $row['name'],
                    'value'   => $row['name'],
                );*/
                $data[] = $row['name'];
            }
        }
//        var_dump($data);
        return $data;
//        return $query->result_array();
    }
}