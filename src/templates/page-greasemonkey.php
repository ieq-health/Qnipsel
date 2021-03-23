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

		<?php
		$sections = carbon_get_the_post_meta('crb_sections');
		foreach ($sections as $section): ?>

			<?php switch ($section['_type']): case '': break; ?>

				<?php case 'columns': ?>
					<div class="container">
						<div class="columns">
						<?php foreach ($section['crb_columns'] as $column): ?>
							<div class="column">
								<?php if ($column['_type'] == 'text'): ?>
									<?= templateq_text_block($column['text']); ?>
								<?php endif; ?>

								<?php if ($column['_type'] == 'message'): ?>
									<?= templateq_message_block($column['style'], $column['title'], $column['body']); ?>
								<?php endif; ?>

								<?php if ($column['_type'] == 'code'): ?>
									<?= templateq_code_block($column['language'], $column['code']); ?>
								<?php endif; ?>

							</div>
						<?php endforeach; ?>
						</div>
					</div>
				<?php break; ?>

				<?php case 'tabs': ?>
					<div class="tabview">
						<div class="container">
							<div class="tabs">
								<ul>
									<?php foreach ($section['crb_tabs'] as $tab): ?>
										<li><a href="#<?= sanitize_title($tab['title']); ?>"><?= $tab['title']; ?></a></li>
									<?php endforeach; ?>
								</ul>
							</div>

							<div class="tab-content">
								<?php foreach ($section['crb_tabs'] as $tab): ?>
									<div id="<?= sanitize_title($tab['title']); ?>">
										<?php if ($tab['_type'] == 'text'): ?>
											<?= templateq_text_block($tab['text']); ?>
										<?php endif; ?>


										<?php if ($tab['_type'] == 'code'): ?>
											<?= templateq_code_block($tab['language'], $tab['code']); ?>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php break; ?>

				<?php case 'text': ?>
					<div class="container">
						<?= templateq_text_block($section['text']); ?>
					</div>
				<?php break; ?>

				<?php case 'message': ?>
					<div class="container">
						<?= templateq_message_block($section['style'], $section['title'], $section['body']); ?>
					</div>
				<?php break; ?>

				<?php case 'code': ?>
					<div class="container">
						<?= templateq_code_block($section['language'], $section['code']); ?>
					</div>
				<?php break; ?>

				<?php case 'codepen': ?>
					<?= templateq_codeview_block($section['title'], $section['html'], $section['css'], $section['css_libs'], $section['js'], $section['js_libs']); ?>
				<?php break; ?>

				<?php case 'hr': ?>
					<hr>
				<?php break; ?>
			<?php endswitch; ?>
		<?php endforeach; ?>

		<?php while ($userscripts->have_posts()): $userscripts->the_post(); ?>
			<div class="container">
				<div class="columns">
					<div class="column">
							<div class="content">
								<h2 id="<?= sanitize_title(get_the_title()) ?>"><?php the_title(); ?></h2>
								<?= wpautop(carbon_get_the_post_meta('description')) ?>
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
