<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */

$dropcaps    = get_theme_mod( 'first_letter_caps', true );
$enable_tags = get_theme_mod( 'tags_post_meta', true );
$post_author = get_theme_mod( 'post_author_area', true );
$left_side   = get_theme_mod( 'post_author_left_side', false );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-content post-grid-wide'); ?>>
	<header class="entry-header nolist">
		<?php
		$post_types = get_post( get_the_ID());
		if($post_types->post_type == 'sectors'){
			$category = get_the_terms( get_the_ID(), 'sectors_cat' );
		}
		else{
			$category = get_the_category();
		}
		
		// var_dump($category);
		if ( has_post_thumbnail() ) {
			$layout = shapely_get_layout_class();
			$size   = 'shapely-featured';

			if ( $layout == 'full-width' ) {
				$size = 'shapely-full';
			}
			$image = get_the_post_thumbnail( get_the_ID(), $size );

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

		
		<?php } ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		
		<?php if ( $post_author && $left_side ): ?>
			<div class="row ">
				<div class="col-md-3 col-xs-12 author-bio-left-side">
					<?php
					shapely_author_bio();
					?>
				</div>
				<div class="col-md-9 col-xs-12 shapely-content <?php echo $dropcaps ? 'dropcaps-content' : ''; ?>">
					<?php
					the_content();

					wp_link_pages( array(
						               'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shapely' ),
						               'after'  => '</div>',
					               ) );
					?>
				</div>
			</div>
		<?php else: ?>
			<div class="col-md-12 no-padding shapely-content1 img-100 <?php echo $dropcaps ? 'dropcaps-content11' : ''; ?>">
        
        <?php $image = get_field('page_banner');
					$size = 'full'; // (thumbnail, medium, large, full or custom size)

					if( $image ) {
            ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
           <?php
          }
       		else {
        		the_post_thumbnail();
           
        }
       		 ?>
		
				<?php
        
				/* the_post_thumbnail();*/

				?>
    
			</div>
			<div class="col-md-12 no-padding shapely-content1 pd--t-20 <?php echo $dropcaps ? 'dropcaps-content11' : ''; ?>">
			<h2><?php the_title();?></h2>
				<?php
				the_content();
				?>
			</div>
			<div class="col-md-6 no-padding shapely-content1 <?php echo $dropcaps ? 'dropcaps-content11' : ''; ?>">
			<?php wp_link_pages( array(
					               'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shapely' ),
					               'after'  => '</div>',
				               ) );
							   ?>
			</div>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<?php
	if ( is_single() ):
		$prev = get_previous_post_link();
		$prev = str_replace( '&laquo;', '<div class="wrapper">', $prev );
		$prev = str_replace( '</a>', '</a> <span class="fa fa-angle-right"></span></div>', $prev );
		$next = get_next_post_link();
		$next = str_replace( '<a', '<div class="wrapper"> <span class="fa fa-angle-left"></span> <a', $next );
		$next = str_replace( '&raquo;', '</div>', $next );
		?>
		<div class="shapely-next-prev row container">
			<div class="col-md-6 text-left">
			<?php echo wp_kses_post( $next ) ?>
			</div>
			<div class="col-md-6 text-right">
			<?php echo wp_kses_post( $prev ) ?>
			</div>
		</div>

		<?php
		if ( $post_author && ! $left_side ):
			shapely_author_bio();
		endif;

		if ( $enable_tags ):
			$tags_list = get_the_tag_list( '', ' ' );
			echo ! empty( $tags_list ) ? '<div class="shapely-tags"><span class="fa fa-tags"></span>' . $tags_list . '</div>' : '';
		endif;
		?>

		<?php //do_action( 'shapely_single_after_article' ); ?>
	<?php endif; ?>
</article>