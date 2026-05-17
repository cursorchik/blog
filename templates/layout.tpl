<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{block name="title"}Мой сайт{/block}</title>
	<link rel="stylesheet" href="/css/styles.css">
    {block name="styles"}{/block}
</head>
<body>
<header>
	<div class="logo"><a href="/">Blog</a></div>
    <div>{block name="header"}{/block}</div>
</header>

<main>
    {block name="content"}{/block}
</main>

<footer>
    {block name="footer"}{/block}
</footer>

{block name="scripts"}{/block}
</body>
</html>