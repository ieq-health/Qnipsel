<?php

/** We don't need the standard editor on pages anymore */
add_action('admin_head', function() {
	remove_post_type_support('page', 'editor');
});

/** Or Gutenberg */
add_filter('use_block_editor_for_post_type', '__return_false');

/** Title Tag */
add_theme_support('title-tag');

/** Remove unnecessary menu items */
add_action('admin_menu', function() {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
});
