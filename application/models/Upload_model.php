<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Location Model
 *
 * @author tdhlakama
 */
class Upload_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get($id)
    {
        $this->db->from('upload');
        $this->db->where('upload_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_last_ten_entries()
    {
        $query = $this->db->get('upload', 10);
        return $query->result();
    }

    public function get_last_five_entries()
    {
        $query = $this->db->get('upload', 5);
        return $query->result();
    }

    public function get_list()
    {
        $query = $this->db->get('upload');
        return $query->result();
    }

    public function save($upload_by)
    {
        $currentDate = date('Y-m-d H:i:s');
        $this->upload_date = $currentDate;
        $this->upload_by = $upload_by;
        $this->db->insert('upload', $this);
        return $this->db->insert_id();
    }

    public function update($id, $count, $errors,$reasons)
    {
        $this->records_uploaded = $count;
        $this->records_notuploaded = $errors;
        $this->reasons = $reasons;
        $this->db->where('upload_id', $id);
        $this->db->update('upload', $this);
    }

    function get_row_count()
    {
        return $this->db->count_all('upload_date');
    }

    function delete($id)
    {
        $this->db->where('upload_id', $id);
        $this->db->delete('upload');
    }


    function deleteAll() {
        $this->db->empty_table('upload');
    }

}
