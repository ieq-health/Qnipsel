<?php get_header(); ?>

<?php if (have_posts()) {
	while (have_posts()) {
		the_post();
		get_template_part('content', get_post_format());
	}
} else { ?>
<div id="site-container">
	<main>
		<div class="container">
			<div class="content">
				<h1 class="title">Letzte Updates</h1>
			</div>
		</div>
		<div class="container">
			<div class="columns">
				<div class="column">
					<?= templateq_recent_updates(); ?>
				</div>
			</div>
		</div>
	</main>
<?php } ?>

<?php get_footer(); ?>
