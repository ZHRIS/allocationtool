<?php

/*
 * File Name: graduate.php
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Graduate extends Generic_home
{

    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->breadcrumbs->push('Worker Settings', '/graduate/listAll');
        $this->breadcrumbs->push('Add Worker', '/');

        $data['location_id'] = $this->location_model->get_location_dropdown();
        $data['worker_type_id'] = $this->worker_type_model->get_worker_type_dropdown();
        $data['gender'] = $this->graduate_model->get_gender_dropdown();
        $data['worker_level_id'] = $this->worker_level_model->get_worker_level_dropdown();
        $data['demand_location_id'] = $this->demand_location_model->get_demand_location_dropdown();
        $data['potential_fixed_location_id'] = $this->demand_location_model->get_demand_location_dropdown();
        $data['do_not_assign_outside_preferences'] = $this->graduate_model->get_assign_outside_preferences_dropdown();
        $data['assigned_to_fixed_location'] = $this->graduate_model->get_assigned_to_fixed_location_dropdown();

        $this->form_validation->set_rules('graduate_no', 'Graduate No', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|callback_alpha_only_space');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_alpha_only_space');
        $this->form_validation->set_rules('location_id', 'Study Location', 'callback_combo_check');
        $this->form_validation->set_rules('worker_type_id', 'Worker Type', 'callback_combo_check');
        $this->form_validation->set_rules('worker_level_id', 'Worker Level', 'callback_combo_check');
        $this->form_validation->set_rules('gender', 'Gender', 'callback_combo_check');
        $this->form_validation->set_rules('potential_fixed_location_id', 'Potential fixed location');

        $numberOfPreferenceAllowed = $this->setting_model->get_number_of_preferences_allowed();

        $data['numberOfPreferenceAllowed'] = $numberOfPreferenceAllowed;


        for ($i = 0; $i <= $numberOfPreferenceAllowed; $i++) {
            $this->form_validation->set_rules('preference' . $i, 'Preference Location', 'callback_combo_check');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('graduate_view', $data);
        } else {

            $graduateNo = $this->input->post('graduate_no');

            if ($this->graduate_model->check_duplicate($graduateNo)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Duplicate Graduate Number!</div>');
                $this->load->view('graduate_view', $data);
            } else {
                $id = $this->graduate_model->save();
                for ($i = 0; $i < $numberOfPreferenceAllowed; $i++) {
                    $this->preference_model->save($id, $this->input->post('preference' . $i));
                }
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
                redirect('graduate/dashboard/' . $id);
            }
        }
        $this->load->view('footer');
    }

    function update($id)
    {

        $this->breadcrumbs->push('Worker Settings', '/graduate/listAll');
        $this->breadcrumbs->push('Worker Dashboard', '/graduate/dashboard/' . $id);
        $this->breadcrumbs->push('Update Graduate', '/');

        $data['location_id'] = $this->location_model->get_location_dropdown();
        $data['worker_type_id'] = $this->worker_type_model->get_worker_type_dropdown();
        $data['gender'] = $this->graduate_model->get_gender_dropdown();
        $data['worker_level_id'] = $this->worker_level_model->get_worker_level_dropdown();
        $data['demand_location_id'] = $this->demand_location_model->get_demand_location_dropdown();
        $data['potential_fixed_location_id'] = $this->demand_location_model->get_demand_location_dropdown();
        $data['do_not_assign_outside_preferences'] = $this->graduate_model->get_assign_outside_preferences_dropdown();
        $data['assigned_to_fixed_location'] = $this->graduate_model->get_assigned_to_fixed_location_dropdown();

        $data['emp'] = $this->graduate_model->get($id);

        $list = $this->preference_model->get_preference_list($id);

        foreach ($list as $item) {
            $this->form_validation->set_rules($item->demand_location_id, 'Preference Location', 'callback_combo_check');
        }

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|callback_alpha_only_space');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_alpha_only_space');
        $this->form_validation->set_rules('location_id', 'Study Location', 'callback_combo_check');
        $this->form_validation->set_rules('worker_type_id', 'Worker Type', 'callback_combo_check');
        $this->form_validation->set_rules('worker_level_id', 'Worker Level', 'callback_combo_check');
        $this->form_validation->set_rules('gender', 'Gender', 'callback_combo_check');
        $this->form_validation->set_rules('potential_fixed_location_id', 'Potential fixed location');

        if ($this->form_validation->run() == FALSE) {
            $data['list'] = $list;
            $this->load->view('update_graduate_view', $data);
        } else {
            $this->graduate_model->update($id);
            foreach ($list as $item) {
                $demand_location_id = $this->input->post($item->demand_location_id);
                if ($this->preference_model->check_preference($id, $demand_location_id)) {
                    $this->preference_model->update($id, $demand_location_id);
                } else {
                    $this->preference_model->save($id, $demand_location_id);
                }
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Updated!</div>');
            redirect('graduate/dashboard/' . $id);
        }
        $this->load->view('footer');
    }

    function listAll()
    {
        $this->breadcrumbs->push('Worker Settings', '/graduate/listAll');
        $data['graduate_list'] = $this->graduate_model->get_list();
        $this->load->view('graduate_list_view', $data);
        $this->load->view('footer');
    }

    function get_search_list($q)
    {
        $this->breadcrumbs->push('Worker Settings', '/graduate/listAll');
        $data['graduate_list'] = $this->graduate_model->get_search_list($q);
        $this->load->view('graduate_list_view', $data);
        $this->load->view('footer');
    }

    function get_upload_list($q)
    {
        $this->breadcrumbs->push('Worker Settings', '/graduate/listAll');
        $data['graduate_list'] = $this->graduate_model->get_upload_list($q);
        $this->load->view('graduate_list_view', $data);
        $this->load->view('footer');
    }

    function delete($id)
    {
        $this->graduate_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('graduate/listAll');
    }

    function search()
    {
        $keyword = $this->input->post('keyword');
        $data['graduate_total'] = $this->graduate_model->get_search_count($keyword);
        $data['location_total'] = $this->location_model->get_search_count($keyword);
        $data['demand_location_total'] = $this->demand_location_model->get_search_count($keyword);
        $data['worker_type_total'] = $this->worker_type_model->get_search_count($keyword);
        $data['worker_level_total'] = $this->worker_level_model->get_search_count($keyword);
        $data['key_word'] = $keyword;
        $this->load->view('search_result_view', $data);
        $this->load->view('footer');
    }

    function autocomplete()
    {
        $this->graduate_model->get_autocomplete();
    }

    function dashboard($id)
    {
        $this->breadcrumbs->push('Worker Settings', '/graduate/listAll');
        $this->breadcrumbs->push('Worker Dashboard', '/graduate/dashboard/' . $id);

        $data['emp'] = $this->graduate_model->get($id);

        $data['preferencelist'] = $this->preference_model->get_preference_list($id);

        $assigned_demand_location = $this->results_x_model->get_assigned_demand_location($id);
        if (is_null($assigned_demand_location)) {
            $data['assigned_demand_location'] = '<div class="alert alert-danger text-center">Allocation Pending</div>';
        } else {
            $data['assigned_demand_location'] = '<div class="alert alert-success text-center"> Allocated to ' . $assigned_demand_location->demand_location_name . '</div>';
        }
        $this->load->view('graduate_dashboard_view', $data);
        $this->load->view('footer');
    }

    function createPreference($id)
    {

        $this->breadcrumbs->push('Worker Settings ', '/graduate/listAll');
        $this->breadcrumbs->push('Worker Dashboard', '/graduate/dashboard/' . $id);
        $this->breadcrumbs->push('Add Worker Preference', '/');

        $data['emp'] = $this->graduate_model->get($id);

        $data['demand_location_id'] = $this->demand_location_model->get_demand_location_dropdown();

        $this->form_validation->set_rules('demand_location_id', 'Worker Preference Location', 'callback_combo_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('create_preference_view', $data);
        } else {
            $this->preference_model->save($id, $this->input->post('demand_location_id'));
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
            redirect('graduate/dashboard/' . $id);
        }
        $this->load->view('footer');
    }

    function delete_preference($id)
    {
        $preference = $this->preference_model->get($id);
        $this->preference_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('graduate/dashboard/' . $preference->graduate_id);
    }

    function remove_fixed_location($id)
    {
        $this->graduate_model->remove_fixed_location($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Fixed Location Removed!!</div>');
        redirect('graduate/dashboard/' . $id);
    }

    function sendMailReminder()
    {
        $this->email->from('tdhlakama@gmail.com', 'Takunda L C Dhlakama');
        $this->email->to('tdhlakama@live.com');
        //$this->email->cc('tdhlakama@yahoo.com');
        $this->email->subject('Reminder Contracts Expiring');
        $emp = $this->graduate_model->get_list();
        $msg = 'Graduate list' . "<br/>";
        if (isset($emp)) {
            foreach ($emp as $item) {
                $msg .= $item->employee_name . "<br/>";
            }
        }
        if (isset($comp)) {
            foreach ($comp as $item) {
                $msg .= $item->company_name . "<br/>";
            }
        }
        $this->email->message($msg);
        if ($this->email->send())
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Reminder has been sent successfully!</div>');
        else
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
        redirect("home");
    }

}

?>

