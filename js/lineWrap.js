// Toggle line wrap
$(function() {
	if (Cookies.get('lineWrap') == 'true') {
		$('body').addClass('lineWrap');
		$('input[name="lineWrap"]').prop('checked', true);
	}

	$('input[name="lineWrap"]').on('change', function() {
		Cookies.set('lineWrap', $(this).is(':checked'), { expires: 365 });

		if ($(this).is(':checked')) {
			$('body').addClass('lineWrap');
		} else {
			$('body').removeClass('lineWrap');
		}
	})
});