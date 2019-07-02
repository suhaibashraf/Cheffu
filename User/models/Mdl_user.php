<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_user extends CI_Model {

function __construct() {
parent::__construct();
}
function get_table() {
    $table = "user";
    return $table;
}
function get($order_by) {
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}
function get_where($id) {
    $table = $this->get_table();
    $this->db->where('userId', $id);
    $query=$this->db->get($table);
    return $query;
}

function get_max() {
    $table = $this->get_table();
    $this->db->select_max('userId');
    $query = $this->db->get($table);
    $row=$query->row();
    $id=$row->userId;
    return $id;
}

function pword_check($username, $pword){
    $table = $this->get_table();
    $this->db->where('userName', $username);
    $this->db->where('userPassword', $pword);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    if($num_rows>0){
            return TRUE;
    }else {
            return FALSE;
    }
}

function get_where_custom($col, $value) {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $query=$this->db->get($table);
    return $query;
}



}