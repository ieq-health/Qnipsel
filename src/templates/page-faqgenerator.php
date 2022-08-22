<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="application-json" class="container-fluid xml-stripper">
					<div class="columns is-gapless">

						<div class="column">
							<div class="px-4 py-4">
								<!-- FAQ List -->
								<div class="columns">
									<div class="column">
										<p class="subtitle">FAQs</p>

										<div class="field faq">
											<div class="faq__item">
												<div class="faq__item__content">
													<?= fractalFormText(array(
														'placeholder' => 'Frage',
														'name' => 'question',
														'classes' => 'faq_question',
													)); ?>
													<?= fractalFormText(array(
														'placeholder' => 'Antwort',
														'name' => 'answer',
														'classes' => 'faq_answer'
													)); ?>
												</div>
												<button class="button is-danger faq__item__delete">
													<?= templateq_icon_delete(); ?>
												</button>
											</div>
										</div>

										<button class="faq-add button is-outlined"><span class="icon is-small"><?= templateq_icon_plus(); ?></span><span>weitere hinzufügen</span></button>

										<button class="faq-generate button is-link"><span class="icon is-small"><?= templateq_icon_code(); ?></span><span>JSON generieren</span><aside class="copied-notification">kopiert</aside></button>
									</div>
								</div>
							</div>
						</div>
			
						<div class="column has-background-light">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Output</p>
								<textarea class="textarea is-family-code faq-generator__output" name="" id="output" cols="30" rows="10" readonly=""></textarea>
							</div>
						</div>

					</div>
				</div>

			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>
