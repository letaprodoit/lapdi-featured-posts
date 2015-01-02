=== TSP Featured Posts ===
Contributors: thesoftwarepeople,sharrondenice
Donate link: http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-posts-for-wordpress.html
Tags: featured posts display gallery slider jquery moving boxes the software people
Requires at least: 3.5.1
Tested up to: 4.1
Stable tag: 1.2.5
License: Apache v2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

Featured Posts allows you to add featured posts to your blog's website via widgets, pages and/or posts.

== Description ==

The Software People's (TSP) Featured Posts plugin allows you to add featured posts to your blog's website via widget or on pages and posts using shortcodes. Featured Posts has five (5) layouts and can include thumbnails, post gallery and quotes.

= Shortcodes =

Add a `Featured Posts` to posts and pages by using a shortcode inside your text or evaluated from within your theme. You may override page/post `Featured Posts` options with shortcode attributes defined on the plugin's settings page.

* `[tsp-featured-posts]` - Will display posts with the default options defined in the plugin's settings page.
* `[tsp-featured-posts title="Title of Posts" keep_formatting="N" style="color: red;" max_words=10 show_quotes="N" show_thumb="Y" show_event_data="N" show_author="Y" show_date"N" show_private="N" show_text_posts="N" number_posts="5" excerpt_max=100 excerpt_min=60 post_type="post" post_ids="5,3,4" category="0" slider_width="865" slider_height="365 layout="0" order_by="DESC" thumb_width="80" thumb_height="80" read_more_text="more..." before_title="" after_title=""]` - Will override all attributes defined on the plugin's settings page.

== Installation ==

BEFORE YOU BEGIN: Requires the installation and activation of [TSP Easy Dev Latest Version](http://wordpress.org/plugins/tsp-easy-dev)

1. Upload `tsp-featured-posts` to the `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. After installation, refer to the `TSP Featured Posts` settings page for more detailed instructions on setting up your shortcodes.
4. `Featured Posts` widgets can be added to the sidemenu bar by visiting `Appearance > Widgets` and dragging the `TSP Featured Posts` widget to your sidebar menu.
5. Add some widgets to the sidemenu bar, Add shortcodes to pages and posts (see Instructions)
6. View your site
7. Adjust your CSS for your theme by visiting `Appearance > Edit CSS`
8. Adjust the `Sliding Gallery` settings, if necessary, by visiting `Plugins > Editor`, Select `TSP Featured Posts` and edit the `tsp-featured-posts.css` and `js/slider-scripts.js` files
9. Manipulating the CSS for `#postSlider` and `#tspfp_article` entries changes the gallery and article styles respectfully

== Frequently asked questions ==

= I've installed the plugin but my posts are not displaying? =

1. Make sure the folder `/wp-content/uploads/` has recursive, 777 permissions
2. Make sure you are listing posts from all `categories` that exist and/or `post_ids` is empty or the posts it refers to exists

== Screenshots ==

1. Admin area widget settings.
2. Featured Posts displayed on the front-end.
3. Featured Posts gallery.
4. Admin area shortcode settings area.

== Changelog ==

= 1.2.5 =
* Enhancement: Added support for viewing tribe event data (see The Events Calendar plugin)

= 1.2.4 =
* Enhancement: Added the option to display post types, to display events, appointments, etc. Anything with a post type you can now display
* Enhancement: Added new layout option, Top: Image, Title: Bottom, Excerpt: Last

= 1.2.3 =
* Enhancement: Added option to show private posts

= 1.2.2 =
* Enhancement: Added option to keep HTML formatting
* Enhancement: Added option to add style formatting to individual posts

= 1.2.1 =
* Enhancement (Blackley): Link thumbnails to articles
* Enhancement (Blackley): Link readmore text to article
* Enhancement (Blackley): Allow readmore text to be customized
* Enhancement (Blackley): Allow show/hide of post thumbnails
* Enhancement (Blackley): Allow user to control post info using CSS (author/date - #tspfp_article #article_about{})

= 1.2.0 =
* Enhancement: Allow spaces between commas when listing post IDs

= 1.1.9 =
* Fixed bug. Correctly locates TSP Easy Dev.

= 1.1.8 =
* Fixed bug. Prevent excerpts of protected posts from being displayed.

= 1.1.7 =
* Enhancement. Removed font size from moving boxes stylesheet

= 1.1.6 =
* Enhancement. Post images are now be pulled from featured thumbnail as well as content.

= 1.1.5 =
* Enhancement. Updated support link

= 1.1.4 =
* Removed inline function from widget_init hook to support older versions of PHP.

= 1.1.3 =
* Required fix to properly store new widget/shortcode attributes into database. (Update to Easy Dev 1.2.2).
* Added a `show_date` attribute to widget and shortcodes.
* Make `show_author` No by default

= 1.1.2 =
* Added back in assets folder

= 1.1.1 =
* Fixed issues with encrypted libraries.

= 1.1.0 =
* Now uses Easy Dev Pro for easy plugin development, <a href="https://twitter.com/#bringbackOOD">#bringbackOOD</a>
* Handled all PHP notices
* Added new attributes max_words (control post title lengths)
* Added new attributes excerpt_min, excerpt_max (control post content lengths)
* Added new attributes show_author (choose to show/hide the author of a post)
* Renamed attributes to prevent red spell checks when editing (old attributes still supported)
* Decreased plugin size by using Easy Dev

= 1.0.1 =
* Checks for existence of parent settings menu before overwriting it

= 1.0.0 =
* Launch

== Upgrade notice ==

= 1.2.5 =
Enhancement: Added support for viewing tribe event data (see The Events Calendar plugin)

= 1.2.4 =
Enhancement: Added the option to display post types, to display events, appointments, etc. Anything with a post type you can now display
Enhancement: Added new layout option, Top: Image, Title: Bottom, Excerpt: Last

= 1.2.3 =
Enhancement: Added option to show private posts

= 1.2.2 =
Enhancement: Added option to keep HTML formatting
Enhancement: Added option to add style formatting to individual posts

= 1.2.1 =
Enhancement (Blackley): Link thumbnails to articles
Enhancement (Blackley): Link readmore text to article
Enhancement (Blackley): Allow readmore text to be customized
Enhancement (Blackley): Allow show/hide of post thumbnails
Enhancement (Blackley): Allow user to control post info using CSS (author/date - #tspfp_article #article_about{})

= 1.2.0 =
Enhancement. Allow spaces between commas when listing post IDs

= 1.1.9 =
Fixed bug. Correctly locates TSP Easy Dev.

= 1.1.8 =
Fixed bug. Prevent excerpts of protected posts from being displayed.

= 1.1.7 =
Enhancement. Removed font size from moving boxes stylesheet

= 1.1.6 =
Enhancement. Post images are now be pulled from featured thumbnail as well as content.

= 1.1.5 =
Enhancement. Updated support link

= 1.1.4 =
Required fix to properly initialize widgets for older versions of PHP.

= 1.1.3 =
Required fix to properly store new widget/shortcode attributes into database. (Update to Easy Dev 1.2.2).
New widget/shortcode attribute.

= 1.1.2 =
Required Bug Fixes.

= 1.1.1 =
Required Bug Fixes.

= 1.1.0 =
Plugin now requires TSP Easy Dev. Uses TSP Easy Dev Pro. New features.

= 1.0.1 =
Menu fix.