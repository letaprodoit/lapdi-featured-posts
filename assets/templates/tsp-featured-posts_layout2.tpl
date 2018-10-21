<!-- // Top post on home page with full excerpt -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout2" style="{$style}">
		<div id="left">
			<header class="entry-header">
				<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$title}">{$title}</a></div>
      		</header>
			{if $show_thumb}
				<a target="{$target}" href="{$permalink}" title="{$long_title}">{$media}</a>
			{/if}
		</div>
		<div id="right">
			<header class="entry-header">
				{if $comments_open && !$post_password_required}
					<div class="comments-link">
						{$comments_popup_link}
					</div>
				{/if}
          		{if $show_quotes == 'Y'}
          			<div class="entry-quote">{$quote}</div>
          		{/if}
				<div id="clear"></div>
			</header>
			<div class="entry-summary">
				{if $show_author == 'Y' || $show_date == 'Y'}
					<div id="article_about">
						{if $show_author == 'Y'}By: {$author_first_name}&nbsp;{$author_last_name}&nbsp;{/if} {if $show_date == 'Y'}Published On: {$publish_date}{/if}
					</div>
				{/if}
				{$full_preview}
			</div>
		</div>
		<div id="clear"></div>
		<footer class="entry-meta">
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>
</article><!-- #post-{$ID} -->
