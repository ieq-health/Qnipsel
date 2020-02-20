<?php get_header(); ?>

<div id="site-container">
  <main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<?php get_template_part('partials/content', 'title'); ?>

        <div id="application-json" class="container-fluid xml-stripper">
          <div class="columns">
            <div class="column">
              <p class="has-text-grey is-uppercase is-size-7">Input</p>

              <!-- Firmandaten -->
              <div class="columns">
                <div class="column">
                    <label class="label">Firmendaten</label>

                    <?= fractalFormText(array(
                      'label' => 'Name',
                      'name' => 'name',
                      'placeholder' => 'Firma GmbH'
                    )) ?>

                    <?= fractalFormText(array(
                      'label' => 'Straße',
                      'name' => 'street',
                      'placeholder' => 'Straße'
                    )) ?>

                    <?= fractalFormText(array(
                      'label' => 'PLZ',
                      'name' => 'plz',
                      'placeholder' => 'PLZ'
                    )) ?>

                    <?= fractalFormText(array(
                      'label' => 'Stadt',
                      'name' => 'place',
                      'placeholder' => 'Musterstadt'
                    )) ?>

                    <?= fractalFormSelect(array(
                      'label' => 'Land',
                      'name'  => 'country',
                      'options' => array(
                        array('value' => 'DE', 'label' => 'Deutschland'),
                        array('value' => 'AT', 'label' => 'Österreich'),
                        array('value' => 'CH', 'label' => 'Schweiz'),
                        array('value' => 'NL', 'label' => 'Niederlande'),
                        array('value' => 'LU', 'label' => 'Luxemburg')
                      )
                    )) ?>

                    <?= fractalFormText(array(
                      'label' => 'Industrie',
                      'name' => 'industry',
                      'placeholder' => 'Zahnmedizin'
                    )) ?>

                    <?= fractalFormText(array(
                      'label' => 'Website',
                      'name' => 'website',
                      'placeholder' => 'Website'
                    )) ?>
                </div>
              </div>

              <!-- Jobinfos -->
              <div class="columns">
                <div class="column">
                    <label class="label">Stellenausschreibung</label>

                    <?= fractalFormText(array(
                      'label' => 'Jobtitel',
                      'name' => 'jobtitle',
                      'placeholder' => 'Zahnmedizinische Fachangestellte/r (m/w/d)'
                    )) ?>

                    <?= fracatlFormTextarea(array(
                      'label' => 'Stellenbeschreibung',
                      'name' => 'description'
                    )) ?>

                    <?= fractalFormSelect(array(
                      'label' => 'Beschäftigung',
                      'name'  => 'employmenttype',
                      'options' => array(
                        array('value' => 'FULL_TIME', 'label' => 'Vollzeit'),
                        array('value' => 'PART_TIME', 'label' => 'Teilzeit'),
                        array('value' => 'TEMPORARY', 'label' => 'befristete Stelle'),
                        array('value' => 'INTERN',    'label' => 'Praktikant'),
                        array('value' => 'OTHER',     'label' => 'anderes Arbeitsverhältnis')
                      )
                    )) ?>

                    <?= fractalFormText(array(
                      'label' => 'Veröffentlichungsdatum',
                      'name' => 'postdate',
                      'placeholder' => '2020-01-31'
                    )) ?>

                    <?= fracatlFormTextarea(array(
                      'label' => 'Verantwortlichkeiten',
                      'name' => 'responsibilities',
                    )) ?>

                    <?= fracatlFormTextarea(array(
                      'label' => 'Skills',
                      'name' => 'skills',
                    )) ?>

                    <?= fracatlFormTextarea(array(
                      'label' => 'Qualifikationen',
                      'name' => 'qualifications',
                    )) ?>

                    <?= fracatlFormTextarea(array(
                      'label' => 'Schulische Voraussetzungen',
                      'name' => 'educationrequirements',
                    )) ?>

                    <?= fracatlFormTextarea(array(
                      'label' => 'Arbeitserfahrung Anforderungen',
                      'name' => 'experiencerequirements',
                    )) ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="column has-background-light">
              <p class="has-text-grey is-uppercase is-size-7">Output</p>
              <textarea class="textarea is-family-code" name="" id="output" cols="30" rows="10" readonly=""></textarea>
            </div>
          </div>
        </div>

        <script>

        </script>

			<?php endwhile; ?>
		<?php endif; ?>
  </main>

<?php get_footer(); ?>