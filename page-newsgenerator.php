<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="newsgenerator" class="container-fluid xml-stripper">
					<div class="columns">
						<div class="column">
							<p class="has-text-grey is-uppercase is-size-7">Input</p>

							<div class="columns">

								<!-- Gewerk -->

								<div class="column">
									<?= fractalFormSelect(array(
										'label' => array( 'string' => 'Gewerk', 'required' => true ),
										'name' => 'gewerk',
										'options' => array(
											array('value' => 'dental', 'label' => 'Dental'),
											array('value' => 'kfo',    'label' => 'KFO')
										)
									)) ?>
								</div>

								<!-- Monat -->

								<div class="column">
									<?= fractalFormSelect(array(
										'label' => array( 'string' => 'Monat', 'required' => true ),
										'name' => 'month',
										'options' => array(
											array('value' => '01', 'label' => 'Januar'),
											array('value' => '02', 'label' => 'Februar'),
											array('value' => '03', 'label' => 'März'),
											array('value' => '04', 'label' => 'April'),
											array('value' => '05', 'label' => 'Mai'),
											array('value' => '06', 'label' => 'Juni'),
											array('value' => '07', 'label' => 'Juli'),
											array('value' => '08', 'label' => 'August'),
											array('value' => '09', 'label' => 'September'),
											array('value' => '10', 'label' => 'Oktober'),
											array('value' => '11', 'label' => 'November'),
											array('value' => '12', 'label' => 'Dezember'),
										)
									)) ?>
								</div>

								<!-- Jahr -->

								<div class="column">
									<?= fractalFormText(array(
										'label' => array( 'string' => 'Jahr', 'required' => true ),
										'name' => 'year'
									)) ?>
								</div>
							</div>

							<!-- Titel -->

							<?= fractalFormText(array(
								'label' => array( 'string' => 'Titel', 'required' => true ),
								'name' => 'title'
							)) ?>

							<!-- Teaser -->

							<?= fractalFormTextarea(array(
								'label' => array( 'string' => 'Text', 'required' => true ),
								'name' => 'text'
							)) ?>

							<!-- Image -->

							<?= fractalFormText(array(
								'label' => array( 'string' => 'Teaserbild', 'required' => false ),
								'name' => 'image'
							)) ?>

						</div>

						<div class="column has-background-light">
							<p class="has-text-grey is-uppercase is-size-7">Output</p>

							<?= fractalFormText(array(
								'label' => array( 'string' => 'Kurzname' ),
								'name' => 'outputShortName',
								'readonly' => true
							)) ?>

							<?= fractalFormText(array(
								'label' => array( 'string' => 'Titel' ),
								'name' => 'outputTitle',
								'readonly' => true
							)) ?>

							<?= fractalFormTextarea(array(
								'label' => array( 'string' => 'Kurzfassung' ),
								'name' => 'outputText',
								'readonly' => true
							)) ?>

						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>