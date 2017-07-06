<?php 
add_shortcode( 'services_short', 'services_shortcode' );
function services_shortcode($atts, $content) {
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
		'post_type' => 'services',					
		), $atts, 'services_short' );		
	$args2 = array(
	'posts_per_page'   => $atts['number_posts'],
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'post_type'        => $atts['post_type'],
	'post_status'      => 'publish',
	'paged'    => $paged,
	);
	// var_dump($atts['post_type']);
	$posts_array2 = new WP_Query( $args2 );
	var_dump($posts_array2->request);
	// echo "<pre>";
	// var_dump($posts_array);
	global $post;?>
	<div class="m_st_20_bul_p">
		<div id="news_load2">
		<?php
		$i=0;
		if ( $posts_array2->have_posts() ) { 
		while ( $posts_array2->have_posts() ) { 
		$posts_array2->the_post(); 
		
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
			<input type="hidden" class="ajax_posts_f_se_page" value="2">
			<input type="hidden" class="ajax_posts_f_se_i" value="<?php echo $i;?>">
		</div>
		</div>
		<div  class="col-ms-12 fl style_news_read_more t_c">
			<a id="read_more_services" href="javascript:void(0);">SEE MORE</a>
		</div>
		<script type="text/javascript">
			jQuery(document).ready( function($) {
			var ajaxUrl2 = "<?php echo admin_url('admin-ajax.php')?>";
			$("#read_more_services").on("click", function() {
			var paged = $('.ajax_posts_f_page_se').last().val();
			var post_type = '<?php echo $atts['post_type']?>';
			var i = $('.ajax_posts_f_se_i').last().val();
			// var paged = $('.ajax_posts_f_page').last().val();
			$.post(ajaxUrl2, {
				action: "load_more_services_ajax",
				paged : paged,
				post_type : post_type,
				i : i,
				},'html')
				.success(function(posts15) {
				
				$("#news_load2").append(posts15);			
				});
			});	
			});			
		</script>
	</div>
	<?php
	$myvariable = ob_get_clean();
	return $myvariable;
}
