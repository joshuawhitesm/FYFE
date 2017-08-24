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
    <?php
    $terms  = get_the_terms( get_the_ID(), 'teams_cat', '', '' );
    $status = get_field('status') ;
    ?>

    <div class="col-lg-5ths col-xs-6 no-padding color-white project-item project-item--people" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
      <div class="teams-img 3">
        <a href="javascript:void(0);"><?php /* the_post_thumbnail('people-vertical');*/?><?php the_post_thumbnail();?></a>
      </div>
      <div class="project-info">
        <?php /*foreach($terms as $value ){*/?><!--
        <div class="btn-see btn_see_fix"><a><?php /*echo $value->name;*/?></a></div>
        --><?php /*} */?>
        <div class="title-post-fix">
          <h5>
            <button type="button" class="btn btn-info btn-lg">
              <?php the_title();?>
              <br />
              <?php echo $status;?>
            </button>
          </h5>
        </div>
      </div>
    </div>

    <?php get_template_part("partials/people", "modal"); ?>

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
   
      <div id="ajax_posts_f_project" class="row">
      <input type="hidden" class="ajax_posts_f_page_project" value="2">
      </div> 
   
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