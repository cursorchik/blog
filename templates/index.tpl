{extends "layout.tpl"}

{block name="title"}Главная - Все категории{/block}

{block name="content"}
	<h1>Категории блога</h1>

    {if empty($categories)}
		<p>Нет категорий с постами.</p>
    {else}
        {foreach $categories as $category}
			<section class="category-section">
				<h2>{$category.name}</h2>
                {if $category.description}
					<p class="category-desc">{$category.description}</p>
                {/if}

                {if $category.recent_posts|count}
					<div class="recent-posts">
						<ul class="post-list">
                            {foreach $category.recent_posts as $post}
								<li class="post-item">
									<img src="/images/coffee.jpg"  width="300" height="512" alt="Картинка">
									<a href="/post/{$post.id}">
                                        {if $post.image}
											<img src="{$post.image}" alt="{$post.title}" class="post-thumb">
                                        {/if}
										<div class="post-info">
											<h4>{$post.title}</h4>
											<p class="post-meta">{$post.created_at|date_format:"%d.%m.%Y"} | Просмотров: {$post.views}</p>
											<p>{$post.description|truncate:120:"..."}</p>
										</div>
									</a>
								</li>
                            {/foreach}
						</ul>
					</div>
                {else}
					<p>В этой категории пока нет постов.</p>
                {/if}

				<a href="/category/{$category.id}" class="btn-all">Все статьи категории →</a>
			</section>
			<hr>
        {/foreach}
    {/if}
{/block}