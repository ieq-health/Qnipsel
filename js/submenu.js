$(function() {

	function activateNavitem (id) {
		document.querySelectorAll('.submenu a.--active').forEach(link => link.classList.remove('--active'));
		document.querySelector('[href="#' + id + '"]').classList.add('--active');
	}

	const naviObserver = new IntersectionObserver(entries => {
		if (entries[0].intersectionRatio <= 0) return;
		if (entries[0].intersectionRatio > 0.75) activateNavitem(entries[0].target.id);
	}, {
		threshold: [0, 0.5, 1],
		rootMargin: '45px 0px 0px 0px'
	})

	document.querySelectorAll('main > .container[id]').forEach(section => naviObserver.observe(section));

	$('.submenu a').on('click', function(event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top - $('nav.navbar').outerHeight()
		}, 1000);
	});
});