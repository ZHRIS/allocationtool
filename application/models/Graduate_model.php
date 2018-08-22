<?php

/*
 * File Name: graduate_model.php
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Graduate_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_last_entries($total) {
        $this->db->distinct();
        $this->db->from('graduate', $total);
        $this->db->join('location', 'graduate.location_id = location.location_id');
        $this->db->join('worker_type', 'graduate.worker_type_id = worker_type.worker_type_id');
        $this->db->join('worker_level', 'graduate.worker_level_id = worker_level.worker_level_id');
        $this->db->join('demand_location', 'graduate.potential_fixed_location_id = demand_location.demand_location_id', 'left');
        $this->db->group_by('graduate_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all() {
        $this->db->distinct();
        $this->db->from('graduate');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_list() {
        $this->db->distinct();
        $this->db->from('graduate');
        $this->db->join('worker_type', 'graduate.worker_type_id = worker_type.worker_type_id');
        $query = $this->db->get();
        return $query->result();
    }

    function get($id) {
        $this->db->from('graduate');
        $this->db->where('graduate_id', $id);
        $this->db->join('worker_type', 'graduate.worker_type_id = worker_type.worker_type_id');
        $this->db->join('worker_level', 'graduate.worker_level_id = worker_level.worker_level_id');
        $this->db->join('demand_location', 'graduate.potential_fixed_location_id = demand_location.demand_location_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function save() {
        $this->graduate_no = $this->input->post('graduate_no');
        $this->first_name = $this->input->post('first_name');
        $this->last_name = $this->input->post('last_name');
        $this->location_id = $this->input->post('location_id');
        $this->worker_type_id = $this->input->post('worker_type_id');
        $this->worker_level_id = $this->input->post('worker_level_id');
        $this->gender = $this->input->post('gender');
        $this->adjusted_salary = $this->input->post('adjusted_salary');
        if ($this->input->post('potential_fixed_location_id') === "-SELECT-") {
            $this->potential_fixed_location_id = NULL;
        } else {
            $this->potential_fixed_location_id = $this->input->post('potential_fixed_location_id');
        }
        $this->do_not_assign_outside_preferences = $this->input->post('do_not_assign_outside_preferences');
        $this->assigned_to_fixed_location = $this->input->post('assigned_to_fixed_location');
        $this->db->insert('graduate', $this);
        return $this->db->insert_id();
    }

    public function update($id) {
        $this->first_name = $this->input->post('first_name');
        $this->last_name = $this->input->post('last_name');
        $this->location_id = $this->input->post('location_id');
        $this->worker_type_id = $this->input->post('worker_type_id');
        $this->worker_level_id = $this->input->post('worker_level_id');
        $this->gender = $this->input->post('gender');
        $this->adjusted_salary = $this->input->post('adjusted_salary');
        if ($this->input->post('potential_fixed_location_id') === "-SELECT-") {
            $this->potential_fixed_location_id = NULL;
        } else {
            $this->potential_fixed_location_id = $this->input->post('potential_fixed_location_id');
        }
        $this->do_not_assign_outside_preferences = $this->input->post('do_not_assign_outside_preferences');
        $this->assigned_to_fixed_location = $this->input->post('assigned_to_fixed_location');
        $this->db->where('graduate_id', $id);
        $this->db->update('graduate', $this);
    }

    public function remove_fixed_location($id) {
        $this->assigned_to_fixed_location = 'NO';
        $this->potential_fixed_location_id = null;
        $this->db->where('graduate_id', $id);
        $this->db->update('graduate', $this);
    }

    function get_row_count() {
        $this->db->distinct();
        return $this->db->count_all('graduate');
    }

    function get_search_count($q) {
        $this->db->from('graduate');
        $this->db->like('first_name', $q, 'both');
        $this->db->or_like('last_name', $q);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_count_by_worker_type($id) {
        $this->db->from('graduate');
        $this->db->where('worker_type_id', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function delete($id) {
        $this->db->where('graduate_id', $id);
        $this->db->delete('graduate');
    }

    function get_search_list($q) {
        $this->db->from('graduate');
        $this->db->like('first_name', $q, 'both');
        $this->db->or_like('last_name', $q);
        $this->db->join('location', 'graduate.location_id = location.location_id');
        $this->db->join('worker_type', 'graduate.worker_type_id = worker_type.worker_type_id');
        $this->db->join('worker_level', 'graduate.worker_level_id = worker_level.worker_level_id');
        $this->db->join('demand_location', 'graduate.potential_fixed_location_id = demand_location.demand_location_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function get_total_numbers() {
        $query = $this->db->query('select count(w.worker_type_name) as total, w.worker_type_name as worker from graduate g inner join worker_type w on w.worker_type_id = g.worker_type_id group by w.worker_type_name');
        return $query->result();
    }

    function get_gender_dropdown() {
        $_id = array('-SELECT-');
        $_name = array('-SELECT-');
        array_push($_id, 'M');
        array_push($_name, 'M');
        array_push($_id, 'F');
        array_push($_name, 'F');
        return $list_result = array_combine($_id, $_name);
    }

    function get_assign_outside_preferences_dropdown() {
        $_id = array();
        $_name = array();
        array_push($_id, 'YES');
        array_push($_name, 'YES');
        array_push($_id, 'NO');
        array_push($_name, 'NO');
        return $list_result = array_combine($_id, $_name);
    }

    function get_assigned_to_fixed_location_dropdown() {
        $_id = array();
        $_name = array();
        array_push($_id, 'NO');
        array_push($_name, 'NO');
        array_push($_id, 'YES');
        array_push($_name, 'YES');
        return $list_result = array_combine($_id, $_name);
    }

    public function get_potential_fixed_location($id) {
        $row = $this->get($id);
        if ($this->get_is_fixed_location($id) === NULL) {
            return "NA";
        }
        if ($this->get_is_fixed_location($id) === 0) {
            return "NA";
        } else {
            return $row->demand_location_name;
        }
    }

    public function get_is_fixed_location($id) {
        $row = $this->get($id);
        if ($row->assigned_to_fixed_location === 'NO') {
            return 0;
        } else {
            return 1;
        }
    }

    function check_duplicate($graduate_no) {
        $this->db->from('graduate');
        $this->db->where('graduate_no', $graduate_no);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function save_upload($graduate_no, $first_name, $last_name, $location_id, $worker_type_id, $worker_level_id, $gender, $upload_id) {
        $this->graduate_no = $graduate_no;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->location_id = $location_id;
        $this->worker_type_id = $worker_type_id;
        $this->worker_level_id = $worker_level_id;
        $this->gender = $gender;
        $this->adjusted_salary = '';
        $this->potential_fixed_location_id = NULL;
        $this->do_not_assign_outside_preferences = "NO";
        $this->assigned_to_fixed_location = "NO";
        $this->upload_id = $upload_id;
        $this->db->insert('graduate', $this);
        return $this->db->insert_id();
    }

    public function get_upload_list($upload_id) {
        $this->db->distinct();
        $this->db->from('graduate');
        $this->db->join('location', 'graduate.location_id = location.location_id');
        $this->db->join('worker_type', 'graduate.worker_type_id = worker_type.worker_type_id');
        $this->db->join('worker_level', 'graduate.worker_level_id = worker_level.worker_level_id');
        $this->db->join('demand_location', 'graduate.potential_fixed_location_id = demand_location.demand_location_id', 'left');
        $this->db->where('upload_id', $upload_id);
        $query = $this->db->get();
        return $query->result();
    }

    function deleteAll() {
        $this->db->empty_table('graduate');
    }

}
