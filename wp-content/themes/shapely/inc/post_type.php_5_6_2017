<?php
function add_expertise_post_type()
{
    $label = array(
        'name' => 'Our Expertise', 
      
		'singular_name' => 'Our Expertise',
		
		'singular' => 'Our Expertise',
		
		'menu_name' => 'Our Expertise',
		
		'parent_item_colon'   => 'Our Expertise',

		'all_items'           => 'All Our Expertise',

		'view_item'           => 'View Our Expertise',

		'add_new_item'        => 'Add New ',

		'add_new'             => 'Add New',

		'edit_item'           => 'Edit Our Expertise',

		'update_item'         => 'Update Our Expertise',

		'search_items'        => 'Search Our Expertise',

		'not_found'           => 'Not Found',

		'not_found_in_trash'  => 'Not found in Trash'
    );
 
    $args = array(
        'labels' => $label, 
        'description' => 'Our Expertise', 
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
?>