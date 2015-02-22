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
    public function city_autocomplete($limit=15)
    {
//        var_dump($_POST);
//        exit;
//        $q = urldecode($_POST['term']);
//        $q = $_POST['q'] = 'а';
//        $q = ($_POST['q'])?$_POST['q']:false;
        $q = ($_POST['ch'])?$_POST['ch']:false;
//            if($q) {
                $qr = "SELECT name,id FROM city where name LIKE '$q%' LIMIT $limit";
                $query = $this->db->query($qr);
                $data = array();
                if ($query->num_rows() >= 1) {
                    $rows = $query->result_array();
                    foreach ($rows as $row) {
                        //  $data[] = $row ;
                        $data[] =array(
                            'label'      => $row['name'],
                            'value'   => $row['name'],
                            'id'   => $row['id'],
                        );
                    }
                }
                return $data;
//            } else {
//                return [] ;
//            }
//        return $query->result_array();
    }
}