<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('post-content post-grid-small col-md-6'); ?>  >
		<header class="entry-header nolist ">
			<?php
			$post_types = get_post( get_the_ID());
			if($post_types->post_type == 'sectors'){
				$category = get_the_terms( get_the_ID(), 'sectors_cat' );
			}
			else{
				$category = get_the_category();
			}
			$image    = '<img class="wp-post-image" alt="" src="' . get_template_directory_uri() . '/assets/images/placeholder.jpg" />';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'shapely-grid' );
			}
			$allowed_tags = array(
				'img'      => array(
					'data-srcset' => true,
					'data-src'    => true,
					'srcset'      => true,
					'sizes'       => true,
					'src'         => true,
					'class'       => true,
					'alt'         => true,
					'width'       => true,
					'height'      => true
				),
				'noscript' => array()
			);
			?>
			<a class="style_image_archive" href="<?php echo esc_url( get_the_permalink() ); ?>">
				<?php echo wp_kses( $image, $allowed_tags ); ?>
			</a>
		</header><!-- .entry-header -->
		<div class="entry-content style_archive_fyfe">
			<h2 class="post-title">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
			</h2>
			<div class="col-md-12 no-padding">
			<div class="entry-meta col-md-8 no-padding">
				<?php
				shapely_posted_on_no_cat(); ?><!-- post-meta -->
			</div>
			<?php if ( isset( $category[0] ) ): ?>
				<span class="shapely-category1 col-md-4 text-right">
					<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>">
						<?php echo esc_html( $category[0]->name ); ?>
					</a>
				</span>
			<?php endif; ?>
			</div>
			<?php
			 echo substr(get_the_content(),0, 100).' ...';

			wp_link_pages( array(
				               'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shapely' ),
				               'after'  => '</div>',
			               ) );
			?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
<?php

