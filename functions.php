<div class="container">
	<div class="content">
	<h1 class="title"><?php the_title(); ?></h1>
	</div>
</div>

<?php

$sections = carbon_get_the_post_meta('crb_sections');
foreach ($sections as $section) {
	switch ($section['_type']) {
		case 'columns': ?>
			<div class="container">
				<div class="columns">
				<?php foreach ($section['crb_columns'] as $column): ?>
					<div class="column">

						<?php if ($column['_type'] == 'text'): ?>
							<?= wpautop($column['text']); ?>
						<?php endif; ?>

						<?php if ($column['_type'] == 'message'): ?>
							<div class="message is-<?= $column['style'] ?>">
								<?php if (!empty($column['title'])): ?>
									<div class="message-header">
										<?= $column['title'] ?>
									</div>
								<?php endif ?>

								<div class="message-body content">
									<?= $column['body'] ?>
								</div>
							</div>
						<?php endif; ?>

					</div>
				<?php endforeach; ?>
				</div>
			</div>
		<?php break;

		case 'text': ?>
			<div class="container">
				<div class="content">
					<?= wpautop($section['text']) ?>
				</div>
			</div>
		<?php break;

		case 'message': ?>
			<div class="container">
				<div class="message is-<?= $section['style'] ?>">
					<?php if (!empty($section['title'])): ?>
						<div class="message-header">
							<?= $section['title'] ?>
						</div>
					<?php endif ?>

					<div class="message-body content">
						<?= $section['body'] ?>
					</div>
				</div>
			</div>
		<?php break;

		case 'code': ?>
			<div class="container">
				<pre><code data-language="<?= $section['language']; ?>"><?= $section['code']; ?></code></pre>
			</div>
		<? break;
		
		case 'codepen':
			$title = $section['title'];
			$html = $section['html'];
			$css = $section['css'];
			$js = $section['js'];
			?>
			<div class="codeview__code">

				<div class="level">

					<!-- Tabs -->
					<div class="level-left">
					<div class="level-item">
						<div class="tabs">
						<ul id="<?= $title ?>Tab">
							<li class="is-active"><a id="<?= $title ?>-tab-preview" href="#<?= $title ?>-preview">Vorschau</a></li>
							<li><a id="<?= $title ?>-tab-html" href="#<?= $title ?>-html">HTML</a></li>
							<li><a id="<?= $title ?>-tab-css"  href="#<?= $title ?>-css" >CSS</a></li>
							<li><a id="<?= $title ?>-tab-js"   href="#<?= $title ?>-js"  >JS</a></li>
						</ul>
						</div>
					</div>
					</div>
					<!-- END Tabs -->

					<!-- Tags -->
					<div class="level-right">
					<div class="level-item">
						<div class="field is-grouped">
						<?php if (in_array('bootstrap', $section['css_libs'])): ?>
						<div class="control">
							<div class="tags has-addons">
							<div class="tag is-dark">CSS</div>
							<div class="tag is-black">Bootstrap</div>
							</div>
						</div>
						<?php endif; ?>

						<?php if (in_array('bootstrap', $section['js_libs'])): ?>
						<div class="control">
							<div class="tags has-addons">
							<div class="tag is-dark">JS</div>
							<div class="tag is-black">Bootstrap</div>
							</div>
						</div>
						<?php endif; ?>

						<?php if (in_array('jquery', $section['js_libs'])): ?>
						<div class="control">
							<div class="tags has-addons">
							<div class="tag is-dark">JS</div>
							<div class="tag is-black">jQuery</div>
							</div>
						</div>
						<?php endif; ?>
						</div>
					</div>
					</div>
					<!-- END Tags -->

				</div>

				<div class="tab-content" id="<?= $title ?>TabContent">
					<div class="is-active" id="<?= $title ?>-preview">
					<iframe id="<?= $title ?>" class="codeview__preview-frame"></iframe>
					</div>
					<div id="<?= $title ?>-html">
					<pre><code data-language="html"><?= $html ?></code></pre>
					</div>
					<div id="<?= $title ?>-css">
					<pre><code data-language="css"><?= $css ?></code></pre>
					</div>
					<div id="<?= $title ?>-js">
					<pre><code data-language="javascript"><?= $js ?></code></pre>
					</div>                   
				</div>
			</div>

			<script>
				let iframe = document.getElementById('<?= $section['title'] ?>').contentWindow.document;
				iframe.open();

				<?php if (in_array('bootstrap', $section['css_libs'])): ?>
					iframe.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">');
				<?php endif; ?>

				<?php if (in_array('slick', $section['css_libs'])): ?>
					iframe.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">');
					iframe.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">');
				<?php endif; ?>

				iframe.write(`<style><?= $css ?></style>`);
				iframe.write(`<body><?= $html ?></body>`);

				<?php if (in_array('jquery', $section['js_libs'])): ?>
					iframe.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"><\/script>');
				<?php endif; ?>

				<?php if (in_array('bootstrap', $section['js_libs'])): ?>
					iframe.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"><\/script>');
					iframe.write('<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"><\/script>');
				<?php endif; ?>

				<?php if (in_array('slick', $section['js_libs'])): ?>
					iframe.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"><\/script>');
					iframe.write('<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" crossorigin="anonymous"><\/script>');
				<?php endif; ?>

				iframe.write(`<script><?= $js ?><\/script>`);
				iframe.close();
			</script>
			<?php
	}
}
?>

			<footer class="footer has-text-centered">
				<?php the_author(); ?> | <?= the_date(); ?> &mdash; <?= the_modified_date(); ?>
			</footer>
