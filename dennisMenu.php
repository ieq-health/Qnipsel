<?php 
    if ($post->post_parent) {
        $ancestors = get_post_ancestors($post->ID);
        $root=count($ancestors)-1;
        $parent = $ancestors[$root];
    } else {
        $parent = $post->ID;
    }
?>

<?php if ($parent): ?>
<aside class="menu" id="dennisMenu">
    <nav>
        <ul class="menu-list">
            <?php
            wp_list_pages(array(
                'title_li' => null,
                'child_of' => $parent,
                'walker' => new Templateq_Split_Nav_Sidenav_Walker()
            ));
            ?>
        </ul>
    </nav>
<aside>
<?php endif; ?>