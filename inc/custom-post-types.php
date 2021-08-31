<?php
/**
 * cpts and taxonomies
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


//room custom post type

// Register Custom Post Type room
// Post Type Key: room

function create_room_cpt() {

  $labels = array(
    'name' => __( 'Rooms', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Room', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Room', 'textdomain' ),
    'name_admin_bar' => __( 'Room', 'textdomain' ),
    'archives' => __( 'Room Archives', 'textdomain' ),
    'attributes' => __( 'Room Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Room:', 'textdomain' ),
    'all_items' => __( 'All Rooms', 'textdomain' ),
    'add_new_item' => __( 'Add New Room', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Room', 'textdomain' ),
    'edit_item' => __( 'Edit Room', 'textdomain' ),
    'update_item' => __( 'Update Room', 'textdomain' ),
    'view_item' => __( 'View Room', 'textdomain' ),
    'view_items' => __( 'View Rooms', 'textdomain' ),
    'search_items' => __( 'Search Rooms', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into room', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this room', 'textdomain' ),
    'items_list' => __( 'Room list', 'textdomain' ),
    'items_list_navigation' => __( 'Room list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Room list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'room', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'room', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_room_cpt', 0 );

add_action( 'init', 'create_building_taxonomies', 0 );
function create_building_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Buildings', 'taxonomy general name' ),
    'singular_name' => _x( 'building', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Buildings' ),
    'popular_items' => __( 'Popular Buildings' ),
    'all_items' => __( 'All Buildings' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Buildings' ),
    'update_item' => __( 'Update building' ),
    'add_new_item' => __( 'Add New building' ),
    'new_item_name' => __( 'New building' ),
    'add_or_remove_items' => __( 'Add or remove Buildings' ),
    'choose_from_most_used' => __( 'Choose from the most used Buildings' ),
    'menu_name' => __( 'building' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Buildings',array('room','post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'building' ),
    'show_in_rest'          => true,
    'rest_base'             => 'building',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

add_action( 'init', 'create_number_taxonomies', 0 );
function create_number_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Numbers', 'taxonomy general name' ),
    'singular_name' => _x( 'number', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Numbers' ),
    'popular_items' => __( 'Popular Numbers' ),
    'all_items' => __( 'All Numbers' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Numbers' ),
    'update_item' => __( 'Update number' ),
    'add_new_item' => __( 'Add New number' ),
    'new_item_name' => __( 'New number' ),
    'add_or_remove_items' => __( 'Add or remove Numbers' ),
    'choose_from_most_used' => __( 'Choose from the most used Numbers' ),
    'menu_name' => __( 'number' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Numbers',array('room'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'number' ),
    'show_in_rest'          => true,
    'rest_base'             => 'number',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

add_action( 'init', 'create_system_taxonomies', 0 );
function create_system_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Systems', 'taxonomy general name' ),
    'singular_name' => _x( 'system', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Systems' ),
    'popular_items' => __( 'Popular Systems' ),
    'all_items' => __( 'All Systems' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Systems' ),
    'update_item' => __( 'Update system' ),
    'add_new_item' => __( 'Add New system' ),
    'new_item_name' => __( 'New system' ),
    'add_or_remove_items' => __( 'Add or remove Systems' ),
    'choose_from_most_used' => __( 'Choose from the most used Systems' ),
    'menu_name' => __( 'system' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Systems',array('room'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'system' ),
    'show_in_rest'          => true,
    'rest_base'             => 'system',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

add_action( 'init', 'create_camera_taxonomies', 0 );
function create_camera_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Cameras', 'taxonomy general name' ),
    'singular_name' => _x( 'camera', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Cameras' ),
    'popular_items' => __( 'Popular Cameras' ),
    'all_items' => __( 'All Cameras' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Cameras' ),
    'update_item' => __( 'Update camera' ),
    'add_new_item' => __( 'Add New camera' ),
    'new_item_name' => __( 'New camera' ),
    'add_or_remove_items' => __( 'Add or remove Cameras' ),
    'choose_from_most_used' => __( 'Choose from the most used Cameras' ),
    'menu_name' => __( 'camera' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Cameras',array('room'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'camera' ),
    'show_in_rest'          => true,
    'rest_base'             => 'camera',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}


add_action( 'init', 'create_mic_taxonomies', 0 );
function create_mic_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Mics', 'taxonomy general name' ),
    'singular_name' => _x( 'mic', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Mics' ),
    'popular_items' => __( 'Popular Mics' ),
    'all_items' => __( 'All Mics' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Mics' ),
    'update_item' => __( 'Update mic' ),
    'add_new_item' => __( 'Add New mic' ),
    'new_item_name' => __( 'New mic' ),
    'add_or_remove_items' => __( 'Add or remove Mics' ),
    'choose_from_most_used' => __( 'Choose from the most used Mics' ),
    'menu_name' => __( 'mic' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Mics',array('room'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'mic' ),
    'show_in_rest'          => true,
    'rest_base'             => 'mic',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

add_action( 'init', 'create_hardware_taxonomies', 0 );
function create_hardware_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Hardware', 'taxonomy general name' ),
    'singular_name' => _x( 'hardware', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Hardware' ),
    'popular_items' => __( 'Popular Hardware' ),
    'all_items' => __( 'All Hardware' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Hardware' ),
    'update_item' => __( 'Update hardware' ),
    'add_new_item' => __( 'Add New hardware' ),
    'new_item_name' => __( 'New hardware' ),
    'add_or_remove_items' => __( 'Add or remove Hardware' ),
    'choose_from_most_used' => __( 'Choose from the most used Hardware' ),
    'menu_name' => __( 'hardware' ),
  );

add_action( 'init', 'create_speaker_taxonomies', 0 );
function create_speaker_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Speakers', 'taxonomy general name' ),
    'singular_name' => _x( 'Speaker', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Speakers' ),
    'popular_items' => __( 'Popular Speakers' ),
    'all_items' => __( 'All Speakers' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Speakers' ),
    'update_item' => __( 'Update speaker' ),
    'add_new_item' => __( 'Add New speaker' ),
    'new_item_name' => __( 'New speaker' ),
    'add_or_remove_items' => __( 'Add or remove Speakers' ),
    'choose_from_most_used' => __( 'Choose from the most used Speakers' ),
    'menu_name' => __( 'speaker' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Speakers',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'speaker' ),
    'show_in_rest'          => true,
    'rest_base'             => 'speaker',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}




//registers taxonomy specific post types - default is just post
  register_taxonomy('Hardware',array('room'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'hardware' ),
    'show_in_rest'          => true,
    'rest_base'             => 'hardware',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}





