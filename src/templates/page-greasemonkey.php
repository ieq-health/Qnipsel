<?php
	get_header();

	// Create code block
	$userscripts = new WP_Query(array(
		'post_type' => 'userscript',
		'nopaging' => true
	));

	$submenu = array();
	?>

<div id="site-container">
	<main>
		<?php get_template_part('partials/content', 'title'); ?>

		<?php while ($userscripts->have_posts()): $userscripts->the_post(); ?>
			<div class="container">
				<div class="columns">
					<div class="column">
							<div class="content">
								<h2 id="<?= sanitize_title(get_the_title()) ?>"><?php the_title(); ?></h2>
								<?= templateq_code_block('javascript', carbon_get_the_post_meta('script')) ?>
							</div>

							<?php array_push(
								$submenu,
								'<li><a href="#' . sanitize_title(get_the_title()) . '">' . get_the_title() . '</a></li>'
							) ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</main>

	<?php wp_reset_postdata(); ?>

	<?php if (sizeof($submenu) > 0): ?>
		<aside class="menu" id="articleNav">
			<nav class="submenu">
				<ul>
					<?= implode($submenu) ?>
				</ul>
			</nav>
		</aside>
	<?php endif; ?>


<?php get_footer(); ?>
