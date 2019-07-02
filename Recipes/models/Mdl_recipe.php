<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_recipe extends CI_Model {

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "recipe";
    return $table;
}

function _insert($data) {
    $table = $this->get_table();
    $this->db->insert($table, $data);
}

function _insert_rating($data) {
    $table = 'recipeRating';
    $this->db->insert($table, $data);
}

function _insert_chefRecipe($data) {
    $table = 'chefRecipe';
    $this->db->insert($table, $data);
}

function get_max() {
    $table = $this->get_table();
    $this->db->select_max('recipeId');
    $query = $this->db->get($table);
    $row=$query->row();
    $id=$row->recipeId;
    return $id;
}

function get($order_by) {
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_recipeRating($id) {
    $table = 'recipeRating';
    $this->db->where('recipeId', $id);
    $query=$this->db->get($table);
    return $query;
}


function getCats($order_by){
    $table = "recipeCategory";
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function getRegionCats($order_by){
    $table = "recipeRegionCategory";
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}


function get_with_limit($limit, $offset, $order_by) {
    $table = $this->get_table();
    $this->db->limit($limit, $offset);
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_where($id) {
    $table = $this->get_table();
    $this->db->where('recipeId', $id);
    $query=$this->db->get($table);
    return $query;
}
function get_where_chef($id) {
    $table = $this->get_table();
    $this->db->where('recipeChefId', $id);
    $query=$this->db->get($table);
    return $query;
}



function get_where_recipe($id) {
    $table = "chefRecipe";
    $this->db->where('recipeId', $id);
    $query=$this->db->get($table);
    return $query;
}

function get_filtered($id) {
    $table = $this->get_table();
    $this->db->where('recipeCategoryId', $id);
    
    $query=$this->db->get($table);
    return $query;
}
function get_where_custom($col, $value) {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $query=$this->db->get($table);
    return $query;
}

function insertRecipeRating($data){
    $table = 'recipeRating';
    $this->db->insert($table, $data);
}

function updateRecipeRating($data){
    $table = 'recipeRating';
    $this->db->update($table, $data);
}

function _updateRecipe($id, $data) {
    $table = 'recipe';
    $this->db->where('recipeId', $id);
    $this->db->update($table, $data);
}


}