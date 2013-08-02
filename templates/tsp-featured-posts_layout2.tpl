<!-- // Top post on home page with full excerpt -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout2">
		<div id="left">
			<header class="entry-header">
				<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$title}">{$title}</a></div>
      		</header>
			{$media}
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
				{if $show_author == 'Y'}By: {$author_first_name}&nbsp;{$author_last_name}<br>{/if}
				{$full_preview}&nbsp;&nbsp;<a target="{$target}" href='{$permalink}'>Continue Reading <span class="meta-nav">&rarr;</span></a>
			</div>
		</div>
		<div id="clear"></div>
		<footer class="entry-meta">
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>
</article><!-- #post-{$ID} -->
