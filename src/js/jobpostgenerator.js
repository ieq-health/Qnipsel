function cleanJson (value) {
  return value.replace(/[\r\n]/g, '\n')
}

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
    "employmentType": "${employmenttype}",
    "datePosted": "${postdateYear}-${postdateMonth}-${postdateDay}",
    "jobLocation": {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "${street}",
        "addressLocality": "${place}",
        "postalCode": "${plz}",
        "addressRegion": "${country}"
      }
    },
    "responsibilities": "${cleanJson( responsibilities )}",
    "skills": "${cleanJson( skills )}",
    "qualifications": "${cleanJson( qualifications )}",
    "educationRequirements": "${cleanJson( educationrequirements )}",
    "experienceRequirements": "${cleanJson( experiencerequirements )}"
  }
<\/script>`);
	}
);
