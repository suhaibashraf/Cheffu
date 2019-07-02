<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Learner extends MX_Controller
{
function __construct() {
parent::__construct();
}
function index(){
    
}
function signUpForm(){
    $data['view_file'] = "signup_form";
    $data['countries'] = $this->get_countries("countryId");
    $data['role'] = 'Learner';
    $this->load->module('Main_template');
    $this->main_template->index($data);
}

function get_countries($order_by){
    $this->load->model('mdl_learner');
    $query = $this->mdl_learner->get_countries($order_by);
    return $query;
}

function get_cities_where(){
    $query = $this->get_cities($_GET['country_id']);
    echo json_encode($query);
}

function addCity(){
    $cities = json_decode(file_get_contents('php://input'), true);
    $this->insert_cities($cities);
    
}

function insert_cities($cities){
    $this->load->model("mdl_learner");
    $this->mdl_learner->insert_cities($cities);
}

function get_cities($id){
    $this->load->model('mdl_learner');
    $query = $this->mdl_learner->get_cities($id);
    return $query;
}

function form_validate(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Street', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        if($this->form_validation->run() == FALSE)
        {
            $data['view_file'] = "signup_form";
            $this->load->module('Main_template');
            $this->main_template->index($data);
        }
        else
        {
            if(!empty($_POST['image-data'])){
                $encoded = $_POST['image-data'];
                //explode at ',' - the last part should be the encoded image now
                $exp = explode(',', $encoded);
                //decode the image and finally save it
                $dataImage = base64_decode($exp[1]);
                $file = date('mdYhis', time()).$_POST['firstname'].$_POST['lastname'].".png";
                //make sure you are the owner and have the rights to write content
                file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/chefuFinal/uploads/dp/" . $file, $dataImage);
            }
            $this->load->module("User");
            $data_db_learner['learnerFirstName'] = $_POST['firstname'];
            $data_db_learner['learnerLastName'] = $_POST['lastname'];
            $data_db_learner['userId'] = $this->user->get_max()+1;
            $data_db_user['userName'] = $_POST['email'];
            $data_db_user['userPassword'] = $_POST['password'];
            $data_db_user['userPhone'] = $_POST['phone'];
            $data_db_user['userEmail'] = $_POST['email'];
            $data_db_user['userStreetAddress'] = $_POST['address'];
            $data_db_user['userLocationId'] = $_POST['city'];
            $data_db_user['userRole'] = "learner";
            $data_db_user['city_id'] = $_POST['city'];
            $data_db_learner['img_url'] = "/uploads/dp/" . $file;
            $this->db->trans_start();
            $this->_insert_learner($data_db_learner);
            $this->_insert_user($data_db_user);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
                $data['role'] = "learner";
                $data['module'] = "User";
                $data['view_file'] = "loginform";
                $data['first_time'] = true;
                $this->dashboard_view($data);
            }

        }
}


public function dashboard(){
    $data['view_file'] = "dashboard";
    if(isset($_POST['learner_id'])){
        $data['learner_details'] = $this->get_where($_POST['learner_id']);
    }else{
        $data['learner_details'] = $this->get_where($_GET['attr']);
    }
    
    $this->load->module("User");
    if(isset($_POST['learner_id'])){
        $data['user_details'] = $this->user->get_where($_POST['learner_id']);
    }else{
        $data['user_details'] = $this->user->get_where($_GET['attr']);
    }
    $this->load->module("Notifications");
    if(isset($_POST['learner_id'])){
        $data['notifications'] = $this->notifications->get_where_unread($_POST['learner_id']);
    }else{
        $data['notifications'] = $this->notifications->get_where_unread($_GET['attr']);   
    }
    
    $this->dashboard_view($data);
}

public function dashboard_view($data){
    $this->load->module("Main_template");
    $this->main_template->index($data);
}

public function recipes(){
    $this->load->module('Recipes');
    if(isset($_GET['rec_id'])){
        $data['view_file'] = "dashboard";
        $data['recipe_data'] = $this->recipes->get_where($_GET['rec_id']);
        $this->load->module('Main_template');
        $this->main_template->index($data);
    }else{
        $data['view_file'] = "dashboard";
        $data['recipe_data'] = $this->recipes->get("recipeId");
        $this->load->module('Main_template');
        $this->main_template->index($data);
    }
    
    
}

public function editRec(){
    
}




public function password_check($str)
{
   if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
     return TRUE;
   }
   return FALSE;
}


function _insert_learner($data) {
    $this->load->model('mdl_learner');
    $this->mdl_learner->_insert_learner($data);
}
function _insert_user($data) {
    $this->load->model('mdl_learner');
    $this->mdl_learner->_insert_user($data);
}

function get_where($id) {
    $this->load->model('mdl_learner');
    $query = $this->mdl_learner->get_where($id);
    return $query;
}


}