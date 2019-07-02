<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>We Are Chefu</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mix.css">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" type="text/css">
    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>'<link href='https://fonts.googleapis.com/css?family=Cabin+Sketch' rel='stylesheet' type='text/css'>
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.min.css" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/creative.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/chef.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-select.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/magnific-popup.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
</head>
<body>
    <span class ="pull-left" style="z-index:100; position: fixed; padding-left: 20px" class="codrops-header absolute">
        <a href = "<?php echo base_url(); ?>Main"><h1>Chefu</h1></a>
        <nav class="codrops-demos center">
            <a href="<?php echo base_url();?>Recipes/allRecipes"><b>Recipes</b></a> |
            <?php 
            if(isset($_SESSION['user_id'])){
                if($_SESSION['user_role'] == 'chef'){?>
                    <a href="<?php echo base_url();?>Chef/Dashboard?attr=<?php echo $_SESSION['user_id'] ?>"><b>Dashboard</b></a> |
                <?php }else if($_SESSION['user_role'] == 'learner'){?>
                    <a href="<?php echo base_url();?>Learner/Dashboard?attr=<?php echo $_SESSION['user_id'] ?>"><b>Dashboard</b></a> |
                <?php }
            }
            ?>
            <a href="#"><b>Blog</b></a>
        </nav>
    </span>
        <?php
            if(!isset($view_file)){
                die("Please set view file");
            }
            if(!isset($module)){
                $module = $this->uri->segment(1);
            }
            if(($view_file != "") && ($module != "")){
            $path = $module."/".$view_file;
            //die("<h1>".$path."</h1>");
            $this->load->view($path);
            }

        ?>
    <footer class="navbar navbar-default navbar-fixed-bottom down-nav" style ="margin-top:25px;" >
        <div class="container" style="padding-top:15px;">
            <div class="col-md-6">
                A project of DostTech
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </footer>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->
<script src="<?php echo base_url();?>assets/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.fittext.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>assets/js/creative.js"></script>
<script src="<?php echo base_url();?>assets/js/material.js"></script>
</body>
</html>