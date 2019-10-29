<?php
	include __DIR__ . '/content_blocks/code.php';
	include __DIR__ . '/content_blocks/codeview.php';
	include __DIR__ . '/content_blocks/message.php';
	include __DIR__ . '/content_blocks/text.php';
?>

<div id="site-container">
	<main>
		<div class="container">
			<div class="content">
				<h1 class="title"><?php the_title(); ?></h1>
			</div>
		</div>

		<?php

			$submenu = array();
			$sections = carbon_get_the_post_meta('crb_sections');
			foreach ($sections as $section): ?>

			<?php /** In Subnavi? */ ?>
			<?php if (array_key_exists('nav_title_enabled', $section) && $section['nav_title_enabled']): ?>
				<?php array_push(
					$submenu,
					'<li><a href="#' . sanitize_title($section['nav_title']) . '">' . $section['nav_title'] . '</a></li>'
				) ?>
				<?php $nav_id = 'id="' . sanitize_title($section['nav_title']) . '"' ?>
			<?php else: ?>
				<?php $nav_id = '' ?>
			<?php endif; ?>

			<?php switch ($section['_type']): case '': break; ?>

			<?php case 'columns': ?>
			<div class="container" <?= $nav_id ?>>
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
			<div class="tabview" <?= $nav_id ?>>
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
			<div class="container" <?= $nav_id ?>>
				<?= templateq_text_block($section['text']); ?>
			</div>
			<?php break; ?>

			<?php case 'message': ?>
			<div class="container">
				<?= templateq_message_block($section['style'], $section['title'], $section['body']); ?>
			</div>
			<?php break; ?>

			<?php case 'code': ?>
			<div class="container" <?= $nav_id ?>>
				<?= templateq_code_block($section['language'], $section['code']); ?>
			</div>
			<?php break; ?>

			<?php case 'codepen': ?>
			<div <?= $nav_id ?>></div>
			<?= templateq_codeview_block($section['title'], $section['html'], $section['css'], $section['css_libs'], $section['js'], $section['js_libs']); ?>
			<?php break; ?>

			<?php case 'hr': ?>
			<hr>
			<?php break; ?>
			<?php endswitch; ?>
		<?php endforeach; ?>
	</main>

	<?php if (sizeof($submenu) > 0): ?>
		<aside class="menu" id="articleNav">
			<nav class="submenu">
				<ul>
					<?= implode($submenu) ?>
				</ul>
			</nav>
		</aside>
	<?php endif; ?>
