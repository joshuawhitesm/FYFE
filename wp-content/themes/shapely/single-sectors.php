<?php
/*
Template Name: Services
Template Post Type: post, page
*/
 get_header(); ?>

<?php $layout_class = shapely_get_layout_class(); ?>
<!--<div class="bg-title-fix"><?php //the_title();?></div>-->
<div class="container">
	<div class="row">
		<div id="primary" class="col-md-12 <?php echo esc_attr( $layout_class ); ?>">
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content-sector' );

			endwhile; // End of the loop.
			?>
		</div><!-- #primary -->
	</div>
	<?php
	$post_id = get_the_ID();
	$post = get_post($post_id); 
	$slug = $post->post_name;
	$slug2 = $post->post_name;
	?> 
	<?php
	$the_query = new WP_Query( array(
    'post_type' => 'projects',
    'tax_query' => array(
        array (
            'taxonomy' => 'project_sectors',
            'field' => 'slug',
            'terms' => $slug,
        )
    ),
) );
$count=0;
?>
<?php
while ( $the_query->have_posts() ) :
    $the_query->the_post(); $count ++;	
	if($count ==0){
	?>

<?php } elseif($count ==1){ ?>
<div class="shapely-related-posts">
<div class="row">
	<div class="col-lg-11 col-sm-10 col-xs-12 shapely-related-posts-title">
	<h3><span><?php  echo 'Related Projects';?></span></h3>
	</div>
</div><!--/.row-->
<div class="shapely-carousel-navigation hidden-xs">
<ul class="shapely-carousel-arrows clearfix">
<li><a href="#" class="shapely-owl-prev fa fa-angle-left"></a></li>
<li><a href="#" class="shapely-owl-next fa fa-angle-right"></a></li>
</ul>
</div>
<?php } else{ ?>
<?php }
endwhile;
?>
<div class="owlCarousel owl-carousel owl-theme owl-loaded owl-drag single-sector-related-project" data-slider-id="1673" id="owlCarousel-1673" data-slider-items="3" data-slider-speed="400" data-slider-auto-play="1" data-slider-navigation="false">
<?php
$arr_project = array();
while ( $the_query->have_posts() ) :
    $the_query->the_post();
	?>
	<?php
	$id = get_the_ID();
	$image_popup = get_field('image_popup');
	$popup_image = $image_popup['url'];
	$post_image = get_the_post_thumbnail($id);
	$arr_project[]= array('id' => $id, 'popup_image' => $popup_image, 'post_image' => $post_image);
	?>
   <div class="item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
		<a href="javascript:void(0);">
		    <?php the_post_thumbnail('shapely-grid' );?> 
		</a>
		<div class="shapely-related-post-title sector-related-post-title">
		<a href="javascript:void(0);"><?php echo wp_trim_words( get_the_title(), 5 ); ?></a>
		</div>
	</div><!--/.item-->
	
	<?php
endwhile;

/* Restore original Post Data 
 * NB: Because we are using new WP_Query we aren't stomping on the 
 * original $wp_query and it does not need to be reset.
*/
wp_reset_postdata();

	?>
	</div><!--/.owlCarousel-->

	
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
         get_template_part("partials/sector", "modal");
        }
      }
            ?>  
            
<?php 
	?>
			</div><!--/.mt-related-posts-->
			</div><!--/.mt-related-posts-->
	</div>
<?php
get_footer();