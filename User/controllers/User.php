<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User extends MX_Controller
{

function __construct() {
parent::__construct();
}
function login($role){
    $data['view_file'] = "loginform";
    $data['role'] = $role;
    $this->load->module('Main_template');
    $this->main_template->index($data);	
}

function submit(){
    $this->load->model("Mdl_user");
    if($this->Mdl_user->pword_check($_POST['username'], $_POST['pword'])){
        $this->_in_you_go($_POST['username']);
    }else{
        die("Invalid Credentials!");
    }




//  $this->load->library('form_validation');
//
//
//  $this->form_validation->set_rules('username', 'Username', 'required|max_length[30]');
//		$this->form_validation->set_rules('pword', 'Password', 'required|max_length[30]|callback_pword_check');
//		if ($this->form_validation->run($this) == FALSE)
//		{
//			$this->login();
//		}
//		else
//		{
//			$username = $this->input->post('username', TRUE);
//			$this->_in_you_go($username);
//		}
	}
function pword_check($pword){
    $username = $this->input->post('username' , TRUE);
    // $pword = Modules::run('index.php/site_secutiry/make_hash', $pword);
    $this->load->model('Mdl_user');
    $result = $this->mdl_user->pword_check($username, $pword);
    if ($result == FALSE)
    {
        $this->form_validation->set_message('pword_check', 'The username and/or password you entered is not correct');
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}
       
        
function _in_you_go($username){
	//if successfully logged in creating a sesssion a taking the user to the admin panel
	$query = $this->get_where_custom('userName', $username);
	foreach($query->result() as $row){
		$user_id = $row->userId;
		$username = $row->userName;
                $userRole = $row->userRole;
	}
	$this->session->set_userdata('username', $username);
	$this->session->set_userdata('user_id', $user_id);
        $this->session->set_userdata('user_role', $userRole);
        if($userRole == 'chef'){
            header('Location:'.base_url().'Chef/Dashboard?attr='.$user_id);
        }else{
            header('Location:'.base_url().'Learner/Dashboard?attr='.$user_id);
        }
}


function logout(){
    $this->load->library('session');
    $this->session->sess_destroy();
    header("Location: ".base_url());
}

function get($order_by) {
    $this->load->model('mdl_user');
    $query = $this->mdl_user->get($order_by);
    return $query;
}
function get_where($id) {
    $this->load->model('mdl_user');
    $query = $this->mdl_user->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_user');
    $query = $this->mdl_user->get_where_custom($col, $value);
    return $query;
}


function get_max() {
    $this->load->model('mdl_user');
    $max_id = $this->mdl_user->get_max();
    return $max_id;
}

function loginJson(){
    $this->load->model("Mdl_user");
    if($this->Mdl_user->pword_check($_POST['username'], $_POST['pword'])){
        $query = $this->get_where_custom('userName', $_POST['username']);
	foreach($query->result() as $row){
		$user_id = $row->userId;
		$username = $row->userName;
                $userRole = $row->userRole;
	}
	$this->session->set_userdata('username', $username);
	$this->session->set_userdata('user_id', $user_id);
        $this->session->set_userdata('user_role', $userRole);
        echo "true";
    }else{
        echo "false";
    }
}

}