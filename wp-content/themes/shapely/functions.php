<?php

/**
 * Shapely functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shapely
 */
if ( ! function_exists( 'shapely_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shapely_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Shapely, use a find and replace
		 * to change 'shapely' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shapely', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add support for the custom logo functionality
		 */
		add_theme_support( 'custom-logo', array(
			'height'     => 55,
			'width'      => 135,
			'flex-width' => true,
		) );

		add_theme_support( 'custom-header', apply_filters( 'shapely_custom_header_args', array(
			'default-image'      => '',
			'default-text-color' => '000000',
			'width'              => 1900,
			'height'             => 225,
			'flex-width'         => true
		) ) );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			                    'primary'     => esc_html__( 'Primary', 'shapely' ),
			                    'social-menu' => esc_html__( 'Social Menu', 'shapely' ),
		                    ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shapely_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'shapely-full', 1110, 530, true );
		add_image_size( 'shapely-featured', 730, 350, true );
		add_image_size( 'shapely-grid', 350, 300, true );
		add_image_size( 'people-vertical', 400, 599, true );
		add_image_size( 'people-thumb', 450, 450, true );


		add_theme_support( 'customize-selective-refresh-widgets' );
		// Welcome screen
		if ( is_admin() ) {
			global $shapely_required_actions, $shapely_recommended_plugins;

			$shapely_recommended_plugins = array(
				'wordpress-seo'          => array( 'recommended' => true ),
				'fancybox-for-wordpress' => array( 'recommended' => false ),
			);

			/*
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 *
			 */
			$path = WPMU_PLUGIN_DIR . '/shapely-companion/inc/views/shapely-demo-content.php';
			if ( ! file_exists( $path ) ) {
				$path = WP_PLUGIN_DIR . '/shapely-companion/inc/views/shapely-demo-content.php';
				if ( ! file_exists( $path ) ) {
					$path = false;
				}
			}

			$shapely_required_actions = array(
				array(
					"id"          => 'shapely-req-ac-install-companion-plugin',
					"title"       => Shapely_Notify_System::shapely_companion_title(),
					"description" => Shapely_Notify_System::shapely_companion_description(),
					"check"       => Shapely_Notify_System::shapely_has_plugin( 'shapely-companion' ),
					"plugin_slug" => 'shapely-companion'
				),
				array(
					"id"          => 'shapely-req-ac-install-wp-jetpack-plugin',
					"title"       => Shapely_Notify_System::shapely_jetpack_title(),
					"description" => Shapely_Notify_System::shapely_jetpack_description(),
					"check"       => Shapely_Notify_System::shapely_has_plugin( 'jetpack' ),
					"plugin_slug" => 'jetpack'
				),
				array(
					"id"       => 'shapely-req-import-content',
					"title"    => esc_html__( 'Import content', 'shapely' ),
					"external" => $path,
					"check"    => Shapely_Notify_System::shapely_check_import_req(),
				),

			);

			require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
		}
	}
endif;
add_action( 'after_setup_theme', 'shapely_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shapely_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'shapely_content_width', 1140 );
}

add_action( 'after_setup_theme', 'shapely_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shapely_widgets_init() {
	register_sidebar( array(
		                  'id'            => 'sidebar-1',
		                  'name'          => esc_html__( 'Sidebar', 'shapely' ),
		                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
		                  'after_widget'  => '</div>',
		                  'before_title'  => '<h2 class="widget-title">',
		                  'after_title'   => '</h2>',
	                  ) );

	register_sidebar( array(
		                  'id'            => 'sidebar-home',
		                  'name'          => esc_html__( 'Homepage', 'shapely' ),
		                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
		                  'after_widget'  => '</div>',
		                  'before_title'  => '<h2 class="widget-title">',
		                  'after_title'   => '</h2>',
	                  ) );

	for ( $i = 1; $i < 5; $i ++ ) {
		register_sidebar( array(
			                  'id'            => 'footer-widget-' . $i,
			                  'name'          => sprintf( esc_html__( 'Footer Widget %s', 'shapely' ), $i ),
			                  'description'   => esc_html__( 'Used for footer widget area', 'shapely' ),
			                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
			                  'after_widget'  => '</div>',
			                  'before_title'  => '<h2 class="widget-title">',
			                  'after_title'   => '</h2>',
		                  ) );
	}

}

add_action( 'widgets_init', 'shapely_widgets_init' );

/**
 * Hides the custom post template for pages on WordPress 4.6 and older
 *
 * @param array $post_templates Array of page templates. Keys are filenames, values are translated names.
 *
 * @return array Filtered array of page templates.
 */
function shapely_exclude_page_templates( $post_templates ) {

	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		unset( $post_templates['page-templates/full-width.php'] );
		unset( $post_templates['page-templates/no-sidebar.php'] );
		unset( $post_templates['page-templates/sidebar-left.php'] );
		unset( $post_templates['page-templates/sidebar-right.php'] );
	}

	return $post_templates;
}

add_filter( 'theme_page_templates', 'shapely_exclude_page_templates' );

/**
 * Enqueue scripts and styles.
 */
function shapely_scripts() {
	// Add Bootstrap default CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );

	// Add Font Awesome stylesheet
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css' );

	// Add Google Fonts

	// Add slider CSS
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/inc/css/flexslider.css' );

	//Add custom theme css
	wp_enqueue_style( 'shapely-style', get_stylesheet_uri() );

	wp_enqueue_script( 'shapely-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'shapely-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	if ( post_type_exists( 'jetpack-portfolio' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	// Add slider JS
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/flexslider.min.js', array( 'jquery' ), '20160222', true );

	if ( is_page_template( 'page-templates/template-home.php' ) ) {
		wp_enqueue_script( 'shapely-parallax', get_template_directory_uri() . '/js/parallax.min.js', array( 'jquery' ), '20160115', true );
	}
	/**
	 * OwlCarousel Library
	 */
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js', array( 'jquery' ), '20160115', true );
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.css' );
	wp_enqueue_style( 'owl.carousel.theme', get_template_directory_uri() . '/js/owl-carousel/owl.theme.default.css' );
	wp_enqueue_style('app.css', get_template_directory_uri() . '/css/app.css');

	wp_enqueue_script( 'shapely-scripts', get_template_directory_uri() . '/js/shapely-scripts.js', array( 'jquery' ), '20160115', true );

	wp_enqueue_script('jquery.jscroll', get_template_directory_uri() . '/js/jquery.jscroll.js', array( 'jquery' ), '1', true );
	wp_enqueue_script('waypoints4', '//cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js', array( 'jquery' ), '4.0.1', true );
	wp_enqueue_script('waypoints4-infinite', '//cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/shortcuts/infinite.min.js', array( 'jquery' ), '4.0.1', true );

	wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), '1', true );
}

add_action( 'wp_enqueue_scripts', 'shapely_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Add custom section
 */
require get_template_directory() . '/inc/shapely-documentation/class-customize.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/navwalker.php';

/**
 * Load Social Navition
 */
require get_template_directory() . '/inc/socialnav.php';

/**
 * Load related posts
 */
require get_template_directory() . '/inc/class-shapely-related-posts.php';

/**
 * Load the system checks ( used for notifications )
 */
require get_template_directory() . '/inc/admin/welcome-screen/notify-system-checks.php';
require get_template_directory() . '/inc/post_type.php';
require get_template_directory() . '/inc/short_code.php';
/*=======ACF API maps=======*/
function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyDhr1EtZA15BSPMHKFwskp5SJqTfdvzx0U');
}

add_action('acf/init', 'my_acf_init');

add_action( 'wp_ajax_nopriv_load-filter', 'prefix_load_cat_posts' );
add_action( 'wp_ajax_load-filter', 'prefix_load_cat_posts' );
function prefix_load_cat_posts () {
    $cat_id = $_POST[ 'cat' ];

	$args = array(
	'post_type' => 'projects',
	'tax_query' => array(
		array(
		'taxonomy' => 'project_cat',
		'field' => 'id',
		'terms' => $cat_id
		 )
	  )
	);
   $the_query = new WP_Query( $args );

    ob_start ();
	if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();?>
		<?php $terms  = get_the_terms( get_the_ID(), 'project_cat', '', '' );  ?>
		<div class="col-md-3 col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
			<div  class="project-img project-img--square 1">
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
							<div class="project-img1 3">
							<?php $image_popup = get_field('image_popup') ;
							if($image_popup !=''){ ?>
								<img src="<?php echo $image_popup['url'];?>" />
							<?php
							}
							else{ ?>
								<a class = "style_image_thumbnail" href=""><?php the_post_thumbnail();?></a>
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
									<div class="btn-see list-cat-fix list-cat-fix2 111">
									<?php
										$terms = get_the_terms( get_the_ID(), 'project_services' );

										if ( $terms && ! is_wp_error( $terms ) ) :

											$draught_links = array();

											foreach ( $terms as $term ) {?>
											    <?php $button_tax_link=get_field('link','project_services_'. $term->term_taxonomy_id);
												if ($button_tax_link!= ''){ ?>
												<a href="<?php the_field('link','project_services_'. $term->term_taxonomy_id);?>"><?php echo $term->name;?></a>
											<?php } else { ?>
											    	<a href="#" class="disabled-link"><?php echo $term->name;?></a>
											    	
											<?php
											} ?>
											<?php }
											?>


										<?php endif; ?></div>
									<div class="post-excerpt-fix-popup hiden-xs"><?php the_content();?></div>

								</div>
								<div class="project_info_bottom">
									<div class="col-md-6 p_l_r_0 project_info_bottom1_6">
										<div class="project_info1_a_share">
											<p>SHARE</p>
											<?php echo do_shortcode( "[simple-social-share]" ); ?>
										</div>
									</div>
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
															<a href="<?php echo get_permalink(); ?>" class="project-info-btn"><?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?></a>
													</h5>
													</div>
											  </div>
											</span>
										<?php  endwhile;?>
										<div class="col-md-12">
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
	<?php }
	/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		// no posts found
	}

   $response = ob_get_contents();
   ob_end_clean();

   echo $response;
   die(1);
   }

add_action( 'wp_ajax_nopriv_load_cat_teams', 'prefix_load_cat_teams' );
add_action( 'wp_ajax_load_cat_teams', 'prefix_load_cat_teams' );
function prefix_load_cat_teams () {
    $cat_id2 = $_POST[ 'teams_cat' ];

	$args = array(
	'post_type' => 'teams',
	'tax_query' => array(
		array(
		'taxonomy' => 'teams_cat',
		'field' => 'id',
		'terms' => $cat_id2
		 )
	  )
	);
   $the_query = new WP_Query( $args );

    ob_start ();
	if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();?>
		<?php $terms  = get_the_terms( get_the_ID(), 'teams_cat', '', '' );  ?>
		<div class="col-lg-5ths col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
			<div class="teams-img 1">
			<a href="javascript:void(0);"><?php the_post_thumbnail('people-thumb');?></a>
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
								</div>
								<div class="col-md-6  p_l_r_0 color-white p_relative">
								<div class="modal-logo">
									<img src="<?php echo bloginfo('template_directory'); ?>/assets/images/logo.png" class="logo" alt="FYFE">

								</div>
									<div class="p_l_t_30">
										<?php
											$status = get_field('status') ;
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

										<div class="project_info_bottom">
											<div class="col-md-6 p_l_r_0">
												<div class="project_info1_a_share">
													<p>SHARE</p>
													<?php echo do_shortcode( "[simple-social-share]" ); ?>
												</div>
											</div>
										</div>

										<?php
											$past_projects = new WP_Query(array(
											  'post_type' => 'projects',
											  'posts_per_page' =>3,
											  'post__not_in'=> array(get_the_ID())
											));
										?>

										<div class="past-project">
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

											<span class="past-project-see-more project_info1_a_see_more">
												<a href="javascript:void(0);">See more</a>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			    </div>
			</div>
	<?php }
	/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		// no posts found
	}

   $response = ob_get_contents();
   ob_end_clean();

   echo $response;
   die(1);
   }

   add_action( 'wp_ajax_nopriv_load_location', 'prefix_load_location' );
add_action( 'wp_ajax_load_location', 'prefix_load_location' );
function prefix_load_location () {
    $cat_id2 = $_POST[ 'location_cat' ];

	$args = array(
	'post_type' => 'teams',
	'tax_query' => array(
		array(
		'taxonomy' => 'teams_cat',
		'field' => 'id',
		'terms' => $cat_id2
		 )
	  )
	);
   $the_query = new WP_Query( $args );

    ob_start ();
	if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();?>
		<div class="col-lg-5ths col-xs-6 no-padding color-white project-item">
		<div class="teams-img 2">
		<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
		</div>
	</div>
	<?php }
	/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		// no posts found
	}

   $response = ob_get_contents();
   ob_end_clean();

   echo $response;
   die(1);
   }

function location_ajax(){

    $id_post_location = $_POST["id_post_location"];
	$args = array('posts_per_page' => -1,
				'post_type' => 'locations',
				'post__in' => array($id_post_location),
				);
	$posts_array = get_posts( $args );
	global $post;?>
	<?php

	$arr= array() ;
	$arr_location = array() ;
	$html_location = "";
	foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
		<?php

			if( have_rows('location_information') ):
			// loop through the rows of data
			while ( have_rows('location_information') ) : the_row();
				$maps_child = get_sub_field('maps_child');
				if( !empty($maps_child) ){
					$arr_location_ok = array();
					$arr_location_ok['address']= $maps_child['address'];
					$arr_location_ok['lat'] = $maps_child['lat'];
					$arr_location_ok['lng'] = $maps_child['lng'];
					$arr_location_ok['title']= get_the_title();
					$arr_location[] = $arr_location_ok;
				}
			endwhile;
			else :
						// no rows found
			endif;



			$name_location = get_field( "name_location" );

			?>
			<?php $html_location .= "<h2>". $name_location . "</h2>"; ?>
			<?php
			// check if the repeater field has rows of data
			if( have_rows('location_information') ):
				// loop through the rows of data
				while ( have_rows('location_information') ) : the_row();
				// display a sub field value ?>
				<?php $html_location .= "<h3>".get_sub_field('location_name')."</h3>" ?>
				<?php
				$html_location .= get_sub_field('information_detail');
				endwhile;
			else :
				// no rows found
			endif;
		?>
	<?php
	endforeach;
	// var_dump($arr_location);
	?>
	<?php
	$arr['html']= $html_location;
	$arr['arr']= $arr_location;
	echo json_encode($arr);

	exit;
}
add_action('wp_ajax_nopriv_location_ajax', 'location_ajax');
add_action('wp_ajax_location_ajax', 'location_ajax');

function load_more_ajax(){
		$paged = $_POST["paged"];
		$i = $_POST["i"];
	
				$args = array(
				'posts_per_page'   => 2,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'paged'    => $paged,
				);
				$the_query = new WP_Query( $args );

				// var_dump($the_query->request);

				if ( $the_query->have_posts() ) {

					while ( $the_query->have_posts() ) {
					$the_query->the_post();
					?>
						<?php if($the_query->max_num_pages==$paged || $the_query->max_num_pages<$paged){?>
							<style>
								#read_more_news {
									display: none;
								}
							</style>
						<?php }
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
					}?>
					<div id="ajax_posts_f" class="row">
						<input type="hidden" class="ajax_posts_f_page" value="<?php echo (int)$paged+1;?>">
						<input type="hidden" class="ajax_posts_f_i" value="<?php echo $i;?>">
					</div>
				<?php
				}
exit;
}
add_action('wp_ajax_nopriv_load_more_ajax', 'load_more_ajax');
add_action('wp_ajax_load_more_ajax', 'load_more_ajax');


function load_more_sectors_ajax(){
		$paged = $_POST["paged"];
		$i = $_POST["i"];
				$args = array(
				'posts_per_page'   => 3,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'sectors',
				'post_status'      => 'publish',
				'paged'    => $paged,
				);
				$the_query = new WP_Query( $args );

				// var_dump($the_query->request);

				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
					$the_query->the_post();
					?>
						<?php if($the_query->max_num_pages==$paged || $the_query->max_num_pages<$paged){?>
							<style>
								#read_more_news {
									display: none;
								}
							</style>
						<?php }
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
					}?>
					<div id="ajax_posts_f" class="row">
						<input type="hidden" class="ajax_posts_f_page" value="<?php echo (int)$paged+1;?>">
						<input type="hidden" class="ajax_posts_f_i" value="<?php echo $i;?>">
					</div>
				<?php
				}
exit;
}
add_action('wp_ajax_nopriv_load_more_sectors_ajax', 'load_more_sectors_ajax');
add_action('wp_ajax_load_more_sectors_ajax', 'load_more_sectors_ajax');

function project_our_ajax(){
	$name_sectors = $_POST["name_sectors"];
	$name_services = $_POST["name_services"];

	if($name_sectors =="all" && $name_services !="all"){
		$args = array(
		'posts_per_page'   => '1000',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'projects',
		'post_status'      => 'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'project_services',
					'field' => 'id',
					'terms' => $name_services,
				),
			),
		);
	}
	else if($name_services =="all" && $name_sectors !="all"){
		$args = array(
		'posts_per_page'   => '1000',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'projects',
		'post_status'      => 'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'project_sectors',
					'field' => 'id',
					'terms' => $name_sectors,
				),
			),
		);
	}
	else if($name_services =="all" && $name_sectors =="all"){
		$args = array(
		'posts_per_page'   => '1000',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'projects',
		'post_status'      => 'publish',
		);
	}
	else{
		$args = array(
		'posts_per_page'   => '1000',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'projects',
		'post_status'      => 'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'project_services',
					'field' => 'id',
					'terms' => $name_services,
				),
				array(
					'taxonomy' => 'project_sectors',
					'field' => 'id',
					'terms' => $name_sectors,
				),
			),
		);
	}
	$loop = new WP_Query( $args );
	 if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class="col-lg-5ths col-xs-6 no-padding color-white project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
			<div  class="pproject-img project-img--square 2">
			<!--<a href="javascript:void(0);"><?php the_post_thumbnail();?></a>-->
			
			<?php if ( has_post_thumbnail($post->ID) ) { ?>
			    <a href="javascript:void(0);"><?php the_post_thumbnail('people-thumb');?></a>
        	        <?php
                   }
                else {
    			    echo '<img src="http://fyfe-project.sunbeardigital.com/wp-content/uploads/2017/08/dummy-thumbnail.jpg" />';
				}
				?> 
			</div>
			<div class="project-info">
				<div class="btn-see list-cat-fix"><?php the_terms( get_the_ID(), 'project_cat', '', '' );  ?></div>
				<div class="title-post-fix"><h5><button type="button" class="btn btn-info btn-lg"><?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?></button>
			</h5></div>
			</div>
		</div>

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
							
							<?php $image_popup = get_field('image_popup') ;
								 
									if($image_popup !=''){ ?>
                                         <div class="project-img1" style="background-image: url(<?php echo $image_popup['url'];?>);"></div>
                                    <?php
                                    }
                                    else{ ?>
                                      <div class="project-img1" style="background-image: url(<?php the_post_thumbnail_url();?>);"></div>
                                    <?php
                                    }
                                    ?>
							
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
									<div class="btn-see list-cat-fix list-cat-fix2 222">
									<?php
										$terms = get_the_terms( get_the_ID(), 'project_services' );

										if ( $terms && ! is_wp_error( $terms ) ) :

											$draught_links = array();

											foreach ( $terms as $term ) {?>
											    <?php $button_tax_link=get_field('link','project_services_'. $term->term_taxonomy_id);
												if ($button_tax_link!= ''){ ?>
												<a href="<?php the_field('link','project_services_'. $term->term_taxonomy_id);?>"><?php echo $term->name;?></a>
											<?php } else { ?>
											    	<a href="#" class="disabled-link"><?php echo $term->name;?></a>
											    	
											<?php
											} ?>
											<?php }
											?>


										<?php endif; ?>
										</div>
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
												<?php if ( has_post_thumbnail( $id ) ) {
                                                    the_post_thumbnail();
                                                }
                                                else {
                                                    echo '<img src="http://fyfe-project.sunbeardigital.com/wp-content/uploads/2017/08/recommended-product-dummy.jpg" alt=""/>';
                                                }
                     
                                                  ?>

											  <div class="project-info">
													<div class="btn-see list-cat-fix"></div>
													<div class="title-post-fix">
														<h5>
															<!--<button type="button" href="javascript:void(0);"class="btn btn-info btn-lg">
																<?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?>
															</button>-->
															  <!--<a href="#" class="project-info-btn"  data-toggle="modal" data-toggle="modal" data-target=".<?php echo get_the_ID();?>" data-dismiss="modal""><?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?></a>-->
															  <a href="<?php echo get_permalink($post_object->ID); ?>" class="project-info-btn" ><?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?></a>
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
	<?php
	endwhile;?>
	<?php else : ?>
	<p class="no_project">No Project Found!</p>
	<?php endif ?>
	<div id="ajax_posts_f_project" class="row">
		<input type="hidden" class="ajax_posts_f_page_project" value="2">
	</div>
<?php
exit;
}
add_action('wp_ajax_nopriv_project_our_ajax', 'project_our_ajax');
add_action('wp_ajax_project_our_ajax', 'project_our_ajax');


add_shortcode( 'our_people', 'our_people_shortcode' );
get_template_part("partials/our-people-shortcode");

/*================project short code=================*/

add_shortcode( 'our_projects', 'our_projects_shortcode' );
get_template_part("shortcodes/our_projects");

get_template_part("shortcodes/see_more_project_our_ajax");
add_action('wp_ajax_nopriv_see_more_project_our_ajax', 'see_more_project_our_ajax');
add_action('wp_ajax_see_more_project_our_ajax', 'see_more_project_our_ajax');

function load_more_services_ajax(){
		$paged = $_POST["paged"];
		$i = $_POST["i"];
				$args = array(
				'posts_per_page'   => 3,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'paged'    => $paged,
				);
				$the_query = new WP_Query( $args );

				// var_dump($the_query->request);

				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
					$the_query->the_post();
					?>
						<?php if($the_query->max_num_pages==$paged || $the_query->max_num_pages<$paged){?>
							<style>
								#read_more_services {
									display: none;
								}
							</style>
						<?php }
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
					}?>
					<div id="ajax_posts_f2" class="row">
						<input type="hidden" class="ajax_posts_f_page_se" value="<?php echo (int)$paged+1;?>">
						<input type="hidden" class="ajax_posts_f_se_i" value="<?php echo $i;?>">
					</div>
				<?php
				}
exit;
}
add_action('wp_ajax_nopriv_load_more_services_ajax', 'load_more_services_ajax');
add_action('wp_ajax_load_more_services_ajax', 'load_more_services_ajax');

function my_custom_taxonomy_columns( $columns )
{
	$columns['link'] = __('Link');

	return $columns;
}
add_filter('manage_edit-project_services_columns' , 'my_custom_taxonomy_columns');
function my_custom_taxonomy_columns_content( $content, $column_name, $term_id )
{
    if ( 'link' == $column_name ) {
		$content = '<a target="_blank" href="'. get_field('link', 'project_services_'.$term_id) .'">'. get_field('link', 'project_services_'.$term_id).'</a>';
    }
	return $content;
}
add_filter( 'manage_project_services_custom_column', 'my_custom_taxonomy_columns_content', 10, 3 );

add_filter( 'manage_expertise_posts_columns', 'set_custom_edit_book_columns' );
add_action( 'manage_expertise_posts_custom_column' , 'custom_book_column', 10, 2 );

function set_custom_edit_book_columns($columns) {
    $columns['slug'] = __( 'Slug', 'your_text_domain' );
    return $columns;
}

function custom_book_column( $column, $post_id ) {
    switch ( $column ) {

        case 'slug' :
           $post = get_post($post_id);
			echo $slug = $post->post_name;
            break;

    }
}
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}









function ni_search_by_title_only( $search, &$wp_query )
{
    global $wpdb;
    if ( empty( $search ) )
        return $search; // skip processing - no search term in query
    $q = $wp_query->query_vars;
    $n = ! empty( $q['exact'] ) ? '' : '%';
    $search =
    $searchand = '';
    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter( 'posts_search', 'ni_search_by_title_only', 500, 2 );