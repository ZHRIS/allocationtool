<?php

/*
 * File Name: distance_model.php
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distance_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_last_entries($total)
    {
        $this->db->from('distance', $total);
        $this->db->join('location', 'distance.location_id = location.location_id');
        $this->db->join('demand_location', 'distance.demand_location_id = demand_location.demand_location_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_list()
    {
        $this->db->from('distance');
        $this->db->join('location', 'distance.location_id = location.location_id');
        $this->db->join('demand_location', 'distance.demand_location_id = demand_location.demand_location_id');
        $query = $this->db->get();
        return $query->result();
    }

    function get($id)
    {
        $this->db->from('distance');
        $this->db->where('distance_id', $id);
        $this->db->join('location', 'distance.location_id = location.location_id');
        $this->db->join('demand_location', 'distance.demand_location_id = demand_location.demand_location_id');
        $query = $this->db->get();
        return $query->row();
    }

    public function save()
    {
        $this->demand_location_id = $this->input->post('demand_location_id');
        $this->location_id = $this->input->post('location_id');
        $this->road_distance = $this->input->post('road_distance');
        $this->db->insert('distance', $this);
    }

    public function update($id)
    {
        $this->location_id = $this->input->post('distance_id');
        $this->demand_location_id = $this->input->post('demand_location_id');
        $this->location_id = $this->input->post('location_id');
        $this->road_distance = $this->input->post('road_distance');
        $this->db->where('distance_id', $id);
        $this->db->update('distance', $this);
    }

    function delete($id)
    {
        $this->db->where('distance_id', $id);
        $this->db->delete('distance');
    }

    function deleteAll()
    {
        $this->db->empty_table('distance');
    }

    function get_distance($location_id, $demand_location_id)
    {
        $this->db->distinct();
        $this->db->from('distance');
        $this->db->where('location_id', $location_id);
        $this->db->where('demand_location_id', $demand_location_id);
        $query = $this->db->get();
        return $query->num_rows();

    }

    public function check_duplicate($location_id, $demand_location_id)
    {
        if ($this->get_distance($location_id, $demand_location_id) == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
