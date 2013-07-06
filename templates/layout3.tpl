<!-- // Side bar featured item with NO title -->
<article id="post-{$ID}" {$post_class}>
	<div id="tspfp_article" class="layout3">
		<div id="full">
			{if isset($first_img) }
				<img align="left" src="{$first_img}" alt="{$long_title}" width="{$widththumb}" height="{$heightthumb}"/>
			{elseif isset($first_video)}
				<code>{$first_video}</code>
			{/if}
			<span class="entry-summary">{$text}</span>
		</div>
		<footer class="entry-meta">
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>   
</article><!-- #post-{$ID} -->
