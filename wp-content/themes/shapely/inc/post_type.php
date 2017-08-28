<?php
function add_expertise_post_type()
{
    $label = array(
        'name' => 'Our Services',

		'singular_name' => 'Our Services',

		'singular' => 'Our Services',

		'menu_name' => 'Our Services',

		'parent_item_colon'   => 'Our Services',

		'all_items'           => 'All Our Services',

		'view_item'           => 'View Our Services',

		'add_new_item'        => 'Add New ',

		'add_new'             => 'Add New',

		'edit_item'           => 'Edit Our Services',

		'update_item'         => 'Update Our Services',

		'search_items'        => 'Search Our Services',

		'not_found'           => 'Not Found',

		'not_found_in_trash'  => 'Not found in Trash'
    );

    $args = array(
        'labels' => $label,
        'description' => 'Our Services',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            ),
        'taxonomies' => array( '' ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-welcome-add-page',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );

    register_post_type('expertise', $args);

}
add_action('init', 'add_expertise_post_type');
function add_sectors_post_type()
{
    $label = array(
        'name' => 'Our Sectors',

		'singular_name' => 'Our Sectors',

		'singular' => 'Our Sectors',

		'menu_name' => 'Our Sectors',

		'parent_item_colon'   => 'Our Sectors',

		'all_items'           => 'All Our Sectors',

		'view_item'           => 'View Our Sectors',

		'add_new_item'        => 'Add New ',

		'add_new'             => 'Add New',

		'edit_item'           => 'Edit Our Sectors',

		'update_item'         => 'Update Our Sectors',

		'search_items'        => 'Search Our Sectors',

		'not_found'           => 'Not Found',

		'not_found_in_trash'  => 'Not found in Trash'
    );

    $args = array(
        'labels' => $label,
        'description' => 'Our Sectors',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            ),
        'taxonomies' => array( '' ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-welcome-add-page',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );

    register_post_type('sectors', $args);

}
add_action('init', 'add_sectors_post_type');

add_action('init', 'create_sectors_cat');

function create_sectors_cat() {
    register_taxonomy('sectors_cat', 'sectors', array(
            'label' => 'Brand',
            'labels' => array(
                'name'          => __('Team Category'),
                'singular_name' => __('Team Category'),
                'add_new_item'  => __('Add New Team Category'),
                'new_item'      => __('New Team Category'),
                'add_new'       => __('Add Team Category'),
                'edit_item'     => __('Edit Team Cat')
            ),
            'public' => true,
            'hierarchical' => true
        )
    );
}

function add_projects_post_type()
{
    $label = array(
        'name' => 'Our Projects',

		'singular_name' => 'Our Projects',

		'singular' => 'Our Projects',

		'menu_name' => 'Our Projects',

		'parent_item_colon'   => 'Our Projects',

		'all_items'           => 'All Our Projects',

		'view_item'           => 'View Our Projects',

		'add_new_item'        => 'Add New ',

		'add_new'             => 'Add New',

		'edit_item'           => 'Edit Our Projects',

		'update_item'         => 'Update Our Projects',

		'search_items'        => 'Search Our Projects',

		'not_found'           => 'Not Found',

		'not_found_in_trash'  => 'Not found in Trash'
    );

    $args = array(
        'labels' => $label,
        'description' => 'Our Projects',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            ),
        'taxonomies' => array( '' ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-welcome-add-page',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );

    register_post_type('projects', $args);

}
add_action('init', 'add_projects_post_type');

add_action('init', 'create_project_cat');

function create_project_cat() {
    register_taxonomy('project_cat', 'projects', array(
            'label' => 'Brand',
            'labels' => array(
                'name'          => __('Project Category'),
                'singular_name' => __('Project Category'),
                'add_new_item'  => __('Add New Project Category'),
                'new_item'      => __('New Project Category'),
                'add_new'       => __('Add Project Category'),
                'edit_item'     => __('Edit Project Cat')
            ),
            'public' => true,
            'hierarchical' => true
        )
    );
}
add_action('init', 'create_project_services');

function create_project_services() {
    register_taxonomy('project_services', 'projects', array(
            'label' => 'Brand',
            'labels' => array(
                'name'          => __('Project Services'),
                'singular_name' => __('Project Services'),
                'add_new_item'  => __('Add New Project Services'),
                'new_item'      => __('New Project Services'),
                'add_new'       => __('Add Project Services'),
                'edit_item'     => __('Edit Project Services')
            ),
            'public' => true,
            'hierarchical' => true
        )
    );
}
add_action('init', 'create_project_sectors');

function create_project_sectors() {
    register_taxonomy('project_sectors', 'projects', array(
            'label' => 'Brand',
            'labels' => array(
                'name'          => __('Project Sectors'),
                'singular_name' => __('Project Sectors'),
                'add_new_item'  => __('Add New Project Sectors'),
                'new_item'      => __('New Project Sectors'),
                'add_new'       => __('Add Project Sectors'),
                'edit_item'     => __('Edit Project Sectors')
            ),
            'public' => true,
            'hierarchical' => true
        )
    );
}

function add_teams_post_type()
{
    $label = array(
        'name' => 'Teams',

		'singular_name' => 'Teams',

		'singular' => 'Teams',

		'menu_name' => 'Teams',

		'parent_item_colon'   => 'Teams',

		'all_items'           => 'All Teams',

		'view_item'           => 'View Teams',

		'add_new_item'        => 'Add New ',

		'add_new'             => 'Add New',

		'edit_item'           => 'Edit Teams',

		'update_item'         => 'Update Teams',

		'search_items'        => 'Search Teams',

		'not_found'           => 'Not Found',

		'not_found_in_trash'  => 'Not found in Trash'
    );

    $args = array(
        'labels' => $label,
        'description' => 'Teams',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            ),
        'taxonomies' => array( '' ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-welcome-add-page',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );

    register_post_type('teams', $args);

}
add_action('init', 'add_teams_post_type');

add_action('init', 'create_team_cat');

function create_team_cat() {
    register_taxonomy('teams_cat', 'teams', array(
            'label' => 'Brand',
            'labels' => array(
                'name'          => __('Team Category'),
                'singular_name' => __('Team Category'),
                'add_new_item'  => __('Add New Team Category'),
                'new_item'      => __('New Team Category'),
                'add_new'       => __('Add Team Category'),
                'edit_item'     => __('Edit Team Cat')
            ),
            'public' => true,
            'hierarchical' => true
        )
    );
}

function add_location_post_type()
{
    $label = array(
        'name' => 'Location',

		'singular_name' => 'Location',

		'singular' => 'Location',

		'menu_name' => 'Location',

		'parent_item_colon'   => 'Location',

		'all_items'           => 'All Location',

		'view_item'           => 'View Location',

		'add_new_item'        => 'Add New ',

		'add_new'             => 'Add New',

		'edit_item'           => 'Edit Location',

		'update_item'         => 'Update Location',

		'search_items'        => 'Search Location',

		'not_found'           => 'Not Found',

		'not_found_in_trash'  => 'Not found in Trash'
    );

    $args = array(
        'labels' => $label,
        'description' => 'Location',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            ),
        'taxonomies' => array( '' ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-welcome-add-page',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );

    register_post_type('locations', $args);

}
add_action('init', 'add_location_post_type');



//Testimonials Custom Post Type
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
    register_post_type( 'sliderhome', $args );

}
add_action( 'init', 'sliderhome_func', 0 );