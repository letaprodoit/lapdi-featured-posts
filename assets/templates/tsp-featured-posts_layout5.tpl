<!-- // Center articles on home page -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout5" style="{$style}">
		<div id="top">
			<header class="entry-header">
				{if $show_thumb}
					<a target="{$target}" href="{$permalink}" title="{$long_title}">{$media}</a>
				{/if}
			</header><!-- .entry-header -->
			<div id="clear"></div>
		</div>
		<div id="full">	 
			{if $sticky}
				<div class="entry-format">{$featured}</div>
			{/if}
			<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$long_title}">{$long_title}</a></div>
		</div>
		<div class="clear"></div>
		<div id="full">	 
			<span class="entry-summary">
				{if $show_author == 'Y' || $show_date == 'Y'}
					<div id="article_about">
						{if $show_author == 'Y'}By: {$author_first_name}&nbsp;{$author_last_name}&nbsp;{/if} {if $show_date == 'Y'}Published On: {$publish_date}{/if}
					</div>
				{/if}
				{$full_preview}
			</span>
		</div>
		<div class="clear"></div>
		<div class="entry-other" style="padding: 20px 0px 10px 0px;">
            {$content_bottom}
        </div>						
		<footer class="entry-meta">
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>   
</article><!-- #post-{$ID} -->
