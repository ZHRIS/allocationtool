<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Preferences Model
 *
 * @author tdhlakama
 */
class Preferences_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil();
    }

    public function save($Worker,$Location,$Weight) {
        $this->Worker = $Worker;
        $this->Location = $Location;
        $this->Weight = $Weight;
        $this->db->insert('preferences', $this);
    }

    function get_preference($Worker, $Location) {
        $this->db->from('preferences');
        $this->db->where('Worker', $Worker);
        $this->db->where('Location', $Location);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function check_preference($Worker, $Location) {
        if ($this->get_preference($Worker, $Location)==0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete() {
        $this->db->empty_table('preferences');
    }

    function export() {
        $query = $this->db->query("SELECT * FROM preferences");
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = str_replace('"','',$data);
        return $data;
    }
}
