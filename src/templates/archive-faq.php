<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php get_template_part('partials/content', 'title'); ?>

			<div class="container">
				<dl>
					<?php while (have_posts()): the_post(); ?>

					<dt><?php the_title(); ?></dt>

					<dd><?php the_content(); ?></dd>

					<?php endwhile ?>
				</dl>
			</div>
		<?php endif; ?>
	</main>

	<aside id="sideMenu" class="menu">

	</aside>

<?php get_footer(); ?>

