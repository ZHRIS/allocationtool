<?php

/**
 * Controller for Outputs of the Allocation - GLPK
 * User: tdhlakama
 */
class Allocation extends Generic_output
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->breadcrumbs->push('Allocation Results', '/');
        $data['has_allocation_tool_errors'] = $this->setting_model->has_allocation_tool_errors();
        $data['last_modified_date'] = $this->setting_model->get_last_modified_date();
        $this->load->view('allocation_view', $data);
        $this->load->view('footer');
    }

    public function fixed_assignments_view()
    {
        $this->breadcrumbs->push('Allocation Results', 'allocation');
        $this->breadcrumbs->push('Fixed Assignments', '/');
        $data['list'] = $this->demand_location_model->get_list();
        $data['worker_type_list'] = $this->worker_type_model->get_list();
        $data['tool_currency'] = $this->setting_model->get_tool_currency();
        $this->load->view('fixed_assignments_view', $data);
        $this->load->view('footer');
    }

    public function worker_assignments_view()
    {
        $this->breadcrumbs->push('Allocation Results', 'allocation');
        $this->breadcrumbs->push('Workers Assignments', '/');
        $data['list'] = $this->results_x_model->get_list();
        $this->load->view('worker_assignments_view', $data);
        $this->load->view('footer');
    }

    public function workers_not_assigned_view()
    {
        $this->breadcrumbs->push('Allocation Results', 'allocation');
        $this->breadcrumbs->push('Workers Not Assigned', '/');
        $data['list'] = $this->results_x_model->get_workers_not_assigned();
        $this->load->view('workers_not_assigned_view', $data);
        $this->load->view('footer');
    }

    public function demand_met_by_location_view()
    {
        $this->breadcrumbs->push('Allocation Results', 'allocation');
        $this->breadcrumbs->push('Demand Met by Locations', '');
        $data['demand_met_by_location'] = $this->results_x_model->get_demand_met_by_location();
        $this->load->view('demand_met_by_location_view', $data);
        $this->load->view('footer');
    }

    public function assignments_by_location_view()
    {
        $this->breadcrumbs->push('Allocation Results', 'allocation');
        $this->breadcrumbs->push('Assignment met by Location', '/');
        $data['assigments_by_location'] = $this->demand_location_model->assignments_by_location();
        $this->load->view('assignments_by_location_view', $data);
        $this->load->view('footer');
    }

    public function assignments_by_worker_types_view()
    {
        $this->breadcrumbs->push('Allocation Results', 'allocation');
        $this->breadcrumbs->push('Assignments by Worker Types', '/');
        $data['assignments_by_worker_types'] = $this->demand_location_model->assignments_by_worker_types();;
        $this->load->view('assignments_by_worker_types_view', $data);
        $this->load->view('footer');
    }

    public function pivot_table_view()
    {
        $this->breadcrumbs->push('Allocation Results', 'allocation');
        $this->breadcrumbs->push('Pivot Table', '/');
        $data['list'] = $this->demand_location_model->get_list();
        $data['worker_type_list'] = $this->worker_type_model->get_list();;
        $this->load->view('pivot_table_view', $data);
        $this->load->view('footer');
    }


    public function preferences_by_location_view()
    {
        $this->breadcrumbs->push('Allocation Results', 'allocation');
        $this->breadcrumbs->push('Preferences by Location', '/');
        $data['preferences_by_location'] = $this->demand_location_model->preferences_met_by_location();
        $this->load->view('preferences_by_location_view', $data);
        $this->load->view('footer');
    }

    public function workers()
    {
        $this->workers_model->delete();
        $list = $this->graduate_model->get_list();
        foreach ($list as $item) {
            $this->workers_model->save($item->graduate_id, $item->worker_type_name,
                $this->worker_salary_model->get_default_salary($item->worker_type_id, $item->worker_level_id),
                $this->graduate_model->get_is_fixed_location($item->graduate_id),
                $this->graduate_model->get_potential_fixed_location($item->graduate_id),
                $this->get_value($item->do_not_assign_outside_preferences));
        }
    }

    public function general()
    {
        $this->general_model->delete();
        $total_budget = $this->setting_model->get_total_budget_value();
        if ($total_budget == 0) {
            $this->general_model->save("totalbudget", 'NA');
        } else {
            $this->general_model->save("totalbudget", $total_budget);
        }
    }

    public function locations()
    {
        $this->locations_model->delete();
        $list = $this->demand_location_model->get_list();
        $default_penalty_unfulfilled_demand = $this->setting_model->get_setting()->default_penalty_unfulfilled_demand;
        foreach ($list as $item) {
            if (isset($item->penalty_unfulfilled_demand)) {
                $this->locations_model->save($item->demand_location_name, $this->get_budget_value($item->location_budget), $default_penalty_unfulfilled_demand);
            } else {
                $this->locations_model->save($item->demand_location_name, $this->get_budget_value($item->location_budget), 40);
            }
        }
    }

    public function types()
    {
        $this->types_model->delete();
        $list = $this->worker_type_model->get_list();
        foreach ($list as $item) {
            $this->types_model->save($item->worker_type_name);
        }
    }

    public function demand()
    {
        $this->demand_model->delete();
        $list = $this->demand_location_model->demand_data();
        foreach ($list as $item) {
            $this->demand_model->save($item->DemandLocation, $item->WorkerType, $item->Requested);
        }

    }

    public function preferences()
    {
        $this->preferences_model->delete();
        $list = $this->graduate_model->get_list();
        foreach ($list as $item) {
            $preferences = $this->preference_model->get_preference_list($item->graduate_id);
            $numberOfPreferenceAllowed = $this->setting_model->get_number_of_preferences_allowed();
            foreach ($preferences as $p) {
                if ($this->preferences_model->check_preference($item->graduate_id, $p->demand_location_name)) {
                    $this->preferences_model->save($item->graduate_id, $p->demand_location_name, $numberOfPreferenceAllowed);
                    $numberOfPreferenceAllowed = $numberOfPreferenceAllowed - 1;
                    if ($numberOfPreferenceAllowed == 0) {
                        break;
                    }
                }
            }
        }
    }

    public function download_export_csv($fileName, $data, $download)
    {
        if (!write_file($fileName, $data)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Unable to write the file!</div>');
        } else {
            if ($download == true) {
                force_download($fileName, NULL);
            }
        }

    }

    public function workers_csv($download)
    {
        $this->workers();
        $this->download_export_csv('workers.csv', $this->workers_model->export(), $download);
    }

    public function types_csv($download)
    {
        $this->types();
        $this->download_export_csv('types.csv', $this->types_model->export(), $download);
    }

    public function locations_csv($download)
    {
        $this->locations();
        $this->download_export_csv('locations.csv', $this->locations_model->export(), $download);
    }

    public function general_csv($download)
    {
        $this->general();
        $this->download_export_csv('general.csv', $this->general_model->export(), $download);
    }

    public function demand_csv($download)
    {
        $this->demand();
        $this->download_export_csv('demand.csv', $this->demand_model->export(), $download);
    }

    public function preferences_csv($download)
    {
        $this->preferences();
        $this->download_export_csv('preferences.csv', $this->preferences_model->export(), $download);
    }

    public function update_last_run($count)
    {
        $this->setting_model->save_last_allocation($count);
    }

    public function update_last_run_date()
    {
        $this->setting_model->save_last_run_date();
    }

    public function generate_glpk_csv()
    {
        $demand_locations = $this->demand_location_model->get_list();
        $worker_types = $this->worker_type_model->get_list();
        //check additional Worker Types and Locations, Create Zero Values
        foreach ($demand_locations as $demand) {
            foreach ($worker_types as $type) {
                if (!$this->worker_demand_model->check_demand($demand->demand_location_id, $type->worker_type_id)) {
                    $this->worker_demand_model->save($demand->demand_location_id, $type->worker_type_id, 0);
                }
            }
        }

        $this->workers_csv(false);
        $this->types_csv(false);
        $this->locations_csv(false);
        $this->general_csv(false);
        $this->demand_csv(false);
        $this->preferences_csv(false);
        $this->session->set_flashdata('msg', ' <div class="alert alert-success text-center">Step 1 : Generate Input Files Complete</div>');
        redirect('allocation');
    }

    public function run_glpk_csv()
    {
        unlink("results_x.csv");

        $setting = $this->setting_model->get_setting();
        $optimal_gap = $setting->optimality_gap;
        $maximum_running_time = $setting->maximum_running_time;

        $data = 'glpsol --mipgap ' . $optimal_gap . ' --tmlim ' . $maximum_running_time . ' -m Model.txt --log log.txt';

        $platform = $setting->platform;

        if (strcmp($platform, "Windows") == 0) {
            unlink("RunModel.bat");
            if (!write_file('RunModel.bat', $data)) {
                $this->session->set_flashdata('msg', ' <div class="alert alert-danger text-center">GPKL Error SETUP</div>');
            }
            $this->update_last_run_date();
            exec('RunModel.bat');
        } else {
            $this->update_last_run_date();
            exec($data);
        }

        $this->session->set_flashdata('msg', ' <div class="alert alert-success text-center">Step 2 : Allocation Complete - OPTIMAL SOLUTION FOUND</div>');
        $error = 'MathProg model processing error';
        $search_solution = 'INTEGER OPTIMAL SOLUTION FOUND';

        $lines = file('log.txt');
        foreach ($lines as $line) {
            $pos1 = stripos($line, $error);
            if ($pos1 === true) {
                $this->session->set_flashdata('msg', ' <div class="alert alert-danger text-center">Allocation Failed, Errors Found</div>');
                break;
            }
            $pos2 = stripos($line, $search_solution);
            if ($pos2 === true) {
                $this->session->set_flashdata('msg', ' <div class="alert alert-success text-center">Step 2 : Allocation Complete</div>');
                break;
            }
        }

        redirect('allocation');
    }

    public function run_glpk_db()
    {

        $setting = $this->setting_model->get_setting();
        $optimal_gap = $setting->optimality_gap;
        $maximum_running_time = $setting->maximum_running_time;

        $this->workers_csv(false);
        $this->types_csv(false);
        $this->locations_csv(false);
        $this->general_csv(false);
        $this->demand_csv(false);
        $this->preferences_csv(false);

        exec('RunModelDB.bat');

        $data = 'glpsol --mipgap ' . $optimal_gap . ' --tmlim ' . $maximum_running_time . ' -m Model.txt --log log.txt';

        $platform = $setting->platform;

        if (strcmp($platform, "Windows") == 0) {
            unlink("RunModelDB.bat");
            if (!write_file('RunModelDB.bat', $data)) {
                $this->session->set_flashdata('msg', ' <div class="alert alert-danger text-center">GPKL Error SETUP</div>');
            }
            exec('RunModelDB.bat');
        } else {
            exec($data);
        }

        $this->session->set_flashdata('msg', ' <div class="alert alert-success text-center">Allocation Complete</div>');
        $data['numberOfErrors'] = 0;
        $this->load->view('allocation_view', $data);
        $this->load->view('footer');
    }

    public function read_glpk_output()
    {
        $this->results_x_model->delete();
        $csv = array_map('str_getcsv', file('results_x.csv'));
        foreach ($csv as $item) {
            $demand_location_id = $this->demand_location_model->get_demand_location_by_name($item[1])->demand_location_id;
            $this->results_x_model->save($item[0], $demand_location_id);
        }
        $this->session->set_flashdata('msg', ' <div class="alert alert-success text-center">Step 3 : Allocation Complete</div>');
        redirect('allocation');

    }

    public function import_allocation_tool_input()
    {
        $csv = array_map('str_getcsv', file('results_x.csv'));
        $this->results_x_model->delete();
        foreach ($csv as $item) {
            $demand_location = $this->demand_location_model->get_demand_location_by_name($item[1]);
            $this->results_x_model->save($item[0], $item[1], $demand_location->demand_location_id);
        }
        $this->session->set_flashdata('msg', ' <div class="alert alert-success text-center">Step 3 : Results Read for Display</div>');
    }

    function download_offline_allocation_tool_zip()
    {

        $this->workers_csv(false);
        $this->types_csv(false);
        $this->locations_csv(false);
        $this->general_csv(false);
        $this->demand_csv(false);
        $this->preferences_csv(false);

        $zip_file_name = "AllocationTool";

        $this->zip->read_file('workers.csv');
        $this->zip->read_file('types.csv');
        $this->zip->read_file('demand.csv');
        $this->zip->read_file('locations.csv');
        $this->zip->read_file('preferences.csv');
        $this->zip->read_file('general.csv');

        $this->zip->download($zip_file_name);

    }

    function read_error_log()
    {
        $this->breadcrumbs->push('Allocation Tool Errors', '/');
        $path = 'log.txt';
        $data['error_log'] = file_get_contents($path);
        $this->load->view('error_log_view', $data);
        $this->load->view('footer');
    }

}

?>

