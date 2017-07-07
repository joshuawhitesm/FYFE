<?php
/*
Template Name: Services
Template Post Type: post, page
*/
get_header(); ?>

<?php $layout_class = shapely_get_layout_class(); ?>
<div class="bg-title-fix"><?php the_title();?></div>
	<div class="row">
		<div id="primary" class="col-md-12 <?php echo esc_attr( $layout_class ); ?>">
			<?php
			while ( have_posts() ) : the_post();
				the_content();

			endwhile; // End of the loop.
			?>
		</div><!-- #primary -->
	</div>
<?php
get_footer();