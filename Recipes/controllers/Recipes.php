<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Recipes extends MX_Controller
{

function __construct() {
parent::__construct();
}
function index(){
    
}

function allRecipes(){
    $this->load->model('mdl_recipe');
    $data['cats'] = $this->mdl_recipe->getCats("recipeCatId");
    $data['regionCats'] = $this->mdl_recipe->getRegionCats("id");
    $data['recipes'] = $this->getAll("recipeId");
    $data['view_file'] = 'recipes_view';
    $this->load->module("Main_template");
    $this->main_template->index($data);
}

function addRecipe(){
        $this->db->trans_start();
        $data_rec['recipeName'] = $_POST['recipe_title'];
        $data_rec['recipeCategoryId'] = $_POST['category_id'];
        $data_rec['recipeRegionCategoryId'] = $_POST['region_category_id'];
        $data_rec['recipeDescription'] = $_POST['description'];
        $data_rec['recipeCategoryId'] = $_POST['category_id'];
        $data_rec['recipeRegionCategoryId'] = $_POST['region_category_id'];
        $data_rec['recipeChefId'] = $_SESSION['user_id'];
        
//        $data_rec['chefId'] = $this->session->userdata('userId');
        
        $recipeId = $data_ing['recipeId'] =  $this->get_max()+1;
        if(empty($recipeId)){
            $recipeId = 1;
        }
        if(!empty($_POST['recipe-image-data'])) {
            $encoded = $_POST['recipe-image-data'];
            //explode at ',' - the last part should be the encoded image now
            $exp = explode(',', $encoded);
            //decode the image and finally save it
            $dataImage = base64_decode($exp[1]);
            $file = date('mdYhis', time()).$recipeId.$this->session->userdata('user_id').".png";
            //make sure you are the owner and have the rights to write content
            file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/chefuFinal/uploads/recipes/" . $file, $dataImage);
        }           
        $data_rec['recipeUrl'] = "/uploads/recipes/" . $file;
        $this->_insert($data_rec);
        if(isset($_POST['number_of_ings'])){    
            if(!($data_ing['recipeId'])){
                $recipeId = $data_ing['recipeId'] = 1;    
            }
            $this->load->module('Ingredients');
            for ($x = 1; $x <= $_POST['number_of_ings']; $x++) {
                $data_ing['ingredientName'] = $_POST['ing'.$x];
                $data_ing['ingredientQty'] = $_POST['ing_qty'.$x];
                $this->ingredients->_insert($data_ing);
            }
        }
        $this->load->module('Steps');
        var_dump($_POST['number_of_steps']) . "<br>";
        if(isset($_POST['number_of_steps'])){
            for ($x = 1; $x <= $_POST['number_of_steps']; $x++) {
                echo $x . '<br>';
                if(!empty($_POST['step-image-data'.$x])) {
                    $encoded1 = $_POST['step-image-data'.$x];
                    //explode at ',' - the last part should be the encoded image now
                    $exp1 = explode(',', $encoded1);
                    //decode the image and finally save it
                    $dataImg = base64_decode($exp1[1]);
//                    echo '<pre>'.$dataImage.'</pre>';
                    $file1 = $recipeId.$x.".png";
                    //make sure you are the owner and have the rights to write content
                    file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/chefuFinal/uploads/recipes/recipeSteps/".$file1, $dataImg);
                }
                $data_step['stepImgUrl'] = "/uploads/recipes/recipeSteps/".$file1;
                $data_step['stepDesc'] = $_POST['guidline'.$x];
                $data_step['stepNumber'] = $x;
                $data_step['recipeId'] = $recipeId;
                $this->steps->_insert($data_step);                        
            }                 
                
        }   
        $data_rating['votes'] = 1;
        $data_rating['rating'] = 1;
        $data_rating['recipeId'] = $recipeId;
        $this->_insert_rating($data_rating);
        echo $data_chefRecipe['chefId'] = $this->session->userdata('user_id');
        $data_chefRecipe['recipeId'] = $recipeId;
        $this->_insert_chefRecipe($data_chefRecipe);
            
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            die("internal error");
        }
        else{
                $this->db->trans_commit();
                header('Location: http://localhost/chefuFinal/Chef/Dashboard?attr='.$_SESSION['user_id']);
        }
}


function _insert_rating($data){
    $this->load->model('mdl_recipe');
    $this->mdl_recipe->_insert_rating($data);
}

function _insert_chefRecipe($data){
    $this->load->model('mdl_recipe');
    $this->mdl_recipe->_insert_chefRecipe($data);
}

function get_max() {
    $this->load->model('mdl_recipe');
    $max_id = $this->mdl_recipe->get_max();
    return $max_id;
}


function _insert($data) {
    $this->load->model('mdl_recipe');
    $this->mdl_recipe->_insert($data);
}

function getAll($order_by){
    $this->load->model('mdl_recipe');
    $data_query['recipe_data'] = $this->mdl_recipe->get($order_by);
    return $data_query['recipe_data'];
}


function rateRecipe(){

    $query = $this->get_recipeRating($_POST['recipeId']);
    if($query->num_rows() == 0){
        $data['votes'] = 1;
        $data['rating'] = $_POST['star'];
        $data['recipeId'] = $_POST['recipeId'];
        $this->insertRecipeRating($data);
        echo "data added success";
    }else{
        foreach($query->result() as $row){
            $data['votes']  =  $row->votes+1;
            $data['rating'] = $row->rating+$_POST['star'];
            $this->update_recipeRating($data);  
            echo $data['rating']/$data['votes'];
        }
    }
    
}
function getChefRecipes($chefId) {
    $this->load->model('mdl_recipe');
    $data_query['recipe_data'] = $this->mdl_recipe->get_where_chef($chefId);
    $this->load->module('Steps');
    $this->load->module('Ingredients');
    foreach ($data_query['recipe_data']->result() as $row) {
        $data_query['step_data'.$row->recipeId] = $this->steps->get_where($row->recipeId);
        $data_query['ing_data'.$row->recipeId] = $this->ingredients->get_where($row->recipeId);
    }
    
    
    echo json_encode($data_query['recipe_data']->result());
}
function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_recipe');
    $query = $this->mdl_dost->get_with_limit($limit, $offset, $order_by);
    return $query;
}
function recipeSingle(){
    $this->load->model('mdl_recipe');
    $data['recipe_data'] = $this->mdl_recipe->get_where($_GET['recId']);
    $this->load->module('Steps');
    $this->load->module('Ingredients');
    foreach ($data['recipe_data']->result() as $row) {
        $data['step_data'] = $this->steps->get_where($row->recipeId);
        $data['ing_data'] = $this->ingredients->get_where($row->recipeId);
        $data['chef_data'] = $this->get_where_recipe($row->recipeId);
        
        $query = $this->get_recipeRating($row->recipeId);
        foreach ($query->result() as $row){
            $data['rating'] = $row->rating/$row->votes;
        }
    }
    $data['view_file'] = 'single_recipe';
    $this->load->module('Main_template');
    $this->main_template->index($data);
}

function recipeSingleEdit(){
    $this->load->model('mdl_recipe');
    $data['recipe_data'] = $this->mdl_recipe->get_where($_GET['recId']);
    $this->load->module('Steps');
    $this->load->module('Ingredients');
    foreach ($data['recipe_data']->result() as $row) {
        $data['step_data'] = $this->steps->get_where($row->recipeId);
        $data['ing_data'] = $this->ingredients->get_where($row->recipeId);
        $data['chef_data'] = $this->get_where_recipe($row->recipeId);
        
        $query = $this->get_recipeRating($row->recipeId);
        foreach ($query->result() as $row){
            $data['rating'] = $row->rating/$row->votes;
        }
    }
    $data['view_file'] = 'single_recipe_edit';
    $this->load->module('Main_template');
    $this->main_template->index($data);
}

function editRecipe(){
    $this->db->trans_start();
        $data_rec['recipeName'] = $_POST['recipe_title'];
        $data_rec['recipeCategoryId'] = $_POST['category_id'];
        $data_rec['recipeRegionCategoryId'] = $_POST['region_category_id'];
        $data_rec['recipeDescription'] = $_POST['description'];
        $data_rec['recipeCategoryId'] = $_POST['category_id'];
        $data_rec['recipeRegionCategoryId'] = $_POST['region_category_id'];
        $data_rec['recipeChefId'] = $_SESSION['user_id'];
        
        $recipeId = $data_ing['recipeId'] =  $_POST['recipe_id'];
        
        if(!empty($_POST['recipe-image-data'])) {
            $encoded = $_POST['recipe-image-data'];
            //explode at ',' - the last part should be the encoded image now
            $exp = explode(',', $encoded);
            //decode the image and finally save it
            $dataImage = base64_decode($exp[1]);
            $file = $recipeId.$this->session->userdata('user_id').".png";
            //make sure you are the owner and have the rights to write content
            file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/chefuFinal/uploads/recipes/" . $file, $dataImage);
            $data_rec['recipeUrl'] = "/uploads/recipes/" . $file;
        }           
        $this->_updateRecipe($recipeId ,$data_rec);
        if(isset($_POST['number_of_ings'])){
            $this->load->module('Ingredients');
            for ($x = 1; $x <= $_POST['number_of_ings']; $x++) {
                $data_ing['ingredientName'] = $_POST['ing'.$x];
                $data_ing['ingredientQty'] = $_POST['ing_qty'.$x];
                $this->ingredients->_updateIng($_POST['ing_id'.$x] ,$data_ing);
            }
        }
        if(isset($_POST['number_of_new_ings'])){
            $data_ing['ingredientName'] = '';
            $data_ing['ingredientQty'] = '';
            $this->load->module('Ingredients');
            for ($x = $_POST['number_of_ings']+1; $x <= $_POST['number_of_new_ings']; $x++) {
                $data_ing['ingredientName'] = $_POST['ing'.$x];
                $data_ing['ingredientQty'] = $_POST['ing_qty'.$x];
                $this->ingredients->_insert($data_ing);
            }
        }
        $this->load->module('Steps');
        if(isset($_POST['number_of_steps'])){
            for ($x = 1; $x <= $_POST['number_of_steps']; $x++) {
                $data_step['stepImgUrl'] = $_POST['img_link'.$x];
                if(!empty($_POST['step-image-data'.$x])) {
                    echo $x . '<br>';
                    $encoded1 = $_POST['step-image-data'.$x];
                    //explode at ',' - the last part should be the encoded image now
                    $exp1 = explode(',', $encoded1);
                    //decode the image and finally save it
                    $dataImg = base64_decode($exp1[1]);
//                    echo '<pre>'.$dataImage.'</pre>';
                    $file1 = $recipeId.$x.".png";
                    //make sure you are the owner and have the rights to write content
                    file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/chefuFinal/uploads/recipes/recipeSteps/".$file1, $dataImg);
                    $data_step['stepImgUrl'] = "/uploads/recipes/recipeSteps/".$file1;
                }
                echo $data_step['stepImgUrl'] . "<br>";
                $data_step['stepDesc'] = $_POST['guidline'.$x];
                $data_step['stepNumber'] = $x;
                $data_step['recipeId'] = $recipeId;
                $this->steps->_updateStep($_POST['step_id'.$x] ,$data_step);                        
            }   
        }
        if(isset($_POST['number_of_new_steps'])){
            for ($x = $_POST['number_of_steps']+1; $x <= $_POST['number_of_new_steps']; $x++) {
                if(!empty($_POST['step-image-data'.$x])) {
                    echo $x . '<br>';
                    $encoded1 = $_POST['step-image-data'.$x];
                    //explode at ',' - the last part should be the encoded image now
                    $exp1 = explode(',', $encoded1);
                    //decode the image and finally save it
                    $dataImg = base64_decode($exp1[1]);
//                    echo '<pre>'.$dataImage.'</pre>';
                    $file1 = $recipeId.$x.".png";
                    //make sure you are the owner and have the rights to write content
                    file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/chefuFinal/uploads/recipes/recipeSteps/".$file1, $dataImg);
                    $data_step['stepImgUrl'] = "/uploads/recipes/recipeSteps/".$file1;
                }
                $data_step['stepDesc'] = $_POST['guidline'.$x];
                $data_step['stepNumber'] = $x;
                $data_step['recipeId'] = $recipeId;
                $this->steps->_insert($data_step);
            }   
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            die("internal error");
        }
        else{
                $this->db->trans_commit();
                header('Location: http://localhost/chefuFinal/Chef/Dashboard?attr='.$_SESSION['user_id']);
        }
}

function get_recipeRating($id){
    $this->load->model('mdl_recipe');
    $query = $this->mdl_recipe->get_recipeRating($id);
    return $query;
}



function get_where_recipe($id){
    $this->load->model('mdl_recipe');
    return $this->mdl_recipe->get_where_recipe($id);
}

function get_where($id) {
    $this->load->model('mdl_recipe');
    $data_query['recipe_data'] = $this->mdl_recipe->get_where($id);
    $this->load->module('Steps');
    $this->load->module('Ingredients');
    foreach ($data_query['recipe_data']->result() as $row) {
        $data_query['step_data'.$row->recipeId] = $this->steps->get_where($row->recipeId);
        $data_query['ing_data'.$row->recipeId] = $this->ingredients->get_where($row->recipeId);
    }
    
    
    return $data_query;
}

function get_filtered(){
    $this->load->model('mdl_recipe');
    echo json_encode($this->mdl_recipe->get_filtered($_GET['id'])->result());
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_recipe');
    $query = $this->mdl_recipe->get_where_custom($col, $value);
    return $query;
}

function insertRecipeRating($data){
    $this->load->model('mdl_recipe');
    $this->mdl_recipe->insertRecipeRating($data);
}


function _updateRecipe($id, $data) {
    $this->load->model('mdl_recipe');
    $this->mdl_recipe->_updateRecipe($id, $data);
}

function update_recipeRating($data){
    $this->load->model('mdl_recipe');
    $this->mdl_recipe->updateRecipeRating($data);
}


}