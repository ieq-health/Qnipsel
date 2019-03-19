<?php
	include __DIR__ . '/content_blocks/code.php';
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
foreach ($sections as $section) {
	switch ($section['_type']) {

		case 'columns': ?>
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
		<?php break;

		case 'tabs': ?>
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
		<?php break;

		case 'text': ?>
			<div class="container">
				<?= templateq_text_block($section['text']); ?>
			</div>
		<?php break;

		case 'message': ?>
			<div class="container">
				<?= templateq_message_block($section['style'], $section['title'], $section['body']); ?>
			</div>
		<?php break;

		case 'code': ?>
			<div class="container">
				<?= templateq_code_block($section['language'], $section['code']); ?>
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

						<?php if (in_array('slick', $section['css_libs'])): ?>
							<div class="control">
								<div class="tags has-addons">
									<div class="tag is-dark">CSS</div>
									<div class="tag is-black">Slick</div>
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

						<?php if (in_array('slick', $section['js_libs'])): ?>
							<div class="control">
								<div class="tags has-addons">
									<div class="tag is-dark">JS</div>
									<div class="tag is-black">Slick</div>
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
				let iframe = document.getElementById('<?= $section['title'] ?>');
				let iframeDocument = iframe.contentWindow.document;

				iframeDocument.open();

				<?php if (in_array('bootstrap', $section['css_libs'])): ?>
					iframeDocument.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">');
				<?php endif; ?>

				<?php if (in_array('slick', $section['css_libs'])): ?>
					iframeDocument.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">');
					iframeDocument.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">');
				<?php endif; ?>

				iframeDocument.write(`<style>html,body{margin:0;padding:0;}</style>`);
				iframeDocument.write(`<style><?= $css ?></style>`);
				iframeDocument.write(`<body><?= $html ?></body>`);

				<?php if (in_array('jquery', $section['js_libs'])): ?>
					iframeDocument.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"><\/script>');
				<?php endif; ?>

				<?php if (in_array('bootstrap', $section['js_libs'])): ?>
					iframeDocument.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"><\/script>');
					iframeDocument.write('<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"><\/script>');
				<?php endif; ?>

				<?php if (in_array('slick', $section['js_libs'])): ?>
					iframeDocument.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"><\/script>');
					iframeDocument.write('<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" crossorigin="anonymous"><\/script>');
				<?php endif; ?>

				iframeDocument.write(`<script><?= $js ?><\/script>`);
				iframeDocument.close();

				let contentHeight = iframeDocument.body.scrollHeight;
				let grow = setInterval(function() {
					if (iframeDocument.body.scrollHeight > contentHeight) {
						iframe.style.height = iframeDocument.body.scrollHeight + 'px';
						clearInterval(this);
					}
				}, 1000);
			</script>
			<?php
	}
}
?>

<footer class="footer has-text-centered">
	<?php the_author(); ?> | <?= the_date(); ?> &mdash; <?= the_modified_date(); ?>
</footer>
