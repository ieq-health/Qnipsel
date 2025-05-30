<?php

function templateq_codeview_block($title, $html, $css, $css_libs, $js, $js_libs)
{
	$js_inject = preg_replace('/\s+/', ' ', $js);
	$js_inject = str_replace('"', '\"', $js_inject);
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
				<?php if (in_array('bootstrap', $css_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">CSS</div>
							<div class="tag is-black">Bootstrap</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('fa5', $css_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">CSS</div>
							<div class="tag is-black">FA5</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('mmenu', $css_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">CSS</div>
							<div class="tag is-black">mmenu</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('slick', $css_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">CSS</div>
							<div class="tag is-black">Slick</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('swiper', $css_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">CSS</div>
							<div class="tag is-black">Swiper</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('bootstrap', $js_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">JS</div>
							<div class="tag is-black">Bootstrap</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('jquery', $js_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">JS</div>
							<div class="tag is-black">jQuery</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('mmenu', $js_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">JS</div>
							<div class="tag is-black">mmenu</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('slick', $js_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">JS</div>
							<div class="tag is-black">Slick</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (in_array('swiper', $js_libs)) : ?>
					<div class="control">
						<div class="tags has-addons">
							<div class="tag is-dark">JS</div>
							<div class="tag is-black">Swiper</div>
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
				<div class="framewrapper">
					<iframe id="<?= $title ?>" class="codeview__preview-frame" data-simplebar></iframe>
					<div class="resizer"></div>
				</div>
				<div class="responsiveControl">
					<div class="buttons has-addons is-centered">
						<button class="button" value="360">360px</button>
						<button class="button" value="576">576px</button>
						<button class="button" value="768">768px</button>
						<button class="button" value="992">992px</button>
						<button class="button" value="1200">1200px</button>
					</div>
				</div>
			</div>
			<div id="<?= $title ?>-html">
				<?= templateq_code_block('html', $html); ?>
			</div>
			<div id="<?= $title ?>-css">
				<?= templateq_code_block('css', $css); ?>
			</div>
			<div id="<?= $title ?>-js">
				<?= templateq_code_block('javascript', $js); ?>
			</div>                   
		</div>
	</div>

	<script>
		(function() {
			let iframe = document.getElementById('<?= $title ?>');
			let iframeDocument = iframe.contentWindow.document;

			iframeDocument.open();

			<?php if (in_array('bootstrap', $css_libs)) : ?>
				iframeDocument.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">');
			<?php endif; ?>

			<?php if (in_array('fa5', $css_libs)) : ?>
				iframeDocument.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">');
			<?php endif; ?>

			<?php if (in_array('mmenu', $css_libs)) : ?>
				iframeDocument.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.3.3/jquery.mmenu.all.css">');
			<?php endif; ?>

			<?php if (in_array('swiper', $css_libs)) : ?>
				iframeDocument.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu.all.css">');
			<?php endif; ?>

			<?php if (in_array('slick', $css_libs)) : ?>
				iframeDocument.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">');
				iframeDocument.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">');
			<?php endif; ?>

			<?php if (in_array('swiper', $css_libs)) : ?>
				iframeDocument.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@5.4.5/css/swiper.min.css">');
			<?php endif; ?>

			iframeDocument.write(`<style>html,body{margin:0;padding:0;}</style>`);
			iframeDocument.write(`<style><?= $css ?></style>`);
			iframeDocument.write(`<body><?= $html ?></body>`);

			<?php if (in_array('jquery', $js_libs)) : ?>
				iframeDocument.write('<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"><\/script>');
			<?php endif; ?>

			<?php if (in_array('mmenu', $js_libs)) : ?>
				iframeDocument.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.3.3/jquery.mmenu.all.js" crossorigin="anonymous"><\/script>');
			<?php endif; ?>

			<?php if (in_array('bootstrap', $js_libs)) : ?>
				iframeDocument.write('<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"><\/script>');
				iframeDocument.write('<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"><\/script>');
			<?php endif; ?>

			<?php if (in_array('slick', $js_libs)) : ?>
				iframeDocument.write('<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"><\/script>');
				iframeDocument.write('<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" crossorigin="anonymous"><\/script>');
			<?php endif; ?>

			<?php if (in_array('swiper', $js_libs)) : ?>
				iframeDocument.write('<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"><\/script>');
				iframeDocument.write('<script src="https://cdn.jsdelivr.net/npm/swiper@5.4.5/js/swiper.min.js" crossorigin="anonymous"><\/script>');
			<?php endif; ?>

			iframeDocument.write("<script><?= trim($js_inject) ?><\/script>");
			iframeDocument.close();
		})();

/**
		let contentHeight = iframeDocument.body.scrollHeight;
		let grow = setInterval(function() {
			if (iframeDocument.body.scrollHeight > contentHeight) {
				iframe.style.height = iframeDocument.body.scrollHeight + 'px';
				clearInterval(this);
			}
		}, 1000);
*/
	</script>
<?php }
