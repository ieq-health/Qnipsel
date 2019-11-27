            <?php get_template_part('partials/menu', 'side'); ?>
        </div>

        <footer class="footer has-text-centered">
            <p>
                Erstellt von <?php the_author(); ?> | <?= the_date(); ?> &mdash; Zuletzt bearbeitet von <?php the_modified_author(); ?> | <?= the_modified_date(); ?>
            </p>

            <p class="has-text-grey-light">
                Version <?= $GLOBALS['qnipsel_version'] ?> &mdash; <a class="has-text-grey-light" href="https://github.com/ieq-health/Qnipsel"><i class="fab fa-github-alt"></i></a> 
            </p>
        </footer>

    </body>

    <?php wp_footer(); ?>
</html>