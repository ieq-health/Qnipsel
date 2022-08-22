<?php

add_action('init', function () {
	$tax_options = array(
		'labels' => array(
			'name'          => 'Kategorien',
			'singular_name' => 'Kategorie'
		),
		'hierarchical' => true
	);

	register_taxonomy(
		'faq_taxonomy',
		array('faq'),
		$tax_options
	);

	register_post_type('faq', array(
		'labels' => array(
			'name' => 'FAQ',
			'singular_name' => 'FAQ'
		),
		'public' => true,
		'has_archive' => true
	));
});
