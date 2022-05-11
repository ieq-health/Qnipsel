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
				<div class="faq-list">
					<?php while (have_posts()): the_post(); ?>

					<div class="card">
						<div class="card-header">
							<p class="card-header-title">
								<?php the_title(); ?>
							</p>
							<span class="card-header-icon">
								<?= templateq_icon_arrow(); ?>
							</span>
						</div>
						<div class="card-content">
							<div class="content">
								<?php the_content(); ?>
							</div>
						</div>
					</div>

					<?php endwhile ?>
				</div>
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

