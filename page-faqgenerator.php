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
                                                    <input type="text" class="input faq_question" name="question" placeholder="Frage">
                                                </div>
                                                <div class="control is-expanded">
                                                    <input type="text" class="input faq_answer" name="answer" placeholder="Antwort">
                                                </div>
                                            </div>
                                            <span class="faq__item__delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg></span>
                                        </div>
                                    </div>
									
                                    <button class="faq-add button is-outlined">weitere hinzufügen</button>
                                    <button class="faq-generate button is-primary">Give me Dat Code</button>
                                </div>                                
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
