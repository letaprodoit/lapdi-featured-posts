<?php
/*
Plugin Name: 	TSP Featured Posts
Plugin URI: 	http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-posts-for-wordpress.html
Description: 	Featured Posts allows you to add featured posts to your blog's website via widgets, pages and/or posts.
Author: 		The Software People
Author URI: 	http://www.thesoftwarepeople.com/
Version: 		1.1.0
Text Domain: 	tspfp
Copyright: 		Copyright © 2013 The Software People, LLC (www.thesoftwarepeople.com). All rights reserved
License: 		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
*/

require_once(ABSPATH . 'wp-admin/includes/plugin.php' );

define('TSPFP_PLUGIN_FILE', 				__FILE__ );
define('TSPFP_PLUGIN_PATH',					plugin_dir_path( __FILE__ ) );
define('TSPFP_PLUGIN_URL', 					plugin_dir_url( __FILE__ ) );
define('TSPFP_PLUGIN_BASE_NAME', 			plugin_basename( __FILE__ ) );
define('TSPFP_PLUGIN_NAME', 				'tsp-featured-posts');
define('TSPFP_PLUGIN_TITLE', 				'TSP Featured Posts');
define('TSPFP_PLUGIN_REQ_VERSION', 			"3.5.1");

// If either of the plugins exist then inlude the register script to register all the classes
// else deactivaet this plugin and do not allow installation
if ( !file_exists( WP_PLUGIN_DIR . "/tsp-easy-dev-pro/TSP_Easy_Dev.register.php" ) )
{
	add_action( 'admin_notices', function (){
		
		$message = TSPFP_PLUGIN_TITLE . ' <strong>was not installed</strong>, plugin requires the installation and activation of <strong><a href="plugin-install.php?tab=search&type=term&s=TSP+Easy+Dev+Pro">TSP Easy Dev Pro</a></strong>.';
	    ?>
	    <div class="error">
	        <p><?php echo $message; ?></p>
	    </div>
	    <?php
	} );
	
	deactivate_plugins( TSPFP_PLUGIN_BASE_NAME );
	
	return;
}//endif
else
{
    if (file_exists( WP_PLUGIN_DIR . "/tsp-easy-dev-pro/TSP_Easy_Dev.register.php" ))
    {
    	include_once WP_PLUGIN_DIR . "/tsp-easy-dev-pro/TSP_Easy_Dev.register.php";
    }//end if
}//end else

global $easy_dev_settings;

require( TSPFP_PLUGIN_PATH . 'TSP_Easy_Dev.config.php');
require( TSPFP_PLUGIN_PATH . 'TSP_Easy_Dev.extend.php');
//--------------------------------------------------------
// initialize the Facepile plugin
//--------------------------------------------------------
$featured_posts 								= new TSP_Easy_Dev_Pro( TSPFP_PLUGIN_FILE, TSPFP_PLUGIN_REQ_VERSION );

$featured_posts->set_options_handler( new TSP_Easy_Dev_Options_Featured_Posts( $easy_dev_settings ), true );

$featured_posts->set_widget_handler( 'TSP_Easy_Dev_Widget_Featured_Posts');

$featured_posts->uses_smarty 					= true;

$featured_posts->uses_shortcodes 				= true;

// Quueue User styles
$featured_posts->add_css( TSPFP_PLUGIN_URL . 'css' . DS . 'movingboxes.css' );

if ( fn_easy_dev_pro_this_browser( 'IE', 8 ) )
{
	$featured_posts->add_css( TSPFP_PLUGIN_URL . 'css' . DS . 'movingboxes-ie.css' );
}//endif
	
if ( fn_easy_dev_pro_this_browser( 'IE' ) )
{
	$featured_posts->add_css( TSPFP_PLUGIN_URL . TSPFP_PLUGIN_NAME . '.ie.css' );
}//endif
else
{
	$featured_posts->add_css( TSPFP_PLUGIN_URL . TSPFP_PLUGIN_NAME . '.css' );
}//endelse

// Quueue User Scripts
$featured_posts->add_script( TSPFP_PLUGIN_URL . 'js' . DS . 'jquery.movingboxes.js', array('jquery') );
$featured_posts->add_script( TSPFP_PLUGIN_URL . 'js' . DS . 'slider-scripts.js', array('jquery') );
$featured_posts->add_script( TSPFP_PLUGIN_URL . 'js' . DS . 'scripts.js',  array('jquery') );

// Quueue Admin styles
$featured_posts->add_css( TSPFP_PLUGIN_URL . 'css' . DS. 'admin-style.css', true );
$featured_posts->add_css( TSP_EASY_DEV_ASSETS_CSS_URL . 'style.css', true );

$featured_posts->set_plugin_icon( TSPFP_PLUGIN_URL . 'images' . DS . 'tsp_icon_16.png' );

$featured_posts->add_shortcode ( TSPFP_PLUGIN_NAME );
$featured_posts->add_shortcode ( 'tsp_featured_posts' ); //backwards compatibility

$featured_posts->run( TSPFP_PLUGIN_FILE );

// Initialize widget - Required by WordPress
add_action('widgets_init', function () {
	global $featured_posts;
	
	register_widget ( $featured_posts->get_widget_handler() ); 
	apply_filters( $featured_posts->get_widget_handler().'-init', $featured_posts->get_options_handler() );
});
?>