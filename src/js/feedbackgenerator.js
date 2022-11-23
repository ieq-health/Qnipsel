$(function() {
	// generate output
	$("#feedbackgenerator").on(
		"input propertychange",
		"input, select, .field textarea",
		function() {
			let name = encodeURIComponent($('*[name="ihr-name"]').val());
			let email = encodeURIComponent($('*[name="email"]').val());
			let website = encodeURIComponent($('*[name="website"]').val());
			let shopid = encodeURIComponent($('*[name="shopid"]').val());

			$("#output").val(`https://www.ieq-health.de/homepage-feedback?ihr-name=${name}&email=${email}&website=${website}&shopid=${shopid}`)
		}
	);
});
