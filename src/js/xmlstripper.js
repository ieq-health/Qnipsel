$(function() {
	$('#xml-input').on('input propertychange', function() {
		let xml = $(this).val();

		xml = xml.replace(/.*<lastmod.*\n/g, '');
		xml = xml.replace(/.*<priority.*\n/g, '');

		xml = xml.replace(/.*<url.*\n.*gw_dental.*\n.*url>.*\n/g, '');
		xml = xml.replace(/.*<url.*\n.*gw_kfo.*\n.*url>.*\n/g, '');
		xml = xml.replace(/.*<url.*\n.*dentallabor.*\n.*url>.*\n/g, '');

		$('#output').val(xml);
	});
});