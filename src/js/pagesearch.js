$(function() {
	$('.page-search .input').on('input', function() {
		const searchterm = $(this).val().toLowerCase();

		$('.page-search__results li').each(function() {
			$(this).toggleClass('match', $(this).text().toLowerCase().includes(searchterm));
		});
	});
})
