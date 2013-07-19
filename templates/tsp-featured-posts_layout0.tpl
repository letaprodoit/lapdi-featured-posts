<!-- // Side bar featured item with title -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout_default layout0">
		<div id="full">
			{$media}
			<header class="entry-header">
				<span class="entry-title"><a target="{$target}" href="{$permalink}" title="{$long_title}">{$long_title}</a></span>
			</header><!-- .entry-header -->
			<span class="entry-summary">{$text}</span>
		</div>
		<footer class="entry-meta">
			{$wp_link_pages}
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>   
</article><!-- #post-{$ID} -->
