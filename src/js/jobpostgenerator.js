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
		let postdate = $('*[name="postdate"]').val();
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
    "description": "${description}",
    "hiringOrganization" : {
      "@type": "Organization",
      "name": "${name}",
      "sameAs": "${website}"
    },
    "industry": "${industry}",
    "employmentType": "${employmenttype}",
    "datePosted": "${postdate}",
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
    "responsibilities": "${responsibilities}",
    "skills": "${skills}",
    "qualifications": "${qualifications}",
    "educationRequirements": "${educationrequirements}",
    "experienceRequirements": "${experiencerequirements}"
  }
<\/script>`);
	}
);
