/**
 * Generate the output
 */

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

<script async="" defer="" src='https://maps.googleapis.com/maps/api/js?key=<IEQ-CMS function="InsertFirmendaten" param="Felder=googleapikey"></IEQ-CMS>&amp;callback=initMap&amp;libraries=places'></script>`);
	});
});

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

/**
 * Generate the preview
 */

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