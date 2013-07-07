{if $first_post}
<div id="postSliderWrapper" style="width:{$widthslider}px; height:{$heightslider}px;">
	<div id="postSlider" style="visibility: hidden;">
{/if}
<!--  // Top post on home page slider -->
		<article id="post-{$ID}" {$post_class}>
			<div id="tspfp_article" class="layout4">
				<div id="full">
					<div class="entry-title"><a target="{$target}" href="{$permalink}" title="{$long_title}">{$long_title}</a></div>
				</div>
				<div id="left">
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
					<div class="entry-summary">{$full_preview}&nbsp;&nbsp;<a target="{$target}" href='{$permalink}'>Continue Reading <span class="meta-nav">&rarr;</span></a></div>
				</div>
				<div id="clear"></div>
			</div>
		</article><!-- #post-{$ID} -->
{if $last_post}
	</div>
</div> <!-- end wrapper -->
{/if}
