$(function() {
	function qNotification (content, state = 'primary', persistent = false) {
		// Check if the state is valid, otherwise set to primary
		state = [
			'primary',
			'link',
			'info',
			'success',
			'warning',
			'danger'
		].includes(state) ? state : 'primary'; 


		// Create notification element
		const $closeButton = $('<button class="delete"></button>');
		const $wrapper = $(`<div class="qNotification notification is-${state}"></div>`)

		$wrapper.text(content);
		$wrapper.prepend($closeButton);


		// Manual closing
		$closeButton.on('click', () => $wrapper.remove());

		// Timeout
		if (!persistent) {
			window.setTimeout(() => $wrapper.remove(), 3000);
		}

		// Append the notification to the body
		$('body').append($wrapper);
	}

	window.qNotification = qNotification;
});
