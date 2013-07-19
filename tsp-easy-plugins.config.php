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

$plugin_globals = get_plugin_data( TSPFP_PLUGIN_FILE, false, false );
$plugin_globals['parent_name']			= TSP_PARENT_NAME;
$plugin_globals['parent_title']			= TSP_PARENT_TITLE;
$plugin_globals['parent_menu'] 			= TSP_PARENT_MENU_POS;

$plugin_globals['name'] 				= TSPFP_PLUGIN_NAME;
$plugin_globals['key'] 					= $plugin_globals['TextDomain'];
$plugin_globals['title']				= $plugin_globals['Name'];
$plugin_globals['title_short']			= $plugin_globals['Name'];

$plugin_globals['option_name']			= TSPFP_PLUGIN_NAME . "-option";
$plugin_globals['option_name_old']		= $plugin_globals['TextDomain']."_options";

$plugin_globals['file']	 				= TSPFP_PLUGIN_FILE;

$plugin_globals['widget_width']	 		= 300;
$plugin_globals['widget_height'] 		= 350;

$plugin_globals['smarty_template_dirs']	= array( TSPFP_PLUGIN_PATH . 'templates', TSP_EASY_PLUGINS_ASSETS_TEMPLATES_PATH );
$plugin_globals['smarty_compiled_dir']  = TSP_EASY_PLUGINS_TMP_PATH . TSPFP_PLUGIN_NAME . DS . 'compiled';
$plugin_globals['smarty_cache_dir'] 	= TSP_EASY_PLUGINS_TMP_PATH . TSPFP_PLUGIN_NAME . DS . 'cache';

//* Custom globals *//
$plugin_globals['title_short']			= preg_replace("/TSP/","",$plugin_globals['Name']);
$plugin_globals['store_url']	 		= 'http://www.thesoftwarepeople.com/software/plugins/wordpress';
$plugin_globals['wp_query'] 			= '/wp-admin/plugin-install.php?tab=search&type=term&s';
$plugin_globals['contact_url'] 			= 'http://www.thesoftwarepeople.com/about-us/contact-us.html';
$plugin_globals['plugin_list']			= 'http://www.thesoftwarepeople.com/plugins/wordpress/plugin_list.txt';
//* Custom globals *//

$plugin_globals['plugin_data']			= array(
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