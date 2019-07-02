<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_notifications extends CI_Model {

function __construct() {
parent::__construct();
}

function get_where($id) {
    $table = 'notifications';
    $this->db->where('intended_for_id', $id);
    $query=$this->db->get($table);
    return $query;
}

function get_where_unread($id) {
    $table = 'notifications';
    $this->db->where('is_read', 0);
    $this->db->where('intended_for_id', $id);
    $query=$this->db->get($table);
    return $query;
}

function _insert($data) {
    $table = 'notifications';
    $this->db->insert($table, $data);
}

function get_max() {
    $table = 'notifications';
    $this->db->select_max('id');
    $query = $this->db->get($table);
    $row=$query->row();
    $id=$row->id;
    return $id;
}

function _update($id, $data) {
    $table = 'notifications';
    $this->db->where('id', $id);
    $this->db->update($table, $data);
}

}