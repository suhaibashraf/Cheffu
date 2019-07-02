<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_learner extends CI_Model {

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "learner";
    return $table;
}

function insert_cities($cities){
    $table = "city";
    $this->db->insert($table, $cities);
}

function get_countries($order_by){
    $table = "country";
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_cities($id){
    $table = "cities";
    $this->db->where('countryId', $id);
    $query=$this->db->get($table);
    return $query;
}

function _insert_learner($data) {
    $table = "learner";
    $this->db->insert($table, $data);
}    
    
function _insert_user($data) {
    $table = "user";
    $this->db->insert($table, $data);
    
}    
    
function get_where($id) {
    $table = 'learner';
    $this->db->where('userId', $id);
    $query=$this->db->get($table);
    return $query;
}
    
}