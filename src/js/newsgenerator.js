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

const months = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];

const today = new Date();
const month = today.getMonth() + 1;
const year = today.getYear() + 1900;

$('select[name="month"]').val((month < 10) ? '0' + month : month.toString());
$('input[name="year"]').val(year);


$('#newsgenerator').on('input propertychange', 'input, select, .field textarea', function() {

	/** Get title */
	let title = $('input[name="title"]').val();
	let slug = makeSlug(title);

	/** Get date */
	let month = {
		num: $('select[name="month"]').val(),
		string: months[$('select[name="month"]').val() - 1]
	};
	let year = $('input[name="year"]').val();
	let ymo = `${year.substr(-2)}${month.num}`;

	/** Get text content */
	let text = $('textarea[name="text"]').val();

	/** Get Gewerk */
	let gewerk = $('select[name="gewerk"]').val();

	/** Get teaser image */
	let imgInput = $('input[name="image"]').val();
	let imgUrl = '';
	let imgTag = '';

	if (imgInput !== '') {
		imgUrl = `http:/scripts/get.aspx?media=${imgInput}`;
		imgTag = `<div class="news-img" style="display:none;"><img class="img-responsive" src="${imgUrl}" alt="${title}"></div>`;
	}

	/** Combine date and slug to create the shortname */
	let shortname = `${ymo}-${slug}`;
	let link = `http:/scripts/show.aspx?content=/health/${gewerk}/news/${year}/${shortname}`;


	/** Generate output path */
	$('[name="outputShortName"]').val(shortname);

	/** Generate output title */
	let titleTag = `${month.string} ${year} &ndash; ${title}`;
	$('[name="outputTitle"]').val(titleTag);

	/** Generate output text */

	$('[name="outputText"]').val(`${imgTag} 
<h3 class="news-heading"><span class="news-datum">${month.string} ${year}</span> <span class="dash">&ndash;</span> ${title}</h3>
<p class="news-text">${text} <a href="${link}" title="Gehe zu: News" class="news-link">Mehr »</a></p>
	`);
});