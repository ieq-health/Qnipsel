<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()):
			while (have_posts()):
				the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="mmenu-generator" class="container-fluid xml-stripper">
					<div class="columns is-gapless">

						<!-- Input -->

						<div class="column">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Input</p>

								<?= fractalFormSelect([
									'label' => ['string' => 'Position'],
									'name' => 'position',
									'options' => [
										['label' => 'Oben',   'value' => 'position-top'],
										['label' => 'Rechts', 'value' => 'position-right'],
										['label' => 'Unten',  'value' => 'position-bottom'],
										['label' => 'Links',  'value' => 'position-left'],
									]]) ?>
								<?= fractalFormCheckbox(['label' => ['string' => 'Vor Seite'], 'name' => 'is-in-front']) ?>

								<?= fractalFormSelect([
									'label' => ['string' => 'Theme'],
									'name' => 'theme',
									'options' => [
										['label' => 'Hell',    'value' => 'theme-light'],
										['label' => 'Dunkel',  'value' => 'theme-dark'],
										['label' => 'Weiss',   'value' => 'theme-white'],
										['label' => 'Schwarz', 'value' => 'theme-black'],
									]]) ?>
								<?= fractalFormCheckbox(['label' => ['string' => 'Borders'], 'name' => 'has-borders']) ?>
								<?= fractalFormCheckbox(['label' => ['string' => 'Dimme Seite'], 'name' => 'is-dimmed']) ?>

								<p class="label">Schatten</p>
								<?= fractalFormCheckbox(['label' => ['string' => 'Page'], 'name' => 'has-shadow-page']) ?>
								<?= fractalFormCheckbox(['label' => ['string' => 'Panel'], 'name' => 'has-shadow-panel']) ?>

								<p class="label">Größe</p>
								<?= fractalFormCheckbox(['label' => ['string' => 'Fullscreen'], 'name' => 'is-fullscreen']) ?>
								<?= fractalFormCheckbox(['label' => ['string' => 'Seiten Volle Höhe'], 'name' => 'is-justified']) ?>

								<p class="label">Unterseiten</p>
								<?= fractalFormCheckbox(['label' => ['string' => 'Sliding Submenu'], 'name' => 'is-sliding']) ?>
								<?= fractalFormCheckbox(['label' => ['string' => 'Zeige Elternmenu'], 'name' => 'show-parent']) ?>
								<?= fractalFormCheckbox(['label' => ['string' => 'Zeige Unterseitencounter'], 'name' => 'show-counters']) ?>
							</div>
						</div>

						<!-- Demo -->

						<div class="column has-background-light">
							<iframe id="demo" style="height: 100%; width: 100%"></iframe>
						</div>

						<!-- Output -->

						<div class="column has-background-light">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Output</p>
								<?= fractalFormTextarea(
									[
										'label' => ['string' => 'JS', 'required' => false],
										'name' => 'output',
										'classes' => 'is-family-code faq-generator__output',
										'borderless' => true,
										'readonly' => true,
									]
								) ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</main>

	<?php get_footer(); ?>
