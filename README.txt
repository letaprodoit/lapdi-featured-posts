=== TSP Featured Posts ===
Contributors: thesoftwarepeople,sharrondenice
Donate link: http://www.thesoftwarepeople.com/software/plugins/wordpress/featured-posts-for-wordpress.html
Tags: featured posts display gallery slider jquery moving boxes the software people
Requires at least: 3.5.1
Tested up to: 3.5.2
Stable tag: 1.0.1
License: Apache v2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

Featured Posts allows you to add featured posts to your blog's website via widget or on pages and posts using shortcodes.

== Description ==

The Software People's (TSP) Featured Posts plugin allows you to add featured posts to your blog's website via widget or on pages and posts using shortcodes. Featured Posts has five (5) layouts and can include thumbnails, post gallery and quotes.

= Shortcodes =

Add a `Featured Posts` to posts and pages by using a shortcode inside your text or evaluated from within your theme. You may override page/post `Featured Posts` options with shortcode attributes defined on the plugin's settings page.

* `[tsp-featured-posts]` - Will display posts with the default options defined in the plugin's settings page.
* `[tsp-featured-posts title="Title of Posts" showquotes="N" showtextposts="N" numberposts="5" postids="5,3,4" category="0" widthslider="865" heightslider="365 layout="0" orderby="DESC" widththumb="80" heightthumb="80" beforetitle="" aftertitle=""]` - Will override all attributes defined on the plugin's settings page.

== Installation ==

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
2. Make sure you are listing posts from all `categories` that exist and/or `postids` is empty or the posts it refers to exists

== Screenshots ==

1. Admin area widget settings.
2. Featured Posts displayed on the front-end.
3. Featured Posts gallery.
4. Admin area shortcode settings area.

== Changelog ==



== Upgrade notice ==
