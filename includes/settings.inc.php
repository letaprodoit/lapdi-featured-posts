<?php

// Default settings at install
$TSPFP_DEFAULTS = array(
			    'title'         => 'TSP Featured Posts',
			    'showquotes'	=> 'N',
			    'showtextposts'	=> 'N',
			    'numberposts'   => 5,
			    'category'      => 0,
			    'layout'        => 0,
			    'orderby'       => 'DESC',
			    'widththumb'    => 80,
			    'heightthumb'   => 80,
			    'beforetitle'   => '<h3>',
			    'aftertitle'    =>  '</h3>');

// These fields for the settings block which is located at the admin setting TSP Featured Posts page
$TSPFP_ADMIN_FIELDS = array (
		array( 'title', 'TEXT', __( 'Title', 'tsp_featured_posts' ), __( 'Title', 'tsp_featured_posts' ) ),
		array( 'showquotes', 'SELECT', __( 'Show Intro Quotes?', 'tsp_featured_posts' ), __( 'Show Intro Quotes?', 'tsp_featured_posts' ) ),
		array( 'showtextposts', 'SELECT', __( 'Show Posts With No Media Content?', 'tsp_featured_posts' ), __( 'Show Posts With No Media Content?', 'tsp_featured_posts' ) ),
		array( 'numberposts','TEXT',  __( 'How many posts do you want to display?', 'tsp_featured_posts' ), __( 'How many posts do you want to display?', 'tsp_featured_posts' ) ),
		array( 'category','TEXT',  __( 'Enter the category ID to query from. Enter 0 to query all categories.', 'tsp_featured_posts' ), __( 'Enter the category ID to query from. Enter 0 to query all categories.', 'tsp_featured_posts' ) ),
		array( 'layout','SELECT',  __( 'Choose layout of the post preview:', 'tsp_featured_posts' ), __( 'Choose layout of the post preview:', 'tsp_featured_posts') ),
		array( 'orderby','SELECT',  __( 'Choose type of order:', 'tsp_featured_posts' ), __( 'Choose type of order:', 'tsp_featured_posts' ) ),		
		array( 'widththumb','TEXT',  __( 'Thumbnail Width', 'tsp_featured_posts' ), __( 'Thumbnail Width', 'tsp_featured_posts' ) ),
		array( 'heightthumb','TEXT',  __( 'Thumbnail Height', 'tsp_featured_posts' ), __( 'Thumbnail Height', 'tsp_featured_posts' ) ),
		array( 'beforetitle','TEXT',  __( 'HTML Before Title', 'tsp_featured_posts' ), __( 'HTML Before Title', 'tsp_featured_posts' ) ),
		array( 'aftertitle','TEXT',  __( 'HTML After Title', 'tsp_featured_posts' ), __( 'HTML After Title', 'tsp_featured_posts') ),
);


function fn_tsp_featured_posts_add_menu_render() 
{
	global $title;
	$active_plugins = get_option('active_plugins');
	$all_plugins = get_plugins();

	$array_activate = array();
	$array_install	= array();
	$array_recomend = array();
	$count_activate = $count_install = $count_recomend = 0;
	$array_plugins	= array(
		array( 'tsp_featured_posts\/tsp_featured_posts.php', 'TSP Featured Posts', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-posts-for-wordpress.html', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-posts-for-wordpress.html', '/wp-admin/plugin-install.php?tab=search&type=term&s=TSP+Featured+Posts&plugin-search-input=Search+Plugins', 'admin.php?page=tsp_featured_posts.php' ), 
		array( 'tsp_disable_autosave\/tsp_disable_autosave.php', 'TSP Disable Auto-Save', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/disable-autosave-for-wordpress.html', 'http://www.thesoftwarepeople.com/software/plugins/wordpress/disable-autosave-for-wordpress.html', '/wp-admin/plugin-install.php?tab=search&type=term&s=TSP+Disable+Autosave&plugin-search-input=Search+Plugins', 'admin.php?page=tsp_disable_autosave.php' ), 
	);
	foreach ( $array_plugins as $plugins ) {
		if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
			$array_activate[$count_activate]["title"] = $plugins[1];
			$array_activate[$count_activate]["link"] = $plugins[2];
			$array_activate[$count_activate]["href"] = $plugins[3];
			$array_activate[$count_activate]["url"]	= $plugins[5];
			$count_activate++;
		} else if ( array_key_exists(str_replace( "\\", "", $plugins[0]), $all_plugins ) ) {
			$array_install[$count_install]["title"] = $plugins[1];
			$array_install[$count_install]["link"]	= $plugins[2];
			$array_install[$count_install]["href"]	= $plugins[3];
			$count_install++;
		} else {
			$array_recomend[$count_recomend]["title"] = $plugins[1];
			$array_recomend[$count_recomend]["link"] = $plugins[2];
			$array_recomend[$count_recomend]["href"] = $plugins[3];
			$array_recomend[$count_recomend]["slug"] = $plugins[4];
			$count_recomend++;
		}
	}
	$array_activate_pro = array();
	$array_install_pro	= array();
	$array_recomend_pro = array();
	$count_activate_pro = $count_install_pro = $count_recomend_pro = 0;
	$array_plugins_pro	= array(
	);
	foreach ( $array_plugins_pro as $plugins ) {
		if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
			$array_activate_pro[$count_activate_pro]["title"] = $plugins[1];
			$array_activate_pro[$count_activate_pro]["link"] = $plugins[2];
			$array_activate_pro[$count_activate_pro]["href"] = $plugins[3];
			$array_activate_pro[$count_activate_pro]["url"]	= $plugins[4];
			$count_activate_pro++;
		} else if( array_key_exists(str_replace( "\\", "", $plugins[0]), $all_plugins ) ) {
			$array_install_pro[$count_install_pro]["title"] = $plugins[1];
			$array_install_pro[$count_install_pro]["link"]	= $plugins[2];
			$array_install_pro[$count_install_pro]["href"]	= $plugins[3];
			$count_install_pro++;
		} else {
			$array_recomend_pro[$count_recomend_pro]["title"] = $plugins[1];
			$array_recomend_pro[$count_recomend_pro]["link"] = $plugins[2];
			$array_recomend_pro[$count_recomend_pro]["href"] = $plugins[3];
			$count_recomend_pro++;
		}
	} ?>
	<div class="wrap">
		<div class="icon32 icon32-tsp" id="icon-options-general"></div>
		<h2><?php echo $title;?></h2>
		<h3 style="color: #B4100E;"><?php _e( 'Professional WordPress Plugins', 'tsp_featured_posts' ); ?></h3>
			<?php if( 0 < $count_activate_pro ) { ?>
			<div style="padding-left:15px;">
				<h4><?php _e( 'Activated plugins', 'tsp_featured_posts' ); ?></h4>
				<?php foreach ( $array_activate_pro as $activate_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $activate_plugin["title"]; ?></div> <p><a href="<?php echo $activate_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_featured_posts' ); ?></a> <a href="<?php echo $activate_plugin["url"]; ?>"><?php echo __( "Settings", 'tsp_featured_posts' ); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_install_pro ) { ?>
			<div style="padding-left:15px;">
				<h4><?php _e( 'Installed plugins', 'tsp_featured_posts' ); ?></h4>
				<?php foreach ( $array_install_pro as $install_plugin) { ?>
				<div style="float:left; width:200px;"><?php echo $install_plugin["title"]; ?></div> <p><a href="<?php echo $install_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_featured_posts' ); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_recomend_pro ) { ?>
			<div style="padding-left:15px;">
				<h4><?php _e( 'Recommended plugins', 'tsp_featured_posts' ); ?></h4>
				<?php foreach ( $array_recomend_pro as $recomend_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $recomend_plugin["title"]; ?></div> <p><a href="<?php echo $recomend_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_featured_posts' ); ?></a> <a href="<?php echo $recomend_plugin["href"]; ?>" target="_blank"><?php echo __( "Purchase", 'tsp_featured_posts' ); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
		<br />
		<h3 style="color: #1A77B1"><?php _e( 'Free WordPress Plugins', 'tsp_featured_posts' ); ?></h3>
			<?php if( 0 < $count_activate ) { ?>
			<div style="padding-left:15px;">
				<h4><?php _e( 'Activated plugins', 'tsp_featured_posts' ); ?></h4>
				<?php foreach( $array_activate as $activate_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $activate_plugin["title"]; ?></div> <p><a href="<?php echo $activate_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_featured_posts' ); ?></a> <a href="<?php echo $activate_plugin["url"]; ?>"><?php echo __( "Settings", 'tsp_featured_posts' ); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_install ) { ?>
			<div style="padding-left:15px;">
				<h4><?php _e( 'Installed plugins', 'tsp_featured_posts' ); ?></h4>
				<?php foreach ( $array_install as $install_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $install_plugin["title"]; ?></div> <p><a href="<?php echo $install_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_featured_posts' ); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_recomend ) { ?>
			<div style="padding-left:15px;">
				<h4><?php _e( 'Recommended plugins', 'tsp_featured_posts' ); ?></h4>
				<?php foreach ( $array_recomend as $recomend_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $recomend_plugin["title"]; ?></div> <p><a href="<?php echo $recomend_plugin["link"]; ?>" target="_blank"><?php echo __( "Read more", 'tsp_featured_posts' ); ?></a> <a href="<?php echo $recomend_plugin["href"]; ?>" target="_blank"><?php echo __( "Download", 'tsp_featured_posts' ); ?></a> <a class="install-now" href="<?php echo get_bloginfo( "url" ) . $recomend_plugin["slug"]; ?>" title="<?php esc_attr( sprintf( __( 'Install %s' ), $recomend_plugin["title"] ) ) ?>" target="_blank"><?php echo __( 'Install now from wordpress.org', 'tsp_featured_posts' ) ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>	
		<br />		
		<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php _e( 'If you have any questions, please contact us via', 'tsp_featured_posts' ); ?> <a href="http://www.thesoftwarepeople.com/about-us/contact-us.html">http://www.thesoftwarepeople.com/about-us/contact-us.html</a></span>
	</div>
<?php } 

// Function for display captcha settings page in the admin area
function fn_tsp_featured_posts_settings_page() {
	global $TSPFP_ADMIN_FIELDS;
	global $TSPFP_OPTIONS;

	$error = "";
	
	// Save data for settings page
	if( isset( $_REQUEST['tspfp_form_submit'] ) && check_admin_referer( plugin_basename(__FILE__), 'tspfp_nonce_name' ) ) {
		$tspfp_request_options = array();
		
		foreach( $TSPFP_OPTIONS as $key => $val ) 
		{
			$tspfp_request_options[$key] = $_REQUEST[$key];
		}
		
		// array merge incase this version has added new options
		$TSPFP_OPTIONS = array_merge( $TSPFP_OPTIONS , $tspfp_request_options );

		update_option( 'tsp_featured_posts_options', $TSPFP_OPTIONS );
		$message = __( "Options saved.", 'tsp_featured_posts' );
	}

	// Display form on the setting page
?>
<div class="tsp_container">
	<div class="icon32 tsp_icon" id="tsp_icon-options-general"></div>
	<h2><?php _e('Featured Posts Shortcode Settings (The Software People)', 'tsp_featured_posts' ); ?></h2>
	<div class="info">
		<p><h3>Using Featured Posts Shortcode <a href="#" class="toggle">(hide/show details)</a>:</h3></p>
		<div class="note-details">
			<ul style="list-style-type:square;">
				<li>Changing the default post options below allows you to place <strong>[tsp_featured_posts]</strong> shortcode tag into any post or page with these options.</li>
				<li>However, if you wish to add different options to the <strong>[tsp_featured_posts]</strong> shortcode please use the following settings:
					<ul style="padding-left: 30px;">
						<li>Title: <strong>title="Title of Posts"</strong></li>
						<li>Show Quotes: <strong>showquotes="Y"</strong>(Options: Y, N)</li>
						<li>Show Posts with No Media Content: <strong>showtextposts="N"</strong>(Options: Y, N)</li>
						<li>Number Posts: <strong>numberposts="5"</strong></li>
						<li>Category: <strong>category="0"</strong>(Any category ID, 0 returns all categories)</li>
						<li>Layout: <strong>layout="0"</strong>(Options: 0, 1, 2, 3, 4)
							<ul style="padding-left: 30px;">
								<li>0: Left: Image - Right: Title, Text (Thumbnail)</li>
								<li>1: Top: Title - Left: Image - Right: Text (Featured-Medium)</li>
								<li>2: Left: Title, Image - Right: Text (Featured-Large)</li>
								<li>3: Left: Image - Right: Text (Thumbnail/No title)</li>
								<li>4: Slider: Title, Image - Right: Text (Featured-Large)</li>
							</ul>
						</li>
						<li>Order By: <strong>orderby="DESC"</strong>(Options: rand,title,date,author,modified,ID)</li>
						<li>Thumbnail Width: <strong>widththumb="80"</strong></li>
						<li>Thumbnail Height: <strong>heightthumb="80"</strong></li>
						<li>HTML Tag Before Title: <strong>beforetitle="&lt;h3&gt;"</strong></li>
						<li>HTML Tag After Title: <strong>aftertitle="&lt;/h3&gt;"</strong></li>
					</ul>
				</li>
				<li>Insert your desired shortcode into any page or post.</li>
			</ul>
			<hr>
			A shortcode with all the options will look like the following:<br><br>
			<strong>[tsp_featured_posts title="Title of Posts" showquotes="N" showtextposts="N" numberposts="5" category="0" layout="0" orderby="DESC" widththumb="80" heightthumb="80" beforetitle="" aftertitle=""]</strong>
		</div>
	
	</div>
	<div class="updated fade" <?php if( ! isset( $_REQUEST['tspfp_form_submit'] ) || $error != "" ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
	<div class="error" <?php if( "" == $error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $error; ?></strong></p></div>
	<form method="post" action="admin.php?page=tsp_featured_posts.php">
		<fieldset>
		<?php foreach ($TSPFP_ADMIN_FIELDS as $fields): ?>
			<div class="tsp_form_element" id="<?php echo $fields[0]; ?>_container_div" style="">
				<label for="<?php echo $fields[0]; ?>"><?php echo __( $fields[2], 'tsp_featured_posts' ); ?></label>
				
				<?php if ($fields[1] == 'TEXT'): ?>
				   <input id="<?php echo $fields[0]; ?>" name="<?php echo $fields[0]; ?>" value="<?php echo $TSPFP_OPTIONS[$fields[0]]; ?>" />
				<?php elseif ($fields[1] == 'SELECT'): ?>
					<?php if ($fields[0] == 'showquotes'): ?>
					   <select name="<?php echo $fields[0]; ?>" id="<?php echo $fields[0]; ?>" >
					      <option class="level-0" value="Y" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "Y") echo " selected='selected'" ?>><?php
					        _e('Yes', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="N" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "N") echo " selected='selected'" ?>><?php
					        _e('No', 'tsp_featured_posts') ?></option>
					   </select>
					<?php elseif ($fields[0] == 'showtextposts'): ?>
					   <select name="<?php echo $fields[0]; ?>" id="<?php echo $fields[0]; ?>" >
					      <option class="level-0" value="Y" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "Y") echo " selected='selected'" ?>><?php
					        _e('Yes', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="N" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "N") echo " selected='selected'" ?>><?php
					        _e('No', 'tsp_featured_posts') ?></option>
					   </select>
					<?php elseif ($fields[0] == 'layout'): ?>
					   <select name="<?php echo $fields[0]; ?>" id="<?php echo $fields[0]; ?>" >
					      <option class="level-0" value="0" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "0") echo " selected='selected'" ?>><?php
					        _e('Left: Image - Right: Title, Text (Thumbnail)', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="1" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "1") echo " selected='selected'" ?>><?php
					        _e('Top: Title - Left: Image - Right: Text (Featured-Medium)', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="2" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "2") echo " selected='selected'" ?>><?php
					        _e('Left: Title, Image - Right: Text (Featured-Large)', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="3" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "3") echo " selected='selected'" ?>><?php
					        _e('Left: Image - Right: Text (Thumbnail/No title)', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="4" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "4") echo " selected='selected'" ?>><?php
					        _e('Slider: Title, Image - Right: Text (Featured-Large)', 'tsp_featured_posts') ?></option>
					   </select>
					<?php elseif ($fields[0] == 'orderby'): ?>
					   <select name="<?php echo $fields[0]; ?>" id="<?php echo $fields[0]; ?>" >
					      <option class="level-0" value="rand" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "rand") echo " selected='selected'" ?>><?php
					        _e('Random', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="title" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "title") echo " selected='selected'" ?>><?php
					        _e('Title', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="date" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "date") echo " selected='selected'" ?>><?php
					        _e('Date', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="author" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "author") echo " selected='selected'" ?>><?php
					        _e('Author', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="modified" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "modified") echo " selected='selected'" ?>><?php
					        _e('Modified', 'tsp_featured_posts') ?></option>
					      <option class="level-0" value="ID" <?php
					        if ($TSPFP_OPTIONS[$fields[0]] == "ID") echo " selected='selected'" ?>><?php
					        _e('ID', 'tsp_featured_posts') ?></option>
					   </select>
					<?php endif; ?>
					
				<?php endif; ?>
				
				<div class="clear"></div>
				<div id="error-message-name"></div>
			</div>
		<?php endforeach; ?>
		</fieldset>
		<input type="hidden" name="tspfp_form_submit" value="submit" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
		<?php wp_nonce_field( plugin_basename(__FILE__), 'tspfp_nonce_name' ); ?>
	</form>
	<script>
		jQuery("div.tsp_container a.toggle").click(function () {
			jQuery(".note-details").toggle();
		});
	</script>
</div>
<?php } 

// register settings function
function fn_tsp_featured_posts_register_settings() {

	global $TSPFP_DEFAULTS,$TSPFP_OPTIONS;
			
	// install the option defaults
	if( !get_option( 'tsp_featured_posts_options' ) ) 
	{
		add_option( 'tsp_featured_posts_options', $TSPFP_DEFAULTS, '', 'yes' );
	}

	$TSPFP_OPTIONS = get_option( 'tsp_featured_posts_options' );// get options from the database
	
	// array merge incase this version has added new options
	
	if (empty($TSPFP_OPTIONS))
	{
		$TSPFP_OPTIONS = $TSPFP_DEFAULTS;
	}
	else
	{
		$TSPFP_OPTIONS = array_merge($TSPFP_DEFAULTS, $TSPFP_OPTIONS);
	}//endelse
}

function fn_tsp_featured_posts_register_plugin_links($links, $file) 
{
	$base = plugin_basename(__FILE__);
	
	if ($file == $base) {
		$links[] = '<a href="admin.php?page=tsp_featured_posts.php">' . __( 'Settings', 'tsp_featured_posts' ) . '</a>';
		$links[] = '<a href="http://wordpress.org/extend/plugins/tsp_featured_posts/faq/" target="_blank">' . __( 'FAQ', 'tsp_featured_posts' ) . '</a>';
		$links[] = '<a href="http://www.thesoftwarepeople.com/about-us/contact-us.html">' . __( 'Support', 'tsp_featured_posts' ) . '</a>';
	}
	return $links;
}

function fn_tsp_featured_posts_plugin_action_links( $links, $file ) 
{
	//Static so we don't call plugin_basename on every plugin row.
	static $this_plugin;
	
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if ( $file == $this_plugin )
	{
		$settings_link = '<a href="admin.php?page=tsp_featured_posts.php">' . __( 'Settings', 'tsp_featured_posts' ) . '</a>';
		array_unshift( $links, $settings_link );
	}
	return $links;
} // end function cptch_plugin_action_links

function fn_tsp_featured_posts_add_admin_menu() 
{
	add_menu_page( 'TSP Plugins', 'TSP Plugins', 'manage_options', 'tsp_plugins', 'fn_tsp_featured_posts_add_menu_render', WP_CONTENT_URL."/plugins/tsp_featured_posts/images/tsp_icon_16.png", 2617638); 
	add_submenu_page('tsp_plugins', __( 'TSP Featured Posts', 'tsp_featured_posts' ), __( 'TSP Featured Posts', 'tsp_featured_posts' ), 'manage_options', "tsp_featured_posts.php", 'fn_tsp_featured_posts_settings_page');

	//call register settings function
	add_action( 'admin_init', 'fn_tsp_featured_posts_register_settings' );
}

function fn_tsp_featured_posts_plugin_init() 
{
}

function fn_tsp_featured_posts_delete_optionsdelete_options() {
	delete_option( 'tsp_featured_posts_options' );
}

function fn_tsp_featured_posts_admin_head() 
{
	wp_register_style( 'tspfp_admin_stylesheet', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_style( 'tspfp_admin_stylesheet' );
}



// Add global setting for Captcha
$TSPFP_OPTIONS = get_option( 'tsp_featured_posts_options' );// get the options from the database

// adds "Settings" link to the plugin action page
add_filter( 'plugin_action_links', 'fn_tsp_featured_posts_plugin_action_links', 10, 2 );

//Additional links on the plugin page
add_filter( 'plugin_row_meta', 'fn_tsp_featured_posts_register_plugin_links', 10, 2 );

add_action( 'init', 'fn_tsp_featured_posts_plugin_init' );
add_action( 'admin_init', 'fn_tsp_featured_posts_plugin_init' );
add_action( 'admin_menu', 'fn_tsp_featured_posts_add_admin_menu' );
add_action( 'admin_enqueue_scripts', 'fn_tsp_featured_posts_admin_head' );

register_uninstall_hook( __FILE__, 'fn_tsp_featured_posts_delete_options' );


?>