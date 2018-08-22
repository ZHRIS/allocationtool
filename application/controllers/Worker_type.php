<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Worker_type extends Generic_input {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->breadcrumbs->push('Worker Types', '/worker_types/listAll');
        $this->breadcrumbs->push('Add Worker Type', '/');

        $this->form_validation->set_rules('worker_type_name', 'Worker Type Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('worker_type_view');
        } else {
            $this->worker_type_model->save();
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
            redirect('worker_type/listAll');
        }
        $this->load->view('footer');
    }

    public function listAll() {
        $this->breadcrumbs->push('Worker Types', '/worker_type/listAll');
        $data['list'] = $this->worker_type_model->get_list();
        $this->load->view('worker_type_list_view', $data);
        $this->load->view('footer');
    }

    function get_search_list($q)
    {
        $this->breadcrumbs->push('Worker Types', '/worker_type/listAll');
        $data['list'] = $this->worker_type_model->get_search_list($q);
        $this->load->view('worker_type_list_view', $data);
        $this->load->view('footer');
    }

    function delete($id) {
        $this->worker_type_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('worker_type/listAll');
    }

    function update($id) {
        $this->breadcrumbs->push('Worker Levels', '/worker_type/listAll');
        $this->breadcrumbs->push('Update Worker Type', '/');

        $data['emp'] = $this->worker_type_model->get($id);

        $this->form_validation->set_rules('worker_type_name', 'Worker Type Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('update_worker_type_view', $data);
        } else {
            $this->worker_type_model->update($id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Updated!</div>');
            redirect('worker_type/listAll');
        }
        $this->load->view('footer');
    }

}
?>

