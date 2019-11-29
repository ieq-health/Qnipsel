<?php

/** Backend */
add_action('admin_enqueue_scripts', function() {
	wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
	wp_enqueue_script('cm_emmet', 'https://cdn.jsdelivr.net/npm/@emmetio/codemirror-plugin@0.5.4/dist/emmet-codemirror-plugin.min.js', array(), '0.5.4');
	wp_add_inline_script('cm_emmet', 'let CodeMirror = wp.CodeMirror;', 'before');
	wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '3.3.1');
	wp_enqueue_script('templateq_backend', get_template_directory_uri() . '/backend/script.js', array('jquery'), $GLOBALS['qnipsel_version']);
});

/** Frontend */
add_action('wp_enqueue_scripts', function() {
	// Remove block library (Gutenberg)
	wp_deregister_style('wp-block-library');

	// Pull latest jQuery
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '3.3.1');

	// Pull custom CSS
	wp_enqueue_style('templateq_css', get_template_directory_uri() . '/dist/css/main.min.css', array(), $GLOBALS['qnipsel_version']);
	wp_enqueue_style('bulma-switch', 'https://cdn.jsdelivr.net/npm/bulma-extensions@6.2.4/bulma-switch/dist/css/bulma-switch.min.css', array(), '6.2.4');
	wp_enqueue_style('fontawesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5/css/all.min.css', array(), '5.8.1');
	wp_enqueue_style('bulma-tooltip', 'https://cdn.jsdelivr.net/npm/bulma-tooltip@2.0.2/dist/css/bulma-tooltip.min.css', array(), '2.0.2');

	// Pull custom JS
	wp_enqueue_script('templateq_codeview', get_template_directory_uri() . '/js/codeview.js', array('jquery'), $GLOBALS['qnipsel_version'], true);
	wp_enqueue_script('templateq_submenu', get_template_directory_uri() . '/js/submenu.js', array('jquery'), $GLOBALS['qnipsel_version'], true);
	wp_enqueue_script('templateq_tabview', get_template_directory_uri() . '/js/tabview.js', array('jquery'), $GLOBALS['qnipsel_version'], true);

	// Dennismode && Darkmode && Linewrap
	wp_enqueue_script('cookies', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', array(), '2', true);
	wp_enqueue_script('templateq_toggleFeatures', get_template_directory_uri() . '/js/toggleFeatures.js', array('cookies'), $GLOBALS['qnipsel_version'], true);

	// Custom Scrollbars
	wp_enqueue_script('simplebar', 'http://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js', array(), 'latest', true);
	wp_enqueue_style('simplebar', 'http://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css', array(), 'latest');

	// Pull Rainbow
	wp_enqueue_script('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js', array(), '1.2.0', true);
	wp_enqueue_script('rainbow-generic', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.min.js', array('rainbow'), '1.2.0', true);
	wp_enqueue_script('rainbow-html', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.min.js', array('rainbow'), '1.2.0', true);
	wp_enqueue_script('rainbow-css', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/css.min.js', array('rainbow'), '1.2.0', true);
	wp_enqueue_script('rainbow-js', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.min.js', array('rainbow'), '1.2.0', true);
	wp_enqueue_style('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.min.css', array('templateq_css'), '1.2.0');
});
