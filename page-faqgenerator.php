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
                                        <div class="faq__item columns">
                                            <div class="faq__item__content column">
                                                <div class="control is-expanded">
                                                    <input type="text" class="input faq_question" name="frage" placeholder="Frage">
                                                </div>
                                                <div class="control is-expanded">
                                                    <input type="text" class="input" name="antwort" placeholder="Antwort">
                                                </div>
                                            </div>
                                            <button class="faq__item__delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg></button>
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
