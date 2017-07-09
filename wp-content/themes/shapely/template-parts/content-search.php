<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */

?>

<div class="row">
	<article id="post-<?php the_ID(); ?>" <?php post_class('post-content post-grid-wide col-md-12'); ?>>
		<div class="entry-content">
			<h2 class="post-title">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
			</h2>

			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
</div>