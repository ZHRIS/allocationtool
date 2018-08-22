<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('active_link')) {

    function active_link($controller)
    {
        $CI = &get_instance();

        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active' : '';
    }

}

if (!function_exists('active_method')) {

    function active_method($method)
    {
        $CI = &get_instance();

        $action = $CI->router->method;
        return ($action == $method) ? 'active' : '';
    }

}

if (!function_exists('get_percentage')) {
    function get_percentage($total, $number)
    {
        if ($total > 0) {
            return round($number / ($total / 100), 2);
        } else {
            return 0;
        }
    }
}

if (!function_exists('get_preferences')) {
    function get_preferences($id)
    {
        $CI =& get_instance();
        $CI->load->model('preference_model');
        if ($id != 0) {
            $CI->preference_model->get_preference_list($id);
        }
    }
}

if (!function_exists('get_number_of_allowed_preferences')) {
    function get_number_of_allowed_preferences()
    {
        $CI =& get_instance();
        $CI->load->model('setting_model');
        $CI->setting_model->get_number_of_preferences_allowed();
    }
}

if (!function_exists('logged_in')) {
    function logged_in()
    {
        $CI =& get_instance();
        $CI->load->library('ion_auth');
        $CI->ion_auth->logged_in();
    }
}
