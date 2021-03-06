<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Location Model
 *
 * @author tdhlakama
 */
class Demand_location_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get($id)
    {
        $this->db->from('demand_location');
        $this->db->where('demand_location_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_demand_location_by_name($name)
    {
        $this->db->from('demand_location');
        $this->db->where('demand_location_name', $name);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_list()
    {
        $this->db->distinct();
        $this->db->from('demand_location');
        $query = $this->db->get();
        return $query->result();
    }

    public function save()
    {
        $this->demand_location_id = $this->input->post('demand_location_id');
        $this->demand_location_name = $this->input->post('demand_location_name');
        $this->demand_longitude_coordinate = $this->input->post('demand_longitude_coordinate');
        $this->demand_latitude_coordinate = $this->input->post('demand_latitude_coordinate');

        if ($this->input->post('location_budget') === '') {
            $this->location_budget = 0;
        } else {
            $this->location_budget = $this->input->post('location_budget');
        }

        $this->penalty_unfulfilled_demand = $this->input->post('penalty_unfulfilled_demand');
        $this->db->insert('demand_location', $this);
        return $this->db->insert_id();
    }

    public function save_name($name)
    {
        $this->demand_location_name = $name;
        $this->penalty_unfulfilled_demand = 40;
        $this->db->insert('demand_location', $this);
    }

    public function update($id)
    {
        $this->demand_location_name = $this->input->post('demand_location_name');
        $this->demand_longitude_coordinate = $this->input->post('demand_longitude_coordinate');
        $this->demand_latitude_coordinate = $this->input->post('demand_latitude_coordinate');
        $this->location_budget = $this->input->post('location_budget');
        $this->penalty_unfulfilled_demand = $this->input->post('penalty_unfulfilled_demand');
        $this->db->where('demand_location_id', $id);
        $this->db->update('demand_location', $this);
    }

    function get_row_count()
    {
        return $this->db->count_all('demand_location');
    }

    function delete($id)
    {
        $this->db->where('demand_location_id', $id);
        $this->db->delete('demand_location');
    }

    function deleteAll()
    {
        $this->db->empty_table('demand_location');
    }

    function get_demand_location_dropdown()
    {
        $this->db->distinct();
        $this->db->select('demand_location_id');
        $this->db->select('demand_location_name');
        $this->db->from('demand_location');
        $query = $this->db->get();
        $result = $query->result();

        $_id = array('-SELECT-');
        $_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($_id, $result[$i]->demand_location_id);
            array_push($_name, $result[$i]->demand_location_name);
        }
        return $list_result = array_combine($_id, $_name);
    }

    public function get_demand_location_budget($id)
    {
        $demand_location = $this->get($id);
        if (is_null($demand_location)) {
            return 0;
        } else {
            return $demand_location->location_budget;
        }
    }

    function get_total_budget()
    {
        $this->db->distinct();
        $this->db->from('demand_location');
        $this->db->select_sum('location_budget');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_total_demand_locations_budget()
    {
        $budget = $this->get_total_budget();
        if (is_null($budget)) {
            return 0;
        } else {
            return $budget->location_budget;
        }
    }

    function get_search_count($q)
    {
        $this->db->from('demand_location');
        $this->db->like('demand_location_name', $q);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function search($q)
    {
        $this->db->from('demand_location');
        $this->db->where('demand_location_name', $q);
        $query = $this->db->get();
        return $query->row();
    }

    function get_search_list($q)
    {
        $this->db->from('demand_location');
        $this->db->like('demand_location_name', $q);
        $query = $this->db->get();
        return $query->result();
    }

    function get_search($q)
    {
        $this->db->from('demand_location');
        $this->db->where('demand_location_name', $q);
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

    function demand_data()
    {
        $query = $this->db->query("select w.worker_type_name as WorkerType, d.demand_location_name as DemandLocation,(wd.total) as Requested from worker_demand wd INNER JOIN demand_location d on d.demand_location_id=wd.demand_location_id
  INNER JOIN worker_type w on w.worker_type_id =wd.worker_type_id GROUP BY  WorkerType, DemandLocation");
        return $query->result();
    }

    function preferences_met_by_location()
    {
        $query = $this->db->query("select pp.location as DemandLocation,  
 (select count(*) FROM preferences) as TotalNumberOfPreferences, 
 (select count(location) FROM preferences WHERE location = pp.location) as Selected, 
 (select count(location) FROM preferences WHERE location =pp.location and Weight =3 GROUP by pp.Location) as TotalTopPreferences,
(select count(location) FROM preferences WHERE location =pp.location and Weight <3 GROUP by pp.Location) as SelectedAsTopPreference,
(select count(location) FROM preferences WHERE location =pp.location GROUP by pp.Location) as SelectedMoreThanOnce
FROM preferences pp GROUP by pp.Location");
        return $query->result();
    }

    function assignments_by_location()
    {
        $query = $this->db->query("select distinct count(r.graduate_id) as 'Assigned', dl.demand_location_name as 'DemandLocation', (select count(*)from graduate) as 'TotalWorkers', (select sum(wd.total) from worker_demand wd where wd.demand_location_id=r.demand_location_id) as 'Requested', 
     IFNULL((select count(pr.Worker) from preferences pr WHERE pr.Location=dl.demand_location_name and pr.Weight =3 and pr.Worker in (select rr.graduate_id from results_x rr where rr.demand_location_id =dl.demand_location_id) GROUP by dl.demand_location_name), 0) as 'AssignedTop',
    IFNULL((select count(pr.Worker) from preferences pr WHERE pr.Location=dl.demand_location_name and pr.Weight >1 and pr.Worker in (select rr.graduate_id from results_x rr where rr.demand_location_id =dl.demand_location_id) GROUP by dl.demand_location_name), 0) as 'AssignedTopThreePreference',
(SELECT dd.location_budget from demand_location dd where r.demand_location_id = dd.demand_location_id) as Bugdet from results_x r inner join demand_location dl on dl.demand_location_id=r.demand_location_id group by dl.demand_location_id");

        return $query->result();
    }

    function assignments_by_worker_types()
    {
        $query = $this->db->query("select w.worker_type_name as 'WorkerType', (select sum(wd.total) from worker_demand wd where w.worker_type_id=wd.worker_type_id) as 'Requested',
(select count(g.graduate_id) from graduate g where w.worker_type_id=g.worker_type_id) as 'TotalWorkers',
(select count(r.graduate_id) from results_x r join graduate g1 on g1.graduate_id=r.graduate_id where g1.worker_type_id = w.worker_type_id) as 'Assigned'
from worker_type w order by w.worker_type_name desc");
        return $query->result();
    }

}
