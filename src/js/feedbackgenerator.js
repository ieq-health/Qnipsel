$(function() {
	function cleanJson (value) {
		return value.replace(/[\r\n]/g, '\\n');
	}

	// automatically set postdate
	const today = new Date();
	const day = today.getDate();
	const month = today.getMonth() + 1;
	const year = today.getYear() + 1900;

	$('select[name="postdate-day"]').val((day < 10) ? '0' + day : day.toString()); 
	$('select[name="postdate-month"]').val((month < 10) ? '0' + month : month.toString());
	$('input[name="postdate-year"]').val(year);

	// generate output
	$("#application-json").on(
		"input propertychange",
		"input, select, .field textarea",
		function() {
			let name = encodeURIComponent($('*[name="name"]').val());
			let email = encodeURIComponent($('*[name="email"]').val());
			let website = encodeURIComponent($('*[name="website"]').val());
			let shopid = encodeURIComponent($('*[name="shopid"]').val());

			$("#output").val(`https://www.ieq-health.de/homepage-feedback?ihr-name=${name}&email=${email}&website=${website}&shopid=${shopid}`)
		}
	);
});
