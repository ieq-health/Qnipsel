$(function() {
	$('.submenu a').on('click', function(event) {
		event.preventDefault();
											
		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top - $('nav.navbar').outerHeight()
		}, 1000);
	});
});