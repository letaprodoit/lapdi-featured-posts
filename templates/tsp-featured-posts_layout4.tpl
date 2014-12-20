{if $first_post}
<div id="postSliderWrapper">
	<div id="postSlider" style="width:{$slider_width}px; visibility: hidden;">
{/if}
<!--  // Top post on home page slider -->
<article id="post-{$ID}" style="height:{$slider_height}px; ">
	<div id="{$plugin_key}_article" class="layout4" style="{$style}">
		<div id="full">
			<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$long_title}">{$long_title}</a></div>
		</div>
		{if $show_thumb}
		<div id="left">
			<a target="{$target}" href="{$permalink}" title="{$long_title}">{$media}</a>
		</div>
		<div id="right">
		{else}
		<div id="full">
		{/if}
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
	</div>
</article><!-- #post-{$ID} -->
{if $last_post}
	</div>
</div> <!-- end wrapper -->
{/if}
