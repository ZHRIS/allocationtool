<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Worker Demand Model
 *
 * @author tdhlakama
 */
class Worker_demand_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get($id)
    {
        $this->db->from('worker_demand');
        $this->db->where('worker_demand_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_list()
    {
        $this->db->distinct();
        $this->db->from('worker_demand');
        $this->db->join('worker_type', 'worker_demand.worker_type_id = worker_type.worker_type_id');
        $this->db->join('demand_location', 'worker_demand.demand_location_id = demand_location.demand_location_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all()
    {
        $this->db->distinct();
        $this->db->from('worker_demand');
        $this->db->join('worker_type', 'worker_demand.worker_type_id = worker_type.worker_type_id');
        $this->db->join('demand_location', 'worker_demand.demand_location_id = demand_location.demand_location_id');
        $query = $this->db->get();
        return $query->result();
    }

    function get_worker_demand_model_list($q)
    {
        $this->db->distinct();
        $this->db->from('worker_demand');
        $this->db->like('demand_location.demand_location_name', $q);
        $this->db->join('demand_location', 'worker_demand.demand_location_id = demand_location.demand_location_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function save($demand_location_id, $worker_type_id, $total)
    {
        $this->demand_location_id = $demand_location_id;
        $this->worker_type_id = $worker_type_id;
        $this->total = $total;
        $this->db->insert('worker_demand', $this);
    }

    public function update($worker_demand_id, $total)
    {
        $this->total = $total;
        $this->db->where('worker_demand_id', $worker_demand_id);
        $this->db->update('worker_demand', $this);
    }

    public function update_location($demand_location_id, $new_location_id)
    {
        $this->demand_location_id = $new_location_id;
        $this->db->where('demand_location_id', $demand_location_id);
        $this->db->update('worker_demand', $this);
    }


    function delete($id)
    {
        $this->db->where('worker_demand_id', $id);
        $this->db->delete('worker_demand');
    }

    function delete_by_demand_location_id($id)
    {
        $this->db->where('demand_location_id', $id);
        $this->db->delete('worker_demand');
    }

    function get_demand($demand_location_id, $worker_type_id)
    {
        $this->db->distinct();
        $this->db->from('worker_demand');
        $this->db->where('demand_location_id', $demand_location_id);
        $this->db->where('worker_type_id', $worker_type_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_total_demand()
    {
        $this->db->distinct();
        $this->db->from('worker_demand');
        $this->db->select_sum('total');
        $query = $this->db->get();
        return $query->row();
    }

    function get_demand_total_by_worker_type($demand_location_id, $worker_type_id)
    {
        $this->db->distinct();
        $this->db->from('worker_demand');
        $this->db->where('demand_location_id', $demand_location_id);
        $this->db->where('worker_type_id', $worker_type_id);
        $query = $this->db->get();
        return $query->num_rows();

    }

    function get_total_demand_by_demand_location($demand_location_id)
    {
        $this->db->distinct();
        $this->db->select_sum('total');
        $this->db->from('worker_demand');
        $this->db->where('demand_location_id', $demand_location_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_total_demand_by_worker_type($worker_type_id)
    {
        $this->db->distinct();
        $this->db->select_sum('total');
        $this->db->from('worker_demand');
        $this->db->where('worker_type_id', $worker_type_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_total_demand_requested()
    {
        $total = $this->get_total_demand();
        if (is_null($total)) {
            return 0;
        } else {
            return $total->total;
        }
    }

    public function check_demand($demand_location_id, $worker_type_id)
    {
        if (is_null($this->get_demand($demand_location_id, $worker_type_id))) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_total_value($demand_location_id, $worker_type_id)
    {
        $total = $this->get_demand($demand_location_id, $worker_type_id);
        if (is_null($total)) {
            return 0;
        } else {
            return $total->total;
        }
    }

    public function get_total_demand_value($demand_location_id)
    {
        $total = $this->get_total_demand_by_demand_location($demand_location_id);
        if (is_null($total)) {
            return 0;
        } else {
            return $total->total;
        }
    }

    public function get_worker_type_total_demand_value($worker_type_id)
    {
        $total = $this->get_total_demand_by_worker_type($worker_type_id);
        if (is_null($total)) {
            return 0;
        } else {
            return $total->total;
        }
    }

    function deleteAll()
    {
        $this->db->empty_table('worker_demand');
    }

}
