<?php									
/* @group Easy Plugins Package settings, all plugins use the same settings, DO NOT EDIT */
if ( !defined( 'TSP_PARENT_NAME' )) define('TSP_PARENT_NAME', 			'tsp_plugins');
if ( !defined( 'TSP_PARENT_TITLE' )) define('TSP_PARENT_TITLE', 		'TSP Plugins');
if ( !defined( 'TSP_PARENT_MENU_POS' )) define('TSP_PARENT_MENU_POS', 	2617638);
/* @end */

// Get the plugin path
if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');

if (!defined('DS')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DS', '\\');
    else define('DS', '/');
}//endif

$easy_plugin_settings = get_plugin_data( TSPFP_PLUGIN_FILE, false, false );
$easy_plugin_settings['parent_name']			= TSP_PARENT_NAME;
$easy_plugin_settings['parent_title']			= TSP_PARENT_TITLE;
$easy_plugin_settings['menu_pos'] 				= TSP_PARENT_MENU_POS;

$easy_plugin_settings['name'] 					= TSPFP_PLUGIN_NAME;
$easy_plugin_settings['key'] 					= $easy_plugin_settings['TextDomain'];
$easy_plugin_settings['title']					= $easy_plugin_settings['Name'];
$easy_plugin_settings['title_short']			= $easy_plugin_settings['Name'];

$easy_plugin_settings['option_name']			= TSPFP_PLUGIN_NAME . "-option";
$easy_plugin_settings['option_name_old']		= $easy_plugin_settings['TextDomain']."_options";

$easy_plugin_settings['file']	 				= TSPFP_PLUGIN_FILE;

$easy_plugin_settings['widget_width']	 		= 300;
$easy_plugin_settings['widget_height'] 			= 350;

$easy_plugin_settings['smarty_template_dirs']	= array( TSPFP_PLUGIN_PATH . 'templates', TSP_EASY_PLUGINS_ASSETS_TEMPLATES_PATH );
$easy_plugin_settings['smarty_compiled_dir']  	= TSP_EASY_PLUGINS_TMP_PATH . TSPFP_PLUGIN_NAME . DS . 'compiled';
$easy_plugin_settings['smarty_cache_dir'] 		= TSP_EASY_PLUGINS_TMP_PATH . TSPFP_PLUGIN_NAME . DS . 'cache';

//* Custom globals *//
$easy_plugin_settings['title_short']			= preg_replace("/TSP/","",$easy_plugin_settings['Name']);
$easy_plugin_settings['store_url']	 			= 'http://www.thesoftwarepeople.com/software/plugins/wordpress';
$easy_plugin_settings['wp_query'] 				= '/wp-admin/plugin-install.php?tab=search&type=term&s';
$easy_plugin_settings['contact_url'] 			= 'http://www.thesoftwarepeople.com/about-us/contact-us.html';
$easy_plugin_settings['plugin_list']			= 'http://www.thesoftwarepeople.com/plugins/wordpress/plugins.json';
//* Custom globals *//

$easy_plugin_settings['plugin_data']			= array(
	'post_fields'						=> array(		
		'quote' 		=> array( 
			'type' 			=> 'TEXTAREA', 
			'label' 		=> 'Intro Post Quote?', 
			'value' 		=> ''
		),
	),
	'widget_fields'						=> array(		
		'title' 		=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Title', 
			'value' 		=> 'TSP Featured Posts',
		),		
		'max_words' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Max Number of Words in the Title', 
			'value' 		=>  7,
		),		
		'show_quotes' 	=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Show Intro Quotes?', 
			'value' 		=> 'Y',
			'old_labels'	=> array ('showquotes'),
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
		),		
		'show_text_posts' 	=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Show Posts With No Media Content?', 
			'value' 		=> 'Y',
			'old_labels'	=> array ('showtextposts'),
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
		),		
		'number_posts' 		=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'How many posts do you want to display?', 
			'value' 		=> 5,
			'old_labels'	=> array ('numberposts'),
		),		
		'excerpt_min' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Excerpt length (Layouts #0 & #3)', 
			'value' 		=> 60,
		),		
		'excerpt_max' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Excerpt length (Layouts #1, #2 & #4)', 
			'value' 		=> 100,
		),		
		'post_ids' 		=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Post IDs to display', 
			'value' 		=> '',
			'old_labels'	=> array ('postids'),
		),		
		'category' 		=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Enter the category ID to query from.<br>Enter 0 to query all categories.', 
			'value' 		=> 0,
		),		
		'slider_width' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Slider Width (Sliding Gallery Only)', 
			'value' 		=> 865,
			'old_labels'	=> array ('widthslider'),
		),		
		'slider_height' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Slider Height (Sliding Gallery Only)', 
			'value' 		=> 360,
			'old_labels'	=> array ('heightslider'),
		),		
		'layout' 		=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Choose the post layout:', 
			'value' 		=> 0,
			'options'		=> array( 
									'Image (left), Title, Text (right)'				=> 0,
									'Title (top), Image (below,left), Text (right)'	=> 1,
									'Title, Image (left) - Text (right)'			=> 2,
									'Image (left) - Text (right)'					=> 3,
									'Slider'										=> 4),
		),		
		'order_by' 		=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Order by', 
			'value' 		=> 0,
			'old_labels'	=> array('orderby'),
			'options'		=> array(
									'Random' 	=>	'rand',
									'Title'		=>	'title',
									'Date'		=>	'date',
									'Author'	=>	'author',
									'Modified'	=>	'modified',
									'ID'		=>	'ID'),
		),		
		'thumb_width' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Thumbnail Width', 
			'value' 		=> 80,
			'old_labels'	=> array ('widththumb'),
		),		
		'thumb_height' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Thumbnail Height', 
			'value' 		=> 80,
			'old_labels'	=> array ('heightthumb'),
		),		
		'before_title' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'HTML Before Title', 
			'value' 		=> '<h3 class="widget-title">',
			'html'			=> true,
			'old_labels'	=> array ('beforetitle'),
		),		
		'after_title' 	=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'HTML After Title', 
			'value' 		=> '</h3>',
			'html'			=> true,
			'old_labels'	=> array ('aftertitle'),
		)
	),
);
?>