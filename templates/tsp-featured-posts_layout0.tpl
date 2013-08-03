<!-- // Side bar featured item with title -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout_default layout0">
		<div id="full">
			{$media}
			<header class="entry-header">
				<span class="entry-title"><a target="{$target}" href="{$permalink}" title="{$long_title}">{$long_title}</a></span>
			</header><!-- .entry-header -->
			<span class="entry-summary">
				{if $show_author == 'Y' || $show_date == 'Y'}
					{if $show_author == 'Y'}By: {$author_first_name}&nbsp;{$author_last_name}&nbsp;{/if} {if $show_date == 'Y'}Published On: {$publish_date}{/if}
					<br>
				{/if}
				{$text}
			</span>
		</div>
		<footer class="entry-meta">
			{$wp_link_pages}
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>   
</article><!-- #post-{$ID} -->
