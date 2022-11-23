<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="feedbackgenerator" class="container-fluid xml-stripper">
					<div class="columns is-gapless">

						<div class="column">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Vordruck</p>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Name', 'required' => true),
									'name' => 'ihr-name',
									'placeholder' => 'Max Mustermann'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'E-Mail', 'required' => true),
									'name' => 'email',
									'placeholder' => 'max.mustermann@email.de'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Webseite', 'required' => true),
									'name' => 'website',
									'placeholder' => 'https://www.dr-mustermann.de'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Shop-ID', 'required' => true),
									'name' => 'shopid',
									'placeholder' => '50010123'
								)) ?>
							</div>
						</div> <!-- // column -->

						<div class="column has-background-light">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Output</p>
								<textarea class="textarea is-family-code" name="" id="output" cols="30" rows="10" readonly=""></textarea>
							</div>
						</div>

					</div> <!-- // columns -->
				</div> <!-- application -->

			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>
