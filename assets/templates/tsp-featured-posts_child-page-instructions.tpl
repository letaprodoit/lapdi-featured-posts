<p>Changing the default post options allows you to place <code>[tsp-featured-posts]</code> shortcode tag into any post or page with the default options.</p>
<p>However, if you wish to add different options to the <code>[tsp-featured-posts]</code> shortcode please use the following settings:</p>
<ul style="list-style-type:square; padding-left: 30px;">
	<li>Title: <code>title="Title of Posts"</code></li>
	<li>Max Words in Title: <code>max_words=10</code></li>
	<li>Show Event Data: <code>show_event_data="Y"</code>(Options: Y, N - Requires The Event Calendar plugin &amp; fpost_type="tribe_events")</li>
	<li>Show Author: <code>show_author="Y"</code>(Options: Y, N)</li>
	<li>Show Publish Date: <code>show_date="Y"</code>(Options: Y, N)</li>
	<li>Show Quotes: <code>show_quotes="Y"</code>(Options: Y, N)</li>
	<li>Show Private Posts: <code>show_private="N"</code>(Options: Y, N)</li>
	<li>Show Posts with No Media Content: <code>show_text_posts="N"</code>(Options: Y, N)</li>
	<li>Keep Formatting: <code>keep_formatting="N"</code>(Options: Y, N)</li>
	<li>CSS Style tags: <code>style="color: red;"</code> (CSS tags seperated by semicolon)</li>
	<li>Number Posts: <code>number_posts="5"</code></li>
	<li>Read More Text: <code>read_more_text="Continue Reading <span class="meta-nav">&rarr;</span>"</code></li>
	<li>Excerpt Length (Layouts #0 & #3): <code>excerpt_min="60"</code></li>
	<li>Excerpt Length (Layouts #1, #2, #4[Slider], #5): <code>excerpt_max="100"</code></li>
	<li>Post Class: <code>post_class=""</code>(Example: columns1_3, columns1_2)</li>
	<li>Post Type: <code>fpost_type="post"</code>(Options: post, varies)</li>
	<li>Post IDs: <code>post_ids="5,3,4"</code></li>
	<li>Category: <code>category="0"</code>(Any category ID, 0 returns all categories)</li>
	<li>Slider Width: <code>slider_width="865"</code></li>
	<li>Slider Height: <code>slider_height="365"</code></li>
	<li>Layout: <code>layout="0"</code>(Options: 0, 1, 2, 3, 4, 5)
		<ul style="padding-left: 30px;">
			<li>0: Left: Image - Right: Title, Text (Thumbnail)</li>
			<li>1: Top: Title - Left: Image - Right: Text (Featured-Medium)</li>
			<li>2: Left: Title, Image - Right: Text (Featured-Large)</li>
			<li>3: Left: Image - Right: Text (Thumbnail/No title)</li>
			<li>4: Slider: Title, Image - Right: Text (Featured-Large)</li>
			<li>5: Top: Image, Bottom: Title, Bottom-Last: Text</li>
		</ul>
	</li>
	<li>Order By: <code>order_by="DESC"</code>(Options: rand,title,date,author,modified,ID)</li>
	<li>Show Thumbnails: <code>show_thumb="Y"</code>(Options: Y, N)</li>
	<li>Thumbnail Width: <code>thumb_width="80"</code></li>
	<li>Thumbnail Height: <code>thumb_height="80"</code></li>
	<li>HTML Tag Before Title: <code>before_title="&lt;h3&gt;"</code></li>
	<li>HTML Tag After Title: <code>after_title="&lt;/h3&gt;"</code></li>
</ul>
<hr>
A shortcode with all the options will look like the following:<br><br>
<code>[tsp-featured-posts title="Title of Posts" keep_formatting="N" style="color: red;" max_words=10 show_quotes="N" show_thumb="Y" show_event_data="N" show_author="Y" show_date"N" show_private="N" show_text_posts="N" number_posts="5" excerpt_max=100 excerpt_min=60 post_class="" fpost_type="post" post_ids="5,3,4" category="0" slider_width="865" slider_height="365 layout="0" order_by="DESC" thumb_width="80" thumb_height="80" read_more_text="more..." before_title="" after_title=""]</code>