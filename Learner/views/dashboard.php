<div class="container" style = "margin-top: 30px">
      <div class="row" style = "padding-bottom : 200px;">
          <?php 
            $this->load->library('session');
            if($this->session->userdata('username')){ ?>
         <span>
            <div id="exTab2" class="container">
               <h3 class = "text-center">DASHBOARD</h3>
               <hr>
               <ul class="nav nav-tabs">
                  <li class="active">
                     <a  href="#1" data-toggle="tab">Profile</a>
                  </li>
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
                        <?php 
                        foreach($learner_details->result() as $row){ ?>
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
                                            <input class="form-control" value="<?php echo $row->learnerFirstName; ?>" type="text">
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-lg-3 control-label">Last name:</label>
                                        <div class="col-lg-8">
                                           <input class="form-control" value="<?php echo $row->learnerLastName; ?>" type="text">
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
               </div>
            </div>
         </span>
          
          
          <?php } ?>
      </div>
</div>










