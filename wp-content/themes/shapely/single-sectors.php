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
	<h3><span><?php  echo 'Related Projects ';?></span></h3>
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
<div class="owlCarousel owl-carousel owl-theme owl-loaded owl-drag" data-slider-id="1673" id="owlCarousel-1673" data-slider-items="3" data-slider-speed="400" data-slider-auto-play="1" data-slider-navigation="false">
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
		<div class="shapely-related-post-title">
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
	foreach($arr_project as $item){
		$project_id = $item['id'];
		$popup_image2 = $item['popup_image'];
		$post_image2 = $item['post_image'];
	?>
	
<div class="<?php echo $project_id;?> modal fade project-modal" role="dialog">
			  <div class="modal-dialog">
			
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					</div>
					<div class="modal-body">
						<div class="modal_body_fix col-md-12 p_l_r_0">
							<div class="col-md-6 p_l_r_0 p_relative">
								  <?php 
								  if($image_popup !=''){ ?>
              
                                  <div class="project-img1" style="background-image: url(<?php echo $image_popup['url'];?>);"></div>
                                    <?php
                                    }
                                    else{ ?>
                                      <div class="project-img1" style="background-image: url(<?php the_post_thumbnail_url();?>);"></div>
                                    <?php
                                    }
                                    ?>
								<div class="project_img1_2">
								</div>
							</div>
							<div class="col-md-6  p_l_r_0 color-white p_relative">
							<div class="modal-logo">
								<img src="<?php echo bloginfo('template_directory'); ?>/assets/images/logo.png" class="logo" alt="FYFE">
							</div>
								<div class="p_l_t_30">

									<div class="project-info1">
										<div class="project-info1_ok">
											<p><?php echo get_the_title($project_id);?></p>
										</div>

										<div class="btn-see list-cat-fix list-cat-fix2">
										<?php
										$terms = get_the_terms( $project_id, 'project_sectors' );
                         
										if ( $terms && ! is_wp_error( $terms ) ) : 
										 
											$draught_links = array();
										 
											foreach ( $terms as $term ) {?>
												<a href="<?php the_field('link','project_sectors_'. $term->term_taxonomy_id);?>"><?php echo $term->name;?></a>
											<?php }
											?>
										 
											
										<?php endif; ?></div>
										<div class="post-excerpt-fix-popup hiden-xs"><?php the_content();?></div>

									</div>

									<div class="project-info1">
										<div class="project_info1_ok11">
											<p>RELATED PROJECTS</p>
										</div>
										<?php
											$id = get_the_ID();
											$args1 = array( 'post_type' => 'projects', 'posts_per_page' =>3, 'post__not_in'=> array( $id) );
											$loop1 = new WP_Query( $args1 );
										?>
										<div class="project_info1_ok1">
											<?php while ( $loop1->have_posts() ) : $loop1->the_post(); global $product1;?>
												<span class="no-padding color-white project-item project-item--small">
													<?php the_post_thumbnail();?>

												  <div class="project-info">
														<div class="btn-see list-cat-fix"></div>
														<div class="title-post-fix">
															<h5>
																<button type="button" href="javascript:void(0);"class="btn btn-info btn-lg">
																	<?php echo the_title(); ?>
																</button>
														</h5>
														</div>
												  </div>
												</span>
											<?php  endwhile;?>
										</div>
									</div>

									<div class="project_info_bottom">
										<div class="col-md-6 p_l_r_0 project_info_bottom1_6">
											<div class="project_info1_a_share">
												<p>SHARE</p>
												<?php echo do_shortcode( "[simple-social-share]" ); ?>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			  </div>
			</div>
<?php }
	?>
			</div><!--/.mt-related-posts-->
			</div><!--/.mt-related-posts-->
	</div>
<?php
get_footer();