<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', function () {
	Container::make('post_meta', 'Snippet')
		->where('post_type', '=', 'userscript')
		->add_fields(array(

			Field::make('rich_text', 'description', 'Beschreibung'),

			Field::make('textarea', 'script', 'Script')
				->set_attribute('data-editor'),
		));
});

add_action('init', function () {
	register_post_type('userscript', array(
		'labels' => array(
			'name' => 'Userscripts',
			'singular_name' => 'Userscript'
		),
		'public' => true,
		'has_archive' => false
	));
	remove_post_type_support('userscript', 'editor');
});

