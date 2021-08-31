<?php
/**
 * acf json save
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

	//save acf json
		add_filter('acf/settings/save_json', 'dlinq_room_json_save_point');
		 
		function dlinq_room_json_save_point( $path ) {
		    
		    // update path
		    $path = plugin_dir_path(__FILE__) . 'acf-json'; //replace w get_stylesheet_directory() for theme
		    		    // return
		    return $path;
		    
		}


		// load acf json
		add_filter('acf/settings/load_json', 'dlinq_room_json_load_point');

		function dlinq_room_json_load_point( $paths ) {
		    
		    // remove original path (optional)
		    unset($paths[0]);
		    
		    
		    // append path
		    $paths[] = plugin_dir_path(__FILE__) . 'acf-json';//replace w get_stylesheet_directory() for theme
  
		    
		    // return
		    return $paths;
		    
		}