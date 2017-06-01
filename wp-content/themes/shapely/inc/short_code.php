<?php
/*================ expertise short code=================*/
function product_shortcode($args, $content) {
	
	ob_start();
	$args = array( 'post_type' => 'expertise', 'posts_per_page' => 8 );
	$loop = new WP_Query( $args );?>
	<div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix">
	<div class="vc_column-inner no-padding center-fix-item">
		<h4>OUR EXPERTISE</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
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
	
	ob_start();
	$args = array( 'post_type' => 'post', 'posts_per_page' => 8 );
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
		<h4>LATEST NEWS</h4>
		
		<a href="#" target="_blank" class="icon-see" rel="noopener noreferrer">&rarr;</a>
		<div class="btn-see">
			<a href="#" target="_blank" rel="noopener noreferrer">SEE MORE</a>
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
function sectors_shortcode($args, $content) {
	
	ob_start();
	$args = array( 'post_type' => 'sectors', 'posts_per_page' => 8 );
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
			<h4>OUR EXPERTISE</h4>
			<a class="title-yellow" href="<?php the_permalink();?>"><?php the_title();?></a>
			<?php the_excerpt();?>
			<p>The Hidden Mystery Behind FYFE</p>
			<a href="#" target="_blank" class="icon-see" rel="noopener noreferrer">&rarr;</a>
			
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
	
	ob_start();
	?>
	
	<div id="category-post-content" class="col-lg-20ths col-xs-12 no-padding">
	<?php 
	$args = array( 'post_type' => 'projects', 'posts_per_page' => 8 );
	$loop = new WP_Query( $args );	
	?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
	<div class="col-md-3 col-xs-6 no-padding color-white project-item">
			<div class="project-img">
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
			</div>
			<div class="project-info">
				<div class="btn-see list-cat-fix"><?php the_terms( get_the_ID(), 'project_cat', '', '' );  ?></div>
				<div class="title-post-fix"><h5><button data-toggle="modal" data-target="#myModal<?php echo get_the_ID();?>"><?php the_title();?></button></h5></div>
				<div class="post-excerpt-fix hiden-xs"><?php the_excerpt();?></div>
				<div id="myModal<?php echo get_the_ID();?>" class="modal fade" role="dialog">
				  <div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modal Header</h4>
					  </div>
					  <div class="modal-body">
						<p><?php the_title();?></p>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
	<div class="vc_column-inner no-padding center-fix-item">
		<h4>OUR PROJECTS</h4>
		<a href="#" target="_blank" class="icon-see" rel="noopener noreferrer">&larr;</a>
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
			<a class="see-a" href="#">SEE MORE</a>
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
	
	ob_start();
	?>
	<div class="wpb_column vc_column_container col-lg-5ths text-center item-center-fix">
		<div class="vc_column-inner no-padding center-fix-item">
			<h4 class="teams-title">TEAM MEMBERS</h4>
				
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
			$args = array( 'post_type' => 'teams', 'posts_per_page' => 9 );
			$loop = new WP_Query( $args );	
		?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
		<div class="col-lg-5ths col-xs-6 no-padding color-white project-item">
			<div class="teams-img">
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
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
	<div class="col-lg-5ths col-xs-6 no-padding ">
	<h4>CONTACT US</h4>
	<?php 
		echo do_shortcode('[contact-form-7 id="171" title="Contact Form"]'); 
	?>
	</div>
	
	<div class="col-md-4 col-xs-6 no-padding bg-yellow ">
		<?php 
				$args = array( 'post_type' => 'location', 'posts_per_page' => -1 );
				$loop = new WP_Query( $args );	
		?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
		<li data-value="value <?php echo get_the_ID(); ?>" id="cat-<?php echo get_the_ID(); ?>"><a class=" ajax" onclick="location_ajax_get('<?php echo get_the_ID(); ?>');" href="javascrip:void(0)"><?php the_title();?></a></li>
		<?php  endwhile;?>
		<?php wp_reset_query(); ?>
	<div id="location-content">
		<?php 
			$args = array( 'post_type' => 'location', 'posts_per_page' => 1 );
			$loop = new WP_Query( $args );	
		?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>
		<?php the_title();?>
		<?php the_content();?>
		<?php  endwhile;?>
		<?php wp_reset_query(); ?>
	</div>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'contact', 'contact_shortcode' );