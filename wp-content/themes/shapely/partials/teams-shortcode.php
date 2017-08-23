<?php

function teams_shortcode($args, $content) {
  $title= $args['title'];
  ob_start();
  ?>
  <div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix teams_style_fix_4_7">
    <div class="vc_column-inner no-padding center-fix-item p_relative">
      <h4 class="teams-title"><?php echo $title;?></h4>
      <div class="btn-see">
        <a href="/?page_id=1410">SEE MORE</a>
      </div>
    </div>
  </div>
  <div id="teams-post-content">
    <?php
      $args = array( 'post_type' => 'teams', 'posts_per_page' => 9, 'orderby' => 'date', 'order' => 'ASC' );
      $loop = new WP_Query( $args );
    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
      <!-- <?php $terms  = get_the_terms( get_the_ID(), 'teams_cat', '', '' );  ?> -->
      <div class="col-lg-5ths col-xs-6 no-padding color-white project-item project-item--people" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
        <div class="teams-img 4">
          <a href="javascript:void(0);"><?php the_post_thumbnail('people-vertical');?></a>
        </div>
        <div class="project-info">
  <!--        <?php foreach($terms as $value ){?>
          <div class="btn-see btn_see_fix"><a><?php echo $value->name;?></a></div>
          <?php } ?> -->
          <div class="title-post-fix">
            <h5>
              <button type="button" class="btn btn-info btn-lg"><?php the_title();?></button>
              <p>
                <?php
                  // Will also be used later
                  $status = get_field('status');
                  echo $status;
                ?>
              </p>
            </h5>
          </div>
        </div>
      </div>

      <?php get_template_part("partials/people", "modal") ?>
    <?php  endwhile;?>
    <?php wp_reset_query(); ?>
  </div>

<?php wp_reset_query(); ?>
<?php
  $out = ob_get_contents();
  ob_end_clean();
  return $out;
}