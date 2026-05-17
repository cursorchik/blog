{extends "layout.tpl"}

{block name="title"}{$post.title}{/block}

{block name="content"}
	<article class="full-post">
		<h1>{$post.title}</h1>
		<div class="post-meta">
			<span>📅 {$post.created_at|date_format:"%d.%m.%Y"}</span>
			<span>👁 {$post.views} просмотров</span>
		</div>

        {if $post.image}
			<img src="{$post.image}" alt="{$post.title}" class="post-full-img">
        {/if}

		<div class="post-content">
            {$post.content|nl2br}
		</div>
	</article>

    {if $similar_posts|count}
		<section class="similar-posts">
			<h2>Похожие статьи</h2>
			<div class="posts-grid">
                {foreach $similar_posts as $similar}
					<div class="post-card">
                        {if $similar.image}
							<img src="{$similar.image}" alt="{$similar.title}" class="post-card-img">
                        {/if}
						<div class="post-card-content">
							<h3><a href="/post/{$similar.id}">{$similar.title}</a></h3>
							<div class="post-meta">
								<span>{$similar.created_at|date_format:"%d.%m.%Y"}</span>
								<span>👁 {$similar.views}</span>
							</div>
							<p>{$similar.description|truncate:120:"..."}</p>
							<a href="/post/{$similar.id}" class="read-more">Читать →</a>
						</div>
					</div>
                {/foreach}
			</div>
		</section>
    {/if}
{/block}