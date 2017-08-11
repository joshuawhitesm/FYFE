<?php
function our_projects_shortcode($args, $content) {
  ob_start();
?>

<div data-name="admin-ajax" data-url="<?php echo admin_url('admin-ajax.php')?>"></div>

<div id="category-post-content" class="col-lg-20ths_fix col-xs-12 no-padding">
  <div class="m_st_20_bul_p">
    <div class="col-md-12 p_relative  style_project_our_top">
      <div class="col-md-8 p_relative  style_project_our_top1">
        <div class="col-md-3 p_relative no-padding">
          <h6 class="style_project_our_top1_all">All</h6>
        </div>

        <div class="col-md-5 p_relative no-padding style_project_our_top1_name">
          <h5 class="name_sectors-title">Filter by Sectors</h5>
          <div class="name_sectors-item">
            <?php $terms = get_terms( array(
              'taxonomy' => 'project_sectors',
              'hide_empty' => false,
            ) );
            foreach($terms as $value) { ?>
              <div class="col-md-6 no-padding name_sectors"><h6 id="project_sectors_<?php echo $value->term_id;?>" class=""><?php echo $value->name;?></h6></div>
              <script type="text/javascript">
                jQuery(document).ready( function($) {
                  $("#project_sectors_<?php echo $value->term_id;?>").on("click", function() {
                    $(".name_sectors_hidden").val('<?php echo $value->term_id;?>');
                    $(".name_sectors h6").removeClass("current_cat");
                    $("#project_sectors_<?php echo $value->term_id;?>").addClass("current_cat");
                  });
                });
              </script>
            <?php } ?>
          </div>
        </div>

        <div class="col-md-4 p_relative no-padding style_project_our_top1_name style_project_our_top1_name_m">
          <h5 class="name-services-title">Filter by Services</h5>
          <div class="name_services-fix">
            <?php $terms = get_terms( array(
              'taxonomy' => 'project_services',
              'hide_empty' => false,
            ) );
            // var_dump($terms);
            foreach($terms as $value){?>
              <div class="col-md-6 no-padding name_services"><h6 id="project_services_<?php echo $value->term_id;?>" class=""><?php echo $value->name;?></h6></div>
              <script type="text/javascript">
                jQuery(document).ready( function($) {
                  $("#project_services_<?php echo $value->term_id;?>").on("click", function() {
                    $(".name_services_hidden").val('<?php echo $value->term_id;?>');
                    $(".name_services h6").removeClass("current_cat");
                    $("#project_services_<?php echo $value->term_id;?>").addClass("current_cat");
                  });
                });
              </script>
            <?php } ?>
          </div>
        </div>

        <input type="hidden" name="name_sectors_hidden" class="name_sectors_hidden" value="all">
        <input type="hidden" name="name_services_hidden" class="name_services_hidden" value="all">
      </div>
    </div>

    <div id="project_our_ajax" class="infinite-container">
      <?php
      if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
      } elseif ( get_query_var('page') ) {
        $paged = get_query_var('page');
      } else {
        $paged = 1;
      }
      $atts = shortcode_atts( array(
        'number_posts' => 30,
        'post_type' => 'projects',
        ), $atts, 'feature' );

      $args = array(
      'posts_per_page'   => $atts['number_posts'],
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => $atts['post_type'],
      'post_status'      => 'publish',
      'paged'    => $paged,
      );
      $loop = new WP_Query( $args );

      if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) {
          $loop->the_post();

          get_template_part("partials/project");
        }
      } else { ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php } ?>
    </div>

    <?php wp_reset_query(); ?>

    <div id="loadingDiv" class="row t_c loadingDiv hidden" >
      <img src="/wp-content/uploads/2017/07/giphy.gif" alt="loading">
    </div>

    <a class="hidden infinite-more-link" href="<?php echo add_query_arg('page', intval($paged) + 1, get_permalink()); ?>">SEE MORE</a>
  </div>
</div>

<?php
  wp_reset_query();
  $out = ob_get_contents();
  ob_end_clean();
  return $out;
}
?>