<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('init', function () {
	$tax_options = array(
		'labels' => array(
			'name'          => 'Auto Shys',
			'singular_name' => 'Autoshy'
		),
		'hierarchical' => false,
		'show_in_rest' => true,
	);

	register_taxonomy(
		'autoshy_taxonomy',
		array('autoshy_entry'),
		$tax_options
	);
});

add_action('carbon_fields_register_fields', function () {
	Container::make('post_meta', 'Autoshy')
		->where('post_type', '=', 'autoshy_entry')
		->add_fields(array(
			Field::make('text', 'source', 'Source'),
			Field::make('text', 'replacement', 'Replacement')
		));
});

add_action('init', function () {
	register_post_type('autoshy_entry', array(
		'labels' => array(
			'name' => 'Autoshy Einträge',
			'singular_name' => 'Autoshy Eintrag'
		),
		'public' => true,
		'has_archive' => false,
		'show_in_rest' => true,
	));
	remove_post_type_support('autoshy_entry', 'editor');
});
