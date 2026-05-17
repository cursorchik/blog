<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{block name="title"}Мой сайт{/block}</title>
    {block name="styles"}{/block}
</head>
<body>
<header>
    {block name="header"}Шапка сайта{/block}
</header>

<main>
    {block name="content"}Основное содержание{/block}
</main>

<footer>
    {block name="footer"}Подвал{/block}
</footer>

{block name="scripts"}{/block}
</body>
</html>