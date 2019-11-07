<?php

/** Custom Fields
 * Set up the Custom Fields plugin and define some fields.
 */
require_once( __DIR__ . '/include/fields.php');

/** Walkers
 * Declare our own menu walkers
 */
require_once( __DIR__ . '/include/walkers.php');

/** Snippet
 * Create our own post type and taxonomy
 */
require_once( __DIR__ . '/include/vscode_snippets.php');

/** Cleanup
 * Remove some stuff from the backend
 */
require_once( __DIR__ . '/include/cleanup.php');

/** Fractals
 * Include some template helper functions
 */
require_once( __DIR__ . '/fractals/bulma/forms.php');


/**
 * Allow more file types
 */

add_filter('upload_mimes', function($mime_types) {
	$mime_types['svg'] = 'image/svg+xml';
	$mime_types['psd'] = 'image/vnd.adobe.photoshop';
	return $mime_types;
}, 1, 1);

/**
 * Supporting scripts and styles
 */

/** Backend */
add_action('admin_enqueue_scripts', function() {
	wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
	wp_enqueue_script('cm_emmet', 'https://cdn.jsdelivr.net/npm/@emmetio/codemirror-plugin@0.5.4/dist/emmet-codemirror-plugin.min.js', array(), '0.5.4');
	wp_add_inline_script('cm_emmet', 'let CodeMirror = wp.CodeMirror;', 'before');
	wp_enqueue_script('templateq_backend', get_template_directory_uri() . '/backend/script.js', array(), '0.0.1');
});

/** Frontend */
add_action('wp_enqueue_scripts', function() {
	// Remove block library (Gutenberg)
	wp_deregister_style('wp-block-library');

	// Pull latest jQuery
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '3.3.1');

	// Pull custom CSS
	wp_enqueue_style('templateq_css', get_template_directory_uri() . '/dist/css/main.min.css', array(), '0.0.1');
	wp_enqueue_style('bulma-switch', 'https://cdn.jsdelivr.net/npm/bulma-extensions@6.2.4/bulma-switch/dist/css/bulma-switch.min.css', array(), '6.2.4');
	wp_enqueue_style('fontawesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5/css/all.min.css', array(), '5.8.1');
	wp_enqueue_style('bulma-tooltip', 'https://cdn.jsdelivr.net/npm/bulma-tooltip@2.0.2/dist/css/bulma-tooltip.min.css', array(), '2.0.2');

	// Pull custom JS
	wp_enqueue_script('templateq_codeview', get_template_directory_uri() . '/js/codeview.js', array('jquery'), '0.0.1');
	wp_enqueue_script('templateq_submenu', get_template_directory_uri() . '/js/submenu.js', array('jquery'), '0.0.1');
	wp_enqueue_script('templateq_tabview', get_template_directory_uri() . '/js/tabview.js', array('jquery'), '0.0.1');

	// Dennismode && Darkmode && Linewrap
	wp_enqueue_script('cookies', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', array(), '2');
	wp_enqueue_script('templateq_darkMode', get_template_directory_uri() . '/js/darkMode.js', array('cookies'), '0.0.1');
	wp_enqueue_script('templateq_lineWrap', get_template_directory_uri() . '/js/lineWrap.js', array('cookies'), '0.0.1');

	// Custom Scrollbars
	wp_enqueue_script('simplebar', 'http://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js', array(), 'latest');
	wp_enqueue_style('simplebar', 'http://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css', array(), 'latest');

	// Pull Rainbow
	wp_enqueue_script('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js', array(), '1.2.0');
	wp_enqueue_script('rainbow-generic', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.min.js', array('rainbow'), '1.2.0');
	wp_enqueue_script('rainbow-html', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.min.js', array('rainbow'), '1.2.0');
	wp_enqueue_script('rainbow-css', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/css.min.js', array('rainbow'), '1.2.0');
	wp_enqueue_script('rainbow-js', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.min.js', array('rainbow'), '1.2.0');
	wp_enqueue_style('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.min.css', array('templateq_css'), '1.2.0');
});

/** Recent Changes */
function templateq_recent_updates()
{
	$loop = new WP_Query(array(
		'post_type' => 'page',
		'orderby' => 'modified'
	));

	$counter = 0;

	$string = '<table class="table"><tbody>';

	while ($loop->have_posts() && $counter < 5) {
		$loop->the_post();
		$string .= '<tr><td><a href="' . get_permalink($loop->post->ID) .'">' . get_the_title($loop->post->ID) . '</a></td>';
		$string .= '<td><small>(' . get_the_modified_date() . ')</small></td>';
		$string .= '<td>' . get_the_modified_author() . '</td></tr>';
		$counter++;
	}

	$string .= '</tbody></table>';
	return $string;
}
