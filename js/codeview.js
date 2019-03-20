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

		$dragHandle.on('mousedown', initDrag);

		function initDrag(e) {
			startY = e.clientY;
			startHeight = parseInt($preview.height());
			$dragHandle.on('mousemove', doDrag);
			$dragHandle.on('mouseup', stopDrag);
		}

		function doDrag(e) {
			$preview.height(startHeight + e.clientY - startY);
		}

		function stopDrag(e) {
			$dragHandle.off('mousemove');
		}
	});
});
