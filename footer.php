        <?php get_template_part('partials/menu', 'side'); ?>

        <footer class="footer has-text-centered">
            <?php the_author(); ?> | <?= the_date(); ?> &mdash; <?php the_modified_author(); ?> | <?= the_modified_date(); ?>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>