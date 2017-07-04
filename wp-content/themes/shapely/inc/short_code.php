<?php
/*================ expertise short code=================*/
function product_shortcode($args, $content) {
	$title = $args['title'] ;
	$des = $args['des'] ;
	ob_start();
	$args = array( 'post_type' => 'expertise', 'posts_per_page' => 12 );
	$loop = new WP_Query( $args );?>
	<div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix">
	<div class="vc_column-inner no-padding center-fix-item expertise_p_t_h4">
		<h4><?php echo $title;?></h4>
		<p><?php echo $des;?></p>
	</div>
	</div>
	<div class="col-lg-20ths col-xs-12 no-padding glr-right">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
	<div class="col-md-3 col-xs-6 no-padding text-center height-fix">
		<div class='img-hover-fix'><?php the_post_thumbnail();?></div>
		<div class="title-hover"><h3><?php the_title();?></h3></div>
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
	$des = $args['des'] ;
	ob_start();
	$args = array( 'post_type' => 'post', 'posts_per_page' => 1,'orderby'  => 'date', 'order'  => 'ASC', );
	$loop = new WP_Query( $args );?>
	
	<div class="col-lg-20ths col-xs-12 no-padding glr-right color-white">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
	<div class="no-padding full-width-fix">
		<div class='img-post-fix'><?php the_post_thumbnail();?></div>
		<div class="info-fix">
			<div class="btn-see"><?php the_category( $separator, $parents, $post_id ); ?> </div>
			<div class="title-post-fix"><h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4></div>
			<div class="post-excerpt-fix hiden-xs"><?php the_excerpt();?></div>
			<a class="see-more  hiden-xs"href="<?php the_permalink();?>">SEE MORE</a>
		</div>
		
	</div>
<?php  endwhile;?>
</div>
<div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix">
	<div class="vc_column-inner no-padding center-fix-item">
		<h4><?php echo $title;?></h4>
		
		<a href="/?page_id=791" target="_blank" class="icon-see" rel="noopener noreferrer">&rarr;</a>
		<div class="btn-see">
			<a href="/?page_id=791" target="_blank" rel="noopener noreferrer">SEE MORE</a>
		</div>
	</div>
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
	$atts = shortcode_atts( array(
		'number_posts' => 8,
		'post_type' => 'sectors',
		), $atts, 'sectors' );
	
    $args = ( array(
        'post_type' => $atts['post_type'],
		'posts_per_page' => $atts['number_posts'],
		'order' => 'ASC'
    ) );

	$query = new WP_Query($args);?>
	<div class="slhome"> 
		<div id="myCarousel2" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
   
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	<?php
	if ($query->have_posts()) { 
		while ($query->have_posts()) { 
		$query->the_post();?>

	  <div id="myCarousel<?php echo get_the_ID(); ?>" class="item item-fix2">
        <div class="img_slhome col-lg-20ths col-xs-12 no-padding glr-right color-white">
			<?php the_post_thumbnail('shapely-full');?>
			<div class="slhome_des col-xs-5"><?php the_field('description');?></div>
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
	<div class="btn-slider slhomebt">
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
	<div class="slhome_list slhome_list_sectors1 sectors1 col-lg-5ths">
		<h4><a href="/?page_id=789">OUR SECTORS</a></h4>
					<div class="dot-slider">
					<ol class="">

		<?php 

		$args2 = ( array(
	        'post_type' => 'sectors',
			'posts_per_page' =>8,
			'order' => 'ASC'
	    ) );
		$i=1;
	    $query2 = new WP_Query($args2);
	    if ($query2->have_posts()) { 
		while ($query2->have_posts()) { 
		$query2->the_post();?>

			<li data-target="#myCarousel2" data-slide-to="<?php the_field('data_slider');?>" class="slhome_title slhome_title_sector slhp_<?php the_field('data_slider');?> <?php if($i==1){echo 'current';}?>"><b><?php the_title();?></b></li>
			<script>
					jQuery('.slhome_title_sector.slhp_<?php the_field('data_slider');?>').on("click", function() {
						jQuery(".slhome_list_sectors1 li").removeClass("current");
						jQuery(".slhome_title_sector.slhp_<?php the_field('data_slider');?>").addClass("current");
					});
			</script>
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
	
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
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
	
	<div id="category-post-content" class="col-lg-20ths col-xs-12 no-padding">
	<?php 
	$args = array( 'post_type' => 'projects', 'posts_per_page' => 8 );
	$loop = new WP_Query( $args );	
	?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
		<?php $terms  = get_the_terms( get_the_ID(), 'project_cat', '', '' );  ?>
		<div class="col-md-3 col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
			<div  class="project-img project-img--square">
			<a href="javascript:void(0);"><?php the_post_thumbnail();?></a>
			</div>
			<div class="project-info">
				<?php foreach($terms as $value ){?>
					<div class="btn-see btn_see_fix"><a><?php echo $value->name;?></a></div>
				<?php } ?>
				<div class="title-post-fix"><h5><button type="button" class="btn btn-info btn-lg"><?php the_title();?></button>
				</h5></div>
			</div>
		</div>
		
		<div class="<?php echo get_the_ID();?> modal fade" role="dialog">
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
								<a class = "style_image_thumbnail" href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
							<?php	
							}
							?>	
							</div>
							<div class="project_img1_2">
							</div>
						</div>
						<div class="col-md-6  p_l_r_0 color-white p_relative">
							<div class="p_l_t_30">
								<div class="btn-see list-cat-fix"><?php the_terms( get_the_ID(), 'project_cat', '', '' );  ?></div>
								<div class="project-info1">
									<div class="project-info1_ok">
										<a href="<?php the_permalink();?>"><?php the_title();?></a>
									</div>
									<div class="post-excerpt-fix-popup hiden-xs"><?php the_excerpt();?></div>
									
								</div>
								<div class="project_info_bottom">
									<div class="col-md-6 p_l_r_0 project_info_bottom1_6">
										<div class="project_info1_a_share">
											<p>SHARE</p>
											<?php echo do_shortcode( "[simple-social-share]" ); ?>
										</div>
									</div>
									<div class="col-md-6 p_l_r_0 project_info_bottom2_6">
										<div class="project_info1_a_work">
											<a href="#">WORK WITH US</a>
											
										</div>
									</div>
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
											<div class="col-md-3 ">
												<div class="project_img1_ok_col_3">
													<div class="project_img1_ok">
														<a href="javascript:void(0);"><?php the_post_thumbnail();?></a>
													</div>
													<div class="project_info1_a_title">
														<a href="javascript:void(0);"><?php the_title();?></a>
													</div>
												</div>
											</div>
										<?php  endwhile;?>
										<div class="col-md-3">
											<div class="project_info1_a_see_more">
												<a href="javascript:void(0);">See more</a>
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
		</div>
	 <?php  endwhile;?>

	 <?php wp_reset_query(); ?>
	</div>
	
	<div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix">
		<div class="vc_column-inner no-padding center-fix-item p_relative">
			<h4><?php echo $title;?></h4>
			<a href="/?page_id=1052" target="_blank" class="icon-see" rel="noopener noreferrer">&larr;</a>
			<?php $categories = get_categories(); ?>
				
				<?php
				// your taxonomy name
				$tax = 'project_cat';

				// get the terms of taxonomy
				$terms = get_terms( $tax, $args = array(
				  'hide_empty' => false, // do not hide empty terms
				));
				
				echo '<ul id="category-menu" class="list-unstyled"> <li class="init">ALL</li>';
				// loop through all terms
				foreach( $terms as $term ) {

					// Get the term link
					$term_link = get_term_link( $term );

					if( $term->count !== 0 )
						?>
						<li><a class="<?php echo $term->slug; ?> ajax" onclick="cat_ajax_get('<?php echo $term->term_id; ?>');" href="javascrip:void(0)"><?php echo $term->name; ?></a></li>
						<?php
				}
				echo '</ul>';
				?>
				<a class="see-a" href="/?page_id=1052">SEE MORE</a>
		</div>
	</div>
	
	 

<?php wp_reset_query(); ?>
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
				
				<?php
				// your taxonomy name
				$tax = 'teams_cat';

				// get the terms of taxonomy
				$terms = get_terms( $tax, $args = array(
				  'hide_empty' => false, // do not hide empty terms
				));
				
				echo '<ul id="category-menu2" class="list-unstyled2"> <li class="init2">FILTER BY SECTOR</li>';
				// loop through all terms
				foreach( $terms as $term ) {

					// Get the term link
					$term_link = get_term_link( $term );

					if( $term->count !== 0 )
						?>
						<li data-value="value <?php echo $term->term_id; ?>" id="cat-<?php echo $term->term_id; ?>"><a class="<?php echo $term->slug; ?> ajax" onclick="team_ajax_get('<?php echo $term->term_id; ?>');" href="javascrip:void(0)">FILTER BY <?php echo $term->name; ?></a></li>
						<?php
				}
				echo '</ul>';
				?>
				<a class="see-a see-a-teams" href="#">SEE MORE</a>
		</div>
	</div>
	<div id="teams-post-content">
		<?php 
			$args = array( 'post_type' => 'teams', 'posts_per_page' => 9, 'orderby' => 'date', 'order' => 'ASC' );
			$loop = new WP_Query( $args );	
		?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
		<?php $terms  = get_the_terms( get_the_ID(), 'teams_cat', '', '' );  ?>
		<div class="col-lg-5ths col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
			<div class="teams-img">
			<a href="javascript:void(0);"><?php the_post_thumbnail();?></a>
			</div>
			<div class="project-info">
				<?php foreach($terms as $value ){?>
					<div class="btn-see btn_see_fix"><a><?php echo $value->name;?></a></div>
				<?php } ?>
				<div class="title-post-fix"><h5>
				<button type="button" class="btn btn-info btn-lg"><?php the_title();?></button>
					</h5>
				</div>
			</div>
		</div>
		<div class="<?php echo get_the_ID();?> modal fade" role="dialog">
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
								<a class = "style_image_thumbnail" href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
							<?php	
							}
							?>	
							</div>
							<div class="project_img1_2">
							</div>
						</div>
						<div class="col-md-6  p_l_r_0 color-white p_relative">
							<div class="p_l_t_30">
								<?php 
								$status = get_field('status') ;
								$location = get_field('location') ;
								
								?>
								<div class="project-info1_ok project_info1_ok_100">
									<h6><?php the_title();?></h6><span><?php echo $location;?></span>
								</div>
								<div class="project-info1">
									<div class="project-info1_ok">
										<a href="<?php the_permalink();?>"><?php echo $status;?></a>
									</div>
									<div class="post-excerpt-fix-popup hiden-xs"><?php the_excerpt();?></div>
									
								</div>
								<div class="project_info_bottom">
									<div class="col-md-6 p_l_r_0 project_info_bottom1_6">
										<div class="project_info1_a_share">
											<p>SHARE</p>
											<?php echo do_shortcode( "[simple-social-share]" ); ?>
										</div>
									</div>
									<div class="col-md-6 p_l_r_0 project_info_bottom2_6">
										<div class="project_info1_a_work">
											<a href="#">WORK WITH US</a>
											
										</div>
									</div>
								</div>
								<div class="project-info1">
									<div class="project_info1_ok11">
										<p>PAST PROJECTS</p>
									</div>
									<?php 
										$id = get_the_ID();
										$args1 = array( 'post_type' => 'projects', 'posts_per_page' =>3, 'post__not_in'=> array( $id) );
										$loop1 = new WP_Query( $args1 );	
									?>
									<div class="project_info1_ok1">
										<?php while ( $loop1->have_posts() ) : $loop1->the_post(); global $product1;?>
											<div class="col-md-3 ">
												<div class="project_img1_ok_col_3">
													<div class="project_img1_ok">
														<a href="javascript:void(0);"><?php the_post_thumbnail();?></a>
													</div>
													<div class="project_info1_a_title">
														<a href="javascript:void(0);"><?php the_title();?></a>
													</div>
												</div>
											</div>
										<?php  endwhile;?>
										<div class="col-md-3">
											<div class="project_info1_a_see_more">
												<a href="javascript:void(0);">See more</a>
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
	<div class="col-md-6 col-xs-5ths_ff col-xs-6 no-padding style_home_fyfe_contact_form ">
		<h4>CONTACT US</h4>
		<?php 
			echo do_shortcode('[contact-form-7 id="171" title="Contact Form"]'); 
		?>
	</div>
	
	<div class="col-md-3 col-xs-7ths_ff col-xs-6 no-padding bg-yellow ">
		<div id="location-content">
			<?php 
			$args2 = array( 'post_type' => 'locations', 'posts_per_page' => -1 );
			$loop2 = new WP_Query( $args2 );
			
			?>
			<div id="location-content_title">
				<?php 
				$i=0;
				$arr_info_main = array();
				while ( $loop2->have_posts() ) : $loop2->the_post(); global $product2;
				$current_cat = "";
				if($i<1){
					$current_cat = 'current_cat';
				}
				$maps_center1 = get_field( "maps" );
				// var_dump($maps_center1);
				// var_dump($maps_center1[lat]);
				// var_dump($maps_center1[lng]);
				?>
					<a id="location_<?php the_ID();?>" class = "location_remove <?php echo $current_cat; ?>" href="javascript:void(0);"><?php the_title();?></a>
					<script type="text/javascript">
						jQuery(document).ready( function($) {
						var ajaxUrl1 = "<?php echo admin_url('admin-ajax.php')?>";
							$("#location_<?php the_ID();?>").on("click", function() {
								$(".id_post_location").val('<?php the_ID();?>');
								$(".location_remove").removeClass("current_cat");
								$("#location_<?php the_ID();?>").addClass("current_cat");
							});	
						});			
					</script>
				<?php
					if( have_rows('location_information') ):
						// loop through the rows of data
						while ( have_rows('location_information') ) : the_row();
							$arr = array();
							// display a sub field value ?>
							<?php
							$location_name = get_sub_field('location_name');
							$information_detail = get_sub_field('information_detail');
							$arr1['name']= $location_name;
							$arr1['information_detail']= $information_detail;
							$maps_child = get_sub_field('maps_child');
							if( !empty($maps_child) ):
								// echo '<a class="lat-item">' . $maps_child['lat'] .' - '; 
								// echo $maps_child['lng'].'</a>';
								$arr1['address']= $maps_child['address'];
								$arr1['lat']= $maps_child['lat'];
								$arr1['lng']= $maps_child['lng'];
							endif;
							$arr_info_main[] = $arr1;
						endwhile;
					else :
						// no rows found

					endif;
				$i++;
				endwhile;
				wp_reset_query();?>
			</div>
			<input type="hidden" class="id_post_location" name="id_post_location" value="">
			<script type="text/javascript">
				jQuery(document).ready( function($) {
						
				});			
			</script>
			<?php $args3 = array( 'post_type' => 'locations', 'posts_per_page' => 1 );
			$loop3 = new WP_Query( $args3 );?>
			<?php $location_item= array ( );?>
			<div id="location-content_main">
			
				<?php 
				$arr_info_center = array() ;
				$arr_info = array() ;
				
				while ( $loop3->have_posts() ) : $loop3->the_post(); global $product3;?>
					<?php
					$name_location = get_field( "name_location" );
					$maps_center = get_field( "maps" );
					$arr_center['address']= $maps_center['address'];
					$arr_center['lat']= $maps_center['lat'];
					$arr_center['lng']= $maps_center['lng'];
					$arr_center['title']= get_the_title();
					$arr_info_center[] = $arr_center;
					
					?>
					<h2><?php echo $name_location;?></h2>
					<?php 
						$id= get_the_ID();
					?>
					<?php
					
					// check if the repeater field has rows of data
					if( have_rows('location_information') ):
						// loop through the rows of data
						while ( have_rows('location_information') ) : the_row();
							$arr = array();
							// display a sub field value ?>
							<h3><?php the_sub_field('location_name');?></h3>
							<?php
							$location_name = get_sub_field('location_name');
							$information_detail = get_sub_field('information_detail');
							$arr['name']= $location_name;
							$arr['information_detail']= $information_detail;
							the_sub_field('information_detail');
							$maps_child = get_sub_field('maps_child');
							if( !empty($maps_child) ):
								// echo '<a class="lat-item">' . $maps_child['lat'] .' - '; 
								// echo $maps_child['lng'].'</a>';
								$arr['address']= $maps_child['address'];
								$arr['lat']= $maps_child['lat'];
								$arr['lng']= $maps_child['lng'];
							endif;
							$arr_info[] = $arr;
						endwhile;
					else :
						// no rows found

					endif;
					
					?>
					
				<?php  endwhile;
					wp_reset_query();
				
			?>
				
				<input type="hidden" class="id_post_location1" name="id_post_location1" value="<?php the_ID();?>">
			</div>
			
		</div>
	</div>
	<?php 
	
	// var_dump($arr_info_center[lat]);
	// echo json_encode($arr_info);
	// $arr_info_json = json_encode($arr_info);
	?>
	<div class="col-md-3 no-padding">
	<div id="map"  style="width: 100%; height: 630px;"></div>
	<input type="hidden" id="result" value="">
	
	<script>
	function initMap() {

        var uluru = {lat: <?php echo $arr_info_center[0][lat];?>, lng: <?php echo $arr_info_center[0][lng];?>};
        var map = new google.maps.Map(document.getElementById('map'), {
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
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
		var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h5 id="firstHeading" class="firstHeading"><?php echo $arr_info_center[0][title];?></h5>'+
            '<div id="bodyContent">'+'<?php echo $arr_info_center[0][address];?>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
		marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
		//Khi khoi tao xong map day la funtion de load may marker va  in len bang do(map)
		
		//Khoi tao ban dau neu chua co ajax load click
		var arr_info_json = <?php echo json_encode($arr_info_main);?>;
		setMarkers(map,arr_info_json);
		
		//bat su kien khi co ajax load
		var ajaxUrl1 = "<?php echo admin_url('admin-ajax.php')?>";
		jQuery(".location_remove").on("click", function() {
			var id_post_location = jQuery('.id_post_location').val();
			// console.log(id_post_location);
			
			jQuery.post(ajaxUrl1, {
						action: "location_ajax",
						id_post_location : id_post_location,
						},'json')
			.success(function(data) {
						var data_json = JSON.parse(data);
						jQuery("#location-content_main").html("");
						jQuery("#location-content_main").html(data_json.html);
						setMarkers(map,data_json.arr);
						
						
			});	
					
		});
		
		
	}
	
	function setMarkers(map,arr_info_json) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
          url: 'http://fyfe-project.sunbeardigital.com/wp-content/uploads/2017/04/marker.png',
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
					
		var marker = [];
		// alert("go go"+arr_info_json.length);
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
					
			google.maps.event.addListener(marker[i], 'click', function() {
				if (!this.getMap()._infoWindow) {
					this.getMap()._infoWindow = new google.maps.InfoWindow();
				}
				
			this.getMap()._infoWindow.close();
			this.getMap()._infoWindow.setContent(this.data);
			this.getMap()._infoWindow.open(this.getMap(), this);
			});				
		}
	
	
		
	}
	 
	window.onload = initMap;
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWerbOyH_bpvHxMOokfcP8L5ClwqD2xY4&callback=initMap">
    </script>
	</div>
	<?php
	// echo json_encode($arr_info);
	// echo json_encode($arr_info_main);
	// var_dump($arr_info);
	// var_dump($arr_info_main);
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
		'number_posts' => 3,
		'post_type' => 'sectors',					
		), $atts, 'sectors_news' );		
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
		$news_taxonomy = get_the_terms( get_the_ID(), 'sectors_cat', '', '' );  
		// var_dump($news_taxonomy);
		$news_taxonomy_link = get_term_link($news_taxonomy[0]->term_id, 'sectors_cat' );
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
			var i = $('.ajax_posts_f_i').last().val();
			// var paged = $('.ajax_posts_f_page').last().val();
			$.post(ajaxUrl1, {
				action: "load_more_sectors_ajax",
				paged : paged,
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

//Short Code Slider Home
add_shortcode( 'our_sliderhome', 'our_sliderhome_func' );
function our_sliderhome_func($atts) {
	ob_start();
	$atts = shortcode_atts( array(
		'number_posts' => 10,
		'post_type' => 'sliderhome',
		), $atts, 'sliderhome' );
	
    $args = ( array(
        'post_type' => $atts['post_type'],
		'posts_per_page' => $atts['number_posts'],
		'order' => 'ASC'
    ) );

	$query = new WP_Query($args);?>
	<div class="slhome"> 
		<div id="myCarousel1" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
   
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	<?php
	if ($query->have_posts()) { 
		while ($query->have_posts()) { 
		$query->the_post();?>

	  <div id="myCarousel<?php echo get_the_ID(); ?>" class="item item-fix1">
        <div class="img_slhome fl_r col-lg-20ths col-xs-12 no-padding glr-right color-white">
			<?php the_post_thumbnail('shapely-full');?>
			<div class="slhome_des col-xs-5"><?php the_field('description');?></div>
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
	<div class="btn-slider right_34 slhomebt">
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
		<div class="dot-slider">
			<ol class="">
				<?php 

				$args2 = ( array(
					'post_type' => 'sliderhome',
					'posts_per_page' =>10,
					'order' => 'ASC'
				) );
				$i=1;
				$query2 = new WP_Query($args2);
				if ($query2->have_posts()) { 
				while ($query2->have_posts()) { 
				$query2->the_post();?>
					<li data-target="#myCarousel1" data-slide-to="<?php the_field('data_slide');?>" class="margin_l_1o5 slhome_title_sliderhome slhome_title slhp_<?php the_field('data_slide');?> <?php if($i==1){echo 'current';}?>"><b><?php the_title();?></b></li>
					<script>
					jQuery('.slhome_title_sliderhome.slhp_<?php the_field('data_slide');?>').on("click", function() {
						jQuery(".slhome_list_sliderhome li").removeClass("current");
						jQuery(".slhome_title_sliderhome.slhp_<?php the_field('data_slide');?>").addClass("current");
					});
					</script>
				<?php $i++;
				}
				wp_reset_postdata();
				}?>
			</ol>
			<div class="sliderhome_75370" >
				<img src="http://fyfe-project.sunbeardigital.com/wp-content/uploads/2017/04/75370-200.png" alt="sliderhome">
			</div>
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

