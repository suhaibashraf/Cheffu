<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Notifications extends MX_Controller
{

function __construct() {
parent::__construct();
}
function index(){
}

function get_where($id){
    $this->load->model('mdl_notifications');
    $query = $this->mdl_notifications->get_where($id);
    return $query;
}

function get_where_unread($id){
    $this->load->model('mdl_notifications');
    $query = $this->mdl_notifications->get_where_unread($id);
    return $query;
}

function _insert($data) {
    $this->load->model('mdl_notifications');
    $this->mdl_notifications->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_notifications');
$this->mdl_notifications->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_dost');
$this->mdl_dost->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_dost');
$count = $this->mdl_dost->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_dost');
$max_id = $this->mdl_dost->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_dost');
$query = $this->mdl_dost->_custom_query($mysql_query);
return $query;
}

}