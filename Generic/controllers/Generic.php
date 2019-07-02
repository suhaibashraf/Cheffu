<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Generic extends MX_Controller
{

function __construct() {
parent::__construct();
}
function index(){
	die('This is the perfect controller');
}

function getCitiesJson($id){
    $cities= $this->get_where('city', 'countryId' ,$id);
    echo json_encode($cities->result());
}

function get($table ,$order_by) {
$this->load->model('mdl_generic');
$query = $this->mdl_generic->get($table ,$order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_generic');
$query = $this->mdl_generic->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($table, $column ,$id) {
$this->load->model('mdl_generic');
$query = $this->mdl_generic->get_where($table, $column ,$id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_generic');
$query = $this->mdl_generic->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_generic');
$this->mdl_generic->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_generic');
$this->mdl_generic->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_generic');
$this->mdl_generic->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_generic');
$count = $this->mdl_generic->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_generic');
$max_id = $this->mdl_generic->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_generic');
$query = $this->mdl_generic->_custom_query($mysql_query);
return $query;
}

}
