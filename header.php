<!DOCTYPE html>
<html lang="de" style="margin-top: 0 !important">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body>

<aside class="menu">
	<!-- Logo -->
	<div class="logo">
		<img src="/wp-content/themes/templateq/img/logo.svg" alt="Qnipsel">
	</div>

	<nav>
		<?php wp_list_pages(array(
			'title_li' => null,
			'walker' => new Templateq_Walker()
		)); ?>
	</nav>
</aside>