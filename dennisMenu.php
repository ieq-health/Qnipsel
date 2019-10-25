<aside class="menu" id="dennisMenu">
    <nav>
        <ul class="menu-list">
            <?php wp_list_pages(array(
                'title_li' => null,
                'walker' => new Templateq_Split_Nav_Sidenav_Walker()
            )); ?>
        </ul>
    </nav>
<aside>