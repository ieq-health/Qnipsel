<!DOCTYPE html>
<html lang="de" style="margin-top: 0 !important">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
	<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<?php wp_head(); ?>
	
	<link rel="apple-touch-icon" sizes="57x57" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?= get_stylesheet_directory_uri() ?>/assets/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?= get_stylesheet_directory_uri() ?>/assets/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
</head>
<body>

<div class="colorbar"></div>

<nav class="navbar has-shadow">
	<div class="navbar-brand">
		<img src="<?= get_stylesheet_directory_uri() ?>/assets/logo.svg" alt="Qnipsel">
	</div>

	<div class="navbar-menu">
		<div class="navbar-start">
			<?php wp_list_pages(array(
				'title_li' => null,
				'walker' => new Templateq_Split_Nav_Topnav_Walker()
			)); ?>
		</div>

		<div class="navbar-end">
			<div class="field page-search">
				<div class="control">
					<input type="search" class="input" placeholder="Suche">
					<div class="box page-search__results">
						<div class="menu">
							<ul class="menu-list">
								<?php wp_list_pages(array( 
									'title_li' => null,
									'walker' => new Templateq_Pagesearch_Walker()
								)); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="field tooltip has-tooltip-bottom" data-tooltip="Dark Mode">
				<input id="darkMode" type="checkbox" name="DarkMode" class="switch is-small is-link is-rounded is-rtl">
				<label for="darkMode"><?= templateq_icon_moon() ?></label>
			</div>
			<div class="field tooltip has-tooltip-bottom" data-tooltip="Zeilenumbruch">
				<input type="checkbox" id="lineWrap" name="LineWrap" class="switch is-small is-warning is-rounded is-rtl">
				<label for="lineWrap"><?= templateq_icon_wrap() ?></label>
			</div>
		</div>
	</div>
</nav>
