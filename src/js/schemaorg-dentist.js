/** Create opening hours table */

$('[name="add_opening-hours"]').on("click", function () {
	let newline = $(`
  <tr>
    <td>
      <div class="select">
        <select>
          <option value="Monday">Montag</option>
          <option value="Tuesday">Dienstag</option>
          <option value="Wednesday">Mittwoch</option>
          <option value="Thursday">Donnerstag</option>
          <option value="Friday">Freitag</option>
          <option value="Saturday">Samstag</option>
        </select>
      </div>
    </td>
    <td>
      <input class="input" type="text" name="opening">
    </td>
    <td>
      <input class="input" type="text" name="closing">
    </td>
    <td>
      <button class="button is-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z"/></svg></button>
    </td>
  </tr>
  `);

	$("button", newline).on("click", function () {
		newline.remove();
	});

	$("#opening-hours tbody").append(newline);
});

function updateOutput() {
	/** Get input values */
	let values = {};

	$("#schemaorg-dentist input, #schemaorg-dentist textarea").each(
		function () {
			values[$(this).attr("name")] = $(this).val();
		}
	);

	/** Create opening hours object */
	let openingHours = [];

	$("#opening-hours tr").each(function () {
		openingHours.push({
			"@type": "OpeningHoursSpecification",
			dayOfWeek: $("select", this).val(),
			opens: $("[name='opening']", this).val(),
			closes: $("[name='closing']", this).val(),
		});
	});

	/** Create output object */
	let output = {
		"@context": "https://schema.org",
		"@type": "Dentist",
		name: values.name,
		alternateName: values.alternate_name,
		description: values.description,
		image: values.logo_url,
		telePhone: values.tel,
		faxNumber: values.fax,
		url: values.url,
		email: values.email,
		address: {
			"@type": "PostalAddress",
			streetAddress: values.address_streetaddress,
			addressLocality: values.address_locality,
			postalCode: values.address_postalcode,
			addressCountry: values.address_country,
		},
		geo: {
			"@type": "GeoCoordinates",
			latitude: values.geo_lat,
			longitude: values.geo_lng,
		},
		openingHoursSpecification: openingHours,
		sameAs: values.sameAs.split("\n"),
	};

	/** Remove empty props from output */
	for (let key in output) {
		if (
			output[key] === "" ||
			(typeof output[key] === "object" &&
				Object.keys(output[key]).length === 0)
		) {
			delete output[key];
		}
	}

	$('[name="output"]').val(`
<script type="application/ld+json">
  ${JSON.stringify(output, null, 2)}
</script>
  `);
}

$("#schemaorg-dentist").on("input", "input, .field textarea", updateOutput);
$("#schemaorg-dentist").on("change", "select", updateOutput);

const openingHourObserver = new MutationObserver(updateOutput);
openingHourObserver.observe($("#schemaorg-dentist tbody")[0], {
	attributes: false,
	childList: true,
	subtree: false,
});
