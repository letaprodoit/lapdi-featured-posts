<?php
/*
Plugin Name: 	TSP Featured Posts
Plugin URI: 	http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-posts-for-wordpress.html
Description: 	Featured Posts allows you to <strong>add featured posts with quotes to your blog</strong>'s website. Powered by <strong><a href="http://wordpress.org/plugins/tsp-easy-dev/">TSP Easy Dev</a></strong>.
Author: 		The Software People
Author URI: 	http://www.thesoftwarepeople.com/
Version: 		1.2.1
Text Domain: 	tspfp
Copyright: 		Copyright � 2013 The Software People, LLC (www.thesoftwarepeople.com). All rights reserved
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

// The recommended option would be to require the installation of the standard version and
// bundle the Pro classes into your plugin if needed, this plugin requires both the Easy Dev plugin installation
// and looks for the existence of the Easy Dev Pro libraries
if ( !file_exists ( WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php" ) || !file_exists( TSPFP_PLUGIN_PATH . "lib/TSP_Easy_Dev_Pro/TSP_Easy_Dev_Pro.register.php" ) )
{
	function display_tspfp_notice()
	{
		$message = TSPFP_PLUGIN_TITLE . ' <strong>was not installed</strong>, plugin requires the installation of <strong><a href="plugin-install.php?tab=search&type=term&s=TSP+Easy+Dev">TSP Easy Dev</a></strong>.';
	    ?>
	    <div class="error">
	        <p><?php echo $message; ?></p>
	    </div>
	    <?php
	}//end display_tspfp_notice

	add_action( 'admin_notices', 'display_tspfp_notice' );
	deactivate_plugins( TSPFP_PLUGIN_BASE_NAME );
	return;
}//endif
else
{
    if (file_exists( WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php" ))
    {
    	include_once WP_PLUGIN_DIR . "/tsp-easy-dev/TSP_Easy_Dev.register.php";
    }//end else

    if (file_exists( TSPFP_PLUGIN_PATH . "/lib//TSP_Easy_Dev_Pro/TSP_Easy_Dev_Pro.register.php" ))
    {
    	include_once TSPFP_PLUGIN_PATH . "/lib//TSP_Easy_Dev_Pro/TSP_Easy_Dev_Pro.register.php";
    }//end else
}//end else

global $easy_dev_settings;

require( TSPFP_PLUGIN_PATH . 'TSP_Easy_Dev.config.php');
require( TSPFP_PLUGIN_PATH . 'TSP_Easy_Dev.extend.php');
//--------------------------------------------------------
// initialize the plugin
//--------------------------------------------------------
$featured_posts 						= new TSP_Easy_Dev_Pro( TSPFP_PLUGIN_FILE, TSPFP_PLUGIN_REQ_VERSION );

$featured_posts->set_options_handler( new TSP_Easy_Dev_Options_Featured_Posts( $easy_dev_settings ), true );

$featured_posts->set_widget_handler( 'TSP_Easy_Dev_Widget_Featured_Posts');

$featured_posts->add_link ( 'FAQ',		'http://wordpress.org/extend/plugins/tsp-featured-posts/faq/' );
$featured_posts->add_link ( 'Rate Me',	'http://wordpress.org/support/view/plugin-reviews/tsp-featured-posts' );
$featured_posts->add_link ( 'Support', 	'http://lab.thesoftwarepeople.com/tracker/wordpress-fp/issues/new' );

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

function tspfp_widgets_init()
{
	global $featured_posts;
	
	register_widget ( $featured_posts->get_widget_handler() ); 
	apply_filters( $featured_posts->get_widget_handler().'-init', $featured_posts->get_options_handler() );
}// end tspfp_widgets_init

// Initialize widget - Required by WordPress
add_action('widgets_init', 'tspfp_widgets_init');
?>