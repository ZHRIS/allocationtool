<?php

/*
 * File Name: graduate.php
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generic extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('breadcrumbs');
        $this->load->library('ion_auth');
        $this->load->library('zip');

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('nav');
        $this->load->helper('language');
        $this->load->helper('csv');
        $this->load->helper('file');
        $this->load->helper('download');

        $this->load->model('graduate_model');
        $this->load->model('location_model');
        $this->load->model('worker_type_model');
        $this->load->model('worker_level_model');
        $this->load->model('preference_model');
        $this->load->model('setting_model');
        $this->load->model('worker_salary_model');
        $this->load->model('demand_location_model');
        $this->load->model('worker_demand_model');
        $this->load->model('distance_model');
        $this->load->model('ion_auth_model');

        $this->load->model('demand_model');
        $this->load->model('general_model');
        $this->load->model('locations_model');
        $this->load->model('preferences_model');
        $this->load->model('types_model');
        $this->load->model('workers_model');
        $this->load->model('results_x_model');
        $this->load->model('upload_model');

        $str = ' <a href="' . site_url('home') . '"> Home </a>';
        $this->breadcrumbs->unshift($str, site_url('home'));
        $this->is_not_logged_in();
    }

    public function is_not_logged_in()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("login");
        }
    }

    public function is_logged_in()
    {
        if ($this->ion_auth->logged_in()) {
            redirect("home");
        }
    }

    public function logged_in()
    {
        if ($this->ion_auth->logged_in()) {
            return true;
        } else
            return false;
    }

    function combo_check($str)
    {
        if ($str == '-SELECT-') {
            $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function alpha_only_space($str)
    {
        if (!preg_match("/^([-a-z ])+$/i", $str)) {
            $this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $returnhtml = false)
    {//I think this makes more sense
        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml)
            return $view_html; //This will return html on 3rd argument being true
    }

    public function get_value($value)
    {
        if ($value === 'YES') {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_budget_value($value)
    {
        if ($value == 0) {
            return 'NA';
        } else {
            return $value;
        }
    }

}

?>

