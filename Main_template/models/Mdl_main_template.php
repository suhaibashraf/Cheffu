<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_main_template extends CI_Model {

function __construct() {
parent::__construct();
}

function get_table() {
$table = "tablename";
return $table;
}
}