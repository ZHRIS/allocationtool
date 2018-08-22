<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Demand Model
 *
 * @author tdhlakama
 */
class Demand_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil();
    }

    public function save($Location,$Type,$Demand) {
        $this->Type = $Type;
        $this->Location = $Location;
        $this->Demand = $Demand;
        $this->db->insert('demand', $this);
    }

    function delete() {
        $this->db->empty_table('demand');
    }

    function export() {
        $query = $this->db->query("SELECT * FROM demand");
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = str_replace('"','',$data);
        return $data;
    }

    function get_demand($Location, $Type)
    {
        $this->db->distinct();
        $this->db->from('demand');
        $this->db->where('Location', $Location);
        $this->db->where('Type', $Type);
        $query = $this->db->get();
        return $query->num_rows();

    }

    public function check_demand($Location, $Type)
    {
        if ($this->get_demand($Location, $Type)==0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }


}
