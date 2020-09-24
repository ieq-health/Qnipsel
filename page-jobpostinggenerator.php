<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="application-json" class="container-fluid xml-stripper">
					<div class="columns is-gapless">

						<div class="column">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Input</p>

								<!-- Firmandaten -->
								<div class="columns">
									<div class="column">
										<p class="subtitle">Firmendaten</p>

										<?= fractalFormText(array(
											'label' => array( 'string' => 'Name', 'required' => true),
											'name' => 'name',
											'placeholder' => 'Firma GmbH'
										)) ?>

										<?= fractalFormText(array(
											'label' => array( 'string' => 'Straße', 'required' => true),
											'name' => 'street',
											'placeholder' => 'Straße'
										)) ?>

										<?= fractalFormText(array(
											'label' => array( 'string' => 'PLZ', 'required' => true),
											'name' => 'plz',
											'placeholder' => 'PLZ'
										)) ?>

										<?= fractalFormText(array(
											'label' => array( 'string' => 'Stadt', 'required' => true),
											'name' => 'place',
											'placeholder' => 'Musterstadt'
										)) ?>

										<?= fractalFormSelect(array(
											'label' => array( 'string' => 'Land', 'required' => true),
											'name'  => 'country',
											'options' => array(
												array('value' => 'DE', 'label' => 'Deutschland'),
												array('value' => 'AT', 'label' => 'Österreich'),
												array('value' => 'CH', 'label' => 'Schweiz'),
												array('value' => 'NL', 'label' => 'Niederlande'),
												array('value' => 'LU', 'label' => 'Luxemburg')
											)
										)) ?>

										<?= fractalFormText(array(
											'label' => array( 'string' => 'Industrie', 'required' => true),
											'name' => 'industry',
											'placeholder' => 'Zahnmedizin'
										)) ?>

										<?= fractalFormText(array(
											'label' => array( 'string' => 'Website', 'required' => true),
											'name' => 'website',
											'placeholder' => 'Website'
										)) ?>

								</div>

								<!-- Jobinfos -->
								<div class="column">
									<p class="subtitle">Stellenausschreibung</p>

									<?= fractalFormText(array(
										'label' => array( 'string' => 'Jobtitel', 'required' => true),
										'name' => 'jobtitle',
										'placeholder' => 'Zahnmedizinische Fachangestellte/r (m/w/d)'
									)) ?>

									<?= fractalFormTextarea(array(
										'label' => array( 'string' => 'Stellenbeschreibung', 'required' => true),
										'name' => 'description'
									)) ?>

									<?= fractalFormSelect(array(
										'label' => array( 'string' => 'Beschäftigung', 'required' => true),
										'name'  => 'employmenttype',
										'options' => array(
											array('value' => 'FULL_TIME', 'label' => 'Vollzeit'),
											array('value' => 'PART_TIME', 'label' => 'Teilzeit'),
											array('value' => 'TEMPORARY', 'label' => 'befristete Stelle'),
											array('value' => 'INTERN',    'label' => 'Praktikant'),
											array('value' => 'OTHER',     'label' => 'anderes Arbeitsverhältnis')
										)
									)) ?>

									<p class="label">Veröffentlichungsdatum</p>

									<div class="columns">
										<div class="column">
											<?= fractalFormSelect(array(
												'label' => array( 'string' => 'Tag', 'required' => true),
												'name' => 'postdate-day',
												'options' => array(
													array('value' => '01', 'label' => '01'),
													array('value' => '02', 'label' => '02'),
													array('value' => '03', 'label' => '03'),
													array('value' => '04', 'label' => '04'),
													array('value' => '05', 'label' => '05'),
													array('value' => '06', 'label' => '06'),
													array('value' => '07', 'label' => '07'),
													array('value' => '08', 'label' => '08'),
													array('value' => '09', 'label' => '09'),
													array('value' => '10', 'label' => '10'),
													array('value' => '11', 'label' => '11'),
													array('value' => '12', 'label' => '12'),
													array('value' => '13', 'label' => '13'),
													array('value' => '14', 'label' => '14'),
													array('value' => '15', 'label' => '15'),
													array('value' => '16', 'label' => '16'),
													array('value' => '17', 'label' => '17'),
													array('value' => '18', 'label' => '18'),
													array('value' => '19', 'label' => '19'),
													array('value' => '20', 'label' => '20'),
													array('value' => '21', 'label' => '21'),
													array('value' => '22', 'label' => '22'),
													array('value' => '23', 'label' => '23'),
													array('value' => '24', 'label' => '24'),
													array('value' => '25', 'label' => '25'),
													array('value' => '26', 'label' => '26'),
													array('value' => '27', 'label' => '27'),
													array('value' => '28', 'label' => '28'),
													array('value' => '29', 'label' => '29'),
													array('value' => '30', 'label' => '30'),
													array('value' => '31', 'label' => '31')
												)
											)) ?>
										</div>
										<div class="column">
											<?= fractalFormSelect(array(
												'label' => array( 'string' => 'Monat', 'required' => true),
												'name' => 'postdate-month',
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
													array('value' => '12', 'label' => 'Dezember')
												)
											)) ?>
										</div>
										<div class="column">
											<?= fractalFormText(array(
												'label' => array( 'string' => 'Jahr', 'required' => true),
												'name' => 'postdate-year',
												'placeholder' => date('Y'),
												'value' => date('Y')
											)) ?>
										</div>
									</div>
								</div>

								<div class="columns">
									<div class="column">
										<p class="subtitle">Optionale Informationen</p>

										<?= fractalFormTextarea(array(
											'label' => 'Verantwortlichkeiten',
											'name' => 'responsibilities',
										)) ?>

										<?= fractalFormTextarea(array(
											'label' => 'Skills',
											'name' => 'skills',
										)) ?>

										<?= fractalFormTextarea(array(
											'label' => 'Qualifikationen',
											'name' => 'qualifications',
										)) ?>

										<?= fractalFormTextarea(array(
											'label' => 'Schulische Voraussetzungen',
											'name' => 'educationrequirements',
										)) ?>

										<?= fractalFormTextarea(array(
											'label' => 'Arbeitserfahrung Anforderungen',
											'name' => 'experiencerequirements',
										)) ?>
									</div>
								</div>
							</div>
						</div>

						<div class="column has-background-light">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Output</p>
								<textarea class="textarea is-family-code" name="" id="output" cols="30" rows="10" readonly=""></textarea>
							</div>
						</div>

					</div>
				</div>

			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>