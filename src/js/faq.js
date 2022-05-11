$(function() {
	$('.card .card-header').on('click', function() {
		$(this).parents('.card').toggleClass('open');
	});
});
