<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Template
{
    public function load($template, $page, $data = [], $return = FALSE)
    {
        date_default_timezone_set('Asia/Singapore');
        $CI = &get_instance();
        $page_data['content'] = $CI->load->view($page, $data, TRUE);
        return $CI->load->view($template, $page_data, $return);
    }
}
