<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller
{

function __construct() {
parent::__construct();
}
function index(){
    $this->load->module("Main_template");
    $data['view_file'] = 'main_view';
    $data['module'] = 'Main';
    
    $this->main_template->index($data);
}

}