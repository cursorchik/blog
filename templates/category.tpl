{extends "layout.tpl"}

{block name="content"}
	<div class="container my-4">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h1>{$category.name}</h1>
			<a href="/" class="btn btn-secondary btn-sm">← На главную</a>
		</div>
        {if $category.description}
			<p class="lead">{$category.description}</p>
        {/if}

		<!-- Блок сортировки -->
		<div class="d-flex gap-2 mb-4">
			<span class="me-2">Сортировать:</span>
			<a href="?sort=created_at&order={if $sort=='created_at' and $order=='DESC'}ASC{else}DESC{/if}"
			   class="btn btn-outline-secondary btn-sm {if $sort=='created_at'}active{/if}">
				По дате {if $sort=='created_at'}{if $order=='DESC'}↓{else}↑{/if}{/if}
			</a>
			<a href="?sort=views&order={if $sort=='views' and $order=='DESC'}ASC{else}DESC{/if}"
			   class="btn btn-outline-secondary btn-sm {if $sort=='views'}active{/if}">
				По просмотрам {if $sort=='views'}{if $order=='DESC'}↓{else}↑{/if}{/if}
			</a>
		</div>

        {if $posts|count}
			<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                {foreach $posts as $post}
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
								<p class="card-text">{$post.description|truncate:160:"..."}</p>
								<a href="/post/{$post.id}" class="btn btn-outline-primary btn-sm">Читать →</a>
							</div>
						</div>
					</div>
                {/foreach}
			</div>

			<!-- Пагинация Bootstrap -->
            {if $total_pages > 1}
				<nav aria-label="Пагинация" class="mt-4">
					<ul class="pagination justify-content-center">
                        {if $current_page > 1}
							<li class="page-item">
								<a class="page-link" href="?page={$current_page-1}&sort={$sort}&order={$order}">←</a>
							</li>
                        {/if}
                        {for $p = 1 to $total_pages}
							<li class="page-item {if $p == $current_page}active{/if}">
								<a class="page-link" href="?page={$p}&sort={$sort}&order={$order}">{$p}</a>
							</li>
                        {/for}
                        {if $current_page < $total_pages}
							<li class="page-item">
								<a class="page-link" href="?page={$current_page+1}&sort={$sort}&order={$order}">→</a>
							</li>
                        {/if}
					</ul>
				</nav>
            {/if}
        {else}
			<div class="alert alert-info">В этой категории пока нет статей.</div>
        {/if}
	</div>
{/block}