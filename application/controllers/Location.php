<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Location extends Generic_input
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->breadcrumbs->push('Study Location', '/location/listAll');
        $this->breadcrumbs->push('Add Study', '/');

        $this->form_validation->set_rules('location_name', 'location Name', 'trim|required');
        $this->form_validation->set_rules('longitude_coordinate', 'Longitude Coodinate', 'trim');
        $this->form_validation->set_rules('latitude_coordinate', 'Latitude Coordinate', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('location_view');
        } else {
            $this->location_model->save();
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
            redirect('location/listAll');
        }
        $this->load->view('footer');
    }

    public function listAll()
    {
        $this->breadcrumbs->push('Study Location', '/location/listAll');
        $data['location_list'] = $this->location_model->get_list();
        $this->load->view('location_list_view', $data);
        $this->load->view('footer');
    }

    function get_search_list($q)
    {
        $this->breadcrumbs->push('Study Location', '/location/listAll');
        $data['location_list'] = $this->location_model->get_search_list($q);
        $this->load->view('location_list_view', $data);
        $this->load->view('footer');
    }

    function delete($id)
    {
        $this->location_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('location/listAll');
    }

    function update($id)
    {
        $this->breadcrumbs->push('Study Location', '/location/listAll');
        $this->breadcrumbs->push('Update Study Location', '/');

        $data['emp'] = $this->location_model->get($id);

        $this->form_validation->set_rules('location_name', 'location Name', 'trim|required');
        $this->form_validation->set_rules('longitude_coordinate', 'Longitude Coodinate', 'trim');
        $this->form_validation->set_rules('latitude_coordinate', 'Latitude Coordinate', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('update_location_view', $data);
        } else {
            $this->location_model->update($id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Updated!</div>');
            redirect('location/listAll');
        }
        $this->load->view('footer');
    }

}

?>

