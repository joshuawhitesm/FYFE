<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shapely
 */

get_header(); ?>
<?php $layout_class = shapely_get_layout_class(); ?>
	<div class="row">
		<?php
		if ( $layout_class == 'sidebar-left' ):
			get_sidebar();
		endif;
		?>
		<div id="primary" class="style_single_page col-md-12 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
		<div class="bg-title-fix"><?php the_title();?></div>
		<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content-sector' );

				// If comments are open or we have at least one comment, load up the comment template.

			endwhile; // End of the loop. ?>
		</div><!-- #primary -->
		<?php
		if ( $layout_class == 'sidebar-right' ):
			// get_sidebar();
		endif;
		?>
	</div>
<?php
get_footer();
