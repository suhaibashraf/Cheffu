<div style = "margin-top : 50px;">
    <span style = "background-image: url(<?php echo base_url(); ?>assets/img/banner2.png); margin-top:-20px;" class="bg-primary blogheader" id="">
        <div class="container">
            <div class="row">
		
                <div class="col-lg-12 text-center" style = "text-align: center;">
                </div>
            </div>
        </div>
    </span>

    <span class="">
        <div class="container">
          <div class="row">
                <div class = "col-lg-9">

                          <?php foreach($recipe_data->result() as $row){ ?>
                              <h2 class = "text-center"><?php echo $row->recipeName; ?></h2>
                              <hr>
                              <h4 class = "text-center"><?php echo $row->recipeDescription; ?></h4>
                              <h3 class = "text-center"><a href = "<?php echo base_url();?>Chef/dashboard?attr=<?php echo $row->recipeChefId; ?>">Chef </a></h3>
                          <?php } ?>

                              <h3>Ingredients</h3>
                              <ol class="">
                              <?php 

                                  foreach ($ing_data->result() as $row){ ?>
                                      <li><?php echo $row->ingredientName;?> , QTY : <?php echo $row->ingredientQty; ?> </li>
                              <?php  }
                              ?>
                              </ol>



                              <h3>Directions</h3>
                              <ol>
                              <?php 

                                  foreach ($step_data->result() as $row){ ?>
                                  <div class="row" style ="margin-top: 30px">
                                      <div class ="col-lg-8">
                                          <li><?php echo $row->stepDesc;?></li>
                                      </div>
                                      <div class="col-lg-4">
                                          <img src="<?php echo base_url() . $row->stepImgUrl;?>" />
                                      </div>
                                  </div>
                              <?php  }
                              ?>
                              </ol>			   
                 </div>
                <?php foreach($recipe_data->result() as $row){ ?>
                <div class = "col-lg-3 text-center"><img class = " img-thumbnail" src="<?php echo base_url() . $row->recipeUrl; ?>"  alt=""></div>
                <?php } ?>
                </div>
		</div>
                <?php 
                    foreach($chef_data->result() as $row){ ?>
                        <div class = "container" style = "margin-bottom:100px;">
                            <div class = "col-lg-12">
                                <div class = "col-lg-3">
                                    <h2>Recipe Rating : </h2>
                                </div>        
                                <div class = "col-lg-2 rating_stars_div">
                                    <div class='movie_choice'>
                                        <?php 
                                            $count = 0;
                                            
                                                $count++;
                                                ?>
                                        <input type = "hidden" id = "ratingStarsId" value = "<?php echo $rating; ?>" >
                                        <div id="r1" recipe-id ="<?php echo $row->recipeId;?>" class="rate_widget">
                                            <div class="star_1 ratings_stars <?php if($rating > $count){ echo 'ratings_over'; } ?>" star-val ="1" ></div>
                                            <?php $count++ ; ?>
                                            <div class="star_2 ratings_stars <?php if($rating > $count){ echo 'ratings_over'; } ?>" star-val = "2"></div>
                                            <?php $count++ ; ?>
                                            <div class="star_3 ratings_stars <?php if($rating > $count){ echo 'ratings_over'; } ?>" star-val = "3"></div>
                                            <?php $count++ ; ?>
                                            <div class="star_4 ratings_stars <?php if($rating > $count){ echo 'ratings_over'; } ?>" star-val = "4"></div>
                                            <?php $count++ ; ?>
                                            <div class="star_5 ratings_stars <?php if($rating > $count){ echo 'ratings_over'; } ?>" star-val = "5"></div>
                                        </div>
                                           
                                    </div>
                                </div>  
                            </div> 
                            
                            <div class = "col-lg-12">
                                <form method = "post" action = "<?php echo base_url()?>Chef/Dashboard">
                                    <input type ="hidden" name ="chef_id" value ="<?php echo $row->chefId ?>"  />
                                    <input type ="submit" class ="btn btn-default" style ="width: 100%" value = "View Chef's Profile">
                                </form>
                            </div>
                        </div>		
                <?php }
                ?>
    </span>

    <span id="contact" style = "margin-top:20px;">
        <div class="container">
            <div class="row" style = "padding-bottom:200px">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@abc.com</a></p>
                </div>
            </div>
        </div>
    </span>
</div>    

<script>
    
//    $(document).ready(function(){
//        $('.rate_widget').each(function(i) {
//            var widget = this;
//            var out_data = {
//                widget_id : $(widget).attr('id'),
//                fetch: 1
//            };
//            $.post(
//                '<?php echo base_url(); ?>Recipes/rating',
//                out_data,
//                function(INFO) {
//                    $(widget).data( 'fsr', INFO );
//                    set_votes(widget);
//                },
//                'json'
//            );
//        });
//        
//        function set_votes(widget) {
// 
//            var avg = $(widget).data('fsr').whole_avg;
//            var votes = $(widget).data('fsr').number_votes;
//            var exact = $(widget).data('fsr').dec_avg;
//
//            $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
//            $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote'); 
//            $(widget).find('.total_votes').text( votes + ' votes recorded (' + exact + ' rating)' );
//        }
//        
//    });
    
    $('.ratings_stars').hover(
        // Handles the mouseover
        function() {
            $(this).prevAll().andSelf().addClass('ratings_over');
            $(this).nextAll().removeClass('ratings_over');
            
        },
        // Handles the mouseout
        function() {
            $('.star_'+Math.floor($('#ratingStarsId').val())).prevAll().andSelf().addClass('ratings_over');
            $('.star_'+Math.floor($('#ratingStarsId').val())).nextAll().removeClass('ratings_over');
            
        }
    );
    
    
    $('.ratings_stars').bind('click', function() {
        var star = this;
        var widget = $(this).parent();

        var clicked_data = {
            star : $(star).attr('star-val'),
            recipeId : widget.attr('recipe-id')
        };
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/Recipes/rateRecipe',
            data: clicked_data,
            success: function(msg) {
                $('#ratingStarsId').val(Math.ceil(msg));
                $('.ratings_stars').removeClass('ratings_over');
//                alert(msg);
//                alert($('.star_'+Math.ceil(msg)).attr('star-val'));
                
                $('.star_'+Math.ceil(msg)).prevAll().andSelf().addClass('ratings_over');
                $('.star_'+Math.ceil(msg)).nextAll().removeClass('ratings_over');
            }
          });
    });
    
</script>