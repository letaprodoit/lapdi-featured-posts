<!-- // Side bar featured item with NO title -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout3">
		<div id="full">
			{if $first_img }
				<img align="left" src="{$first_img}" alt="{$long_title}" width="{$thumb_width}" height="{$thumb_height}"/>
			{elseif $first_video}
				<code>{$first_video}</code>
			{/if}
			<span class="entry-summary">{$text}</span>
		</div>
		<footer class="entry-meta">
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>   
</article><!-- #post-{$ID} -->
