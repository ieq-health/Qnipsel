<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/** Add navigation title */
function templateq_add_navigation_option($fields)
{
	return array_merge(
		array(
			Field::make('checkbox', 'nav_title_enabled', 'In Subnavigation?')
			->set_option_value('enabled'),

			Field::make('text', 'nav_title', 'Navtitel')
			->set_conditional_logic(array(
				array(
					'field' => 'nav_title_enabled',
					'value' => true
				)
			))
		),
		$fields
	);
}

/** Code field */
function templateq_code_field()
{
	return array(
		Field::make('text', 'language', 'Sprache'),
		Field::make('textarea', 'code', 'Code')
			->set_attribute('data-editor')
	);
}

/** Text field */
function templateq_text_field()
{
	return array(Field::make('rich_text', 'text', 'Text'));
}

/** Message field */
function templateq_message_field()
{
	return array(
		Field::make('text', 'title', 'Titel'),
		Field::make('rich_text', 'body', 'Text'),
		Field::make('select', 'style', 'Stil')
		->add_options(array(
			'dark'    => 'Dark',
			'primary' => 'Primary',
			'link'    => 'Link',
			'info'    => 'Info',
			'success' => 'Success',
			'warning' => 'Warning',
			'danger'  => 'Danger',
		))
	);
}

/** Add custom fields to pages */
add_action('carbon_fields_register_fields', function () {
	Container::make('post_meta', 'Sections')
		->where('post_type', '=', 'page')
		->add_fields(array(
			Field::make('complex', 'crb_sections', 'Sections')

			/** Spalten */
			->add_fields('columns', 'Spalten', templateq_add_navigation_option(array(
				Field::make('complex', 'crb_columns', 'Spalten')
				->add_fields('text', 'Text', templateq_text_field())
				->add_fields('message', 'Message', templateq_message_field())
				->add_fields('code', 'Code', templateq_code_field())
			)))
			
			/** Tabs */
			->add_fields('tabs', 'Tabs', templateq_add_navigation_option(array(
				Field::make('complex', 'crb_tabs', 'Tabs')
				->add_fields('text', 'Text', array(
					Field::make('text', 'title', 'Titel'),
					Field::make('rich_text', 'text', 'Text')
				))
				->add_fields('code', 'Code', array(
					Field::make('text', 'title', 'Titel'),
					Field::make('text', 'language', 'Sprache'),
					Field::make('textarea', 'code', 'Code')
				))
			)))

			/** Text */
			->add_fields('text', 'Text', templateq_add_navigation_option(templateq_text_field()))

			/** Code */
			->add_fields('code', 'Code', templateq_add_navigation_option(templateq_code_field()))

			/** Message */
			->add_fields('message', 'Message', templateq_message_field())

			/** Codepen */
			->add_fields('codepen', 'Codepen', templateq_add_navigation_option(array(
				Field::make('text', 'title', 'Titel'),
				Field::make('textarea', 'html', 'HTML')
				->set_attribute('data-editor', 'html'),
				Field::make('textarea', 'css', 'CSS')
				->set_attribute('data-editor', 'css'),
				Field::make('multiselect', 'css_libs', 'CSS Libraries')
				->add_options(array(
					'bootstrap' => 'Bootstrap',
					'mmenu' => 'mmenu',
					'slick' => 'Slick',
					'swiper' => 'Swiper'
				)),
				Field::make('textarea', 'js', 'JS')
				->set_attribute('data-editor', 'javascript'),
				Field::make('multiselect', 'js_libs', 'JS Libraries')
				->add_options(array(
					'bootstrap' => 'Bootstrap',
					'jquery' => 'jQuery',
					'mmenu' => 'mmenu',
					'slick' => 'Slick',
					'swiper' => 'Swiper'
				))
			)))

			/** Horizontal Rule */
			->add_fields('hr', 'Trennlinie', array(
				Field::make('html', 'hr', 'Trennlinie')
				->set_html('<hr>')
			))

			/** Output in REST Api */
			->set_visible_in_rest_api($visible = true)
		));
});

/** Bootstrap Custom Fields */
add_action('after_setup_theme', function () {
	require_once(__DIR__ . '/../vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
});
