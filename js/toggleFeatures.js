const toggleFeature = (feature, enabled, setCookie = false) => {
	$('body').toggleClass(feature, enabled);
	$(`input[name="${feature}"]`).prop('checked', enabled);

	if (setCookie) {
		Cookies.set(feature, enabled, { expires: 365 });
	}
};

['darkMode', 'lineWrap'].forEach((feature) => {
	toggleFeature(feature, JSON.parse(Cookies.get(feature) || false));

	// toggle feature with toggler
	$(`input[name="${feature}"]`).on('change', () => {
		toggleFeature(feature, $(event.target).is(':checked'), true);
	});
});
