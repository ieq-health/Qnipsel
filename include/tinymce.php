<?php

add_filter('mce_buttons', function ($buttons) {
	array_splice($buttons, 6, 0, array('templateq_code_button', 'separator'));
	return $buttons;
});

add_filter('mce_external_plugins', function ($plugin_array) {
	$plugin_array['templateq_code_button'] = get_template_directory_uri() . '/backend/tinymce-code-button.js';
	return $plugin_array;
});
