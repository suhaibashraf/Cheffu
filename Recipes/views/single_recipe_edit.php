<script src="<?php echo base_url(); ?>assets/js/jquery.cropit.js"></script>
<style>
    .cropit-preview {
      background-color: #f8f8f8;
      background-size: cover;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-top: 7px;
      width: 250px;
      height: 250px;
    }

    .cropit-preview-image-container {
      cursor: move;
    }

    .image-size-label {
      margin-top: 10px;
    }

    input {
      display: block;
    }

    button[type="submit"] {
      margin-top: 10px;
    }

    #result {
      margin-top: 10px;
      width: 900px;
    }

    #result-data {
      display: block;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      word-wrap: break-word;
    }
    .hidden{
        display : none;
    }
</style>

<div class="container" style = "margin-top: 100px">
    <div class="container-fluid"> 
	<form method="post" action="<?php echo base_url(); ?>Recipes/editRecipe" enctype="multipart/form-data"> 
            <div class="col-lg-12"> 
                <div class="row">
                    <div class="row"> 
                        <div id ="recipe-data">
                            <?php foreach($recipe_data->result() as $row){ ?>
                            <div class="col-lg-8"> 
                                <label>Recipe Title</label> <input class="form-control" type="text" name="recipe_title" id="recipe_title" value="<?php echo $row->recipeName;?>" /> 
                                <input type="hidden" name="recipe_id" value="<?php echo $row->recipeId; ?>" />
                            </div>
                            <div class="col-lg-2" style="margin-top:26px"> 
                                <select class="form-control" name="category_id"> 
                                    <option>Select Category</option> 
                                    <option value="1" <?php if($row->recipeCategoryId == 1){?> selected="true" <?php  } ?> >Breakfast</option> 
                                    <option value="2" <?php if($row->recipeCategoryId == 2){?> selected="true" <?php  } ?> >Lunch</option> 
                                    <option value="3" <?php if($row->recipeCategoryId == 3){?> selected="true" <?php  } ?> >Beverages</option> 
                                    <option value="4" <?php if($row->recipeCategoryId == 4){?> selected="true" <?php  } ?> >Appetizers</option> 
                                    <option value="5" <?php if($row->recipeCategoryId == 5){?> selected="true" <?php  } ?> >Soups</option> 
                                    <option value="6" <?php if($row->recipeCategoryId == 6){?> selected="true" <?php  } ?> >Salads</option> 
                                    <option value="7" <?php if($row->recipeCategoryId == 7){?> selected="true" <?php  } ?> >Seafood</option> 
                                    <option value="8" <?php if($row->recipeCategoryId == 8){?> selected="true" <?php  } ?> >Vegetarian</option> 
                                    <option value="9" <?php if($row->recipeCategoryId == 9){?> selected="true" <?php  } ?> >Desserts</option> 
                                    <option value="10" <?php if($row->recipeCategoryId == 10){?> selected="true" <?php  } ?> >Breads</option> 
                                    <option value="11" <?php if($row->recipeCategoryId == 11){?> selected="true" <?php  } ?> >Holidays</option> 
                                    <option value="12" <?php if($row->recipeCategoryId == 12){?> selected="true" <?php  } ?> >Entertaining</option> 
                                    <option value="13" <?php if($row->recipeCategoryId == 13){?> selected="true" <?php  } ?> >Others</option> 
                                </select> 
                            </div>
                            <div class="col-lg-2" style="margin-top:26px"> 
                                <select class="form-control" name="region_category_id"> 
                                    <option>Select Region Category</option> 
                                    <option value="1" <?php if($row->recipeRegionCategoryId == 1){?> selected="true" <?php  } ?> >Pakistani</option> 
                                    <option value="2" <?php if($row->recipeRegionCategoryId == 2){?> selected="true" <?php  } ?> >Indian</option> 
                                    <option value="3" <?php if($row->recipeRegionCategoryId == 3){?> selected="true" <?php  } ?>>Turkish</option> 
                                    <option value="4" <?php if($row->recipeRegionCategoryId == 4){?> selected="true" <?php  } ?> >French</option> 
                                    <option value="5" <?php if($row->recipeRegionCategoryId == 5){?> selected="true" <?php  } ?>>Japanese</option> 
                                    <option value="6" <?php if($row->recipeRegionCategoryId == 6){?> selected="true" <?php  } ?>>Spanish</option> 
                                    <option value="7" <?php if($row->recipeRegionCategoryId == 7){?> selected="true" <?php  } ?>>Italian</option> 
                                    <option value="8" <?php if($row->recipeRegionCategoryId == 8){?> selected="true" <?php  } ?>>Chinese</option> 
                                    <option value="9" <?php if($row->recipeRegionCategoryId == 9){?> selected="true" <?php  } ?>>Mexican</option> 
                                    <option value="10" <?php if($row->recipeRegionCategoryId == 10){?> selected="true" <?php  } ?>>Indonesian</option> 
                                    <option value="11" <?php if($row->recipeRegionCategoryId == 11){?> selected="true" <?php  } ?>>Others</option> 
                                </select> 
                            </div>
                            <?php }?>
                        </div>
                    <div class="recipe-image" id="recipe-image" > 
                        <input type="file" class="cropit-image-input" name="recipeImage"/> 
                        <div class="cropit-preview">
                            <img src="<?php echo base_url().$row->recipeUrl; ?>" />
                        </div>
                        <div class="image-size-label"> Resize image and <span style="color:red">please click on crop to assure upload</span> 
                        </div>
                        <input type="range" class="cropit-image-zoom-input"> 
                        <input type="hidden" name="recipe-image-data" id="recipe-image-data" class="hidden-image-data" required/> 
                        <span class="btn btn-primary" id="submit-croped" style="width:100%" onclick="checkImage(this)" >Crop</span> 
                    </div>
                    </div>
                    <div class="container" id="ing_div">
                        <h2>Ingredients</h2>
                        <?php $ingCounter = 0; 
                            foreach($ing_data->result() as $row){ 
                                $ingCounter++;
                            ?>
                            <div class="container-fluid">
                                <input type="hidden" name="number_of_ings" value="<?php echo $ingCounter; ?>">
                                <input type="hidden" name="number_of_new_ings" />
                                <input type="hidden" class="ing_id" name="ing_id<?php echo $ingCounter; ?>" value="<?php echo $row->id;?>" />
                                <div class="col-lg-5">
                                    <label>Ingredient Name <?php echo $ingCounter; ?></label>
                                    <input class="form-control" type="text" name="ing<?php echo $ingCounter; ?>" id="ing<?php echo $ingCounter; ?>" value="<?php echo $row->ingredientName; ?>" />
                                </div>
                                <div class="col-lg-5">
                                    <label>Ingredient QTY</label>
                                    <input class="form-control" type="text" name="ing_qty<?php echo $ingCounter; ?>" id="ing_qty<?php echo $ingCounter; ?>" placehoder="Please write units too"  value="<?php echo $row->ingredientQty; ?>" />
                                </div>
                                <div class="col-lg-2" style="padding-top:25px">
                                    <span onclick="removeIng(this)" ing-id="<?php echo $row->id; ?>" class="btn btn-danger">Remove Ingredient</span>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="col-lg-8 col-lg-offset-2"> 
                        <span onclick="addIng()" class="btn btn-default" style="width : 100%; margin-top:20px;">Add Ingredient</span> 
                    </div>
                    <div id="step_div" class="col-lg-12">
                        <?php $stepCounter = 0; foreach ($step_data->result() as $row){ 
                                $stepCounter++;
                            ?>
                            <div class="container-fluid">
                                <h2>Guidline</h2>
                                <input type="hidden" name="number_of_steps" value="<?php echo $stepCounter; ?>" />
                                <input type="hidden" name="number_of_new_steps" />
                                <input type="hidden" name="step_id<?php echo $stepCounter; ?>" value="<?php echo $row->guidelineId;?>" />
                                <div class="col-lg-10">
                                    <label>Step <?php echo $stepCounter; ?></label>
                                    <input class="form-control" type="text" name="guidline<?php echo $stepCounter; ?>" id="guidline<?php echo $stepCounter; ?>"  value="<?php echo $row->stepDesc; ?>" />
                                </div>
                                <div class="col-lg-2" style="padding-top:25px">
                                    <span onclick="removeStep(this)" step-id="<?php echo $row->guidelineId;?>" class="btn btn-danger">Remove Step</span>
                                </div>
                                
                                <div class="step-image<?php echo $stepCounter; ?>">
                                    <input type="file" class="cropit-image-input" name="recipeImage" />
                                    <div class="cropit-preview">
                                        <img src="<?php echo base_url().$row->stepImgUrl; ?>">
                                    </div>
                                    <input type="hidden" name="img_link<?php echo $stepCounter; ?>" value="<?php echo $row->stepImgUrl; ?>" />
                                    <div class="image-size-label"> Resize image <span style="color:red">please click on crop to assure upload</span> </div>
                                    <input type="range" class="cropit-image-zoom-input">
                                    <input type="hidden" name="step-image-data<?php echo $stepCounter; ?>" id="recipe-image-data<?php echo $stepCounter; ?>" class="hidden-image-data" required/> <span class="btn btn-primary" id="submit-croped" style="width:100%" onclick="checkImage(this)">Crop</span> 
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="container-fluid" id="guid_div"></div>
                    <div class="col-lg-12"> 
                        <span onclick="addGuid()" class="btn btn-default" style="width : 100%; margin-top:20px;">Add Guidline Step</span> 
                    </div>
                </div>
            </div>
            <?php foreach($recipe_data->result() as $row){ ?>
            <div class="col-lg-12"> 
                <textarea name="description" class="form-control"><?php echo $row->recipeDescription; ?></textarea> 
            </div>
            <?php } ?>
            <div class="col-lg-12"> 
                <input type="submit" class="btn btn-default" style="width:100%; margin-top : 20px;margin-bottom:100px" value="Edit"/> 
            </div>
	</form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.recipe-image').cropit();
        for (i = 1; i <= '<?php echo $stepCounter; ?>'; i++) { 
            $('.step-image'+i).cropit();
        }
    });
    
    var counter1 = '<?php echo $ingCounter; ?>';    
    function addIng(){
        counter1++;
        $("#ing_div").append('<div class = "container-fluid"><input type = "hidden" name = "number_of_new_ings" value = "'+counter1+'"  ><div class = "col-lg-5"><label>Ingredient Name '+counter1+'</label><input class = "form-control" type = "text" name = "ing'+counter1+'" id = "ing'+counter1+'" /></div><div class = "col-lg-5"><label>Ingrediant QTY</label><input class = "form-control" type = "number" name = "ing_qty'+counter1+'" id = "ing_qty'+counter1+'" placehoder = "Please write units too" ></div></div>');
    }    
    var counter = '<?php echo $stepCounter; ?>';    
    function addGuid(){
        counter++;
        $("#guid_div").append('<div class="container-fluid"> <input type="hidden" name="number_of_new_steps" value="'+counter+'"> <div class="col-lg-12"> <label>Step '+counter+'</label> <input class="form-control" type="text" name="guidline'+counter+'" id="guidline'+counter+'"/> </div><div class="step-image'+counter+'" > <input type="file" class="cropit-image-input" name="recipeImage"/> <div class="cropit-preview"></div><div class="image-size-label"> Resize image <span style="color:red">please click on crop to assure upload</span> </div><input type="range" class="cropit-image-zoom-input"> <input type="hidden" name="step-image-data'+counter+'" id="recipe-image-data'+counter+'" class="hidden-image-data" required/> <span class="btn btn-primary" id="submit-croped" style="width:100%" onclick="checkImage(this)" >Crop</span> </div></div>');
        $('.step-image'+counter).cropit();
    }    
    
    function checkImage(el){
        var imageData = $(el).parent().cropit("export");
        console.log(imageData);
        $(el).prev().val(imageData);
        console.log($(el).prev().val());
        //$(el).closest(".hidden-image-data").val();
    }
    
    function removeIng(el){
        $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>Ingredients/deleteIng/'+$(el).attr('ing-id'),
            datatype: "json",
            success: function(data){
                location.reload();
            }
          });
    }
    function removeStep(el){
        $.ajax({
            type: "GET",
            url: '<?php echo base_url();?>Steps/deleteStep/'+$(el).attr('step-id'),
            datatype: "json",
            success: function(data){
                location.reload();
            }
          });
    }
</script>