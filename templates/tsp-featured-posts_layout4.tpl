{if $first_post}
<div id="postSliderWrapper">
	<div id="postSlider" style="width:{$slider_width}px; visibility: hidden;">
{/if}
<!--  // Top post on home page slider -->
<article id="post-{$ID}" style="height:{$slider_height}px; ">
	<div id="{$plugin_key}_article" class="layout4">
		<div id="full">
			<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$long_title}">{$long_title}</a></div>
		</div>
		<div id="left">
			{$media}
		</div>
		<div id="right">
			{if $has_header_data}
				<header class="entry-header">
					<div class="comments-link">
						{if $comments_open && !$post_password_required}
							{$comments_popup_link}
						{/if}
					</div>
	          		{if $show_quotes == 'Y'}
	          			<div class="entry-quote">{$quote}</div>
	          		{/if}
					<div id="clear"></div>
				</header>
			{/if}
			<div class="entry-summary">{$full_preview}&nbsp;&nbsp;<a target="{$target}" href='{$permalink}'>Continue Reading <span class="meta-nav">&rarr;</span></a></div>
		</div>
		<div id="clear"></div>
	</div>
</article><!-- #post-{$ID} -->
{if $last_post}
	</div>
</div> <!-- end wrapper -->
{/if}
