<?php
function our_people_shortcode($args, $content) {

  ob_start();
  ?>

  <div id="category-post-content" class="col-lg-20ths_fix col-xs-12 no-padding">
  <div class="m_st_20_bul_p">
  <div id="project_our_ajax">
  <?php
  if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
  } elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
  } else {
    $paged = 1;
  }
  $atts = shortcode_atts( array(
    'number_posts' => 1000,
    'post_type' => 'teams',
    ), $atts, 'feature' );
  $args = array(
  'posts_per_page'   => $atts['number_posts'],
  'orderby'          => 'date',
  'order'            => 'ASC',
  'post_type'        => $atts['post_type'],
  'post_status'      => 'publish',
  'paged'    => $paged,
  );
  $loop = new WP_Query( $args );
  ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;
    ?>
  <?php get_template_part("partials/people", "modal"); ?>

  <?php  endwhile;?>
    <div id="ajax_posts_f_project" class="row">
      <input type="hidden" class="ajax_posts_f_page_project" value="2">
    </div>
   <?php wp_reset_query(); ?>
  </div>

  </div>


  </div>

<?php wp_reset_query(); ?>
<?php
  $out = ob_get_contents();
  ob_end_clean();
  return $out;
}
?>