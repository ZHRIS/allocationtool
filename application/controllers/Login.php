<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->view('header_home');
        $this->load->library('ion_auth');
        $this->load->helper(array('url', 'language'));
        $str = ' <a href="/allocationtool"> Home </a>';
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    }

    function index()
    {

        if ($this->ion_auth->logged_in()) {
            // redirect them to the home page
            redirect('home');
        }

        $this->load->view('login_view');
        $this->load->view('footer');
    }

    // log the user in
    function login()
    {
        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            //validation fails
            $this->load->view('login_view');
        } else {
            $remember = false;

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page
                redirect('home');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username or password!' . '</div>');
                redirect('login/index');
            }
        }
        $this->load->view('footer');
    }

    function logout()
    {
        // log the user out
        $logout = $this->ion_auth->logout();
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">' . $this->ion_auth->messages() . '</div>');
        redirect('login', 'refresh');
    }

}
