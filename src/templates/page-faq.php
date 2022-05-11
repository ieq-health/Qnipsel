<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div class="container">
					<dl>

					<?php
						/** Loop through the FAQ posts */
						$loop = new WP_Query(array(
							'post_type' => 'faq'
						));
						while ($loop->have_posts()): $loop->the_post();
						?>

						<dt><?php the_title(); ?></dt>

						<dd><?php the_content(); ?></dd>

						<?php endwhile; wp_reset_postdata(); ?>
					</dl>
				</div>

			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>

