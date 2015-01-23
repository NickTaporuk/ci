<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
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
    public function get_users()
    {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function get_user($id)
    {
        $this->db->limit('1');
        $this->db->order_by('id');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function insert_user(array $user)
    {
        $this->db->insert('users', $user);
        return true;
    }

    public function edit_user(array $user)
    {
        try {
            if ($user['id']) {
                $this->db->where('id', $user['id']);
                unset($user['id']);
                $this->db->update('users', $user);
            } else {
                $error  = 'No id in array IN FUNCTION :'.__FUNCTION__.' LINE :'.__LINE__;
                throw new Exception($error);
            }

        } catch (Exception $e) {
            error_log($e->getMessage());
        }

    }

}