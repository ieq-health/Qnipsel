<?php get_header(); ?>

<aside class="menu">
	<!-- Logo -->
	<div class="logo">
		<img src="/wp-content/themes/templateq/img/logo.svg" alt="Qnipsel">
	</div>

	<nav>
		<ul class="menu-list">
			<?php wp_list_pages(array('title_li' => null)); ?>
		</ul>
	</nav>
</aside>

<main>
	<?php if (have_posts()): ?>
		<?php while (have_posts()): the_post(); ?>
			<div class="container">
				<div class="content">
					<h1 class="title"><?php the_title(); ?></h1>
				</div>
			</div>

			<div class="container-fluid">
				<div class="columns">
					<div class="column">
						<p>Hier XML reinkopieren</p>
						<textarea class="textarea" name="" id="input" cols="30" rows="10"></textarea>
					</div>

					<div class="column">
						<p>Hier XML rauskopieren</p>
						<textarea class="textarea" name="" id="output" cols="30" rows="10" readonly></textarea>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</main>



<script>
	$(function() {
		$('#input').on('input propertychange', function() {
			let xml = $(this).val();

			xml = xml.replace(/.*<lastmod.*\n/g, '');
			xml = xml.replace(/.*<priority.*\n/g, '');

			xml = xml.replace(/.*<url.*\n.*gw_dental.*\n.*url>.*\n/g, '');
			xml = xml.replace(/.*<url.*\n.*dentallabor.*\n.*url>.*\n/g, '');

			$('#output').val(xml);
		});
	});
</script>