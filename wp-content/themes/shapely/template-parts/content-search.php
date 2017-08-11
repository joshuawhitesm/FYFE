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
      <?php if (get_post_type() == 'teams') { ?>
        <h2 class="post-title">
          <a data-toggle="modal" data-target=".<?php echo get_the_ID();?>" href="javascript:void(0);">
            <?php echo wp_trim_words( get_the_title(), 9 ); ?>
          </a>
        </h2>

        <?php get_template_part("partials/people", "modal") ?>
      <?php } else if (get_post_type() == 'projects') { ?>
        <h2 class="post-title">
          <a data-toggle="modal" data-target=".<?php echo get_the_ID();?>" href="javascript:void(0);">
            <?php echo wp_trim_words( get_the_title(), 9 ); ?>
          </a>
        </h2>

        <?php get_template_part("partials/project", "modal") ?>
      <?php } else { ?>
        <h2 class="post-title">
          <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
        </h2>
      <?php } ?>

			<?php the_excerpt(); ?>
		</div>
	</article>
</div>