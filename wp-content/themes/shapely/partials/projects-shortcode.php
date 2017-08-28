<?php

function project_shortcode($args, $content) {
  $title= $args['title'];
  ob_start();
  ?>

  <div class="wpb_column vc_column_container text-center item-center-fix col-lg-5ths pull-right our-project-title before">
    <div class="vc_column-inner no-padding center-fix-item p_relative">
      <h4><a href="/?page_id=1052"><?php echo $title;?></a></h4>
      <div class="btn-see">
        <a href="/?page_id=1052">SEE MORE</a>
      </div>
    </div>
  </div>

  <div id="category-post-content" class="">
    <?php
    $args = array( 'post_type' => 'projects', 'posts_per_page' => 9 );
    $loop = new WP_Query( $args );$count=0;
    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); $count++; global $product;?>
      <?php $terms  = get_the_terms( get_the_ID(), 'project_cat', '', '' );  ?>

      <?php if($count==4){?>
        <div class="col-lg-5ths col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
        <div class="project-img project-img--square hh1" >
          <a href="javascript:void(0);"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'people-thumb');?>" alt="" ></a>
        </div>
        <div class="project-info">
          <div class="title-post-fix"><h5><button type="button" class="btn btn-info btn-lg"><?php the_title();?></button>
          </h5></div>
        </div>
      </div>

      <div class="wpb_column vc_column_container text-center item-center-fix col-lg-5ths pull-right our-project-title after project-img project-img--square hh2" style="padding: 0;margin: 0;display: block;">
        <div class="project-img project-img--square hh3" >
            <img src="http://fyfe.com.au/wp-content/uploads/2017/08/white-bg.jpg" alt="">
        </div>

        <div class="vc_column-inner no-padding project-d-title">
          <h4><a href="/?page_id=1052"><?php echo $title;?></a></h4>
          <div class="btn-see">
            <a href="/?page_id=1052">SEE MORE</a>
          </div>
        </div>
      </div>

      <?php } else{ ?>
      <div class="col-lg-5ths col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
        <div class="project-img project-img--square hh3" >
          <a href="javascript:void(0);"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'people-thumb');?>" alt="" ></a>
        </div>
        <div class="project-info">
          <div class="title-post-fix"><h5><button type="button" class="btn btn-info btn-lg"><?php the_title();?></button>
          </h5></div>
        </div>
      </div>
      <?php } ?>

    <?php  endwhile;?>

    <?php wp_reset_query(); ?>




    <?php
    $args = array(
      'posts_per_page'   => 10000,
      'post_type'        => 'projects',
      'post_status'      => 'publish',
      );
      $loop = new WP_Query( $args );

      if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) {
          $loop->the_post();
         get_template_part("partials/project", "modal");
        }
      }
            ?>


      <?php wp_reset_query(); ?>







  </div>



<?php
  $out = ob_get_contents();
  ob_end_clean();
  return $out;
}