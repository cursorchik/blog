{extends "layout.tpl"}

{block name="content"}
	<div class="container my-4">
		<h1 class="mb-4">Категории блога</h1>

        {foreach $categories as $category}
			<section class="category-section mb-5">
				<div class="d-flex justify-content-between align-items-center mb-3">
					<h2>{$category.name}</h2>
					<a href="/category/{$category.id}" class="btn btn-outline-primary btn-sm">Все статьи →</a>
				</div>
                {if $category.description}
					<p class="text-muted">{$category.description}</p>
                {/if}

                {if $category.recent_posts|count}
					<div class="row row-cols-1 row-cols-md-3 g-4">
                        {foreach $category.recent_posts as $post}
							<div class="col">
								<div class="card h-100">
									<img src="/images/coffee.jpg" class="card-img-top" alt="...">
									<div class="card-body">
										<h5 class="card-title">
											<a href="/post/{$post.id}" class="text-decoration-none">{$post.title}</a>
										</h5>
										<p class="card-text text-muted small">
                                            {$post.created_at|date_format:"%d.%m.%Y"} | 👁 {$post.views}
										</p>
										<p class="card-text">{$post.description|truncate:120:"..."}</p>
										<a href="/post/{$post.id}" class="btn btn-sm btn-primary">Читать</a>
									</div>
								</div>
							</div>
                        {/foreach}
					</div>
                {else}
					<p class="text-secondary">Нет постов в этой категории.</p>
                {/if}
			</section>
			<hr class="my-4">
        {/foreach}
	</div>
{/block}