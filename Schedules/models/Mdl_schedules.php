<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_schedules extends CI_Model {

function __construct() {
parent::__construct();
}

function get_where($id) {
    $table = 'schedules';
    $this->db->where('chefId', $id);
    $query=$this->db->get($table);
    return $query;
}
function get_where_id($id){
    $table = 'schedules';
    $this->db->where('id', $id);
    $query=$this->db->get($table);
    return $query;
}

function _insert($data) {
    $table = 'schedules';
    $this->db->insert($table, $data);
}

function _update($id, $data) {
    $table = 'schedules';
    $this->db->where('id', $id);
    $this->db->update($table, $data);
}
    
}