<?php get_header(); ?>

<aside class="menu">
    <!-- Logo -->
    <div class="logo">
	<img src="/wp-content/themes/templateq/img/logo.svg" alt="Qnipsel">
    </div>

    <nav>
	<ul class="menu-list">
	    <?php
	    wp_list_pages(array(
		'title_li' => null
	    ));
	    ?>
	</ul>
    </nav>
</aside>

<main>
    <?php
    if (have_posts()) {
	while (have_posts()) {
	    the_post();
	    get_template_part('content', get_post_format());
	}
    }
    ?>
</main>
