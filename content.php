<?php
	include __DIR__ . '/content_blocks/code.php';
	include __DIR__ . '/content_blocks/codeview.php';
	include __DIR__ . '/content_blocks/message.php';
	include __DIR__ . '/content_blocks/text.php';
?>

<div class="container">
	<div class="content">
		<h1 class="title"><?php the_title(); ?></h1>
	</div>
</div>

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

<footer class="footer has-text-centered">
	<?php the_author(); ?> | <?= the_date(); ?> &mdash; <?php the_modified_author(); ?> | <?= the_modified_date(); ?>
</footer>
