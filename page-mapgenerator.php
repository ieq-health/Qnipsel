<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div class="container-fluid xml-stripper">
					<div class="columns">
						<div class="column">
							<p class="has-text-grey is-uppercase is-size-7">Input</p>

							<div class="columns">
								<div class="column">
									<label class="label">Location</label>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Lat</button></p>
										<div class="control">
											<input name="lat" type="text" class="input" placeholder="Latitude">
										</div>
									</div>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Lng</button></p>
										<div class="control">
											<input name="lng" type="text" class="input" placeholder="Longitude">
										</div>
									</div>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Zoom</button></p>
										<div class="control">
											<input name="zoom" type="text" class="input" placeholder="Zoom">
										</div>
									</div>
								</div>

								<div class="column">
									<label class="label">Offset LG</label>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Lat</button></p>
										<div class="control">
											<input name="lat_offset" value="0" type="text" class="input" placeholder="Latitude">
										</div>
									</div>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Lng</button></p>
										<div class="control">
											<input name="lng_offset" value="0" type="text" class="input" placeholder="Longitude">
										</div>
									</div>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Zoom</button></p>
										<div class="control">
											<input name="zoom_offset" type="text" class="input" placeholder="Zoom">
										</div>
									</div>
								</div>
							</div>

							<!-- Styles -->
							<div class="columns">
								<div class="column">
									<div class="field">
										<label class="label">Styles</label>

										<div class="control">
											<textarea name="styles" class="textarea has-border"></textarea>
										</div>
									</div>
								</div>
							</div>

							<!-- Marker -->
							<div class="columns">
								<div class="column">
									<label class="label">Marker</label>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Marker URL</button></p>
										<div class="control"><input class="input" type="text" name="marker"></div>
									</div>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Marker Breite</button></p>
										<div class="control"><input class="input" type="text" name="marker_width"></div>
									</div>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Marker Höhe</button></p>
										<div class="control"><input class="input" type="text" name="marker_height"></div>
									</div>
								</div>

								<div class="column">
									<label class="label">Label</label>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Label Titel</button></p>
										<div class="control"><input class="input" type="text" name="title"></div>
									</div>

									<div class="field has-addons">
										<p class="control"><button class="button is-static">Label URL</button></p>
										<div class="control"><input class="input" type="text" name="url"></div>
									</div>
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

	function initMap() {
		map = new google.maps.Map(document.getElementById('preview'), {
			center: {lat: 51.933799, lng: 7.655033},
			zoom: 16,
			disableDefaultUI: true,
			styles: []
		});
	}

	$(function() {
		$('input[name="lat"], input[name="lng"]').on('input propertychange', function() {
			let lat = parseFloat($('input[name="lat"]').val());
			let lng = parseFloat($('input[name="lng"]').val());

			map.setCenter({lat: lat, lng: lng});
		});

		$('input[name="zoom"]').on('input propertychange', function() {
			let lng = parseFloat($('input[name="zoom"]').val());

			map.setZoom(zoom);
		});

		$('textarea[name="styles"]').on('input propertychange', function() {
			let styles = JSON.parse($('textarea[name="styles"]').val());

			map.setOptions({styles: styles});
		});
	});
</script>

<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=***API KEY***&amp;callback=initMap&amp;libraries=places"></script>

<?php get_footer(); ?>
