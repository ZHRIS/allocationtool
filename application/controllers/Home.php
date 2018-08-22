<?php

/**
 * Application Start
 *
 * @author tdhlakama
 */
class Home extends Generic_home
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['last_modified_date'] = $this->setting_model->get_last_modified_date();
        $data['total_number_of_graduates'] = $this->graduate_model->get_row_count();
        $data['total_allocated'] = $this->results_x_model->get_row_count();
        $data['allocated_data'] = $this->graduate_model->get_total_numbers();
        $data['workers_requested'] = $this->workers_requested();
        $data['workers_allocated'] = $this->workers_allocated();
        $this->load->view('home_view', $data);
        $this->load->view('footer');
    }


    public function workers_requested()
    {

        $list = $this->demand_location_model->get_list();
        $workers_requested = array();
        foreach ($list as $i => $item) {
            $total_requested = $this->worker_demand_model->get_total_demand_value($item->demand_location_id);
            array_push($workers_requested, array($total_requested, $item->demand_location_name));
        }
        return $workers_requested;
    }

    public function workers_allocated()
    {
        $list = $this->demand_location_model->get_list();
        $workers_allocated = array();
        foreach ($list as $i => $item) {
            $total_allocated = $this->results_x_model->get_count_assigned_by_demand_location($item->demand_location_id);
            array_push($workers_allocated, array($total_allocated, $item->demand_location_name,));
        }
        return $workers_allocated;
    }

    public function listAllValues() {
        $this->breadcrumbs->push('Demand Locations', '/demand_location/listAll');
        $data['demand_data'] = $this->demand_location_model->demand_data();
        $this->load->view('demand_location_list_values_view', $data);
        $this->load->view('footer');
    }

 }

?>

