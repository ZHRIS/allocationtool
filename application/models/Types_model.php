<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Types Model
 *
 * @author tdhlakama
 */
class Types_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil();
    }

    public function save($Type) {
        $this->Type = $Type;
        $this->db->insert('types', $this);
    }

    function delete() {
        $this->db->empty_table('types');
    }

    function export() {
        $query = $this->db->query("SELECT * FROM types");
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = str_replace('"','',$data);
        return $data;
    }
}
