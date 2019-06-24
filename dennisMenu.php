<aside class="menu" id="dennisMenu">
    <nav>
        <ul class="menu-list">
            <?php wp_list_pages(array(
                'title_li' => null,
                'walker' => new Templateq_Walker()
            )); ?>
        </ul>
    </nav>
<aside>