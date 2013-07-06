<?php
/*
Plugin Name: 	TSP Featured Posts
Plugin URI: 	http://www.thesoftwarepeople.com/
Description: 	Featured Posts allows you to add featured posts to your blog's website via widget or on pages and posts using shortcodes. Featured Posts has five (5) layouts and can include thumbnails and quotes.
Author: 		The Software People
Author URI: 	http://www.thesoftwarepeople.com/
Version: 		1.0
Copyright: 		Copyright © 2013 The Software People, LLC (www.thesoftwarepeople.com). All rights reserved
License: 		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
*/

// Get the plugin path
if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if (!defined('DIRECTORY_SEPARATOR')) {
    if (strpos(php_uname('s') , 'Win') !== false) define('DIRECTORY_SEPARATOR', '\\');
    else define('DIRECTORY_SEPARATOR', '/');
}

// Set the abs plugin path
define('PLUGIN_ABS_PATH', ABSPATH . PLUGINDIR );
$plugin_abs_path = PLUGIN_ABS_PATH . DIRECTORY_SEPARATOR . "tsp_featured_posts";
define('TSPFP_ABS_PATH', $plugin_abs_path);
$plugin_url = WP_CONTENT_URL . '/plugins/' . plugin_basename(dirname(__FILE__)) . '/';
define('TSPFP_URL_PATH', $plugin_url);

define('TSPFP_TEMPLATE_PATH', TSPFP_ABS_PATH . '/templates');

// Set the file path
$file_path    = $plugin_abs_path . DIRECTORY_SEPARATOR . basename(__FILE__);

// Set the absolute path
$asolute_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
define('TSPFP_ABSPATH', $asolute_path);

include_once(TSPFP_ABS_PATH . '/includes/php-browser-detection.inc.php');
include_once(TSPFP_ABS_PATH . '/includes/settings.inc.php');
include_once(TSPFP_ABS_PATH . '/libs/Smarty.class.php');

//--------------------------------------------------------
// Process shortcodes
//--------------------------------------------------------
function fn_tsp_featured_posts_process_shortcodes($att)
{
	global $TSPFP_OPTIONS;
	
	if ( is_feed() )
		return '[tsp_featured_posts]';

	$options = $TSPFP_OPTIONS;
	
	if (!empty($att))
		$options = array_merge( $TSPFP_OPTIONS, $att );
		     	
	$output = fn_tsp_featured_posts_display($options,false);
	
	return $output;
}

add_shortcode('tsp_featured_posts', 'fn_tsp_featured_posts_process_shortcodes');

//--------------------------------------------------------
// Get post thumbnail
//--------------------------------------------------------
function fn_tsp_featured_posts_get_thumbnail($post)
{
    $img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $img    = $matches[1][0];
    return $img;
}

//--------------------------------------------------------
// Get post video
//--------------------------------------------------------
function fn_tsp_featured_posts_get_video($post)
{
    $video = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<code>(.*?)<\/code>/i', $post->post_content, $matches);
    $video    = $matches[1][0];
    
    if (!$video)
    {
	    //if its not wrapped in the code tags find the other methods of viewing videos
	    $output = preg_match_all('/<iframe (.*?)>(.*?)<\/iframe>/i', $post->post_content, $matches);
	    $video    = $matches[0][0];
    }
    
    if (!$video)
    {
	    //if its not wrapped in the code tags find the other methods of viewing videos
	    $output = preg_match_all('/<object (.*?)>(.*?)<\/object>/i', $post->post_content, $matches);
	    $video    = $matches[0][0];
    }
    
    return $video;
}
//--------------------------------------------------------
// Adjust the size of a video
//--------------------------------------------------------
function fn_tsp_featured_posts_adjust_video($video, $width, $height)
{
	$video = preg_replace('/width="(.*?)"/i', 'width="'.$width.'"', $video);
	$video = preg_replace('/height="(.*?)"/i', 'height="'.$height.'"', $video);
	
	$video = preg_replace('/width=\'(.*?)\'/i', 'width=\''.$width.'\'', $video);
	$video = preg_replace('/height=\'(.*?)\'/i', 'height=\''.$height.'\'', $video);
	
	return $video;
}
//--------------------------------------------------------
// Queue the stylesheet
//--------------------------------------------------------
function fn_tsp_featured_posts_enqueue_styles()
{
    wp_enqueue_style('movingboxes.css', TSPFP_URL_PATH . 'css/movingboxes.css');
        
    if (is_lt_IE9())
    	wp_enqueue_style('movingboxes-ie.css', TSPFP_URL_PATH . 'css/movingboxes-ie.css');
    	
    if (is_IE())
    	wp_enqueue_style('tsp_featured_posts.ie.css', TSPFP_URL_PATH . 'tsp_featured_posts.ie.css');
    else
    	wp_enqueue_style('tsp_featured_posts.css', TSPFP_URL_PATH . 'tsp_featured_posts.css');

}

add_action('wp_print_styles', 'fn_tsp_featured_posts_enqueue_styles');

//--------------------------------------------------------
// Queue the scripts
//--------------------------------------------------------
function fn_tsp_featured_posts_enqueue_scripts()
{
    wp_enqueue_script( 'jquery' );
    
    wp_register_script('jquery.movingboxes.js', TSPFP_URL_PATH . 'js/jquery.movingboxes.js', array('jquery'));
    wp_enqueue_script('jquery.movingboxes.js');
    
    wp_enqueue_script('tsp_featured_posts-slider-scripts.js', TSPFP_URL_PATH . 'js/tsp_featured_posts-slider-scripts.js', array('jquery','jquery.movingboxes.js'));
    wp_enqueue_script('tsp_featured_posts-scripts.js', TSPFP_URL_PATH . 'js/tsp_featured_posts-scripts.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'fn_tsp_featured_posts_enqueue_scripts');

//--------------------------------------------------------
// Show simple featured posts
//--------------------------------------------------------
function fn_tsp_featured_posts_display ($args = null, $echo = true)
{
    global $TSPFP_OPTIONS;
	    
	$smarty = new Smarty;
	$smarty->setTemplateDir(TSPFP_TEMPLATE_PATH);
	$smarty->setCompileDir(TSPFP_TEMPLATE_PATH.'/compiled/');
	$smarty->setCacheDir(TSPFP_TEMPLATE_PATH.'/cache/');
	
	$return_HTML = "";
	
	$fp = $TSPFP_OPTIONS;
	
	if (!empty($args))
		$fp = array_merge( $TSPFP_OPTIONS, $args );
    
    // User settings
    $title        = $fp['title'];
    $showquotes   = $fp['showquotes'];
    $showtextposts= $fp['showtextposts'];
    $numberposts  = $fp['numberposts'];
    $category     = $fp['category'];
    $layout       = $fp['layout'];
    $orderby      = $fp['orderby'];
    $widththumb   = $fp['widththumb'];
    $heightthumb  = $fp['heightthumb'];
    $before_title = $fp['beforetitle'];
    $after_title  = $fp['aftertitle'];        
    
    
    // If there is a title insert before/after title tags
    if (!empty($title)) {
        $return_HTML .= $before_title . $title . $after_title;
    }
    
    // Process Featured Posts
    global $post;
    
    $args                  = 'category=' . $category . '&numberposts=' . $numberposts . '&orderby=' . $orderby;
    
    $queried_posts = get_posts($args);
        
	// gallery before & after code
	if ($layout == 4 && count($queried_posts) > 0)
	{
		$return_HTML .= '
			<!-- Layout #4 -->
			<div id="postSliderWrapper">
				<div id="postSlider">
			';
	}
	
    
    foreach ($queried_posts as $post)
    {    
        setup_postdata($post);
        
        $text = "";
        $full_preview = "";        
                        
        // get the first image
        $first_img     = fn_tsp_featured_posts_get_thumbnail($post);
        $first_video = null;
        
        if (empty($first_img))
        {
        	$first_video = fn_tsp_featured_posts_get_video($post);
        
	       	if (!empty($first_video))
	       		$first_video = fn_tsp_featured_posts_adjust_video($first_video,$widththumb,$heightthumb);
	    }//endif

        // get the quote for the post
        $quote_arr = get_post_custom_values('quote');
        $quote     = $quote_arr[0]; //There should only be one quote dont loop

        $target = "_self";
        
        if (get_post_format() == 'link')
        	$target = "_blank";
        
        if (in_array($layout, array(1,2,4)))
        {
	        // get the bottom content
	        $content_bottom = apply_filters('the_content','');
	        $content_bottom  = preg_replace('/<p>(.*?)<\/p>/m', "$1", $content_bottom);
	        	
	        // get the content to <!--more--> tag
	        $extended_post = get_extended($post->post_content);
	        
	        // add in formatting
	        $full_preview  = apply_filters('the_content', $extended_post['main']);
	
	        // remove bottom content from fullpreview to prevent it from displaying twice
	        $full_preview = str_replace($content_bottom, "", $full_preview);
	        
        	$excerpt_length = 90;
        	
        	if ($quote)
         		$excerpt_length = 80;
         	if ($layout == 1)
         		$excerpt_length = 35;
       	
        	$full_preview  = strip_tags($full_preview);
	        $full_preview  = preg_replace('/\[youtube=(.*?)\]/m', "", $full_preview);
        	        	
	        $words          = explode(' ', $full_preview, $excerpt_length + 1);
	        
	        if (count($words) > $excerpt_length) {
	            array_pop($words);
	            array_push($words, '…');
	            $full_preview          = implode(' ', $words);
	        }
        }
        else
        {
	        $text           = get_the_excerpt();
        	//$text  			= strip_tags($text);
	        $text           = strip_shortcodes($text);
	        $text           = apply_filters('the_content', $text);
	        $text           = str_replace(']]>', ']]&gt;', $text);
	        $text           = str_replace('<[[', '&lt;[[', $text);
	        $text 		 	= preg_replace('/\[youtube=(.*?)\]/m', "", $text);
	        	        	        
	        $excerpt_length = 100;
	        
	        $words          = explode(' ', $text, $excerpt_length + 1);
	        
	        if (count($words) > $excerpt_length) {
	            array_pop($words);
	            array_push($words, '…');
	            $text          = implode(' ', $words);
	        }
        }
        
        $media_found = false;
        
        if ($first_img || $first_video)
        	$media_found = true;
        
        // Only show articles that have associated images if $showtextposts is set to 'Y' and
        // $showtextposts is 'N' and there are at least a video or image
        if ($showtextposts == 'Y' || ($showtextposts == 'N' && $media_found == true)) {
        
        	$title = get_the_title();
        	
        	$max_words = 7;
        	$words          = explode(' ', $title, $max_words + 1);
 	        
 	        if (count($words) > $max_words) {
	            array_pop($words);
	            array_push($words, '…');
	            $title          = implode(' ', $words);
	        }
           	           		
		    // Store values into Smarty
		    foreach ($fp as $key => $val)
		    {
		    	$smarty->assign("$key", $val, true);
		    }

			$smarty->assign("ID", get_the_ID(), true);
			$smarty->assign("post_class", get_post_class(), true);
			$smarty->assign("comments_open", comments_open(), true);
			$smarty->assign("post_password_required", post_password_required(), true);
			$smarty->assign("long_title", get_the_title(), true);
			$smarty->assign("wp_link_pages", wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'tsp_featured_posts' ), 'after' => '</div>', 'echo' => 0 ) ), true);
			$smarty->assign("edit_post_link", get_edit_post_link( __( 'Edit', 'tsp_featured_posts' ), '<div class="edit-link">', '</div>', get_the_ID() ), true);
			$smarty->assign("author_first_name", get_the_author_meta('first_name'), true);
			$smarty->assign("author_last_name", get_the_author_meta('last_name'), true);
			$smarty->assign("sticky", is_sticky(get_the_ID()), true);
			
			$smarty->assign("featured", __( 'Featured', 'tsp_featured_posts' ), true);
			$smarty->assign("title", $title, true);
			$smarty->assign("first_img", $first_img, true);
			$smarty->assign("first_video", $first_video, true);
			$smarty->assign("target", $target, true);
			$smarty->assign("text", $text, true);
			$smarty->assign("quote", $quote, true);
			$smarty->assign("full_preview", $full_preview, true);
			$smarty->assign("content_bottom", $content_bottom, true);
            
            $return_HTML .= $smarty->fetch('layout'.$layout.'.tpl');
        }
    } //endforeach;
    
	if ($layout == 4 && count($queried_posts) > 0)
    {
    	$return_HTML .= '
    		</div>
    	</div> <!-- end wrapper -->';
    }
    
    if ($echo)
    	echo $return_HTML;
    else
    	return $return_HTML;
}

//--------------------------------------------------------
// Widget Section
//--------------------------------------------------------

//--------------------------------------------------------
// Register widget
//--------------------------------------------------------
function fn_tsp_featured_posts_widget_init()
{
    register_widget('TSP_Featured_Posts_Widget');
}

// Add functions to init
add_action('widgets_init', 'fn_tsp_featured_posts_widget_init');
//--------------------------------------------------------

class TSP_Featured_Posts_Widget extends WP_Widget
{
    //--------------------------------------------------------
    // Constructor
	//--------------------------------------------------------
	function __construct()
    {
        // Get widget options
        $widget_options  = array(
            'classname'                 => 'widget_tsp_featured_posts',
            'description'               => __('This widget allows you to add in your sites themes a list of featured posts.', 'tsp_featured_posts')
        );
        
        // Get control options
        $control_options = array(
            'width' => 300,
            'height' => 350,
            'id_base' => 'widget_tsp_featured_posts'
        );
        
        // Create the widget
		parent::__construct('widget_tsp_featured_posts', __('TSP Featured Posts', 'tsp_featured_posts') , $widget_options, $control_options);
    }
    
    //--------------------------------------------------------
    // initialize the widget
	//--------------------------------------------------------
    function widget($args, $instance)
    {
        extract($args);
        
        $arguments = array(
            'title' 		=> $instance['title'],
            'showquotes' 	=> $instance['showquotes'],
            'showtextposts' => $instance['showtextposts'],
            'layout' 		=> $instance['layout'],
            'numberposts' 	=> $instance['numberposts'],
            'category' 		=> $instance['category'],
            'orderby' 		=> $instance['orderby'],
            'widththumb' 	=> $instance['width-thumb'],
            'heightthumb'	=> $instance['height-thumb'],
            'beforetitle' 	=> $before_title,
            'aftertitle' 	=> $after_title
        );
                
        // Display the widget
        echo $before_widget;
        fn_tsp_featured_posts_display($arguments);
        echo $after_widget;
    }
    
    //--------------------------------------------------------
    // update the widget
	//--------------------------------------------------------
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        // Update the widget data
        $instance['title']          = strip_tags($new_instance['title']);
        $instance['showquotes']     = $new_instance['showquotes'];
        $instance['showtextposts']  = $new_instance['showtextposts'];
        $instance['layout']         = $new_instance['layout'];
        $instance['category']       = $new_instance['category'];
        $instance['numberposts']    = $new_instance['numberposts'];
        $instance['orderby']        = $new_instance['orderby'];
        $instance['width-thumb']    = $new_instance['width-thumb'];
        $instance['height-thumb']   = $new_instance['height-thumb'];
        return $instance;
    }
    
    //--------------------------------------------------------
    // display the form
	//--------------------------------------------------------
    function form($instance)
    {
        // Set default values for widget
        $instance = wp_parse_args((array)$instance, $TSPFP_DEFAULTS); ?>
      
<!-- Display the title -->
<p>
   <label for="<?php
        echo $this->get_field_id('title'); ?>"><?php
        _e('Title:', 'tsp_featured_posts') ?></label>
   <input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" value="<?php
        echo $instance['title']; ?>" style="width:100%;" />
</p>

<!-- Display quotes? -->
<p>
   <label for="<?php
        echo $this->get_field_id('showquotes'); ?>"><?php
        _e('Display quotes?', 'tsp_featured_posts') ?></label>
   <select name="<?php
        echo $this->get_field_name('showquotes'); ?>" id="<?php
        echo $this->get_field_id('showquotes'); ?>" >
      <option class="level-0" value="Y" <?php
        if ($instance['showquotes'] == "Y") echo " selected='selected'" ?>><?php
        _e('Yes', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="N" <?php
        if ($instance['showquotes'] == "N") echo " selected='selected'" ?>><?php
        _e('No', 'tsp_featured_posts') ?></option>
   </select>
</p>

<!-- Display text only posts? -->
<p>
   <label for="<?php
        echo $this->get_field_id('showtextposts'); ?>"><?php
        _e('Show Posts With No Media Content?', 'tsp_featured_posts') ?></label>
   <select name="<?php
        echo $this->get_field_name('showtextposts'); ?>" id="<?php
        echo $this->get_field_id('showtextposts'); ?>" >
      <option class="level-0" value="Y" <?php
        if ($instance['showtextposts'] == "Y") echo " selected='selected'" ?>><?php
        _e('Yes', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="N" <?php
        if ($instance['showtextposts'] == "N") echo " selected='selected'" ?>><?php
        _e('No', 'tsp_featured_posts') ?></option>
   </select>
</p>

<!-- Display the number of posts -->
<p>
   <label for="<?php
        echo $this->get_field_id('numberposts'); ?>"><?php
        _e('How many posts do you want to display?', 'tsp_featured_posts') ?></label>
   <input id="<?php
        echo $this->get_field_id('numberposts'); ?>" name="<?php
        echo $this->get_field_name('numberposts'); ?>" value="<?php
        echo $instance['numberposts']; ?>" style="width:100%;" />
</p>

<!-- Choose the post's category -->
<p>
   <label for="<?php
        echo $this->get_field_id('category'); ?>"><?php
        _e('Enter the category ID to query from. Enter 0 to query all categories.', 'tsp_featured_posts') ?></label>
   <input id="<?php
        echo $this->get_field_id('category'); ?>" name="<?php
        echo $this->get_field_name('category'); ?>" value="<?php
        echo $instance['category']; ?>" style="width:20%;" />
</p>

<!-- Choose the post's layout -->
<p>
   <label for="<?php
        echo $this->get_field_id('layout'); ?>"><?php
        _e('Choose layout of the post preview:', 'tsp_featured_posts') ?></label>
   <select name="<?php
        echo $this->get_field_name('layout'); ?>" id="<?php
        echo $this->get_field_id('layout'); ?>" >
      <option class="level-0" value="0" <?php
        if ($instance['layout'] == "0") echo " selected='selected'" ?>><?php
        _e('Left: Image - Right: Title, Text (Thumbnail)', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="1" <?php
        if ($instance['layout'] == "1") echo " selected='selected'" ?>><?php
        _e('Top: Title - Left: Image - Right: Text (Featured-Medium)', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="2" <?php
        if ($instance['layout'] == "2") echo " selected='selected'" ?>><?php
        _e('Left: Title, Image - Right: Text (Featured-Large)', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="3" <?php
        if ($instance['layout'] == "3") echo " selected='selected'" ?>><?php
        _e('Left: Image - Right: Text (Thumbnail/No title)', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="4" <?php
        if ($instance['layout'] == "4") echo " selected='selected'" ?>><?php
        _e('Slider: Title, Image - Right: Text (Featured-Large)', 'tsp_featured_posts') ?></option>
   </select>
</p>

<!-- Choose how the posts will be ordered -->
<p>
   <label for="<?php
        echo $this->get_field_id('orderby'); ?>"><?php
        _e('Choose type of order:', 'tsp_featured_posts') ?></label>
   <select name="<?php
        echo $this->get_field_name('orderby'); ?>" id="<?php
        echo $this->get_field_id('orderby'); ?>" >
      <option class="level-0" value="rand" <?php
        if ($instance['orderby'] == "rand") echo " selected='selected'" ?>><?php
        _e('Random', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="title" <?php
        if ($instance['orderby'] == "title") echo " selected='selected'" ?>><?php
        _e('Title', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="date" <?php
        if ($instance['orderby'] == "date") echo " selected='selected'" ?>><?php
        _e('Date', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="author" <?php
        if ($instance['orderby'] == "author") echo " selected='selected'" ?>><?php
        _e('Author', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="modified" <?php
        if ($instance['orderby'] == "modified") echo " selected='selected'" ?>><?php
        _e('Modified', 'tsp_featured_posts') ?></option>
      <option class="level-0" value="ID" <?php
        if ($instance['orderby'] == "ID") echo " selected='selected'" ?>><?php
        _e('ID', 'tsp_featured_posts') ?></option>
   </select>
</p>

<!-- Choose the thumbnail width -->
<p>
   <input id="<?php
        echo $this->get_field_id('width-thumb'); ?>" name="<?php
        echo $this->get_field_name('width-thumb'); ?>" value="<?php
        echo $instance['width-thumb']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('width-thumb'); ?>"><?php
        _e('Width Thumbnail', 'tsp_featured_posts') ?></label>
</p>

<!-- Choose the thumbnail height -->
<p>
   <input id="<?php
        echo $this->get_field_id('height-thumb'); ?>" name="<?php
        echo $this->get_field_name('height-thumb'); ?>" value="<?php
        echo $instance['height-thumb']; ?>" style="width:20%;" />
   <label for="<?php
        echo $this->get_field_id('height-thumb'); ?>"><?php
        _e('Height Thumbnail', 'tsp_featured_posts') ?></label>
</p>
   <?php
    }
} //end class TSP_Featured_Posts_Widget


//---------------------------------------------------
// Post MetaData Section
//---------------------------------------------------

//--------------------------------------------------------
// save the metadata
//--------------------------------------------------------
function fn_tsp_featured_posts_modify_data($post_ID)
{
    $article = get_post($post_ID);
    
    // quote
    if ($_POST['insert_quote_post']) {
        add_post_meta($article->ID, 'quote', "{$_POST['insert_quote_post']}", TRUE) or update_post_meta($article->ID, 'quote', "{$_POST['insert_quote_post']}");
    } else {
        delete_post_meta($article->ID, 'quote');
    }
}

add_action('new_to_publish', 'fn_tsp_featured_posts_modify_data');
add_action('save_post', 'fn_tsp_featured_posts_modify_data');
//--------------------------------------------------------

//--------------------------------------------------------
// Funciton to display form fields to update/save meta data
//--------------------------------------------------------
function fn_tsp_featured_posts_box()
{
    global $post;
    $quote    = get_post_meta($post->ID, 'quote', 1);
?>
<p>
	<label for="insert_quote_post"><?php
    _e('Intro Post Quote?', 'quote-post') ?></label>
	<textarea name="insert_quote_post" id="insert_quote_post" cols="25" rows="5"><?php
    echo $quote; ?></textarea>
</p>
<?php
}

//--------------------------------------------------------
// Funciton to display form fields to update/save meta data
//--------------------------------------------------------
function fn_tsp_featured_posts_add_box()
{
    add_meta_box('post_info', __('TSP Featured Post Information', 'tsp_featured_posts') , 'fn_tsp_featured_posts_box', 'post', 'side', 'high');
}

add_action('admin_menu', 'fn_tsp_featured_posts_add_box');
//--------------------------------------------------------
?>