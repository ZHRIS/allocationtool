<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Worker_salary extends Generic_input {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->breadcrumbs->push('Worker Salary', '/worker_salary/listAll');
        $this->breadcrumbs->push('Add Worker Salary', '/');

        $data['worker_type_id'] = $this->worker_type_model->get_worker_type_dropdown();
        $data['worker_level_id'] = $this->worker_level_model->get_worker_level_dropdown();
        $data['tool_currency'] =  $this->setting_model->get_tool_currency();

        $this->form_validation->set_rules('salary', 'Salary', 'trim|required|integer');
        $this->form_validation->set_rules('worker_type_id', 'Worker Type', 'callback_combo_check');
        $this->form_validation->set_rules('worker_level_id', 'Worker Level', 'callback_combo_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('worker_salary_view', $data);
        } else {
            $this->worker_salary_model->save();
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
            redirect('worker_salary/listAll');
        }
        $this->load->view('footer');
    }

    public function listAll() {
        $this->breadcrumbs->push('Worker Salary', '/worker_salary/listAll');
        $data['tool_currency'] =  $this->setting_model->get_tool_currency();

        $data['list'] = $this->worker_salary_model->get_list();
        $this->load->view('worker_salary_list_view', $data);
        $this->load->view('footer');
    }

    function delete($id) {
        $this->worker_salary_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('worker_salary/listAll');
    }

    function update($id) {
        $this->breadcrumbs->push('Worker Salary', '/worker_salary/listAll');
        $this->breadcrumbs->push('Update Worker Salary', '/');

        $data['emp'] = $this->worker_salary_model->get($id);
        $data['tool_currency'] =  $this->setting_model->get_tool_currency();

        $data['worker_type_id'] = $this->worker_type_model->get_worker_type_dropdown();
        $data['worker_level_id'] = $this->worker_level_model->get_worker_level_dropdown();

        $this->form_validation->set_rules('salary', 'Salary', 'trim|required|integer');
        $this->form_validation->set_rules('worker_type_id', 'Worker Type', 'callback_combo_check');
        $this->form_validation->set_rules('worker_level_id', 'Worker Level', 'callback_combo_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('update_worker_salary_view', $data);
        } else {
            $this->worker_salary_model->update($id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Updated!</div>');
            redirect('worker_salary/listAll');
        }
        $this->load->view('footer');
    }

}
?>

