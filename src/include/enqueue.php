<?php

/** Backend */
add_action('admin_enqueue_scripts', function () {
	wp_enqueue_code_editor(array( 'type' => 'text/html' ));
	wp_enqueue_script('cm_emmet', 'https://cdn.jsdelivr.net/npm/@emmetio/codemirror-plugin@0.5.4/dist/emmet-codemirror-plugin.min.js', array(), '0.5.4');
	wp_add_inline_script('cm_emmet', 'let CodeMirror = wp.CodeMirror;', 'before');
	wp_enqueue_script('templateq_backend', get_template_directory_uri() . '/backend/script.js', array('jquery'), $GLOBALS['qnipsel_version']);
});

/** Frontend */
add_action('wp_enqueue_scripts', function () {
	// Remove block library (Gutenberg)
	wp_deregister_style('wp-block-library');

	// Pull latest jQuery
	wp_deregister_script('jquery');

	// Pull custom CSS
	wp_enqueue_style('templateq_css', get_template_directory_uri() . '/style.css', array(), $GLOBALS['qnipsel_version']);

	// Pull custom JS
	wp_enqueue_script('cookie-js', 'https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js', array(), '2.2.1', true);
	wp_enqueue_script('templateq_js', get_template_directory_uri() . '/main.js', array(), $GLOBALS['qnipsel_version'], true);

	// Pull Rainbow
	wp_enqueue_script('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js', array(), '1.2.0', true);
	wp_enqueue_script('rainbow-generic', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.min.js', array('rainbow'), '1.2.0', true);
	wp_enqueue_script('rainbow-html', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.min.js', array('rainbow'), '1.2.0', true);
	wp_enqueue_script('rainbow-css', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/css.min.js', array('rainbow'), '1.2.0', true);
	wp_enqueue_script('rainbow-js', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.min.js', array('rainbow'), '1.2.0', true);
	wp_enqueue_style('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.min.css', array('templateq_css'), '1.2.0');

	// Pass PHP values to script
	$templateq_icons = array(
		'code' => templateq_icon_code(),
		'delete' => templateq_icon_delete(),
		'plus' => templateq_icon_plus()
	);
	wp_localize_script('templateq_js', 'icons', $templateq_icons);
});
