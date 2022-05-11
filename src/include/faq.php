<?php

add_action('init', function () {
	register_post_type('faq', array(
		'labels' => array(
			'name' => 'FAQ',
			'singular_name' => 'FAQ'
		),
		'public' => true,
		'has_archive' => false
	));
});
