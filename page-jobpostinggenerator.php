<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="application-json" class="container-fluid xml-stripper">
					<div class="columns">

						<div class="column">
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

									<?= fractalFormText(array(
										'label' => array( 'string' => 'Veröffentlichungsdatum', 'required' => true),
										'name' => 'postdate',
										'placeholder' => '2020-01-31'
									)) ?>
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

						<div class="column has-background-light">
							<p class="has-text-grey is-uppercase is-size-7">Output</p>
							<textarea class="textarea is-family-code" name="" id="output" cols="30" rows="10" readonly=""></textarea>
						</div>

					</div>
				</div>

			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>