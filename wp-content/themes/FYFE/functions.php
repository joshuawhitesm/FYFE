<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

/*add_action( 'wp_enqueue_scripts', 'amethyst_load_mobile_nav_script' );
function amethyst_load_mobile_nav_script() {*/

    //Add mobile button script to primary navigation menu
 /*   wp_enqueue_script( 'nav_for_mobile', get_bloginfo( 'stylesheet_directory' ) . '/scripts/drop-down-nav.js', array('jquery'), '0.5' );
}*/
//mobile menu area
// Don't add the opening <?php tag

// Register responsive menu script
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_scripts' );
/**
 * Enqueue responsive javascript
 * @author Ozzy Rodriguez
 * @todo Change 'prefix' to your theme's prefix
 */

function prefix_enqueue_scripts() {

	wp_enqueue_script( 'prefix-responsive-menu', get_stylesheet_directory_uri() . '/lib/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true ); // Change 'prefix' to your theme's prefix

}
//mobile menu area

//favicon area
add_filter( 'genesis_pre_load_favicon', 'sp_favicon_filter' );
function sp_favicon_filter( $favicon_url ) {
	return get_stylesheet_directory_uri() . '/images/favicon.png';
}
//favicon area

//sticky header area
//* Enqueue sticky menu script
add_action( 'wp_enqueue_scripts', 'sp_enqueue_script' );
function sp_enqueue_script() {
	wp_enqueue_script( 'sample-sticky-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/sticky-menu.js', array( 'jquery' ), '1.0.0' );
}

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before', 'genesis_do_subnav' );
//sticky header area

//slider area 
//Add in new Widget areas(added for slider)
/*function themeprefix_extra_widgets() {
	genesis_register_sidebar( array(
	'id'            => 'slider',
	'name'          => __( 'Slider', 'genesischild' ),
	'description'   => __( 'This is the Slider area', 'genesischild' ),
	'before_widget' => '<div class="wrap slider">',
	'after_widget'  => '</div>',
	) );
}*/
//add_action( 'widgets_init', 'themeprefix_extra_widgets' );

//Position the slider Area
/*function themeprefix_slider_widget() {
	if( is_front_page() ) {
	genesis_widget_area ( 'slider', array(
	'before' => '<aside class="slider-container">',
	'after'  => '</aside>',));
	}
}
add_action( 'genesis_after_header','themeprefix_slider_widget' );*/
//slider area

//featured image area
//* Do NOT include the opening php tag

//* Enqueue scripts and styles
/*add_action( 'wp_enqueue_scripts', 'cegg_load_scripts_styles' );
function cegg_load_scripts_styles() {

	if ( is_singular( array( 'post', 'page' ) ) && has_post_thumbnail() ) {

		wp_enqueue_script( 'cegg-backstretch', get_bloginfo( 'stylesheet_directory' ) . '/js/backstretch.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'cegg-backstretch-set', get_bloginfo( 'stylesheet_directory' ) . '/js/backstretch-set.js' , array( 'jquery', 'cegg-backstretch' ), '1.0.0', true );
	
	}
}*/

//* Localize backstretch script
/*add_action( 'genesis_after_entry', 'cegg_set_background_image' );
function cegg_set_background_image() {

	$image = array( 'src' => has_post_thumbnail() ? genesis_get_image( array( 'format' => 'url' ) ) : '' );

	wp_localize_script( 'cegg-backstretch-set', 'BackStretchImg', $image );

}*/

//* Hook entry background area
/*add_action( 'genesis_after_header', 'cegg_entry_background' );
function cegg_entry_background() {

	if ( is_singular( 'post' ) || ( is_singular( 'page' ) && has_post_thumbnail() ) ) {

		echo '<div class="container_featured"><div class="entry-background"></div></div>';
	
	}

}
*/
//featured image area

//footer menu area
/*function themprefix_footer_menu () {

 	$args = array( 
		'theme_location'  => 'tertiary', 
 		'container'       => 'nav',
		'container_class' => 'footer-menu-container',
		'menu_class'      => 'wrap menu genesis-nav-menu menu-tertiary', 
		'depth'           => 1, //change to 0 for submenu levels
		); 
		
	wp_nav_menu( $args );
}*/

/*add_theme_support ( 'genesis-menus' , array ( 
                                      'primary' => 'Primary Navigation Menu' , 
                                      'secondary' => 'Secondary Navigation Menu' ,
                                      'tertiary' => 'Footer Navigation Menu' 
                                      ) );

add_action( 'genesis_before_footer', 'themprefix_footer_menu' );*/
//footer menu area

//* Customize the entire footer area
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	?>
    
22 Dunlop Road, Sunlands SA 5322 Postal Address: PO Box 643 Waikerie SA 5330 Phone: 08 8541 9072  <a href="#">CONTACT</a>
	
	<?php
}
//* Customize the entire footer area

//add widget area
//* Register after post widget area
genesis_register_sidebar( array(
	'id'            => 'social-media-footer',
	'name'          => __( 'Social Media Footer', 'themename' ),
	'description'   => __( 'This is a widget area that can be placed after the post', 'themename' ),
) );
//* Hook after post widget area after post content

	function sp_after_post_widget() {
	
		genesis_widget_area( 'social-media-footer', array(
			'before' => '<div class="social-media-container"><div class="social-media-inner">',
			'after' => '</div></div>',
	) );
}
add_action( 'genesis_before_footer', 'sp_after_post_widget', 1 );
//add widget area

/*post area*/
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
	$post_info = '[post_date] by [post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
}

// Remove the post info function
remove_action( 'genesis_before_post_content', 'genesis_post_info' );

add_filter( 'genesis_post_meta', 'ig_entry_meta_footer' );
function ig_entry_meta_footer( $post_meta ) {
	$post_meta = '';
	return $post_meta;
}

add_filter( 'get_the_content_more_link', 'sp_read_more_link' );
function sp_read_more_link() {
	return '... <a class="more-link" href="' . get_permalink() . '">View More</a>';
}
/*post area*/

//add footer widgets
remove_theme_support( 'genesis-footer-widgets', 3 );
add_theme_support( 'genesis-footer-widgets', 4 );

/*Sub Menu*/

genesis_register_sidebar( array(
	'id'            => 'sub-menu-header',
	'name'          => __( 'Sub Menu', 'waikerie' ),
	'description'   => __( 'This is a widget area for the inner pages - sub menus', 'waikerie' ),
) );

function add_waikerie_submenu() {
	
		genesis_widget_area( 'sub-menu-header', array(
			'before' => '<div class="sub-menu"><div class="wrap">',
			'after' => '</div></div>',
	) );
}

add_action( 'genesis_after_header', 'add_waikerie_submenu', 10 );



//Slider Home Custom Post Type
function sliderhome_func() {

	$labels = array(
		'name'                  => _x( 'Slider Home', 'Post Type General Name', 'text-domain' ),
		'singular_name'         => _x( 'Slider Home', 'Post Type Singular Name', 'text-domain' ),
		'menu_name'             => __( 'Slider Home', 'text-domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text-domain' ),
		'archives'              => __( 'Item Archives', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text-domain' ),
		'all_items'             => __( 'All Items', 'text-domain' ),
		'add_new_item'          => __( 'Add New Item', 'text-domain' ),
		'add_new'               => __( 'Add New', 'text-domain' ),
		'new_item'              => __( 'New Item', 'text-domain' ),
		'edit_item'             => __( 'Edit Item', 'text-domain' ),
		'update_item'           => __( 'Update Item', 'text-domain' ),
		'view_item'             => __( 'View Item', 'text-domain' ),
		'search_items'          => __( 'Search Item', 'text-domain' ),
		'not_found'             => __( 'Not found', 'text-domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text-domain' ),
		'featured_image'        => __( 'Featured Image', 'text-domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text-domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text-domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text-domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text-domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text-domain' ),
		'items_list'            => __( 'Items list', 'text-domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text-domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text-domain' ),
	);
	$args = array(
		'label'                 => __( 'Slider Home', 'text-domain' ),
		'description'           => __( 'Slider Home', 'text-domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'slider-home', $args );

}
add_action( 'init', 'sliderhome_func', 0 );


//Short Code Testimonials
add_shortcode( 'our_testi', 'our_testi_func' );
function our_testi_func($atts) {
	ob_start();
	$atts = shortcode_atts( array(
		'number_posts' => 10,
		'post_type' => 'testimonials',
		), $atts, 'testimonials' );
	
    $args = ( array(
        'post_type' => $atts['post_type'],
		'posts_per_page' => $atts['number_posts'],
		'order' => 'ASC'
		// 'paged' => $paged,
    ) );
	$query = new WP_Query($args);?>
	<div class="col-ms-12 testi"> 
	<?php
	if ($query->have_posts()) { 
		while ($query->have_posts()) { 
		$query->the_post();?>
			<div class="col-ms-55 testi-members" >

				<div class="col-ms-12 testi-img">
					<?php //the_post_thumbnail();?>
				</div>

				<div class="col-ms-11 testi-info">

					<div class="col-ms-12 content">
						<?php the_content();?>
					</div>
					<br>
					<div class="col-ms-12 title">
						<b><?php the_title();?></b>
						<p><?php the_field('employment');?></p>
					</div>

				</div>

			</div>
		<?php
		}
		wp_reset_postdata();
	}?> 
	</div>
	<?php
$myvariable = ob_get_clean();
	return $myvariable;
}