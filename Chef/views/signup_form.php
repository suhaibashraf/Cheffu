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
</style>
<div class="container">
    <div class="row" style = "margin-top: 75px; padding-left: 100px; padding-right: 100px">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style = "padding-bottom : 200px;">
            <div id="contactus">
                <h1><?php echo $role; ?> Sign Up</h1>
                <hr>
                <form role="form" method="post" action="<?php echo base_url();?>Chef/form_validate" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" pattern="[a-zA-Z]+" title="Only English Alphabats are allowed" class="form-control" placeholder="Your First Name (Letters only)" name="firstname" value="<?php echo set_value('firstname'); ?>" required />
                        <?php echo form_error('firstname', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                        <input type="text" pattern="[a-zA-Z]+" title="Only English Alphabats are allowed" class="form-control" placeholder="Your Last Name (Letters only)" name="lastname" value="<?php echo set_value('lastname'); ?>" required />
                        <?php echo form_error('lastname', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Your Email" name="email" value="<?php echo set_value('email'); ?>" required />
                        <?php echo form_error('email', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" pattern="[0-9a-zA-Z]{8,}" class="form-control" placeholder="Select Password (Leagth = 8 with atlest one Upper and Lower case letter, one Special Character and one number)" name="password" value="<?php echo set_value('email'); ?>" required />
                        <?php echo form_error('password', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                    </div>


                    <div class="form-group">
                        <input type="text" pattern="^s[0-9]{11,13}" title="Invalid Number" class="form-control" placeholder="Your Phone" name="phone" value="<?php echo set_value('phone'); ?>" required />
                        <?php echo form_error('phone', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Street Address" name="address" value="<?php echo set_value('address'); ?>" required />
                        <?php echo form_error('address', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label> Country </label>
                        <select class="form-control" name="country" id ="country" required > 
                            <option>Country</option>
                            <?php 
                                foreach ($countries->result() as $row){ ?>
                                    <option value = "<?php echo $row->countryId; ?>"><?php echo $row->countryName;  ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('country', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                    </div>

                    <div class="form-group" id = "city-div">
                        <select class="selectpicker" name="city" id ="city-select" data-live-search="true" >
                        </select>
                        <?php echo form_error('city', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                    </div>
<!--                    <div class="form-group">
                        <input type="file" class="form-control" placeholder="Profile Picture" name="userfile" />
                        <?php if(isset($error)){ ?>
                                <p><?php echo $error; ?></p>
                          <?php } ?>
                    </div>-->
                    
<div class="image-editor" style="padding-right: 690px">
                        <input type="file" class="cropit-image-input" name ="imageDp">
                        <div class="cropit-preview"></div>
                        <div class="image-size-label">
                          Resize image
                        </div>
                        <input type="range" class="cropit-image-zoom-input">
                        <input type="hidden" name="image-data" id="image-data" class="hidden-image-data" required />
                        <span class="btn btn-primary" id="submit-croped" style="width:100%">Crop</span>
                    </div>
                    <div class="form-group text-center">
                        <button type="reset" class="btn btn-danger" style="margin-top: 10px">Clear Form</button>
                        <button type="submit" class="btn btn-success" >Register</button>
                    </div>
                </form>
            </div>
<!--            <span id ="fetch" class ="col-lg-12 btn-default" >Go Fetch</span> -->
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.js"></script>
<script>
$(document).ready(function(){
    $('.image-editor').cropit();
    
    $("#submit-croped").click(function(){
        var imageData = $('.image-editor').cropit('export');
        $('#image-data').val(imageData);
        console.log($("#image-data").val());
    });
    
    $("#country").change(function(){
    $("#city-select").empty();  
    $.ajax({ 
            type: "GET",   
            url: "<?php echo base_url(); ?>Generic/getCitiesJson/"+$(this).val(),
            success : function(text)
            {
                var some = JSON.parse(text);
                $("#city-select").append('<option>Select City</option>');
                for (i = 0; i < some.length; i++) {  
                    $("#city-select").append('<option value = "'+some[i].cityId+'">'+some[i].cityName+'</option>');
                }
                $('.selectpicker').selectpicker('refresh');
            }
        });
    });
});


</script>