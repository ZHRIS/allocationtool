<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Locations Model
 *
 * @author tdhlakama
 */
class Locations_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil();
    }

    public function save($Location,$Budget,$Penalty) {
        $this->Location = $Location;
        $this->Budget = $Budget;
        $this->Penalty = $Penalty;
        $this->db->insert('locations', $this);
    }

    function delete() {
        $this->db->empty_table('locations');
    }

    function export() {
        $query = $this->db->query("SELECT * FROM locations");
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = str_replace('"','',$data);
        return $data;
    }
}
