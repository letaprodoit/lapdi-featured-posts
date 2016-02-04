<?php									
/* @group Easy Dev Package settings, all plugins use the same settings, DO NOT EDIT */
if ( !defined( 'TSP_PARENT_NAME' )) define('TSP_PARENT_NAME', 			'tsp_plugins');
if ( !defined( 'TSP_PARENT_TITLE' )) define('TSP_PARENT_TITLE', 		'TSP Plugins');
if ( !defined( 'TSP_PARENT_MENU_POS' )) define('TSP_PARENT_MENU_POS', 	2617638.180);
/* @end */

// Get the plugin path
if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');

if (!defined('DS')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DS', '\\');
    else define('DS', '/');
}//endif

$easy_dev_settings = get_plugin_data( TSPFP_PLUGIN_FILE, false, false );
$easy_dev_settings['parent_name']			= TSP_PARENT_NAME;
$easy_dev_settings['parent_title']			= TSP_PARENT_TITLE;
$easy_dev_settings['menu_pos'] 				= TSP_PARENT_MENU_POS;

$easy_dev_settings['name'] 					= TSPFP_PLUGIN_NAME;
$easy_dev_settings['key'] 					= $easy_dev_settings['TextDomain'];
$easy_dev_settings['title']					= $easy_dev_settings['Name'];
$easy_dev_settings['title_short']			= $easy_dev_settings['Name'];

$easy_dev_settings['option_prefix']			= TSPFP_PLUGIN_NAME . "-option";
$easy_dev_settings['option_prefix_old']		= $easy_dev_settings['TextDomain']."_options";

$easy_dev_settings['file']	 				= TSPFP_PLUGIN_FILE;
$easy_dev_settings['base_name']	 			= TSPFP_PLUGIN_BASE_NAME;

$easy_dev_settings['widget_width']	 		= 300;
$easy_dev_settings['widget_height'] 		= 350;

$easy_dev_settings['smarty_template_dirs']	= array( TSPFP_PLUGIN_PATH . 'templates', TSP_EASY_DEV_ASSETS_TEMPLATES_PATH );
$easy_dev_settings['smarty_compiled_dir']  	= TSP_EASY_DEV_TMP_PATH . TSPFP_PLUGIN_NAME . DS . 'compiled';
$easy_dev_settings['smarty_cache_dir'] 		= TSP_EASY_DEV_TMP_PATH . TSPFP_PLUGIN_NAME . DS . 'cache';

//* Custom globals *//
$easy_dev_settings['title_short']			= preg_replace("/TSP/","",$easy_dev_settings['Name']);
$easy_dev_settings['store_url']	 			= 'http://www.thesoftwarepeople.com/software/plugins/wordpress';
$easy_dev_settings['wp_query'] 				= '/wp-admin/plugin-install.php?tab=search&type=term&s';
$easy_dev_settings['contact_url'] 			= 'http://www.thesoftwarepeople.com/about-us/contact-us.html';
$easy_dev_settings['plugin_list']			= 'http://www.thesoftwarepeople.com/plugins/wordpress/plugins.json';
//* Custom globals *//

$easy_dev_settings['plugin_options']		= array(
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
		'show_author' 	=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Display Author?', 
			'value' 		=> 'N',
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
		),		
		'show_event_data' 	=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Display Event Data (Requires The Events Calendar)?', 
			'value' 		=> 'N',
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
		),		
		'show_private' 	=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Show Private Posts?', 
			'value' 		=> 'N',
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
		),		
		'read_more_text'=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Read More Text',
			'html'			=> true,
			'value' 		=> '<small>Continue Reading <span class="meta-nav">&rarr;</span></small>',
		),		
		'show_date' 	=> array( 
			'type' 			=> 'SELECT', 
			'label' 		=> 'Display Publish Date?', 
			'value' 		=> 'N',
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
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
		'keep_formatting'	=> array( 
			'type'			=> 'SELECT', 
			'label'			=> 'Keep HTML Formatting?', 
			'value'			=> 'N',
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
		),		
		'style'				=> array( 
			'type'			=> 'INPUT', 
			'label'			=> 'CSS style tags', 
			'value'			=> '',
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
			'label' 		=> 'Excerpt length (Layouts #1, #2, #4, #5)', 
			'value' 		=> 100,
		),		
		'post_class'		=> array( 
			'type'			=> 'INPUT', 
			'label'			=> 'Post Class', 
			'value'			=> '',
		),		
		'fpost_type' 		=> array( 
			'type' 			=> 'INPUT', 
			'label' 		=> 'Post Type', 
			'value' 		=> 'post',
			'old_labels'	=> array ('post_type'),
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
									'Slider'										=> 4,
									'Image (top), Title (below), Text (below-last)'	=> 5),
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
		'show_thumb' 	=> array(
			'type' 			=> 'SELECT',
			'label' 		=> 'Show Thumbnails?',
			'value' 		=> 'Y',
			'options'		=> array ('Yes' => 'Y', 'No' => 'N'),
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

$easy_dev_settings['plugin_options']['shortcode_fields'] = $easy_dev_settings['plugin_options']['widget_fields'];		
?>