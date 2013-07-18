<!-- // Top post on home page with full excerpt -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout2">
		<div id="left">
			<header class="entry-header">
				<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$title}">{$title}</a></div>
      		</header>
			{if $first_img }
				<img align="left" src="{$first_img}" alt="{$long_title}" width="{$thumb_width}" height="{$thumb_height}"/>
			{elseif $first_video}
				<code>{$first_video}</code>
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
				{$full_preview}&nbsp;&nbsp;<a target="{$target}" href='{$permalink}'>Continue Reading <span class="meta-nav">&rarr;</span></a>
			</div>
		</div>
		<div id="clear"></div>
		<footer class="entry-meta">
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>
</article><!-- #post-{$ID} -->
