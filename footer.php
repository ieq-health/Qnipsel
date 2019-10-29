            <?php get_template_part('partials/menu', 'side'); ?>
        </div>

        <footer class="footer has-text-centered">
            <p>
                <?php the_author(); ?> | <?= the_date(); ?> &mdash; <?php the_modified_author(); ?> | <?= the_modified_date(); ?>
            </p>

            <p>
                <a href="https://github.com/ieq-health/Qnipsel"><i class="fab fa-github-alt"></i></a> 
            </p>
        </footer>

    </body>

    <?php wp_footer(); ?>
</html>