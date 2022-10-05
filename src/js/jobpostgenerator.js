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
			let name = $('*[name="name"]').val();
			let street = $('*[name="street"]').val();
			let plz = $('*[name="plz"]').val();
			let place = $('*[name="place"]').val();
			let country = $('*[name="country"]').val();
			let industry = $('*[name="industry"]').val();
			let website = $('*[name="website"]').val();

			let jobtitle = $('*[name="jobtitle"]').val();
			let description = $('*[name="description"]').val();
			let employmenttype = $('*[name="employmenttype"]').val();
			let postdateDay = $('*[name="postdate-day"]').val();
			let postdateMonth = $('*[name="postdate-month"]').val();
			let postdateYear = $('*[name="postdate-year"]').val();
			let responsibilities = $('*[name="responsibilities"]').val();
			let skills = $('*[name="skills"]').val();
			let qualifications = $('*[name="qualifications"]').val();
			let educationrequirements = $('*[name="educationrequirements"]').val();
			let experiencerequirements = $('*[name="experiencerequirements"]').val();
			let jobbenefits = $('*[name="jobBenefits"]').val();

			// check for chrystals
			if (!(name
				&& street
				&& plz
				&& place
				&& industry
				&& website
				&& jobtitle
				&& description
				&& employmenttype)) {
					$("#output").val('Nicht alle Pflichtfelder ausgefüllt.');
					return;
			}

			$("#output").val(`
<script type="application/ld+json">
{
	"@context": "https://schema.org/",
	"@type": "JobPosting",
	"title": "${jobtitle}",
	"description": "${cleanJson( description )}",
	"hiringOrganization" : {
		"@type": "Organization",
		"name": "${name}",
		"sameAs": "${website}"
	},
	"industry": "${industry}",
	"employmentType": [${employmenttype.map(i => '"' + i + '"')}],
	"datePosted": "${postdateYear}-${postdateMonth}-${postdateDay}",
	"jobLocation": {
		"@type": "Place",
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "${street}",
			"addressLocality": "${place}",
			"postalCode": "${plz}",
			"addressCountry": "${country}"
		}
	},
	"responsibilities": "${cleanJson( responsibilities )}",
	"skills": "${cleanJson( skills )}",
	"qualifications": "${cleanJson( qualifications )}",
	"educationRequirements": "${cleanJson( educationrequirements )}",
	"experienceRequirements": "${cleanJson( experiencerequirements )}",
	"jobBenefits": "${cleanJson( jobbenefits )}"
}
<\/script>`);
		}
	);
});
