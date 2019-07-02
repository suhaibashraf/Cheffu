<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Schedules extends MX_Controller
{

function __construct() {
parent::__construct();
}
function index(){
}
function availabilty(){
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    $query = $this->get_where($obj->chefId);
    $start_new = strtotime($obj->date. ' ' .$obj->start);
    $end_new = strtotime($obj->date. ' ' .$obj->end);
    $check = true;
    foreach ($query->result() as $row){
        $old_start = $row->start;
        $old_end = $row->end;
        if($start_new <= $old_end && $old_start >= $end_new){
            $check = false;
            echo "Not Available";
        }else{
            $check = true;
        }
    }
    if($check){
        $data['chefId'] = $obj->chefId;
        $data['start'] = date('Y-m-d H:i:s', $start_new);
        $data['end'] = date('Y-m-d H:i:s', $end_new);
        $data['userId'] = $obj->userId;
        $data['status'] = 'pending';
        $this->_insert($data);
        $this->load->module('Learner');
        $query = $this->learner->get_where($obj->userId);
        foreach($query->result() as $row){
            $firstName = $row->learnerFirstName;
            $lastName = $row->learnerLastName;
            $requesteeId = $row->userId;
        }
        var_dump($data);
        $data_not['intended_for_id'] = $obj->chefId;
        $data_not['requestee_id'] = $obj->userId;
        $data_not['description'] = $firstName . " " . $lastName . " has requested for your consultanlcy starting:" . " " . date('Y-m-d H:i:s', $start_new) . " ending:" . " " . date('Y-m-d H:i:s', $end_new);
        $data_not['generation_date'] = date('Y-m-d H:i:s');
        $data_not['read_date'] = '';
        $data_not['is_read'] = false;
        $data_not['activity_id'] = $this->get_max();
        $this->load->module('Notifications');
        $this->notifications->_insert($data_not);
        echo "okay";
    }
}

function accept(){
    $data['status'] = 'approved';
    $this->_update($_GET['activityId'], $data);
    $this->load->module("Notifications");
    $dataNot['is_read'] = true;
    $dataNot['read_date'] = date('Y-m-d H:i:s');
    
    $this->notifications->_update($_GET['notificationId'], $dataNot);
    $schedule = $this->get_where_id($_GET['activityId']);
    
    foreach($schedule->result() as $row){
        $startDate = $row->start;
        $endDate = $row->end;
        $chefId = $row->chefId;
    }
    $this->load->module("Chef");
    $chef = $this->chef->get_where($chefId);
    foreach($chef->result() as $row){
        $firstName = $row->chefFirstName;
        $lastName = $row->chefLastName;
    }
    
    $dataNotNew['intended_for_id'] = $_GET['requesteeId'];
    $dataNotNew['requestee_id'] = $_GET['attr'];
    $dataNotNew['description'] = $firstName . " " . $lastName . " has accepted your request for consultancy. Your session will start " . $startDate . ". Please make sure to visit chef's profile for session.";
    $dataNotNew['generation_date'] = date('Y-m-d H:i:s');
    $dataNotNew['read_date'] = '';
    $dataNotNew['is_read'] = false;
    $dataNotNew['activity_id'] = "n/a";
    $this->notifications->_insert($dataNotNew);
    
    
    
    $dataNot['intended_for_id'] = $_GET['attr'];
    $dataNot['description'] = "You have successfully approved";
    $dataNot['intended_for_id'] = $_GET['attr'];
    $dataNot['requestee_id'] = $_GET['attr'];
    $dataNot['generation_date'] = date('Y-m-d H:i:s');
    $dataNot['read_date'] = '';
    $dataNot['is_read'] = false;
    $dataNot['activity_id'] = 'n/a';
    $this->notifications->_insert($dataNot);
    header("Location: " . base_url() . "Chef/dashboard?attr=".$_SESSION['user_id']);
}

function get_where($id){
    $this->load->model('mdl_schedules');
    $query = $this->mdl_schedules->get_where($id);
    return $query;
}

function get_where_id($id){
    $this->load->model('mdl_schedules');
    $query = $this->mdl_schedules->get_where_id($id);
    return $query;
}

function _insert($data) {
    $this->load->model('mdl_schedules');
    $this->mdl_schedules->_insert($data);
}

function _update($id, $data) {
    $this->load->model('mdl_schedules');
    $this->mdl_schedules->_update($id, $data);
}

function _delete($id) {
    $this->load->model('mdl_schedules');
    $this->mdl_schedules->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('mdl_schedules');
    $count = $this->mdl_schedules->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('mdl_notifications');
    $max_id = $this->mdl_notifications->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('mdl_schedules');
    $query = $this->mdl_schedules->_custom_query($mysql_query);
    return $query;
}

}