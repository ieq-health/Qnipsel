<?php

/** We don't need the standard editor on pages anymore */
function templateq_disable_editor()
{
	remove_post_type_support('page', 'editor');
}
add_action('admin_head', 'templateq_disable_editor');

/** Or Gutenberg */
add_filter('use_block_editor_for_post_type', '__return_false');

/** Title Tag */
add_theme_support('title-tag');

/** Remove unnecessary menu items */
function templateq_clean_admin_menu()
{
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'templateq_clean_admin_menu');
