<!-- // Top post on home page with full excerpt -->
<article id="post-{$ID}" {$post_class}>
	<div id="tspfp_article" class="layout2">
		<div id="left">
			<header class="entry-header">
				<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$title}">{$title}</a></div>
      		</header>
			{if isset($first_img) }
				<img align="left" src="{$first_img}" alt="{$long_title}" width="{$widththumb}" height="{$heightthumb}"/>
			{elseif isset($first_video)}
				<code>{$first_video}</code>
			{/if}
		</div>
		<div id="right">
			<header class="entry-header">
				<div class="comments-link">
					{if $comments_open && !$post_password_required}
						{$comments_popup_link}
					{/if}
				</div>
          		{if $showquotes == 'Y'}
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
