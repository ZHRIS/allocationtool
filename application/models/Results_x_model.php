<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Setting
 *
 * @author
 */
class Results_x_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_assigned_demand_location($graduate_id)
    {
        $this->db->distinct();
        $this->db->from('results_x');
        $this->db->join('graduate', 'results_x.graduate_id = graduate.graduate_id');
        $this->db->join('demand_location', 'results_x.demand_location_id = demand_location.demand_location_id');
        $this->db->where('graduate.graduate_id', $graduate_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_count_assigned_by_demand_location($demand_location_id)
    {
        $this->db->from('results_x');
        $this->db->join('graduate', 'results_x.graduate_id = graduate.graduate_id');
        $this->db->where('demand_location_id', $demand_location_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_count_assigned_worker_type($worker_type_id)
    {
        $this->db->from('results_x');
        $this->db->join('graduate', 'results_x.graduate_id = graduate.graduate_id');
        $this->db->where('graduate.worker_type_id', $worker_type_id);
        $query = $this->db->get();
        return $query->num_rows();

    }

    function get_count_assigned_worker_type_by_demand_location($worker_type_id, $demand_location_id)
    {
        $this->db->from('results_x');
        $this->db->join('graduate', 'results_x.graduate_id = graduate.graduate_id');
        $this->db->where('graduate.worker_type_id', $worker_type_id);
        $this->db->where('demand_location_id', $demand_location_id);
        $query = $this->db->get();
        return $query->num_rows();

    }

    function get_count_fixed_assigned_worker_type_by_demand_location($worker_type_id, $demand_location_id)
    {
        $this->db->from('results_x');
        $this->db->join('graduate', 'results_x.graduate_id = graduate.graduate_id');
        $this->db->where('graduate.worker_type_id', $worker_type_id);
        $this->db->where('graduate.potential_fixed_location_id', $demand_location_id);
        $this->db->where('graduate.assigned_to_fixed_location', 'YES');
        $query = $this->db->get();
        return $query->num_rows();

    }

    function get_total_count_fixed_assigned_worker_type($worker_type_id)
    {
        $this->db->from('results_x');
        $this->db->join('graduate', 'results_x.graduate_id = graduate.graduate_id');
        $this->db->where('graduate.worker_type_id', $worker_type_id);
        $this->db->where('graduate.assigned_to_fixed_location', 'YES');
        $query = $this->db->get();
        return $query->num_rows();

    }

    function delete()
    {
        $this->db->empty_table('results_x');
    }

    public function get_list()
    {
        $this->db->distinct();
        $query = $this->db->get('results_x');
        return $query->result();
    }

    public function save($graduate_id, $demand_location_id)
    {
        $this->graduate_id = $graduate_id;
        $this->demand_location_id = $demand_location_id;
        $this->db->insert('results_x', $this);
    }

    function get_row_count()
    {
        return $this->db->count_all('results_x');
    }

    function check_if_assigned_by_demand_location($graduate_id, $demand_location_id)
    {
        $this->db->from('results_x');
        $this->db->where('demand_location_id', $demand_location_id);
        $this->db->where('graduate_id', $graduate_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    function check_if_assigned($graduate_id)
    {
        $this->db->from('results_x');
        $this->db->where('graduate_id', $graduate_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_demand_met_by_location()
    {
        $query = $this->db->query("select dl.demand_location_name as DemandLocation, count(*) as Allocated,wt.worker_type_name as WorkerType,wd.total as Requested,
(select count(p.graduate_id) from graduate p where p.worker_type_id = g.worker_type_id) as Available  from results_x x
inner join graduate g on x.graduate_id=g.graduate_id
inner join worker_type wt on g.worker_type_id=wt.worker_type_id inner
join demand_location dl on x.demand_location_id=dl.demand_location_id
inner join worker_demand wd on (x.demand_location_id=wd.demand_location_id
and g.worker_type_id=wd.worker_type_id) where g.worker_type_id in
(select a.worker_type_id from graduate a inner join graduate b on a.worker_type_id=b.worker_type_id)
group by g.worker_type_id,x.demand_location_id");
        return $query->result();

    }


    function get_workers_not_assigned()
    {
        $query = $this->db->query("select * from graduate g inner join worker_type w on w.worker_type_id = g.worker_type_id
where g.graduate_id not in (select r.graduate_id from results_x r)");
        return $query->result();
    }
}