<?php
/**
 * The template for displaying archive pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */
get_header(); ?>
<?php $layout_class = shapely_get_layout_class();?>
<?php
if (have_posts()) : 
$count=0;
?>
<div class="bg-title-fix"><?php single_cat_title();?></div>
	<?php
	/* Start the Loop */
	while (have_posts()) : the_post(); $count++;
	$news_taxonomy = get_the_terms( get_the_ID(), 'sectors_cat', '', '' );
		// var_dump($news_taxonomy);
		$news_taxonomy_link = get_term_link($news_taxonomy[0]->term_id, 'sectors_cat' );
	?>
	<?php  if($count % 2 == 0) {?>
	
<div class="col-md-12 no-padding">
				<div class="col-md-6 no-padding">
					<div class=" fl style_content_get_news">
						<div class="col-ms-12 fl style_image_news">
							<?php the_post_thumbnail();?>					</div>
					</div>
				</div>
				<div class="col-md-6 no-padding">
					<div class=" fl style_content_news">

						<div class="btn-see style_content_news_a">
								<a href="<?php echo $news_taxonomy_link;?>"> <?php echo $news_taxonomy[0]->name;  ?></a>
						</div>
						<div class="col-ms-12 fl style_title_news">
								<a href="<?php the_permalink();?>"><?php the_title();?></a>
						</div>
						<div class="col-ms-12 fl style_c_d">
								<span class="style_c_d2"><?php $post_date = get_the_date( 'd/m/Y' ); echo $post_date; ?></span>
						</div>
						<div class="col-ms-12 fl style_content_news_main">
							<?php  echo get_the_excerpt(); ?>
						<div><a class="btn-filled btn" href="<?php the_permalink();?>" title="Water">Read More</a></div>						</div>

						<div class="col-ms-12 fl style_news_read_more">
							<a href="<?php the_permalink();?>">READ MORE</a>
						</div>
					</div>
				</div>
			</div>
	<?php } else {?>
	<div class="col-md-12 no-padding">
				<div class="col-md-6 no-padding d_n style_content_get_news_display1">
					<div class=" fl style_content_get_news">
						<div class="col-ms-12 fl style_image_news">
							<?php the_title();?>						</div>
					</div>
				</div>
				<div class="col-md-6 no-padding">
					<div class=" fl style_content_news">
						<div class="btn-see style_content_news_a">
						<a href="<?php echo $news_taxonomy_link;?>"> <?php echo $news_taxonomy[0]->name;  ?></a>
						</div>
						<div class="col-ms-12 fl style_title_news">
							<a href="<?php the_permalink();?>"><?php the_title();?></a>
						</div>
						<div class="col-ms-12 fl style_c_d">
							<span class="style_c_d2"><?php $post_date = get_the_date( 'd/m/Y' ); echo $post_date; ?></span>
						</div>
						<div class="col-ms-12 fl style_content_news_main">
							<?php  echo get_the_excerpt(); ?><div><a class="btn-filled btn" href="<?php the_permalink();?>" title="<?php the_title();?>">Read More</a></div>						</div>
						<div class="col-ms-12 fl style_news_read_more">
							<a href="<?php the_permalink();?>">READ MORE</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 no-padding style_content_get_news_display2">
					<div class=" fl style_content_get_news">
						<div class="col-ms-12 fl style_image_news">
							<?php the_post_thumbnail();?>							</div>
					</div>
				</div>
			</div>
			
	<?php } endwhile;
	endif; ?>
		<?php
		if ( $layout_class == 'sidebar-right' ):
			// get_sidebar();
		endif; ?>
<?php
get_footer();
