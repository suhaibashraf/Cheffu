<section  class="rock" id="learner_1" style = "padding-top:100px; padding-bottom:100px;" style ="display:none" >
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-12 text-center">
                    <h1 class = "text-color-dark">Recipes That Could Be Yours</h1>
                    
                    <select id ="filterCat" class = "form-control">
                        <option>Looking for something specific?</option>>
                        <?php 
                            foreach($cats->result() as $row){ ?>
                        <option value = "<?php echo $row->recipeCatId; ?>"><?php echo $row->recipeCatName; ?></option>
                        <?php    }
                        ?>
                    </select>
                    <div class="container">
                        <div id="portfolio" class="row no_padding title__block nothing no-margin">
                          <ul class="list-unstyled controls">
                            <li class="filter" data-filter="all">Show All</li>
                            <?php 
                                foreach ($regionCats->result() as $row){
                            ?>
                                <li class="filter" data-filter="<?php echo $row->id; ?>"><?php echo $row->regionCategoryTitle; ?></li>
                            <?php } ?>
                          </ul>
                          <ul id="Grid" class="gallery">
                              <?php 
                                foreach($recipes->result() as $row){ ?>
                                    <li class="mix <?php echo $row->recipeRegionCategoryId; ?> col-sm-3"> <a href="<?php echo base_url();?>Recipes/recipeSingle?recId=<?php echo $row->recipeId; ?>" ><img alt="" src="<?php echo base_url().$row->recipeUrl;?>" class="img-responsive"></a> <a class="link" href="<?php echo base_url();?>Recipe/recipeSingle?recId=<?php echo $row->recipeId; ?>" ><?php echo $row->recipeDescription;  ?></a> </li>
                              <?php }
                              ?>
                          </ul>
                        </div>
                        <div class="dc_clear"></div>
                        <br/>
                        <br/>
                        <br/>
                    </div>		 
                </div>
            </div>
        </div>
</section>

<script src="<?php echo base_url();?>assets/js/jquery.mixitup.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.magnific-popup.js"></script>

<script>
    $(document).ready(function(){
        $('#Grid').mixitup();
        $('#filterCat').change(function(){
            $.ajax({ 
                type: "GET",   
                url: "<?php echo base_url(); ?>Recipes/get_filtered?id="+$(this).val(),   
                async: false,
                success : function(text)
                {
                    $('#Grid').empty();
                    $('#Grid').mixitup('destroy');
                    var some = JSON.parse(text);
                    for (i = 0; i < some.length; i++) { 
                        $('#Grid').append('<li class="mix '+some[i].recipeRegionCategoryId+' col-sm-4"> <a href="<?php echo base_url();?>Recipes/recipeSingle?recId='+some[i].recipeId+'"><img alt="" src="<?php echo base_url();?>assets/img/fish.png" class="img-responsive"></a> <a class="link" href="<?php echo base_url();?>Recipe/recipeSingle?recId='+some[i].recipeId+'">'+some[i].recipeDescription+'</a> </li>');
                        $('#Grid').mixitup();
                    }
                }
            });
        });
    });
</script>