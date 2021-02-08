<?php
    /*
    Plugin Name: 	LAPDI Featured Posts
    Plugin URI: 	https://letaprodoitcom/apps/plugins/wordpress/featured-posts-for-wordpress/
    Description: 	Featured Posts allows you to <strong>add featured posts with quotes to your blog</strong>'s website. Powered by <strong><a href="http://wordpress.org/plugins/tsp-easy-dev/">LAPDI Easy Dev</a></strong>.
    Author: 		Let A Pro Do IT!
    Author URI: 	https://letaprodoit.com/
    Version: 		1.3.3
    Text Domain: 	tspfp
    Copyright: 		Copyright � 2021 Let A Pro Do IT!, LLC (www.letaprodoit.com). All rights reserved
    License: 		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
    */

    require_once(ABSPATH . 'wp-admin/includes/plugin.php' );

    define('TSPFP_PLUGIN_FILE', 				__FILE__ );
    define('TSPFP_PLUGIN_PATH',					plugin_dir_path( __FILE__ ) );
    define('TSPFP_PLUGIN_URL', 					plugin_dir_url( __FILE__ ) );
    define('TSPFP_PLUGIN_BASE_NAME', 			plugin_basename( __FILE__ ) );
    define('TSPFP_PLUGIN_NAME', 				'tsp-featured-posts');
    define('TSPFP_PLUGIN_TITLE', 				'Featured Posts');
    define('TSPFP_PLUGIN_REQ_VERSION', 			"3.5.1");

    if (file_exists( WP_PLUGIN_DIR . "/tsp-easy-dev/tsp-easy-dev.php" ))
    {
        include_once WP_PLUGIN_DIR . "/tsp-easy-dev/tsp-easy-dev.php";
    }//end else
    else
        return;

    global $easy_dev_settings;

    require( TSPFP_PLUGIN_PATH . 'TSP_Easy_Dev.config.php');
    require( TSPFP_PLUGIN_PATH . 'TSP_Easy_Dev.extend.php');
    //--------------------------------------------------------
    // initialize the plugin
    //--------------------------------------------------------
    $featured_posts 						= new TSP_Easy_Dev( TSPFP_PLUGIN_FILE, TSPFP_PLUGIN_REQ_VERSION );

    $featured_posts->set_options_handler( new TSP_Easy_Dev_Options_Featured_Posts( $easy_dev_settings ), true );

    $featured_posts->set_widget_handler( 'TSP_Easy_Dev_Widget_Featured_Posts');

    $featured_posts->add_link ( 'FAQ',          preg_replace("/\%PLUGIN\%/", TSPFP_PLUGIN_NAME, TSP_WORDPRESS_FAQ_URL ));
    $featured_posts->add_link ( 'Rate Me',      preg_replace("/\%PLUGIN\%/", TSPFP_PLUGIN_NAME, TSP_WORDPRESS_RATE_URL ) );
    $featured_posts->add_link ( 'Support',      preg_replace("/\%PLUGIN\%/", 'wordpress-fp', TSP_LAB_BUG_URL ));

    $featured_posts->uses_shortcodes 				= true;

    // Queue User styles
    $featured_posts->add_css( TSPFP_PLUGIN_URL . 'assets/css' . DS . 'movingboxes.css' );

    if ( TSP_Easy_Dev_Tools::this_browser( 'IE', 8 ) )
    {
        $featured_posts->add_css( TSPFP_PLUGIN_URL . 'assets/css' . DS . 'movingboxes-ie.css' );
    }//endif

    if ( TSP_Easy_Dev_Tools::this_browser( 'IE' ) )
    {
        $featured_posts->add_css( TSPFP_PLUGIN_URL . TSPFP_PLUGIN_NAME . '.ie.css' );
    }//endif
    else
    {
        $featured_posts->add_css( TSPFP_PLUGIN_URL . TSPFP_PLUGIN_NAME . '.css' );
    }//endelse

    // Queue User Scripts
    $featured_posts->add_script( TSPFP_PLUGIN_URL . 'assets/js' . DS . 'jquery.movingboxes.js', array('jquery') );
    $featured_posts->add_script( TSPFP_PLUGIN_URL . 'assets/js' . DS . 'slider-scripts.js', array('jquery') );
    $featured_posts->add_script( TSPFP_PLUGIN_URL . 'assets/js' . DS . 'scripts.js',  array('jquery') );

    $featured_posts->set_plugin_icon( TSP_EASY_DEV_ASSETS_IMAGES_URL . 'icon_16.png' );

    $featured_posts->add_shortcode ( TSPFP_PLUGIN_NAME );
    $featured_posts->add_shortcode ( 'tsp_featured_posts' ); //backwards compatibility

    $featured_posts->run( TSPFP_PLUGIN_FILE );

    // Initialize widget - Required by WordPress
    add_action('widgets_init', function()
    {
        global $featured_posts;

        register_widget ( $featured_posts->get_widget_handler() );
        apply_filters( $featured_posts->get_widget_handler().'-init', $featured_posts->get_options_handler() );
    });