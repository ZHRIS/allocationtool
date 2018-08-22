<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Workers Model
 *
 * @author tdhlakama
 */
class Workers_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil();
    }

    public function save($Worker,$Type,$Salary,$Fixed,$FixedLocation,$OnlyPreferences) {
        $this->Worker = $Worker;
        $this->Type = $Type;
        $this->Salary = $Salary;
        $this->Fixed = $Fixed;
        $this->FixedLocation = $FixedLocation;
        $this->OnlyPreferences = $OnlyPreferences;
        $this->db->insert('workers', $this);
    }

    function delete() {
        $this->db->empty_table('workers');
    }

    function export() {
        $query = $this->db->query("SELECT * FROM workers");
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = str_replace('"','',$data);
        return $data;
    }

}
