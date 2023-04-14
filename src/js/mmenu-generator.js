$(function () {
	/* Create Demo */
	const demo = document.getElementById('demo').contentWindow;
	demo.document.write(`
	<html>
		<head>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.3.3/jquery.mmenu.all.css">
		</head>
		<body style="background:white">
			<a href="#menu">Menu</a>
			<div id="orig-menu">
				<ul>
					<li>
						<a href="#">Link</a>
						<ul>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Link</a>
						<ul>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Link</a>
						<ul>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Link</a>
						<ul>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Link</a>
						<ul>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"><\/script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.3.3/jquery.mmenu.all.js"><\/script>
			<script>
				updateMenu();
				function updateMenu(opts) {
					$('html').removeAttr('class');
					/* Copy menu */
					$('#menu').remove();
					$('#orig-menu').hide();
					$('#orig-menu').clone().attr('id', 'menu').show().appendTo('body');
					const $mmenu = $('#menu').mmenu(opts);
					$mmenu.data('mmenu').open();
				}
			<\/script>
		</body>
	</html>
	`)
		// const demo = $("#demo");
		// const orig = $("#orig-menu", demo);
		// $("#menu", demo).remove();
		// orig.hide();
		// const menu = orig.clone().attr("id", "menu").show().appendTo(demo);



	function updateOutput() {
		/** Get input values */
		let values = {};

		$("#mmenu-generator input, #mmenu-generator textarea").each(
			function () {
				values[$(this).attr("name")] = $(this).val();
			}
		);

		let extensions = ['multiline'];
		let options = {};

		extensions.push($("#mmenu-generator select[name='position']").val());
		if ($("#mmenu-generator #is-in-front").is(":checked")) {
			extensions.push("position-front");
		}

		extensions.push($("#mmenu-generator select[name='theme']").val());

		if ($("#mmenu-generator #is-fullscreen").is(":checked")) {
			extensions.push("fullscreen");
		}

		if ($("#mmenu-generator #has-shadow-page").is(":checked")) {
			extensions.push("shadow-page");
		}

		if ($("#mmenu-generator #has-shadow-panel").is(":checked")) {
			extensions.push("shadow-panels");
		}

		if ($("#mmenu-generator #has-borders").is(":checked")) {
			extensions.push("border-full");
		} else {
			extensions.push("border-none");
		}

		if ($("#mmenu-generator #is-justified").is(":checked")) {
			extensions.push("listview-justify");
		}

		if ($("#mmenu-generator #is-dimmed").is(":checked")) {
			extensions.push("pagedim-black");
		}


		if ($("#mmenu-generator #is-sliding").is(":checked")) {
			options["slidingSubmenus"] = true;
		} else {
			options["slidingSubmenus"] = false;
		}

		if ($("#mmenu-generator #show-parent").is(":checked")) {
			options["iconPanels"] = true;
		} else {
			options["iconPanels"] = false;
		}

		if ($("#mmenu-generator #show-counters").is(":checked")) {
			options["counters"] = true;
		} else {
			options["counters"] = false;
		}

		// Show logo instead of title
		let navTitle = "Navigation";
		let navHeight = 1;
		if ($("#mmenu-generator #show-logo").is(":checked")) {
			let logoURL = $("#mmenu-generator input[name='logo-url']").val();
			navTitle = `<img style='max-height:100%' src='${logoURL}'>`
			navHeight = 2
		}

		/** Create output object */
		let output = {
			...{
				extensions: extensions,
				navbar: { title: navTitle},
				navbars: [
					{
						position: "top",
						height: navHeight,
						content: ["prev", "title", "close"]
					},
					{
						position: "bottom",
						content: [
							"<a class='fa fas fa-map-marker fa-map-marker-alt' href='http:/scripts/show.aspx?content=/health/dental/kontakt'></a>",
							"<a class='fa fas fa-phone' href='tel:'></a>",
							"<a class='fa fas fa-calendar fa-calendar-alt' href='http:/scripts/yaHRSKalender.aspx'></a>",
						],
					},
				],
				onClick: { close: true },
			},
			...options,
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
  $(function() {
    $("#menu").mmenu(${JSON.stringify(output, null, 2)});
  });
  `);

		/* Update demo */
		demo.updateMenu(output);
		// menu.mmenu({...output, offCanvas: false});
	}

	$("#mmenu-generator").on("input", "input, .field textarea", updateOutput);
	$("#mmenu-generator").on("change", "select", updateOutput);
});
