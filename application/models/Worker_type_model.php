<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Worker Type
 *
 * @author
 */
class Worker_type_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_last_ten_entries()
    {
        $query = $this->db->get('worker_type', 10);
        return $query->result();
    }

    function get($id)
    {
        $this->db->from('worker_type');
        $this->db->where('worker_type_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_list()
    {
        $this->db->distinct();
        $query = $this->db->get('worker_type');
        return $query->result();
    }

    public function save()
    {
        $this->worker_type_name = $this->input->post('worker_type_name');
        $this->db->insert('worker_type', $this);
    }

    public function save_name($name)
    {
        $this->worker_type_name = $name;
        $this->db->insert('worker_type', $this);
    }

    public function update($id)
    {
        $this->worker_type_name = $this->input->post('worker_type_name');
        $this->db->where('worker_type_id', $id);
        $this->db->update('worker_type', $this);
    }

    function get_row_count()
    {
        return $this->db->count_all('worker_type');
    }

    function get_search_count($q)
    {
        $this->db->from('worker_type');
        $this->db->like('worker_type_name', $q);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function search($q)
    {
        $this->db->from('worker_type');
        $this->db->like('worker_type_name', $q);
        $query = $this->db->get();
        return $query->row();
    }

    function get_search_list($q)
    {
        $this->db->from('worker_type');
        $this->db->like('worker_type_name', $q);
        $query = $this->db->get();
        return $query->result();
    }

    function get_search($q)
    {
        $this->db->from('worker_type');
        $this->db->where('worker_type_name', $q);
        $query = $this->db->get();
        return $query->num_rows();
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
        $this->db->where('worker_type_id', $id);
        $this->db->delete('worker_type');
    }

    function get_worker_type_dropdown()
    {
        $this->db->select('worker_type_id');
        $this->db->select('worker_type_name');
        $this->db->from('worker_type');
        $query = $this->db->get();
        $result = $query->result();

        $_id = array('-SELECT-');
        $_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($_id, $result[$i]->worker_type_id);
            array_push($_name, $result[$i]->worker_type_name);
        }
        return $list_result = array_combine($_id, $_name);
    }

    function deleteAll() {
        $this->db->empty_table('worker_type');
    }

}
