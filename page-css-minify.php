<?php
	include __DIR__ . '/content_blocks/code.php';
	include __DIR__ . '/content_blocks/codeview.php';
	include __DIR__ . '/content_blocks/message.php';
	include __DIR__ . '/content_blocks/text.php';
?>

<?php get_header(); ?>

<div id="site-wrapper">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
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

				<div class="container-fluid xml-stripper">
					<div class="columns">
						<div class="column">
							<p class="has-text-grey is-uppercase is-size-7">Input</p>
							<textarea class="textarea is-family-code" name="" id="input" cols="30" rows="10"></textarea>
						</div>

						<div class="column has-background-light">
							<p class="has-text-grey is-uppercase is-size-7">Output</p>
							<textarea class="textarea is-family-code" name="" id="output" cols="30" rows="10" readonly></textarea>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</main>



	<script>
		function httpGet(url) {
			let request, response;
			request = new XMLHttpRequest();
			request.open('GET', url, false);
			request.send(null);

			// fix relative URLs
			response = request.responseText.replace(/\.\./g, url);

			return response;
		}

		$(function() {
			$('#input').on('input propertychange', function() {
				let css, importRegexp, imports, output;
				css = $(this).val();

				// Import imports
				importRegexp = /@import url\(['\"](.*)['\"]\);/g;

				imports = (css.match(importRegexp) || []).map(e =>
					e.replace(importRegexp, '$1')
				);

				// Write contents of imports to output
				output = imports.map(u => httpGet(u)).join();

				// Strip import statements
				output += css.replace(importRegexp, '');

				// Strip comments
				output = output.replace(/\/\*[\s\S]+?\*\//g, '');

				// Strip whitespace
				output = output.replace(/\s+/g, '');
				$('#output').val(output);
			});
		});
	</script>

<?php get_footer(); ?>