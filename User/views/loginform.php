<section  class="" id="login_1">
    <div class="container text-center">
        <div class="row text-center">
            <div class="row ma-title text-color-dark">
                <div class="col-md-offset-3 col-md-4" style="padding-left:90px;">
                    Login
                </div>
            </div>
            <div class="col-md-offset-4 col-md-5"><img src="<?php echo base_url();?>assets/img/pan.png" class="img-responsive"></div>
            <form method = "post" action ="<?php echo base_url();?>User/submit" >
                <div class="row">
                    <div class="form-group col-md-offset-3 col-md-5">
                        <input type="email" class="form-control" id="exampleInputEmail1" name ="username" placeholder="Email" required >
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-offset-3 col-md-5">
                        <input type="password" class="form-control" id="exampleInputPassword1" name ="pword" placeholder="Password" required>
                    </div>
                </div>
                <div class="col-md-offset-3 col-md-4" style="padding-left:80px;">
                    <button class="button orange" type="submit" style="color:#fff;"> Login</button>
                </div>
            </form>
            <div class="col-md-offset-3 col-md-4" style="padding-left:80px;">
                <?php if($role == "chef"){ ?>
                    <a href = "<?php echo base_url(); ?>Chef/signUpForm"><button class="button blue " type="submit" style="color:#fff;"> Register</button></a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>