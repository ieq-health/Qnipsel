<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<div class="container">
					<div class="content">
						<h1 class="title"><?php the_title(); ?></h1>
					</div>
				</div>

				<div class="container-fluid xml-stripper">
					<div class="columns">
						<div class="column">
							<p class="has-text-grey is-uppercase is-size-7">Input</p>

							<div class="columns">

								<!-- Gewerk -->

								<div class="column">
									<label class="label">Gewerk</label>
									<div class="field is-grouped">
										<div class="control">
											<label class="radio">
												<input type="radio" id="dental" name="gewerk" value="dental" checked> Dental
											</label>
											<label class="radio">
												<input type="radio" id="dental" name="gewerk" value="kfo"> KFO
											</label>
										</div>
									</div>
								</div>

								<!-- Land -->

								<div class="column">
									<label class="label">Land</label>
									<div class="field is-grouped">
										<div class="control">
											<label class="radio">
												<input type="radio" id="de" name="land" value="dental" checked> Deutschland
											</label>
										</div>
										<div class="control">
											<label class="radio">
												<input type="radio" id="a" name="land" value="aktuell"> Österreich
											</label>
										</div>
									</div>
								</div>

								<!-- Datum -->

								<div class="column">
									<label class="label">Datum</label>
									<div class="field has-addons">
										<div class="control">
											<div class="select">
												<select name="month">
													<option value="01">Januar</option>
													<option value="02">Februar</option>
													<option value="03">März</option>
													<option value="04">April</option>
													<option value="05">Mai</option>
													<option value="06">Juni</option>
													<option value="07">Juli</option>
													<option value="08">August</option>
													<option value="09">September</option>
													<option value="10">Oktober</option>
													<option value="11">November</option>
													<option value="12">Dezember</option>
												</select>
											</div>
										</div>

										<div class="control">
											<input name="year" class="input" type="text">
										</div>
									</div>
								</div>
							</div>

							<hr>

							<!-- Titel -->

							<div class="field">
								<label class="label">Titel</label>
								<div class="control">
									<input name="title" class="input" type="text">
								</div>
							</div>

							<!-- Teaser -->

							<div class="field">
								<label class="label">Text</label>
								<div class="control">
									<textarea name="text" class="textarea has-border"></textarea>
								</div>
							</div>
						</div>

						<div class="column has-background-light">
							<p class="has-text-grey is-uppercase is-size-7">Output</p>
							<textarea class="textarea is-family-code" name="" id="output" cols="30" rows="10" readonly></textarea>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</main>
	<aside class="menu" id="dennisMenu">
		<nav>
			<ul class="menu-list">
				<?php wp_list_pages(array(
					'title_li' => null,
					'walker' => new Templateq_Walker()
				)); ?>
			</ul>
		</nav>
	<aside>
</div>



<script>
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

		$('input, select, .field textarea').on('input propertychange', function() {
			let title = $('input[name="title"]').val();
			let month = {
				num: $('select[name="month"]').val(),
				string: months[$('select[name="month"]').val() - 1]
			};
			let year = $('input[name="year"]').val();
			let ymo = `${year.substr(-2)}${month.num}`;
			let text = $('textarea[name="text"]').val();
			let land = $('input[name="land"]:checked').val();
			let gewerk = $('input[name="gewerk"]:checked').val();
			let slug = makeSlug(title);
			let newspath = `${ymo}-${slug}`;
			let link = `http:/scripts/show.aspx?content=/health/${gewerk}/news/${land}/${year}/${newspath}`;

			$('#output').val(`
${newspath}

${title}

<h3 class="news-heading"><span class="news-datum">${month.string} ${year}</span> <span class="dash">&ndash;</span> ${title}</h3>
<p class="news-text">${text} <a href="${link}" title="Gehe zu: News" class="news-link">Mehr erfahren</a></p>
			`);
		});
	});
</script>
