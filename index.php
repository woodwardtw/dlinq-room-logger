<?php 
/*
Plugin Name: DLINQ Room Logger
Plugin URI:  https://github.com/
Description: For stuff that's magical
Version:     1.0
Author:      DLINQ
Author URI:  https://dlinq.middcreate.net
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// add_action('wp_enqueue_scripts', 'prefix_load_scripts');

// function prefix_load_scripts() {                           
//     $deps = array('jquery');
//     $version= '1.0'; 
//     $in_footer = true;    
//     wp_enqueue_script('prefix-main-js', plugin_dir_url( __FILE__) . 'js/prefix-main.js', $deps, $version, $in_footer); 
//     wp_enqueue_style( 'prefix-main-css', plugin_dir_url( __FILE__) . 'css/prefix-main.css');
// }

// UnderStrap's includes directory.
$alt_room_logger_inc_dir = plugin_dir_path(__FILE__)  . 'inc';

$alt_room_logger_includes = array(
   '/custom-post-types.php',                          // Load custom post types and taxonomies
   '/acf.php'                          // Load custom post types and taxonomies
);


// Include files.
foreach ( $alt_room_logger_includes as $file ) {
   require_once $alt_room_logger_inc_dir . $file;
}



//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

  //print("<pre>".print_r($a,true)."</pre>");

//FIX TITLE ON QUOTES 
function room_title ($post_id){
  $type = get_post_type($post_id);
  if ($type === 'room'){
    remove_action( 'save_post', 'room_title' );
    $building = get_field('building', $post_id)->name;
    $room_number = get_field('room_number', $post_id)->name;
    $room = $building . ' room '  . $room_number . ' review';
    $my_post = array(
        'ID'           => $post_id,
        'post_title'   => $room,      
    );

  // Update the post into the database
    wp_update_post( $my_post );
  }
    add_action( 'save_post', 'room_title' );
}

add_action( 'save_post', 'room_title', 10, 3 ); //don't forget the last argument to allow all three arguments of the function