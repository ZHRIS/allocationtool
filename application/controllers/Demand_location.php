<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Demand_location extends Generic_input {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->breadcrumbs->push('Demand Locations', '/demand_location/listAll');
        $this->breadcrumbs->push('Add Demand Location', '/');
        $data['tool_currency'] = $this->setting_model->get_tool_currency();

        $this->form_validation->set_rules('demand_location_name', 'location Name', 'trim|required');
        $this->form_validation->set_rules('demand_longitude_coordinate', 'Longitude Coodinate', 'trim');
        $this->form_validation->set_rules('demand_latitude_coordinate', 'Latitude Coordinate', 'trim');
        $this->form_validation->set_rules('location_budget', 'trim|numeric');
        $this->form_validation->set_rules('penalty_unfulfilled_demand', 'Penalty for Unfulfilled Study', 'numeric');

        $list = $this->worker_type_model->get_list();

        foreach ($list as $item) {
            $this->form_validation->set_rules($item->worker_type_id, 'Requested Number', 'numeric');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['list'] = $list;
            $this->load->view('demand_location_view', $data);
        } else {
            $demand_location_id = $this->demand_location_model->save();
            foreach ($list as $item) {
                $total = $this->input->post($item->worker_type_id);
                if ($total === '') {
                    $this->worker_demand_model->save($demand_location_id, $item->worker_type_id, 0);
                } else {
                    $this->worker_demand_model->save($demand_location_id, $item->worker_type_id, $total);
                }
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
            redirect('demand_location/listAll');
        }

        $this->load->view('footer');
    }

    public function createInitialValues() {
        $this->breadcrumbs->push('Demand Locations', '/demand_location/listAll');
        $demand_locations = $this->demand_location_model->get_list();
        $worker_types = $this->worker_type_model->get_list();
        //create additional Worker Types and Locations, Create Zero Values
        foreach ($demand_locations as $demand) {
            foreach ($worker_types as $type) {
                if (!$this->worker_demand_model->check_demand($demand->demand_location_id, $type->worker_type_id)) {
                    $this->worker_demand_model->save($demand->demand_location_id, $type->worker_type_id, 0);
                }
            }
        }
        $data['demand_data'] = $this->demand_location_model->demand_data();
        $this->load->view('demand_location_list_values_view', $data);
        $this->load->view('footer');
    }

    public function listAll() {
        $this->breadcrumbs->push('Demand Locations', '/demand_location/listAll');
        $data['demand_location_list'] = $this->demand_location_model->get_list();
        $this->load->view('demand_location_list_view', $data);
        $this->load->view('footer');
    }

    function get_search_list($q) {
        $this->breadcrumbs->push('Demand Locations', '/demand_location/listAll');
        $demand_locations = $this->demand_location_model->get_search_list($q);
        $worker_types = $this->worker_type_model->get_list();
        //check additional Worker Types and Locations, Create Zero Values
        foreach ($demand_locations as $demand) {
            foreach ($worker_types as $type) {
                if (!$this->worker_demand_model->check_demand($demand->demand_location_id, $type->worker_type_id)) {
                    $this->worker_demand_model->save($demand->demand_location_id, $type->worker_type_id, 0);
                }
            }
        }
        $data['worker_demand_list'] = $demand_locations;
        $data['worker_type_list'] = $worker_types;

        $this->load->view('demand_location_list_view', $data);
        $this->load->view('footer');
    }

    function delete($id) {
        $this->worker_demand_model->delete_by_demand_location_id($id);
        $this->demand_location_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('demand_location/listAll');
    }

    function update($id) {
        $this->breadcrumbs->push('Demand Locations', '/demand_location/listAll');
        $this->breadcrumbs->push('Update Demand Location', '/');

        $data['emp'] = $this->demand_location_model->get($id);
        $data['tool_currency'] = $this->setting_model->get_tool_currency();

        $this->form_validation->set_rules('demand_location_name', 'location Name', 'trim|required');
        $this->form_validation->set_rules('demand_longitude_coordinate', 'Longitude Coodinate', 'trim');
        $this->form_validation->set_rules('demand_latitude_coordinate', 'Latitude Coordinate', 'trim');
        $this->form_validation->set_rules('location_budget', 'trim|numeric');
        $this->form_validation->set_rules('penalty_unfulfilled_demand', 'Penalty for Unfulfilled Study', 'numeric');

        $list = $this->worker_type_model->get_list();

        foreach ($list as $item) {
            $this->form_validation->set_rules($item->worker_type_id, 'Requested Number', 'numeric');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['list'] = $list;
            $this->load->view('update_demand_location_view', $data);
        } else {
            $this->demand_location_name = $this->input->post('demand_location_name');
            $this->demand_longitude_coordinate = $this->input->post('demand_longitude_coordinate');
            $this->demand_latitude_coordinate = $this->input->post('demand_latitude_coordinate');
            $this->location_budget = $this->input->post('location_budget');
            $this->penalty_unfulfilled_demand = $this->input->post('penalty_unfulfilled_demand');
            $this->db->where('demand_location_id', $id);
            $this->db->update('demand_location', $this);

            $this->worker_demand_model->delete_by_demand_location_id($id);

            foreach ($list as $item) {
                $total = $this->input->post($item->worker_type_id);
                $this->worker_demand_model->save($id, $item->worker_type_id, $total);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Updated!</div>');
            redirect('demand_location/listAll');
        }

        $this->load->view('footer');
    }

}
?>

