<?php

add_filter('mce_buttons', function ($buttons) {
	array_splice($buttons, 6, 0, array('templateq_code_button', 'separator', 'templateq_tag_selector'));
	return $buttons;
});

add_filter('mce_external_plugins', function ($plugin_array) {
	// Add button to create inline code snippets 
	$plugin_array['templateq_code_button'] = get_template_directory_uri() . '/backend/tinymce-code-button.js';

	// Add selector to create tags
	$plugin_array['templateq_tag_selector'] = get_template_directory_uri() . '/backend/tinymce-tag-selector.js';
	add_editor_style('/backend/tinymce-tag-styles.css');

	return $plugin_array;
});
