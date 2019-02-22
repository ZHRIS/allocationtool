<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting extends Generic_input
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->breadcrumbs->push('Settings', '/setting/listAll');
        $this->breadcrumbs->push('Add Settings', '/');

        $data['tool_currency'] = $this->setting_model->get_currencies_dropdown();
        $data['platform'] = $this->setting_model->get_platform_dropdown();

        $this->form_validation->set_rules('maximum_running_time', 'Maximum Running Time', 'trim|required|numeric');
        $this->form_validation->set_rules('optimality_gap', 'Optimality Gap', 'trim|required|numeric');
        $this->form_validation->set_rules('harvesine_formula', 'Harvesine Formula', 'trim|required|numeric');
        $this->form_validation->set_rules('maximum_weight', 'Maximum Weight', 'trim|required|numeric');
        $this->form_validation->set_rules('total_budget', 'Total Budget', 'trim|integer');
        $this->form_validation->set_rules('tool_currency', 'Currency', 'callback_combo_check');
        $this->form_validation->set_rules('platform', 'Platform', 'callback_combo_check');

        $this->form_validation->set_rules('number_of_preferences_allowed', 'Number of Preferences allowed', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('setting_view');
        } else {
            $this->setting_model->save();
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Added!</div>');
            redirect('setting/listAll');
        }
        $this->load->view('footer');
    }

    public function listAll()
    {
        $this->breadcrumbs->push('Settings', '/setting/listAll');
        $data['list'] = $this->setting_model->get_list();
        if ($this->setting_model->get_row_count() == 0) {
            $data['showAdd'] = '<a href="index" class="btn btn-lg btn-primary" style="float: right;">Add General Setting</a>';
        } else {
            $data['showAdd'] = '';
        }
        $this->load->view('setting_list_view', $data);
        $this->load->view('footer');
    }

    function delete($id)
    {
        $this->setting_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Recorded Deleted from Database!!!</div>');
        redirect('setting/listAll');
    }

    function update($id)
    {
        $this->breadcrumbs->push('Settings', '/setting/listAll');
        $this->breadcrumbs->push('Update Settings', '/');

        $data['emp'] = $this->setting_model->get($id);
        $data['tool_currency'] = $this->setting_model->get_currencies_dropdown();
        $data['platform'] = $this->setting_model->get_platform_dropdown();

        $this->form_validation->set_rules('maximum_running_time', 'Maximum Running Time', 'trim|required|numeric');
        $this->form_validation->set_rules('optimality_gap', 'Optimality Gap', 'trim|required|numeric');
        $this->form_validation->set_rules('harvesine_formula', 'Harvesine Formula', 'trim|required|numeric');
        $this->form_validation->set_rules('maximum_weight', 'Maximum Weight', 'trim|required|numeric');
        $this->form_validation->set_rules('total_budget', 'Total Budget', 'trim|integer');
        $this->form_validation->set_rules('default_penalty_unfulfilled_demand', 'Default penalty unfulfilled demand', 'trim|required|numeric');
        $this->form_validation->set_rules('number_of_preferences_allowed', 'Number of Preferences allowed', 'trim|required|numeric');
        $this->form_validation->set_rules('tool_currency', 'Currency', 'callback_combo_check');
        $this->form_validation->set_rules('platform', 'Platform', 'callback_combo_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('update_setting_view', $data);
        } else {
            $this->setting_model->update($id);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Successfully Updated!</div>');
            redirect('setting/listAll');
        }
        $this->load->view('footer');
    }

    public function configure_system()
    {

        if (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $this->breadcrumbs->push('Configure', '/');
        $data['has_allocation_tool_errors'] = $this->setting_model->has_allocation_tool_errors();
        $data['last_modified_date'] = $this->setting_model->get_last_modified_date();
        $this->load->view('admin_view', $data);
        $this->load->view('footer');
    }

    public function upload_result()
    {
        $this->breadcrumbs->push('Configure', '/');
        $data['upload_list'] = $this->upload_model->get_list();
        $this->load->view('upload_result', $data);
        $this->load->view('footer');
    }

    public function upload_view()
    {
        $this->breadcrumbs->push('Configure', '/');
        $data['error'] = '';
        $data['upload_list'] = $this->upload_model->get_last_five_entries();
        $this->load->view('upload_view', $data);
        $this->load->view('footer');
    }

    public function upload_static_view()
    {
        $this->breadcrumbs->push('Configure', '/');
        $data['error'] = '';
        $data['type_list'] = $this->get_upload_static_dropdown();
        $this->load->view('upload_static_view', $data);
        $this->load->view('footer');
    }

    function get_upload_static_dropdown()
    {
        $_id = array('-SELECT-');
        $_name = array('-SELECT-');
        array_push($_id, 'location');
        array_push($_name, 'Study Location');
        array_push($_id, 'worker_type');
        array_push($_name, 'Worker Type');
        array_push($_id, 'worker_level');
        array_push($_name, 'Worker Level');
        array_push($_id, 'demand_location');
        array_push($_name, 'Demand Location');
        array_push($_id, 'worker_demand');
        array_push($_name, 'Worker Demand');
        return $list_result = array_combine($_id, $_name);
    }

    public function do_static_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 10000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['file_name'] = 'static_list.csv';
        $config['overwrite'] = TRUE;


        $this->load->library('Upload', $config);
        $this->upload->initialize($config);

        $file = "./uploads/static_list.csv";

        if (!$this->upload->do_upload('userfile')) {
            $data['error'] = $this->upload->display_errors();
            $data['type_list'] = $this->get_upload_static_dropdown();
            $this->load->view('upload_static_view', $data);
        }

        $type_name = trim(($_POST['type_list']));

        $data['csv'] = array_map('str_getcsv', file($file));

        foreach ($data['csv'] as $item) {


            if ($type_name === "location") {

                if (!$this->location_model->check_duplicate(trim($item[0]))) {
                    $this->location_model->save_name(trim($item[0]));
                }
            }

            if ($type_name === "worker_type") {

                if (!$this->worker_type_model->check_duplicate(trim($item[0]))) {
                    $this->worker_type_model->save_name(trim($item[0]));
                }
            }

            if ($type_name === "worker_level") {

                if (!$this->worker_level_model->check_duplicate(trim($item[0]))) {
                    $this->worker_level_model->save_name(trim($item[0]));
                }
            }

            if ($type_name === "demand_location") {

                if (!$this->demand_location_model->check_duplicate(trim($item[0]))) {
                    $this->demand_location_model->save_name(trim($item[0]));
                }
            }
            if ($type_name === "worker_demand") {
                $validity = true;
                $worker_type_id = null;
                $demand_location_id = null;


                if (!$this->demand_location_model->check_duplicate(trim($item[0]))) {
                    $validity = false;
                } else {
                    $demand_location_id = $this->demand_location_model->search(trim($item[0]))->demand_location_id;
                }

                if (!$this->worker_type_model->check_duplicate(trim($item[1]))) {
                    $validity = false;

                } else {
                    $worker_type_id = $this->worker_type_model->search(trim($item[1]))->worker_type_id;
                }

                $worker_demand = $this->worker_demand_model->get_demand($demand_location_id, $worker_type_id);
                if (is_null($worker_demand)) {
                    if ($validity) {
                        $this->worker_demand_model->save($demand_location_id, $worker_type_id, trim($item[2]));
                    }
                } else {
                    $this->worker_demand_model->update($worker_demand->worker_demand_id, trim($item[2]));
                }
            }
        }
        unlink($file);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Upload Complete - ' . $type_name . '  </div>');
        redirect('setting/upload_static_view');
    }

    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 10000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['file_name'] = 'graduate_list.csv';
        $config['overwrite'] = TRUE;

        $this->load->library('Upload', $config);
        $this->upload->initialize($config);

        $file = "./uploads/graduate_list.csv";
        if (!$this->upload->do_upload('userfile')) {
            $data['error'] = $this->upload->display_errors();
            $data['upload_list'] = $this->upload_model->get_last_five_entries();
            $this->load->view('upload_view', $data);
        } else {
            redirect('setting/upload_success');
        }
    }

    public function upload_success()
    {
        $data['csv'] = array_map('str_getcsv', file('./uploads/graduate_list.csv'));
        $this->load->view('upload_sucess_view', $data);
        $this->load->view('footer');
    }

    public function save_success()
    {
        $data['csv'] = array_map('str_getcsv', file('./uploads/graduate_list.csv'));

        $count = 0;
        $errors = 0;
        $duplicate = '';
        $locationMissing = '';
        $workerTypeMissing = '';
        $workerLevelMissing = '';

        $numberOfPreferenceAllowed = $this->setting_model->get_number_of_preferences_allowed();

        $id = $this->upload_model->save($this->session->userdata('identity'));
        foreach ($data['csv'] as $item) {
            $graduate_valid = true;
            $graduate_no = null;
            if ($this->graduate_model->check_duplicate(trim($item[0]))) {
                $graduate_valid = false;
                $duplicate = 'Duplicate ID found';
            } else {
                $graduate_no = $item[0];
            }

            $location_id = null;
            if (!$this->location_model->check_duplicate(trim($item[3]))) {
                $graduate_valid = false;
                $locationMissing = 'Study Location :not found';
            } else {
                $location_id = $this->location_model->search(trim($item[3]))->location_id;
            }

            $worker_type_id = null;
            if (!$this->worker_type_model->check_duplicate(trim($item[4]))) {
                $graduate_valid = false;
                $workerTypeMissing = 'Worker Type :not found';
            } else {
                $worker_type_id = $this->worker_type_model->search(trim($item[4]))->worker_type_id;
            }

            $worker_level_id = null;
            if (!$this->worker_level_model->check_duplicate(trim($item[5]))) {
                $graduate_valid = false;
                $workerLevelMissing = 'Worker Level :not found';
            } else {
                $worker_level_id = $this->worker_level_model->search(trim($item[5]))->worker_level_id;
            }


            if ($graduate_valid) {


                /* use this to break full name into first name and last name
                  $full_name = explode("-", $item[1], 2);
                  $first_name =$full_name[0];
                  $last_name =$full_name[1];
                 */


                $graduate_id = $this->graduate_model->save_upload(
                    $graduate_no, trim($item[1]), //first_name
                    trim($item[2]), //$last_name
                    $location_id, $worker_type_id, $worker_level_id, trim($item[6]), $id
                );


                $preference_start = 7;

                for ($i = 0; $i < $numberOfPreferenceAllowed; $i++) {
                    $preference_valid = true;
                    $preference = null;
                    if (!$this->demand_location_model->check_duplicate(trim($item[$preference_start]))) {
                        $preference_valid = false;
                    } else {
                        $preference = $this->demand_location_model->search(trim($item[$preference_start]))->demand_location_id;
                    }

                    if ($preference_valid) {
                        $this->preference_model->save($graduate_id, $preference);
                    }

                    $preference_start++;
                }

                $count++;
            } else {
                $errors++;
            }
        }
        $reasons = $duplicate . ' ' . $locationMissing . ' ' . $workerTypeMissing . ' ' . $workerLevelMissing . ' ' . $preferenceMissing = '';
        $this->upload_model->update($id, $count, $errors, $reasons);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Updated Successfully ' . $count . ' * Errors Found ' . $errors . ' </div>');
        redirect('setting/upload_success');
    }

    public function download_template_csv()
    {
        force_download("./assets/tool/upload_template.csv", NULL);
    }

    function delete_allocation_tool_data()
    {
        $this->workers_model->delete();
        $this->locations_model->delete();
        $this->types_model->delete();
        $this->demand_model->delete();
        $this->preferences_model->delete();
        $this->results_x_model->delete();
        $this->general_model->delete();

        $this->location_model->deleteAll();
        $this->worker_type_model->deleteAll();
        $this->worker_level_model->deleteAll();
        $this->preference_model->deleteAll();
        $this->worker_salary_model->deleteAll();
        $this->demand_location_model->deleteAll();
        $this->worker_demand_model->deleteAll();
        $this->distance_model->deleteAll();
        $this->upload_model->deleteAll();

        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Allocation Tool Data Reset!</div>');

        redirect('setting/configure_system/');
    }

    function delete_worker_data()
    {
        $this->workers_model->delete();
        $this->locations_model->delete();
        $this->types_model->delete();
        $this->demand_model->delete();
        $this->preferences_model->delete();
        $this->results_x_model->delete();
        $this->general_model->delete();

        $this->graduate_model->deleteAll();
        $this->preference_model->deleteAll();
        $this->upload_model->deleteAll();
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Worker info deleted!</div>');
        redirect('setting/configure_system/');
    }


    public function worker_type_template_csv()
    {
        force_download("./assets/tool/worker_type_template.csv", NULL);
    }

    public function worker_level_template_csv()
    {
        force_download("./assets/tool/worker_level_template.csv", NULL);
    }

    public function study_location_template_csv()
    {
        force_download("./assets/tool/study_location_template.csv", NULL);
    }

    public function demand_location_template_csv()
    {
        force_download("./assets/tool/demand_location_template.csv", NULL);
    }

    public function worker_demand_template_csv()
    {
        force_download("./assets/tool/worker_demand_template.csv", NULL);
    }


}

?>

