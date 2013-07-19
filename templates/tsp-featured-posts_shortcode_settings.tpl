 <div class="tsp_container">
	<div class="icon32" id="tsp_icon"></div>
	<h2>Featured Posts Default Settings (The Software People)</h2>
	<div class="mycomment">
		<p><h3>Using Featured Posts Shortcode <a href="#" class="toggle">(hide/show details)</a>:</h3></p>
		<div class="note-details">
			<ul style="list-style-type:square;">
				<li>Changing the default post options below allows you to place <strong>[tsp-featured-posts]</strong> shortcode tag into any post or page with these options.</li>
				<li>However, if you wish to add different options to the <strong>[tsp-featured-posts]</strong> shortcode please use the following settings:
					<ul style="padding-left: 30px;">
						<li>Title: <strong>title="Title of Posts"</strong></li>
						<li>Max Words in Title: <strong>max_words=10</strong></li>
						<li>Show Quotes: <strong>show_quotes="Y"</strong>(Options: Y, N)</li>
						<li>Show Posts with No Media Content: <strong>show_text_posts="N"</strong>(Options: Y, N)</li>
						<li>Number Posts: <strong>number_posts="5"</strong></li>
						<li>Excerpt Length (Layouts #0 & #3): <strong>excerpt_min="60"</strong></li>
						<li>Excerpt Length (Layouts #1, #2 & #4): <strong>excerpt_max="100"</strong></li>
						<li>Post IDs: <strong>post_ids="5,3,4"</strong></li>
						<li>Category: <strong>category="0"</strong>(Any category ID, 0 returns all categories)</li>
						<li>Slider Width: <strong>slider_width="865"</strong></li>
						<li>Slider Height: <strong>slider_height="365"</strong></li>
						<li>Layout: <strong>layout="0"</strong>(Options: 0, 1, 2, 3, 4)
							<ul style="padding-left: 30px;">
								<li>0: Left: Image - Right: Title, Text (Thumbnail)</li>
								<li>1: Top: Title - Left: Image - Right: Text (Featured-Medium)</li>
								<li>2: Left: Title, Image - Right: Text (Featured-Large)</li>
								<li>3: Left: Image - Right: Text (Thumbnail/No title)</li>
								<li>4: Slider: Title, Image - Right: Text (Featured-Large)</li>
							</ul>
						</li>
						<li>Order By: <strong>order_by="DESC"</strong>(Options: rand,title,date,author,modified,ID)</li>
						<li>Thumbnail Width: <strong>thumb_width="80"</strong></li>
						<li>Thumbnail Height: <strong>thumb_height="80"</strong></li>
						<li>HTML Tag Before Title: <strong>before_title="&lt;h3&gt;"</strong></li>
						<li>HTML Tag After Title: <strong>after_title="&lt;/h3&gt;"</strong></li>
					</ul>
				</li>
				<li>Insert your desired shortcode into any page or post.</li>
			</ul>
			<hr>
			A shortcode with all the options will look like the following:<br><br>
			<strong>[tsp-featured-posts title="Title of Posts" max_words=10 show_quotes="N" show_text_posts="N" number_posts="5" excerpt_min="60" excerpt_max="100" post_ids="5,3,4" category="0" slider_width="865" slider_height="365 layout="0" order_by="DESC" thumb_width="80" thumb_height="80" before_title="" after_title=""]</strong>
		</div>
	
	</div>
	<script>
		{literal}
		jQuery("div.tsp_container a.toggle").click(function () {
			jQuery(".note-details").toggle();
		});
		{/literal}
	</script>
	<div class="updated fade" {if !$form || $error != ""}style="display:none;"{/if}><p><strong>{$message}</strong></p></div>
	<div class="error" {if !$error}style="display:none;"{/if}><p><strong>{$error}</strong></p></div>
	<form method="post" action="admin.php?page={$plugin_name}.php">
		<fieldset>
		{foreach $form_fields as $field}
			{include file="$EASY_PLUGIN_FORM_FIELDS" field=$field}
		{/foreach}
		</fieldset>
		<input type="hidden" name="{$plugin_name}_form_submit" value="submit" />
		<p class="submit">
			<input type="submit" class="button-primary" value="Save Changes" />
		</p>
		{$nonce_name}
	</form>
</div><!-- tsp_container -->
