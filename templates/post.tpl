{extends "layout.tpl"}

{block name="content"}
	<div class="container my-4">
		<div class="mb-3">
			<a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">← Назад</a>
		</div>
		<article class="mb-5">
			<h1 class="mb-3">{$post.title}</h1>
			<div class="text-muted mb-4">
				📅 {$post.created_at|date_format:"%d.%m.%Y"} | 👁 {$post.views} просмотров
			</div>
			<img src="/images/coffee.jpg" class="img-fluid rounded mb-4" alt="Изображение статьи">
			<div class="post-content">
                {$post.content|nl2br}
			</div>
		</article>

        {if $similar_posts|count}
			<section>
				<h3 class="mb-3">Похожие статьи</h3>
				<div class="row row-cols-1 row-cols-md-3 g-4">
                    {foreach $similar_posts as $similar}
						<div class="col">
							<div class="card h-100">
								<img src="/images/coffee.jpg" class="card-img-top" alt="...">
								<div class="card-body">
									<h5 class="card-title">
										<a href="/post/{$similar.id}" class="text-decoration-none">{$similar.title}</a>
									</h5>
									<p class="card-text text-muted small">
                                        {$similar.created_at|date_format:"%d.%m.%Y"} | 👁 {$similar.views}
									</p>
									<p>{$similar.description|truncate:120:"..."}</p>
									<a href="/post/{$similar.id}" class="btn btn-sm btn-primary">Читать</a>
								</div>
							</div>
						</div>
                    {/foreach}
				</div>
			</section>
        {/if}
	</div>
{/block}