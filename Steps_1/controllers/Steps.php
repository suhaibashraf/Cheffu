<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Steps extends MX_Controller
{

function __construct() {
parent::__construct();
}

function _insert($data) {
    $this->load->model('mdl_steps');
    $this->mdl_steps->_insert($data);
}
    
function get($order_by) {
    $this->load->model('mdl_steps');
    $this->mdl_steps->get_where();
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_steps');
    $query = $this->mdl_steps->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id) {
    $this->load->model('mdl_steps');
    $query = $this->mdl_steps->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_steps');
    $query = $this->mdl_steps->get_where_custom($col, $value);
    return $query;
}    
    
    
}