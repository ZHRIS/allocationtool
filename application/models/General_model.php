<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of General Model
 *
 * @author tdhlakama
 */
class General_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save($Setting,$Value) {
        $this->Setting = $Setting;
        $this->Value = $Value;
        $this->db->insert('general', $this);
    }

    function delete() {
        $this->db->empty_table('general');
    }

    function export() {
        $this->load->dbutil();
        $query = $this->db->query("SELECT * FROM general");
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = str_replace('"','',$data);
        return $data;
    }
}
