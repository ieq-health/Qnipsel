$(function() {
	$('.codeview__code').each(function() {
		let $tabs = $(this).find('.tabs a');
		let $tabcontents = $(this).find('.tab-content > div');

		$tabs.on('click', function(e) {
			let $target = $($(this).attr('href'));

			$tabs.parent('li').removeClass('is-active');
			$tabcontents.removeClass('is-active');

			$(this).parent('li').addClass('is-active');
			$target.addClass('is-active');

			e.preventDefault();
		});


		// Resizable
		let startY, startHeight;
		let $dragHandle = $(this).find('.resizer');
		let $preview = $(this).find('div[id$="-preview"]');
		let $iframe = $preview.find('iframe');

		$dragHandle.on('mousedown', initDrag);

		function initDrag(e) {
			startY = e.clientY;
			startHeight = parseInt($preview.height());
			$iframe.css('pointer-events', 'none');
			$(document).on('mousemove', doDrag);
			$(document).on('mouseup', stopDrag);
		}

		function doDrag(e) {
			$preview.height(startHeight + e.clientY - startY);
		}

		function stopDrag(e) {
			$iframe.css('pointer-events', 'all');
			$(document).off('mousemove');
		}


		// Responsive control
		let $responsiveButtons = $(this).find('.responsiveControl button');

		function responsiveView(size) {
			if (size === 'full') {
				$iframe.css('width', '100%');
			} else {
				$iframe.css('width', `${size}px`);
			}
		}

		$responsiveButtons.on('click', function() { responsiveView($(this).val()) });
	});
});
