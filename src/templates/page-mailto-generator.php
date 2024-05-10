<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="mailtogenerator" class="container-fluid xml-stripper">
					<div class="columns is-gapless">

						<div class="column">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Input</p>

								<?= fractalFormText(array(
									'label' => array( 'string' => 'Mail', 'required' => true),
									'name' => 'mail',
									'placeholder' => 'max.mustermann@musterfirma.de'
								)) ?>
							</div>
						</div> <!-- // column -->

						<div class="column has-background-light">
							<div class="px-4 py-4">
								<p class="has-text-grey is-uppercase is-size-7">Output</p>
								<textarea class="textarea is-family-code" name="" id="output" cols="30" rows="10" readonly=""></textarea>
							</div>
						</div>

					</div> <!-- // columns -->
				</div> <!-- application -->

				<script>
					const input = document.getElementById('mail')
					const output = document.getElementById('output')

					input.addEventListener('input', function() {
						const addressInput = input.value;
						let addressOutput = ''
					
						for (let character of addressInput) {
							addressOutput += character.charCodeAt() + ';'
						}
						addressOutput = addressOutput.slice(0, -1);
						
						output.value = `\<script\>
						function UnCryptMailto(s) {
						var myS = ''; var arrS = s.split(';'); var i = 0;
						for (i = 0; i < arrS.length; i++) {
							myS += String.fromCharCode(parseInt(arrS[i]));
						}
						return myS;
						}
						document.write('<a href="mailto:' + UnCryptMailto('${addressOutput}') + '">' + UnCryptMailto('${addressOutput}') + '</a>')
						\<\/script\>`
					});
				</script>

			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>
