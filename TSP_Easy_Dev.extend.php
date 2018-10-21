<?php				
    /**
     * TSP_Easy_Dev_Options_Featured_Posts - Extends the TSP_Easy_Dev_Options Class
     * @package TSP_Easy_Dev
     * @author sharrondenice, letaprodoit
     * @author Sharron Denice, Let A Pro Do IT!
     * @copyright 2013 Let A Pro Do IT!
     * @license APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
     * @version $Id: [FILE] [] [DATE] [TIME] [USER] $
     */

    class TSP_Easy_Dev_Options_Featured_Posts extends TSP_Easy_Dev_Options
    {
        /**
         * Implements the settings_page to display settings specific to this plugin
         *
         * @since 1.1.0
         *
         * @param void
         *
         * @return void -output to screen
         *
         * @throws SmartyException
         */
        function display_plugin_options_page()
        {
            $message = "";

            $error = "";

            // get settings from database
            $shortcode_fields = get_option( $this->get_value('shortcode-fields-option-name') );

            $defaults = new TSP_Easy_Dev_Data ( $shortcode_fields, 'shortcode' );

            $form = null;
            if ( array_key_exists( $this->get_value('name') . '_form_submit', $_REQUEST ))
            {
                $form = $_REQUEST[ $this->get_value('name') . '_form_submit'];
            }//endif

            // Save data for settings page
            if( isset( $form ) && check_admin_referer( $this->get_value('name'), $this->get_value('name') . '_nonce_name' ) )
            {
                $defaults->set_values( $_POST );
                $shortcode_fields = $defaults->get();

                update_option( $this->get_value('shortcode-fields-option-name'), $shortcode_fields );

                $message = __( "Options saved.", $this->get_value('name') );
            }

            $form_fields = $defaults->get_values( true );

            // Display settings to screen
            $smarty = new TSP_Easy_Dev_Smarty( $this->get_value('smarty_template_dirs'),
                $this->get_value('smarty_cache_dir'),
                $this->get_value('smarty_compiled_dir'), true );

            global $featured_posts;

            $smarty->assign( 'plugin_title',			TSPFP_PLUGIN_TITLE);
            $smarty->assign( 'plugin_links',			implode(' | ', $featured_posts->get_meta_links()));
            $smarty->assign( 'EASY_DEV_SETTINGS_UI',	$this->get_value('name') . '_child-page-instructions.tpl');

            $smarty->assign( 'form_fields',				$form_fields);
            $smarty->assign( 'message',					$message);
            $smarty->assign( 'error',					$error);
            $smarty->assign( 'form',					$form);
            $smarty->assign( 'plugin_name',				$this->get_value('name'));
            $smarty->assign( 'nonce_name',				wp_nonce_field( $this->get_value('name'), $this->get_value('name').'_nonce_name' ));

            $smarty->display( 'easy-dev-child-page-default.tpl');

        }//end settings_page

    }//end TSP_Easy_Dev_Options_Featured_Posts


    /**
     * TSP_Easy_Dev_Widget_Featured_Posts - Extends the TSP_Easy_Dev_Widget Class
     * @package TSPEasyPlugin
     * @author sharrondenice, letaprodoit
     * @author Sharron Denice, Let A Pro Do IT!
     * @copyright 2013 Let A Pro Do IT!
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
         * @return void
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
         * @param array $fields Required - array of current values
         *
         * @return void - display to widget box
         */
        public function display_form( $fields )
        {
            if (!empty($this->options))
            {
                $smarty = new TSP_Easy_Dev_Smarty( $this->options->get_value('smarty_template_dirs'),
                        $this->options->get_value('smarty_cache_dir'),
                        $this->options->get_value('smarty_compiled_dir'), true );

                $smarty->assign( 'shortcode_fields', $fields );
                $smarty->assign( 'class', 'widefat' );
                $smarty->display( 'easy-dev-shortcode-form.tpl' );
            }
        }//end form

        /**
         * Implementation (required) to print widget & shortcode information to screen
         *
         * @since 1.1.0
         *
         * @param array $fields  - the settings to display
         * @param boolean $echo Optional - if false returns output instead of displaying to screen
         * @param string $tag Optional - the name of the shortcode being processed
         *
         * @return string $output if echo is true displays to screen else returns string
         *
         * @throws SmartyException
         */
        public function display_widget( $fields, $echo = true, $tag = null )
        {
            extract ( $fields );

            $return_HTML = "";

            // If there is a title insert before/after title tags
            if (!empty($fields['title'])) {
                $return_HTML .= $fields['before_title'] . $fields['title'] . $fields['after_title'];
            }

                // remove unnecessary spaces from cat_ids #FP-13
            if (!empty($fields['post_ids']))
            {
                $fields['post_ids'] = preg_replace( "/\s+/", " ", $fields['post_ids'] ); //remove extra spaces
                $fields['post_ids'] = preg_replace( "/\,(\s+)/", ",", $fields['post_ids'] ); // remove comma's with extra spaces
                $fields['post_ids'] = preg_replace( "/(\s+)/", ",", $fields['post_ids'] ); // replace spaces with commas
            }

            $args = array(
                'post_type' 	=> $fields['fpost_type'],
                'category'		=> $fields['category'],
                'numberposts'	=> $fields['number_posts'],
                'orderby'		=> $fields['order_by'],
                'include'		=> $fields['post_ids'],
            );

            if ($fields['show_private'] == 'Y')
                $args['post_status'] = "publish,private";

            if ($fields['fpost_type'] == 'tribe_events')
            {
                $args['meta_query'] = array(
                    array(
                        'key' => '_EventEndDate',
                        'value' => date('Y-m-d'),
                        'compare' => '>=',
                        'type' => 'DATETIME'
                    )
                );
            }

            $queried_posts = get_posts($args);

            $pro_post = $this->options->get_pro_post();

            if (!empty ( $queried_posts ))
            {
                $post_cnt = 0;
                $num_posts = sizeof( $queried_posts );

                global $post;

                foreach ( $queried_posts as $post )
                {
                    setup_postdata( $post );

                    $ID = $post->ID;

                    $publish_date = date( get_option('date_format'), strtotime( $post->post_date ) );

                    // get the first image or video
                    $media = $pro_post->get_post_media ( $post, $fields['thumb_width'], $fields['thumb_height'] );

                    // get the fields stored in the database for this post
                    $post_fields = $pro_post->get_post_fields( $ID );

                    // determine if the link is external if so set target to blank window
                    // TODO: I don't like passing that entire post object by value
                    $target = "_self";

                    if ( get_post_format( $post ) == 'link')
                        $target = "_blank";

                    $text = "";
                    $full_preview = "";
                    $content_bottom = "";

                    $permalink = get_permalink( $ID );
                    $long_title = get_the_title( $post );

                    if ( in_array( $fields['layout'], array( 1, 2, 4, 5 ) ) )
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

                        if ($fields['keep_formatting'] != 'Y')
                        {
                            $full_preview  	= strip_tags($full_preview);
                        }//endif

                        $full_preview  	= preg_replace('/\[youtube=(.*?)\]/m', "", $full_preview);

                        $protected = false;

                        if ( post_password_required($ID) )
                        {
                            $full_preview = __( 'There is no excerpt because this is a protected post.' );
                            $protected = true;
                        }//end if

                        $words          = explode(' ', $full_preview, $fields['excerpt_max'] + 1);

                        if ( count( $words ) > $fields['excerpt_max'] )
                        {
                            array_pop($words);
                            array_push($words, "<a target='{$target}' href='{$permalink}' title='{$long_title}'>{$fields['read_more_text']}</a>");

                            $full_preview          = implode(' ', $words);
                        }//end if

                        if (!$protected && $fields['fpost_type'] == 'tribe_events' && $fields['show_event_data'] == 'Y')
                        {
                            $venue = '<div class="duration venue">'.tribe_get_venue().'</div>';
                            $schedule = '<div class="duration time">'.tribe_events_event_schedule_details().'</div>';
                            $full_preview = "{$venue}{$schedule}{$full_preview}";
                        }
                    }
                    else
                    {
                        $content       	= get_extended( $post->post_content );
                        $text			= $content['main'];

                        if ($fields['keep_formatting'] != 'Y')
                        {
                            $text  			= strip_tags($text);
                        }//endif

                        $text           = strip_shortcodes($text);
                        $text           = str_replace(']]>', ']]&gt;', $text);
                        $text           = str_replace('<[[', '&lt;[[', $text);
                        $text 		 	= preg_replace('/\[youtube=(.*?)\]/m', "", $text);
                        $text			= preg_replace("/\n/", " ", $text);
                        $text			= preg_replace("/\s+/", " ", $text);

                        $protected = false;

                        if ( post_password_required($ID) )
                        {
                            $text = __( 'There is no excerpt because this is a protected post.' );
                            $protected = true;
                        }//end if

                        $words          = explode(' ', $text, $fields['excerpt_min'] + 1);

                        if ( count( $words ) > $fields['excerpt_min'] )
                        {
                            array_pop($words);
                            array_push($words, "<a target='{$target}' href='{$permalink}' title='{$long_title}'>{$fields['read_more_text']}</a>");

                            $text       = implode(' ', $words);
                        }//end if

                        if (!$protected && $fields['fpost_type'] == 'tribe_events' && $fields['show_event_data'] == 'Y')
                        {
                            $venue = '<div class="duration venue">'.tribe_get_venue().'</div>';
                            $schedule = '<div class="duration time">'.tribe_events_event_schedule_details().'</div>';
                            $text = "{$venue}{$schedule}{$text}";
                        }
                    }//end foreach

                    // Only show articles that have associated images if $show_text_posts is set to 'Y' and
                    // $show_text_posts is 'N' and there are at least a video or image
                    if ( $fields['show_text_posts'] == 'Y' || ( $fields['show_text_posts'] == 'N' && !empty( $media ) ) )
                    {
                        $title = $post->post_title;

                        $words          = explode(' ', $title, $fields['max_words'] + 1);

                        if ( count( $words ) > $fields['max_words'] )
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
                        $private = 									post_password_required( $post );

                        $has_header_data = false;

                        if ( ( $fields['show_quotes'] == 'Y' && !empty($quote)  ) ||  ( $comments_open && !$private && !empty( $comments_popup_link ) ) )
                        {
                            $has_header_data = true;
                        }//endif

                        $smarty = new TSP_Easy_Dev_Smarty( $this->options->get_value('smarty_template_dirs'),
                            $this->options->get_value('smarty_cache_dir'),
                            $this->options->get_value('smarty_compiled_dir'), true );

                        // Store values into Smarty
                        // values like slider_width, slider_height that do not
                        // need to be maniuplated are stored in smarty here
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

                        $current_post_class = implode( " ", get_post_class( null, $ID ) );

                        if (!empty($post_class))
                            $current_post_class .= " $post_class";

                        $smarty->assign("ID", 						$ID, true);
                        $smarty->assign("post_class", 				$current_post_class, true);
                        $smarty->assign("long_title", 				$long_title, true);
                        $smarty->assign("wp_link_pages", 			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', $this->options->get_value('name') ), 'after' => '</div>', 'echo' => 0 ) ), true);
                        $smarty->assign("edit_post_link", 			get_edit_post_link( __( 'Edit', $this->options->get_value('name') ), '<div class="edit-link">', '</div>', $ID ), true);
                        $smarty->assign("author_first_name", 		get_the_author_meta( 'first_name', $post->post_author ), true );
                        $smarty->assign("author_last_name", 		get_the_author_meta( 'last_name', $post->post_author ), true );
                        $smarty->assign("sticky", 					is_sticky( $ID ), true);
                        $smarty->assign("permalink", 				$permalink, true);

                        $smarty->assign("featured",					__( 'Featured', $this->options->get_value('name') ), true);
                        $smarty->assign("publish_date", 			    $publish_date, true);
                        $smarty->assign("title", 					$title, true);
                        $smarty->assign("media", 					$media, true);
                        $smarty->assign("target", 					$target, true);
                        $smarty->assign("text", 					    $text, true);
                        $smarty->assign("style", 					$fields['style'], true);
                        $smarty->assign("full_preview", 			    $full_preview, true);
                        $smarty->assign("content_bottom", 			$content_bottom, true);
                        $smarty->assign("comments_popup_link", 		$comments_popup_link, true);
                        $smarty->assign("comments_open", 			$comments_open, true);
                        $smarty->assign("post_password_required", 	$private, true);
                        $smarty->assign("plugin_key",				$this->options->get_value('TextDomain'), true);
                        $smarty->assign("has_header_data", 			$has_header_data, true);
                        $smarty->assign("last_post", 				($post_cnt == $num_posts) ? true : null, true);
                        $smarty->assign("first_post", 				($post_cnt == 1) ? true : null, true);

                        $smarty->assign("show_thumb", 				($show_thumb == 'Y') ? true : null, true);
                        $return_HTML .= $smarty->fetch( $this->options->get_value('name') . '_layout'.$fields['layout'].'.tpl' );
                    }
                } //endforeach;
            }//end if

            if ($echo)
                echo $return_HTML;

            return $return_HTML;
        }//end display
    }//end TSP_Easy_Dev_Widget_Featured_Posts