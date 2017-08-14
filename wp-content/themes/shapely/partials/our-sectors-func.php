<?php
function our_sectors_func($atts) {
  ob_start();

    $args = ( array(
        'post_type' => 'sectors',
    'posts_per_page' => 12,
    'orderby' => 'title',
    'order' => 'ASC'
    ) );

  $query = new WP_Query($args);?>
  <div class="slhome">
    <div id="myCarousel2" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2000">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
  <?php
  if ($query->have_posts()) {
    while ($query->have_posts()) {
    $query->the_post();?>

    <div style="min-height: 83.2298vh;" id="myCarousel<?php echo get_the_ID(); ?>" class="item item-fix2">
        <div class="img_slhome col-lg-20ths col-xs-12 no-padding glr-right color-white">
      <a href="<?php the_permalink(); ?>">
      <img style="min-height: 83.2298vh;" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'shapely-full'); ?>" />
      </a>

    </div>
    <div class="wpb_column vc_column_container col-lg-5ths item-center-fix2">
      <div class="vc_column-inner no-padding center-fix-item text-left">
        <!-- <h4><a href="/?page_id=789">OUR SECTORS</a></h4> -->
      </div>
    </div>
      </div>

    <?php
    }
  }?>
  <div class="btn-slider hsu-slider-styling slhomebt">
    <a class="leftbt" href="#myCarousel2" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="rightbt" href="#myCarousel2" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  </div>
  <div class="slhome_list slhome_list_sector1 slhome_list_sectors1 sectors1 col-lg-5ths">
    <h4><a href="/?page_id=789">OUR SECTORS</a></h4>
    <div class="dot-slider">
      <ol class="carousel-indicators">

      <?php

        $args2 = ( array(
          'post_type' => 'sectors',
          'posts_per_page' => 12,
          'orderby' => 'title',
          'order' => 'ASC'
        ) );
        $i=0;
        $query2 = new WP_Query($args2);
        if ($query2->have_posts()) {
        while ($query2->have_posts()) {
        $query2->the_post();?>

          <li data-target="#myCarousel2" data-slide-to="<?php echo $i;?>"
            class="slhome_title slhome_title_sector slhp_<?php the_field('data_slider');?>
            <?php if($i==0){echo 'active';}?>">
            <?php
            $post_slug = get_post_field( 'post_name', get_post() );
            // var_dump($post_slug);

            $link = '/?page_id=789/#'.$post_slug ;
            ?>
            <a href="<?php echo $link; ?>"><?php the_title();?></a>
          </li>
        <?php $i++;
        }
        wp_reset_postdata();
      }?>
      </ol>
    </div>
  </div>

  </div>
  <style type="text/css">
    .text_yellow{
      color: #f1ac08;
    }
  </style>
  <script>
    jQuery(document).ready(function(){

      jQuery(".item-fix2:first").addClass("active");
    jQuery('.slhome_title').click(function(){
      jQuery(".slhome_title").toggleClass('text_yellow');
  });

});
  </script>



  </div>
  <?php
$myvariable = ob_get_clean();
  return $myvariable;
}

