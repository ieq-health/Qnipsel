$(function() {

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
	  <button class="button is-danger">${icons.delete}</button>
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

		/** Create array from sameAs */
		let sameAs = values.sameAs ? values.sameAs.split('\n') : [];


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
			sameAs: sameAs
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
});
