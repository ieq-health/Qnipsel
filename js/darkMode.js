// Turn on Darkmode
$(function() {
	if (Cookies.get('darkMode') == 'true') {
		$('body').addClass('darkMode');
		$('input[name="darkMode"]').prop('checked', true);
	}

	$('input[name="darkMode"]').on('change', function() {
		Cookies.set('darkMode', $(this).is(':checked'), { expires: 365 });

		if ($(this).is(':checked')) {
			$('body').addClass('darkMode');
		} else {
			$('body').removeClass('darkMode');
		}
	})
});