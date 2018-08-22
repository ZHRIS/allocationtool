<?php

/*
 * File Name: distance.php
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distance extends Generic_input
{

    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->breadcrumbs->push('Distance lookup table', '/distance/listAll');
        $this->breadcrumbs->push('Add Distance Lookup', '/');

        $data['location_id'] = $this->location_model->get_location_dropdown();
        $data['demand_location_id'] = $this->demand_location_model->get_demand_location_dropdown();

        $this->form_validation->set_rules('location_id', 'Study Location', 'callback_combo_check');
        $this->form_validation->set_rules('demand_location_id', 'Demand Location', 'callback_combo_check');
        $this->form_validation->set_rules('road_distance', 'Road Distance', 'trim|required|integer');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('distance_view', $data);
        } else {

            $location_id = $this->input->post('location_id');
            $demand_location_id = $this->input->post('demand_location_id');

            if ($this->distance_model->check_duplicate($location_id, $demand_location_id)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Duplicate Record Not Added!</div>');
                redirect('distance/listAll');
            } else {
                $this->distance_model->save();
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
                redirect('distance/listAll');
            }


        }
        $this->load->view('footer');
    }

    function update($id)
    {


        $this->breadcrumbs->push('Distance lookup table', '/distance/listAll');
        $this->breadcrumbs->push('Update Distance lookup', '/');

        $data['location_id'] = $this->location_model->get_location_dropdown();
        $data['demand_location_id'] = $this->demand_location_model->get_demand_location_dropdown();

        $data['emp'] = $this->distance_model->get($id);

        $this->form_validation->set_rules('location_id', 'Study Location', 'callback_combo_check');
        $this->form_validation->set_rules('demand_location_id', 'Demand Location', 'callback_combo_check');
        $this->form_validation->set_rules('road_distance', 'Road Distance', 'trim|required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('update_distance_view', $data);
        } else {
            $this->distance_model->update($id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Updated!</div>');
            redirect('distance/listAll');
        }
        $this->load->view('footer');
    }

    function listAll()
    {
        $this->breadcrumbs->push('Distance lookup table', '/distance/listAll');
        $data['list'] = $this->distance_model->get_list();
        $this->load->view('distance_list_view', $data);
        $this->load->view('footer');
    }

    function delete($id)
    {
        $this->distance_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('distance/listAll');
        $this->load->view('footer');
    }

}

?>

