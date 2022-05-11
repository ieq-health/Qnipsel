<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<div class="container">
				<div class="content">
					<h1 class="title">FAQ</h1>
				</div>
			</div>

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
		<nav>
			<ul class="menu-list">
				<?php foreach (get_terms('faq_taxonomy') as $category): ?>
				<li>
					<a href="<?= esc_url(get_term_link($category)) ?>"><?= $category->name ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</aside>

<?php get_footer(); ?>

