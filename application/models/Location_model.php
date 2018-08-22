<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Location Model
 *
 * @author tdhlakama
 */
class Location_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get($id)
    {
        $this->db->from('location');
        $this->db->where('location_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_last_ten_entries()
    {
        $query = $this->db->get('location', 10);
        return $query->result();
    }

    public function get_list()
    {
        $query = $this->db->get('location');
        return $query->result();
    }

    public function save()
    {
        $this->location_name = $this->input->post('location_name');
        $this->longitude_coordinate = $this->input->post('longitude_coordinate');
        $this->latitude_coordinate = $this->input->post('latitude_coordinate');
        $this->db->insert('location', $this);
    }

    public function save_name($name)
    {
        $this->location_name = $name;
        $this->db->insert('location', $this);
    }

    public function update($id)
    {
        $this->location_name = $this->input->post('location_name');
        $this->longitude_coordinate = $this->input->post('longitude_coordinate');
        $this->latitude_coordinate = $this->input->post('latitude_coordinate');
        $this->db->where('location_id', $id);
        $this->db->update('location', $this);
    }

    function get_locations_list($q)
    {
        $this->db->distinct();
        $this->db->from('location');
        $this->db->like('location_name', $q);
        $query = $this->db->get();
        return $query->result();
    }

    function get_search($q)
    {
        $this->db->from('location');
        $this->db->where('location_name', $q);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function search($q)
    {
        $this->db->from('location');
        $this->db->where('location_name', $q);
        $query = $this->db->get();
        return $query->row();
    }

    function get_row_count()
    {
        return $this->db->count_all('location');
    }

    function get_search_count($q)
    {
        $this->db->from('location');
        $this->db->like('location_name', $q);
        $query = $this->db->get();
        return $query->num_rows();
    }


    function get_search_list($q)
    {
        $this->db->from('location');
        $this->db->like('location_name', $q);
        $query = $this->db->get();
        return $query->result();
    }

    function check_duplicate($q)
    {
        if ($this->get_search($q) == 0) {
            return false;
        } else {
            return true;
        }
    }

    function delete($id)
    {
        $this->db->where('location_id', $id);
        $this->db->delete('location');
    }

    function get_location_dropdown()
    {
        $this->db->select('location_id');
        $this->db->select('location_name');
        $this->db->from('location');
        $query = $this->db->get();
        $result = $query->result();

        $_id = array('-SELECT-');
        $_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($_id, $result[$i]->location_id);
            array_push($_name, $result[$i]->location_name);
        }
        return $list_result = array_combine($_id, $_name);
    }

    function deleteAll() {
        $this->db->empty_table('location');
    }

}
