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
                  <div class="field">
                    <label class="label">Firmendaten</label>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Name</button>
                      </p>
                      <div class="control">
                        <input type="text" class="input" label="name" name="name" placeholder="Firma GmbH">
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Straße</button>
                      </p>
                      <div class="control">
                        <input type="text" class="input" label="street" name="street" placeholder="Musterstr. 10">
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">PLZ</button>
                      </p>
                      <div class="control">
                        <input type="text" class="input" label="plz" name="plz" placeholder="12345">
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Ort</button>
                      </p>
                      <div class="control">
                        <input type="text" class="input" label="place" name="place" placeholder="Musterstadt">
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Land</button>
                      </p>
                      <div class="select">
                        <select name="land">
                          <option value="DE">Deutschland</option>
                          <option value="CH">Schweiz</option>
                          <option value="AT">Österreich</option>
                          <option value="NL">Niederlande</option>
                          <option value="LU">Luxemburg</option>
                        </select>
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Industrie</button>
                      </p>
                      <div class="control">
                        <input type="text" class="input" label="industry" name="industry" placeholder="Zahnmedizin">
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Website</button>
                      </p>
                      <div class="control">
                        <input type="text" class="input" label="website" name="website" placeholder="www.mustermann.de">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Jobinfos -->
              <div class="columns">
                <div class="column">
                  <div class="field">
                    <label class="label">Stellenausschreibung</label>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Jobtitel</button>
                      </p>
                      <div class="control">
                        <input type="text" class="input" label="jobtitle" name="jobtitle" placeholder="Zahnmedizinische Fachangestellte/r (m/w/d)">
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Stellenbeschreibung</button>
                      </p>
                      <div class="control">
                        <textarea class="textarea has-border" label="description" name="description"></textarea>
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Beschäftigung</button>
                      </p>
                      <div class="select">
                        <select name="employmenttype">
                          <option value="FULL_TIME">Vollzeit</option>
                          <option value="PART_TIME">Teilzeit</option>
                          <option value="TEMPORARY">befristete Stelle</option>
                          <option value="INTERN">Praktikant</option>
                          <option value="OTHER">anderes Arbeitsverhältnis</option>
                        </select>
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Veröffentlichungsdatum</button>
                      </p>
                      <div class="control">
                        <input type="text" class="input" label="postdate" name="postdate" placeholder="2020-01-31">
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Verantwortlichkeiten</button>
                      </p>
                      <div class="control">
                        <textarea class="textarea has-border" label="responsibilities" name="responsibilities"></textarea>
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Skills</button>
                      </p>
                      <div class="control">
                        <textarea class="textarea has-border" label="skills" name="skills"></textarea>
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Qualifikationen</button>
                      </p>
                      <div class="control">
                        <textarea class="textarea has-border" label="qualifications" name="qualifications"></textarea>
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Schulische Voraussetzungen</button>
                      </p>
                      <div class="control">
                        <textarea class="textarea has-border" label="educationrequirements" name="educationrequirements"></textarea>
                      </div>
                    </div>
                    <div class="field has-addons">
                      <p class="control">
                        <button class="button is-static">Arbeitserfahrung Anforderungen</button>
                      </p>
                      <div class="control">
                        <textarea class="textarea has-border" label="experiencerequirements" name="experiencerequirements"></textarea>
                      </div>
                    </div>
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

        $('#application-json').on('input propertychange', 'input, select, .field textarea', function() {
          let name = $('*[name="name"]').val()
          let street = $('*[name="street"]').val()
          let plz = $('*[name="plz"]').val()
          let place = $('*[name=place"]').val()
          let land = $('*[name=land"]').val()
          let industry = $('*[name=industry"]').val()
          let website = $('*[name=website"]').val()

          let jobtitle = $('*[name=jobtitle"]').val()
          let description = $('*[name=description"]').val()
          let employmenttype = $('*[name=employmenttype"]').val()
          let postdate = $('*[name=postdate"]').val()
          let responsibilities = $('*[name=responsibilities"]').val()
          let skills = $('*[name=skills"]').val()
          let qualifications = $('*[name=qualifications"]').val()
          let educationrequirements = $('*[name=educationrequirements"]').val()
          let experiencerequirements = $('*[name=experiencerequirements"]').val()


          $('#output').val(`
<script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "JobPosting",
    "title": "${jobtitle}",     // Job Suche Titel X
    "description": "${description}",    // Beschreibender Text X
    "hiringOrganization" : {
      "@type": "Organization",
      "name": "${name}",    // Firmenname X
      "sameAs": "${website}"    // Internetadresse X
    },
    "industry": "${industry}",    // Welche Industrie X
    "employmentType": "${employmenttype}",   // Arbeitsweise (Vollzeit, Teilzeit etc.) X
    "datePosted": "${postdate}",    // Seit wann kann man sich bewerben X
    "jobLocation": {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "${street}",   // Straße X
        "addressLocality": "${place}",  // Ort X 
        "postalCode": "${plz}",   // PLZ X 
        "addressRegion": "${land}"  // Land X 
      }
    },
    "responsibilities": "${responsibilities}",     // Welche Verantwortlichkeiten
    "skills": "${skills}", // Welche Skills man mitbringt
    "qualifications": "${qualifications}", // Welche Qualifikationen man braucht Jobmäßig
    "educationRequirements": "${educationrequirements}", // Bildungsqualis
    "experienceRequirements": "${experiencerequirements}"  // Erfahrungen 
  }
</script>`);
        });

        </script>

			<?php endwhile; ?>
		<?php endif; ?>
  </main>

  <?php get_footer(); ?>