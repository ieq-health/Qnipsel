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

									<?= bulmaFormText(array(
										'label' => 'Lat',
										'name' => 'lat',
										'placeholder' => '51.933799'
									)) ?>

									<?= bulmaFormText(array(
										'label' => 'Lng',
										'name' => 'lng',
										'placeholder' => '7.655033'
									)) ?>

									<?= bulmaFormText(array(
										'label' => 'Zoom',
										'name' => 'zoom',
										'placeholder' => '16'
									)) ?>
								</div>

								<div class="column">
									<label class="label">Offset LG</label>

									<?= bulmaFormText(array(
										'label' => 'Lat',
										'name' => 'lat_offset',
										'placeholder' => '0'
									)) ?>

									<?= bulmaFormText(array(
										'label' => 'Lng',
										'name' => 'lng_offset',
										'placeholder' => '0'
									)) ?>

									<?= bulmaFormText(array(
										'label' => 'Zoom',
										'name' => 'zoom_offset',
										'placeholder' => '0'
									)) ?>

									<label class="checkbox">
										<input type="checkbox" class="checkbox" name="offset_visible">
										Anzeigen
									</label>
								</div>
							</div>

							<!-- Styles -->
							<div class="columns">
								<div class="column">
									<?= bulmaFormTextarea(array(
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

									<?= bulmaFormText(array(
										'label' => 'Marker URL',
										'name' => 'marker',
										'placeholder' => 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png'
									)) ?>

									<?= bulmaFormText(array(
										'label' => 'Marker Breite',
										'name' => 'marker_width',
										'placeholder' => '27'
									)) ?>

									<?= bulmaFormText(array(
										'label' => 'Marker Höhe',
										'name' => 'marker_height',
										'placeholder' => '43'
									)) ?>
								</div>

								<div class="column">
									<label class="label">Anker (%)</label>

									<?= bulmaFormText(array(
										'label' => 'X',
										'name' => 'anchorx',
										'placeholder' => '50'
									)) ?>

									<?= bulmaFormText(array(
										'label' => 'Y',
										'name' => 'anchory',
										'placeholder' => '27'
									)) ?>
								</div>

								<div class="column">
									<label class="label">Label</label>

									<?= bulmaFormText(array(
										'label' => 'Label Titel',
										'name' => 'title'
									)) ?>

									<?= bulmaFormText(array(
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

<script>
	$(function() {

		$('input, select, .field textarea').on('input propertychange', function() {
			let lat = $('input[name="lat"]').val();
			let lng = $('input[name="lng"]').val();
			let zoom = $('input[name="zoom"]').val();

			let lat_offset = lat * 1 + $('input[name="lat_offset"]').val() * 1;
			let lng_offset = lng * 1 + $('input[name="lng_offset"]').val() * 1;
			let zoom_offset = zoom * 1 + $('input[name="zoom_offset"]').val() * 1;

			let styles = $('textarea[name="styles"]').val() || '[]';

			let marker = $('input[name="marker"]').val();
			let marker_width = $('input[name="marker_width"]').val();
			let marker_height = $('input[name="marker_height"]').val();

			let title = $('input[name="title"]').val();
			let url = $('input[name="url"]').val();


			$('#output').val(`
<div id="map"></div>

<script>
const mq = window.matchMedia('screen and (min-width: 1200px)');

const mapLocation = {
	lat: ${lat},
	lng: ${lng},
	zoom: ${zoom},

	get offset() {
		return {
			lat: ${lat_offset},
			lng: ${lng_offset},
			zoom: ${zoom_offset}
		}
	}
};

function initMap() {
	const map = new google.maps.Map(document.getElementById('map'), {
		center: mq.matches ? mapLocation.offset : mapLocation,
		zoom: mq.matches ? mapLocation.offset.zoom : mapLocation.zoom,
		disableDefaultUI: true,
		styles: ${styles}
	});

	const image = {
		url: '${marker}',
		size: new google.maps.Size(${marker_width}, ${marker_height}),
		anchor: new google.maps.Point(${marker_width / 2}, ${marker_height})
	};

	const marker = new google.maps.Marker({
		position: mapLocation,
		map: map,
		title: '${title}',
		icon: image,
		url: '${url}'
	});

	google.maps.event.addListener(marker, "click", function() {
		window.open(this.url, "_blank");
	});

	window.addEventListener('resize', debounce(function() {
		map.setCenter(mq.matches ? mapLocation.offset : mapLocation)
		map.setZoom(mq.matches ? mapLocation.offset.zoom : mapLocation.zoom)
	}, 200, false));
}

function debounce(func, wait, immediate) {
	let timeout;
	return function() {
		const context = this;
		const args = arguments;
		const later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		const callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	}
}
<\/script>
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=***API KEY***&amp;callback=initMap&amp;libraries=places">
<\/script>`);
		});
	});
</script>

<script>
	let map;
	let marker;
	let icon;
	function initMap() {
		map = new google.maps.Map(document.getElementById('preview'), {
			center: {lat: 51.933799, lng: 7.655033},
			zoom: 16,
			disableDefaultUI: true,
			styles: []
		});

		icon = {
			url: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png",
			size: new google.maps.Size(27, 43),
			anchor: new google.maps.Point(13.5, 43),
		};

		marker = new google.maps.Marker({
			position: {lat: 51.933799, lng: 7.655033},
			map: map,
			icon: icon
		});
	}

	$(function() {

		/** set location */

		$('input[name="lat"], input[name="lng"], input[name="offset_visible"]').on('input propertychange', function() {
			let offset_visible = $('input[name="offset_visible"]').is(':checked');

			let lat = parseFloat($('input[name="lat"]').val()) || 51.933799;
			let lng = parseFloat($('input[name="lng"]').val()) || 7.655033;

			let lat_offset = parseFloat($('input[name="lat_offset"]').val()) || 0;
			let lng_offset = parseFloat($('input[name="lng_offset"]').val()) || 0;

			map.setCenter({
				lat: offset_visible ? lat_offset + lat : lat,
				lng: offset_visible ? lng_offset + lng : lng
			});

			marker.setOptions({
				position: {
					lat: lat,
					lng: lng
				}
			});
		});

		$('input[name="zoom"]').on('input propertychange', function() {
			let offset_visible = $('input[name="offset_visible"]').is(':checked');

			let zoom = parseFloat($('input[name="zoom"]').val()) || 16;
			let zoom_offset = parseFloat($('input[name="zoom_offset"]').val()) || 0;

			map.setZoom(offset_visible ? zoom_offset + zoom : zoom);
		});

		/** set style */

		$('textarea[name="styles"]').on('input propertychange', function() {
			let styles = JSON.parse($('textarea[name="styles"]').val()) || [];

			map.setOptions({
				styles: styles
			});
		});

		/** set marker icon */

		$('input[name="marker"]').on('input propertychange', function() {
			let url = $('input[name="marker"]').val() || 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png';

			icon.url = url;

			marker.setIcon(url);
		});

		/** set marker size */

		$('input[name="marker_width"], input[name="marker_height"], input[name="anchorx"], input[name="anchory"]').on('input propertychange', function() {
			let width = parseFloat($('input[name="marker_width"]').val()) || 27;
			let height = parseFloat($('input[name="marker_height"]').val()) || 43;
			let anchorx = parseFloat($('input[name="anchorx"]').val()) || 50;
			let anchory = parseFloat($('input[name="anchory"]').val()) || 100;

			icon.size = new google.maps.Size(width, height);
			icon.anchor = new google.maps.Point(width * (anchorx / 100), height * (anchory / 100));

			marker.setIcon(icon);
		});
	});
</script>

<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=***API KEY***&amp;callback=initMap&amp;libraries=places"></script>

<?php get_footer(); ?>
