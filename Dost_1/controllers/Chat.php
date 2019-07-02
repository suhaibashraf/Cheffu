<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Chat extends MX_Controller
{

function __construct() {
parent::__construct();
}


	//Global variable  
    public $outputData;		//Holds the output data for each view
	public $loggedInUser;

public function index(){
		//Load the users model 
		$this->load->module('User');
		//Load the session library
		$this->load->library('session');	
		// Redirect if not logged
		$sessionUserID = $this->session->userdata('user_id');
		if(!$sessionUserID) 
			redirect('welcome');
		
		//Get all users
		$data['listOfUsers'] = $this->user->get("userId");
						
		$this->load->view('chat/userList',$data);
    }
	


function get($order_by) {
$this->load->model('mdl_chat');
$query = $this->mdl_chat->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_chat');
$query = $this->mdl_chat->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_chat');
$query = $this->mdl_chat->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_chat');
$query = $this->mdl_chat->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_chat');
$this->mdl_chat->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_chat');
$this->mdl_chat->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_chat');
$this->mdl_chat->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_chat');
$count = $this->mdl_chat->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_chat');
$max_id = $this->mdl_chat->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_chat');
$query = $this->mdl_chat->_custom_query($mysql_query);
return $query;
}

}



