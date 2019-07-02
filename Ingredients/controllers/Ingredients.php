<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ingredients extends MX_Controller
{

function __construct() {
parent::__construct();
}

function _insert($data) {
    $this->load->model('mdl_ingredients');
    $this->mdl_ingredients->_insert($data);
}


function get($order_by) {
    $this->load->model('mdl_ingredients');
    $query = $this->mdl_ingredients->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_ingredients');
    $query = $this->mdl_ingredients->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id) {
    $this->load->model('mdl_ingredients');
    $query = $this->mdl_ingredients->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_ingredients');
    $query = $this->mdl_ingredients->get_where_custom($col, $value);
    return $query;
}

function _updateIng($id, $data) {
    $this->load->model('mdl_ingredients');
    $this->mdl_ingredients->_updateIng($id, $data);
}

function deleteIng($ingId){
    if($this->_delete($ingId)){
        echo "success";
    }else{
        echo "fail";
    }
}

function _delete($id) {
    $this->load->model('mdl_ingredients');
    $this->mdl_ingredients->_delete($id);
}

}