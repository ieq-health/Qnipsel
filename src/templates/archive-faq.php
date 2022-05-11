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
				<div class="columns">
				<?php foreach (get_terms('faq_taxonomy') as $category): ?>
					<div class="column">
						<div class="content">
							<h3>
								<a href="<?= esc_url(get_term_link($category)) ?>"><?= $category->name ?></a>
							</h3>
							<p><?= $category->description ?></p>
						</div>
					</div>
				<?php endforeach; ?>
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

