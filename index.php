<?php get_header(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-dark sidebar">
            <header class="sidebar-sticky">
                <nav>
                    <div id="menu">
                        <ul>
                            <?php
                                wp_list_pages(array(
                                    'title_li' => null
                                ));
                            ?>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>

        <div class="col ml-sm-auto px-4">
        <main>
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('content', get_post_format());
                }
            }
            ?>
        </main>
        </div>
    </div>
</div>
</main>