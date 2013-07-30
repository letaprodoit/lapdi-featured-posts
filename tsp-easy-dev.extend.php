<?php				
/**
 * TSP_Easy_Dev_Options_Featured_Posts - Extends the TSP_Plugin_Settings Class
 * @package TSP_Easy_Dev
 * @author sharrondenice, thesoftwarepeople
 * @author Sharron Denice, The Software People
 * @copyright 2013 The Software People
 * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
 */

/**
 * Extends the TSP_Easy_Dev_Options_Facepile Class
 *
 * original author: Sharron Denice
 */
class TSP_Easy_Dev_Options_Featured_Posts extends TSP_Easy_Dev_Options
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
		
		$json 					= file_get_contents( $this->get_value('plugin_list') );
		$tsp_plugins 			= json_decode($json);
		
		foreach ( $tsp_plugins->{'plugins'} as $plugin_data )
		{
			if ( $plugin_data->{'type'} == 'FREE' )
			{
				if ( in_array($plugin_data->{'name'}, $active_plugins ) )
				{
					$free_active_plugins[] = (array)$plugin_data;
				}//endif
				elseif ( array_key_exists($plugin_data->{'name'}, $all_plugins ) )
				{
					$free_installed_plugins[] = (array)$plugin_data;
				}//end elseif
				else
				{
					$free_recommend_plugins[] = (array)$plugin_data;
				}//endelse
			}//endif
			elseif ( $plugin_data->{'type'} == 'PRO' )
			{
				if ( in_array($plugin_data->{'name'}, $active_plugins ) )
				{
					$pro_active_plugins[] = (array)$plugin_data;
				}//endif
				elseif ( array_key_exists($plugin_data->{'name'}, $all_plugins ) )
				{
					$pro_installed_plugins[] = (array)$plugin_data;
				}//endelseif
				else
				{
					$pro_recommend_plugins[] = (array)$plugin_data;
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
		$smarty = new TSP_Easy_Dev_Smarty( $this->get_value('smarty_template_dirs'), 
			$this->get_value('smarty_cache_dir'), 
			$this->get_value('smarty_compiled_dir'), true );
			
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
		$smarty->assign( 'contact_url',				$this->get_value('contact_url'));

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
		$settings_fields = get_option( $this->get_value('settings-fields-option-name') );
		
		$defaults = new TSP_Easy_Dev_Data ( $settings_fields );

		$form = null;
		if ( array_key_exists( $this->get_value('name') . '_form_submit', $_REQUEST ))
		{
			$form = $_REQUEST[ $this->get_value('name') . '_form_submit'];
		}//endif
				
		// Save data for settings page
		if( isset( $form ) && check_admin_referer( $this->get_value('name'), $this->get_value('name') . '_nonce_name' ) ) 
		{
			$defaults->set_values( $_POST );
			$settings_fields = $defaults->get();
			
			update_option( $this->get_value('settings-fields-option-name'), $settings_fields );
			
			$message = __( "Options saved.", $this->get_value('name') );
		}
		
		$form_fields = $defaults->get_values( true );

		// Display settings to screen
		$smarty = new TSP_Easy_Dev_Smarty( $this->get_value('smarty_template_dirs'), 
			$this->get_value('smarty_cache_dir'), 
			$this->get_value('smarty_compiled_dir'), true );

		$smarty->assign( 'form_fields',				$form_fields);
		$smarty->assign( 'message',					$message);
		$smarty->assign( 'error',					$error);
		$smarty->assign( 'form',					$form);
		$smarty->assign( 'plugin_name',				$this->get_value('name'));
		$smarty->assign( 'nonce_name',				wp_nonce_field( $this->get_value('name'), $this->get_value('name').'_nonce_name' ));
		
		$smarty->display( $this->get_value('name') . '_shortcode_settings.tpl');
				
	}//end settings_page
	
}//end TSP_Easy_Dev_Options_Featured_Posts


/**
 * TSP_Easy_Dev_Widget_Featured_Posts - Extends the TSP_Easy_Dev_Widget Class
 * @package TSPEasyPlugin
 * @author sharrondenice, thesoftwarepeople
 * @author Sharron Denice, The Software People
 * @copyright 2013 The Software People
 * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
 */

/**
 * Extends the TSP_Easy_Dev_Widget_Facepile Class
 *
 * original author: Sharron Denice
 */
class TSP_Easy_Dev_Widget_Featured_Posts extends TSP_Easy_Dev_Widget
{
	/**
	 * Constructor
	 */	
	public function __construct() 
	{
		add_filter( get_class()  .'-init', array($this, 'init'), 10, 1 );
	}//end __construct

	/**
	 * Function added to filter to allow initialization of widget
	 *
	 * @since 1.1.0
	 *
	 * @param object $options Required - pass in reference to options class
	 *
	 * @return none
	 */
	public function init( $options )
	{
        // Create the widget
		parent::__construct( $options );
	}//end init

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

		$smarty = new TSP_Easy_Dev_Smarty( $this->options->get_value('smarty_template_dirs'), 
			$this->options->get_value('smarty_cache_dir'), 
			$this->options->get_value('smarty_compiled_dir'), true );

    	$smarty->assign( 'form_fields', $fields );
    	$smarty->assign( 'class', 'widefat' );
		$smarty->display( 'default_form.tpl' );
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
		
		    foreach ( $queried_posts as $a_post )
		    {    
		        $ID = $a_post->ID;
		        
		        // get the first image or video
		        $media = $this->get_media ( $a_post, $thumb_width, $thumb_height );
		
		        // get the fields stored in the database for this post
		        $post_fields = $this->get_post_fields( $ID );
		        
		        // get determine if the link is external if so set target to blank window
		        // TODO: I don't like passing that entire post object by value
		        $target = "_self";
		        
		        if ( get_post_format( $a_post ) == 'link')
		        	$target = "_blank";
		        
		        $text = "";
		        $full_preview = "";        
		        $content_bottom = "";

		        if ( in_array( $layout, array( 1, 2, 4 ) ) )
		        {
			        // get the bottom content
			        $content_bottom = apply_filters('the_content','');
			        $content_bottom  = preg_replace('/<p>(.*?)<\/p>/m', "$1", $content_bottom);
			        	
			        // get the content to <!--more--> tag
			        $extended_post = get_extended( $a_post->post_content );
			        
			        // add in formatting
			        $full_preview  = apply_filters( 'the_content', $extended_post['main'] );
			
			        // remove bottom content from fullpreview to prevent it from displaying twice
			        $full_preview = str_replace( $content_bottom, "", $full_preview );
			        
		        	$full_preview  	= strip_tags($full_preview);
			        $full_preview  	= preg_replace('/\[youtube=(.*?)\]/m', "", $full_preview);
		        	        	
			        $words          = explode(' ', $full_preview, $excerpt_max + 1);
			        
			        if ( count( $words ) > $excerpt_max ) 
			        {
			            array_pop($words);
			            array_push($words, '...');
			            
			            $full_preview          = implode(' ', $words);
			        }//end if
		        }
		        else
		        {
			        $content       	= get_extended( $a_post->post_content );
			        $text			= $content['main'];
		        	$text  			= strip_tags($text);
			        $text           = strip_shortcodes($text);
			        $text           = str_replace(']]>', ']]&gt;', $text);
			        $text           = str_replace('<[[', '&lt;[[', $text);
			        $text 		 	= preg_replace('/\[youtube=(.*?)\]/m', "", $text);
			        $text			= preg_replace("/\n/", " ", $text);
			        $text			= preg_replace("/\s+/", " ", $text);
			        	        	        
			        $words          = explode(' ', $text, $excerpt_min + 1);
			        
			        if ( count( $words ) > $excerpt_min ) 
			        {
			            array_pop($words);
			            array_push($words, '[…]');
			            
			            $text       = implode(' ', $words);
			        }//end if
		        }//end foreach
		        		        
		        // Only show articles that have associated images if $show_text_posts is set to 'Y' and
		        // $show_text_posts is 'N' and there are at least a video or image
		        if ( $show_text_posts == 'Y' || ( $show_text_posts == 'N' && !empty( $media ) ) ) 
		        {
		        	$title = $a_post->post_title;
		        	
		        	$words          = explode(' ', $title, $max_words + 1);
		 	        
		 	        if ( count( $words ) > $max_words ) 
		 	        {
			            array_pop($words);
			            array_push($words, '…');
			            
			            $title          = implode(' ', $words);
			        }//end if
		           	           				
			        $post_cnt++;
					
					$comments_popup_link = "";
					/*
					$comments_popup_link = comments_popup_link( 
						'<span class="leave-reply">' . __( 'Reply', $this->options->get_value('name') ) . '</span>', 
						_x( '1', 'comments number', $this->options->get_value('name') ), 
						_x( '%', 'comments number', $this->options->get_value('name') ) );*/
					
					$comments_open = 							comments_open( $ID );
					$private = 									post_password_required( $a_post );
					
					$has_header_data = false;
					
					if ( ( $show_quotes == 'Y' && !empty($quote)  ) ||  ( $comments_open && !$private && !empty( $comments_popup_link ) ) )
					{
						$has_header_data = true;
					}//endif

					$smarty = new TSP_Easy_Dev_Smarty( $this->options->get_value('smarty_template_dirs'), 
						$this->options->get_value('smarty_cache_dir'), 
						$this->options->get_value('smarty_compiled_dir'), true );
				    
				    // Store values into Smarty
				    foreach ( $fields as $key => $val )
				    {
				    	$smarty->assign( $key, $val, true);
				    }//end foreach

				   	if (!empty ( $post_fields ))
				   	{
					    foreach ( $post_fields as $key => $val )
					    {
					    	$smarty->assign( $key, $val, true);
					    }//end foreach
				   	}//endif

					$smarty->assign("ID", 						$ID, true);
					$smarty->assign("post_class", 				implode( " ", get_post_class( null, $ID ) ), true);
					$smarty->assign("long_title", 				get_the_title( $a_post ), true);
					$smarty->assign("wp_link_pages", 			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', $this->options->get_value('name') ), 'after' => '</div>', 'echo' => 0 ) ), true);
					$smarty->assign("edit_post_link", 			get_edit_post_link( __( 'Edit', $this->options->get_value('name') ), '<div class="edit-link">', '</div>', $ID ), true);
					$smarty->assign("author_first_name", 		get_the_author_meta( 'first_name', $a_post->post_author ), true );
					$smarty->assign("author_last_name", 		get_the_author_meta( 'last_name', $a_post->post_author ), true );
					$smarty->assign("sticky", 					is_sticky( $ID ), true);
					$smarty->assign("permalink", 				get_permalink( $ID ), true);
					
					$smarty->assign("featured",					__( 'Featured', $this->options->get_value('name') ), true);
					$smarty->assign("title", 					$title, true);
					$smarty->assign("media", 					$media, true);
					$smarty->assign("target", 					$target, true);
					$smarty->assign("text", 					$text, true);
					$smarty->assign("full_preview", 			$full_preview, true);
					$smarty->assign("content_bottom", 			$content_bottom, true);
					$smarty->assign("comments_popup_link", 		$comments_popup_link, true);
					$smarty->assign("comments_open", 			$comments_open, true);
					$smarty->assign("post_password_required", 	$private, true);
					$smarty->assign("plugin_key",				$this->options->get_value('TextDomain'), true);
					$smarty->assign("has_header_data", 			$has_header_data, true);
					$smarty->assign("last_post", 				($post_cnt == $num_posts) ? true : null, true);
					$smarty->assign("first_post", 				($post_cnt == 1) ? true : null, true);
		            
		            $return_HTML .= $smarty->fetch( $this->options->get_value('name') . '_layout'.$layout.'.tpl' );
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
	 * @param object $a_post  - the post to parse
	 * @param int $thumb_width  - the width to set the image to
	 * @param int $thumb_height  - the height to set the image to
	 *
	 * @return string $media return the the first media item found
	 */
	private function get_media( &$a_post, $thumb_width, $thumb_height )
	{
       	$media 		= null;
        $img     	= $this->get_thumbnail( $a_post );
        
        if ( empty( $img ) )
        {
        	$video = $this->get_video( $a_post );
        
	       	if ( !empty( $video ) )
	       	{
	       		$video = $this->adjust_video( $video, $thumb_width, $thumb_height);
	       		$media = "<code>$video</code>";
	       	}//end if
	    }//endif
	    else
	    {
			$media = "<img align='left' src='$img' alt='{$a_post->post_title}' width='$thumb_width' height='$thumb_height'/>";
	    }//end else
	    
	    return $media;
	}//end get_media

	/**
	 * Return an array of the post fields
	 *
	 * @since 1.1.0
	 *
	 * @param int $ID  - the post's ID
	 *
	 * @return array $post_fields return an array of fiels stored in the post
	 */
	private function get_post_fields( $ID )
	{
		$new_post_fields = array();
		       
		$post_fields = get_option( $this->options->get_value('post-fields-option-name') );
		$defaults = new TSP_Easy_Dev_Data ( $post_fields );
		
		$fields = $defaults->get_values();

        if (!empty ( $fields ))
        {
	        foreach ( $fields as $key => $default_value )
	        {
		        // get the quote for the post
		        $value_arr = get_post_custom_values( $key, $ID );
		        
		        if (!empty( $value_arr ))
		        	$new_post_fields[$key] = $value_arr[0];
		        else
		        	$new_post_fields[$key] = "";
	        }//end foreach
        }//endif
        		
		return $new_post_fields;
	}//end get_post_fields

	/**
	 * Find and return an image from the post
	 *
	 * @since 1.1.0
	 *
	 * @param object $a_post  - the post to parse
	 *
	 * @return string $img return the the first image found
	 */
	private function get_thumbnail( &$a_post )
	{
	   	$img = null;
	   
	   	if ( !empty( $a_post ))
	   	{
			ob_start();
			ob_end_clean();
			
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $a_post->post_content, $matches);
			
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
	 * @param object $a_post  - the post to parse
	 *
	 * @return string $video return the the first video found
	 */
	private function get_video( &$a_post )
	{
	    $video = null;
	    
	    
	   	if ( !empty( $a_post ))
	   	{
		    ob_start();
		    ob_end_clean();
		    
		    $output = preg_match_all('/<code>(.*?)<\/code>/i', $a_post->post_content, $matches);
			if ( !empty( $matches[1] ))
			{
				$video    = $matches[1][0];
			}//end if
		    
		   	// if video wasn't found look for iframes
		    if ( empty( $video ) )
		    {
			    //if its not wrapped in the code tags find the other methods of viewing videos
			    $output = preg_match_all('/<iframe (.*?)>(.*?)<\/iframe>/i', $a_post->post_content, $matches);
				if ( !empty ( $matches[0] ))
				{
					$video    = $matches[0][0];
				}//endif
		    }
		    
		    // if iframes weren't found look for flash
		    if ( empty( $video ) )
		    {
			    //if its not wrapped in the code tags find the other methods of viewing videos
			    $output = preg_match_all('/<object (.*?)>(.*?)<\/object>/i', $a_post->post_content, $matches);
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
	private function adjust_video($video, $width, $height)
	{
		$video = preg_replace('/width="(.*?)"/i', 'width="'.$width.'"', $video);
		$video = preg_replace('/height="(.*?)"/i', 'height="'.$height.'"', $video);
		
		$video = preg_replace('/width=\'(.*?)\'/i', 'width=\''.$width.'\'', $video);
		$video = preg_replace('/height=\'(.*?)\'/i', 'height=\''.$height.'\'', $video);
		
		return $video;
	}//end adjust_video
	
}//end TSP_Easy_Dev_Widget_Featured_Posts
?>