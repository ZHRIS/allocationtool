<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Worker Type
 *
 * @author 
 */
class Worker_salary_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get($id) {
        $this->db->from('worker_salary');
        $this->db->where('worker_salary_id', $id);
        $this->db->join('worker_type', 'worker_salary.worker_type_id = worker_type.worker_type_id');
        $this->db->join('worker_level', 'worker_salary.worker_level_id = worker_level.worker_level_id');
        $query = $this->db->get();
        return $query->row();
    }

    function get_worker_salary($worker_type_id, $worker_level_id) {
        $this->db->from('worker_salary', 1);
        $this->db->where('worker_type_id', $worker_type_id);
        $this->db->where('worker_level_id', $worker_level_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_worker_type_salary($worker_type_id) {
        $this->db->from('worker_salary', 1);
        $this->db->where('worker_type_id', $worker_type_id);
        $this->db->where('worker_level_id is null');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_list() {
        $this->db->distinct();
        $this->db->from('worker_salary');
        $this->db->join('worker_type', 'worker_salary.worker_type_id = worker_type.worker_type_id');
        $this->db->join('worker_level', 'worker_salary.worker_level_id = worker_level.worker_level_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function save() {
        $this->salary = $this->input->post('salary');
        $this->worker_type_id = $this->input->post('worker_type_id');
        $this->worker_level_id = $this->input->post('worker_level_id');
        $this->db->insert('worker_salary', $this);
    }

    public function update($id) {
        $this->salary = $this->input->post('salary');
        $this->worker_type_id = $this->input->post('worker_type_id');
        $this->worker_level_id = $this->input->post('worker_level_id');
        $this->db->where('worker_salary_id', $id);
        $this->db->update('worker_salary', $this);
    }

    function get_row_count() {
        return $this->db->count_all('worker_salary');
    }

    function delete($id) {
        $this->db->where('worker_salary_id', $id);
        $this->db->delete('worker_salary');
    }

    public function get_default_salary($worker_type_id, $worker_level_id) {
        $row = $this->get_worker_salary($worker_type_id, $worker_level_id);
        if (is_null($row)) {
            return 0;
        } else {
            return $row->salary;
        }
    }

    function deleteAll() {
        $this->db->empty_table('worker_salary');
    }

}
