// Turn on Dennismode
$(function() {
	if (Cookies.get('dennisMode') == 'true') {
		$('body').addClass('dennisMode');
	}

	$('input[name="dennisMode"]').on('change', function() {
		Cookies.set('dennisMode', $(this).is(':checked'), { expires: 365 });

		if ($(this).is(':checked')) {
			$('body').addClass('dennisMode');
		} else {
			$('body').removeClass('dennisMode');
		}
	})
});