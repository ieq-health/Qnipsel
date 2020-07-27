<?php get_header(); ?>

<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

				<div id="application-json" class="container-fluid xml-stripper">
                    <div class="columns">
                
                        <div class="column">
                            <!-- FAQ List -->
                            <div class="columns">
                                <div class="column">
                                    <p class="subtitle">FAQs</p>
                
                                    <div class="field faq">
                                        <div class="faq__item">
                                            <div class="faq__item__content">
                                                <div class="control is-expanded">
                                                    <input type="text" class="input faq_question" name="frage" placeholder="Frage">
                                                </div>
                                                <div class="control is-expanded">
                                                    <input type="text" class="input" name="antwort" placeholder="Antwort">
                                                </div>
                                            </div>
                                            <button class="faq__item__delete">X</button>
                                        </div>
                                    </div>
                
                                </div>
                                <button class="faq-add">weitere hinzufügen</button>
                                <button class="faq-generate">Give me Dat Code</button>
                            </div>
                        </div>
                
                        <div class="column has-background-light">
                            <p class="has-text-grey is-uppercase is-size-7">Output</p>
                            <textarea class="textarea is-family-code faq-generator__output" name="" id="output" cols="30" rows="10"
                                readonly=""></textarea>
                        </div>
                
                    </div>
                </div>

			<?php endwhile; ?>
		<?php endif; ?>
	</main>

<?php get_footer(); ?>
