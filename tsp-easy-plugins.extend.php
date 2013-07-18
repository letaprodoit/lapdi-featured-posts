<?php				
/**
 * TSP_Easy_Plugins_Settings_Featured_Posts - Extends the TSP_Plugin_Settings Class
 * @package TSP_Easy_Plugins
 * @author sharrondenice, thesoftwarepeople
 * @author Sharron Denice, The Software People
 * @copyright 2013 The Software People
 * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
 */

/**
 * Extends the TSP_Easy_Plugins_Settings_Facepile Class
 *
 * original author: Sharron Denice
 */
class TSP_Easy_Plugins_Settings_Featured_Posts extends TSP_Easy_Plugins_Settings
{
	/**
	 * Display all the plugins that The Software People has released
	 *
	 * @since 1.1.0
	 *
	 * @param none
	 *
	 * @return output to stdout
	 */
	public function display_parent_page()
	{
		$active_plugins			= get_option('active_plugins');
		$all_plugins 			= get_plugins();
	
		$free_active_plugins 	= array();
		$free_installed_plugins = array();
		$free_recommend_plugins = array();
		
		$pro_active_plugins 	= array();
		$pro_installed_plugins 	= array();
		$pro_recommend_plugins 	= array();
		
		$plugins_txt = file_get_contents( $this->plugin_globals['plugin_list'] );
		$tsp_plugins =  preg_split( "/\n/", $plugins_txt );

		foreach ( $tsp_plugins as $line => $meta )
		{
			$tsp_plugins[$line] = preg_split("/\|/", $meta );
			
			$plugin_data = $tsp_plugins[$line];
			
			$plugin_type 	= $plugin_data[0];
			$plugin_file	= $plugin_data[1];
			
			$saved_plugin = array (
				'title' 	=> $plugin_data[2],
				'desc' 		=> $plugin_data[3],
				'more_url' 	=> $plugin_data[4],
				'store_url' => $plugin_data[5],
				'wp_url' 	=> $plugin_data[6],
				'settings' 	=> $plugin_data[7]
			);
			
			if ( $plugin_type == 'FREE' )
			{
				if ( in_array(str_replace( "\\", "", $plugin_file), $active_plugins ) )
				{
					$free_active_plugins[] = $saved_plugin;
				}//endif
				elseif ( array_key_exists(str_replace( "\\", "", $plugin_file), $all_plugins ) )
				{
					$free_installed_plugins[] = $saved_plugin;
				}//end elseif
				else
				{
					$free_recommend_plugins[] = $saved_plugin;
				}//endelse
			}//endif
			elseif ( $plugin_type == 'PRO' )
			{
				if ( in_array(str_replace( "\\", "", $plugin_file), $active_plugins ) )
				{
					$pro_active_plugins[] = $saved_plugin;
				}//endif
				elseif ( array_key_exists(str_replace( "\\", "", $plugin_file), $all_plugins ) )
				{
					$pro_installed_plugins[] = $saved_plugin;
				}//endelseif
				else
				{
					$pro_recommend_plugins[] = $saved_plugin;
				}//endelse
			}//endelseif
			
		}//endforeach
		
		$free_active_count									= count($free_active_plugins);
		$free_installed_count 								= count($free_installed_plugins);
		$free_recommend_count 								= count($free_recommend_plugins);

		$free_total											= $free_active_count + $free_installed_count + $free_recommend_count;

		$pro_active_count									= count($pro_active_plugins);
		$pro_installed_count 								= count($pro_installed_plugins);
		$pro_recommend_count 								= count($pro_recommend_plugins);
		
		$pro_total											= $pro_active_count + $pro_installed_count + $pro_recommend_count;
				
		// Display settings to screen
		$template_dirs = array( $this->plugin_globals['templates'], $this->plugin_globals['easy_templates'] );
		$cache_dir = $this->plugin_globals['smarty_cache'];
		$compiled_dir = $this->plugin_globals['smarty_compiled'];
		
		$smarty = TSP_Easy_Plugins_Smarty::get_smarty( $template_dirs, $cache_dir, $compiled_dir );
		$smarty->assign( 'free_active_count',		$free_active_count);
		$smarty->assign( 'free_installed_count',	$free_installed_count);
		$smarty->assign( 'free_recommend_count',	$free_recommend_count);

		$smarty->assign( 'pro_active_count',		$pro_active_count);
		$smarty->assign( 'pro_installed_count',		$pro_installed_count);
		$smarty->assign( 'pro_recommend_count',		$pro_recommend_count);
		
		$smarty->assign( 'free_active_plugins',		$free_active_plugins);
		$smarty->assign( 'free_installed_plugins',	$free_installed_plugins);
		$smarty->assign( 'free_recommend_plugins',	$free_recommend_plugins);

		$smarty->assign( 'pro_active_plugins',		$pro_active_plugins);
		$smarty->assign( 'pro_installed_plugins',	$pro_installed_plugins);
		$smarty->assign( 'pro_recommend_plugins',	$pro_recommend_plugins);

		$smarty->assign( 'free_total',				$free_total);
		$smarty->assign( 'pro_total',				$pro_total);

		$smarty->assign( 'title',					"WordPress Plugins by The Software People");
		$smarty->assign( 'contact_url',				$this->plugin_globals['contact_url']);

		$smarty->display( 'default_admin_menu.tpl');
	}//end ad_menu
	
	/**
	 * Implements the settings_page to display settings specific to this plugin
	 *
	 * @since 1.1.0
	 *
	 * @param none
	 *
	 * @return output to screen
	 */
	function display_plugin_settings_page() 
	{
		$message = "";
		
		$error = "";
		
		// get settings from database
		$database_options = get_option( $this->plugin_globals['option_name'] );
		$defaults = new TSP_Easy_Plugins_Data ( $database_options['widget_fields'] );

		$form = null;
		if ( array_key_exists( $this->plugin_globals['name'] . '_form_submit', $_REQUEST ))
		{
			$form = $_REQUEST[ $this->plugin_globals['name'] . '_form_submit'];
		}//endif
				
		// Save data for settings page
		if( isset( $form ) && check_admin_referer( $this->plugin_globals['name'], $this->plugin_globals['name'] . '_nonce_name' ) ) 
		{
			$defaults->set_values( $_POST );
			$database_options['widget_fields'] = $defaults->get();
			
			update_option( $this->plugin_globals['option_name'], $database_options );
			
			$message = __( "Options saved.", $this->plugin_globals['name'] );
		}

		$form_fields = $defaults->get_values( true );

		// Display settings to screen
		$template_dirs = array( $this->plugin_globals['templates'], $this->plugin_globals['easy_templates'] );
		$cache_dir = $this->plugin_globals['smarty_cache'];
		$compiled_dir = $this->plugin_globals['smarty_compiled'];
		
		$smarty = TSP_Easy_Plugins_Smarty::get_smarty( $template_dirs, $cache_dir, $compiled_dir, true );
		$smarty->assign( 'form_fields',				$form_fields);
		$smarty->assign( 'message',					$message);
		$smarty->assign( 'error',					$error);
		$smarty->assign( 'form',					$form);
		$smarty->assign( 'plugin_name',				$this->plugin_globals['name']);
		$smarty->assign( 'nonce_name',				wp_nonce_field( $this->plugin_globals['name'], $this->plugin_globals['name'].'_nonce_name' ));
		
		$smarty->display( $this->plugin_globals['name'] . '_shortcode_settings.tpl');
				
	}//end settings_page
	
}//end TSP_Easy_Plugins_Settings_Featured_Posts


/**
 * TSP_Easy_Plugins_Widget_Featured_Posts - Extends the TSP_Easy_Plugins_Widget Class
 * @package TSPEasyPlugin
 * @author sharrondenice, thesoftwarepeople
 * @author Sharron Denice, The Software People
 * @copyright 2013 The Software People
 * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
 */

/**
 * Extends the TSP_Easy_Plugins_Widget_Facepile Class
 *
 * original author: Sharron Denice
 */
class TSP_Easy_Plugins_Widget_Featured_Posts extends TSP_Easy_Plugins_Widget
{
	/**
	 * PHP4 constructor
	 */
	public function TSP_Easy_Plugins_Widget_Featured_Posts() 
	{
		TSP_Easy_Plugins_Widget_Featured_Posts::__construct();
	}//end TSP_Plugin_Widget

	/**
	 * PHP5 constructor
	 */
	public function __construct() 
	{
		// TODO: figure out a way to set globals without doing it directly
		$this->plugin_globals 		= get_option ( 'tsp-featured-posts-option' );
		
        // Create the widget
		parent::__construct( $this->plugin_globals );
	}//end __construct

	
	/**
	 * Override required of form function to display widget information
	 *
	 * @since 1.1.0
	 *
	 * @param array $instance Required - array of current values
	 *
	 * @return display to widget box
	 */
	public function display_form( $fields )
	{
		foreach ( $fields as $key => $value )
		{
			// since there are multiple widgets on a page it is important
			// to make sure the id and name are unique to this particular
			// instance of the plugin so override the id and name
			$fields[$key]['id'] 		= $this->get_field_id($key);
			$fields[$key]['name'] 		= $this->get_field_name($key);
		}//end foreach

		$template_dirs = array( $this->plugin_globals['templates'], $this->plugin_globals['easy_templates'] );
		$cache_dir = $this->plugin_globals['smarty_cache'];
		$compiled_dir = $this->plugin_globals['smarty_compiled'];
		
		$smarty = TSP_Easy_Plugins_Smarty::get_smarty( $template_dirs, $cache_dir, $compiled_dir, true );
    	$smarty->assign('form_fields', $fields);
    	$smarty->assign('class', 'widefat');
		$smarty->display( 'default_form.tpl');
	}//end form
	
	/**
	 * Implementation (required) to print widget & shortcode information to screen
	 *
	 * @since 1.1.0
	 *
	 * @param array $fields  - the settings to display
	 * @param boolean $echo Optional - if false returns output instead of displaying to screen
	 *
	 * @return string $output if echo is true displays to screen else returns string
	 */
	public function display_widget( $fields, $echo = true )
	{
	    extract ( $fields );
	    
		$return_HTML = "";

	    // If there is a title insert before/after title tags
	    if (!empty($title)) {
	        $return_HTML .= $before_title . $title . $after_title;
	    }
	    	    
	    $args                  = 'category=' . $category . '&numberposts=' . $number_posts . '&orderby=' . $order_by . '&include=' . $post_ids;
	    
	    $queried_posts = get_posts($args);
	    
	    if (!empty ( $queried_posts ))
	    {
		    $post_cnt = 0;
		    $num_posts = sizeof( $queried_posts );
		
		    // Process Featured Posts
		    global $post;

		    foreach ( $queried_posts as $post )
		    {    
		        setup_postdata( $post );
		        
		        $comments_popup_link = "";
		        
		        $text = "";
		        $full_preview = "";        
		                        
		        // get the first image
		        $first_img     = $this->get_thumbnail($post);
		        $first_video = null;
		        
		        if ( empty( $first_img ) )
		        {
		        	$first_video = $this->get_video( $post );
		        
			       	if ( !empty( $first_video ) )
			       	{
			       		$first_video = $this->adjust_video( $first_video, $thumb_width, $thumb_height);
			       	}//end if
			    }//endif
		
		        // get the quote for the post
		        $quote_arr = get_post_custom_values('quote');
		        $quote = "";
		        $content_bottom = "";
		        
		        if ( !empty ( $quote_arr ) )
		        {
		        	$quote     = $quote_arr[0]; //There should only be one quote dont loop
		        }//end if
		
		        $target = "_self";
		        
		        if ( get_post_format() == 'link')
		        	$target = "_blank";
		        
		        if ( in_array( $layout, array( 1, 2, 4 ) ) )
		        {
			        // get the bottom content
			        $content_bottom = apply_filters('the_content','');
			        $content_bottom  = preg_replace('/<p>(.*?)<\/p>/m', "$1", $content_bottom);
			        	
			        // get the content to <!--more--> tag
			        $extended_post = get_extended( $post->post_content );
			        
			        // add in formatting
			        $full_preview  = apply_filters( 'the_content', $extended_post['main'] );
			
			        // remove bottom content from fullpreview to prevent it from displaying twice
			        $full_preview = str_replace( $content_bottom, "", $full_preview );
			        
		        	if ($quote)
		         	{
		         		$excerpt_length -= 10;
		         	}//end if
		         			       		
		        	$full_preview  	= strip_tags($full_preview);
			        $full_preview  	= preg_replace('/\[youtube=(.*?)\]/m', "", $full_preview);
		        	        	
			        $words          = explode(' ', $full_preview, $excerpt_length + 1);
			        
			        if ( count( $words ) > $excerpt_length ) 
			        {
			            array_pop($words);
			            array_push($words, '…');
			            
			            $full_preview          = implode(' ', $words);
			        }//end if
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
			        	        	        
			        $words          = explode(' ', $text, $excerpt_length + 1);
			        
			        if ( count( $words ) > $excerpt_length ) 
			        {
			            array_pop($words);
			            array_push($words, '…');
			            $text       = implode(' ', $words);
			        }//end if
		        }//end foreach
		        
		        $media_found = false;
		        
		        if ( !empty ( $first_img ) || !empty( $first_video ) )
		        {
		        	$media_found = true;
		        }//end if
		        
		        // Only show articles that have associated images if $show_text_posts is set to 'Y' and
		        // $show_text_posts is 'N' and there are at least a video or image
		        if ( $show_text_posts == 'Y' || ( $show_text_posts == 'N' && $media_found == true ) ) 
		        {
		        	$title = get_the_title();
		        	$ID = get_the_ID();
		        	
		        	$max_words = 7;
		        	$words          = explode(' ', $title, $max_words + 1);
		 	        
		 	        if ( count( $words ) > $max_words ) 
		 	        {
			            array_pop($words);
			            array_push($words, '…');
			            
			            $title          = implode(' ', $words);
			        }//end if
		           	           		
					$template_dirs = array( $this->plugin_globals['templates'], $this->plugin_globals['easy_templates'] );
					$cache_dir = $this->plugin_globals['smarty_cache'];
					$compiled_dir = $this->plugin_globals['smarty_compiled'];
					
					$smarty = TSP_Easy_Plugins_Smarty::get_smarty( $template_dirs, $cache_dir, $compiled_dir );
				    
				    // Store values into Smarty
				    foreach ($fields as $key => $val)
				    {
				    	$smarty->assign("$key", $val, true);
				    }
		
			        $post_cnt++;
			
					if ($post_cnt == 1)
					{
						$smarty->assign("first_post", true, true);
					}//end if
					else
					{
						$smarty->assign("first_post", null, true);
					}//end else
		
					$comments_popup_link = "";
					/*
					$comments_popup_link = comments_popup_link( 
						'<span class="leave-reply">' . __( 'Reply', $this->plugin_globals['name'] ) . '</span>', 
						_x( '1', 'comments number', $this->plugin_globals['name'] ), 
						_x( '%', 'comments number', $this->plugin_globals['name'] ) );*/

					$smarty->assign("ID", $ID, true);
					$smarty->assign("post_class", implode( " ", get_post_class() ), true);
					$smarty->assign("comments_open", comments_open(), true);
					$smarty->assign("post_password_required", post_password_required(), true);
					$smarty->assign("long_title", get_the_title(), true);
					$smarty->assign("wp_link_pages", wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', $this->plugin_globals['name'] ), 'after' => '</div>', 'echo' => 0 ) ), true);
					$smarty->assign("edit_post_link", get_edit_post_link( __( 'Edit', $this->plugin_globals['name'] ), '<div class="edit-link">', '</div>', $ID ), true);
					$smarty->assign("author_first_name", get_the_author_meta('first_name'), true);
					$smarty->assign("author_last_name", get_the_author_meta('last_name'), true);
					$smarty->assign("sticky", is_sticky($ID), true);
					$smarty->assign("permalink", get_permalink( $ID ), true);
					
					$smarty->assign("featured", __( 'Featured', $this->plugin_globals['name'] ), true);
					$smarty->assign("title", $title, true);
					$smarty->assign("first_img", $first_img, true);
					$smarty->assign("first_video", $first_video, true);
					$smarty->assign("target", $target, true);
					$smarty->assign("text", $text, true);
					$smarty->assign("quote", $quote, true);
					$smarty->assign("full_preview", $full_preview, true);
					$smarty->assign("content_bottom", $content_bottom, true);
					$smarty->assign("comments_popup_link", $comments_popup_link, true);
					$smarty->assign("plugin_key", $this->plugin_globals['TextDomain'], true);
					
					$has_header_data = false;
					
					if ( ( $show_quotes == 'Y' && !empty($quote)  ) ||  ( comments_open() && !post_password_required() && $comments_popup_link ) )
					{
						$has_header_data = true;
					}//endif
					
					$smarty->assign("has_header_data", $has_header_data, true);
		            
					if ($post_cnt == $num_posts)
					{
						$smarty->assign("last_post", true, true);
					}//end if
					else
					{
						$smarty->assign("last_post", null, true);
					}//end else
					
		            $return_HTML .= $smarty->fetch( $this->plugin_globals['name'] . '_layout'.$layout.'.tpl' );
		        }
		    } //endforeach;
	    }//end if
	        		
		if ($echo)
			echo $return_HTML;
		
		return $return_HTML;
	}//end display

	/**
	 * Find and return an image from the post
	 *
	 * @since 1.1.0
	 *
	 * @param object $post  - the post to parse
	 *
	 * @return string $img return the the first image found
	 */
	function get_thumbnail( $post )
	{
	   	$img = null;
	   
	   	if ( !empty( $post ))
	   	{
			ob_start();
			ob_end_clean();
			
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			
			if ( !empty( $matches[1] ))
			{
				$img    = $matches[1][0];
			}//end if
		}//end if
	    
	   	return $img;
	}//end get_thumbnail
	
	/**
	 * Find and return a video from the post
	 *
	 * @since 1.1.0
	 *
	 * @param object $post  - the post to parse
	 *
	 * @return string $video return the the first video found
	 */
	function get_video( $post )
	{
	    $video = null;
	    
	    
	   	if ( !empty( $post ))
	   	{
		    ob_start();
		    ob_end_clean();
		    
		    $output = preg_match_all('/<code>(.*?)<\/code>/i', $post->post_content, $matches);
			if ( !empty( $matches[1] ))
			{
				$video    = $matches[1][0];
			}//end if
		    
		   	// if video wasn't found look for iframes
		    if ( empty( $video ) )
		    {
			    //if its not wrapped in the code tags find the other methods of viewing videos
			    $output = preg_match_all('/<iframe (.*?)>(.*?)<\/iframe>/i', $post->post_content, $matches);
				if ( !empty ( $matches[0] ))
				{
					$video    = $matches[0][0];
				}//endif
		    }
		    
		    // if iframes weren't found look for flash
		    if ( empty( $video ) )
		    {
			    //if its not wrapped in the code tags find the other methods of viewing videos
			    $output = preg_match_all('/<object (.*?)>(.*?)<\/object>/i', $post->post_content, $matches);
				if ( !empty ( $matches[0] ))
				{
					$video    = $matches[0][0];
				}//endif
		    }
	   	}//end if
	    
	    return $video;
	}//end get_video
	
	/**
	 * Set the width and height in the the video string
	 *
	 * @since 1.1.0
	 *
	 * @param string $video  - the video to parse
	 * @param string $width  - the width of the video
	 * @param string $height  - the height of the video
	 *
	 * @return string $video return the the updated video string
	 */
	function adjust_video($video, $width, $height)
	{
		$video = preg_replace('/width="(.*?)"/i', 'width="'.$width.'"', $video);
		$video = preg_replace('/height="(.*?)"/i', 'height="'.$height.'"', $video);
		
		$video = preg_replace('/width=\'(.*?)\'/i', 'width=\''.$width.'\'', $video);
		$video = preg_replace('/height=\'(.*?)\'/i', 'height=\''.$height.'\'', $video);
		
		return $video;
	}//end adjust_video
	
}//end TSP_Easy_Plugins_Widget_Featured_Posts
?>