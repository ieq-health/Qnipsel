<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<div class="container-fluid" style="margin-top:-4vw;margin-bottom:-3vw;">
					<div id="preview" style="width:100%;height:300px"></div>
				</div>

				<div class="container-fluid xml-stripper">
					<div class="columns">
						<div class="column">
							<p class="has-text-grey is-uppercase is-size-7">Input</p>

							<div class="columns">
								<div class="column">
									<label class="label">Location</label>

									<?= fractalFormText(array(
										'label' => 'Lat',
										'name' => 'lat',
										'placeholder' => '51.933799'
									)) ?>

									<?= fractalFormText(array(
										'label' => 'Lng',
										'name' => 'lng',
										'placeholder' => '7.655033'
									)) ?>

									<?= fractalFormText(array(
										'label' => 'Zoom',
										'name' => 'zoom',
										'placeholder' => '16'
									)) ?>
								</div>

								<div class="column">
									<label class="label">Offset LG</label>

									<?= fractalFormText(array(
										'label' => 'Lat',
										'name' => 'lat_offset',
										'placeholder' => '0'
									)) ?>

									<?= fractalFormText(array(
										'label' => 'Lng',
										'name' => 'lng_offset',
										'placeholder' => '0'
									)) ?>

									<?= fractalFormText(array(
										'label' => 'Zoom',
										'name' => 'zoom_offset',
										'placeholder' => '0'
									)) ?>

									<?= fractalFormCheckbox(array(
										'label' => 'Anzeigen',
										'name' => 'offset_visible'
									)) ?>
								</div>
							</div>

							<!-- Styles -->
							<div class="columns">
								<div class="column">
									<?= fractalFormTextarea(array(
										'label' => 'Styles',
										'name' => 'styles'
									)) ?>

									<p><a href="https://mapstyle.withgoogle.com/" target="_blank" rel="noopener">https://mapstyle.withgoogle.com</a></p>
								</div>
							</div>

							<!-- Marker -->
							<div class="columns">
								<div class="column">
									<label class="label">Marker</label>

									<?= fractalFormText(array(
										'label' => 'Marker URL',
										'name' => 'marker',
										'placeholder' => 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png'
									)) ?>

									<?= fractalFormText(array(
										'label' => 'Marker Breite',
										'name' => 'marker_width',
										'placeholder' => '27'
									)) ?>

									<?= fractalFormText(array(
										'label' => 'Marker Höhe',
										'name' => 'marker_height',
										'placeholder' => '43'
									)) ?>
								</div>

								<div class="column">
									<label class="label">Anker (%)</label>

									<?= fractalFormText(array(
										'label' => 'X',
										'name' => 'anchorx',
										'placeholder' => '50'
									)) ?>

									<?= fractalFormText(array(
										'label' => 'Y',
										'name' => 'anchory',
										'placeholder' => '27'
									)) ?>
								</div>

								<div class="column">
									<label class="label">Label</label>

									<?= fractalFormText(array(
										'label' => 'Label Titel',
										'name' => 'title'
									)) ?>

									<?= fractalFormText(array(
										'label' => 'Label URL',
										'name' => 'url'
									)) ?>
								</div>
							</div>
						</div>

						<div class="column has-background-light">
							<p class="has-text-grey is-uppercase is-size-7">Output</p>
							<textarea class="textarea is-family-code" name="" id="output" cols="30" rows="10" readonly></textarea>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php wp_enqueue_script('gmaps', 'https://maps.googleapis.com/maps/api/js?key=***API KEY***&amp;callback=initMap&amp;libraries=places', array('templateq_js'), '', true); ?>

<?php get_footer(); ?>
