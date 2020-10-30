<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="schemaorg-dentist" class="container-fluid xml-stripper">
					<div class="columns is-gapless">

						<!-- Input -->

						<div class="column">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Input</p>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Name der Praxis', 'required' => true ),
									'name' => 'name'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Alternativer Name', 'required' => false ),
									'name' => 'alternate_name'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Beschreibung der Praxis', 'required' => false ),
									'name' => 'description'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'URL des Logos', 'required' => true ),
									'name' => 'logo_url'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Telefon', 'required' => true ),
									'name' => 'tel'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Fax', 'required' => false ),
									'name' => 'fax'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'URL', 'required' => true ),
									'name' => 'url'
								)) ?>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'E-Mail', 'required' => false ),
									'name' => 'email'
								)) ?>

								<hr>

								<!-- Area served -->

								<p class="subtitle">Adresse</p>

								<div class="columns is-multiline">

									<div class="column is-full">
										<?= fractalFormText(array(
											'label' => array( 'string' => 'Straße', 'required' => true ),
											'name' => 'address_streetaddress'
										)) ?>
									</div>

									<div class="column is-one-quarter">
										<?= fractalFormText(array(
											'label' => array( 'string' => 'PLZ', 'required' => true ),
											'name' => 'address_postalcode'
										)) ?>
									</div>

									<div class="column is-three-quarters">
										<?= fractalFormText(array(
											'label' => array( 'string' => 'Stadt', 'required' => true ),
											'name' => 'address_locality'
										)) ?>
									</div>

									<div class="column is-full">
										<?= fractalFormText(array(
											'label' => array( 'string' => 'Land', 'required' => true ),
											'name' => 'address_country'
										)) ?>
									</div>

									<div class="column is-half">
										<?= fractalFormText(array(
											'label' => array( 'string' => 'Koordinaten Latitude', 'required' => true ),
											'name' => 'geo_lat'
										)) ?>
									</div>

									<div class="column is-half">
										<?= fractalFormText(array(
											'label' => array( 'string' => 'Koordinaten Longitude', 'required' => true ),
											'name' => 'geo_lng'
										)) ?>
									</div>
								</div>

								<hr>

								<!-- hasMap -->

								<p class="subtitle">Öffnungszeiten</p>


								<table id="opening-hours" class="table is-fullwidth is-bordered is-striped">
									<tbody></tbody>
								</table>

								<button name="add_opening-hours" class="button is-link"><?= templateq_icon_plus(); ?> &nbsp; Sprechzeiten hinzufügen</button>

								<hr>

								<?= fractalFormTextarea(array(
									'label' => array( 'string' => 'Weitere Seiten (eine URL pro Zeile)', 'required' => false ),
									'name' => 'sameAs'
								)) ?>
							</div>
						</div>

						<!-- Output -->

						<div class="column has-background-light">
							<div class="px-4 py-4">
									<p class="has-text-grey is-uppercase is-size-7">Output</p>
									<?= fractalFormTextarea(array(
										'label' => array( 'string' => 'JSON+LD', 'required' => false ),
										'name' => 'output',
										'classes' => 'is-family-code faq-generator__output',
										'borderless' => true,
										'readonly' => true
									)) ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>