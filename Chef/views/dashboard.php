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
<div class="container" style = "margin-top: 30px">
      <div class="row" style = "padding-bottom : 200px;">
          
          
          
          <?php 
          
            if(isset($_SESSION['user_id'])){ ?>
                <input type ="hidden"  value="<?php echo $_SESSION['user_id']?>" id="loggedInId" />
            <?php }
          ?>
          <?php 
          
            $this->load->library('session');
            if($this->session->userdata('username')){
                if($_SESSION['user_role'] == 'chef'){ ?>
                    <span>
                        <div id="exTab2" class="container">
                           <h3 class = "text-center">DASHBOARD</h3>
                           <hr>
                           <ul class="nav nav-tabs">
                              <li class="active">
                                 <a  href="#1" data-toggle="tab">Profile</a>
                              </li>
                            <?php
                                if($_SESSION['user_role'] == "chef"){ ?>
                                    <li><a href="#2" id ="getRec"  data-toggle="tab" chef-id="<?php echo $_SESSION['user_id']; ?>">Manage Recipes</a>
                                    </li>
                                    <li><a href="#3" id ="uploadRec" data-toggle="tab">Upload Recipe</a>
                                    </li>
                            <?php }
                              ?>
                              <li class = "pull-right"><a href ="<?php echo base_url(); ?>User/logout">Logout</a></li>
                           </ul>
                           <div class="tab-content ">
                              <div class="tab-pane active" id="1">
                                <?php foreach($user_details->result() as $row){ ?>
                                    <h3><?php echo $row->userName; ?></h3>
                                <?php } 

                                ?> 

                                 <div class="row">
                                    <!-- left column -->
                                    <?php foreach($chef_details->result() as $row){ ?>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                       <div class="text-center">
                                           <img src="<?php echo base_url().$row->img_url; ?>" class="avatar img-thumbnail" alt="avatar">
                                       </div>
                                    </div>
                                    <!-- edit form column -->
                                    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                                        <?php 
                                            foreach($notifications->result() as $rowNotifs){ 
                                                if($rowNotifs->activity_id != "n/a"){
                                                ?>        
                                                    <div class="alert alert-info alert-dismissable">
                                                        <a class="panel-close close" data-dismiss="alert">×</a> 
                                                        <i class="fa fa-coffee"></i>
                                                        <?php echo $rowNotifs->description; ?><a style="padding-left:20px" href ="<?php echo base_url(); ?>Schedules/accept?attr=<?php echo $_SESSION['user_id']; ?>&&requesteeId=<?php echo $rowNotifs->requestee_id; ?>&&activityId=<?php echo $rowNotifs->activity_id; ?>&&notificationId=<?php echo $rowNotifs->id;?>"> Accept</a><a style="padding-left:20px" href ="<?php echo base_url(); ?>Schedules/decline?attr=<?php echo $_SESSION['user_id']; ?>&&requesteeId=<?php echo $rowNotifs->requestee_id; ?>"> Decline</a><a style="padding-left:20px" href ="#"> View Profile</a>
                                                    </div>
                                        <?php 
                                                }else{?>
                                                    <div class="alert alert-info alert-dismissable">
                                                        <a class="panel-close close" data-dismiss="alert">×</a> 
                                                        <i class="fa fa-coffee"></i>
                                                        <?php echo $rowNotifs->description; ?>
                                                    </div>
                                               <?php }
                                            }
                                        ?>
                                       <h3>Personal info</h3>
                                       <form class="form-horizontal" role="form">
                                              <div class="form-group">
                                                    <label class="col-lg-3 control-label">First name:</label>
                                                    <div class="col-lg-8">
                                                        <input class="form-control" value="<?php echo $row->chefFirstName; ?>" type="text">
                                                    </div>
                                                 </div>
                                                 <div class="form-group">
                                                    <label class="col-lg-3 control-label">Last name:</label>
                                                    <div class="col-lg-8">
                                                       <input class="form-control" value="<?php echo $row->chefLastName; ?>" type="text">
                                                    </div>
                                                 </div>
                                           <?php }
                                           foreach($user_details->result() as $row){ 

                                           ?>
                                                 <div class="form-group">
                                                    <label class="col-lg-3 control-label">Phone:</label>
                                                    <div class="col-lg-8">
                                                       <input class="form-control" value="<?php echo $row->userPhone; ?>" type="text">
                                                    </div>
                                                 </div>
                                                 <div class="form-group">
                                                    <label class="col-lg-3 control-label">Email:</label>
                                                    <div class="col-lg-8">
                                                       <input class="form-control" value="<?php echo $row->userEmail; ?>" type="text">
                                                    </div>
                                                 </div>
                                                 <div class="form-group">
                                                    <label class="col-lg-3 control-label">Address:</label>
                                                    <div class="col-lg-8">
                                                       <input class="form-control" value="<?php echo $row->userStreetAddress; ?>" type="text">
                                                    </div>
                                                 </div>

                                        <div class="form-group">
                                             <label class="col-md-3 control-label"></label>
                                             <div class="col-md-8">
                                                <input class="btn btn-primary" value="Edit" type="button">
                                                <span></span>
                                                <input class="btn btn-default" value="Cancel" type="reset">
                                             </div>
                                        </div>
                                       </form>
                                    </div>
                                 </div>
                                <?php } ?>
                              </div>
                              <div class="tab-pane" id="2">

                              </div>
                              <div class="tab-pane" id="3">

                              </div>
                           </div>
                        </div>
                     </span>
                <?php }else{ ?>
                    <span>
                <!--            <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>-->
                            <div id="exTab2" class="container">
                               <h3 class = "text-center">Chef Profile</h3>
                               <hr>
                               <ul class="nav nav-tabs">
                                  <li class="active">
                                     <a  href="#1" data-toggle="tab">Profile</a>
                                  </li>
                                  <?php foreach($chef_details->result() as $row){ ?>
                                  <li><a href="#2" id ="getRec" chef-id ="<?php echo $row->userId;  ?>" data-toggle="tab">View Recipes</a>
                                  </li>
                                  <?php } ?>
                <!--                  <li class = "pull-right" style ="cursor : pointer" >
                                  <div id ="SkypeButton_Call_danish.michael1_1" class="alert alert-info">
                                    <i class="fa fa-skype fa-2x"></i>
                                    Skype Chef
                                    <script type="text/javascript">
                                    Skype.ui({
                                    "name": "call",
                                    "element": "SkypeButton_Call_danish.michael1_1",
                                    "participants": ["zesh.cornelius"]
                                    });
                                    </script>

                                  </div></li>-->
                               </ul>
                               <div class="tab-content ">
                                  <div class="tab-pane active" id="1">
                                    <?php foreach($chef_details->result() as $row){ ?>
                                        <h3><?php echo $row->chefFirstName . " " . $row->chefLastName ; ?></h3>
                                    <?php } 

                                    ?> 
                                     <div class="row">
                                        <!-- left column -->
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                           <div class="text-center">
                                               <img src="<?php echo base_url().$row->img_url; ?>" class="avatar img-thumbnail" alt="avatar">
                                           </div>
                                        </div>
                                        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                                           <h3>Chef info</h3>
                                              <?php foreach($chef_details->result() as $row){ ?>
                                                  <div class="form-group">
                                                        <label class="col-lg-3 control-label">First name:</label>
                                                        <div class="col-lg-8">
                                                            <p><?php echo $row->chefFirstName; ?></p>
                                                        </div>
                                                     </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-3 control-label">Last name:</label>
                                                        <div class="col-lg-8">
                                                           <p><?php echo $row->chefLastName; ?></p>
                                                        </div>
                                                     </div>
                                               <?php }
                                               foreach($user_details->result() as $row){ 

                                               ?>
                                                <input type ="hidden" id ="chef_id" value="<?php echo $row->userId;  ?>" />
                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Phone:</label>
                                                        <div class="col-lg-8">
                                                           <p><?php echo $row->userPhone; ?></p>
                                                        </div>
                                                     </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-3 control-label">Email:</label>
                                                        <div class="col-lg-8">
                                                           <p><?php echo $row->userEmail; ?></p>
                                                        </div>
                                                     </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-3 control-label">Address:</label>
                                                        <div class="col-lg-8">
                                                           <p><?php echo $row->userStreetAddress; ?></p>
                                                        </div>
                                                     </div>
                                               <?php } ?>
                                            <h3>Chef Rating : 5</h3>
                                            <?php if(isset($_SESSION['user_role'])){
                                                if($_SESSION['user_role'] != 'chef'){ ?>
                                                <div class = "col-lg-12">
                                                    <span id ="hire" class = "btn btn-default" style = "width : 100%">Hire This Chef</span>
                                                </div>    
                                            <?php } 
                                                }else{ ?>
                                                <div class = "col-lg-12">
                                                    <span id ="hire" class = "btn btn-default" style = "width : 100%">Hire This Chef</span>
                                                </div>    
                                            <?php } ?>

                                        </div>
                                     </div>
                                  </div>
                                   <div class="tab-pane" id="2">

                                   </div>
                         </div>
                        </div>
                    </span>
                <?php }
                ?>
          <?php }else{
            $this->load->library('session');
            if(!($this->session->userdata('username'))){ ?>
            <span>
<!--            <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>-->
            <div id="exTab2" class="container">
               <h3 class = "text-center">Chef Profile</h3>
               <hr>
               <ul class="nav nav-tabs">
                  <li class="active">
                     <a  href="#1" data-toggle="tab">Profile</a>
                  </li>
                  <?php foreach($chef_details->result() as $row){ ?>
                  <li><a href="#2" id ="getRec" chef-id ="<?php echo $row->userId;  ?>" data-toggle="tab">View Recipes</a>
                  </li>
                  <?php } ?>
<!--                  <li class = "pull-right" style ="cursor : pointer" >
                  <div id ="SkypeButton_Call_danish.michael1_1" class="alert alert-info">
                    <i class="fa fa-skype fa-2x"></i>
                    Skype Chef
                    <script type="text/javascript">
                    Skype.ui({
                    "name": "call",
                    "element": "SkypeButton_Call_danish.michael1_1",
                    "participants": ["zesh.cornelius"]
                    });
                    </script>

                  </div></li>-->
               </ul>
               <div class="tab-content ">
                  <div class="tab-pane active" id="1">
                    <?php foreach($chef_details->result() as $row){ ?>
                        <h3><?php echo $row->chefFirstName . " " . $row->chefLastName ; ?></h3>
                    <?php } 
                    
                    ?> 
                     <div class="row">
                        <!-- left column -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="text-center">
                               <img src="<?php echo base_url().$row->img_url; ?>" class="avatar img-thumbnail" alt="avatar">
                           </div>
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                           <h3>Chef info</h3>
                              <?php foreach($chef_details->result() as $row){ ?>
                                  <div class="form-group">
                                        <label class="col-lg-3 control-label">First name:</label>
                                        <div class="col-lg-8">
                                            <p><?php echo $row->chefFirstName; ?></p>
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-lg-3 control-label">Last name:</label>
                                        <div class="col-lg-8">
                                           <p><?php echo $row->chefLastName; ?></p>
                                        </div>
                                     </div>
                               <?php }
                               foreach($user_details->result() as $row){ 
                                   
                               ?>
                                <input type ="hidden" id ="chef_id" value="<?php echo $row->userId;  ?>" />
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Phone:</label>
                                        <div class="col-lg-8">
                                           <p><?php echo $row->userPhone; ?></p>
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-lg-3 control-label">Email:</label>
                                        <div class="col-lg-8">
                                           <p><?php echo $row->userEmail; ?></p>
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-lg-3 control-label">Address:</label>
                                        <div class="col-lg-8">
                                           <p><?php echo $row->userStreetAddress; ?></p>
                                        </div>
                                     </div>
                               <?php } ?>
                            <h3>Chef Rating : 5</h3>
                            <?php if(isset($_SESSION['user_role'])){
                                if($_SESSION['user_role'] != 'chef'){ ?>
                                <div class = "col-lg-12">
                                    <span id ="hire" class = "btn btn-default" style = "width : 100%">Hire This Chef</span>
                                </div>    
                            <?php } 
                                }else{ ?>
                                <div class = "col-lg-12">
                                    <span id ="hire" class = "btn btn-default" style = "width : 100%">Hire This Chef</span>
                                </div>    
                            <?php } ?>
                           
                        </div>
                     </div>
                  </div>
                   <div class="tab-pane" id="2">
                     
                   </div>
         </div>
        </div>
       </span> 
           <?php }
          }
          ?>
      </div>
</div>
          
          
<!-- Modal -->
<div class="modal fade" id="myModal" data-keyboard="false" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title text-center">Schedule an Event</h4>
   </div>
   <form class="schedule" id = "schedule" name="schedule">
      <div class="modal-body">
         <div id = "formBody">
            <div style = "float:none!important" class = "col-lg-12">
               <label style = "color:black" class="label" for="name">Enter Date</label><br>
               <input type ="date" id = "event_date" type="text" name="event_date" class="form-control" placeholder = "mm/dd/yyyy" required>
               <span class="error hidden">This field is required</span>
            </div>
            <div class = "col-lg-6" >
               <label class="label" for="email" style = "color:black">Enter Start Time</label><br>
               <input type ="time" id = "event_start_time" name = "event_start_time" class = "form-control" placeholder ="MM:ss" required  />
            </div>
            <div class = "col-lg-6" class = "timepicker">
               <label class="label" for="message" style = "color:black">Enter End Time</label><br>
               <input type ="time" id = "event_end_time" name="event_end_time" class="form-control" placeholder ="MM:ss" required /><br>
            </div>
         </div>
      </div>
      <div id = "formFooter" class="modal-footer" >
         <div id = "btnDiv" style = "bottom:0">
            <span style = "margin-top:10%;" id = "submit" class="btn btn-default">Schedule</span>
            <button id = "button" style = "margin-top:10%;" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
      <div id = "successBody" class = "hidden">
         <h3>Your request has been sent for approval. Chef's profile link has been emailed you which you can use to come back here to see if the chef has approved and the calling feature is available prior. :)</h3>
         <div class="modal-footer">	
            <button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>
         </div>
      </div>
   </form>
</div>
<!-- Modal Content End -->   
</div>
</div>

<div class="modal fade" id="loginModal" data-keyboard="false" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title text-center">Seems you are not logged in..</h4>
   </div>
    <form id="loginForm" >
      <div class="modal-body">
         <div id = "formBody">
            <div style = "float:none!important" class = "col-lg-12">
               <label style = "color:black" class="label" for="name">Username</label><br>
               <input type="email" class="form-control" name ="username" value ="zeeshan.cornelius@gmail.com" placeholder="Email" required >
               <span class="error hidden">This field is required</span>
            </div>
            <div class = "col-lg-6" >
               <label class="label" for="email" style = "color:black">Password</label><br>
               <input type="password" class="form-control" name ="pword" value ="select" placeholder="Password" required>
            </div>
         </div>
      </div>
      <div id = "formFooter" class="modal-footer" >
         <div id = "btnDiv" style = "bottom:0">
            <span style = "margin-top:10%;" id ="submitLogin" class="btn btn-default">Login</span>
            <a href="<?php echo base_url(); ?>User/signUpForm" style = "margin-top:10%;" type="button" class="btn btn-default">Register</a>
         </div>
      </div>
    </form>
</div>
<!-- Modal Content End -->   
</div>
</div>
<script>
    $(document).ready(function(){
       $("#getRec").click(function(){
           $("#2").empty();
           $.ajax({
                type: "GET",
                url: '<?php echo base_url();?>Recipes/getChefRecipes/'+$(this).attr('chef-id'),
                datatype: "json",
                success: function(data){
                   console.log(data);
                   var decoded = JSON.parse(data);
                   for (i = 0; i < decoded.length; i++) {
                       if($("#loggedInId").val() == decoded[i].recipeChefId){
                           var href = "<?php echo base_url(); ?>Recipes/recipeSingleEdit?recId="+decoded[i].recipeId;
                       }else{
                           var href = "<?php echo base_url(); ?>Recipes/recipeSingle?recId="+decoded[i].recipeId;
                       }
                       var col = '<div style="margin-top:10px;" class="col-lg-3"> <div class="panel panel-warning"> <div class="panel-heading"> <h3 class="panel-title text-center">Recipe</h3></div><div class="panel-body"><img src="<?php echo base_url();?>'+decoded[i].recipeUrl+'" class="avatar img-thumbnail" alt="avatar"> <p class="text-center">'+decoded[i].recipeName+'</p><p class="text-center"> <a href="'+href+'"> <button class="btn btn-primary btn-sm">Details</button> </a> </p></div></div></div>';
                       $("#2").append(col);
                    }
                }
              });
       });
       $("#uploadRec").click(function(){
            $("#3").append('<div class="container-fluid"> <form method="post" action="<?php echo base_url(); ?>Recipes/addRecipe" enctype="multipart/form-data"> <div class="col-lg-12"> <div class="row"> <div class="row"> <div class="col-lg-8"> <label>Recipe Title</label> <input class="form-control" type="text" name="recipe_title" id="recipe_title"/> </div><div class="col-lg-2" style="margin-top:26px"> <select class="form-control" name="category_id"> <option>Select Category</option> <option value="1">Breakfast</option> <option value="2">Lunch</option> <option value="3">Beverages</option> <option value="4">Appetizers</option> <option value="5">Soups</option> <option value="6">Salads</option> <option value="7">Seafood</option> <option value="8">Vegetarian</option> <option value="9">Desserts</option> <option value="10">Breads</option> <option value="11">Holidays</option> <option value="12">Entertaining</option> <option value="13">Others</option> </select> </div><div class="col-lg-2" style="margin-top:26px"> <select class="form-control" name="region_category_id"> <option>Select Region Category</option> <option value="1">Pakistani</option> <option value="2">Indian</option> <option value="3">Turkish</option> <option value="4">French</option> <option value="5">Japanese</option> <option value="6">Spanish</option> <option value="7">Italian</option> <option value="8">Chinese</option> <option value="9">Mexican</option> <option value="10">Indonesian</option> <option value="11">Others</option> </select> </div></div><div class="recipe-image" id="recipe-image" > <input type="file" class="cropit-image-input" name="recipeImage"/> <div class="cropit-preview"></div><div class="image-size-label"> Resize image and <span style="color:red">please click on crop to assure upload</span> </div><input type="range" class="cropit-image-zoom-input"> <input type="hidden" name="recipe-image-data" id="recipe-image-data" class="hidden-image-data" required/> <span class="btn btn-primary" id="submit-croped" style="width:100%" onclick="checkImage(this)" >Crop</span> </div><div id="step_div" class="col-lg-12"></div><div class="container" id="ing_div"></div><div class="col-lg-8 col-lg-offset-2"> <span onclick="addIng()" class="btn btn-default" style="width : 100%; margin-top:20px;">Add Ingredient</span> </div><div class="container-fluid" id="guid_div"></div><div class="col-lg-12"> <span onclick="addGuid()" class="btn btn-default" style="width : 100%; margin-top:20px;">Add Guidline Step</span> </div></div></div><div class="col-lg-12"> <textarea name="description" class="form-control"></textarea> </div><div class="col-lg-12"> <input type="submit" class="btn btn-default" style="width:100%; margin-top : 20px;margin-bottom:20px" value="Submit"/> </div></form></div>');
            $('.recipe-image').cropit();
       });
    });
    
    function checkImage(el){
        var imageData = $(el).parent().cropit("export");
        console.log(imageData);
        $(el).prev().val(imageData);
        console.log($(el).prev().val());
        //$(el).closest(".hidden-image-data").val();
    }
    var counter1 = 0;    
    function addIng(){
        counter1++;
        $("#ing_div").append('<div class = "container-fluid"><input type = "hidden" name = "number_of_ings" value = "'+counter1+'"  ><div class = "col-lg-5"><label>Ingredient Name '+counter1+'</label><input class = "form-control" type = "text" name = "ing'+counter1+'" id = "ing'+counter1+'" /></div><div class = "col-lg-5"><label>Ingrediant QTY</label><input class = "form-control" type = "number" name = "ing_qty'+counter1+'" id = "ing_qty'+counter1+'" placehoder = "Please write units too" ></div></div>');
    }    
    var counter = 0;    
    function addGuid(){
        counter++;
        $("#guid_div").append('<div class="container-fluid"> <input type="hidden" name="number_of_steps" value="'+counter+'"> <div class="col-lg-12"> <label>Step '+counter+'</label> <input class="form-control" type="text" name="guidline'+counter+'" id="guidline'+counter+'"/> </div><div class="step-image'+counter+'" > <input type="file" class="cropit-image-input" name="recipeImage"/> <div class="cropit-preview"></div><div class="image-size-label"> Resize image <span style="color:red">please click on crop to assure upload</span> </div><input type="range" class="cropit-image-zoom-input"> <input type="hidden" name="step-image-data'+counter+'" id="recipe-image-data'+counter+'" class="hidden-image-data" required/> <span class="btn btn-primary" id="submit-croped" style="width:100%" onclick="checkImage(this)" >Crop</span> </div></div>');
        $('.step-image'+counter).cropit();
    }    
    $("#hire").click(function(){
//        alert(<?php echo isset($_SESSION['user-id'])?'true':'false'; ?>);
        if(!$("#loggedInId").length > 0){
            $("#loginModal").modal();
        }else{
            $("#myModal").modal();
        }
    });
    $("#submit").click(function(){
//        alert($('#event_date').val());
//        if(!(ValidateDate($('#event_date').val()))){
//            alert("Follow Date Format");
//            throw new Error("Follow Date Format");
//        }else{
//            var date = $('#event_date').val();
//        }
        var date = $('#event_date').val();
        var start = $('#event_start_time').val();
        var end = $('#event_end_time').val();
        var chef = $('#chef_id').val();
        var user = $("#loggedInId").val();
        var temp = {
            date: date,
            start : start,
            end : end,
            chefId : chef,
            userId : user
        }
        $.ajax({
            type: "POST",
            data : JSON.stringify(temp), // store json string,
            url: '<?php echo base_url();?>Schedules/availabilty',
            datatype: "json",
            success: function(data){
               alert(data); 
               if(data === "okay"){
                    $("#formBody").addClass("hidden");
                    $("#formFooter").addClass("hidden");
                    $("#successBody").removeClass("hidden");
               } else{
                   alert(data);
               }

            }
          });        
    });
    
    $("#submitLogin").click(function(){
        var serialized = $("#loginForm").serialize();
        $.ajax({
            type: "POST",
            data : serialized, // store json string,
            url: '<?php echo base_url();?>User/loginJson',
            datatype: "json",
            success: function(data){
                if(data == "true"){
                    location.reload();
                }else{
                    alert("Invalid Credentials");
                }
            }
          });
        
    });
    function ValidateDate(dtValue){
        var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
        return dtRegex.test(dtValue);
    }
</script>