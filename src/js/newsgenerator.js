function makeSlug (string) {
	return string
		.toLowerCase()
		.replace(/\s+/g, '-')
		.replace(/ä/g, 'ae')
		.replace(/ö/g, 'oe')
		.replace(/ü/g, 'ue')
		.replace(/ß/g, 'ss')
		.replace(/[^-a-z0-9]+/g, '');
}

$(function() {
	const months = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
	
	const today = new Date();
	const month = today.getMonth() + 1;
	const year = today.getYear() + 1900;
	
	$('select[name="month"]').val((month < 10) ? '0' + month : month.toString());
	$('input[name="year"]').val(year);
	

	$('input, select, .field textarea').on('input propertychange', function() {
		let title = $('input[name="title"]').val();
		let month = {
			num: $('select[name="month"]').val(),
			string: months[$('select[name="month"]').val() - 1]
		};
		let year = $('input[name="year"]').val();
		let ymo = `${year.substr(-2)}${month.num}`;
		let text = $('textarea[name="text"]').val();
		// let land = $('input[name="land"]:checked').val();
		let gewerk = $('input[name="gewerk"]:checked').val();
		let slug = makeSlug(title);
		let newspath = `${ymo}-${slug}`;
		let link = `http:/scripts/show.aspx?content=/health/${gewerk}/news/${year}/${newspath}`;

		$('#output').val(`
${newspath}

${title}

<h3 class="news-heading"><span class="news-datum">${month.string} ${year}</span> <span class="dash">&ndash;</span> ${title}</h3>
<p class="news-text">${text} <a href="${link}" title="Gehe zu: News" class="news-link">Mehr »</a></p>
		`);
	});
});