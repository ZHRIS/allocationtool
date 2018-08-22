<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Worker_level extends Generic_input {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->breadcrumbs->push('Worker Levels', '/worker_level/listAll');
        $this->breadcrumbs->push('Add Worker Level', '/');

        $this->form_validation->set_rules('worker_level_name', 'Worker Type Name', 'trim|required');
        $this->form_validation->set_rules('worker_level_description', 'Worker Type Description', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('worker_level_view');
        } else {
            $this->worker_level_model->save();
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
            redirect('worker_level/listAll');
        }
        $this->load->view('footer');
    }

    public function listAll() {
        $this->breadcrumbs->push('Worker Types', '/worker_type/listAll');
        $data['list'] = $this->worker_level_model->get_list();
        $this->load->view('worker_level_list_view', $data);
        $this->load->view('footer');
    }

    function get_search_list($q)
    {
        $this->breadcrumbs->push('Worker Types', '/worker_type/listAll');
        $data['list'] = $this->worker_level_model->get_search_list($q);
        $this->load->view('worker_level_list_view', $data);
        $this->load->view('footer');
    }

    function delete($id) {
        $this->worker_level_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('worker_level/listAll');
        $this->load->view('footer');
    }

    function update($id) {
        $this->breadcrumbs->push('Worker Types', '/worker_type/listAll');
        $this->breadcrumbs->push('Update Worker Type', '/');

        $data['emp'] = $this->worker_level_model->get($id);

        $this->form_validation->set_rules('worker_level_name', 'Worker Type Name', 'trim|required');
        $this->form_validation->set_rules('worker_level_description', 'Worker Type Description', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('update_worker_level_view', $data);
        } else {
            $this->worker_level_model->update($id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Updated!</div>');
            redirect('worker_level/listAll');
        }
        $this->load->view('footer');
    }

}
?>

