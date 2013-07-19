<!-- // Center articles on home page -->
<article id="post-{$ID}" class="{$post_class}">
	<div id="{$plugin_key}_article" class="layout1">
		<div id="top">
			<header class="entry-header">
				{if $sticky}
					<div class="entry-format">{$featured}</div>
				{/if}
				<div id="left">
					<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$long_title}">{$long_title}</a></div>
				</div>
				<div id="right">
					<div class="comments-link">
						{if $comments_open && !$post_password_required}
							{$comments_popup_link}
						{/if}
					</div>
					<div id="clear"></div>
				</div>
			</header><!-- .entry-header -->
			<div id="clear"></div>
      		{if $show_quotes == 'Y'}
      			<div class="entry-quote">{$quote}</div>
      		{/if}
		</div>
		<div id="full">	 
			{$media}
			<span class="entry-summary">
				By: {$author_first_name}&nbsp;{$author_last_name}<br>
				{$full_preview}&nbsp;&nbsp;<a target="{$target}" href='{$permalink}'>Continue Reading <span class="meta-nav">&rarr;</span></a>
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
