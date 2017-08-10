<?php
/*================ expertise short code=================*/
function product_shortcode($args, $content) {
	$title = $args['title'] ;
	$des = $args['des'] ;
	ob_start();
	$args = array( 'post_type' => 'expertise', 'posts_per_page' => 14, /*'orderby'=> 'title', */'order' => 'ASC' );
	$loop = new WP_Query( $args );?>
	<div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix height-fix-tn">
		<div class="vc_column-inner no-padding center-fix-item expertise_p_t_h4">
			<h4><a href="/?page_id=1101"><?php echo $title;?></a></h4>
			<p><?php echo $des;?></p>
		</div>
	</div>

	<div class="our-service-posts">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;
		$animated_icons = get_field('animated_icons');
		// var_dump($animated_icons['url']);
		?>
		<div class="col-lg-5ths col-md-3 col-sm-4 col-xs-6 no-padding text-center height-fix height-fix_19_7">
			<a href="<?php the_field('link'); ?>">
				<div class='img-hover-fix img-hover-fix_1'><?php the_post_thumbnail();?></div>
				<div class='img-hover-fix d_n img-hover-fix_2'>
					<?php if($animated_icons['url']!=''){?>
						<img src="<?php echo $animated_icons['url']; ?>">
					<?php }
					else {
						the_post_thumbnail();
					}?>
				</div>
				<div class="title-hover"><h3><?php the_title();?></h3></div>
			</a>
		</div>
		<?php  endwhile;?>
	</div>
<?php wp_reset_query(); ?>
<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'expertise', 'product_shortcode' );

/*================post short code=================*/
function post_shortcode($args, $content) {
	$title = $args['title'] ;
	ob_start();
	$args = array( 'post_type' => 'post', 'posts_per_page' => 1,'orderby'  => 'date', 'order'  => 'ASC', );
	$loop = new WP_Query( $args );?>

	<div class="col-lg-12 col-xs-12 no-padding glr-right color-white">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
	<div class="no-padding full-width-fix">
		<div class="info-fix-right">
			<h4><a href="/?page_id=791"><?php echo $title;?></a></h4>

			<!--<a href="/?page_id=791" target="_blank" class="icon-see" rel="noopener noreferrer">&rarr;</a>-->
			<div class="btn-see">
				<a href="/?page_id=791" target="_blank" rel="noopener noreferrer">SEE MORE</a>
			</div>
		</div>

		<div class='img-post-fix'><?php the_post_thumbnail();?></div>
		<div class="info-fix">
			<!--<div class="btn-see"><?php /*the_category( $separator, $parents, $post_id ); */?> </div>-->
			<div class="title-post-fix"><h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4></div>
			<!--<div class="post-excerpt-fix hiden-xs"><?php /*the_excerpt();*/?></div>-->

			<div class="btn-see">
				<a href="<?php the_permalink();?>">READ MORE</a>
			</div>
		</div>
	</div>
<?php  endwhile;?>
</div>

<?php wp_reset_query(); ?>
<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'post_home', 'post_shortcode' );

/*================sectors short code=================*/

//Sector fix 3-7-2017


//Short Code Slider Home
add_shortcode( 'sectors1', 'our_sectors_func' );
function our_sectors_func($atts) {
	ob_start();

    $args = ( array(
        'post_type' => 'sectors',
		'posts_per_page' => 12,
		'orderby' => 'title',
		'order' => 'ASC'
    ) );

	$query = new WP_Query($args);?>
	<div class="slhome">
		<div id="myCarousel2" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2000">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	<?php
	if ($query->have_posts()) {
		while ($query->have_posts()) {
		$query->the_post();?>

	  <div id="myCarousel<?php echo get_the_ID(); ?>" class="item item-fix2">
        <div class="img_slhome col-lg-20ths col-xs-12 no-padding glr-right color-white">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('shapely-full');?></a>

		</div>
		<div class="wpb_column vc_column_container col-lg-5ths item-center-fix2">
			<div class="vc_column-inner no-padding center-fix-item text-left">
				<!-- <h4><a href="/?page_id=789">OUR SECTORS</a></h4> -->
			</div>
		</div>
      </div>

		<?php
		}
	}?>
	<div class="btn-slider hsu-slider-styling slhomebt">
		<a class="leftbt" href="#myCarousel2" data-slide="prev">
		  <span class="glyphicon glyphicon-chevron-left"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="rightbt" href="#myCarousel2" data-slide="next">
		  <span class="glyphicon glyphicon-chevron-right"></span>
		  <span class="sr-only">Next</span>
		</a>
	</div>

	</div>
	<div class="slhome_list slhome_list_sector1 slhome_list_sectors1 sectors1 col-lg-5ths">
		<h4><a href="/?page_id=789">OUR SECTORS</a></h4>
		<div class="dot-slider">
			<ol class="carousel-indicators">

			<?php

				$args2 = ( array(
					'post_type' => 'sectors',
					'posts_per_page' => 12,
					'orderby' => 'title',
					'order' => 'ASC'
				) );
				$i=0;
				$query2 = new WP_Query($args2);
				if ($query2->have_posts()) {
				while ($query2->have_posts()) {
				$query2->the_post();?>

					<li data-target="#myCarousel2" data-slide-to="<?php echo $i;?>"
						class="slhome_title slhome_title_sector slhp_<?php the_field('data_slider');?>
						<?php if($i==0){echo 'active';}?>">
						<?php
						$post_slug = get_post_field( 'post_name', get_post() );
						// var_dump($post_slug);

						$link = '/?page_id=789/#'.$post_slug ;
						?>
						<a href="<?php echo $link; ?>"><?php the_title();?></a>
					</li>
				<?php $i++;
				}
				wp_reset_postdata();
			}?>
			</ol>
		</div>
	</div>

  </div>
  <style type="text/css">
  	.text_yellow{
  		color: #f1ac08;
  	}
  </style>
  <script>
    jQuery(document).ready(function(){

    	jQuery(".item-fix2:first").addClass("active");
		jQuery('.slhome_title').click(function(){
			jQuery(".slhome_title").toggleClass('text_yellow');
	});

});
  </script>



	</div>
	<?php
$myvariable = ob_get_clean();
	return $myvariable;
}


//End ector fix 3-7-2017



function sectors_shortcode($args, $content) {

	ob_start();
	$args = array( 'post_type' => 'sectors', 'posts_per_page' => 8, 'order'   => 'ASC', );
	$loop = new WP_Query( $args );
	?>

  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
      <div class="item item-fix">
        <div class="col-lg-20ths col-xs-12 no-padding glr-right color-white">
			<?php the_post_thumbnail();?>
		</div>
		<div class="wpb_column vc_column_container col-lg-5ths item-center-fix2">
		<div class="vc_column-inner no-padding center-fix-item text-left">
			<h4><a href="/?page_id=789">OUR SECTORS</a></h4>
			<a class="title-yellow" href="<?php the_permalink();?>"><?php the_title();?></a>
			<?php ;
			echo substr(get_the_excerpt(), 0, 200);
			?>
			<p>The Hidden Mystery Behind FYFE</p>
			<a href="/?page_id=789" target="_blank" class="icon-see" rel="noopener noreferrer">&rarr;</a>

		</div>
		</div>
      </div>
	  <?php  endwhile;?>
    </div>
	<div class="btn-slider">
		<a class="" href="#myCarousel" data-slide="prev">
		  <span class="glyphicon glyphicon-chevron-left"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="" href="#myCarousel" data-slide="next">
		  <span class="glyphicon glyphicon-chevron-right"></span>
		  <span class="sr-only">Next</span>
		</a>

	</div>
	<div class="dot-slider">
	<ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

  </ol>

	</div>
    <!-- Left and right controls -->

  </div>
  <script>
  jQuery(document).ready(function(){
    jQuery(".item-fix:first").addClass("active");
});
  </script>
  <?php wp_reset_query(); ?>
<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'sectors', 'sectors_shortcode' );

/*================project short code=================*/
function project_shortcode($args, $content) {
	$title= $args['title'];
	ob_start();
	?>

	<div class="wpb_column vc_column_container text-center item-center-fix col-lg-5ths pull-right our-project-title before">
		<div class="vc_column-inner no-padding center-fix-item p_relative">
			<h4><a href="/?page_id=1052"><?php echo $title;?></a></h4>
			<div class="btn-see">
				<a href="/?page_id=1052">SEE MORE</a>
			</div>
		</div>
	</div>

	<div id="category-post-content" class="">
		<?php
		$args = array( 'post_type' => 'projects', 'posts_per_page' => 9 );
		$loop = new WP_Query( $args );$count=0;
		?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); $count++; global $product;?>
			<?php $terms  = get_the_terms( get_the_ID(), 'project_cat', '', '' );  ?>

			<?php if($count==4){?>
				<div class="col-lg-5ths col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
				<div class="project-img project-img--square" style="background: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'people-thumb');?>) no-repeat center center; background-size: cover;">
					<a href="javascript:void(0);"></a>
				</div>
				<div class="project-info">
					<div class="title-post-fix"><h5><button type="button" class="btn btn-info btn-lg"><?php the_title();?></button>
					</h5></div>
				</div>
			</div>
				<div class="wpb_column vc_column_container text-center item-center-fix col-lg-5ths pull-right our-project-title after project-img project-img--square" style="height: 20vw;">
				<div class="vc_column-inner no-padding center-fix-item p_relative">
					<h4><a href="/?page_id=1052"><?php echo $title;?></a></h4>
					<div class="btn-see">
						<a href="/?page_id=1052">SEE MORE</a>
					</div>
				</div>
			</div>
			<?php } else{ ?>
			<div class="col-lg-5ths col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
				<div class="project-img project-img--square" style="background: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'people-thumb');?>) no-repeat center center; background-size: cover;">
					<a href="javascript:void(0);"></a>
				</div>
				<div class="project-info">
					<div class="title-post-fix"><h5><button type="button" class="btn btn-info btn-lg"><?php the_title();?></button>
					</h5></div>
				</div>
			</div>
			<?php } ?>
			<div class="<?php echo get_the_ID();?> modal fade project-modal" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					</div>
					<div class="modal-body">
						<div class="modal_body_fix col-md-12 p_l_r_0">
							<div class="col-md-6 p_l_r_0 p_relative">
								<div class="project-img1">
								<?php $image_popup = get_field('image_popup') ;
								if($image_popup !=''){ ?>
									<img src="<?php echo $image_popup['url'];?>" />
								<?php
								}
								else{ ?>
									<a class = "style_image_thumbnail" href="#"><?php the_post_thumbnail();?></a>
								<?php
								}
								?>
								</div>
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
											<p><?php the_title();?></p>
										</div>

										<div class="btn-see list-cat-fix list-cat-fix2">
										<?php
										$terms = get_the_terms( get_the_ID(), 'project_services' );

										if ( $terms && ! is_wp_error( $terms ) ) :

											$draught_links = array();

											foreach ( $terms as $term ) {?>
												<a href="<?php the_field('link','project_services_'. $term->term_taxonomy_id);?>"><?php echo $term->name;?></a>
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
										$custom_taxterms = wp_get_object_terms( $id, 'project_services', array('fields' => 'ids') );
										$args1 = array(
										'post_type' => 'projects',
										'post_status' => 'publish',
										'posts_per_page' => 3, // you may edit this number
										'orderby' => 'rand',
										'tax_query' => array(
											array(
												'taxonomy' => 'project_services',
												'field' => 'id',
												'terms' => $custom_taxterms
											)
										),
										'post__not_in' => array ($id),
										);

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
		<?php  endwhile;?>

		<?php wp_reset_query(); ?>
	</div>



<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'projects', 'project_shortcode' );
/*================team short code=================*/
function teams_shortcode($args, $content) {
	$title= $args['title'];
	ob_start();
	?>
	<div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix teams_style_fix_4_7">
		<div class="vc_column-inner no-padding center-fix-item p_relative">
			<h4 class="teams-title"><?php echo $title;?></h4>
			<div class="btn-see">
				<a href="/?page_id=1410">SEE MORE</a>
			</div>
		</div>
	</div>
	<div id="teams-post-content">
		<?php
			$args = array( 'post_type' => 'teams', 'posts_per_page' => 9, 'orderby' => 'date', 'order' => 'ASC' );
			$loop = new WP_Query( $args );
		?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
			<!-- <?php $terms  = get_the_terms( get_the_ID(), 'teams_cat', '', '' );  ?> -->
			<div class="col-lg-5ths col-xs-6 no-padding color-white project-item project-item--people" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
				<div class="teams-img 4">
					<a href="javascript:void(0);"><?php the_post_thumbnail('people-thumb');?></a>
				</div>
				<div class="project-info">
	<!-- 				<?php foreach($terms as $value ){?>
					<div class="btn-see btn_see_fix"><a><?php echo $value->name;?></a></div>
					<?php } ?> -->
					<div class="title-post-fix">
						<h5>
							<button type="button" class="btn btn-info btn-lg"><?php the_title();?></button>
							<p>
								<?php
									// Will also be used later
									$status = get_field('status');
									echo $status;
								?>
							</p>
						</h5>
					</div>
				</div>
			</div>
			<div class="<?php echo get_the_ID();?> modal fade team-modal" role="dialog">
			    <div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<div class="modal_body_fix col-md-12 p_l_r_0">

								<div class="col-md-6 p_l_r_0 p_relative">
									<div class="project-img1">
									<?php $image_popup = get_field('image_popup') ;
									if($image_popup !=''){ ?>
										<img src="<?php echo $image_popup['url'];?>" />
									<?php
									}
									else{ ?>
										<a class = "style_image_thumbnail" href="#"><?php the_post_thumbnail();?></a>
									<?php
									}
									?>
									</div>
									<div class="project_img1_2">
									</div>
								</div>
								<div class="col-md-6  p_l_r_0 color-white p_relative">
								<div class="modal-logo">
									<img src="<?php echo bloginfo('template_directory'); ?>/assets/images/logo.png" class="logo" alt="FYFE">
								</div>
									<div class="p_l_t_30">
										<?php
											$location = get_field('location') ;
											$email = get_field('email') ;
											$phone = get_field('phone') ;
										?>
										<div class="project-info1_ok project_info1_ok_100">
											<h6><a href="<?php the_field('linkedin');?>" target="_blank" class="linkedin-user"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a><?php the_title();?></h6>
										</div>
										<div class="project-info1">
											<div class="project-info1_ok">
												<p><?php echo $status;?></p>
											</div>
											<div class="post-excerpt-fix-popup hiden-xs">
											  	<?php the_content();?>
											  	<?php if (!empty($email)) { ?>
											      	<p>
												      	<span>Email:</span>
												      	<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
											      	</p>
											  	<?php } ?>
											  	<?php if (!empty($phone)) { ?>
												    <p>
													    <span>Phone:</span>
													    <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
												    </p>
											  	<?php } ?>
											</div>
										</div>

										<?php
											$past_projects = new WP_Query(array(
											  'post_type' => 'projects',
											  'posts_per_page' =>3,
											  'post__not_in'=> array(get_the_ID())
											));
										?>

										<div class="past-project" id="past-project-<?php the_ID(); ?>">
											<h5>PAST PROJECTS</h5>

											<?php while($past_projects->have_posts()) : $past_projects->the_post(); global $product1; ?>
												<span class="no-padding color-white project-item project-item--small" data-toggle="modal" data-target=".1628">
													<?php the_post_thumbnail();?>

												  <div class="project-info">
														<div class="btn-see list-cat-fix"></div>
														<div class="title-post-fix">
															<h5>
																<button type="button" class="btn btn-info btn-lg">
																	<?php echo the_title(); ?>
																</button>
													  	</h5>
														</div>
												  </div>
												</span>
											<?php endwhile; ?>
										</div>

										<div class="project_info_bottom">
											<div class="col-md-6 p_l_r_0">
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
		<?php  endwhile;?>
		<?php wp_reset_query(); ?>
	</div>

<?php wp_reset_query(); ?>
<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'teams', 'teams_shortcode' );


function contact_shortcode($args, $content) {
	ob_start();
	?>

	<div class="col-md-3 no-padding">
		<div id="map"  style="width: 100%; height: 630px;"></div>
		<input type="hidden" id="result" value="">
	</div>

	<div class="col-md-3 col-xs-7ths_ff col-xs-12 no-padding bg-yellow ">
		<div id="location-content">
			<?php
			$args2 = array(
				'post_type' => 'locations',
				'posts_per_page' => -1,

			);
			$loop2 = new WP_Query( $args2 );
			?>

			<div id="location-content_title">
				<?php
				$i=0;
				$arr_info_center = array() ;

				while ( $loop2->have_posts() ) : $loop2->the_post(); global $product2;
					$current_cat = ($i<1) ? 'current_cat' : '';
					//$maps_center1 = get_field( "maps" );

					$maps_center = get_field( "maps" );
					$arr_center = array();
					$arr_center['id'] = get_the_ID();
					$arr_center['name_location'] = get_field( "name_location" );
					$arr_center['address']= isset($maps_center['address']) ? $maps_center['address'] : '';
					$arr_center['lat']= isset($maps_center['lat']) ? $maps_center['lat'] : '';
					$arr_center['lng']= isset($maps_center['lng']) ? $maps_center['lng'] : '';
					$arr_center['title']= get_the_title();
					$arr_center['visible'] = ($i<1) ? '1' : '0';

					$arr_center['arr_info'] = array();
					?>
					<a id="location_<?php the_ID();?>"
					   class="location_remove <?php echo $current_cat; ?>"
					   href="javascript:void(0);"
					   data-location-id="<?php the_ID(); ?>"
					   data-lat="<?php echo $arr_center['lat']; ?>"
					   data-lng="<?php echo $arr_center['lng']; ?>">
						<?php the_title();?>
					</a>
					<?php
					if( have_rows('location_information') ):
						// loop through the rows of data
						while ( have_rows('location_information') ) : the_row();
							$arr = array();
							// display a sub field value ?>
							<?php
							$location_name = get_sub_field('location_name');
							$information_detail = get_sub_field('information_detail');
							$arr1 = array();
							$arr1['name']= $location_name;
							$arr1['information_detail']= $information_detail;
							$maps_child = get_sub_field('maps_child', false);
							if( !empty($maps_child) ):
								// echo '<a class="lat-item">' . $maps_child['lat'] .' - ';
								// echo $maps_child['lng'].'</a>';
								$arr1['address']= $maps_child['address'];
								$arr1['lat']= $maps_child['lat'];
								$arr1['lng']= $maps_child['lng'];
							endif;

							$arr_center['arr_info'][] = $arr1;
						endwhile;
					else :
						// no rows found

					endif;

					$arr_info_center[] = $arr_center;
					$i++;
				endwhile;
				wp_reset_query();?>
			</div>

			<div id="location-content_main">
				<?php foreach($arr_info_center as $item) { ?>
					<div id="location-box-<?php echo $item['id'] ?>" class="location-box" style="<?php echo ($item['visible'] == '1') ? '' : 'display:none;' ?>">
						<h2><?php echo $item['name_location'];?></h2>

						<?php foreach($item['arr_info'] as $arrItem) { ?>
							<h3><?php echo $arrItem['name'];?></h3>
							<?php echo $arrItem['information_detail']; ?>
						<?php } ?>

						<script>
							var addr_info_<?php echo $item['id'] ?> = <?php echo json_encode($item['arr_info']); ?>;
						</script>
					</div>
				<?php } ?>
			</div>

		</div>

		<script type="text/javascript">
			var map = null;
			var marker = [];

			jQuery(document).ready( function($) {
				$(".location_remove").on("click", function() {
					if($(this).hasClass('current_cat')) return;

					$(".location_remove").removeClass("current_cat");
					$(this).addClass("current_cat");

					var locationId = $(this).data('location-id');
					var boxId = '#location-box-' + locationId;

					$('.location-box').hide();
					$(boxId).show();

					if(map != null) {
						clearMarkers();
						setMarkers(map, eval('addr_info_'+locationId));
					}
				});
			});

			function initMap(lat, lng, arr_info_json) {
				var lat = <?php echo $arr_info_center[0]['lat'];?>;
				var lng = <?php echo $arr_info_center[0]['lng'];?>;
				var arr_info_json = <?php echo json_encode($arr_info_center[0]['arr_info']); ?>;

				var uluru = {lat: lat, lng: lng};
				map = new google.maps.Map(document.getElementById('map'), {
					zoom: 2,
					center: uluru,
					mapTypeControl: false,
					styles: [
						{
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#f5f5f5"
								}
							]
						},
						{
							"elementType": "labels.icon",
							"stylers": [
								{
									"visibility": "off"
								}
							]
						},
						{
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"color": "#616161"
								}
							]
						},
						{
							"elementType": "labels.text.stroke",
							"stylers": [
								{
									"color": "#f5f5f5"
								}
							]
						},
						{
							"featureType": "administrative.land_parcel",
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"color": "#bdbdbd"
								}
							]
						},
						{
							"featureType": "poi",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#eeeeee"
								}
							]
						},
						{
							"featureType": "poi",
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"color": "#757575"
								}
							]
						},
						{
							"featureType": "poi.park",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#e5e5e5"
								}
							]
						},
						{
							"featureType": "poi.park",
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"color": "#9e9e9e"
								}
							]
						},
						{
							"featureType": "road",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#ffffff"
								}
							]
						},
						{
							"featureType": "road.arterial",
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"color": "#757575"
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#dadada"
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"color": "#616161"
								}
							]
						},
						{
							"featureType": "road.local",
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"color": "#9e9e9e"
								}
							]
						},
						{
							"featureType": "transit.line",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#e5e5e5"
								}
							]
						},
						{
							"featureType": "transit.station",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#eeeeee"
								}
							]
						},
						{
							"featureType": "water",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#c9c9c9"
								}
							]
						},
						{
							"featureType": "water",
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"color": "#9e9e9e"
								}
							]
						}
					]
				});
				var image = {
					url: 'http://fyfe-project.sunbeardigital.com/wp-content/uploads/2017/07/icon_marker.png',
					// This marker is 20 pixels wide by 32 pixels high.
					size: new google.maps.Size(32, 32),
					// The origin for this image is (0, 0).
					origin: new google.maps.Point(0, 0),
					// The anchor for this image is the base of the flagpole at (0, 32).
					anchor: new google.maps.Point(16, 32)
				};

				//Khoi tao ban dau neu chua co ajax load click
				setMarkers(map,arr_info_json);
			}

			function setMarkers(map,arr_info_json) {
				// Adds markers to the map.

				// Marker sizes are expressed as a Size of X,Y where the origin of the image
				// (0,0) is located in the top left of the image.

				// Origins, anchor positions and coordinates of the marker increase in the X
				// direction to the right and in the Y direction down.
				var image = {
					url: 'http://fyfe-project.sunbeardigital.com/wp-content/uploads/2017/07/icon_marker.png',
					// This marker is 20 pixels wide by 32 pixels high.
					size: new google.maps.Size(32, 32),
					// The origin for this image is (0, 0).
					origin: new google.maps.Point(0, 0),
					// The anchor for this image is the base of the flagpole at (0, 32).
					anchor: new google.maps.Point(16, 32)
				};
				// Shapes define the clickable region of the icon. The type defines an HTML
				// <area> element 'poly' which traces out a polygon as a series of X,Y points.
				// The final coordinate closes the poly by connecting to the first coordinate.
				var shape = {
					coords: [1, 1, 1, 20, 18, 20, 18, 1],
					type: 'poly'
				};
				// var beaches;
				//neu em lam the nay no chi luon gan = 2 diem minh phair bien function nay thanh function chung
				for (var i = 0; i < arr_info_json.length; i++) {

					var arr_maker = arr_info_json[i];
					var lat = parseFloat(arr_maker.lat);
					var lng = parseFloat(arr_maker.lng);
					marker[i] = new google.maps.Marker({
						position: {lat: lat, lng: lng},
						map: map,
						icon: image,
						title: arr_maker.lat,
						zIndex: arr_maker.lat,
						data: arr_maker.address,
					});

					google.maps.event.addListener(marker[i], 'mouseover', function() {
						if (!this.getMap()._infoWindow) {
							this.getMap()._infoWindow = new google.maps.InfoWindow();
						}

						this.getMap()._infoWindow.setContent(this.data);
						this.getMap()._infoWindow.open(this.getMap(), this);
					});

					google.maps.event.addListener(marker[i], 'mouseout', function() {
						if (!this.getMap()._infoWindow) {
							this.getMap()._infoWindow = new google.maps.InfoWindow();
						}

						this.getMap()._infoWindow.close();
					});
				}
			}

			function clearMarkers() {
				for (var i = 0; i < marker.length; i++) {
					marker[i].setMap(null);
				}

				marker = [];
			}
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWerbOyH_bpvHxMOokfcP8L5ClwqD2xY4&callback=initMap"></script>
	</div>

	<div class="col-md-6 col-xs-5ths_ff col-xs-12 no-padding style_home_fyfe_contact_form ">
		<h4>CONTACT US</h4>
		<?php echo do_shortcode('[contact-form-7 id="171" title="Contact Form"]'); ?>
	</div>

	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'contact', 'contact_shortcode' );

add_shortcode( 'news', 'news_shortcode' );
function news_shortcode($args, $content) {
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	ob_start();
	$atts = shortcode_atts( array(
		'number_posts' => 3,
		'post_type' => 'post',
		), $atts, 'news' );
	$args1 = array(
	'posts_per_page'   => $atts['number_posts'],
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'post_type'        => $atts['post_type'],
	'post_status'      => 'publish',
	'paged'    => $paged,
	);
	// var_dump($atts['post_type']);
	$posts_array1 = new WP_Query( $args1 );
	// var_dump($posts_array1->request);
	// echo "<pre>";
	// var_dump($posts_array);
	global $post;?>
	<div class="m_st_20_bul_p">
		<div id="news_load">
		<?php
		$i=0;
		if ( $posts_array1->have_posts() ) {
		while ( $posts_array1->have_posts() ) {
		$posts_array1->the_post();
		$news_taxonomy = get_the_terms( get_the_ID(), 'category', '', '' );
		// var_dump($news_taxonomy);
		$news_taxonomy_link = get_term_link($news_taxonomy[0]->term_id, 'category' );
		// var_dump($news_taxonomy_link);
		if($i%2==0){
		?>
			<div class="col-md-12 no-padding">
				<div class="col-md-6 no-padding">
					<div  class=" fl style_content_get_news">
						<div  class="col-ms-12 fl style_image_news">
							<?php the_post_thumbnail();?>
						</div>
					</div>
				</div>
				<div class="col-md-6 no-padding">
					<div  class=" fl style_content_news">

						<div class="btn-see style_content_news_a">
								<a href="<?php echo $news_taxonomy_link;?>"> <?php echo $news_taxonomy[0]->name;  ?></a>
						</div>
						<div  class="col-ms-12 fl style_title_news">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
						<div  class="col-ms-12 fl style_c_d">
								<span class="style_c_d2"><?php $post_date = get_the_date( 'd/m/Y' ); echo $post_date; ?></span>
						</div>
						<div  class="col-ms-12 fl style_content_news_main">
								<?php  echo get_the_excerpt(); ?>
						</div>

						<div  class="col-ms-12 fl style_news_read_more">
							<a  href="<?php the_permalink(); ?>">READ MORE</a>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		else{
		?>
			<div class="col-md-12 no-padding">
				<div class="col-md-6 no-padding d_n style_content_get_news_display1">
					<div  class=" fl style_content_get_news">
						<div  class="col-ms-12 fl style_image_news">
							<?php the_post_thumbnail();?>
						</div>
					</div>
				</div>
				<div class="col-md-6 no-padding">
					<div  class=" fl style_content_news">
						<div class="btn-see style_content_news_a">
							<a href="<?php echo $news_taxonomy_link;?>"> <?php echo $news_taxonomy[0]->name;  ?></a>
						</div>
						<div  class="col-ms-12 fl style_title_news">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
						<div  class="col-ms-12 fl style_c_d">
							<span class="style_c_d2"><?php $post_date = get_the_date( 'd/m/Y' ); echo $post_date; ?></span>
						</div>
						<div  class="col-ms-12 fl style_content_news_main">
							<?php  echo get_the_excerpt(); ?>
						</div>
						<div  class="col-ms-12 fl style_news_read_more">
							<a href="<?php the_permalink(); ?>">READ MORE</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 no-padding style_content_get_news_display2">
					<div  class=" fl style_content_get_news">
						<div  class="col-ms-12 fl style_image_news">
							<?php the_post_thumbnail();?>
						</div>
					</div>
				</div>
			</div>

		<?php
		}
		$i++;
		}
		}
		wp_reset_postdata();
		?>

		<div id="ajax_posts_f" class="row">
			<input type="hidden" class="ajax_posts_f_page" value="2">
			<input type="hidden" class="ajax_posts_f_i" value="<?php echo $i;?>">
		</div>
		</div>
		<div  class="col-ms-12 fl style_news_read_more t_c">
			<a id="read_more_news" href="javascript:void(0);">SEE MORE</a>
		</div>
		<script type="text/javascript">
			jQuery(document).ready( function($) {
			var ajaxUrl1 = "<?php echo admin_url('admin-ajax.php')?>";
			$("#read_more_news").on("click", function() {
			var paged = $('.ajax_posts_f_page').last().val();
			var post_type = '<?php echo $atts['post_type']?>';
			var i = $('.ajax_posts_f_i').last().val();
			// var paged = $('.ajax_posts_f_page').last().val();
			$.post(ajaxUrl1, {
				action: "load_more_ajax",
				paged : paged,
				post_type : post_type,
				i : i,
				},'html')
				.success(function(posts1345) {

				$("#news_load").append(posts1345);
				});
			});
			});
		</script>
	</div>
	<?php
	$myvariable = ob_get_clean();
	return $myvariable;
}

add_shortcode( 'feature', 'feature_shortcode' );
function feature_shortcode($args, $content) {
	ob_start();
	$atts = shortcode_atts( array(
		'number_posts' => 3,
		'post_type' => 'post',
		'taxonomy'  => 'feature',
		), $atts, 'feature' );
	$args = array(
	'posts_per_page'   => $atts['number_posts'],
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => $atts['post_type'],
	'post_status'      => 'publish',
	'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $atts['taxonomy'],
            ),
        ),
	);
	$posts_array = get_posts( $args );
	// echo "<pre>";
	// var_dump($posts_array);
	global $post;?>
	<div class="m_st_20_bul_p_feature">
		<?php
		$i=0;
		foreach ( $posts_array as $post ) : setup_postdata( $post );
		$news_taxonomy = get_the_terms( get_the_ID(), 'category', '', '' );
		// var_dump($news_taxonomy);
		$news_taxonomy_link = get_term_link($news_taxonomy[0]->term_id, 'category' );
		?>
			<div class="col-md-4 ">
				<div class="col-md-12 no-padding">
					<div  class=" fl style_content_get_feature">
						<div  class="col-ms-12 fl style_image_feature">
							<?php the_post_thumbnail();?>
						</div>
					</div>
				</div>
				<div class="col-md-12 no-padding">
					<div  class=" fl style_content_feature">

						<div class="btn-see style_content_news_a">
								<a href="<?php echo $news_taxonomy_link;?>"> <?php echo $news_taxonomy[0]->name;  ?></a>
						</div>
						<div  class="col-ms-12 fl style_title_news">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
						<div  class="col-ms-12 fl style_c_d">
								<span class="style_c_d2"><?php $post_date = get_the_date( 'd/m/Y' ); echo $post_date; ?></span>
						</div>
						<div  class="col-ms-12 fl style_content_news_main">
								<?php  echo substr( get_the_excerpt() ,  0, 232); ?>
						</div>

						<div  class="col-ms-12 fl style_news_read_more">
							<a  href="<?php the_permalink(); ?>">READ MORE</a>
						</div>
					</div>
				</div>
			</div>
		<?php
		endforeach;
		wp_reset_postdata();
		?>

	</div>
	<?php
	$myvariable = ob_get_clean();
	return $myvariable;
}

add_shortcode( 'sectors_news', 'sectors_news_shortcode' );
function sectors_news_shortcode($args, $content) {
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	ob_start();
	$atts = shortcode_atts( array(
		'number_posts' => -1,
		'post_type' => 'sectors',
		), $atts, 'sectors_news' );
	$args1 = array(
	'posts_per_page' 	   => '-1',
	'orderby'          => 'title',
	'order'            => 'ASC',
	'post_type'        => $atts['post_type'],
	'post_status'      => 'publish',
	'paged'    => $paged,
	);
	// var_dump($atts['post_type']);
	$posts_array1 = new WP_Query( $args1 );
	// var_dump($posts_array1->request);
	// echo "<pre>";
	// var_dump($posts_array);
	global $post;?>
	<div class="m_st_20_bul_p">
		<div id="news_load">
		<?php
		$i=0;
		if ( $posts_array1->have_posts() ) {
		while ( $posts_array1->have_posts() ) {
		$posts_array1->the_post();
		$news_taxonomy = get_the_terms( get_the_ID(), 'sectors_cat', '', '' );
		// var_dump($news_taxonomy);
		$news_taxonomy_link = get_term_link($news_taxonomy[0]->term_id, 'sectors_cat' );
		// var_dump($news_taxonomy_link);
		$post_slug = get_post_field( 'post_name', get_post() );
		if($i%2==0){
		?>
			<div class="col-md-12 no-padding " id="<?php echo $post_slug; ?>">
				<div class="col-md-6 no-padding">
					<div  class=" fl style_content_get_news">
						<div  class="col-ms-12 fl style_image_news">
							<?php the_post_thumbnail();?>
						</div>
					</div>
				</div>
				<div class="col-md-6 no-padding">
					<div  class=" fl style_content_news">

						<!--<div class="btn-see style_content_news_a">
								<a href="<?php /*echo $news_taxonomy_link;*/?>"> <?php /*echo $news_taxonomy[0]->name;  */?></a>
						</div>-->
						<div  class="col-ms-12 fl style_title_news">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
						<!--<div  class="col-ms-12 fl style_c_d">
								<span class="style_c_d2"><?php /*$post_date = get_the_date( 'd/m/Y' ); echo $post_date; */?></span>
						</div>-->
						<div  class="col-ms-12 fl style_content_news_main">
							<?php  echo excerpt(50); ?>
						</div>

						<div  class="col-ms-12 fl style_news_read_more">
							<a  href="<?php the_permalink(); ?>">READ MORE</a>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		else{
		?>
			<div class="col-md-12 no-padding" id="<?php echo $post_slug; ?>">
				<div class="col-md-6 no-padding d_n style_content_get_news_display1">
					<div  class=" fl style_content_get_news">
						<div  class="col-ms-12 fl style_image_news">
							<?php the_post_thumbnail();?>
						</div>
					</div>
				</div>
				<div class="col-md-6 no-padding">
					<div  class=" fl style_content_news">
						<!--<div class="btn-see style_content_news_a">
							<a href="<?php /*echo $news_taxonomy_link;*/?>"> <?php /*echo $news_taxonomy[0]->name;  */?></a>
						</div>-->
						<div  class="col-ms-12 fl style_title_news">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
						<!--<div  class="col-ms-12 fl style_c_d">
							<span class="style_c_d2"><?php /*$post_date = get_the_date( 'd/m/Y' ); echo $post_date; */?></span>
						</div>-->
						<div  class="col-ms-12 fl style_content_news_main">

							<?php  echo excerpt(50); ?>
						</div>
						<div  class="col-ms-12 fl style_news_read_more">
							<a href="<?php the_permalink(); ?>">READ MORE</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 no-padding style_content_get_news_display2">
					<div  class=" fl style_content_get_news">
						<div  class="col-ms-12 fl style_image_news">
							<?php the_post_thumbnail();?>
						</div>
					</div>
				</div>
			</div>

		<?php
		}
		$i++;
		}
		}
		wp_reset_postdata();
		?>

		<div id="ajax_posts_f" class="row">
			<input type="hidden" class="ajax_posts_f_page" value="2">
			<input type="hidden" class="ajax_posts_f_i" value="<?php echo $i;?>">
		</div>
		</div>
	</div>
	<?php
	$myvariable = ob_get_clean();
	return $myvariable;
}

//Short Code Slider Home
add_shortcode( 'our_sliderhome', 'our_sliderhome_func' );
function our_sliderhome_func($atts,$args) {
	ob_start();
	$title = isset($args['title']) ? $args['title'] : '';
	$atts = shortcode_atts( array(
		'number_posts' => 10,
		'post_type' => 'sliderhome',
		), $atts, 'sliderhome' );

    $args = ( array(
        'post_type' => $atts['post_type'],
		'posts_per_page' => $atts['number_posts'],
		'orderby' => 'title',
		'order' => 'ASC'
    ) );

	$query = new WP_Query($args);?>
	<div class="slhome">
	<div id="myCarousel1" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2000">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	<?php
	if ($query->have_posts()) {
		$arr_project = array();
		while ($query->have_posts()) {
		$query->the_post();?>
		<?php
		$id = get_field('id_project');
		$arr_project[]= array('id' => $id);
		?>
	  <div id="myCarousel<?php echo get_the_ID(); ?>" class="item item-fix1">
	    <div class="img_slhome fl_r col-lg-20ths col-xs-12 no-padding glr-right color-white">
			<?php the_post_thumbnail('shapely-full');?>
			<div class="slhome_des col-xs-5"><a data-toggle="modal" data-target="#mymodal_<?php the_field('id_project');?>" ><?php the_field('description');?></a></div>
		</div>
		<div class="wpb_column vc_column_container col-lg-5ths item-center-fix2">
			<div class="vc_column-inner no-padding center-fix-item text-left">
				<!-- <h4><a href="#"><?php the_title();?></a></h4> -->
			</div>
		</div>
      </div>

		<?php
		}
	}?>
	<div class="btn-slider hsu-slider-styling slhomebt">
		<a class="leftbt" href="#myCarousel1" data-slide="prev">
		  <span class="glyphicon glyphicon-chevron-left"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="rightbt" href="#myCarousel1" data-slide="next">
		  <span class="glyphicon glyphicon-chevron-right"></span>
		  <span class="sr-only">Next</span>
		</a>

	</div>

	</div>
	<div class="slhome_list slhome_list_sliderhome left_0 col-lg-5ths">
		<h4><a href="/?page_id=1101">KEY SERVICES</a></h4>
		<script>
			setTimeout(function(){
				jQuery(".carousel-indicators li a").on("click",function(){
					var url = jQuery(this).attr('href');
					jQuery(location).attr('href',url);
				});
			}, 0);

		</script>
		<div class="dot-slider">
			<ol class="carousel1-indicators">

				<?php

				$args2 = ( array(
					'post_type' => 'sliderhome',
					'posts_per_page' => 10,
					'orderby' => 'title',
					'order' => 'ASC'
				) );
				$i=0;
				$query2 = new WP_Query($args2);
				if ($query2->have_posts()) {
				while ($query2->have_posts()) {
				$query2->the_post();?>
					<li  data-slide-to="<?php echo $i;?>"
						class="slhome_title_sliderhome slhome_title slhp_<?php the_field('data_slide');?>">
						<?php
						$post_slug = get_post_field( 'post_name', get_post() );
						// var_dump($post_slug);

						$link = '/?page_id=1101/#'.$post_slug ;
						?>
						<a href="<?php echo $link; ?>"><?php the_title();?></a>
					</li>
				<?php $i++;
				}
				wp_reset_postdata();
				}?>
			</ol>
			<div class="sliderhome_75370" >
				<img src="<?php echo bloginfo('template_directory'); ?>/inc/img/maps.png" alt="sliderhome">
			</div>
		</div>
	</div>

  </div>
   <?php
	foreach($arr_project as $item){
		$project_id = $item['id'];
		$image_popup = get_field('image_popup', $project_id);
		$popup_image = $image_popup['url'];
	?>

  <div class="modal fade project-modal" id="mymodal_<?php echo $project_id;?>" role="dialog">
    <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					</div>
					<div class="modal-body">
						<div class="modal_body_fix col-md-12 p_l_r_0">
							<div class="col-md-6 p_l_r_0 p_relative">
								<div class="project-img1">
								<?php
								if($popup_image != ''){ ?>
									<img src="<?php echo $popup_image;?>" />
								<?php
								}
								else{ ?>
									<a class = "style_image_thumbnail" href="#"><?php echo get_the_post_thumbnail($project_id);?></a>
								<?php
								}
								?>
								</div>
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
										$terms = get_the_terms( $project_id, 'project_services' );

										if ( $terms && ! is_wp_error( $terms ) ) :

											$draught_links = array();

											foreach ( $terms as $term ) {?>
												<a href="<?php the_field('link','project_services_'. $term->term_taxonomy_id);?>"><?php echo $term->name;?></a>
											<?php }
											?>


										<?php endif; ?></div>
										<div class="post-excerpt-fix-popup hiden-xs"><?php echo get_post_field('post_content', $project_id); ?></div>

									</div>

									<div class="project-info1">
										<div class="project_info1_ok11">
											<p>RELATED PROJECTS</p>
										</div>
										<?php
										$terms = get_the_terms( $project_id, 'project_services' );
										// print_r( $terms );
										foreach($terms as $term) {
											$id2 = $term->term_id;
											$args1 = array(
											'post_type' => 'projects',
											'posts_per_page' => 3,
											'tax_query' => array(
												array(
													'taxonomy' => 'project_services',
													'field' => 'id',
													'terms' => $id2
													)
												)
											);
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
										<?php } ?>
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
	<?php } ?>
  <style type="text/css">
  	.text_yellow{
  		color: #f1ac08;
  	}
  </style>
  <script>
    jQuery(document).ready(function(){

    	jQuery(".item-fix1:first").addClass("active");
		jQuery('.slhome_title').click(function(){
			jQuery(".slhome_title").toggleClass('text_yellow');
	});

});
  </script>



	</div>
	<?php
$myvariable = ob_get_clean();
	return $myvariable;
}

