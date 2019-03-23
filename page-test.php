<?php get_header(); ?>

<main>
	<?php wp_list_pages(array(
		'title_li' => null,
		'walker' => new Templateq_Walker()
	)); ?>
</main>