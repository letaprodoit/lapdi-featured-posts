<!-- // Side bar featured item with NO title -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout3">
		<div id="full">
			{$media}
			<span class="entry-summary">
				{if $show_author == 'Y' || $show_date == 'Y'}
					{if $show_author == 'Y'}By: {$author_first_name}&nbsp;{$author_last_name}&nbsp;{/if} {if $show_date == 'Y'}Published On: {$publish_date}{/if}
					<br>
				{/if}
				{$text}
			</span>
		</div>
		<footer class="entry-meta">
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>   
</article><!-- #post-{$ID} -->
