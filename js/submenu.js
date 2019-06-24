$(function() {

	let naviObserver = new IntersectionObserver(function(object, observer) {
		let id = object[0].target.id;
		if (typeof id != 'undefined') {
			$('#nonDennisMenu a').removeClass('--active');
			$('a[href="#' + id + '"]').addClass('--active');
		}
	});

	document.querySelectorAll('main > .container').forEach(function(section) {
		naviObserver.observe(section);
	});

	$('.submenu a').on('click', function(event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top - $('nav.navbar').outerHeight()
		}, 1000);
	});
});