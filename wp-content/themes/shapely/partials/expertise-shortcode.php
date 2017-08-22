<?php

function expertise_shortcode($args, $content) {
  $title = $args['title'] ;
  $des = $args['des'] ;
  ob_start();
  $args = array( 'post_type' => 'expertise', 'posts_per_page' => 14, /*'orderby'=> 'title', */'order' => 'ASC' );
  $loop = new WP_Query( $args );?>
  <div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix height-fix-tn">
    <div class="vc_column-inner no-padding center-fix-item expertise_p_t_h4">
      <h4><a href="/?page_id=1101"><?php echo $title;?></a></h4>
      <p><?php echo $des;?></p>
    </div>
  </div>

  <div class="our-service-posts">
    <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;
    $animated_icons = get_field('animated_icons');
    // var_dump($animated_icons['url']);
    ?>
    <div class="col-lg-5ths col-md-3 col-sm-4 col-xs-6 no-padding text-center height-fix height-fix_19_7">
      <a href="<?php the_field('link'); ?>">
        <div class='img-hover-fix img-hover-fix_1'><?php the_post_thumbnail();?></div>
        <div class='img-hover-fix d_n img-hover-fix_2'>
          <?php if($animated_icons['url']!=''){?>
            <img src="<?php echo $animated_icons['url']; ?>">
          <?php }
          else {
            the_post_thumbnail();
          }?>
        </div>
        <div class="title-hover"><h3><?php the_title();?></h3></div>
      </a>
    </div>
    <?php  endwhile;?>
    <style>
      .height-fix.js-activated {
          background: #252525;
          cursor: pointer;
      }

      .height-fix.js-activated .title-hover h3 {
          opacity: 1;
      }

      .height-fix.js-activated {
          padding: 75px 0 35px 0;
      }

      .height-fix.js-activated .img-hover-fix img {
          width: auto;
          height: 110px;
      }

      .height-fix.js-activated .img-hover-fix_1 {
          display: none;
      }

      .height-fix.js-activated .img-hover-fix_2 {
          display: block !important;
      }
    </style>

    <script>
    currentAnimationIndex = 0
    $ = jQuery
    function animation_shifter() {
      console.log("shifting")
      $(".height-fix.js-activated").removeClass("js-activated")
      $($(".height-fix")[currentAnimationIndex]).addClass("js-activated")
      // $(".img-hover-fix_1").show()
      // $(".img-hover-fix_2").hide()
      // $($(".img-hover-fix_1")[currentAnimationIndex]).hide()
      // $($(".img-hover-fix_2")[currentAnimationIndex]).show()
      currentAnimationIndex = (currentAnimationIndex + 1) % 14

      setTimeout(animation_shifter, 5000)
    }
    animation_shifter()
    </script>
  </div>
<?php wp_reset_query(); ?>
<?php
  $out = ob_get_contents();
  ob_end_clean();
  return $out;
}