<div class="xx project infinite-item col-xs-6 no-padding color-white project-item modal-<?php echo get_the_ID();?>" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">

    <div class="project-img project-img--square 11">
        <?php if ( has_post_thumbnail($post->ID) ) {
        	 the_post_thumbnail('people-thumb');
       }
        else {
    			echo '<img src="http://fyfe.com.au/wp-content/uploads/2017/08/dummy-thumbnail.jpg" />';
				}
				?>

    </div>


    <div class="project-info">


    <div class="title-post-fix">
        <h5><button type="button" class="btn btn-info btn-lg"><?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?></button></h5>
      </div>
    </div>

</div>


