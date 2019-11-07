<?php

add_action('init', function() {
	$tax_options = array(
		'labels' => array(
			'name'          => 'Kategorien',
			'singular_name' => 'Kategorie'
		),
		'hierarchical' => true
	);

	register_taxonomy(
		'vscode_taxonomy',
		array('vscode_snippet'),
		$tax_options
	);
});

add_action('carbon_fields_register_fields', function() {
	Container::make('post_meta', 'Snippet')
		->where('post_type', '=', 'vscode_snippet')
		->add_fields(array(
			Field::make('multiselect', 'scope', 'Scopes')
				->add_options(array(
					'css' => 'CSS',
					'html' => 'HTML',
					'javascript' => 'Javascript'
				)),

			Field::make('text', 'prefix', 'Prefix'),

			Field::make('textarea', 'body', 'Body')
				->set_attribute('data-editor'),

			Field::make('text', 'description', 'Description')
		));
});

add_action('init', function() {
	register_post_type('vscode_snippet', array(
		'labels' => array(
			'name' => 'VSCode Snippets',
			'singular_name' => 'VSCode Snippet'
		),
		'public' => true,
		'has_archive' => false
	));
	remove_post_type_support('vscode_snippet', 'editor');
});