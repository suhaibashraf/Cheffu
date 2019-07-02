<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Test extends MX_Controller
{

function __construct() {
parent::__construct();
}
function index(){
    $data['view_file'] = "test_view";
	$this->load->module('Main_template');
	$this->main_template->index($data);
}

function form_test(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('website', 'Website', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');


		if($this->form_validation->run() == FALSE)
		{
			$data['view_file'] = "test_view";
        	$this->load->module('Main_template');
        	$this->main_template->index($data);
		}
		else
		{
			die("Confirmed");
		}

	
}

}