<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Main_template extends MX_Controller
{

function __construct() {
parent::__construct();
}
function index($data){
    $this->load->view("main_template_view", $data);
}

}